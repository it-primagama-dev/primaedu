<?php

use Phalcon\Mvc\Model\Resultset;
use Phalcon\Paginator\Adapter\QueryBuilder as Paginator;

class NilaiController extends PartitionedBase {

    public function initialize() {
        $this->tag->setTitle("Nilai Siswa");
        parent::initialize();
    }

    public function indexAction() {
        $this->persistent->parameters = null;
        $this->view->program = $this->getProgramTx(NULL, Resultset::HYDRATE_ARRAYS);
    }

    public function searchAction() {
        $page = 1;
        if ($this->request->isPost()) {
            $this->persistent->parameters = [
                'program' => $this->request->getPost('ProgramSiswa', 'int')
            ];
        } else {
            $page = $this->request->get('page', 'int');
        }
        $param = $this->persistent->parameters;
        //$program = Program::findFirstByRecID($param['program']);
        $program = $this->getProgramTx($param['program'])->getFirst();
        if ($program === FALSE || is_null($param)) {
            $this->flash->error('Program Siswa tidak ditemukan');
            return $this->forward('nilai/index');
        }
        $trans = $this->getTransaction($program->RecID, TRUE);
        $paginator = new Paginator([
            'builder' => $trans, 'limit' => 20, 'page' => $page
        ]);
        $this->view->program = $program;
        $this->view->page = $paginator->getPaginate();
    }

    public function inputAction($RecID = NULL) {
        $program = $this->getProgramTx($this->filter->sanitize($RecID, 'int'))->getFirst();
        if ($program === FALSE || is_null($RecID)) {
            $this->flash->error('Program Siswa tidak ditemukan');
            return $this->forward('nilai/index');
        }
        $this->view->program = $program;
    }

    public function uploadAction() {
        if (!$this->request->isPost()) {
            return $this->forward('nilai/input');
        }
        $files = NULL;
        foreach ($this->request->getUploadedFiles() as $file) {
            $files = $file;
        }
        $program = $this->request->getPost('ProgramSiswa');
        $nilaike = $this->request->getPost('Nilai');
        if (is_null($files)) {
            $this->flash->error('File tidak dapat ditemukan');
            return $this->forward('nilai/input/' . $program);
        }
        $dataExcel = $this->excel->readNilai($files);

        foreach ($dataExcel as $value) {
            $programsiswa = $this->checkSiswa($value['KodeSiswa'], $program)->getFirst();
            if ($programsiswa === FALSE) {
                $this->flash->error($value['NamaSiswa'] . ' tidak dapat ditemukan');
                continue;
            }
            foreach ($value['Nilai'] as $bs => $nilai) {
                $nilaiTx = Nilai::findFirst([
                    'conditions' => 'ProgramSiswaRecId = ?0 AND BidangStudi = ?1',
                    'bind' => [0 => $programsiswa->ProgramSiswa, 1 => $bs]
                ]);
                if ($nilaiTx === FALSE) {
                    $nilaiTx = new Nilai();
                }
                $nilaiTx->ProgramSiswaRecId = $programsiswa->ProgramSiswa;
                $nilaiTx->BidangStudi = $bs;
                $nilaiTx->{$nilaike} = $nilai;
                
                if (!$nilaiTx->save()) {
                    $this->flash->error($value['NamaSiswa'] . ' nilai tidak dapat disimpan');
                }
            }
        }
        return $this->forward('nilai/input/' . $program);
    }

    public function downloadAction($param = NULL) {
        $program = $this->getProgramTx($this->filter->sanitize($param, 'int'))->getFirst();
        if ($program === FALSE || is_null($param)) {
            $this->flash->error('No Data');
            return $this->forward('nilai/index');
        }
        $data = [];
        for ($index = 0; $index < 2; $index++) {
            // First Data for Header
            if ($index === 0) {
                $data[$index] = [];
                continue;
            }
            $data[$index] = ['Kode Siswa', 'Nama Siswa'];
            foreach ($this->getDataToExport($program->RecID) as $value) {
                array_push($data[$index], "$value->NamaBidangStudi ($value->KodeBidangStudi)");
            }
        }
        $this->excel->exportToExcel($data, FALSE, $program->NamaProgram);
    }

