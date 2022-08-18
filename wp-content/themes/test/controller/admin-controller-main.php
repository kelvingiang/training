<?php 

class Admin_Controller_Main {
    private $_controller_name = 'admin_controller__main_options';
    private $_controller_options = array();

    public function __construct()
    {
        $defaultoption = array(
            //custom post
            'admin_controller_news' => true,

        );

        $this->_controller_options = get_option($this->_controller_name, $defaultoption);
        $this->admin_controller__news_function();

        add_action('admin_init', array($this, 'do_output_buffer'));
    }

    public function admin_controller__news_function()
    {
        
        
        if ($this->_controller_options['admin_controller_news'] == true) {
        
            require_once(DIR_CONTROLLER . 'admin-controller-news.php');
            new Admin_Controller_News();
        }
    }

    //=== FUNCTION NAY GIAI QUYET CHUYEN TRANG BI LOI 
    public function do_output_buffer()
    {
        ob_start();
    }
}