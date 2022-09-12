<?php

class Admin_Controller_Member {
    public function __construct() {
        add_action('admin_menu', array($this, 'AddToMenu'));
    }

    public function AddToMenu() {
        // THEM 1 NHOM MENU MOI VAO TRONG ADMIN MENU
        $page_title = __('Member'); // TIEU DE CUA TRANG 
        $menu_title = __('Member');  // TEN HIEN TRONG MENU
// CHON QUYEN TRUY CAP manage_categories DE role ADMINNITRATOR VÀ EDITOR DEU THAY DUOC
        $capability = 'manage_categories'; // QUYEN TRUY CAP DE THAY MENU NAY
        $menu_slug = 'page_member'; // TEN slug TEN DUY NHAT KO DC TRUNG VOI TRANG KHAC GAN TREN THANH DIA CHI OF MENU
// THAM SO THU 5 GOI DEN HAM HIEN THI GIAO DIEN TRONG MENU
        $icon = PART_ICON . 'ad-icon.png';  // THAM SO THU 6 LA LINK DEN ICON DAI DIEN
        $position = 8; // VI TRI HIEN THI TRONG MENU

        add_menu_page($page_title, $menu_title, $capability, $menu_slug, array($this, 'dispatchActive'), $icon, $position);
    }

    //phan dieu huong
    public function dispatchActive() {
        $action = getParams('action');
        switch ($action) {
            case 'add':
                $this->addAction();
                break;
            case 'edit':
                $this->editAction();
                break;
            case 'delete':
                $this->deleteAction();
                break;
            case 'trash':
                $this->trashAction();
                break;
            case 'uncheckin':
                $this->uncheckinAction();
                break;
            case 'restore':
                $this->restoreAction();
                break;
            default :
                $this->displayPage();
                break;    
        }
    }
    //khoi tao url
    public function createUrl() {
        echo $url = 'admin.php?page=' . getParams('page');
        //filter status
        if (!empty(getParams('filter_group'))) {
            if (getParams('filter_group') >= -1) {
                $url .= '&filter_group=' . getParams('filter_group');
            }
        }
        //filter status
        if (!empty(getParams('filter_industry'))) {
            if (getParams('filter_industry') >= -1) {
                $url .= '&filter_industry=' . getParams('filter_industry');
            }
        }
        //search
        if (mb_strlen(getParams('s'))) {
            $url .= '&s=' . getParams('s');
        }
        return $url;
    }

/**
 * =================================================
 * CAC CHUC NANG THEM XOA SUA VA HIEN THI
 * =================================================
 */
    //hien thi trang
    public function displayPage() {
        //loc du lieu khi action = -1
        //nghia la dang lỗi du lieu (cho ca search và filter)
        if(getParams('action') == -1) {
            $url = $this->createUrl();
            wp_redirect($url);
        }

        //nên tách html va code wordpress để dễ quản lý
        require_once(DIR_VIEW . 'admin-view-member-view.php');
    }

    public function model() {
        require_once(DIR_MODEL . 'admin-model-member.php');
        $model = new Admin_Model_Member();
        return $model;
    }

    public function model_F() {
        require_once(DIR_MODEL . 'admin-model-member-function.php');
        $model = new Admin_Model_Member_Function();
        return $model;
    }

    //them moi item
    public function addAction() {
        //kiem tra phuong thuc GET hay POST
        if(isPost()) {
            $arr = array('action' => 'insert');
            $this->model_F()->saveItem($_POST,$arr); 
            goback();
        }
        //show phần form dữ liệu
        require_once(DIR_VIEW . 'admin-view-member-form.php');
    }

    //sua item
    public function editAction() {
        /**
         * Hàm isPost() dùng kiểm tra dữ liệu chuyển sang bằng dạng POST hay GET
         * Khi mới show trang ở dạng GET chỉ thực hiện việc show dữ liệu
         * Khi được Submit là ở dạng POST phải update hoặc insert dữ liệu
         */
        if(isPost()) {
            $arr = array('action' => 'update', 'ID' => getParams('id'));
            $this->model_F()->saveItem($_POST, $arr);
            goback(); 
        }
        //show phần form dữ liệu
        require_once(DIR_VIEW . 'admin-view-member-form.php');
    }

    //bo chon item
    public function uncheckinAction() {
        $arrParams = getParams();
        $this->model()->uncheckinItem($arrParams);
        if ($arrParams['check'] == 0 && !is_array($arrParams['id'])) {
            $this->model()->checkin($arrParams);
        }
        goback();
    }

    //xoa item
    public function deleteAction() {
        $this->model_F()->deleteItem(getParams());
        goback();
    }

    //khoi phuc item
    public function restoreAction() {
        $this->model_F()->restoreItem(getParams());
        goback();
    }

    //trash item
    public function trashAction() {
        $this->model_F()->trashItem(getParams());
        goback();
    }
}