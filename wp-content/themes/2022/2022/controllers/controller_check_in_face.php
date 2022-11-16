<?php
require_once(DIR_MODEL . 'model_check_in_setting.php');

class Admin_Controller_Check_In_Face
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'Create'));
    }

    // PHAN TAO MENU CON TRONG MENU CHA CUNG LA POST TYPE
    public function Create()
    {
        $parent_slug = 'tw_checkin';
        $page_title = __('Check In Face Recognition');
        $menu_title = __('Check In Face Recognition');
        $capability = 'manage_categories';
        $menu_slug = 'checkinface';
        $position = 18;
        //$icon = PART_ICON . '/staff-icon.png';  // THAM SO THU 6 LA LINK DEN ICON DAI DIEN
        add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, array($this, 'dispatchActive'), $position);
    }

    public function dispatchActive()
    {
        //        echo __METHOD__;
        $action = getParams('action');
        switch ($action) {
            case 'import_face':
                $this->ImportFaceAction();
                break;
            default:
                $this->displayPage();
                break;
        }
    }

    public function displayPage()
    {
        if (isPost()) {
            $this->ImportFaceAction();
        }
        require_once(DIR_VIEW . 'view_check_in_face.php');
    }



    // Import Group Function 
    public function ImportFaceAction()
    {
        //if (isPost()) {
        $errors = array();
        $file_name = $_FILES['file-face']['name'];
        $file_size = $_FILES['file-face']['size'];
        $file_tmp = $_FILES['file-face']['tmp_name'];
        $file_type = $_FILES['file-face']['type'];

        $file_trim = ((explode('.', $_FILES['file-face']['name'])));
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
            require_once(DIR_MODEL . 'model_check_in_setting.php');
            $model = new Admin_Model_Check_In_Setting();
            $model->ImportFace($excelList);

            //ToBack();
        }
        //  }
        //require_once(DIR_VIEW . 'view_guests_import.php');
    }
}
