<?php

require 'captchaCls.php';
if (!isset($_GET['reset'])) {
    $objCaptcha = new captchaCls(5, TRUE);
    $strCaptcha = $objCaptcha->getCaptcha();

} else {
    $objCaptcha = new captchaCls(5, true);
    $strCaptcha = $objCaptcha->getCaptcha();
     
}
require 'ImageCls.php';
$objImage = new ImageCls(200, 50, $strCaptcha);
$objImage->showImage("Vnitruck.TTF");



