<?php

class Admin_Metabox_Main {
    private $_controler_name = 'admin_controller__main_options';
    private $_controler_options = array();
    public function __construct()
    {
        $defaultoption = array(
            'admin_metabox_order' => true,
            'admin_metabox_news' => true,
            'admin_metabox_checkbox' => true,
        );

        $this->_controler_options = get_option($this->_controler_name, $defaultoption);
        $this->admin_metabox_order_function();
        $this->admin_metabox_news_function();
        $this->admin_metabox_checkbox_function();
    }

    public function admin_metabox_order_function()
    {
        if ($this->_controler_options['admin_metabox_order'] == true) {
            require_once(DIR_METABOX . 'admin-metabox-order.php');
            new Admin_Metabox_Order();
        }
    }

    public function admin_metabox_news_function()
    {
        if ($this->_controler_options['admin_metabox_news'] == true) {
            require_once(DIR_METABOX . 'admin-metabox-news.php');
            new Admin_Metabox_News();
        }
    }

    public function admin_metabox_checkbox_function()
    {
        if ($this->_controler_options['admin_metabox_checkbox'] == true) {
            require_once(DIR_METABOX . 'admin-metabox-checkbox.php');
            new admin_metabox_Checkbox();
        }
    }
}