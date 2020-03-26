<?php

class LaporanraporsiswaController extends ControllerBase
{

    protected $auth;

    public function initialize() {
        $this->tag->setTitle("Rapor Siswa");
        parent::initialize();
        // Check Session
        if($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
        }
    }

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for LaporanSiswa
     */
    public function searchAction()
    {

        $siswa = Siswa::findFirst(array(
            "VirtualAccount = :va: AND Cabang = :cabang:",
            "bind" => array("va" => $this->request->getPost("KodeSiswa", "int"), "cabang" => $this->auth['areacabang']),
            "order" => "CreatedAt DESC"
        ));

        if(!$siswa) {
            $this->flash->error("Data siswa tidak ditemukan");
            return $this->forward("laporanraporsiswa/index");
        }

        $programsiswa = Programsiswa::findBySiswa($siswa->RecID);

        if(count($programsiswa) == 0) {
            $this->flash->error("Siswa belum mengikuti program");
            return $this->forward("laporanraporsiswa/index");
        }

        $this->view->programsiswa = $programsiswa;
    }

    public function printAction($param) {
        $this->view->disable();
        $pdf = new pdf();
        $pdf->pdf_output_l("Rapor Siswa", $this->printReport($param));
    }

    public function printReport($RecId) {

        $programsiswa = Programsiswa::findFirst($RecId);
        
        $nilaisiswa = $programsiswa->nilai;

        $content =
'<tr>
    <td class="pad1" colspan="2">
        <table class="tablePrintContent">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>' . $programsiswa->getSiswa() . '</td>
            </tr>
            <tr>
                <td>Kode Siswa</td>
                <td>:</td>
                <td>' . $programsiswa->getKodeSiswa() . '</td>
            </tr>
            <tr>
                <td>Program</td>
                <td>:</td>
                <td>' . $programsiswa->getProgram() . '</td>
            </tr>
        </table>
        <table width="100%" border="1" style="border-collapse: collapse; margin-top: 10pt">
            <tr>
                <td align="center">Bidang Studi</td>
                <td align="center" width="8%">Nilai 1</td>
                <td align="center" width="8%">Nilai 2</td>
                <td align="center" width="8%">Nilai 3</td>
                <td align="center" width="8%">Nilai 4</td>
                <td align="center" width="8%">Nilai 5</td>
                <td align="center" width="8%">Nilai 6</td>
                <td align="center" width="8%">Nilai 7</td>
                <td align="center" width="8%">Nilai 8</td>
                <td align="center" width="8%">Nilai 9</td>
                <td align="center" width="8%">Nilai 10</td>
            </tr>';
        
        foreach ($nilaisiswa as $nilai) {
            $content .=
                    '<tr>
                <td>' . $nilai->getBidangStudi() . '</td>
                <td>' . $nilai->Nilai1 . '</td>
                <td>' . $nilai->Nilai2 . '</td>
                <td>' . $nilai->Nilai3 . '</td>
                <td>' . $nilai->Nilai4 . '</td>
                <td>' . $nilai->Nilai5 . '</td>
                <td>' . $nilai->Nilai6 . '</td>
                <td>' . $nilai->Nilai7 . '</td>
                <td>' . $nilai->Nilai8 . '</td>
                <td>' . $nilai->Nilai9 . '</td>
                <td>' . $nilai->Nilai10 . '</td>
            </tr>';
        }
        
        $content .= '</table></td></tr>';

        return $content;
    }
}

