<?php
class Main_Controller
{
    private $_controller_name = 'main_controler_options';
    private $_controller_options = array();

    public function __construct()
    {
        $defaultoption = array(
            //custom post
            'slider_controller' => true,
            'member_controller' => true,

            //page
            'setting_controller' => true,
            'product_controller' => true,
            'product_category_controller' => true,
        );

        $this->_controller_options = get_option($this->_controller_name, $defaultoption);
        $this->slider_controller_function();
        $this->member_controller_function();
        $this->setting_controller_function();
        $this->product_controller_function();
        $this->product_category_controller_function();

        add_action('admin_init', array($this, 'do_output_buffer'));
    }

    public function slider_controller_function()
    {
        if ($this->_controller_options['slider_controller'] == true) {
            require_once(DIR_CONTROLLER . 'slider-controller.php');
            new Slider_Controller();
        }
    }

    public function member_controller_function()
    {
        if ($this->_controller_options['member_controller'] == true) {
            require_once(DIR_CONTROLLER . 'member-controller.php');
            new Member_Controller();
        }
    }

    public function setting_controller_function()
    {
        if ($this->_controller_options['setting_controller'] == true) {
            require_once(DIR_CONTROLLER . 'setting-controller.php');
            new Setting_Controller();
        }
    }

    public function product_controller_function()
    {
        if ($this->_controller_options['product_controller'] == true) {
            require_once(DIR_CONTROLLER . 'product-controller.php');
            new Product_Controller();
        }
    }

    public function product_category_controller_function()
    {
        
        
        if ($this->_controller_options['product_category_controller'] == true) {
        
            require_once(DIR_CONTROLLER . 'product-category-controller.php');
            new Product_category_Controller();
        }
    }

    //=== FUNCTION NAY GIAI QUYET CHUYEN TRANG BI LOI 
    public function do_output_buffer()
    {
        ob_start();
    }
}
