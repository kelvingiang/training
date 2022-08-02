<?php

class Check_In_Setting_Controler {

    public function __construct() {
        add_action('admin_menu', array($this, 'AddSubMenu'));
    }

    // PHAN TAO MENU CON TRONG MENU CHA CUNG LA POST TYPE
    public function AddSubMenu() {
        $parent_slug = 'page_check_in';
        $page_title = __('Check In Setting');
        $menu_title = __('Check In Setting');
        $capability = 'manage_categories';
        $menu_slug = 'page_check_in_setting';
        add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, array($this, 'dispatchActive'));
    }

    public function dispatchActive() {
//        echo __METHOD__;
        $action = getParams('action');
        switch ($action) {
            case 'export-check-in':
                $this->exportAction();
                break;
            case 'export-meeting-member':
                $this->exportMeetingAction();
                break;
            case 'export-member':
                $this->exportMemberAction();
                break;
            case 'import-member':
                $this->importMemberAction();
                break;
            case 'import-meeting-member':
                $this->importMeetingMemberAction();
                break;
            case 'reset-check-in':
                $this->resetCheckInAction();
                break;
            case 'create-QR-name':
                $this->createQRHaveName();
                break;
            default :
                $this->displayPage();
                break;
        }
    }

    public function model() {
        require_once (DIR_MODEL . 'check_in_setting_model.php');
        $model = new Check_In_Setting_Model();
        return $model;
    }

    public function displayPage() {
        require_once ( DIR_VIEW . 'check_in_setting_view.php');
    }

    public function exportAction() {
        $this->model()->ExportCheckIn();
    }

    public function exportMeetingAction() {
        $this->model()->ExportMettingMember();
    }

    public function exportMemberAction() {
        $this->model()->ExportMember();
    }

    public function importMemberAction() {
        if (isPost()) {
            $flag = true;
            $file_name = $_FILES['member']['name'];
            $file_size = $_FILES['member']['size'];
            $file_tmp = $_FILES['member']['tmp_name'];
            $file_type = $_FILES['member']['type'];

            $file_trim = ((explode('.', $_FILES['member']['name'])));
            $trim_name = strtolower($file_trim[0]);
            $trim_type = strtolower($file_trim[1]);
            //$name = $_SESSION['login'];
            // $cus_name = 'avatar-'.$name . '.' . $trim_type;  //tao name moi cho file tranh trung va mat file

            $extensions = array("xls", "xlsx", 'csv');
            if (in_array($trim_type, $extensions) === false) {
                Check_In_Setting_Controler::$errors[] = __('extension not allowed, please choose an excel file');
                $flag = false;
            }
            if ($flag) {
                $path = WP_CONTENT_DIR . DS . 'themes' . DS . 'blankslate' . DS . 'file' . DS;
                move_uploaded_file($file_tmp, ( $path . $file_name));

                $excelList = $path . $file_name;
                $this->model()->ImportMember($excelList);

                goback(2);
            }
        }
        require_once (DIR_VIEW . 'import_member_view.php');
    }

    public function importMeetingMemberAction() {
        if (isPost()) {
            $flag = true;
            $file_name = $_FILES['member']['name'];
            $file_size = $_FILES['member']['size'];
            $file_tmp = $_FILES['member']['tmp_name'];
            $file_type = $_FILES['member']['type'];

            $file_trim = ((explode('.', $_FILES['member']['name'])));
            $trim_name = strtolower($file_trim[0]);
            $trim_type = strtolower($file_trim[1]);
            //$name = $_SESSION['login'];
            // $cus_name = 'avatar-'.$name . '.' . $trim_type;  //tao name moi cho file tranh trung va mat file

            $extensions = array("xls", "xlsx", 'csv');
            if (in_array($trim_type, $extensions) === false) {
                Check_In_Setting_Controler::$errors[] = __('extension not allowed, please choose an excel file');
                $flag = false;
            }
            if ($flag) {
                $path = WP_CONTENT_DIR . DS . 'themes' . DS . 'blankslate' . DS . 'file' . DS;
                move_uploaded_file($file_tmp, ( $path . $file_name));

                $excelList = $path . $file_name;
                $this->model()->ImportMeetingMember($excelList);

               goback(2);
            }
        }
        require_once (DIR_VIEW . 'import_meeting_member_view.php');
    }

    public function resetCheckInAction() {
        $this->model()->ResetCheckIn();
        goback(3);
    }

    public function createQRHaveName() {
        $this->model()->CreateQRCodeHaveName();
        goback(3);
    }

    public static $errors;

}
