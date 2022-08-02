<?php

class Member_Industry_Controler {

    public function __construct() {
        add_action('admin_menu', array($this, 'AddSubMenu'));
    }

    // PHAN TAO MENU CON TRONG MENU CHA CUNG LA POST TYPE
    public function AddSubMenu() {
        $parent_slug = 'page_member';
        $page_title = __('Member Industry');
        $menu_title = __('Member Industry');
        $capability = 'manage_categories';
        $menu_slug = 'page_member_industry';
        add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, array($this, 'dispatchActive'));
    }

    public function dispatchActive() {
//        echo __METHOD__;
        $action = getParams('action');
        switch ($action) {
            case 'edit':
                $this->editAction();
                break;
            case 'del':
                $this->deleteAction();
                break;
            default :
                $this->displayPage();
                break;
        }
    }

    public function displayPage() {
        if (isPost()) {
            require_once (DIR_MODEL . 'member_industry_model.php');
            $model = new Member_Industry_Model();
            $model->save($_POST, 'add');
        }
        require_once ( DIR_VIEW . 'member_industry_view.php');
    }

    public function editAction() {
        if (isPost()) {
            require_once (DIR_MODEL . 'member_industry_model.php');
            $model = new Member_Industry_Model();
            $model->save($_POST, 'update');
            goback();
        }
        require_once ( DIR_VIEW . 'member_industry_view.php');
    }

    public function deleteAction(){
        $id = getParams('id');
        require_once (DIR_MODEL . 'member_industry_model.php');
        $model = new Member_Industry_Model();
        $model->delete($id);
         goback();
    }
}
