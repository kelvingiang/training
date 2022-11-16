<?php
class Admin_Schedule_Validate
{
    private $_errors = array();
    private $_data   = array();


    public function isValidate($options = array())
    {
        $flag = FALSE;
        $action = getParams('action');
        // check_admin_referer($action,'security_code');
        //   if(check_admin_referer($action,'security_code')){
        $this->_data = getParams();
        //KIEM TRA Title KHONG DC RONG
        $title = getParams('title');
        if (empty($title)) {
            $this->_errors['title'] = translate('請輸入活動項目!');
            $this->_data['title'] = ' ';
        }
        // KIEM TRA CHUYEN DATA VE KIEU SLUG CAN PHIA SU DUNG sanitize_title DE BAO MAT
        $slug = getParams('slug');
        if (!empty($slug)) {
            $this->_data['slug'] = sanitize_title($slug);  //HAM sanitize_title CHUC NANG LA LOC CAC KY TUC KHONG PHU HOP VOI SLUG
        }

        $datepicker = getParams('date');
        if (empty($datepicker)) {
            $this->_errors['date'] = translate('請輸入活動日期 !');
            $this->_data['date'] = ' ';
        }

        // $timeStart = getParams('timeStart');
        // if (empty($timeStart)) {
        //     $this->_errors['timeStart'] = translate('請輸入活動時間 !');
        //     $this->_data['timeStart'] = ' ';
        // }
        $branch = getParams('branch');
        if ($branch == '0') {
            $this->_errors['branch'] = translate('請選擇分會 !');
            $this->_data['branch'] = ' ';
        }

        // $place = getParams('place');
        // if (empty($place)) {
        //     $this->_errors['place'] = translate('請輸入活動地點 !');
        //     $this->_data['place'] = ' ';
        // }


        // KIEM PHAN DU LIEU CON LOI HAY HET   
        if (count($this->_errors)  ==  0) {
            $flag = TRUE;
        }
        //    }else{
        //  echo 'sdfsdfas';
        //   }
        return $flag;
    }


    public function getFormError($name = '')
    {
        if (empty($name)) {
            return $this->_errors;
        } else {
            return (isset($this->_errors[$name])) ?  $this->_errors[$name] : ' ';
        }
    }


    public function getFormData($name = '')
    {
        if (empty($name)) {
            return $this->_data;
        } else {
            return (isset($this->_data['$name'])) ?  $this->_data['$name'] : ' ';
        }
    }
}
