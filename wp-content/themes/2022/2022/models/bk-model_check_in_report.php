<?php

class Admin_Model_Check_In_Report_Back
{

    public function __construct()
    {
    }

    public function ReportView()
    {
        global $wpdb;
        $table = $wpdb->prefix . 'guests';
        $sql = "SELECT * FROM $table WHERE check_in = 1 AND status = 1";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    public function ReportjoinView()
    {
        global $wpdb;
        $table_guests = $wpdb->prefix . 'guests';
        $table_check = $wpdb->prefix . 'guests_check_in';
        $sql = "SELECT * FROM $table_guests AS A LEFT JOIN $table_check AS B ON A.ID = B.guests_id
                  WHERE A.status = 1 AND A.check_in =1
                  GROUP BY B.guests_id
                  ORDER BY B.time DESC";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    //^^ add new at 14/03/2018
    public function ReportBranchView()
    {
        global $wpdb;
        $table = $wpdb->prefix . 'guests';

        $sql = "SELECT country AS code, Count(country) AS register, 
            (SELECT  Count(country) FROM $table WHERE check_in = 1 AND status = 1 AND country = code) AS arrived
             FROM $table WHERE status = 1 GROUP BY country ORDER BY arrived DESC ";
        $row = $wpdb->get_results($sql, ARRAY_A);

        $newBranchitem = array();
        $newBranch = array();
        foreach ($row as $val) {
            $newBranchitem['code'] = $val['code'];
            $newBranchitem['register'] = $val['register'];
            $newBranchitem['arrived'] = $val['arrived'];
            $newBranchitem['percent'] = round($val['arrived'] / $val['register'] * 100, 2);
            $newBranch[] = $newBranchitem;
        }
        return $newBranch;
    }

    public function BarcodeInfo()
    {
        global $wpdb;
        $table = $wpdb->prefix . 'guests';
        $sql = "SELECT * FROM $table WHERE  status = 1";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    public function ReportDetailView($guests_id)
    {
        global $wpdb;
        $table = $wpdb->prefix . 'guests_check_in';
        $sql = "SELECT * FROM $table WHERE guests_id = $guests_id";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    public function ExportToExcel()
    {
        require_once DIR_CLASS . 'PHPExcel.php';
        $exExport = new PHPExcel();

        // TAO COT TITLE
        $exExport->setActiveSheetIndex(0)
            ->setCellValue('A1', '姓名')
            ->setCellValue('B1', '分會')
            ->setCellValue('C1', '職稱')
            ->setCellValue('D1', '報到時間')
            ->setCellValue('E1', '聯絡電話')
            ->setCellValue('F1', 'EMAIL')
            ->setCellValue('G1', '條碼');


        // TAO NOI DUNG CHEN TU DONG 2
        $i = 2;
        $list = $this->ReportView();
        require_once DIR_CODES . 'my-list.php';
        $myList = new Codes_My_List();

        foreach ($list as $row) {
            $checkInDetail = $this->ReportDetailView($row['ID']);
            foreach ($checkInDetail as $item) {
                $checkInItem .= $item['time'] . '__' . $item['date'] . '  ';
            }

            $exExport->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $row['full_name'])
                ->setCellValue('B' . $i, $myList->get_country($row['country']))
                ->setCellValue('C' . $i, $row['position'])
                ->setCellValue('D' . $i, $checkInItem)
                ->setCellValueExplicit('E' . $i, $row['phone'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('F' . $i, $row['email'])
                ->setCellValue('G' . $i, $row['barcode'], PHPExcel_Cell_DataType::TYPE_STRING);
            $i++;
            $checkInItem = '';
        }

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

    public function ExportBarcode()
    {
        require_once DIR_CLASS . 'PHPExcel.php';
        $exExport = new PHPExcel();

        // TAO COT TITLE
        $exExport->setActiveSheetIndex(0)
            ->setCellValue('A1', '姓名')
            ->setCellValue('B1', '職稱')
            ->setCellValue('C1', '分會')
            ->setCellValue('D1', '條碼');

        // TAO NOI DUNG CHEN TU DONG 2
        $i = 2;
        $list = $this->BarcodeInfo();
        require_once DIR_CODES . 'my-list.php';
        $myList = new Codes_My_List();
        foreach ($list as $row) {
            $checkInDetail = $this->ReportDetailView($row['ID']);
            foreach ($checkInDetail as $item) {
                $checkInItem .= $item['time'] . '__' . $item['date'] . '  ';
            }

            $exExport->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $row['full_name'])
                ->setCellValue('B' . $i, $row['position'])
                ->setCellValue('C' . $i, $myList->get_country($row['country']))
                ->setCellValueExplicit('D' . $i, $row['barcode'], PHPExcel_Cell_DataType::TYPE_STRING);
            $i++;
            $checkInItem = '';
        }
        //        echo '<pre>';
        //        print_r($list);
        //        echo '</pre>';
        //        die();
        // TAO FILE EXCEL VA SAVE LAI THEO PATH
        //$objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        //$full_path = EXPORT_DIR . date("YmdHis") . '_report.xlsx'; //duong dan file
        //$objWriter->save($full_path);
        // TAO FILE EXCEL VA DOWN TRUC TIEP XUONG CLINET
        $filename = date("YmdHis") . '_barcode.xlsx';
        $objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');
        ob_end_clean();
        //        ob_start();
        $objWriter->save('php://output');
    }

    public function ExportMember()
    {
        require_once DIR_CLASS . 'PHPExcel.php';
        $exExport = new PHPExcel();

        // TAO COT TITLE
        $exExport->setActiveSheetIndex(0)
            ->setCellValue('A1', '姓名')
            ->setCellValue('B1', '公司')
            ->setCellValue('C1', '職稱')
            ->setCellValue('D1', 'Email')
            ->setCellValue('E1', '電話');

        // TAO NOI DUNG CHEN TU DONG 2
        $i = 2;
        $arr = array(
            'post_type' => 'member',
            'posts_per_page' => -1,
            'orderby' => 'ID',
            'order' => 'ASC',
        );

        $my_query = new WP_Query($arr);
        //    echo '<pre>';
        //    print_r($my_query);
        //    echo '</pre>';
        //    die();

        if ($my_query->have_posts()) {
            while ($my_query->have_posts()) {
                $my_query->the_post();
                //    echo get_the_ID();
                // echo  get_post_meta(get_the_ID(),'m_fullname', TRUE);
                //die();
                $exExport->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, get_post_meta(get_the_ID(), 'm_fullname', TRUE))
                    ->setCellValue('B' . $i, get_post_meta(get_the_ID(), 'm_company', TRUE))
                    ->setCellValue('C' . $i, get_post_meta(get_the_ID(), 'm_position', True))
                    ->setCellValue('D' . $i, get_post_meta(get_the_ID(), 'm_email', True))
                    ->setCellValueExplicit('E' . $i, get_post_meta(get_the_ID(), 'm_phone', True), PHPExcel_Cell_DataType::TYPE_STRING);
                $i++;
            }
            wp_reset_postdata();
            wp_reset_query();
        }
        //        echo '<pre>';
        //        print_r($list);
        //        echo '</pre>';
        //        die();
        // TAO FILE EXCEL VA SAVE LAI THEO PATH
        //$objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        //$full_path = EXPORT_DIR . date("YmdHis") . '_report.xlsx'; //duong dan file
        //$objWriter->save($full_path);
        // TAO FILE EXCEL VA DOWN TRUC TIEP XUONG CLINET
        $filename = date("YmdHis") . '_member.xlsx';
        $objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');
        ob_end_clean();
        //        ob_start();
        $objWriter->save('php://output');
    }

    public function BatchCreateQRCode()
    {
        global $wpdb;
        $table = $wpdb->prefix . 'guests';
        $sql = "SELECT barcode FROM $table";
        $row = $wpdb->get_results($sql, ARRAY_A);

        require_once(DIR_CLASS . 'qrcode' . DS . 'qrlib.php');
        foreach ($row as $item) {
            $filename = DIR_IMAGES_BARCODE . $item['barcode'] . '.png';
            $errorCorrectionLevel = "L";
            $matrixPointSize = 10;
            QRcode::png($item['barcode'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);
        }
        //$this->createQRcode($arrData['sel_country']);
    }

    public function ResetCheckIn()
    {
        global $wpdb;
        $table = $wpdb->prefix . 'guests';
        $table2 = $wpdb->prefix . 'guests_check_in';
        //RESET ALL CHECK 
        $updateSql = "UPDATE $table SET check_in=0 WHERE 1=1";
        $wpdb->query($updateSql);
        // XOA GUESTS CHECK IN
        $deleteSql = "DELETE FROM $table2";
        $wpdb->query($deleteSql);
        // TRA ID LAI MUT BAT DAU BAT DAU BANG 1
        $sql = "ALTER TABLE $table2 AUTO_INCREMENT = 1";
        $wpdb->query($sql);
    }
}
