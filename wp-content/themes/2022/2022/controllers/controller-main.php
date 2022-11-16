<?php

class Admin_Controller_Main
{

    private $_controller_name = 'controller_options';
    private $_controller_options = array();

    public function __construct()
    {
        $defaultOption = array(
            'controller_download' => TRUE,
            'controller_slider' => TRUE,
            'controller_branch' => TRUE,
            'controller_forum' => TRUE,
            'controller_recruitment' => TRUE,
            'controller_member' => TRUE,
            'controller_friend_link' => TRUE,

            'controller_event' => TRUE,
            'controller_event_report' => FALSE,
            'controller_apply' => FALSE,
            'controller_join' => FALSE,
            'controller_about' => TRUE,

            'controller_advertising' => TRUE,
            'controller_supervisor' => TRUE,
            'controller_schedule' => TRUE,
            'controller_checkin' => TRUE,
            'controller_checkin_report' => TRUE,
            'controller_checkin_face' => TRUE,
            'controller_checkin_setting' => get_current_user_id() == 1 ? TRUE : FALSE,
            'controller_president' => TRUE,
            'controller_vote' => TRUE,
            'controller_vote_setting' => TRUE,

        );

        $this->_controller_options = get_option($this->_controller_name, $defaultOption);
        $this->post_slider();

        $this->post_event();
        $this->post_branch();
        $this->post_event_report();
        $this->post_apply();
        $this->post_join();
        $this->post_forum();
        $this->post_recruitment();
        $this->post_friend_link();
        $this->post_member();
        $this->post_advertising();
        $this->post_supervisor();
        $this->post_president();

        $this->page_download();

        $this->page_schedule();
        $this->page_check_in();
        $this->page_check_in_report();
        $this->page_check_in_setting();
        $this->page_check_in_face();
        $this->page_about();
        $this->page_vote();
        $this->page_vote_setting();

        add_action('admin_init', array($this, 'do_output_buffer'));
    }

    /* FUNCTION NAY GIAI VIET CHUYEN TRANG BI LOI  */

    public function do_output_buffer()
    {
        ob_start();
    }

    public function page_download()
    {
        if ($this->_controller_options['controller_download'] == TRUE) {
            require_once(DIR_CONTROLLER . 'controller_download.php');
            new Admin_Controller_Download();
        }
    }

    public function post_slider()
    {

        if ($this->_controller_options['controller_slider'] == true) {
            require_once(DIR_CONTROLLER . 'controller_slider.php');
            new Admin_Controller_Slider();
        }
    }

    public function post_branch()
    {
        if ($this->_controller_options['controller_branch'] == TRUE) {
            require_once(DIR_CONTROLLER . 'controller_branch.php');
            new Admin_Controller_Branch();
        }
    }

    public function post_apply()
    {
        if ($this->_controller_options['controller_apply'] == TRUE) {
            require_once(DIR_CONTROLLER . 'controller_apply.php');
            new Admin_Controller_Apply();
        }
    }

    public function post_recruitment()
    {
        if ($this->_controller_options['controller_recruitment'] == TRUE) {
            require_once(DIR_CONTROLLER . 'controller_recruitment.php');
            new Admin_Controller_Recruitment();
        }
    }

    public function post_join()
    {
        if ($this->_controller_options['controller_join'] == TRUE) {
            require_once(DIR_CONTROLLER . 'controller_join.php');
            new Admin_controller_Join();
        }
    }

    public function post_forum()
    {
        if ($this->_controller_options['controller_forum'] == TRUE) {
            require_once(DIR_CONTROLLER . 'controller_forum.php');
            new Admin_Controller_Forum();
        }
    }

    public function post_member()
    {
        if ($this->_controller_options['controller_member'] == TRUE) {
            require_once(DIR_CONTROLLER . 'controller_member.php');
            new Admin_controller_Member();
        }
    }

    public function post_friend_link()
    {
        if ($this->_controller_options['controller_friend_link'] == true) {
            require_once(DIR_CONTROLLER . 'controller_friend_link.php');
            new Admin_Controller_Friend_Link();
        }
    }

    public function post_event()
    {
        if ($this->_controller_options['controller_event'] == true) {
            require_once(DIR_CONTROLLER . 'controller_event.php');
            new Admin_Controller_Event();
        }
    }

    public function post_event_report()
    {
        if ($this->_controller_options['controller_event_report'] == true) {
            require_once(DIR_CONTROLLER . 'controller_event_report.php');
            new Admin_Controller_Event_Report();
        }
    }

    public function page_vote_setting()
    {
        if ($this->_controller_options['controller_vote_setting'] == true) {
            require_once(DIR_CONTROLLER . 'controller_vote_setting.php');
            new Admin_Controller_Vote_Setting();
        }
    }

    public function page_vote()
    {
        if ($this->_controller_options['controller_vote'] == true) {
            require_once(DIR_CONTROLLER . 'controller_vote.php');
            new Admin_Controller_Vote();
        }
    }

    public function page_about()
    {
        if ($this->_controller_options['controller_about'] == true) {
            require_once(DIR_CONTROLLER . 'controller_about.php');
            new Admin_Controller_About();
        }
    }

    public function post_advertising()
    {
        if ($this->_controller_options['controller_advertising'] == true) {
            require_once(DIR_CONTROLLER . 'controller_advertising.php');
            new Admin_Controller_Advertising();
        }
    }

    public function post_supervisor()
    {
        if ($this->_controller_options['controller_supervisor'] == true) {
            require_once(DIR_CONTROLLER . 'controller_supervisor.php');
            new Admin_Controller_Supervisor();
        }
    }

    public function page_schedule()
    {
        if ($this->_controller_options['controller_schedule'] == true) {
            require_once(DIR_CONTROLLER . 'controller_schedule.php');
            new Admin_Controller_Schedule();
        }
    }

    public function page_check_in()
    {
        if ($this->_controller_options['controller_checkin'] == TRUE) {
            require_once(DIR_CONTROLLER . 'controller_check_in.php');
            new Admin_Controller_Check_In();
        }
    }

    public function page_check_in_report()
    {
        if ($this->_controller_options['controller_checkin_report'] == TRUE) {
            require_once(DIR_CONTROLLER . 'controller_check_in_report.php');
            new Admin_Controller_Check_In_Report();
        }
    }

    public function page_check_in_setting()
    {
        if ($this->_controller_options['controller_checkin_setting'] == TRUE) {
            require_once(DIR_CONTROLLER . 'controller_check_in_setting.php');
            new Admin_Controller_Check_In_Setting();
        }
    }

    public function page_check_in_face()
    {
        if ($this->_controller_options['controller_checkin_face'] == TRUE) {
            require_once(DIR_CONTROLLER . 'controller_check_in_face.php');
            new Admin_Controller_Check_In_Face();
        }
    }

    public function post_president()
    {
        if ($this->_controller_options['controller_president'] == TRUE) {
            require_once(DIR_CONTROLLER . 'controller_president.php');
            new Admin_Controller_President();
        }
    }
}
