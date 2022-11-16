<?php
require_once(DIR_MODEL . 'model_check_in_setting.php');

class Admin_Controller_Check_In_Setting
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'Create'));
    }

    // PHAN TAO MENU CON TRONG MENU CHA CUNG LA POST TYPE
    public function Create()
    {
        $parent_slug = 'tw_checkin';
        $page_title = __('Check In Setting');
        $menu_title = __('Check In Setting');
        $capability = 'manage_categories';
        $menu_slug = 'checkinsetting';
        // $icon = PART_ICON . '/staff-icon.png';  // THAM SO THU 6 LA LINK DEN ICON DAI DIEN
        $position = 18;
        add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, array($this, 'dispatchActive'), $position);
    }

    public function dispatchActive()
    {
        //        echo __METHOD__;
        $action = getParams('action');
        switch ($action) {
            case 'export_checkin':
                $this->ExportCheckInAction();
                break;
            case 'export_member_post':
                $this->ExportMemberPostAction();
                break;
            case 'export_member_table':
                $this->ExportMemberTableAction();
                break;
            case 'export_guests':
                $this->ExportGuestsAction();
                break;
            case 'import_guests':
                $this->ImportGuestsAction();
                break;
            case 'import_guests_info':
                $this->ImportGuestsInfoAction();
                break;
            case 'import_member':
                $this->ImportMemberAction();
                break;
            case 'reset_checkin':
                $this->ResetCheckInAction();
                break;
            case 'create_qrcode':
                $this->CreateQRCodeAction();
                break;
            case 'create_qrcode_name':
                $this->CreateNameQRCodeAction();
                break;
            case 'create_qrcode_register':
                $this->CreateRegisteredQRCodeAction();
                break;
            default:
                $this->displayPage();
                break;
        }
    }

    public function displayPage()
    {
        require_once(DIR_VIEW . 'view_check_in_setting.php');
    }

    // Export Group Function
    public function ExportCheckInAction()
    {
        $model = new Admin_Model_Check_In_Setting();
        $model->ExCheckInToExcel();
    }

    public function ExportMemberPostAction()
    {
        $model = new Admin_Model_Check_In_Setting();
        $model->ExportMemberPost();
    }

    public function ExportMemberTableAction()
    {
        $model = new Admin_Model_Check_In_Setting();
        $model->ExportMemberTable();
    }

    public function ExportGuestsAction()
    {
        $model = new Admin_Model_Check_In_Setting();
        $model->ExportGuests();
    }

    // Import Group Function 

    public function ImportGuestsInfoAction()
    {
        if (isPost()) {
            $errors = array();
            $file_name = $_FILES['myfile']['name'];
            $file_size = $_FILES['myfile']['size'];
            $file_tmp = $_FILES['myfile']['tmp_name'];
            $file_type = $_FILES['myfile']['type'];

            $file_trim = ((explode('.', $_FILES['myfile']['name'])));
            $trim_name = strtolower($file_trim[0]);
            $trim_type = strtolower($file_trim[1]);
            //$name = $_SESSION['login'];
            // $cus_name = 'avatar-'.$name . '.' . $trim_type;  //tao name moi cho file tranh trung va mat file

            $extensions = array("xls", "xlsx");
            if (in_array($trim_type, $extensions) === false) {
                $errors[] = "extension not allowed, please choose a excel file.";
            }
            if ($file_size > 20097152) {
                $errors[] = 'File size must be excately 20 MB';
            }
            if (empty($errors)) {
                $path = DIR_FILE;
                move_uploaded_file($file_tmp, ($path . $file_name));

                $excelList = $path . $file_name;
                // require_once(DIR_MODEL . 'model_check_in_setting.php');
                $model = new Admin_Model_Check_In_Setting();
                $model->ImportGuestsUpdateInfo($excelList);

                ToBack();
            }
        }
        require_once(DIR_VIEW . 'view_guests_import.php');
    }

    public function ImportGuestsAction()
    {
        if (isPost()) {
            $errors = array();
            $file_name = $_FILES['myfile']['name'];
            $file_size = $_FILES['myfile']['size'];
            $file_tmp = $_FILES['myfile']['tmp_name'];
            $file_type = $_FILES['myfile']['type'];

            $file_trim = ((explode('.', $_FILES['myfile']['name'])));
            $trim_name = strtolower($file_trim[0]);
            $trim_type = strtolower($file_trim[1]);
            //$name = $_SESSION['login'];
            // $cus_name = 'avatar-'.$name . '.' . $trim_type;  //tao name moi cho file tranh trung va mat file

            $extensions = array("xls", "xlsx");
            if (in_array($trim_type, $extensions) === false) {
                $errors[] = "extension not allowed, please choose a excel file.";
            }
            if ($file_size > 20097152) {
                $errors[] = 'File size must be excately 20 MB';
            }
            if (empty($errors)) {
                $path = DIR_FILE;
                move_uploaded_file($file_tmp, ($path . $file_name));

                $excelList = $path . $file_name;
                // require_once(DIR_MODEL . 'model_check_in_setting.php');
                $model = new Admin_Model_Check_In_Setting();
                $model->ImportGuests($excelList);

                ToBack();
            }
        }
        require_once(DIR_VIEW . 'view_guests_import.php');
    }


    public function ImportMemberAction()
    {
        if (isPost()) {
            $errors = array();
            $file_name = $_FILES['myfile']['name'];
            $file_size = $_FILES['myfile']['size'];
            $file_tmp = $_FILES['myfile']['tmp_name'];
            $file_type = $_FILES['myfile']['type'];

            $file_trim = ((explode('.', $_FILES['myfile']['name'])));
            $trim_name = strtolower($file_trim[0]);
            $trim_type = strtolower($file_trim[1]);
            //$name = $_SESSION['login'];
            // $cus_name = 'avatar-'.$name . '.' . $trim_type;  //tao name moi cho file tranh trung va mat file

            $extensions = array("xls", "xlsx");
            if (in_array($trim_type, $extensions) === false) {
                $errors[] = "extension not allowed, please choose a excel file.";
            }
            if ($file_size > 20097152) {
                $errors[] = 'File size must be excately 20 MB';
            }
            if (empty($errors)) {
                $path = DIR_FILE;
                move_uploaded_file($file_tmp, ($path . $file_name));

                $excelList = $path . $file_name;
                $model = new Admin_Model_Check_In_Setting();
                $model->ImportMember($excelList);

                $paged = max(1, getParams('paged'));
                $url = 'admin.php?page=' . 'checkinsetting' . '&paged=' . $paged . '&msg=1';
                //$url = 'admin.php?page=' . $_REQUEST['page'] . '&paged=' . $paged . '&msg=1';
                wp_redirect($url);
            }
        }
        require_once(DIR_VIEW . 'view_member_import.php');
    }

    // Create Group QRCode    
    public function ResetCheckInAction()
    {
        $model = new Admin_Model_Check_In_Setting();
        $model->ResetCheckIn();
        ToBack();
    }

    public function CreateQRCodeAction()
    {
        $model = new Admin_Model_Check_In_Setting();
        $model->create_QRCode();
        ToBack();
    }

    public function CreateNameQRCodeAction()
    {

        $model = new Admin_Model_Check_In_Setting();
        $model->create_name_QRCode();
        ToBack();
    }

    public function  CreateRegisteredQRCodeAction()
    {
        $model = new Admin_Model_Check_In_Setting();
        $model->create_registered_QRCode();
        ToBack();
    }
}
