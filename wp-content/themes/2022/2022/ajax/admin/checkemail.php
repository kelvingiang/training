<?php

// include WordPress
define('WP_USE_THEMES', false);
require('../../../../../wp-load.php');

// tiep gía tri chuyen qua tu post 
$email = esc_attr($_POST['m_email']);

// dieu kien get data tu metabox == where
$arrArgs = array(
    'post_type' => 'member',
    'meta_query' => array(
        array('key' => 'm_email', 'value' => $email),
    )
);

// KIEM TRA DA LIEU USER DANG TON TAI TRONG DATABASE CHUA
$objMember = current(get_posts($arrArgs));
if ($objMember) {
    $response = array(
        'status' => 'done',
        'message' => __('該Email已註冊,請選另外一個Email'),
    );
    // TAO THEM PHAN SESION DE GIU GIATRI KHI REFRESH PAGE
    $_SESSION['checkEmail'] = '該Email已註冊,請選另外一個Email';
} else {
    $response = array(
        'status' => 'error',
        'message' => '',
    );
    unset($_SESSION['checkEmail']);
}

echo json_encode($response);
//echo $user;
?>
