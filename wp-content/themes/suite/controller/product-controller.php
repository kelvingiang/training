<?php

class Product_Controller {
    public function __construct() {
        add_action('admin_menu', array($this, 'AddToMenu'));
    }

    public function AddToMenu() {
        // THEM 1 NHOM MENU MOI VAO TRONG ADMIN MENU
        $page_title = __('Product'); // TIEU DE CUA TRANG 
        $menu_title = __('Product');  // TEN HIEN TRONG MENU
// CHON QUYEN TRUY CAP manage_categories DE role ADMINNITRATOR VÀ EDITOR DEU THAY DUOC
        $capability = 'manage_categories'; // QUYEN TRUY CAP DE THAY MENU NAY
        $menu_slug = 'page_product'; // TEN slug TEN DUY NHAT KO DC TRUNG VOI TRANG KHAC GAN TREN THANH DIA CHI OF MENU
// THAM SO THU 5 GOI DEN HAM HIEN THI GIAO DIEN TRONG MENU
        $icon = PART_ICON . 'link-icon.png';  // THAM SO THU 6 LA LINK DEN ICON DAI DIEN
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
        if (!empty(getParams('filter_branch'))) {
            if (getParams('filter_branch') >= -1) {
                $url .= '&filter_branch=' . getParams('filter_branch');
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
        require_once(DIR_VIEW . 'product_view.php');
    }

    public function model() {
        require_once(DIR_MODEL . 'product_model.php');
        $model = new Product_Model();
        return $model;
    }

    public function model_function() {
        require_once(DIR_MODEL . 'product_model_function.php');
        $model = new Product_Model_Function();
        return $model;
    }

    //them moi item
    public function addAction() {
        //kiem tra phuong thuc GET hay POST
        if(isPost()) {
            $arr = array('action' => 'insert');
            $this->model_function()->saveItem($_POST,$arr); 
            goback();
        }
        //show phần form dữ liệu
        require_once(DIR_VIEW . 'product_form.php');
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
            $this->model_function()->saveItem($_POST, $arr);
            goback(); 
        }
        //show phần form dữ liệu
        require_once(DIR_VIEW . 'product_form.php');
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
        $this->model_function()->deleteItem(getParams());
        goback();
    }

    //khoi phuc item
    public function restoreAction() {
        $this->model_function()->restoreItem(getParams());
        goback();
    }

    //trash item
    public function trashAction() {
        $this->model_function()->trashItem(getParams());
        goback();
    }
}