<?php

class Main_Metabox {

    private $_controler_name = 'main_controler_options';
    private $_controler_options = array();

    public function __construct() {
        $defaultoption = array(
            'executive_metabox' => true,
            'website_metabox' => true,
            'order_metabox' => true,
            'prioritize_metabox' => true,
            'seo_metabox' => true,
        );

        $this->_controler_options = get_option($this->_controler_name, $defaultoption);
        $this->executive_metabox_function();
        $this->order_metabox_function();
        $this->website_metabox_function();
        $this->prioritize_metabox_function();
        $this->seo_metabox_function();
    }

    public function executive_metabox_function(){
        if($this->_controler_options['executive_metabox']== true){
            require_once (DIR_METABOX.'executive-metabox.php');
            new executive_Metabox();
        }
    }
    
    public function order_metabox_function() {
        if ($this->_controler_options['order_metabox'] == true) {
            require_once (DIR_METABOX . 'order-metabox.php');
            new Order_Metabox();
        }
    }

    public function website_metabox_function() {
        if ($this->_controler_options['website_metabox'] == true) {
            require_once (DIR_METABOX . 'website-metabox.php');
            new Website_Metabox();
        }
    }
    
    public function prioritize_metabox_function(){
        if($this->_controler_options['prioritize_metabox'] == true){
            require_once (DIR_METABOX .'prioritize-metabox.php');
            new Prioritize_Metabox();
        }
    }
    
    public function seo_metabox_function(){
        if($this->_controler_options['seo_metabox'] == true ){
            require_once (DIR_METABOX.'seo-metabox.php');
            new Seo_Metabox();
        }
    }

}
