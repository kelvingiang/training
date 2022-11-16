<?php

class Admin_metabox_Main
{

    private $_metabox_name = 'metabox_options';
    private $_metabox_options = array();

    public function __construct()
    {
        $defaultoption = array(
            'metabox_apply' => TRUE,
            'metabox_join' => TRUE,
            'metabox_branch' => TRUE,
            'metabox_active' => TRUE,
            'metabox_recruitment' => TRUE,
            'metabox_website' => TRUE,
            'metabox_special' => TRUE,
            'metabox_friend_link' => TRUE,

            'metabox_president' => TRUE,
            'metabox_member' => TRUE,
            'metabox_seo' => TRUE,
            'metabox_language' => TRUE,
            'metabox_order' => TRUE,

            'metabox_event' => FALSE,
        );


        $this->_metabox_options = get_option($this->_metabox_name, $defaultoption);
        $this->apply();
        $this->join();
        $this->branch();
        $this->active();
        $this->recruitment();
        $this->event();
        $this->website();
        $this->SpecialShow();

        $this->president();
        $this->member();
        $this->friendLink();
        $this->seo();
        $this->order();
        $this->language();
    }


    public function language()
    {
        if ($this->_metabox_options['metabox_language'] == true) {
            require_once(DIR_METABOX . 'metabox-language.php');
            new Admin_Metabox_Language();
        }
    }

    public function order()
    {
        if ($this->_metabox_options['metabox_order'] == true) {
            require_once(DIR_METABOX . 'metabox-order.php');
            new Admin_Metabox_Order();
        }
    }

    public function seo()
    {
        if ($this->_metabox_options['metabox_seo'] == true) {
            require_once(DIR_METABOX . 'metabox-seo.php');
            new Admin_Metabox_Seo();
        }
    }



    public function apply()
    {
        if ($this->_metabox_options['metabox_apply'] == true) {
            require_once(DIR_METABOX . 'apply.php');
            new Admin_Metabox_Apply();
        }
    }

    public function join()
    {
        if ($this->_metabox_options['metabox_join'] == true) {
            require_once(DIR_METABOX . 'join.php');
            new Admin_Metabox_Join();
        }
    }

    public function branch()
    {
        if ($this->_metabox_options['metabox_branch'] == true) {
            require_once(DIR_METABOX . 'metabox-branch.php');
            new Admin_Metabox_Branch();
        }
    }

    public function active()
    {
        if ($this->_metabox_options['metabox_active'] == true) {
            require_once(DIR_METABOX . 'active.php');
            new Admin_Metabox_active();
        }
    }

    public function recruitment()
    {
        if ($this->_metabox_options['metabox_recruitment'] == true) {
            require_once(DIR_METABOX . 'metabox-recruitment.php');
            new Admin_Metabox_Recruitment();
        }
    }

    public function member()
    {
        if ($this->_metabox_options['metabox_member'] == true) {
            require_once(DIR_METABOX . 'metabox-member.php');
            new Admin_Metabox_Member();
        }
    }



    public function friendLink()
    {
        if ($this->_metabox_options['metabox_friend_link'] == true) {
            require_once(DIR_METABOX . 'metabox-friendlink.php');
            new Admin_Metabox_Friend_link();
        }
    }

    public function event()
    {
        if ($this->_metabox_options['metabox_event'] == true) {
            require_once(DIR_METABOX . 'event.php');
            new Admin_Metabox_Event();
        }
    }

    public function website()
    {
        if ($this->_metabox_options['metabox_website'] == true) {
            require_once(DIR_METABOX . 'metabox-website.php');
            new Admin_Metabox_website();
        }
    }

    public function SpecialShow()
    {
        if ($this->_metabox_options['metabox_special'] == true) {
            require_once(DIR_METABOX . 'metabox-special.php');
            new Admin_Metabox_Special();
        }
    }

    public function president()
    {
        if ($this->_metabox_options['metabox_president'] == true) {
            require_once(DIR_METABOX . 'metabox-president.php');
            new Admin_Metabox_President();
        }
    }
}
