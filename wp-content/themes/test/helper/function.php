<?php

//==== GET PARAM TREN URL============================================
function getParams($name = null)
{
    if ($name == null || empty($name)) {
        return $_REQUEST; // TRA VE GIA TRI REQUEST
    } else {
        // TRUONG HOP name DC CHUYEN VAO 
        // KIEM TRA name CO TON TAI TRA VE name NGUOI ''
        $val = (isset($_REQUEST[$name])) ? $_REQUEST[$name] : ' ';
        return $val;
    }
}

//============= KIEM DU LIEU CHUYEN QUA BANG PHUONG POST HAY GET======================
function isPost()
{
    $flag = ($_SERVER['REQUEST_METHOD'] == 'POST') ? TRUE : FALSE;
    return $flag;
}

//=======================  FUNCTION GET HINH ==================================

//Function duoc goi trong news-controller.php trong phan tao taxonomy
function custom_redirect($location)
{
    global $post_type;
    $location = admin_url('edit.php?post_type=' . $post_type);
    return $location;
}

//========================== FUNCTION ==================================

//function dung de quay tro lai trang truoc do
function goback($num = 1)
{
    $paged = max(1, $arrParams['paged']);
    $url = 'admin.php?page=' . $_REQUEST['page'] . '&paged=' . $paged . '&msg=' . $num;
    wp_redirect($url);
}
