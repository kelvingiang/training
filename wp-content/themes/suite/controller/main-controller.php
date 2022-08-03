<?php
class Main_Controler {
    private $_controler_name = 'main_controler_options';
    private $_controler_options = array();

    public function __construct() {
        $defaultoption = array(
            // page
            // 'setting_controler' => true,
            // 'check_in_controler' => true,
            // 'check_in_report_controler' => true,
            // 'check_in_setting_controler' => true,
            // 'schedule_controler' => true,
            // 'member_controler' => true,
            // 'member_industry_controler' => true,
            // custom post
            //'executive_controler' => true,
            'slider_controler' => true,
            // 'sponsor_controler' => true,
            // 'friendly_controler' => true,
        );

        $this->_controler_options = get_option($this->_controler_name, $defaultoption);
        // $this->setting_controler_function();
        // $this->check_in_controler_function();
        // $this->check_in_report_controler_function();
        // $this->check_in_setting_controler_function();
        // $this->schedule_controler_function();
        // $this->executive_controler_function();
        $this->slider_controler_function();
        // $this->sponsor_controler_function();
        // $this->member_controler_function();
        // $this->member_industry_controler_function();
        // $this->friendly_controler_function();

        add_action('admin_init', array($this, 'do_output_buffer'));
    }

    public function slider_controler_function() {
        if ($this->_controler_options['slider_controler'] == true) {
            require_once (DIR_CONTROLLER . 'slider-controller.php');
            new Slider_Controler();
        }
    }

    //=== FUNCTION NAY GIAI QUYET CHUYEN TRANG BI LOI 
    public function do_output_buffer() {
        ob_start();
    }
}