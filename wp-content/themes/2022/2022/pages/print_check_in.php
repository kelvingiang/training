<?php
/*
 * Template Name: Page Print Check in
 */
require_once(DIR_MODEL . 'model_check_in_report.php');
$model = new Admin_Model_Check_In_Report();
//$checkInList = $model->ReportView();
$checkInList = $model->AttenDetail();
// echo "<pre>";
// print_r($checkInList);
// echo "</pre>";
// die();
?>

<html>

<head>
    <meta name="description" content="Học web chuẩn" />
    <meta name="keywords" content="HTML,CSS,XML,JavaScript" />
    <meta name="author" content="DuongHC" />
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <style type='text/css'>
        /* khong in url va ngay trang tren trang in*/
        @page {
            size: auto;
            margin: 0mm;
        }

        #print_report {
            cursor: pointer;
            background-color: #008EC2;
            position: absolute;
            padding: 7px 20px;
            margin-top: 0px;
            border-radius: 5px;
            color: white;
            font-size: 13px;
            right: 20px;
            top: 20px;
        }

        #print_report:hover {
            background-color: #0075A0;
            color: #d7d7d7;
        }

        .lbl_3 {
            float: left;
            width: 10%;
            text-align: center;
        }
    </style>
    <script src="<?php echo get_template_directory_uri() . '/js/jquery-1.11.3.min.js'; ?>" type="text/javascript">
    </script>
</head>

<body style="padding-left: 8px">
    <div>
        <h4> 來 賓 出 席 總 數 : <?php echo count($checkInList) ?> 位 </h4>
        <h3 id="print_report">列 印</h3>
    </div>
    <div>
        <table cellpadding="0" Cellspacing='0' style='width: 700px; margin-top: 20px; border-left: 1px solid #000; border-right:  1px solid #666 '>
            <tr style=' background-color: #2b95fd; color: white; height: 50px; font-size: 15px'>
                <th style=' border-right:  1px #fff solid ; border-bottom:  2px #000 solid; width: 20px'></th>
                <th style=' border-right:  1px #fff solid; border-bottom:  2px #000 solid;width: 80px'>
                    <?php _e('Full Name'); ?></th>
                <th style=' border-right: 1px #fff solid; border-bottom:  2px #000 solid; width: 70px'>
                    <?php _e('Brach') ?></th>
                <th style=' border-right: 1px #fff solid; border-bottom:  2px #000 solid; width: 80px'>
                    <?php _e('Asia Position'); ?></th>
                <th style=' border-right: 1px #fff solid; border-bottom:  2px #000 solid; width: 120px '>報到時間</th>

                <!--<th style=' border-right: 1px white solid'><?php _e('Career') ?></th>-->
                <th style=' border-right: 1px #000 solid; border-bottom:  2px #000 solid; width: 100px'>
                    <?php _e('Phone') ?></th>
                <!--<th><?php _e('Email') ?></th>-->
            </tr>

            <?php
            require_once DIR_CODES . 'my-list.php';
            $myList = new Codes_My_List();
            $stt = 1;
            foreach ($checkInList as $key => $val) {
            ?>
                <tr style='height: 40px; border-bottom:  #666 solid 1px; font-size: 15px;'>
                    <td style='border-bottom:  #666  dotted 1px; text-align: center'> <?php echo $stt; ?></td>
                    <td style='border-bottom:  #666  dotted 1px; padding-left: 5px'> <?php echo $val[0]['Name']; ?></td>
                    <td style='border-bottom:  #666 dotted 1px'> <?php echo $myList->get_country($val[0]['Country']) ?></td>
                    <td style='border-bottom:  #666 dotted 1px'> <?php echo $val[0]['Position']; ?></td>
                    <td style='border-bottom:  #666 dotted 1px'> <?php echo $val[1]['Time'] . ' -- ' . $val[1]['Date']; ?>
                    </td>
                    <td style='border-bottom:  #666 dotted 1px'> <?php echo $val[0]['Phone']; ?></td>
                </tr>
            <?php
                $stt++;
            }
            ?>

        </table>

    </div>
</body>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#print_report').click(function() {
            jQuery(this).hide();
            window.print();
            jQuery(this).show();
        });
    });
</script>

</html>