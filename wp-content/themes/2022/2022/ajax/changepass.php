<?php

// include WordPress
define('WP_USE_THEMES', false);
require('../../../../wp-load.php');

// tiep gía tri chuyen qua tu post 
$user = $_SESSION['login'];
$o_pass = md5(esc_attr($_POST['o_pass']));
$n_pass = md5(esc_attr($_POST['n_pass']));



// dieu kien get data tu metabox == where
$arrArgs = array(
    'post_type' => 'member',
    'meta_query' => array(
        array('key' => 'm_user', 'value' => $user),
        array('key' => 'm_password', 'value' => $o_pass),
    )
);
// kiem tra du leiu co trung hop khong
$objMember = current(get_posts($arrArgs));
if (!$objMember) {
    $response = array(
        'status' => 'error',
        'oldPass' => '密碼不正確',
        'message' => ' '
    );

    /*
      $getMeta = get_post_meta($objMember->ID); // lay gia tri tu metabox
      $_SESSION['login'] = $getMeta['m_user'][0]; //  lay user trong metabox ra de tao gia tri cho session
      $response = array(
      'status' => 'done',
      'message' => ''
      );
     * 
     */
} else {

    // sau khi lay va lay dong du lieu
    $objMember = current(get_posts($arrArgs));
    $id = $objMember->ID; // lay ID cua du dong du lieu lay dc

    update_post_meta($id, 'm_password', $n_pass);
    $response = array(
        'status' => 'done',
        'oldPass' => '',
        'message' => '密碼已更新 !'
    );
}

echo json_encode($response);
