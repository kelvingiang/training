<?php

define('WP_USE_THEMES', false);
require('../../../../wp-load.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');

$a_barcode = $_POST['id'];


if (!empty($a_barcode)) {
    global $wpdb;
    $table = $wpdb->prefix . 'member';
    $table2 = $wpdb->prefix . 'member_check_in';
    $sql = "SELECT * FROM $table WHERE barcode = $a_barcode";
    $row = $wpdb->get_row($sql, ARRAY_A);
    // add 11/10/2017 =======================================================================================  
    $sql2 = "SELECT time, date,  (SELECT COUNT(*) FROM $table2 WHERE member_ID =" . $row['ID'] . ") as count FROM $table2 WHERE member_ID =" . $row['ID'] . " ORDER BY time DESC LIMIT 1";
    $row2 = $wpdb->get_row($sql2, ARRAY_A);
    // end ================================================================================================      

    if (!empty($row)) {
        $data = array('check_in' => 1);
        $where = array('ID' => $row['ID']);
        $wpdb->update($table, $data, $where);

        $data2 = array(
            'member_id' => $row['ID'],
            'time' => date('H:i:s'),
            'date' => date('m-d-Y'),
        );
        $wpdb->insert($table2, $data2);
        //$_SESSION['checkinID'] = $row['ID'];
        if (!empty($row['img'])) {
            $img = "<img id='guest-pic'  name='guest-pic' src= '" . get_template_directory_uri() . '/images/member/' . $row['img'] . "'/>";
        } else {
            $img = "<img id= 'guest-pic' name = 'guest-pic' src ='" . PART_IMAGES . 'logo.png' . "'/>";
        }

        require_once DIR_CODES . 'my-list.php';
        $myList = new Codes_My_List();

        $info = array(
            'FullName' => $row['name'],
            'Country' => $myList->get_country($row['branch']),
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
