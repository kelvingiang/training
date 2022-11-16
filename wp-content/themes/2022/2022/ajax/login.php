<?php

// include WordPress
define('WP_USE_THEMES', false);
require('../../../../wp-load.php');

// tiep gía tri chuyen qua tu post 
$user = esc_attr($_POST['l_user']);
$pass = md5(esc_attr($_POST['l_pass']));
//$pass = md5($_POST['l_pass']);
//$save = $_POST['l_cookie'];
// dieu kien get data tu metabox == where
$arrArgs = array(
    'post_type' => 'member',
    'meta_query' => array(
        array('key' => 'm_user', 'value' => $user),
        array('key' => 'm_password', 'value' => $pass),
        array('key' => 'm_active', 'value' => 'on')
    )
);

$arrArgsName = array(
    'post_type' => 'member',
    'meta_query' => array(
        array('key' => 'm_fullname', 'value' => $user),
        array('key' => 'm_password', 'value' => $pass),
        array('key' => 'm_active', 'value' => 'on')
    )
);
// kiem tra du leiu co trung hop khong
$objMember = current(get_posts($arrArgs));
$objName = current(get_posts($arrArgsName));
if ($objMember || $objName) {
    if ($objMember) {
        $getMeta = get_post_meta($objMember->ID); // lay gia tri tu metabox 
    } else {
        $getMeta = get_post_meta($objName->ID); // lay gia tri tu metabox   
    }
    $_SESSION['login_id'] = $objMember->ID;
    $_SESSION['login'] = $getMeta['m_user'][0];    //  lay user trong metabox ra de tao gia tri cho session
    $_SESSION['login_type'] = $getMeta['m_member'][0];
    $_SESSION['email'] = $getMeta['m_email'][0];

    if ($getMeta['m_member'][0] == "apply") {
        $site = "recruiter";
    } elseif ($getMeta['m_member'][0] == "recruit" || $getMeta['m_member'][0] == "on") {
        $site = "recruitments";
    }
    $response = array(
        'status' => 'done',
        'site' => $site,
        'URL' => HOME_LINK,
        'message' => ' ',
    );
} else {
    $response = array(
        'status' => 'error',
        'message' => __('登入帳號(姓名)或密碼不正確!'),
        'pass' => $pass
    );
}

echo json_encode($response);
