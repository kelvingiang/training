<?php

// include WordPress
define('WP_USE_THEMES', false);
require('../../../../wp-load.php');

// tiep gía tri chuyen qua tu post 

$cmtComment = $_POST['comment'];

// dieu kien get data tu metabox == where
// kiem tra du leiu co trung hop khong
//if (empty($cmtComment)) {
  //  $response = array(
    //    'status' => 'empty',
      //  'mess' => 'chua nhap thong tin cmt !',
       // 'message' => $cmtComment);
//} else {
    $checkValue = $cmtComment;
    if (!$checkValue) {
        $response = array(
            'status' => 'error',
            'mess' => __('co mot so tu khong cho phep nhap',suite),
            'message' => $cmtComment);
    }else{
          $response = array(
            'status' => 'done',
            'mess' => '',
            'message' => $cmtComment);
    }
//}

echo json_encode($response);
?>
