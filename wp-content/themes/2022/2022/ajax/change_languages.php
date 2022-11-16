<?php
define('WP_USE_THEMES', false);
require('../../../../wp-load.php');

$response = array('status' => 'error');

if (isset($_POST)) {
    $_SESSION['languages'] = $_POST['type'];
    $response = array('status' => 'ok');
    //echo "ok";
}
echo json_encode($response);
//echo $response;