<?php

class Admin_Controller_Member_Industry {
    public function __construct()
    {
        add_action('admin_menu', array($this, 'AddSubMenu'));
    }

    //phần tạo menu con trong menu cha cũng là post type
    public function AddSubMenu()
    {
        $parent_slug = 'page_member';  //giống slug $menu_slug của member
        $page_title = __('Member Industry');
        $menu_title = __('Member Industry');
        $capability = 'manage_categories';
        $menu_slug = 'page_member_industry'; //tên slug của member industry
        add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, array($this, 'dispatchActive'));
    }

    public function dispatchActive()
    {
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
        //nếu có post
        if (isPost()) {
            require_once (DIR_MODEL . 'admin-model-member-cate.php');
            $model = new Admin_Model_Member_Cate();
            $model->save($_POST, 'add');
        }
        require_once ( DIR_VIEW . 'admin-view-member-cate-industry-view.php');
    }

    public function editAction() {
        //nếu có post
        if (isPost()) {
            require_once (DIR_MODEL . 'admin-model-member-cate.php');
            $model = new Admin_Model_Member_Cate();
            $model->save($_POST, 'update');
            goback();
        }
        require_once ( DIR_VIEW . 'admin-view-member-cate-industry-view.php');
    }

    public function deleteAction(){
        $id = getParams('id');
        require_once (DIR_MODEL . 'admin-model-member-cate.php');
        $model = new Admin_Model_Member_Cate();
        $model->delete($id);
        goback();
    }
}