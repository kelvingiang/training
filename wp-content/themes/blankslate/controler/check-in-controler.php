<?php

class Check_In_Controler {

    public function __construct() {
        add_action('admin_menu', array($this, 'AddToMenu'));
    }

    public function AddToMenu() {
        // THEM 1 NHOM MENU MOI VAO TRONG ADMIN MENU
        $page_title = __('Check In System'); // TIEU DE CUA TRANG 
        $menu_title = __('Check In System');  // TEN HIEN TRONG MENU
// CHON QUYEN TRUY CAP manage_categories DE role ADMINNITRATOR VÀ EDITOR DEU THAY DUOC
        $capability = 'manage_categories'; // QUYEN TRUY CAP DE THAY MENU NAY
        $menu_slug = 'page_check_in'; // TEN slug TEN DUY NHAT KO DC TRUNG VOI TRANG KHAC GAN TREN THANH DIA CHI OF MENU
// THAM SO THU 5 GOI DEN HAM HIEN THI GIAO DIEN TRONG MENU
        $icon = PART_ICON . 'staff-icon.png';  // THAM SO THU 6 LA LINK DEN ICON DAI DIEN
        $position = 9; // VI TRI HIEN THI TRONG MENU

        add_menu_page($page_title, $menu_title, $capability, $menu_slug, array($this, 'dispatchActive'), $icon, $position);
    }

    // Phan dieu huong 
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

    public function createUrl() {
        echo $url = 'admin.php?page=' . getParams('page');
        if (mb_strlen(getParams('s'))) {
            $url .= '&s=' . getParams('s');
        }
        return $url;
    }

    public function model() {
        require_once (DIR_MODEL . 'check_in_model.php');
        $model = new Check_In_Model();
        return $model;
    }

//---------------------------------------------------------------------------------------------
// Cmt CAC CHUC NANG THEM XOA SUA VA HIEN THI
//---------------------------------------------------------------------------------------------
// CAC DISPLAY PAGE
    public function displayPage() {
// LOC DU LIEU KHI action = -1 CO NGHIA LA DANG LOI DU LIEU (CHO 2 TRUONG HOP search va filter)
        if (getParams('action') == -1) {
            $url = $this->createUrl();
            wp_redirect($url);
        }
// NEN TACH ROI HTML VA CODE WP RA CHO DE QUAN LY
        require_once (DIR_VIEW . 'check_in_view.php');
    }

// THEM MOI ITEM
    public function addAction() {
// KIEM TRA PHUONG THUC GET HAY POST
        if (isPost()) {
            $arr = array('action' => 'insert');
            $this->model()->saveItem($_POST, $arr);
            goback();
        }
        require_once( DIR_VIEW . '/check_in_from.php');
    }

// EDIT
    public function editAction() {
// HAM isPost() DUNG KIEM TRA DU  LIEU CHUYEN SANG BANG DANG post HAY get
// KHI MOI SHOW TRANG RA O DANG GET CHI THUC HIEN VIEC SHOW DU LIEU
// KHI DC SUBMIT LA O DANG POST PHAI update HAY insert DU LIEU
        if (isPost()) {
            $arr = array('action' => 'update', 'ID' => getParams('id'));
            $this->model()->saveItem($_POST, $arr);
        } 
//SHOW PHAN FORM DU LIEU
        require_once( DIR_VIEW . '/check_in_from.php');
    }

//CHECK IN
    public function uncheckinAction() {
        $arrParams = getParams();
        if ($arrParams['check'] == 0 && !is_array($arrParams['id'])) {
            $this->model()->checkinItem($arrParams, 'check');
        } else {
            $this->model()->checkinItem($arrParams, 'uncheck');
        }
        goback();
    }

// XOA DU LIEU
    public function deleteAction() {
        $this->model()->deleteItem(getParams());
        goback();
    }

// RESTORE
    public function restoreAction() {
        $this->model()->restoreItem(getParams());
        goback();
    }

// TRASH    
    public function trashAction() {
        $this->model()->trashItem(getParams());
        goback();
    }

}
