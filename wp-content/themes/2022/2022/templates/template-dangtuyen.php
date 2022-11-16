<?php
$uri = $_SERVER['REQUEST_URI'];  // lay url tai trang hien hanh
$status = 'on';

// LAY GIA TRI CUA BAI DANG GAN NHAT GAN VO BAI VIET MOI =====================================
$metaID = $myQuery->posts[0]->ID;
$com_company_tw = get_post_meta($metaID, '_recruit_company_tw', true);
$com_company_en = get_post_meta($metaID, '_recruit_company_en', true);
$com_company_vn = get_post_meta($metaID, '_recruit_company_vn', true);
$com_address = get_post_meta($metaID, '_recruit_address', true);
$com_phone = get_post_meta($metaID, '_recruit_phone', true);
$com_email = get_post_meta($metaID, '_recruit_email', true);
$com_count = get_post_meta($metaID, '_recruit_count', true);
$summary = get_post_meta($metaID, '_recruit_summary', true);
$contact_name = get_post_meta($metaID, '_recruit_contact_name', true);
$contact_phone = get_post_meta($metaID, '_recruit_contact_phone', true);
$contact_email = get_post_meta($metaID, '_recruit_contact_email', true);

//========== lay gia tri cap nhap  du lieu================================
if (isset($_GET['id'])) {
    $getID = (int) $_GET['id'];
    $arrArgs = array(
        'post_type' => 'recruitment',
        'post__in' => array($getID),
    );
    $objRec = current(get_posts($arrArgs));
    $postMeta = get_post_meta($objRec->ID); // lay cac gia tri trong meta
    $com_title = get_the_title($objRec->ID); // lay title
    $status = $postMeta['_recruit_status'][0];
    $com_company_tw = $postMeta['_recruit_company_tw'][0];
    $com_company_en = $postMeta['_recruit_company_en'][0];
    $com_company_vn = $postMeta['_recruit_company_vn'][0];
    $com_address = $postMeta['_recruit_address'][0];
    $com_phone = $postMeta['_recruit_phone'][0];
    $com_email = $postMeta['_recruit_email'][0];
    $com_count = $postMeta['_recruit_count'][0];
    $summary = $postMeta['_recruit_summary'][0];
    $lack_job = $postMeta['_recruit_lack_job'][0];
    $lack_count = $postMeta['_recruit_lack_count'][0];
    $com_sex = $postMeta['_recruit_sex'][0];
    $date_from = $postMeta['_recruit_date_from'][0];
    $date_to = $postMeta['_recruit_date_to'][0];
    $level = $postMeta['_recruit_level'][0];
    $experience = $postMeta['_recruit_experience'][0];
    $age_from = $postMeta['_recruit_age_from'][0];
    $age_to = $postMeta['_recruit_age_to'][0];
    $language = $postMeta['_recruit_language'][0];
    $work_space = $postMeta['_recruit_work_space'][0];
    $salary = $postMeta['_recruit_salary'][0];
    $orther = $postMeta['_recruit_orther'][0];
    $contact_name = $postMeta['_recruit_contact_name'][0];
    $contact_phone = $postMeta['_recruit_contact_phone'][0];
    $contact_email = $postMeta['_recruit_contact_email'][0];
    // add new 18-05-2020
    $sel_place = $postMeta['_recruit_place'][0];
    $sel_career = $postMeta['_recruit_career'][0];
}


