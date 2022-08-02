<?php

class Check_In_Report_Model {
    public $guests_table;
    public $check_table;
    
    public function __construct() {
        global $wpdb;
        $this->guests_table = $wpdb->prefix . 'guests';
        $this->check_table =  $wpdb->prefix . 'guests_check_in';
    }
    
    public function AttendList(){
          global $wpdb;
        $sql = "SELECT * FROM $this->guests_table WHERE check_in = 1 AND trash = 1";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    public function AttendCount() {
        return count($this->AttendList());
    }

    public function RegisterCount() {
         global $wpdb;
        $sql = "SELECT COUNT(ID) FROM $this->guests_table WHERE trash = 1";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row[0]['COUNT(ID)'];
    }
    
    public function CheckInList() {
        global $wpdb;
        $sql = "SELECT a.ID, a.serial, a.name, a.company, a.phone, a.mobile, a.address, a.code, a.email, b.time, b.date "
                . "FROM $this->guests_table AS A LEFT JOIN $this->check_table AS B ON A.ID = B.guests_id
                  WHERE A.trash = 1 AND A.check_in =1
                  GROUP BY B.guests_id
                  ORDER BY B.time DESC";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }
    
    public function ExportCheckIn(){
         require_once DIR_CLASS . 'PHPExcel.php';
        $exExport = new PHPExcel();
                
        // TAO COT TITLE
        $exExport->setActiveSheetIndex(0);
        $sheet = $exExport->getActiveSheet()->setTitle("check in");
        $sheet->setCellValue('A1', __('Serial'));
        $sheet->setCellValue('B1', __('Name'));
        $sheet->setCellValue('C1', __('Check In Time'));
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
                    ->setCellValue('B' . $i, $row['name'])
                    ->setCellValue('C' . $i, $row['time'] . ' -- ' .$row['date'] )
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
          $sheet->getStyle('A1:'.'G'.($i-1))->applyFromArray($styleArray);     
        //   chi dong title
        //$sheet->getStyle('A1:' . 'G1')->applyFromArray($styleArray);

        // TAO FILE EXCEL VA SAVE LAI THEO PATH
        //$objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        //$full_path = EXPORT_DIR . date("YmdHis") . '_report.xlsx'; //duong dan file
        //$objWriter->save($full_path);
        
// TAO FILE EXCEL VA DOWN TRUC TIEP XUONG CLINET
        $filename = 'ctcvn_checkin_' . date("ymdHis") . '.xlsx';
        $objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');
        ob_end_clean();
//        ob_start();
        $objWriter->save('php://output');
        
    }

}
