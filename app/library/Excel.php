<?php

namespace Primaedu\Excel;

use Phalcon\Mvc\User\Component;

require_once __DIR__ . '/../../vendor/PHPExcel/PHPExcel.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

class Excel extends Component {

    public function downloadSchedule($ismart, $ruangan, $bidangStudi) {

        define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

        require_once dirname(__FILE__) . '/../../Vendor/PHPExcel/PHPExcel.php';
        // Create new PHPExcel object
        //echo date('H:i:s') , " Create new PHPExcel object" , EOL;
        $objPHPExcel = new \PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Techno one")
                ->setLastModifiedBy("Techno one")
                ->setTitle("Template Excel")
                ->setSubject("Template Excel")
                ->setDescription("Document for PHPExcel, generated using PHP classes.")
                ->setKeywords("office PHPExcel php")
                ->setCategory("Schedule Template");

        // Add some data on sheet 1
        $objPHPExcel->setActiveSheetIndex(0)
                ->setTitle('Input Jadwal')
                ->setCellValue('A2', 'Tanggal (contoh, 21/02/2015)')
//                ->setCellValue('A3', '01/01/2015')
                ->setCellValue('B2', 'Jam (contoh, 15:00)')
//                ->setCellValue('B3', '15:00')
                ->setCellValue('C2', 'Guru')
                ->setCellValue('D2', 'Ruangan')
                ->setCellValue('E2', 'BidangStudi');

        // Add some data on sheet 2 (kode i-smart)
        $objPHPExcel->createSheet(null, 1);
        $objPHPExcel->setActiveSheetIndex(1)
                ->setTitle('Kode I-smart')
                ->setCellValue('A1', 'Kode I-smart');

        //set cell ismart value from database
        for ($i = 0; $i < count($ismart); $i++) {
            $objPHPExcel->getSheet(1)->setCellValue('A' . ($i + 2), $ismart[$i]->KodeISmart . " - " . $ismart[$i]->NamaISmart . " (" . $ismart[$i]->RecID . ")");
        }

        // Add some data on sheet 3 (kode ruangan)
        $objPHPExcel->createSheet(null, 2);
        $objPHPExcel->setActiveSheetIndex(2)
                ->setTitle('Kode Ruangan')
                ->setCellValue('A1', 'Kode Ruangan');

        //set cell ruangan value from database
        for ($i = 0; $i < count($ruangan); $i++) {
            $objPHPExcel->getSheet(2)->setCellValue('A' . ($i + 2), $ruangan[$i]->KodeRuangan . " - " . $ruangan[$i]->NamaRuangan . " (" . $ruangan[$i]->RecID . ")");
        }

        // Add some data on sheet 4 (bidang studi)
        $objPHPExcel->createSheet(null, 3);
        $objPHPExcel->setActiveSheetIndex(3)
                ->setTitle('Kode Bidang Studi')
                ->setCellValue('A1', 'Kode Bidang Studi');

        //set cell bidstudi value from database
        for ($i = 0; $i < count($bidangStudi); $i++) {
            $objPHPExcel->getSheet(3)->setCellValue('A' . ($i + 2), $bidangStudi[$i]->NamaBidangStudi . " (" . $bidangStudi[$i]->KodeBidangStudi . ")");
        }

        $objPHPExcel->setActiveSheetIndex(0); //activate first sheet

        $objPHPExcel->addNamedRange(
                new \PHPExcel_NamedRange(
                'kodeismart', $objPHPExcel->getSheet(1), 'A2:A' . (count($ismart) + 1)
                )
        );

        //$objPHPExcel->getSheet(0)->SetCellValue("B1", "London");
        $objPHPExcel->addNamedRange(
                new \PHPExcel_NamedRange(
                'ruangan', $objPHPExcel->getSheet(2), 'A2:A' . (count($ruangan) + 1)
                )
        );

        $objPHPExcel->addNamedRange(
                new \PHPExcel_NamedRange(
                'kodebidangstudi', $objPHPExcel->getSheet(3), 'A2:A' . (count($bidangStudi) + 1)
                )
        );

        //$objValidation = $objPHPExcel->getActiveSheet()->getCell('A1')->getDataValidation();
        for ($i = 3; $i < 200; $i++) {
            $objValidation = $objPHPExcel->getSheet(0)->getCell('C' . $i)->getDataValidation();
            $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
            $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
            $objValidation->setAllowBlank(false);
            $objValidation->setShowInputMessage(true);
            $objValidation->setShowErrorMessage(true);
            $objValidation->setShowDropDown(true);
            $objValidation->setErrorTitle('Input error');
            $objValidation->setError('Value is not in list.');
            $objValidation->setPromptTitle('Kode I-smart');
            $objValidation->setPrompt('Pilih Kode I-smart dari drop-down list.');
            $objValidation->setFormula1("=kodeismart"); //note this!
        }

        for ($i = 3; $i < 200; $i++) {
            $objValidation = $objPHPExcel->getSheet(0)->getCell('D' . $i)->getDataValidation();
            $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
            $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
            $objValidation->setAllowBlank(false);
            $objValidation->setShowInputMessage(true);
            $objValidation->setShowErrorMessage(true);
            $objValidation->setShowDropDown(true);
            $objValidation->setErrorTitle('Input error');
            $objValidation->setError('Value is not in list.');
            $objValidation->setPromptTitle('Kode Ruangan');
            $objValidation->setPrompt('Pilih kode ruangan dari drop-down list.');
            $objValidation->setFormula1('=ruangan');
        }

        for ($i = 3; $i < 200; $i++) {
            $objValidation = $objPHPExcel->getSheet(0)->getCell('E' . $i)->getDataValidation();
            $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
            $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
            $objValidation->setAllowBlank(false);
            $objValidation->setShowInputMessage(true);
            $objValidation->setShowErrorMessage(true);
            $objValidation->setShowDropDown(true);
            $objValidation->setErrorTitle('Input error');
            $objValidation->setError('Value is not in list.');
            $objValidation->setPromptTitle('Kode Bidang Studi');
            $objValidation->setPrompt('Pilih kode bidang studi dari drop-down list.');
            $objValidation->setFormula1('=kodebidangstudi');
        }

        // Save Excel 2007 file
        $filename = microtime(true) . '.xlsx';
        $filePath = str_replace('Excel.php', $filename, __FILE__);
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($filePath);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"template_jadwal_new.xlsx\"");
        readfile($filePath);
        unlink($filePath);
        die();
    }

    public function downloadFormBarcode($kodepr) {

        define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

        require_once dirname(__FILE__) . '/../../Vendor/PHPExcel/PHPExcel.php';
        // Create new PHPExcel object
        //echo date('H:i:s') , " Create new PHPExcel object" , EOL;
        $objPHPExcel = new \PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Primaedu")
                ->setLastModifiedBy("Primaedu")
                ->setTitle("Form Barcode")
                ->setSubject("Form Barcode")
                ->setDescription("Document for PHPExcel, generated using PHP classes.")
                ->setKeywords("office PHPExcel php")
                ->setCategory("Form Barcode Logistik");

        // Add some data on sheet 1
        $objPHPExcel->setActiveSheetIndex(0)
                ->setTitle('Input Barcode')
                ->setCellValue('A1', 'Kode PR')
                ->setCellValue('B1', 'Barcode')
                ->setCellValue('A2', $kodepr);

        // Save Excel 2007 file
        $filename = microtime(true) . '.xlsx';
        $filePath = str_replace('Excel.php', $filename, __FILE__);
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($filePath);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"form_barcode.xlsx\"");
        readfile($filePath);
        unlink($filePath);
        die();
    }

    public function downloadNilai($siswa, $bidangStudi) {

        define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

        require_once dirname(__FILE__) . '/../../Vendor/PHPExcel/PHPExcel.php';
        // Create new PHPExcel object
        //echo date('H:i:s') , " Create new PHPExcel object" , EOL;
        $objPHPExcel = new \PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("PrimaEdu")
                ->setLastModifiedBy("PrimaEdu")
                ->setTitle("Template Excel")
                ->setSubject("Template Excel")
                ->setDescription("Document for PHPExcel, generated using PHP classes.")
                ->setKeywords("office PHPExcel php")
                ->setCategory("Schedule Template");

        // Add some data on sheet 1
        $objPHPExcel->setActiveSheetIndex(0)
                ->setTitle('Input Nilai')
                ->setCellValue('A2', 'Siswa')
                ->setCellValue('B2', 'Bidang Studi')
                ->setCellValue('C2', 'Nilai 1')
                ->setCellValue('D2', 'Nilai 2')
                ->setCellValue('E2', 'Nilai 3')
                ->setCellValue('F2', 'Nilai 4')
                ->setCellValue('G2', 'Nilai 5')
                ->setCellValue('H2', 'Nilai 6')
                ->setCellValue('I2', 'Nilai 7')
                ->setCellValue('J2', 'Nilai 8')
                ->setCellValue('K2', 'Nilai 9')
                ->setCellValue('L2', 'Nilai 10');

        // Add some data on sheet 2 (kode i-smart)
        $objPHPExcel->createSheet(null, 1);
        $objPHPExcel->setActiveSheetIndex(1)
                ->setTitle('Kode Siswa')
                ->setCellValue('A1', 'Kode Siswa');

        //set cell ismart value from database
        for ($i = 0; $i < count($siswa); $i++) {
            $objPHPExcel->getSheet(1)->setCellValue('A' . ($i + 2), $siswa[$i]->VirtualAccount . " - " . $siswa[$i]->NamaSiswa . " (" . $siswa[$i]->RecID . ")");
        }


        // Add some data on sheet 3 (bidang studi)
        $objPHPExcel->createSheet(null, 2);
        $objPHPExcel->setActiveSheetIndex(2)
                ->setTitle('Kode Bidang Studi')
                ->setCellValue('A1', 'Kode Bidang Studi');

        //set cell bidstudi value from database
        for ($i = 0; $i < count($bidangStudi); $i++) {
            $objPHPExcel->getSheet(2)->setCellValue('A' . ($i + 2), $bidangStudi[$i]->NamaBidangStudi . " (" . $bidangStudi[$i]->KodeBidangStudi . ")");
        }

        $objPHPExcel->setActiveSheetIndex(0); //activate first sheet

        $objPHPExcel->addNamedRange(
                new \PHPExcel_NamedRange(
                'siswa', $objPHPExcel->getSheet(1), 'A2:A' . (count($siswa) + 1)
                )
        );

        $objPHPExcel->addNamedRange(
                new \PHPExcel_NamedRange(
                'kodebidangstudi', $objPHPExcel->getSheet(2), 'A2:A' . (count($bidangStudi) + 1)
                )
        );

        //$objValidation = $objPHPExcel->getActiveSheet()->getCell('A1')->getDataValidation();
        for ($i = 3; $i < 50; $i++) {
            $objValidation = $objPHPExcel->getSheet(0)->getCell('A' . $i)->getDataValidation();
            $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
            $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
            $objValidation->setAllowBlank(false);
            $objValidation->setShowInputMessage(true);
            $objValidation->setShowErrorMessage(true);
            $objValidation->setShowDropDown(true);
            $objValidation->setErrorTitle('Input error');
            $objValidation->setError('Value is not in list.');
            $objValidation->setPromptTitle('Kode Siswa');
            $objValidation->setPrompt('Pilih Kode Siswa dari drop-down list.');
            $objValidation->setFormula1("=siswa"); //note this!
        }

        for ($i = 3; $i < 50; $i++) {
            $objValidation = $objPHPExcel->getSheet(0)->getCell('B' . $i)->getDataValidation();
            $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
            $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
            $objValidation->setAllowBlank(false);
            $objValidation->setShowInputMessage(true);
            $objValidation->setShowErrorMessage(true);
            $objValidation->setShowDropDown(true);
            $objValidation->setErrorTitle('Input error');
            $objValidation->setError('Value is not in list.');
            $objValidation->setPromptTitle('Kode Bidang Studi');
            $objValidation->setPrompt('Pilih kode bidang studi dari drop-down list.');
            $objValidation->setFormula1('=kodebidangstudi');
        }

        // Save Excel 2007 file
        $filename = microtime(true) . '.xlsx';
        $filePath = str_replace('Excel.php', $filename, __FILE__);
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($filePath);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"template_nilai_new.xlsx\"");
        readfile($filePath);
        unlink($filePath);
        die();
    }

    public function readFile($fileUpload) {
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($fileUpload->getTempName());
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($fileUpload->getTempName());
        } catch (Exception $e) {
            $this->flash->error('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());

            return;
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();

        //  Loop through each row of the worksheet in turn
        $result = array();


        $counter = 0;

        $firstRow = 3;

        for ($row = 0; $row < $highestRow; $row++) {

            if ($sheet->getCell('A' . ($firstRow + $row))->getValue() == null)
                break;

            $result[$row]['Siswa'] = $sheet->getCell('A' . ($firstRow + $row))->getValue();
            $result[$row]['BidangStudi'] = $sheet->getCell('B' . ($firstRow + $row))->getValue();
            $result[$row]['nilai1'] = $sheet->getCell('C' . ($firstRow + $row))->getValue();
            $result[$row]['nilai2'] = $sheet->getCell('D' . ($firstRow + $row))->getValue();
            $result[$row]['nilai3'] = $sheet->getCell('E' . ($firstRow + $row))->getValue();
            $result[$row]['nilai4'] = $sheet->getCell('F' . ($firstRow + $row))->getValue();
            $result[$row]['nilai5'] = $sheet->getCell('G' . ($firstRow + $row))->getValue();
            $result[$row]['nilai6'] = $sheet->getCell('H' . ($firstRow + $row))->getValue();
            $result[$row]['nilai7'] = $sheet->getCell('I' . ($firstRow + $row))->getValue();
            $result[$row]['nilai8'] = $sheet->getCell('J' . ($firstRow + $row))->getValue();
            $result[$row]['nilai9'] = $sheet->getCell('K' . ($firstRow + $row))->getValue();
            $result[$row]['nilai10'] = $sheet->getCell('L' . ($firstRow + $row))->getValue();
        }

        return $result;
    }

    public function readSchedule($fileUpload, $ext = null) {
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($fileUpload->getTempName());
            //$inputFileType = $ext;
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($fileUpload->getTempName());
        } catch (Exception $e) {
            //$this->flash->error('Error loading file "'.pathinfo($fileUpload,PATHINFO_BASENAME).'": '.$e->getMessage());
            $this->flash->error('Error loading file : ' . $e->getMessage());
            return;
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();

        //  Loop through each row of the worksheet in turn
        $result = array();

        $counter = 0;

        $firstRow = 3;

        for ($row = 0; $row < $highestRow; $row++) {

            if ($sheet->getCell('A' . ($firstRow + $row))->getValue() == null)
                break;

            $result[$row]['Tanggal'] = \PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell('A' . ($firstRow + $row))->getValue(), 'YYYYMMDD');
            $result[$row]['Jam'] = \PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell('B' . ($firstRow + $row))->getValue(), 'hh:mm:ss');
            $result[$row]['Guru'] = $sheet->getCell('C' . ($firstRow + $row))->getValue();
            $result[$row]['Ruangan'] = $sheet->getCell('D' . ($firstRow + $row))->getValue();
            $result[$row]['BidangStudi'] = $sheet->getCell('E' . ($firstRow + $row))->getValue();
        }

        return $result;
    }

   //BRI
	
	public function readCardBRI($fileUpload) {
      try {
            $inputFileType = \PHPExcel_IOFactory::identify($fileUpload->getTempName());
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($fileUpload->getTempName());
        } catch (Exception $e) {
            //$this->flash->error('Error loading file "'.pathinfo($fileUpload,PATHINFO_BASENAME).'": '.$e->getMessage());
            $this->flash->error('Error loading file : ' . $e->getMessage());
            return;
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(1);
        $highestRow = $sheet->getHighestRow();

        //  Loop through each row of the worksheet in turn
        $result = array();

        $counter = 0;

        $firstRow = 1;

        for ($row = 0; $row < $highestRow; $row++) {

          
				$result[$row]['auth_cd'] = $sheet->getCell('E' . ($firstRow + $row))->getValue();
				$result[$row]['cardno'] = $sheet->getCell('C' . ($firstRow + $row))->getValue();
				$result[$row]['term_id'] = $sheet->getCell('A' . ($firstRow + $row))->getValue();
				$result[$row]['trans_date'] = $sheet->getCell('I' . ($firstRow + $row))->getValue();
			//	$result[$row]['trans_time'] = $sheet->getCell('Y' . ($firstRow + $row))->getValue();
			//	$result[$row]['batch_ptlf'] = $sheet->getCell('F' . ($firstRow + $row))->getValue();
				$result[$row]['seq'] = $sheet->getCell('G' . ($firstRow + $row))->getValue();
			//	$result[$row]['auth_cd'] = $sheet->getCell('A' . ($firstRow + $row))->getValue();
			//	$result[$row]['cardno'] = $sheet->getCell('C' . ($firstRow + $row))->getValue();
            //                     $result[$row]['status'] = $sheet->getCell('S' . ($firstRow + $row))->getValue();
			    $result[$row]['nett_amt'] = preg_replace("/[^0-9]/", "", $sheet->getCell('H' . ($firstRow + $row))->getValue());
		        $result[$row]['gros_amt'] = preg_replace("/[^0-9]/", "", $sheet->getCell('F' . ($firstRow + $row))->getValue());
		/*	$str = ltrim( $sheet->getCell('K' . ($firstRow + $row))->getValue(),'0'); 
				$str=ceil($str);
				$result[$row]['nett_amt'] = $str;
				$str1 = ltrim( $sheet->getCell('E' . ($firstRow + $row))->getValue(),'0'); 
				$str1=ceil($str1);
				$result[$row]['gros_amt'] = $str1;
			*/	
        }
        return $result;
    }
	
	
	//END BRI

    public function readBarcode($fileUpload, $ext = null) {
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($fileUpload->getTempName());
            //$inputFileType = $ext;
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($fileUpload->getTempName());
        } catch (Exception $e) {
            //$this->flash->error('Error loading file "'.pathinfo($fileUpload,PATHINFO_BASENAME).'": '.$e->getMessage());
            $this->flash->error('Error loading file : ' . $e->getMessage());
            return;
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();

        //  Loop through each row of the worksheet in turn
        $result = array();

        $counter = 0;

        $firstRow = 2;

        for ($row = 0; $row < $highestRow; $row++) {

            if ($sheet->getCell('B' . ($firstRow + $row))->getValue() == null)
                break;

            $result[$row]['Barcode'] = $sheet->getCell('B' . ($firstRow + $row))->getValue();
        }

        return $result;
    }
	
	public function readCardBCA($fileUpload) {
      try {
            $inputFileType = \PHPExcel_IOFactory::identify($fileUpload->getTempName());
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($fileUpload->getTempName());
        } catch (Exception $e) {
            //$this->flash->error('Error loading file "'.pathinfo($fileUpload,PATHINFO_BASENAME).'": '.$e->getMessage());
            $this->flash->error('Error loading file : ' . $e->getMessage());
            return;
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();

        //  Loop through each row of the worksheet in turn
        $result = array();

        $counter = 0;

        $firstRow = 1;

        for ($row = 0; $row < $highestRow; $row++) {

          
				$result[$row]['auth_cd'] = $sheet->getCell('A' . ($firstRow + $row))->getValue();
				$result[$row]['cardno'] = $sheet->getCell('B' . ($firstRow + $row))->getValue();
				$result[$row]['term_id'] = $sheet->getCell('W' . ($firstRow + $row))->getValue();
				$result[$row]['trans_date'] = $sheet->getCell('M' . ($firstRow + $row))->getValue();
				$result[$row]['trans_time'] = $sheet->getCell('Y' . ($firstRow + $row))->getValue();
				$result[$row]['batch_ptlf'] = $sheet->getCell('F' . ($firstRow + $row))->getValue();
				$result[$row]['seq'] = $sheet->getCell('G' . ($firstRow + $row))->getValue();
				$result[$row]['auth_cd'] = $sheet->getCell('A' . ($firstRow + $row))->getValue();
				$result[$row]['cardno'] = $sheet->getCell('B' . ($firstRow + $row))->getValue();
                                 $result[$row]['status'] = $sheet->getCell('S' . ($firstRow + $row))->getValue();
				$str = ltrim( $sheet->getCell('K' . ($firstRow + $row))->getValue(),'0'); 
				$str=ceil($str);
				$result[$row]['nett_amt'] = $str;
				$str1 = ltrim( $sheet->getCell('E' . ($firstRow + $row))->getValue(),'0'); 
				$str1=ceil($str1);
				$result[$row]['gros_amt'] = $str1;
        }
        return $result;
    }
	
    public function readFilelama($fileUpload) {
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($fileUpload->getTempName());
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($fileUpload->getTempName());
        } catch (Exception $e) {
            $this->flash->error('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
            return;
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = "N"; //$sheet->getHighestColumn();
        //  Loop through each row of the worksheet in turn
        $result = array();
        $header = array();
        $data = array();
        $counter = 0;
        $counterHeader = 0;
        $counterData = 0;
        $columnNumber = 0;
        for ($row = 1; $row <= $highestRow; $row++) { // Start Reading from row (B2) or Line 9 column 2
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, TRUE, TRUE); //FALSE);
            //  Insert row data array into database
            foreach ($rowData as $key => $value) {
                $columnNumber = count($value);

                foreach ($value as $key2 => $cell) {

                    /*
                      Counter = 0 : Dokumentasi
                      Counter = 1 : Judul File
                      Counter = 2 : Header
                      Counter = 3 : isi file
                      Dalam file excel dipisahkan oleh 1 baris kosong
                     */


                    //Cek baris
                    if ($key2 == 0 && $cell == "") {
                        // Ganti Baris
                        $counter++;
                    } else {
                        if ($cell != "" || $cell != null) {
                            if ($counter == 2) {
                                $header[$counterHeader] = $cell;
                                $counterHeader++;
                            } else if ($counter > 2) {
                                $data[$counterData] = $cell;
                                $counterData++;
                            }
                        }
                    }
                }
            }
        }

        $columnNumber = 14;

        // reasmbling array
        $resultHeader = array();
        $jumlahBarisData = count($header) / 2;
        $index = 0;
        for ($i = 0; $i < $jumlahBarisData; $i++) {
            $temp = array();
            for ($j = 0; $j < 2; $j++) {
                if ($header[$index] != null) {
                    $temp[$j] = $header[$index];
                    $index++;
                }
            }
            $resultHeader[$i] = $temp;
        }

        $resultData = array();
        $jumlahBarisData = count($data) / $columnNumber;
        $index = 0;
        for ($i = 0; $i < $jumlahBarisData; $i++) {
            $temp = array();
            for ($j = 0; $j < $columnNumber; $j++) {
                $temp[$data[$j]] = $data[$index];

                $index++;
            }
            $resultData[$i] = $temp;
        }
        array_shift($resultData);

        if (count($data) > 0) {
            $result['header'] = $resultHeader;
            $result['data'] = $resultData;
        }

        return $result;
    }

    public function readJadwal($fileUpload) {
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($fileUpload);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($fileUpload->getTempName());
        } catch (Exception $e) {
            $this->flash->error('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
            return;
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        //  Loop through each row of the worksheet in turn
        $result = array();
        $header = array();
        $data = array();
        $counter = 0;
        $counterHeader = 0;
        $counterData = 0;
        $columnNumber = 0;
        for ($row = 1; $row <= $highestRow; $row++) { // Start Reading from row (B2) or Line 9 column 2
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, TRUE); //FALSE);
            //  Insert row data array into database

            foreach ($rowData as $key => $value) {
                $columnNumber = count($value);
                foreach ($value as $key2 => $cell) {
                    /*
                      Counter = 0 : Dokumentasi
                      Counter = 1 : Judul File
                      Counter = 2 : Header
                      Counter = 3 : isi file
                      Dalam file excel dipisahkan oleh 1 baris kosong
                     */


                    //Cek baris
                    if ($key2 == 0 && $cell == "") {
                        // Ganti Baris
                        $counter++;
                    } else {
                        if ($cell != "" || $cell != null) {
                            if ($counter == 2) {
                                $header[$counterHeader] = $cell;
                                $counterHeader++;
                            } else if ($counter > 2) {
                                $data[$counterData] = $cell;
                                $counterData++;
                            }
                        }
                    }
                }
            }
        }

        $columnNumber = 7;

        // reasmbling array
        $resultHeader = array();
        $jumlahBarisData = count($header) / 2;
        $index = 0;
        for ($i = 0; $i < $jumlahBarisData; $i++) {
            $temp = array();
            for ($j = 0; $j < 2; $j++) {
                if ($header[$index] != null) {
                    $temp[$j] = $header[$index];
                    $index++;
                }
            }
            $resultHeader[$i] = $temp;
        }

        $resultData = array();
        $jumlahBarisData = count($data) / $columnNumber;
        $index = 0;
        for ($i = 0; $i < $jumlahBarisData; $i++) {
            $temp = array();
            for ($j = 0; $j < $columnNumber; $j++) {
                $temp[$data[$j]] = $data[$index];
                $index++;
            }
            $resultData[$i] = $temp;
        }
        array_shift($resultData);

        if (count($data) > 0) {
            $result['header'] = $resultHeader;
            $result['data'] = $resultData;
        }

        return $result;
    }

    public function uploadRekening($fileUpload) {
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($fileUpload->getTempName());
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($fileUpload->getTempName());
        } catch (Exception $e) {
            $this->flash->error('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());

            return;
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();

        //  Loop through each row of the worksheet in turn
        $result = [];

        $firstRow = 2;

        for ($row = 0; $row < $highestRow; $row++) {

            if ($sheet->getCell('A' . ($firstRow + $row))->getValue() == null)
                break;

            $kodecabang = $this->filter->sanitize($sheet->getCell('C' . ($firstRow + $row))->getValue(), 'int');
            $result[$row]['KodeAreaCabang'] = $kodecabang != '' ? str_pad($kodecabang, 4, '0', STR_PAD_LEFT) : NULL;
            $result[$row]['NoRekening'] = preg_replace("/[^0-9]/", "", $sheet->getCell('E' . ($firstRow + $row))->getValue());
            $result[$row]['NamaRekening'] = strtoupper(trim($sheet->getCell('F' . ($firstRow + $row))->getValue()));
            $result[$row]['NamaBank'] = trim($sheet->getCell('G' . ($firstRow + $row))->getValue());
            $result[$row]['KodeBank'] = $this->filter->sanitize($sheet->getCell('H' . ($firstRow + $row)), "int");
        }

        return $result;
    }

    /*
     * TOC-RB : 7 Aug 2015
     */

    public function exportToExcel(array $data, $header = FALSE, $fileName = NULL, $title = 'primaedu') {
        if (!is_array($data)) {
            return FALSE;
        }
        define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
        require_once dirname(__FILE__) . '/../../Vendor/PHPExcel/PHPExcel.php';

        $objExcel = new \PHPExcel();

        // Set document properties
        $objExcel->getProperties()->setCreator("Techno One Consulting")
                ->setLastModifiedBy("Techno One Consulting")
                ->setTitle("Primaedu Data Export")
                ->setSubject("Primaedu Data Export")
                ->setDescription("Document for PHPExcel, generated using PHP classes.")
                ->setCategory("Primaedu Data Export");

        $objExcel->setActiveSheetIndex(0)->setTitle($title);

        // Set Initial Cell Row
        $rownum = 1;
        $headerFlag = TRUE;
        foreach ($data as $row) {
            // Set Initial Cell Column
            $colnum = 'A';
            if ($header && $headerFlag) {
                $this->exportToExcel_PrintHeader($objExcel, array_keys($row), $rownum);
                $headerFlag = FALSE;
                $rownum++;
            }
            foreach ($row as $value) {
                $cell = $colnum . ($rownum);
                $objExcel->getActiveSheet()
                        ->setCellValueExplicit($cell, $value, \PHPExcel_Cell_DataType::TYPE_STRING);
                $colnum++;
            }
            $rownum++;
        }

        // Save Excel 2007 file
        if (is_null($fileName)) {
            $fileName = 'tmp' . microtime(true) . '.xlsx';
        } else {
            $fileName .= '.xlsx';
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');
        $objWriter->save('php://output');

        die();
    }

    private function exportToExcel_PrintHeader(\PHPExcel $objExcel, $header, $rownum) {
        if (!is_array($header)) {
            return FALSE;
        }
        $colnum = 'A';
        foreach ($header as $value) {
            $cell = $colnum . $rownum;
            $objExcel->getActiveSheet()->setCellValue($cell, $value);
            $colnum++;
        }
    }

    public function readNilai($fileUpload) {
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($fileUpload->getTempName());
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($fileUpload->getTempName());
        } catch (Exception $e) {
            $this->flash->error('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
            return;
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();

        //  Loop through each row of the worksheet in turn
        $result = array();

        $firstRow = 3;

        for ($row = 0; $row < $highestRow; $row++) {

            if ($sheet->getCell('A' . ($firstRow + $row))->getValue() == null)
                break;

            $result[$row]['KodeSiswa'] = $sheet->getCell('A' . ($firstRow + $row))->getValue();
            $result[$row]['NamaSiswa'] = $sheet->getCell('B' . ($firstRow + $row))->getValue();

            $highestCol = $sheet->getHighestDataColumn($firstRow + $row);

            for ($col = 'C'; $col <= $highestCol; $col++) {
                $temp = $sheet->getCell($col . '2')->getValue();
                $pos1 = strrpos($temp, "(");
                $pos2 = strrpos($temp, ")");
                $bidangstudi = substr($temp, $pos1 + 1, $pos2 - $pos1 - 1);
                $result[$row]['Nilai'][$bidangstudi] = $sheet->getCell($col . ($firstRow + $row))->getValue();
            }
        }

        return $result;
    }

    public function readHarga($fileUpload) {
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($fileUpload->getTempName());
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($fileUpload->getTempName());
        } catch (Exception $e) {
            $this->flash->error('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());

            return;
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();

        //  Loop through each row of the worksheet in turn
        $result = array();


        $counter = 0;

        $firstRow = 2;

        for ($row = 0; $row < $highestRow; $row++) {

            if ($sheet->getCell('A' . ($firstRow + $row))->getValue() == null)
                break;

            $result[$row]['Program'] = $sheet->getCell('A' . ($firstRow + $row))->getValue();
            $result[$row]['HargaBimbingan'] = $sheet->getCell('B' . ($firstRow + $row))->getValue();
            $result[$row]['HargaPendaftaran'] = $sheet->getCell('C' . ($firstRow + $row))->getValue();
            $result[$row]['TanggalBerlaku'] = \PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell('D' . ($firstRow + $row))->getValue(), 'YYYYMMDD');
            $result[$row]['AreaCabang'] = $sheet->getCell('E' . ($firstRow + $row))->getValue();
            $result[$row]['SektorCabang'] = $sheet->getCell('F' . ($firstRow + $row))->getValue();
        }

        return $result;
    }

    public function readEmail($fileUpload) {
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($fileUpload->getTempName());
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($fileUpload->getTempName());
        } catch (Exception $e) {
            $this->flash->error('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());

            return;
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();

        //  Loop through each row of the worksheet in turn
        $result = array();


        $counter = 0;

        $firstRow = 2;

        for ($row = 0; $row < $highestRow; $row++) {

            if ($sheet->getCell('A' . ($firstRow + $row))->getValue() == null)
                break;

            $result[$row]['NamaSiswa'] = $sheet->getCell('A' . ($firstRow + $row))->getValue();
            $result[$row]['EmailInternal'] = $sheet->getCell('B' . ($firstRow + $row))->getValue();
            $result[$row]['Password'] = $sheet->getCell('C' . ($firstRow + $row))->getValue();
            $result[$row]['NomorVa'] = $sheet->getCell('D' . ($firstRow + $row))->getValue();
        }

        return $result;
    }

}

?>