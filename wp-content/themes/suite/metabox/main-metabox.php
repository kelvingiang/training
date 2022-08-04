<?php
class Main_Metabox
{
    private $_controler_name = 'main_controler_options';
    private $_controler_options = array();
    public function __construct()
    {
        $defaultoption = array(

            'order_metabox' => true,
            'member_metabox' => true,
            'checkbox_metabox' => true,
        );

        $this->_controler_options = get_option($this->_controler_name, $defaultoption);
        $this->order_metabox_function();
        $this->member_metabox_function();
        $this->checkbox_metabox_function();
    }

    public function order_metabox_function()
    {
        if ($this->_controler_options['order_metabox'] == true) {
            require_once(DIR_METABOX . 'order-metabox.php');
            new Order_Metabox();
        }
    }

    public function member_metabox_function()
    {
        if ($this->_controler_options['member_metabox'] == true) {
            require_once(DIR_METABOX . 'member-metabox.php');
            new Member_Metabox();
        }
    }

    public function checkbox_metabox_function()
    {
        if ($this->_controler_options['checkbox_metabox'] == true) {
            require_once(DIR_METABOX . 'checkbox-metabox.php');
            new Checkbox_Metabox();
        }
    }
}
