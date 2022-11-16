<?php
require_once(DIR_MODEL . 'model_download.php');
class Admin_Controller_Download
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'create'));
    }

    public function create()
    {
        // THEM 1 NHOM MENU MOI VAO TRONG ADMIN MENU
        $page_title =  __('Bulletin'); // TIEU DE CUA TRANG 
        $menu_title = __('Bulletin');  // TEN HIEN TRONG MENU
        // CHON QUYEN TRUY CAP manage_categories DE role ADMINNITRATOR VÀ EDITOR DEU THAY DUOC
        $capability = 'manage_categories'; // QUYEN TRUY CAP DE THAY MENU NAY
        $menu_slug = 'tw_download'; // TEN slug TEN DUY NHAT KO DC TRUNG VOI TRANG KHAC GAN TREN THANH DIA CHI OF MENU
        // THAM SO THU 5 GOI DEN HAM HIEN THI GIAO DIEN TRONG MENU
        $icon = PART_ICON . 'schedule16x16.png';  // THAM SO THU 6 LA LINK DEN ICON DAI DIEN
        $position = 16; // VI TRI HIEN THI TRONG MENU

        add_menu_page($page_title, $menu_title, $capability, $menu_slug, array($this, 'dispatchActive'), $icon, $position);
    }

    // Phan dieu huong 
    public function dispatchActive()
    {
        $action = getParams('action');
        switch ($action) {
            case 'add':
            case 'edit':
                $this->saveAction();
                break;
            case 'trash':
            case 'restore':
                $this->trashAction();
                break;
            case 'delete':
                $this->deteleAction();
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
        if (getParams('filter_status') != '0') {
            $url .= '&filter_status=' . getParams('filter_status');
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
        require_once(DIR_VIEW . 'view_download.php');
    }

    // INSERT OR UPDATE DATE
    public function saveAction()
    {
        // HAM isPost() DUNG KIEM TRA DU  LIEU CHUYEN SANG BANG DANG post HAY get
        // KHI MOI SHOW TRANG RA O DANG GET CHI THUC HIEN VIEC SHOW DU LIEU
        // KHI DC SUBMIT LA O DANG POST PHAI update HAY insert DU LIEU
        if (isPost()) {
            $fileName = $_POST['hid_file'];
            if (!empty($_FILES['file_upload']['name'])) {
                $fileName = uploadFileDownLoad($_FILES, $fileName);
            }

            $fileImg = $_POST['hid_img'];
            if (!empty($_FILES['img_upload']['name'])) {
                $fileImg = uploadImg($_FILES, $fileImg);
            }

            // KHI HET LOI SE update DU LIEU VAO DATABASE
            //require_once(DIR_MODEL . '/download_model.php');
            // GOI DE function save_item DE UPDATE DU LLEU
            $action = getParams('action');
            $model = new Admin_Model_Download();
            $model->save_item($_POST, $fileName, $fileImg, $action);

            ToBack();
        }
        //SHOW PHAN FORM DU LIEU
        require_once(DIR_VIEW . 'from_download.php');
    }

    // TO TRASH OR RESTORE
    public function trashAction()
    {
        $arrParam = getParams();

        // GOI DEN MODEL 
        require_once(DIR_MODEL . 'model_download.php');
        $model = new Admin_Model_Download();
        $model->toTrash($arrParam, $arrParam['action']);
        ToBack();
    }

    // DELETE DATA
    public function deteleAction()
    {
        $arrParam = getParams();
        $model = new Admin_Model_Download();
        $model->deleteItem($arrParam);
        ToBack();
    }
}
