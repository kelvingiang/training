<?php
$uri = $_SERVER['REQUEST_URI'];  // lay url tai trang hien hanh
// ======KIEM TRA INPUT BANG FUNCTION DUOC VIET TAI FILE RECRUIT==========
$r_error = array();
$status = 'on';
$loginID = $_SESSION['login_id'];

// ================ LAY GIA TRI TIN DA DANG DE EDIT===========================
if (isset($_GET['id'])) {

    $getID = (int) $_GET['id'];
    $arrArgs = array(
        'post_type' => 'recruitment',
        'post__in' => array($getID),
    );
    $objRec = current(get_posts($arrArgs));
    $postMeta = get_post_meta($objRec->ID); // lay cac gia tri trong meta

    $r_id = $_GET['id'];
    $r_title = get_the_title($objRec->ID); // lay title
    $status = $postMeta['_recruit_status'][0];
    $r_fullname = $postMeta['_recruit_fullname'][0];
    $r_birthday = $postMeta['_recruit_birthday'][0];
    $r_sex = $postMeta['_recruit_sex'][0];
    $r_address = $postMeta['_recruit_address'][0];
    $r_email = $postMeta['_recruit_email'][0];
    $r_phone = $postMeta['_recruit_phone'][0];
    $r_level = $postMeta['_recruit_level'][0];
    $r_experience = $postMeta['_recruit_experience'][0];
    $r_another = $postMeta['_recruit_another'][0];
    // add new 09/04/2020
    $r_height = $postMeta['_recruit_height'][0];
    $r_department = $postMeta['_recruit_department'][0];
    $r_work = $postMeta['_recruit_work'][0];
    $r_job = $postMeta['_recruit_job'][0];
    $r_salary = $postMeta['_recruit_salary'][0];
    $r_industry = $postMeta['_recruit_industry'][0];
    $r_language = $postMeta['_recruit_language'][0];
    $r_license = $postMeta['_recruit_license'][0];
    $r_software = $postMeta['_recruit_software'][0];
    $r_drive = $postMeta['_recruit_drive'][0];
    $r_line = $postMeta['_recruit_line'][0];
    $m_img = get_post_meta($loginID, 'm_img', true);
} else {
    // LAY GIA TRI CAN BAN CUA THANH VIEN GAN VAO KHONG TAO MOI
    $r_fullname = get_post_meta($loginID, 'm_fullname', true);
    $r_birthday = get_post_meta($loginID, 'm_birthdate', true);
    $r_address = get_post_meta($loginID, 'm_address', true);
    $r_email = get_post_meta($loginID, 'm_email', true);
    $r_phone = get_post_meta($loginID, 'm_phone', true);
    $r_sex = get_post_meta($loginID, 'm_sex', true);
    $m_img = get_post_meta($loginID, 'm_img', true);
}

//======== INSERT DATE  TO DATABASE========================================
if ($_POST & !isset($_GET['id'])) {

    //======== INSERT NEW INFO TO DATABASE========================================
    //  echo 'loi'.$r_error;
    if (empty($r_error)) {
        $catePost = 9; // SO ID CUA CATEGORY
        $cat = array($catePost);
        //    $editor_settings = Common::$_wpeditor;
        $newRecruit = array(
            'post_title' => esc_attr($_POST['txt_title']),
            'post_content' => $_POST['another'],
            'post_category' => $cat,
            'post_status' => 'publish',
            'post_type' => 'recruitment'
        );
        //add post moi
        $recMeta = wp_insert_post($newRecruit);
        // them catetegory cho post
        wp_set_object_terms($recMeta, $cat, 'recruitment_category');
        // Save phan metabox active //
        recruitmentMetaBox($recMeta, $_POST);
        // insertt xong xao trang cac gia tri input
        $status = "";
        $r_title = "";
        $r_fullname = "";
        $r_birthday = "";
        $r_sex = "";
        $r_address = "";
        $r_email = "";
        $r_phone = "";
        $r_level = "";
        $r_experience = "";
        $r_another = "";
        // add new 09/04/2020
        $r_height = "";
        $r_department = "";
        $r_work = "";
        $r_job = "";
        $r_salary = "";
        $r_industry = "";
        $r_language = "";
        $r_license = "";
        $r_software = "";
        $r_drive = "";
        if (empty($r_error)) {
            wp_redirect(esc_url(remove_query_arg('id', $uri))); // PHAN NAY XOA ID TRAN URL VA CHAN KHONG CO INSERT KHI  REFRESH
        }
    }
}
//}
//======== UPDATE DATE  TO DATABASE========================================
if ($_POST & isset($_GET['id'])) {

    $postID = $_POST['hid_id'];
    $arrUpdate = array(
        'ID' => $postID,
        'post_title' => esc_attr($_POST['txt_title'])
    );

    wp_update_post($arrUpdate);
    $r_error = recruitmentMetaBox($postID, $_POST);
    if (empty($r_error)) {
        wp_redirect(esc_url(remove_query_arg('id', $uri)));
    }
}

