<?php

// include WordPress
define('WP_USE_THEMES', false);
require('../../../../wp-load.php');
$id = $_POST['id'];

if (!isset($_SESSION['like']) or $_SESSION['like'] != $id) {
    $_SESSION['like'] = $id;
    $arrlike = array(
        'post_type' => 'forum',
        'post__in' =>  array($id) // lay du lieu theo ID trong post
    );
    $objMember = current(get_posts($arrlike));
    if ($objMember) {
        $getMeta = get_post_meta($objMember->ID); // lay gia tri tu metabox 
        $like = (int) $getMeta['f_like'][0];
        (int) $newLike = $like + 1;
        update_post_meta($id, 'f_like', $newLike);
        $response = array(
            'status' => 'done',
            'like' => $newLike,
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'user hay pass khong chinh xac '
        );
    }
    echo json_encode($response);
}
?>
