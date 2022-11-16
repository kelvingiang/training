<?php
require_once(DIR_MODEL . 'model_check_in.php');

class Admin_Controller_Check_In
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'checkInToMenu'));
    }

    public function checkInToMenu()
    {
        // THEM 1 NHOM MENU MOI VAO TRONG ADMIN MENU
        $page_title = __('Check In System'); // TIEU DE CUA TRANG 
        $menu_title = __('Check In System');  // TEN HIEN TRONG MENU
        // CHON QUYEN TRUY CAP manage_categories DE role ADMINNITRATOR VÀ EDITOR DEU THAY DUOC
        $capability = 'manage_categories'; // QUYEN TRUY CAP DE THAY MENU NAY
        $menu_slug = 'tw_checkin'; // TEN slug TEN DUY NHAT KO DC TRUNG VOI TRANG KHAC GAN TREN THANH DIA CHI OF MENU
        // THAM SO THU 5 GOI DEN HAM HIEN THI GIAO DIEN TRONG MENU
        $icon = PART_ICON . 'staff-icon.png';  // THAM SO THU 6 LA LINK DEN ICON DAI DIEN
        $position = 17; // VI TRI HIEN THI TRONG MENU

        add_menu_page($page_title, $menu_title, $capability, $menu_slug, array($this, 'dispatchActive'), $icon, $position);
    }

    // Phan dieu huong 
    public function dispatchActive()
    {
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
            default:
                $this->displayPage();
                break;
        }
    }

    public function createUrl()
    {
        echo $url = 'admin.php?page=' . getParams('page');

        //filter_status
        if (getParams('filter_branch') != '0') {
            $url .= '&filter_branch=' . getParams('filter_branch');
        }

        if (mb_strlen(getParams('s'))) {
            $url .= '&s=' . getParams('s');
        }

        return $url;
    }

    //---------------------------------------------------------------------------------------------
    // Cmt CAC CHUC NANG THEM XOA SUA VA HIEN THI
    //---------------------------------------------------------------------------------------------
    // CAC DISPLAY PAGE
    public function displayPage()
    {
        // LOC DU LIEU KHI action = -1 CO NGHIA LA DANG LOI DU LIEU (CHO 2 TRUONG HOP search va filter)
        if (getParams('action') == -1) {
            $url = $this->createUrl();
            wp_redirect($url);
        }
        // NEN TACH ROI HTML VA CODE WP RA CHO DE QUAN LY
        require_once(DIR_VIEW . 'view_check_in.php');
    }

    // THEM MOI ITEM
    public function addAction()
    {

        // KIEM TRA PHUONG THUC GET HAY POST

        if (isPost()) {
            $model = new Admin_Model_Check_In();
            $model->saveItem($_POST);

            $paged = max(1, getParams('paged'));
            $url = 'admin.php?page=' . $_REQUEST['page'] . '&paged=' . $paged . '&msg=1';
            wp_redirect($url);
        }
        require_once(DIR_VIEW . 'from_check_in.php');
        //require_once( DIR_VIEW . 'test.php');
    }

    // EDIT SCHEDULE
    public function editAction()
    {
        // HAM isPost() DUNG KIEM TRA DU  LIEU CHUYEN SANG BANG DANG post HAY get
        // KHI MOI SHOW TRANG RA O DANG GET CHI THUC HIEN VIEC SHOW DU LIEU
        // KHI DC SUBMIT LA O DANG POST PHAI update HAY insert DU LIEU
        $model = new Admin_Model_Check_In();
        if (isPost()) {
            $model->saveItem($_POST);
        } else {
            // CHUA SUBMIT DATA GET
            //   echo 'phuong thuc get';
            $data = $model->get_item(getParams());   // bien data nay chuyen chuyen du lieu sang trang form va do du lieu vao cac textbox 
        }
        //SHOW PHAN FORM DU LIEU
        require_once(DIR_VIEW . 'from_check_in.php');
    }

    public function uncheckinAction()
    {
        $model = new Admin_Model_Check_In();
        $model->uncheckinItem(getParams());

        if (getParams('check') == 0 && !is_array(getParams('id'))) {
            $model->checkin(getParams());
        }
        // TRA VE TRANG MAC DINH
        ToBack();
    }

    // XOA DU LIEU
    public function deleteAction()
    {
        //$arrParam = getParams();
        $model = new Admin_Model_Check_In();
        $model->deleteItem(getParams());
        ToBack();
    }

    public function restoreAction()
    {

        $model = new Admin_Model_Check_In();
        $model->restoreItem(getParams());
        ToBack();
    }

    public function trashAction()
    {


        $model = new Admin_Model_Check_In();
        $model->trashItem(getParams());
        // TRA VE TRANG MAC DINH
        ToBack();
    }
}
