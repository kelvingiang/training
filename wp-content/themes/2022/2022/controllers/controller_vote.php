<?php
require_once(DIR_MODEL . 'model_vote.php');
class Admin_Controller_Vote
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'Create'));
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    }

    public function Create()
    {
        // THEM 1 NHOM MENU MOI VAO TRONG ADMIN MENU
        $page_title = __('Voting System'); // TIEU DE CUA TRANG 
        $menu_title = __('Voting System');  // TEN HIEN TRONG MENU
        // CHON QUYEN TRUY CAP manage_categories DE role ADMINNITRATOR VÀ EDITOR DEU THAY DUOC
        $capability = 'manage_categories'; // QUYEN TRUY CAP DE THAY MENU NAY
        $menu_slug = 'vote'; // TEN slug TEN DUY NHAT KO DC TRUNG VOI TRANG KHAC GAN TREN THANH DIA CHI OF MENU
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
            case 'edit':
                $this->addAction();
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
        require_once(DIR_VIEW . 'view_vote.php');
    }

    // THEM MOI ITEM
    public function addAction()
    {
        $action = $_GET['action'];
        // KIEM TRA PHUONG THUC GET HAY POST
        if (isPost()) {
            $model = new Admin_Model_Vote();
            $errors = array();
            $fileName = $_POST['hid_img'];

            if (!empty($_FILES['vote_img']['name'])) {
                // XOA FILE DINH KEM SAU KHI GOI
                if (!empty($_POST['hid_img'])) {
                    unlink(DIR_IMAGES_VOTE . $_POST['hid_img']);
                }
                $file_size = $_FILES['vote_img']['size'];
                $file_tmp = $_FILES['vote_img']['tmp_name'];

                $file_trim = ((explode('.', $_FILES['vote_img']['name'])));
                $trim_type = strtolower($file_trim[1]);

                $extensions = array("jpg", "png", "jpeg", "gif", "pdf");
                if (in_array($trim_type, $extensions) === false) {
                    $errors[] = "上傳照片檔案是 JPEG , PNG , BMP.";
                }
                if ($file_size > 20097152) {
                    $errors[] = '上傳檔案容量不可大於 2 MB';
                }

                if (empty($errors)) {
                    $fileName = date('ymdhis') . '.' . @$trim_type;
                    move_uploaded_file(@$file_tmp, (DIR_IMAGES_VOTE . $fileName));
                }
            }

            $model->saveItem($_POST, $fileName, array('action' => $action));

          //  ToBack();
        }
        require_once(DIR_VIEW . 'from_vote.php');
        //require_once( DIR_VIEW . 'test.php');
    }

    public function uncheckinAction()
    {
        $model = new Admin_Model_Vote();
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
        $model = new Admin_Model_Vote();
        $model->deleteItem(getParams());

        ToBack();
    }

    public function restoreAction()
    {
        $model = new Admin_Model_Vote();
        $model->restoreItem(getParams());
        ToBack();
    }

    public function trashAction()
    {
        $model = new Admin_Model_Vote();
        $model->trashItem(getParams());
        // TRA VE TRANG MAC DINH
        ToBack();
    }
}
