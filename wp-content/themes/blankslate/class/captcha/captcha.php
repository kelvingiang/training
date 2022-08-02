<?php

require './CaptchaCls.php';
if (!isset($_GET['reset'])) {
    
    $objCaptcha = new CaptchaCls(null, false);
    $strCaptcha = $objCaptcha->getCaptcha();
} else {
    session_start();
    $objCaptcha = new CaptchaCls(5, true);
    $strCaptcha = $objCaptcha->getCaptcha();
}
require './ImageCls.php';
$objImage = new ImageCls(200, 50, $strCaptcha);
$objImage->showImage("Vnitruck.TTF");



