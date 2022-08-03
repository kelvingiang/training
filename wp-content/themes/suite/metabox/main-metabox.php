<?php
class Main_Metabox {
    private $_controler_name = 'main_controler_options';
    private $_controler_options = array();
    public function __construct() {
        $defaultoption = array(
            // 'executive_metabox' => true,
            // 'website_metabox' => true,
            'order_metabox' => true,
            // 'prioritize_metabox' => true,
            // 'seo_metabox' => true,
        );

        $this->_controler_options = get_option($this->_controler_name, $defaultoption);
        $this->order_metabox_function();
    }

    public function order_metabox_function() {
        if ($this->_controler_options['order_metabox'] == true) {
            require_once (DIR_METABOX . 'order-metabox.php');
            new Order_Metabox();
        }
    }

    
}