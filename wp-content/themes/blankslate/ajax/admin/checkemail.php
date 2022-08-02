<?php

// include WordPress
define('WP_USE_THEMES', false);
require('../../../../../wp-load.php');


// tiep gía tri chuyen qua tu post 
$serial = $_POST['txt-serial'];
if (!empty($serial)) {
    
    global $wpdb;
    $table = $wpdb->prefix . 'member';

    $sqlSerail = "SELECT serial FROM $table WHERE serial = $serial";
    $val = $wpdb->get_row($sqlSerail, ARRAY_A);
  // $response = $val;
    if (!empty($val)) {
        $response = array(
            'status' => 'error',
            'message' => __('The serial number already exists'),
        );
    } else {
           $response = array(
            'status' => 'done',
            'message' => '',
        );
    }
}
echo json_encode($response);
