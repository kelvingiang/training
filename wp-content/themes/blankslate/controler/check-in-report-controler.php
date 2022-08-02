<?php

class Check_In_Report_Controler {

    public function __construct() {
        add_action('admin_menu', array($this, 'AddSubMenu'));
    }

    // PHAN TAO MENU CON TRONG MENU CHA CUNG LA POST TYPE
    public function AddSubMenu() {
        $parent_slug = 'page_check_in';
        $page_title = __('Check In Report');
        $menu_title = __('Check In Report');
        $capability = 'manage_categories';
        $menu_slug = 'page_check_in_report';
        add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, array($this, 'dispatchActive'));
    }

    public function dispatchActive() {
//        echo __METHOD__;
        $action = getParams('action');
        switch ($action) {
            case 'export':
                $this->exportAction();
                break;
            case'waiting':
                $this->waitingAction();
                break;
            default :
                $this->displayPage();
                break;
        }
    }

    public function displayPage() {
        require_once ( DIR_VIEW . 'check_in_report_view.php');
    }

    public function exportAction() {
        require_once (DIR_MODEL . 'check_in_report_model.php');
        $model = new Check_In_Report_Model();
        $model->ExportCheckIn();
    }

    
    public function waitingAction(){
        if(isPost()){
            update_option("check_in_waitting",$_POST['txtWait']);
            update_option("check_in_title",$_POST['txtTitle']);
            goback();
        }
        require_once (DIR_VIEW .'check_in_waiting_view.php');
    }
}
