<?php
require_once(DIR_MODEL . 'model_schedule.php');
class Admin_Controller_Schedule
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'Create'));
    }

    public function Create()
    {
        // THEM 1 NHOM MENU MOI VAO TRONG ADMIN MENU
        $page_title = __('Calendars'); // TIEU DE CUA TRANG 
        $menu_title = __('Calendars');  // TEN HIEN TRONG MENU
        // CHON QUYEN TRUY CAP manage_categories DE role ADMINNITRATOR VÀ EDITOR DEU THAY DUOC
        $capability = 'manage_categories'; // QUYEN TRUY CAP DE THAY MENU NAY
        $menu_slug = 'tw_schedule'; // TEN slug TEN DUY NHAT KO DC TRUNG VOI TRANG KHAC GAN TREN THANH DIA CHI OF MENU
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
                $this->addAction();
                break;
            case 'edit':
                $this->editAction();
                break;
            case 'delete':
                $this->deleteAction();
                break;
            case 'sendMail':
                $this->sendMailAction();
                break;
            case 'trash':
            case 'restore':
                $this->statusAction();
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
        require_once(DIR_VIEW . 'view_schedule.php');
    }

    // THEM MOI ITEM
    public function addAction()
    {

        // KIEM TRA PHUONG THUC GET HAY POST
        if (isPost()) {

            // KHI POST KIEM TRA LOI NHAP LIEU
            $validates = getValidate('schedule');
            if ($validates->isValidate() == FALSE) {
                if (getParams('security_code') != ' ') {
                    //echo '</br> HIEN THI THONG BAO ERROR';
                    $error = $validates->getFormError();
                    $data = $validates->getFormdata();
                }
            } else {
                // die('sss');
                // HET LOI insert DU LIEU VAO database
                // echo '</br>CAP NHAT VAO DATABASE';
                $formaData = $validates->getFormdata();

                $save = new Admin_Model_Schedule();
                $save->save_item($formaData);
                //   $page = getParams('page');
                //  $linkSendMail = admin_url('admin.php?page=' . $page . '&action=sendMail');
                // $linkBack = admin_url('admin.php?page=' . $page);
                // SESION NAY TAI DE LAY DATA SEND MAIL CHO CAC THANH VIEN
                // $_SESSION['sendMailContent'] = $formaData;
                //  if (!isset($_GET['send'])) {
?>
                <!--                    <script type="text/javascript">
                        if (confirm("此內容是否寄Email給會員們!") === true) {
                            //   jQuery.cookie('send-mail', null, {expires: -1});
                            //  jQuery.cookie('send-mail', 'true');
                            window.location.replace("<? php // echo $linkSendMail 
                                                        ?>")
                        } else {
                            window.location.replace("<? php // echo $linkBack 
                                                        ?>")
                            //   jQuery.cookie('send-mail', null, {expires: -1});
                            //   jQuery.cookie('send-mail', 'flase');
                        }
                        //window.location.reload();
                        // location.reload();
                        console.log(jQuery.cookie('send-mail'));
                    </script>-->
            <?php
                //  }

                // SAU KHI INSERT XONG CHUYEN VE TRANG SHOW
                //    $url = 'admin.php?page=' . $_REQUEST['page'] . '&msg=1';
                //   wp_redirect($url);
            }
        }
        require_once(DIR_VIEW . 'from_schedule.php');
        //require_once( DIR_VIEW . 'test.php');
    }

    // EDIT SCHEDULE
    public function editAction()
    {
        // HAM isPost() DUNG KIEM TRA DU  LIEU CHUYEN SANG BANG DANG post HAY get
        // KHI MOI SHOW TRANG RA O DANG GET CHI THUC HIEN VIEC SHOW DU LIEU
        // KHI DC SUBMIT LA O DANG POST PHAI update HAY insert DU LIEU
        if (isPost()) {
            // DA SEND DATA POST
            // GOI FUNCTION isValidate DE KIEM TRA LOI DU LIEU NHAP VAO
            // NEU CO LOI THONG BAO DANG LOI textbox SE BI RONG,  CAC textbox CO DU LIEU DUNG SE DC GIU LAI
            $validates = getValidate('schedule');
            if ($validates->isValidate() == FALSE) {
                if (getParams('security_code') != ' ') {
                    $error = $validates->getFormError();
                    $data = $validates->getFormdata();
                }
            } else {
                // KHI HET LOI SE update DU LIEU VAO DATABASE
                $formaData = $validates->getFormdata();
                // GOI DE function save_item DE UPDATE DU LLEU
                $save = new Admin_Model_Schedule();
                $save->save_item($formaData);
                // PHAN DIEU KIEN SEND MAIL
                // $page = getParams('page');
                //  $linkSendMail = admin_url('admin.php?page=' . $page . '&action=sendMail');
                //  $linkBack = admin_url('admin.php?page=' . $page);
                //  $_SESSION['sendMailContent'] = $formaData;
                // if (!isset($_GET['send'])) {
            ?>
                <!--                   <script type="text/javascript">
                    //    if (confirm("此內容是否寄Email給會員們!") === true) {
                            //   jQuery.cookie('send-mail', null, {expires: -1});
                            //  jQuery.cookie('send-mail', 'true');
                            window.location.replace("<?php  //echo $linkSendMail 
                                                        ?>");
                        } else {
                            window.location.replace("<?php //echo $linkBack 
                                                        ?>");
                            //   jQuery.cookie('send-mail', null, {expires: -1});
                            //   jQuery.cookie('send-mail', 'flase');
                        }
                        //window.location.reload();
                        // location.reload();
                        console.log(jQuery.cookie('send-mail'));
                    </script>-->
<?php
                //                }
                // SAU KHI UPDATE XONG CHUYEN VE TRANG SHOW
                //   $url = 'admin.php?page=' . $_REQUEST['page'] . '&msg=1';
                // wp_redirect($url);
            }
        } else {
            // CHUA SUBMIT DATA GET
            //   echo 'phuong thuc get';
            $getID = new Admin_Model_Schedule();
            $data = $getID->get_item(getParams());  // bien data nay chuyen chuyen du lieu sang trang form va do du lieu vao cac textbox 
        }
        //SHOW PHAN FORM DU LIEU
        require_once(DIR_VIEW . 'from_schedule.php');
    }

    // XOA DU LIEU
    public function deleteAction()
    {


        $model = new Admin_Model_Schedule();
        $model->deleteItem(getParams());
        ToBack();
    }

    public function statusAction()
    {
        $model = new Admin_Model_Schedule();
        $model->changeStatus(getParams());
        ToBack();
    }

    public function sendMailAction()
    {
        $model = new Admin_Model_Schedule();
        // SESION DUOC TAO TREN HAM addAction
        $model->sendMail($_SESSION['sendMailContent']);
    }
}
