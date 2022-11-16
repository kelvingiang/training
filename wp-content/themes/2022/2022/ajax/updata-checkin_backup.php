<?php

define('WP_USE_THEMES', false);
require('../../../../wp-load.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');

$a_barcode = $_POST['id'];

if (!empty($a_barcode)) {
    global $wpdb;
    $table   = $wpdb->prefix . 'guests';
    $table2 = $wpdb->prefix . 'guests_check_in';
    $table3 = $wpdb->prefix . 'member';

    //---------------------------------------------------------------------------------------------
    // LAY THONG TRONG TABLE guests
    //---------------------------------------------------------------------------------------------
    $sql = "SELECT * FROM $table WHERE barcode = $a_barcode";
    $row = $wpdb->get_row($sql, ARRAY_A);

    // add 11/10/2017 lay thong check in =======================================================================================  
    $sql2 = "SELECT time, date,  (SELECT COUNT(*) FROM $table2 WHERE guests_id =" . $row['ID'] . ") as count FROM $table2 WHERE guests_id =" . $row['ID'] . " ORDER BY time DESC LIMIT 1";
    $row2 = $wpdb->get_row($sql2, ARRAY_A);
    // end ================================================================================================      

    //---------------------------------------------------------------------------------------------
    // lay thong trong table member
    //---------------------------------------------------------------------------------------------
    $sql3 = "SELECT * FROM $table3 WHERE barcode = $a_barcode";
    $row3 = $wpdb->get_row($sql3, ARRAY_A);








    if (!empty($row)) {
        $data = array('check_in' => 1);
        $where = array('ID' => $row['ID']);
        $wpdb->update($table, $data, $where);

        $data2 = array(
            'guests_id' => $row['ID'],
            'time' => date('H:i:s'),
            'date' => date('m-d-Y'),
        );
        $wpdb->insert($table2, $data2);
        //$_SESSION['checkinID'] = $row['ID'];
        if (!empty($row['img'])) {
            $img = "<img id='guest-pic'  name='guest-pic' src= '" . get_guests_img($row['img']) . "'/>";
        } else {
            $img = "<img id= 'guest-pic' name = 'guest-pic' src ='" . PART_IMAGES . 'logo.png' . "'/>";
        }

        $info = array(
            'FullName' => $row['full_name'],
            'Country' => get_country($row['country']),
            'Position' => $row['position'],
            'Email' => $row['email'],
            'Phone' => $row['phone'],
            'Note' => $row['note'],
            'Img' => $img,
            'TotalTimes' => $row2['count'],
            'LastCheckIn' => $row2['date'] . ' / ' . $row2['time']
        );


        $response = array('status' => 'done', 'message' => $row['ID'], 'info' => $info);
    } else {
        // $_SESSION['checkinID'] = '0000';
        $response = array('status' => 'error', 'message' => '0000');
    }
}
echo json_encode($response);