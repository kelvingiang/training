<?php

// include WordPress
define('WP_USE_THEMES', false);
require('../../../../../wp-load.php');

// tiep gía tri chuyen qua tu post 
$user = esc_attr($_POST['m_user']);

// dieu kien get data tu metabox == where
$arrArgs = array(
    'post_type' => 'member',
    'meta_query' => array(
        array('key' => 'm_user', 'value' => $user),
    )
);

// KIEM TRA DA LIEU USER DANG TON TAI TRONG DATABASE CHUA
$objMember = current(get_posts($arrArgs));
if ($objMember) {
    $response = array(
        'status' => 'done',
        'message' => __('帳號名稱已註冊,請選另外一個帳號名稱'),
    );
// TAO THEM PHAN SESION DE GIU GIATRI KHI REFRESH PAGE
    $_SESSION['checkUser'] = '帳號名稱已註冊,請選另外一個帳號名稱';
} else {
    $response = array(
        'status' => 'error',
        'message' => '',
    );
    unset($_SESSION['checkUser']);
}

echo json_encode($response);
?>
