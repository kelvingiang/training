<?php

class Check_In_Setting_Model {

    public $guests_table;
    public $check_table;
    public $member_table;

    public function __construct() {
        global $wpdb;
        $this->guests_table = $wpdb->prefix . 'guests';
        $this->check_table = $wpdb->prefix . 'guests_check_in';
        $this->member_table = $wpdb->prefix . 'member';
    }

//======= GET DATA FORM DATABASE =======================================
    public function AttendList() {
        global $wpdb;
        $sql = "SELECT * FROM $this->guests_table WHERE check_in = 1 AND trash = 1";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    public function RegisterList() {
        global $wpdb;
        $sql = "SELECT * FROM $this->guests_table WHERE trash = 1";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    public function CheckInList() {
        global $wpdb;
        $sql = "SELECT a.ID, a.serial, a.name, a.company, a.phone, a.mobile, a.address, a.code, a.email, b.time, b.date FROM $this->guests_table AS A LEFT JOIN $this->check_table AS B ON A.ID = B.guests_id
                  WHERE A.trash = 1 AND A.check_in =1
                  GROUP BY B.guests_id
                  ORDER BY B.time DESC";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    public function MemberList() {
        global $wpdb;
        $sql = "SELECT * FROM $this->member_table";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

//====== ORTHER FUNCTION ================================================ 

    public function AttendCount() {
        return count($this->AttendList());
    }

    public function RegisterCount() {
        return count($this->RegisterList());
    }

// ======= EXPORT DATA ===================================================
    public function ExportCheckIn() {
        require_once DIR_CLASS . 'PHPExcel.php';
        $exExport = new PHPExcel();

        // TAO COT TITLE
        $exExport->setActiveSheetIndex(0);
        $sheet = $exExport->getActiveSheet()->setTitle("check in");
        $sheet->setCellValue('A1', __('Serial'));
        $sheet->setCellValue('B1', __('Check In Time'));
        $sheet->setCellValue('C1', __('Name'));
        $sheet->setCellValue('D1', __('Company Name'));
        $sheet->setCellValue('E1', __('Email'));
        $sheet->setCellValue('F1', __('Mobile'));
        $sheet->setCellValue('G1', __('Phone'));
        // set do rong cua cot
        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setWidth(35);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        // set chieu cao cua dong
        $sheet->getRowDimension('1')->setRowHeight(30);
        // set to dam chu
        $sheet->getStyle('A')->getFont()->setBold(TRUE);
        $sheet->getStyle('A1:G1')->getFont()->setBold(TRUE);
        // set nen backgroup cho dong
        $sheet->getStyle('A1:G1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('0008bdf8');
        // set chu canh giua
        $sheet->getStyle('A1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:G1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $i = 2;

        //---------------------------------------------------------------------------------------------
// PHAN LAY CHICK IN 2 TABLE GUESTS VA MEMBER NHU CHI LAY 1 DONG TRONG BANG CHECK IN
//---------------------------------------------------------------------------------------------

        foreach ($this->CheckInList() as $row) {
            $exExport->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $row['serial'])
                    ->setCellValue('B' . $i, $row['time'] . ' -- ' . $row['date'])
                    ->setCellValue('C' . $i, $row['name'])
                    ->setCellValue('D' . $i, $row['company'])
                    ->setCellValue('E' . $i, $row['email'])
                    ->setCellValueExplicit('F' . $i, $row['mobile'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('G' . $i, $row['phone'], PHPExcel_Cell_DataType::TYPE_STRING);
            $i++;
        }
        // phan set border 
        $styleArray = array('borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        //cho tat ca 
        $sheet->getStyle('A1:' . 'G' . ($i - 1))->applyFromArray($styleArray);
        //   chi dong title
        //$sheet->getStyle('A1:' . 'G1')->applyFromArray($styleArray);
        // TAO FILE EXCEL VA SAVE LAI THEO PATH
        //$objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        //$full_path = EXPORT_DIR . date("YmdHis") . '_report.xlsx'; //duong dan file
        //$objWriter->save($full_path);
// TAO FILE EXCEL VA DOWN TRUC TIEP XUONG CLINET
        $filename = 'ctcdn_checkin_' . date("ymdHis") . '.xlsx';
        $objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');
        ob_end_clean();
//        ob_start();
        $objWriter->save('php://output');
    }

    public function ExportMettingMember() {
        require_once DIR_CLASS . 'PHPExcel.php';
        $exExport = new PHPExcel();

        // TAO COT TITLE
        $exExport->setActiveSheetIndex(0);
        $sheet = $exExport->getActiveSheet()->setTitle("member");
        $sheet->setCellValue('A1', __('Serial'));
        $sheet->setCellValue('B1', __('Name'));
        $sheet->setCellValue('C1', __('Regency'));
        $sheet->setCellValue('D1', __('Company Name'));
        $sheet->setCellValue('E1', __('Address'));
        $sheet->setCellValue('F1', __('Mobile'));
        $sheet->setCellValue('G1', __('Phone'));
        $sheet->setCellValue('H1', __('Fax'));
        $sheet->setCellValue('I1', __('Email'));
        $sheet->setCellValue('J1', __('Web Site'));
        $sheet->setCellValue('K1', __('Note'));
        // set do rong cua cot
        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setWidth(100);
        $sheet->getColumnDimension('F')->setWidth(35);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        // set chieu cao cua dong
        $sheet->getRowDimension('1')->setRowHeight(30);
        // set to dam chu
        $sheet->getStyle('A')->getFont()->setBold(TRUE);
        $sheet->getStyle('A1:K1')->getFont()->setBold(TRUE);
        // set nen backgroup cho dong
        $sheet->getStyle('A1:K1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('0008bdf8');
        // set chu canh giua
        $sheet->getStyle('A1:K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:K1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $i = 2;

        //---------------------------------------------------------------------------------------------
// PHAN LAY CHICK IN 2 TABLE GUESTS VA MEMBER NHU CHI LAY 1 DONG TRONG BANG CHECK IN
//---------------------------------------------------------------------------------------------

        foreach ($this->RegisterList() as $row) {

            $exExport->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $row['serial'])
                    ->setCellValue('B' . $i, $row['name'])
                    ->setCellValue('C' . $i, $row['position'])
                    ->setCellValue('D' . $i, $row['company'])
                    ->setCellValue('E' . $i, $row['address'])
                    ->setCellValueExplicit('F' . $i, $row['mobile'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('G' . $i, $row['phone'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('H' . $i, $row['fax'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('I' . $i, $row['email'])
                    ->setCellValue('J' . $i, $row['website'])
                    ->setCellValue('K' . $i, $row['note']);
            $i++;
        }
        // phan set border 
        $styleArray = array('borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        //cho tat ca 
        $sheet->getStyle('A1:' . 'K' . ($i - 1))->applyFromArray($styleArray);
        //   chi dong title
        //$sheet->getStyle('A1:' . 'G1')->applyFromArray($styleArray);
        // TAO FILE EXCEL VA SAVE LAI THEO PATH
        //$objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        //$full_path = EXPORT_DIR . date("YmdHis") . '_report.xlsx'; //duong dan file
        //$objWriter->save($full_path);
// TAO FILE EXCEL VA DOWN TRUC TIEP XUONG CLINET
        $filename = 'ctcdn_meeting_' . date("ymdHis") . '.xlsx';
        $objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');
        ob_end_clean();
//        ob_start();
        $objWriter->save('php://output');
    }

    public function ExportMember() {
        require_once DIR_CLASS . 'PHPExcel.php';
        $exExport = new PHPExcel();

        // TAO COT TITLE
        $exExport->setActiveSheetIndex(0);
        $sheet = $exExport->getActiveSheet()->setTitle("member");
        $sheet->setCellValue('A1', __('Serial'));
        $sheet->setCellValue('B1', __('Name'));
        $sheet->setCellValue('C1', __('Regency'));
        $sheet->setCellValue('D1', __('Company Name Chinese'));
        $sheet->setCellValue('E1', __('Company Name Vietnam'));
        $sheet->setCellValue('F1', __('Address Chinese'));
        $sheet->setCellValue('G1', __('Address Vietnam'));
        $sheet->setCellValue('H1', __('Mobile'));
        $sheet->setCellValue('I1', __('Phone'));
        $sheet->setCellValue('J1', __('Fax'));
        $sheet->setCellValue('K1', __('Email'));
        $sheet->setCellValue('L1', __('Web Site'));
        $sheet->setCellValue('M1', __('Service List'));
        $sheet->setCellValue('N1', __('Industry'));
        // set do rong cua cot
        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setWidth(100);
        $sheet->getColumnDimension('F')->setWidth(35);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('N')->setAutoSize(true);
        // set chieu cao cua dong
        $sheet->getRowDimension('1')->setRowHeight(30);
        // set to dam chu
        $sheet->getStyle('A')->getFont()->setBold(TRUE);
        $sheet->getStyle('A1:N1')->getFont()->setBold(TRUE);
        // set nen backgroup cho dong
        $sheet->getStyle('A1:N1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('0008bdf8');
        // set chu canh giua
        $sheet->getStyle('A1:N1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:N1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $i = 2;

        //---------------------------------------------------------------------------------------------
// PHAN LAY CHICK IN 2 TABLE GUESTS VA MEMBER NHU CHI LAY 1 DONG TRONG BANG CHECK IN
//---------------------------------------------------------------------------------------------

        foreach ($this->MemberList() as $row) {

            $exExport->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $row['serial'])
                    ->setCellValue('B' . $i, $row['contact'])
                    ->setCellValue('C' . $i, $row['position'])
                    ->setCellValue('D' . $i, $row['company_cn'])
                    ->setCellValue('E' . $i, $row['company_vn'])
                    ->setCellValue('F' . $i, $row['address_cn'])
                    ->setCellValue('G' . $i, $row['address_vn'])
                    ->setCellValueExplicit('H' . $i, $row['mobile'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('I' . $i, $row['phone'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('J' . $i, $row['fax'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('K' . $i, $row['email'])
                    ->setCellValue('L' . $i, $row['website'])
                    ->setCellValue('M' . $i, $row['service'])
                    ->setCellValue('N' . $i, $row['industry']);
            $i++;
        }
        // phan set border 
        $styleArray = array('borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        //cho tat ca 
        $sheet->getStyle('A1:' . 'N' . ($i - 1))->applyFromArray($styleArray);
        //   chi dong title
        //$sheet->getStyle('A1:' . 'G1')->applyFromArray($styleArray);
        // TAO FILE EXCEL VA SAVE LAI THEO PATH
        //$objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        //$full_path = EXPORT_DIR . date("YmdHis") . '_report.xlsx'; //duong dan file
        //$objWriter->save($full_path);
// TAO FILE EXCEL VA DOWN TRUC TIEP XUONG CLINET
        $filename = 'ctcdn_member_' . date("ymdHis") . '.xlsx';
        $objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');
        ob_end_clean();
//        ob_start();
        $objWriter->save('php://output');
    }

//======== IMPORT DATA=====================================================
    public function ImportMember($filename) {
        require_once DIR_CLASS . 'PHPExcel.php';
        $inputFileType = PHPExcel_IOFactory::identify($filename);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

        $objReader->setReadDataOnly(true);

        /**  Load $inputFileName to a PHPExcel Object  * */
        $objPHPExcel = $objReader->load("$filename");

        $total_sheets = $objPHPExcel->getSheetCount();

        $allSheetName = $objPHPExcel->getSheetNames();
        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $arraydata = array();
        for ($row = 2; $row <= $highestRow; ++$row) {
            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                $value = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                $arraydata[$row - 2][$col] = $value;
            }
        }
        global $wpdb;
        $table = $wpdb->prefix . 'member';
        
        foreach ($arraydata as $item) {
            $createDate = date('d-m-Y');
            $data = array(
                'serial' => $item[1],
                'company_cn' =>  $item[2] == null ? " ":trim($item[2]),
                'company_vn' => $item[3]== null ? " ":trim($item[3]),
                'address_cn' => $item[4]== null ? " ":trim($item[4]),
                'address_vn' => $item[5]== null ? " ":trim($item[5]),
                'contact' => $item[6]== null ? " ":trim($item[6]),
                'position' => $item[7]== null ? " ":trim($item[7]),
                'mobile' => $item[8]== null ? " ":trim($item[8]),
                'phone' => $item[9]== null ? " ":trim($item[9]),
                'fax' => $item[10]== null ? " ":trim($item[10]),
                'email' => $item[11]== null ? " ":trim($item[11]),
                'service' => $item[12]== null ? " ":trim($item[12]),
                'region' => $item[13]== null ? " ":trim($item[13]),
                'industry' => $item[14]== null ? " ":trim($item[14]),
                'trash' => 1,
                'create_date' => $createDate,
            );
            $wpdb->insert($table, $data);
        }
    }

    public function ImportMeetingMember($filename) {
        require_once DIR_CLASS . 'PHPExcel.php';
        $inputFileType = PHPExcel_IOFactory::identify($filename);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

        $objReader->setReadDataOnly(true);

        /**  Load $inputFileName to a PHPExcel Object  * */
        $objPHPExcel = $objReader->load("$filename");

        $total_sheets = $objPHPExcel->getSheetCount();

        $allSheetName = $objPHPExcel->getSheetNames();
        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $arraydata = array();
        for ($row = 2; $row <= $highestRow; ++$row) {
            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                $value = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                $arraydata[$row - 2][$col] = $value;
            }
        }
   // XOA CAC FILE CU TRONG THU MUC
        $files = glob(rtrim(DIR_IMAGE_QRCODE . '*.png')); //get all file names
        foreach ($files as $file) {
                unlink($file); //delete file
        }
        
        global $wpdb;
        
            // XOA DATA TRONG TABLE GUESTS 
        $deleteSql = "DELETE FROM $this->guests_table";
        $wpdb->query($deleteSql);
        // TRA ID LAI MUT BAT DAU BAT DAU BANG 1
        $sql = "ALTER TABLE $this->guests_table AUTO_INCREMENT = 1";
        $wpdb->query($sql);
        
              // XOA DATA TRONG TABLE GUESTS CHECK IN
        $deleteSqlcheckin = "DELETE FROM $this->check_table";
        $wpdb->query($deleteSqlcheckin);
        // TRA ID LAI MUT BAT DAU BAT DAU BANG 1
        $sqlcheckin = "ALTER TABLE $this->check_table AUTO_INCREMENT = 1";
        $wpdb->query($sqlcheckin);
        
        
        foreach ($arraydata as $item) {
            if(empty($item[1])){
                break;
            }
            $code = trim($item[1]) . createRandom(6); 
            $createDate = date('d-m-Y');
            $data = array(
                'code' => $code,
                'serial' => $item[1] == "" ? "" : trim($item[1]),
                'company' => $item[2] == "" ? "" : trim($item[2]),
                'address' => $item[3] == "" ? "" : trim($item[3]),
                'name' => $item[4] == "" ? "" : trim($item[4]),
                'position' => $item[5] == "" ? "" : trim($item[5]),
                'mobile' => $item[6] == "" ? "" : trim($item[6]),
                'phone' => $item[7] == "" ? "" : trim($item[7]),
                'fax' => $item[8] == "" ? "" : trim($item[8]),
                'email' => $item[9] == "" ? "" : trim($item[9]),
                'note' => $item[10] == "" ? "" : trim($item[10]),
                'trash' => 1,
                'create_date' => $createDate,
            );
          
           $wpdb->insert($this->guests_table, $data);
            // tao file qrcode;
          createQRcode($code);
        }
    }

    //=========RESET AND CREATE ===============================================
    public function ResetCheckIn() {
        global $wpdb;
        //RESET ALL CHECK 
        $updateSql = "UPDATE $this->guests_table SET check_in=0 WHERE 1=1";
        $wpdb->query($updateSql);

        // XOA GUESTS CHECK IN
        $deleteSql = "DELETE FROM $this->check_table";
        $wpdb->query($deleteSql);
        // TRA ID LAI MUT BAT DAU BAT DAU BANG 1
        $sql = "ALTER TABLE $this->check_table AUTO_INCREMENT = 1";
        $wpdb->query($sql);
    }

    public function CreateQRCodeHaveName() {
          global $wpdb;
   // xoa cac file cu
        $files = glob(rtrim(DIR_IMAGE_QRCODE_NAME . '*.png')); //get all file names
        foreach ($files as $file) {
                unlink($file); //delete file
        }
   //  copy tat ca file trong thu muc barcode den thu muc name_barcode  
        $copyfiles = glob(trim(DIR_IMAGE_QRCODE . '*.png')); //get all file names
        foreach ($copyfiles as $item) {
            if (is_file($item)) {
               $ff = explode(DS, $item);
               $lastItem = end($ff); // lay phan tu cuoi cung trong array
               $newfile = DIR_IMAGE_QRCODE_NAME . $lastItem;
               copy($item, $newfile); // chuyen sang folden moi;
            }
        }
 // doi ten them ten thanh vien vao ten file
        $sql = "SELECT name, code FROM $this->guests_table";
        $rows = $wpdb->get_results($sql, ARRAY_A);
        foreach ($rows as $row) {
            // DOI TEN FILE THEO KIEU CHU HOA
            $oldName = DIR_IMAGE_QRCODE_NAME . $row['code'] . '.png';
            $name = iconv('UTF-8', 'BIG5', DIR_IMAGE_QRCODE_NAME . $row['name'] . '-' . $row['code'] . '.png');
            $newName = str_replace(" ", "", $name);
            rename($oldName, $newName);
        }
        
    }

}