    private function getProgramTx($program = NULL, $hydration = Resultset::HYDRATE_OBJECTS) {
        $column = ['p.RecID', 'p.NamaProgram'];
        $cabang = $this->_getParmCabang();
        $query = $this->modelsManager->createBuilder()
                        ->addFrom('Program', 'p')
                        ->join('Programsiswa', 'p.RecID = ps.Program', 'ps')
                        ->join('Siswa', 'ps.Siswa = s.RecID', 's')
                        ->columns($column)->groupBy($column);
        if ($cabang) {
            $query = $query->inWhere('s.Cabang', $cabang);
        }
        if ($program) {
            $query = $query->andWhere('p.RecID = :p:', ['p' => $program]);
        }
        return $query->getQuery()->execute()->setHydrateMode($hydration);
    }

    private function getTransaction($program, $builderOnly = FALSE) {
        $column = ['s.VirtualAccount', 's.NamaSiswa', 'bs.NamaBidangStudi', 'n.RecId',
            'n.Nilai1', 'n.Nilai2', 'n.Nilai3', 'n.Nilai4', 'n.Nilai5',
            'n.Nilai6', 'n.Nilai7', 'n.Nilai8', 'n.Nilai9', 'n.Nilai10'];
        $cabang = $this->_getParmCabang();
        $query = $this->modelsManager->createBuilder()
                ->columns($column)
                ->addFrom('Nilai', 'n')
                ->join('Programsiswa', 'n.ProgramSiswaRecId = ps.RecID', 'ps')
                ->join('Siswa', 'ps.Siswa = s.RecID', 's')
                ->join('Bidangstudi', 'n.BidangStudi = bs.KodeBidangStudi', 'bs')
                ->where('ps.Program = ?0', [0 => $program])
                ->orderBy('n.ProgramSiswaRecId, n.BidangStudi');
        if ($cabang) {
            $query = $query->inWhere('s.Cabang', $cabang);
        }
        return $builderOnly ? $query : $query->getQuery()->execute()
                        ->setHydrateMode(Resultset::HYDRATE_OBJECTS);
    }

    private function getNilaiTx($program, $siswa = NULL, $bs = NULL) {
        $cabang = $this->_getParmCabang();
        $query = $this->modelsManager->createBuilder()
                ->addFrom('Nilai', 'n')
                ->join('Programsiswa', 'n.ProgramSiswaRecId = ps.RecID', 'ps')
                ->join('Siswa', 'ps.Siswa = s.RecID', 's')
                ->where('ps.Program = ?0', [0 => $program]);
        if ($cabang) {
            $query = $query->inWhere('s.Cabang', $cabang);
        }
        if ($siswa) {
            $query = $query->andWhere('s.VirtualAccount = :s:', ['s' => $siswa]);
        }
        if ($bs) {
            $query = $query->andWhere('n.BidangStudi = :s:', ['s' => $siswa]);
        }
        return $query->getQuery()->execute()
                        ->setHydrateMode(Resultset::HYDRATE_OBJECTS);
    }

    private function checkSiswa($siswa, $program) {
        $cabang = $this->_getParmCabang();
        $query = $this->modelsManager->createBuilder()->addFrom('Siswa')
                ->columns('ps.RecID AS ProgramSiswa')
                ->join('Programsiswa', 'Siswa.RecID = ps.Siswa', 'ps')
                ->inWhere('Siswa.Cabang', $cabang)
                ->andWhere('Siswa.VirtualAccount = :s:', ['s' => $siswa])
                ->andWhere('ps.Program = :p:', ['p' => $program]);
        return $query->getQuery()->execute()
                        ->setHydrateMode(Resultset::HYDRATE_OBJECTS);
    }

    private function getDataToExport($program = NULL) {
        $column = ['bs.KodeBidangStudi', 'bs.NamaBidangStudi'];
        $cabang = $this->_getParmCabang();
        $query = $this->modelsManager->createBuilder()
                        ->columns($column)
                        ->addFrom('Programsiswa', 'ps')
                        ->join('Scheduleheader', 'ps.ScheduleHeader = sh.RecId', 'sh')
                        ->join('Scheduledetail', 'sh.RecId = sd.Schedule', 'sd')
                        ->join('Bidangstudi', 'sd.BidangStudi = bs.KodeBidangStudi', 'bs')
                        ->where('ps.Program = :p:', ['p' => $program])
                        ->groupBy($column)->orderBy('KodeBidangStudi');
        if ($cabang) {
            $query = $query->inWhere('sh.Cabang', $cabang);
        }
        $data = $query->getQuery()->execute()
                ->setHydrateMode(Resultset::HYDRATE_OBJECTS);
        return count($data) ? $data : Bidangstudi::find();
    }

}
