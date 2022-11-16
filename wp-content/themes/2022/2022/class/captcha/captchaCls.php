<?php

class captchaCls {

    private $_intCaptchaLength;
    private $_strCaptcha;

    /*
     * Initialize object Captcha
     * 
     * @return object captcha
     */
    public function __construct() {

        $arrArgs = func_get_args();

        session_start();
        if ($arrArgs[1] == true) {
            $this->_intCaptchaLength = $arrArgs[0];

            $strLibs = "23456789zxcvbnmlkjhgfdsaqwertyup";

            for ($i = 0; $i < $this->_intCaptchaLength; $i++) {
                $strChar = $strLibs{rand(0, strlen($strLibs) - 1)};
                $this->_strCaptcha .= $strChar;
            }
            
            $_SESSION['captcha'] = $this->_strCaptcha;
        } else {
            $this->_strCaptcha = $_SESSION['captcha'];
        }
    }

    /*
     * Get string captcha
     * 
     * @return string captcha
     */
    public function getCaptcha() {
        return $this->_strCaptcha;
    }

}
