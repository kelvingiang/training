<?php

// include WordPress
define('WP_USE_THEMES', false);
require('../../../../../wp-load.php');

// tiep gía tri chuyen qua tu post 
//$email = esc_attr($_POST['m_email']);

// dieu kien get data tu metabox == where
$arrArgs = array(
    'post_type' => 'event',
    'meta_query' => array(
        array('key' => 'e_join', 'value' => 'on'),
    )
);

// KIEM TRA DA LIEU USER DANG TON TAI TRONG DATABASE CHUA
$objEvent = current(get_posts($arrArgs));
if ($objEvent) {
    $response = array(
        'status' => 'done',
        'message' => __('已有另一個活動使用此功能, 先把它停用 ! '),
    );
    // TAO THEM PHAN SESION DE GIU GIATRI KHI REFRESH PAGE
    //$_SESSION['checkEmail'] = '該Email已註冊,請選另外一個Email';
} else {
    $response = array(
        'status' => 'error',
        'message' => '',
    );
   // unset($_SESSION['checkEmail']);
}

echo json_encode($response);
//echo $user;
?>
