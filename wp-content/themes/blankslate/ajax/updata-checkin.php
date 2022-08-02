<?php

define('WP_USE_THEMES', false);
require('../../../../wp-load.php' );
date_default_timezone_set('Asia/Ho_Chi_Minh');

$a_barcode = $_POST['id'];

if (!empty($a_barcode)) {
    global $wpdb;
    $table = $wpdb->prefix . 'guests';
    $table2 = $wpdb->prefix . 'guests_check_in';


    $sqlGuests = "SELECT * FROM $table WHERE code = '$a_barcode' ";
    $row = $wpdb->get_row($sqlGuests, ARRAY_A);

    if (!empty($row) && $row['trash'] == 1) {
        

        // add 11/10/2017 KIEM TRA SO LAN CHECK IN =======================================================================================  
        $sql2 = "SELECT time, date,  (SELECT COUNT(*) FROM $table2 WHERE guests_id =" . $row['ID'] . ") as count FROM $table2 WHERE guests_id =" . $row['ID'] . " ORDER BY time DESC LIMIT 1";
        $row2 = $wpdb->get_row($sql2, ARRAY_A);
 
        // end ================================================================================================    
        // UPDATE TABLE guests CHECK_IN 
        $data = array('check_in' => 1);
        $where = array('ID' => $row['ID']);
        $wpdb->update($table, $data, $where);

        // ADD ROW CHECK IN INFO VAO TABLE  guests_check_in
        $data2 = array(
            'guests_id' => $row['ID'],
         //   'barcode' => $a_barcode,
            'time' => date('H:i:s'),
            'date' => date('m-d-Y'),
                // 'kind' => $row['kind'],
        );
        $wpdb->insert($table2, $data2);
       
        // add 11/10/2017 GIA TRI TRA VE =======================================================================================                         
        // LAY HINH ANH DAI DIEN
        if (!empty($row['img'])) {
            $img = "<img id='guest-pic'  name='guest-pic' src= '" . get_guests_img($row['img']) . "'/>";
        } else {
            $img = "<img id= 'guest-pic' name = 'guest-pic' src ='" . get_image('logo.png') . "'/>";
        }

        $info = array(
            'FullName' => $row['name'],
            'Position' => $row['position'],
            'Company' => $row['company'],
            'Email' => $row['email'],
            'Phone' => $row['phone'],
            'Note' => $row['note'],
            'Img' => $img,
            'TotalTimes' => $row2['count'] + 1,
            'LastCheckIn' => $row2['date'] . ' / ' . $row2['time']
        );
        $response = array('status' => 'done', 'message' => $row['ID'], 'info' => $info);

        // end ================================================================================================     
    } elseif (!empty($row) && $row['trash'] == 0) {
        $response = array('status' => 'unactive', 'message' => 'chua kich hoat tai khoan');
    } else {
        $response = array('status' => 'error', 'message' => '0000');
    }

    echo json_encode($response);
}





