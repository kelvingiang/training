<?php

define('WP_USE_THEMES', false);
require('../../../../../wp-load.php' );

$postID = (int)$_POST['id'];

if (!empty($postID)) {
    update_post_meta($postID, '_guests_check_in', '0');
    update_post_meta($postID, '_guests_check_time', '');
    //update_post_meta($postID, '_guests_check_in', '1');
    $response = array('status' => 'done', 'message' => $_POST['id']);
} else {
    $response = array('status' => 'error', 'message' => 'have a error');
}

echo json_encode($response);