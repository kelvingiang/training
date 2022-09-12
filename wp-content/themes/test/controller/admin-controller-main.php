<?php 

class Admin_Controller_Main {
    private $_controller_name = 'admin_controller__main_options';
    private $_controller_options = array();

    public function __construct()
    {
        $defaultoption = array(
            //custom post
            'admin_controller_news' => true,
            'admin_controller_slider' => true,

            //page
            'admin_controller_member' => true,
            'admin_controller_member_group' => true,
            'admin_controller_member_industry' => true,
        );

        $this->_controller_options = get_option($this->_controller_name, $defaultoption);
        $this->admin_controller__news_function();
        $this->admin_controller__slider_function();
        $this->admin_controller__member_function();
        $this->admin_controller__member_group_function();
        $this->admin_controller__member_industry_function();

        add_action('admin_init', array($this, 'do_output_buffer'));
    }

    public function admin_controller__news_function()
    {
        if ($this->_controller_options['admin_controller_news'] == true) {
        
            require_once(DIR_CONTROLLER . 'admin-controller-news.php');
            new Admin_Controller_News();
        }
    }

    public function admin_controller__member_function()
    {
        if ($this->_controller_options['admin_controller_member'] == true) {
        
            require_once(DIR_CONTROLLER . 'admin-controller-member.php');
            new Admin_Controller_Member();
        }
    }

    public function admin_controller__member_group_function()
    {
        if ($this->_controller_options['admin_controller_member_group'] == true) {
        
            require_once(DIR_CONTROLLER . 'admin-controller-member-group.php');
            new Admin_Controller_Member_Group();
        }
    }

    public function admin_controller__member_industry_function()
    {
        if ($this->_controller_options['admin_controller_member_industry'] == true) {
        
            require_once(DIR_CONTROLLER . 'admin-controller-member-industry.php');
            new Admin_Controller_Member_Industry();
        }
    }

    public function admin_controller__slider_function()
    {
        if ($this->_controller_options['admin_controller_slider'] == true) {
        
            require_once(DIR_CONTROLLER . 'admin-controller-slider.php');
            new Admin_Controller_Slider();
        }
    }

    //=== FUNCTION NAY GIAI QUYET CHUYEN TRANG BI LOI 
    public function do_output_buffer()
    {
        ob_start();
    }
}