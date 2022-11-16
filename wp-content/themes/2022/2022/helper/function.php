<?php

function curl_get_contents($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    $html = curl_exec($ch);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

require_once(DIR_CODES . 'admin-function.php');
require_once(DIR_CODES . 'admin-add-post-taxonomy-field.php');

require_once(DIR_CODES . 'forum-cmd-ui.php');

require_once(DIR_CODES . 'function-post-list.php');
require_once(DIR_CODES . 'function-vote.php');
require_once(DIR_CODES . 'function-upload.php');
require_once(DIR_CODES . 'function-download.php');

//=====2022=====================
require_once(DIR_CODES . 'function-menu.php');
require_once(DIR_CODES . 'meta-recruit.php');
require_once(DIR_CODES . 'function-slider.php');
require_once(DIR_CODES . 'function-wp-query.php');
require_once(DIR_CODES . 'function-paging.php');

/* ======  GET  HINH THEO PATH ========= */

function get_member_img($img = '')
{
    return PART_IMAGES_MEMBER . $img;
}

function get_qrcode_img($barcode = '')
{
    return PART_IMAGES_QRCODE . $barcode . '.png';
}

/* KIEM TRA CO SUBMIT FROM KHONG */

function isPost()
{
    $flag = ($_SERVER['REQUEST_METHOD'] == 'POST') ? TRUE : FALSE;
    return $flag;
}

function ToBack($num = 1)
{
    $paged = max(1, getParams('paged'));
    $url = 'admin.php?page=' . $_REQUEST['page'] . '&paged=' . $paged . '&msg=' . $num;
    wp_redirect($url);
}



/* KIEM TRA DU LIEU CO CHINH XAC VA LOI KHONG */

function getValidate($filename = '', $dir = '')
{
    $obj = new stdClass();
    $file = DIR_VALIDATE . $dir . DS . $filename . '.php';
    if (file_exists($file)) {
        require_once $file;
        $validateName = 'Admin_' . $filename . '_Validate';
        $obj = new $validateName();
    }
    return $obj;
}

/*  GET  A THAM SO TREN THANH URL */

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



function custom_redirect($location)
{
    global $post_type;
    $location = admin_url('edit.php?post_type=' . $post_type);
    return $location;
}

function get_page_permalink($name)
{
    if (!empty($name)) {
        $dataPage = get_page_by_title($name);
        $id = $dataPage->ID;
        return get_page_link($id);
    }
    return false;
}

//====== functions  ===================================================
// kiem tra doi tuong da ton tai chu
// $filed = ten filed trong database
// $value = gia tri tim kiem trong $field
// $error_mess = noi dung cau thong bao tra ve
function checkExists($field, $value, $error_mess)
{
    $strField = $field;
    $strValue = $value;

    $arrArgs = array(
        'post_type' => 'member',
        'meta_query' => array(
            array(
                'key' => $strField,
                'value' => $strValue
            )
        )
    );

    $arrUsers = get_posts($arrArgs);

    if (count($arrUsers) > 0) {
        $return['error'] = 'exists';
        $return['mess'] = $error_mess;
        return $return;
    }
}

// kiem tra string
// $element = doi tuong input can kiem tra
// $min = so ky tu nho nhat
// $max = so ky tu lon nhat
function checkstr($element, $min = 2, $max = 5000)
{
    $length = strlen($element);
    if (empty($length)) {
        return __('plaese require this', 'suite');
    } elseif ($length < $min) {
        return __('min', 'suite') . $min . __('characters', 'suite');
    } elseif ($length > $max) {
        return __('max', 'suite') . $max . __('characters', 'suite');
    }
    //   return true;
}

// kiem tra email
function checkemail($element)
{
    if ($element == '') {
        return __('plaese require this', 'suite');
    } else if (!filter_var($element, FILTER_VALIDATE_EMAIL)) {
        return __('this email exists', 'suite');
    }
}

// kiem tra captcha
function checkcaptcha($elenment)
{
    if ($elenment == '') {
        return __('Requied', 'suite');
    } elseif ($elenment !== $_SESSION['captcha']) {
        return __('Capcha Not Matching', 'suite');
    } else {
        return 'done';
    }
}

/* ================================================
  SEND MAIL FUNTION
  =================================================== */

function registrySendMail($mailTo, $name, $user, $password)
{
    $subject = '越南台灣商會聯合總會-會員註冊';
    $message = '<h2>' . $name . ': 您好 ! </h2> <br>';
    $message .= '<h3> 歡迎您成為"越南台灣商會聯合總會"網頁的會員 </h3>';
    $message .= '<p> 您註冊帳號 :' . $user . ' </p>';
    $message .= '<p> 帳號密碼    :' . $password . ' </p>';
    $message .= '<a href ="http://ctcvn.vn" target="_blank"> 越南台灣商會聯合總會網頁</a><br>';
    $message .= '<a href ="http://ctcvn.vn" target="_blank"> ctcvn.vn</a><br>';
    $message .= '謝謝';
    wp_mail($mailTo, $subject, $message);
}



//Remove JQuery migrate

function remove_jquery_migrate($scripts)
{
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        if ($script->deps) {
            // Check whether the script has any dependencies

            $script->deps = array_diff($script->deps, array('jquery-migrate'));
        }
    }
}

add_action('wp_default_scripts', 'remove_jquery_migrate');
