<?php

class Setting_Controller {

    public function __construct() 
    {
        add_action('admin_menu', array($this, 'AddToMenu'));
    }

    public function AddToMenu() {
        //THEM 1 NHOM MOI VAO ADMIN MENU
        $page_title = __('Commerce Setting'); // TIEU DE
        $menu_title = __('Commerce Setting');   //TEN HIEN THI

        //CHON QUYEN TRUY CAP manage_categories 
        //DE role ADMINISTATOR VA EDITOR DEU THAY DUOC
        $capability = 'manage_categories'; //QUYEN TRUY CAP DE THAY MENU NAY
        //TEN slug TEN DUY NHAT KHONG DUOC TRÙNG VỚI TRANG KHÁC GẮN TREN THANH ĐỊA CHỈ CỦA MENU
        $menu_slug = 'page_setting'; 

        //THAM SO THU 5 GOI DEN HAM HIEN THI GIAO DIEN TRONG MENU
        $icon = PART_ICON . 'admin-icon.png'; // THAM SO THU 6 LA LINK DEN ICON ĐẠI DIỆN
        $position = 12; //VI TRI HIEN THI TRONG MENU

        add_menu_page($page_title, $menu_title, $capability, $menu_slug, array($this, 'dispatchActive'), $icon, $position);

    }

    //điều hướng
    public function dispatchActive() 
    {
        $action = getParams('action');
        switch ($action) {
            default :
                $this->displayPage();
                break;
        }
    }
    //khởi tạo url
    public function createUrl()
    {
        echo $url = 'admin.php?page=' . getParams('page'); //admin.php?page=page_setting
        if(mb_strlen(getParams('s'))) {
            $url .= '&s=' . getParams('s');
        }
        return $url;
    }


    /** 
     * =================================================
     * CAC CHUC NANG THEM , XOA, SUA , HIEN THI
     * ===================================================
     */
    //Hiển thị trang
    public function displayPage() 
    {   
        /**
         * loc du lieu khi action = -1
         * nghia la dang co du lieu(cho ca filter va search)
         */
        if(getParams('action') == -1){
            $url = $this->createUrl();
            wp_redirect($url);
        }
        //neu da post
        if(isPost()) {
            require_once(DIR_MODEL.'setting_model.php');
            $model = new Setting_Model();
            $model->Save($_POST);
        }
        require_once (DIR_VIEW . 'setting_view.php');
    }

}