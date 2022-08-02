<?php

class ImageCls {

    private $_intWidth;
    private $_intHeight;
    private $_objImage;
    private $_intDisturbColor;
    private $_strCaptcha;
    private $_intCaptchaLength;

    public function __construct($intWidth = 200, $intHeight = 50, $strCaptcha = '') {

        $this->_intWidth = $intWidth;
        $this->_intHeight = $intHeight;
        $this->_strCaptcha = $strCaptcha;
        $this->_intCaptchaLength = strlen($strCaptcha);

        $num = floor($this->_intWidth * $this->_intHeight / 15);
        if ($num > 240 - $this->_intCaptchaLength) {
            $this->_intDisturbColor = 240 - $this->_intCaptchaLength;
        } else {
            $this->_intDisturbColor = $num;
        }
    }

    public function showImage($strFontFace = "") {

        $this->_objImage = imagecreatetruecolor($this->_intWidth, $this->_intHeight);

        $backColor = imagecolorallocate($this->_objImage, rand(225, 255), rand(225, 255), rand(225, 255));
        imagefill($this->_objImage, 0, 0, $backColor);

        $border = imagecolorallocate($this->_objImage, 0, 0, 0);
        imagerectangle($this->_objImage, 0, 0, $this->_intWidth - 1, $this->_intHeight - 1, $border);

        for ($i = 0; $i < $this->_intDisturbColor; $i++) {
            $color = imagecolorallocate($this->_objImage, rand(0, 255), rand(0, 255), rand(0, 255));
            imagesetpixel($this->_objImage, rand(1, $this->_intWidth - 2), rand(1, $this->_intHeight - 2), $color);
        }
        for ($i = 0; $i < 10; $i++) {
            $color = imagecolorallocate($this->_objImage, rand(0, 255), rand(0, 255), rand(0, 255));
            imagearc($this->_objImage, rand(-10, $this->_intWidth), rand(-10, $this->_intHeight), rand(30, 300), rand(20, 200), 50, 44, $color);
        }

        for ($i = 0; $i < $this->_intCaptchaLength; $i++) {

            $fontcolor = imagecolorallocate($this->_objImage, rand(0, 128), rand(0, 128), rand(0, 128));
            if ($strFontFace == "") {
                
                $fontsize = rand(3, 5);
                $x = floor($this->_intWidth / $this->_intCaptchaLength) * $i + 3;
                $y = rand(0, $this->_intHeight - 15);
                imagechar($this->_objImage, $fontsize, $x, $y, $this->_strCaptcha{$i}, $fontcolor);
            } else {

                $fontsize = rand(12, 35);
                $x = floor(($this->_intWidth) / $this->_intCaptchaLength) * $i + 15;
                $y = rand($fontsize + 5, $this->_intHeight - 8);
                imagettftext($this->_objImage, $fontsize, rand(-45, 45), $x, $y, $fontcolor, $strFontFace, $this->_strCaptcha{$i});
            }
        }

        if (imagetypes() % IMG_GIF) {
            header("Content-type:image/gif");
            imagepng($this->_objImage);
        } else if (imagetypes() % IMG_JPG) {
            header("Content-type:image/jpeg");
            imagepng($this->_objImage);
        } else if (imagetypes() % IMG_PNG) {
            header("Content-type:image/png");
            imagepng($this->_objImage);
        } else if (imagetypes() % IMG_WBMP) {
            header("Content-type:image/vnd.wap.wbmp");
            imagepng($this->_objImage);
        } else {
            die("PHP Not support");
        }
    }

    function __destruct() {
        imagedestroy($this->_objImage);
    }
}