//======= THEM MOI PHAN DANG TUYEN ==================================================================
if ($_POST & !isset($_GET['id'])) {
    $_error = array();
    if (isset($_POST['status'])) {
        $status = $_POST['status'];
    }
    if (empty($_POST['txt_title'])) {
        $_error['title'] = "標題不能空！";
    }

    if ($_POST['sel_place'] == '00') {
        $_error['place'] = "請選上班地區！";
    }

    if ($_POST['sel_career'] == '00') {
        $_error['career'] = "請選工作職務！";
    }

    if (empty($_error)) {

        // kiem tra noi dung nhap vao    
        if (checkContent($_POST['editor'])) {
            $catePost = 8; // SO ID CUA CATEGORY
            $cat = array($catePost);
            //    $editor_settings = Common::$_wpeditor;
            $newRecruit = array(
                'post_title' => esc_attr($_POST['txt_title']),
                'post_content' => $_POST['editor'],
                'post_category' => $cat,
                'post_status' => 'publish',
                'post_type' => 'recruitment'
            );
            //add post moi dong thoi lay ID post 
            $recMeta = wp_insert_post($newRecruit);

            // them catetegory cho post
            wp_set_object_terms($recMeta, $cat, 'recruitment_category');
            //   
            // Save phan metabox active //
            recruitMetaBox($recMeta, $_POST);
            // sau khi insert xong cac gia tri input se thanh rong
            $status = "";
            $com_company_tw = "";
            $com_company_en = "";
            $com_company_vn = "";
            $com_address = "";
            $com_phone = "";
            $com_email = "";
            $com_count = "";
            $summary = "";
            $lack_job = "";
            $lack_count = "";
            $com_sex = "";
            $date_from = "";
            $date_to = "";
            $level = "";
            $experience = "";
            $age_from = "";
            $age_to = "";
            $language = "";
            $salary = '';
            $work_space = '';
            $orther = "";
            $contact_name = "";
            $contact_phone = "";
            $contact_email = "";
            wp_redirect(esc_url(remove_query_arg('id', $uri))); // PHAN NAY XOA ID TREN THANH URL TAI DAY AP DUNG CHO VIEC CHAN INSERT DATA KHI REFRESH
        } else {
            $err_com_editor = __('There are special words');
        }
    }
}
//======= CAP NHAT PHAN DANG TUYEN ==================================================================
if ($_POST & isset($_GET['id'])) {
    if (empty($_error)) {
        // kiem tra noi dung nhap vao    
        $postID = $_POST['hid_id'];
        $arrUpdate = array(
            'ID' => $postID,
            'post_title' => esc_attr($_POST['txt_title'])
        );
        wp_update_post($arrUpdate);
        // die('dsfs');      
        //            die();
        recruitMetaBox($postID, $_POST);
        wp_redirect(esc_url(remove_query_arg('id', $uri)));
    }
}

