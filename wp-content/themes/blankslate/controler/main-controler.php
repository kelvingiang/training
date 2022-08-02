<?php

class Main_Controler {

    private $_controler_name = 'main_controler_options';
    private $_controler_options = array();

    public function __construct() {
        $defaultoption = array(
            // page
            'setting_controler' => true,
            'check_in_controler' => true,
            'check_in_report_controler' => true,
            'check_in_setting_controler' => true,
            'schedule_controler' => true,
            'member_controler' => true,
            'member_industry_controler' => true,
            // custom post
            'executive_controler' => true,
            'slider_controler' => true,
            'sponsor_controler' => true,
            'friendly_controler' => true,
        );

        $this->_controler_options = get_option($this->_controler_name, $defaultoption);
        $this->setting_controler_function();
        $this->check_in_controler_function();
        $this->check_in_report_controler_function();
        $this->check_in_setting_controler_function();
        $this->schedule_controler_function();
        $this->executive_controler_function();
        $this->slider_controler_function();
        $this->sponsor_controler_function();
        $this->member_controler_function();
        $this->member_industry_controler_function();
        $this->friendly_controler_function();

        add_action('admin_init', array($this, 'do_output_buffer'));
    }

    public function setting_controler_function() {
        if ($this->_controler_options['setting_controler'] == true) {
            require_once(DIR_CONTROLER . 'setting-controler.php');
            new Setting_Controler();
        }
    }

    public function check_in_controler_function() {
        if ($this->_controler_options['check_in_controler'] == true) {
            require_once(DIR_CONTROLER . 'check-in-controler.php');
            new Check_In_Controler();
        }
    }

    public function check_in_report_controler_function() {
        if ($this->_controler_options['check_in_report_controler'] == true) {
            require_once(DIR_CONTROLER . 'check-in-report-controler.php');
            new Check_In_Report_Controler();
        }
    }

    public function check_in_setting_controler_function() {
        if ($this->_controler_options['check_in_setting_controler'] == true) {
            require_once (DIR_CONTROLER . 'check-in-setting-controler.php');
            new Check_In_Setting_Controler();
        }
    }

    public function schedule_controler_function() {
        if ($this->_controler_options['schedule_controler'] == true) {
            require_once (DIR_CONTROLER . 'schedule-controler.php');
            new Schedule_Controler();
        }
    }

    public function executive_controler_function() {
        if ($this->_controler_options['executive_controler'] == true) {
            require_once (DIR_CONTROLER . 'executive-controler.php');
            new Executive_Controler();
        }
    }

    public function slider_controler_function() {
        if ($this->_controler_options['slider_controler'] == true) {
            require_once (DIR_CONTROLER . 'slider-controler.php');
            new Slider_Controler();
        }
    }

    public function sponsor_controler_function() {
        if ($this->_controler_options['sponsor_controler'] == true) {
            require_once (DIR_CONTROLER . 'sponsor-controler.php');
            new Sponsor_Controler();
        }
    }

    public function member_controler_function() {
        if ($this->_controler_options['member_controler'] == true) {
            require_once (DIR_CONTROLER . 'member-controler.php');
            new Member_Controler();
        }
    }

    public function member_industry_controler_function() {
        if ($this->_controler_options['member_industry_controler'] == true) {
            require_once (DIR_CONTROLER . 'member-industry-controler.php');
            new Member_Industry_Controler();
        }
    }

    public function friendly_controler_function() {
        if ($this->_controler_options['friendly_controler'] == true) {
            require_once (DIR_CONTROLER . 'friendly-controler.php');
            new Friendly_Controler();
        }
    }

//=== FUNCTION NAY GIAI QUYET CHUYEN TRANG BI LOI 
    public function do_output_buffer() {
        ob_start();
    }

}
