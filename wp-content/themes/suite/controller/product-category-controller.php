<?php

class Product_Category_Controller {

    public function __construct()
    {
        add_action('admin_menu', array($this, 'AddSubMenu'));
    }

    //phần tạp menu con trong menu cha cũng là post type
    public function AddSubMenu()
    {
        $parent_slug = 'page_product';  //giống slug $menu_slug của product
        $page_title = __('Product Category');
        $menu_title = __('Product Category');
        $capability = 'manage_categories';
        $menu_slug = 'page_product_category'; //tên slug của product category
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
            require_once (DIR_MODEL . 'product_category_model.php');
            $model = new Product_Category_Model();
            $model->save($_POST, 'add');
        }
        require_once ( DIR_VIEW . 'product_category_view.php');
    }

    public function editAction() {
        //nếu có post
        if (isPost()) {
            require_once (DIR_MODEL . 'product_category_model.php');
            $model = new Product_Category_Model();
            $model->save($_POST, 'update');
            goback();
        }
        require_once ( DIR_VIEW . 'product_category_view.php');
    }

    public function deleteAction(){
        $id = getParams('id');
        require_once (DIR_MODEL . 'product_category_model.php');
        $model = new Product_Category_Model();
        $model->delete($id);
        goback();
    }
}