// ================ XOA TIN DA DANG ===========================            
if (!$_GET['del'] == '') {
    wp_trash_post($_GET['del']);
    wp_redirect(esc_url(remove_query_arg('del', $uri)));
}
?>
<form id="f_recruit_dangtuyen" method="post" action="#">

    <div style=" margin:2rem">
        <label> <?php _e('Active') ?></label>
        <input type="checkbox" name="chk_status" id=" chk_status" <?php echo $status === 'on' ? 'checked' : ""; ?> />
    </div>

    <input type="hidden" id="hid_id" name="hid_id" value="<?php echo $getID ?>" />
    <div class="recruit-space">

        <!-- active -->
        <div>
            <label><?php _e('Title'); ?><i id="error_title" class="error-mess"><?php echo $_error['title']; ?></i></label>
            <input type="text" class="form-control" name="txt_title" id="txt_title" value="<?php echo $com_title ?>">
        </div>

        <!-- title -->
        <div>
            <label><?php _e('Company Tw'); ?> <i id='error-company-tw' class="error-mess"><?php echo $err_com_company_tw ?></i></label>
            <input type="text" class="form-control" required name="txt_company_tw" id="txt_company_tw" value="<?php echo $com_company_tw ?>">
        </div>

        <div>
            <label><?php _e('Company Vn'); ?></label>
            <input type="text" class="form-control" name="txt_company_vn" id="txt_company_vn" value="<?php echo $com_company_vn ?>">
        </div> <!-- vn Company -->

        <div>
            <label><?php _e('Company En'); ?></label>
            <input type="text" class="form-control" name="txt_company_en" id="txt_company_en" value="<?php echo $com_company_en ?>">
        </div> <!-- en Company -->

        <div>
            <label><?php _e('Address'); ?><i id="error-address" class="error-mess"><?php echo $err_com_address ?></i></label>
            <input type="text" class="form-control" name="txt_address" id="txt_address" value="<?php echo $com_address ?>">
        </div> <!-- dia chi -->

        <div>
            <label><?php _e('Phone'); ?><i id="error-phone" class=" error-mess"><?php echo $err_com_phone ?></i></label>
            <input type="text" class=" form-control type-phone" name="txt_phone" id="txt_phone" value="<?php echo $com_phone ?>">
        </div>

        <div>
            <label><?php _e('Email'); ?><i id="error-email" class=" error-mess"><?php echo $err_com_email ?></i></label>
            <input type="email" class="form-control" name="txt_email" id="txt_email" value="<?php echo $com_email ?>">
        </div>

        <div>
            <label><?php _e('number of employees of the company'); ?></label>
            <input type="text" class="type-phone" name="txt_count" id="txt_count" value="<?php echo $com_count ?>">
        </div>

        <div>
            <label><?php _e('Company Summary'); ?></label>
            <textarea id="editor" name="editor" style="min-height: 300px;">
                            <?php echo $summary ?>
                        </textarea>
            <script>
                var editor = CKEDITOR.replace('editor', {
                    customConfig: 'custom-config.js'
                });
                CKFinder.setupCKEditor(editor, '<?php echo PART_CLASS . 'ckfinder' ?>');
            </script>
        </div> <!-- gioi thieu cty -->

        <div style="height:20px;">
            <hr style="border: 2px solid  #005082">
        </div>


        <div>
            <label><?php _e('職缺名稱'); ?></label>
            <input type="text" class="form-control" name="txt_lack_job" id="txt_lack_job" value="<?php echo $lack_job ?>">
        </div> <!-- nganh nghe kinh doanh -->

        <div>
            <label><?php _e('職缺人數'); ?></label>
            <input type="text" class="form-control type-number" maxlength="3" name="txt_lack_count" id="txt_lack_count" value="<?php echo $lack_count ?>">
        </div>
        <!--so nguoi can tuyen -->
        <!-- <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12"> <label for="sex"
                            class="label-title"><?php //_e('Sex'); 
                                                ?></label></div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select id="sel_sex" name="sel_sex" style="width: 180px">
                            <option value="3" <?php //echo $com_sex == 3 ? 'selected="selected"' : '' 
                                                ?>>
                                <?php //_e('Male/Female'); 
                                ?></option>
                            <option value="1" <?php //echo $com_sex == 1 ? 'selected="selected"' : '' 
                                                ?>>
                                <?php //_e('Male'); 
                                ?></option>
                            <option value="2" <?php //echo $com_sex == 2 ? 'selected="selected"' : '' 
                                                ?>>
                                <?php // _e('Female'); 
                                ?></option>
                        </select>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 error-text"><label></label></div>
                </div> -->
        <!-- gioi tinh -->
        <div class="two-row">
            <div>
                <label><?php _e('有效日期'); ?></label>
                <input type="text" class="MyDate" maxlength="10" name="txt_date_from" id="txt_date_from" value="<?php echo $date_from ?>">
            </div>
            <div>
                <label><?php _e('To'); ?></label>
                <input type="text" class="MyDate" maxlength="10" name="txt_date_to" id="txt_date_to" value="<?php echo $date_to ?>">
            </div>
        </div>


        <?php
        require_once DIR_CODES . 'my-list.php';
        $myList = new Codes_My_List();
        $placeList = $myList->PlaceList();
        $careerList = $myList->CareerList();
        ?>
        <div class="two-row">
            <div>
                <label><?php _e('上班地區'); ?><i id="error_place" class=' error-mess'><?php echo $err_place ?></i></label>
                <select id="sel_place" name="sel_place" class="selectmenu">
                    <?php foreach ($placeList as $key => $val) { ?>
                        <option value="<?php echo $key ?>" <?php echo $sel_place == $key ? 'selected="selected"' : '' ?>>
                            <?php echo $val ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div>
                <label><?php _e('職務類別'); ?> <i id="error_career" class=" error-mess"> <?php echo $err_career ?></i></label>

                <select id="sel_career" name="sel_career" class="selectmenu">
                    <?php foreach ($careerList as $key => $val) { ?>
                        <option value="<?php echo $key ?>" <?php echo $sel_career == $key ? 'selected="selected"' : '' ?>><?php echo $val ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <!-- ngay co hien luc -->
        <div>
            <label><?php _e('Level'); ?></label>
            <input type="text" class="form-control" name="txt_level" id="txt_level" value="<?php echo $level ?>">
        </div>

        <!-- trinh do -->
        <div>
            <label><?php _e('Experiences'); ?></label>
            <input type="text" class="form-control" name="txt_experience" id="txt_experience" value="<?php echo $experience ?>">
        </div> <!-- kinh nghiem -->
        <!-- <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-4"> <label class="label-title"><?php //_e('Age'); 
                                                                                        ?></label></div>
                    <div class="col-md-4 col-sm-4 col-xs-8"><input type="text" style="width: 88%" class="type-number" maxlength="2" name="txt_age_from" id="txt_age_from" value="<?php //echo $age_from 
                                                                                                                                                                                    ?>"></div>
                    <div class="col-md-1 col-sm-1 col-xs-4"><label class="label-title"><?php //_e('To'); 
                                                                                        ?></label></div>
                    <div class="col-md-4 col-sm-4 col-xs-8"><input type="text" style="width: 88%" class="type-number " maxlength="2" name="txt_age_to" id="txt_age_to" value="<?php //echo $age_to 
                                                                                                                                                                                ?>"> </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 error-text"><label class="mess">
                            <?php //echo $err_com_age 
                            ?></label></div>
                </div> gioi han do tuoi -->
        <div>
            <label><?php _e('Foreign Languages'); ?></label>
            <input type="text" class="form-control" name="txt_language" id="txt_language" value="<?php echo $language ?>">
        </div> <!-- ngoai ngu -->

        <div>
            <label><?php _e('Work Space'); ?></label>
            <input type="text" class="form-control" name="txt_word_space" id="txt_word_space" value="<?php echo $work_space ?>">
        </div> <!-- noi lam viec -->


        <div>
            <label><?php _e('Salary'); ?></label>
            <input type="text" class="form-control" name="txt_salary" id="txt_salary" value="<?php echo $salary ?>">

        </div> <!-- noi lam viec -->

        <div>
            <label class="label-title"><?php _e('Another'); ?></label>
            <textarea id="another" name="another" style="min-height: 200px">
                            <?php echo $orther ?>
                        </textarea>
            <script>
                var another = CKEDITOR.replace('another', {
                    customConfig: 'custom-config_no-img.js'
                });
                CKFinder.setupCKEditor(another, '<?php echo PART_CLASS . 'ckfinder' ?>');
            </script>
        </div>
        <!-- khac -->

        <div>
            <h4><?php _e('人事聯絡室'); ?></h4>
        </div>

        <div>
            <label><?php _e('Name'); ?></label>
            <input type="text" class="form-control" name="txt_contact_name" id="txt_contact_name" value="<?php echo $contact_name ?>">
        </div>

        <div>
            <label><?php _e('Phone'); ?></label>
            <input type="text" class="type-phone form-control" name="txt_contact_phone" id="txt_contact_phone" value="<?php echo $contact_phone ?>">
        </div>

        <div>
            <label><?php _e('Email'); ?></label>
            <input type="email" class="form-control" name="txt_contact_email" id="txt_contact_email" value="<?php echo $contact_email ?>">
        </div>
        <!-- thong tin lien nguoi quan ly -->

    </div>
    <div class="btn-space" style="margin-top: 2rem">
        <input id="btn-submit" type="button" class="btn-my" value="<?php echo isset($_GET['id']) ? _e('Update') : _e('Submit_'); ?>" />
        <?php if (isset($_GET['id'])) { ?>
            <input id="btn_reset" type="reset" class="btn-my" value="<?php _e('Cancel'); ?>" onclick="javascript:window.location = '<?php echo home_url('recruit/?dt=4') ?>';" />
        <?php } else { ?>
            <input id="btn-reset" type="reset" class="btn-my" value='<?php _e('Reset'); ?>' />
        <?php } ?>
    </div> <!-- button -->
</form>


<?php
if (isset($_GET['id'])) {
    $getid = $_GET['id'];
} else {
    $getid = 001;
}
?>

<script>
    jQuery(document).ready(function() {
        //KIEM TRA INPUT TRUOC KHI SUBMIT FORM
        jQuery('#btn-submit').on('click', function() {
            var error = '';

            if (jQuery('#sel_place').val() === '00') {
                error += 'error select palce,'
                jQuery('#error_place').html('請選上班地區!');
                // SCROLL DEN PHAN BAO LOI
                jQuery('html, body').animate({
                    scrollTop: jQuery('#error_place').offset().top - 100
                }, 1000);
            } else {
                jQuery('#error_place').html('');
            }

            if (jQuery('#sel_career').val() === '00') {
                error += 'error select career,'
                jQuery('#error_career').html('請選工作職務!');
                jQuery('html, body').animate({
                    scrollTop: jQuery('#error_career').offset().top - 100
                }, 1000);
            } else {
                jQuery('#error_career').html('');
            }

            if (jQuery('#txt_email').val() === '') {
                error += 'loi email,';
                jQuery('#error-email').html('不能為空!');
                jQuery('html, body').animate({
                    scrollTop: jQuery('#error-email').offset().top - 100
                }, 1000);
            } else {
                jQuery('#error-email').html('');
            }

            if (jQuery('#txt_phone').val() === '') {
                error += 'loi dien thoai,';
                jQuery('#error-phone').html('不能為空!');
                jQuery('html, body').animate({
                    scrollTop: jQuery('#error-phone').offset().top - 100
                }, 1000);
            } else {
                jQuery('#error-phone').html('');
            }

            if (jQuery('#txt_address').val() === '') {
                error += 'loi dia chi,';
                jQuery('#error-address').html('不能為空!');
                jQuery('html, body').animate({
                    scrollTop: jQuery('#error-address').offset().top - 100
                }, 1000);
            } else {
                jQuery('#error-address').html('');
            }

            if (jQuery('#txt_company_tw').val() === '') {
                error += 'loi ten cty,';
                jQuery('#error-company-tw').html('不能為空!');
                jQuery('html, body').animate({
                    scrollTop: jQuery('#error-company-tw').offset().top - 100
                }, 1000);
            } else {
                jQuery('#error-company-tw').html('');
            }

            if (jQuery('#txt_title').val() === '') {
                error += 'loi title,';
                jQuery('#error_title').html('不能為空!');
                jQuery('html, body').animate({
                    scrollTop: jQuery('#error_title').offset().top - 100
                }, 1000);
            } else {
                jQuery('#error_title').html('');
            }



            if (error === '') {
                jQuery('#f_recruit_dangtuyen').submit();
            }
        });

        if ('<?php echo $getID ?>' !== '') {
            jQuery(".add_new_space").slideDown('slow');
        }

        jQuery("#add_new").on("click", function() {
            jQuery(".add_new_space").toggle('slow');
            var dd = jQuery('.add_new_space').css('height');

            if (dd === '1px') {
                jQuery("#add_new").text('取 消');
            } else {
                jQuery("#add_new").text('新 增');
            }
        });
    });
</script>