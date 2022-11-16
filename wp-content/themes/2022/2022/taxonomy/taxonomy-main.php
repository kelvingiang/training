<?php

class Admin_Taxonomy_Main
{

    private $_taxonomy_name = 'main_taxonomy_options';
    private $_taxonomy_options = array();

    public function __construct()
    {
        $defaultoption = array(
            'taxonomy_event' => true,

        );

        $this->_taxonomy_options = get_option($this->_taxonomy_name, $defaultoption);
        $this->taxonomy_event();
    }


    public function taxonomy_event()
    {
        if ($this->_taxonomy_options['taxonomy_event'] == true) {
            require_once(DIR_TAXONOMY . 'taxonomy-event.php');
            new taxonomy_event();
        }
    }
}