// ================ XOA TIN DA DANG ===========================            
if (!$_GET['del'] == '') {
    wp_trash_post($_GET['del']);
    wp_redirect(esc_url(remove_query_arg('del', $uri)));
}

// ================ LAY VA TIN DA DANG BOI USER DANG NHAP===========================

?>
<div class="add_new_space">
    <form id="f_recruit_ungtuyen" method="post" action="#" enctype="multipart/form-data">
        <input type="hidden" id="hid_id" name="hid_id" value="<?php echo $r_id ?>" />

        <div class="row row-modify">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <label class="label-title" style="margin-right: 30px; font-weight: bold">
                    <?php _e('Active') ?>,
                </label>
                <input type="checkbox" name="chk_status" id="chk_status" <?php echo $status === 'on' ? 'checked' : ""; ?> />
            </div>
        </div>

        <div class="row row-modify">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label class="label-title">
                    <?php _e('Title_'); ?>
                </label>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" required name="txt_title" id="txt_title" value="<?php echo $r_title ?>">
            </div>
        </div>

        <div class="row  row-modify">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label class="label-title">
                    <?php _e('Full Name'); ?>
                </label>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" required name="txt_fullname" id="txt_fullname" value="<?php echo $r_fullname ?>">
            </div>
        </div>

        <div class="row row-modify">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <label class="label-title"><?php _e('Upload Image'); ?></label>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="file" name="file_upload" id="file_upload" accept="image/*" />
            </div>
            <div class='col-md-3 col-sm-3 col-xs-12'>
                <?php if (!empty($m_img)) { ?>
                    <img src="<?php echo PART_IMAGES_APPLY . $m_img ?>" width="100px" />
                <?php } ?>
            </div>
            <div class='col-md-2 col-sm-2 col-xs-12'>
                <?php foreach ($r_error as $va) { ?>
                    <label style="color: red"> <?php echo $va ?></label><br>
                <?php } ?>
            </div>
        </div>

        <div class="row row-modify">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label class="label-title" for="txt_birthday"><?php _e('Birth Of Date'); ?></label>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" maxlength="10" required class="MyDate" name="txt_birthday" id="txt_birthday" value="<?php echo $r_birthday ?>">
            </div>
        </div>

        <div class="row row-modify">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label class="label-title"><?php _e('Sex'); ?></label>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select id="sel_sex" name="sel_sex" class="selectmenu" style="width: 180px">
                    <option value="1" <?php echo $r_sex == 1 ? 'selected="selected"' : ''; ?>>
                        <?php _e('Male'); ?></option>
                    <option value="2" <?php echo $r_sex == 2 ? 'selected="selected"' : ''; ?>>
                        <?php _e('Female'); ?></option>
                </select>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <input type="checkbox" name="chk_drive" id=" chk_drive" <?php echo $r_drive == 'on' ? 'checked' : ''; ?> style=" margin-right: 10px">
                <label class="label-title"><?php _e('Driving License '); ?>,
                </label>
            </div>
        </div>

        <div class="row row-modify">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label class="label-title"><?php _e('Height and weight'); ?></label>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="txt_height" id="txt_height" value="<?php echo $r_height ?>">
            </div>
        </div>

        <div class="row row-modify">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label class="label-title"><?php _e('Address'); ?></label>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="txt_address" id="txt_address" value="<?php echo $r_address ?>">
            </div>
        </div>

        <div class="row row-modify">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label class="label-title"><?php _e('E-mail'); ?></label>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="email" class="form-control" name="txt_email" id="txt_email" value="<?php echo $r_email ?>">
            </div>
        </div>

        <div class="row row-modify">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label class="label-title"><?php _e('Phone'); ?></label>
            </div>
            <div class=" col-md-9 col-sm-9 col-xs-12">
                <input type="text" maxlength="20" class="form-control type-phone" name="txt_phone" id="txt_phone" value="<?php echo $r_phone ?>">
            </div>
        </div>

        <div class="row row-modify">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label class="label-title"><?php _e('Line ID'); ?></label>
            </div>
            <div class=" col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="txt_line" id="txt_line" value="<?php echo $r_line ?>">
            </div>
        </div>

        <div class="row row-modify">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label class="label-title"><?php _e('Education'); ?></label>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" maxlength="20" class="form-control" name="txt_level" id="txt_level" value="<?php echo $r_level ?>">
            </div>
        </div>

        <div class="row row-modify">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label class="label-title"><?php _e('School Department'); ?></label>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" maxlength="20" class="form-control" name="txt_department" id="txt_department" value="<?php echo $r_department ?>">
            </div>
        </div>


        <div class="row row-modify">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label class="label-title"><?php _e('Work Experiences'); ?></label>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="txt_experience" id="txt_experience" value="<?php echo $r_experience ?>">
            </div>
        </div>


        <div class="row  row-modify">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label class="label-title"><?php _e('The fastest working day'); ?></label>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" maxlength="10" class="MyDate" name="txt_work" id="txt_work" value="<?php echo $r_work ?>">
            </div>
        </div>

        <div class="row row-modify">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label class="label-title"><?php _e('Job Objective'); ?></label>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="txt_job" id="txt_job" value="<?php echo $r_job ?>">
            </div>
        </div>

        <div class="row row-modify">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label class="label-title"><?php _e('Expected Salary'); ?></label>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="txt_salary" id="txt_salary" value="<?php echo $r_salary ?>">
            </div>
        </div>

        <div class="row row-modify">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label class="label-title"><?php _e('The industry wants to work'); ?></label>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="txt_industry" id="txt_industry" value="<?php echo $r_industry ?>">
            </div>
        </div>

        <div class="row row-modify">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label class="label-title"><?php _e('Languages Proficiency'); ?></label>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="txt_language" id="txt_language" value="<?php echo $r_language ?>">
            </div>
        </div>

        <div class="row row-modify">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label class="label-title"><?php _e('Certificates or Licenses'); ?></label>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="txt_license" id="txt_license" value="<?php echo $r_license ?>">
            </div>
        </div>

        <div class="row row-modify">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label class="label-title"><?php _e('Skills'); ?></label>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="txt_software" id="txt_software" value="<?php echo $r_software ?>">
            </div>
        </div>

        <div class="row row-modify">
            <div class=" col-md-3 col-sm-3 col-xs-12">
                <label class="label-title"><?php _e('Autobiography'); ?></label>
            </div>
            <!--  phan su dung ckeditor chua duoc      -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <textarea id="another" name="another" style="min-height: 300px">
                            <?php echo $r_another ?>
                        </textarea>
                <script>
                    var editor = CKEDITOR.replace('another', {
                        customConfig: 'custom-config_no-img.js'
                    });
                    CKFinder.setupCKEditor(another, '<?php echo PART_CLASS . 'ckfinder/' ?>');
                </script>
            </div>
        </div>

        <div style=" text-align: center; padding: 25px">
            <div class="btn-space" style="margin-top: 2rem">
                <input id="btn-submit" type="submit" class="btn-my" value="<?php echo isset($_GET['id']) ? _e('Update') : _e('Submit_'); ?>" />
                <?php if (isset($_GET['id'])) { ?>
                    <input id="btn_reset" type="reset" class="btn-my" value="<?php _e('Cancel'); ?>" onclick="javascript:window.location = '<?php echo home_url('recruit/?dt=1') ?>';" />
                <?php } else { ?>
                    <input id="btn-reset" type="reset" class="btn-my" value='<?php _e('Reset'); ?>' />
                <?php } ?>
            </div>
        </div>
    </form>
</div>



<?php
// PHAN LAY PARAM CUA URL CHUYEN CHO JAVASCRIPT DE TAO HIEU UNG SCROLL
if (isset($_GET['id'])) {
    $getid = $_GET['id'];
} else {
    $getid = 001;
}
?>