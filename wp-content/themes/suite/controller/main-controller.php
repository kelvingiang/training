<?php
class Main_Controler
{
    private $_controller_name = 'main_controler_options';
    private $_controller_options = array();

    public function __construct()
    {
        $defaultoption = array(

            'slider_controller' => true,

        );

        $this->_controller_options = get_option($this->_controller_name, $defaultoption);
        $this->slider_controller_function();

        add_action('admin_init', array($this, 'do_output_buffer'));
    }

    public function slider_controller_function()
    {
        if ($this->_controller_options['slider_controller'] == true) {
            require_once(DIR_CONTROLLER . 'slider-controller.php');
            new Slider_Controller();
        }
    }

    //=== FUNCTION NAY GIAI QUYET CHUYEN TRANG BI LOI 
    public function do_output_buffer()
    {
        ob_start();
    }
}
