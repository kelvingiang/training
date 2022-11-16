<?php
if (!empty($_POST)) {
    // kiem neu het loi add vao data base
    // $error = cac loi khi nhap lieu

    function add($error)
    {
        if (empty($error)) {
            /* create an "order" in DB and save order details */

            $objNewOrder = array(
                'post_type' => 'member',
                'post_author' => 1,
                'post_status' => 'publish'
            );
            $intPostId = wp_insert_post($objNewOrder);

            /* Save order details into Database*/
            update_post_meta($intPostId, 'm_user', esc_attr($_POST['m_user']));
            update_post_meta($intPostId, 'm_password', md5(esc_attr($_POST['m_pass'])));
            update_post_meta($intPostId, 'm_active', 'on');
            update_post_meta($intPostId, 'm_fullname', esc_attr($_POST['m_fullname']));
            update_post_meta($intPostId, 'm_lastname', esc_attr($_POST['m_lastname']));
            update_post_meta($intPostId, 'm_midename', esc_attr($_POST['m_midename']));
            update_post_meta($intPostId, 'm_firstname', esc_attr($_POST['m_firstname']));
            update_post_meta($intPostId, 'm_passport', esc_attr($_POST['m_passport']));
            update_post_meta($intPostId, 'm_birthdate', esc_attr($_POST['m_birthdate']));
            update_post_meta($intPostId, 'm_sex', esc_attr($_POST['m_sex']));
            update_post_meta($intPostId, 'm_company', esc_attr($_POST['m_company']));
            update_post_meta($intPostId, 'm_position', esc_attr($_POST['m_position']));
            update_post_meta($intPostId, 'm_email', esc_attr($_POST['m_email']));
            update_post_meta($intPostId, 'm_phone', esc_attr($_POST['m_phone']));
            update_post_meta($intPostId, 'm_address', esc_attr($_POST['m_address']));
            update_post_meta($intPostId, 'm_image', 'm_img.jpg');

            $mailTo       = $_POST['m_email'];
            $name         = $_POST['m_fullname'];
            $user           = $_POST['m_user'];
            $password    = $_POST['m_pass'];
            registrySendMail($mailTo, $name, $user, $password);
        }
    }

    //========= action =======================================================================

    $m_error = '';
    if (isset($_POST['m_user'])) {
        $txt_user = $_POST['m_user'];
        $back_user = checkstr($txt_user, 5, 20);
        if (!empty($back_user)) {
            $err_user = '帳號' . $back_user;
            $m_error = 'user';
        } else {
            $user = $_POST['m_user'];
        }
    }


    add($m_error);
    //////======================================================
?>

<?php } ?>


<form id="f-register" name="f-register" method="post" action="">
    <div class='head-title'>
        <div class="title">
            <h2 class="head"> <?php _e('會員註冊表'); ?> </h2>
        </div>
    </div>
    <div class="row">
        <div class='col-md-3'><label class="label-title" for="m_user"><?php _e('User Name', 'suite'); ?> </label></div>
        <div class='col-md-9'><input type="text" class="form-control" required oninvalid="this.setCustomValidity('<?php _e('Requied', 'suite'); ?>')" onchange="this.setCustomValidity('')" placeholder="<?php _e('User Name', 'suite'); ?>" pattern=".{2,}" title="minlegh 2 chars" name="m_user" id="m_user" value="<?php echo $user; ?>" /> </div>
        <!-- onivalid thay do noi dung show thong bao  -->
        <div class='col-md-12 error-text'><label><?php echo $err_user; ?></label></div>
    </div>
    <div class="row">
        <div class='col-md-3'><label class="label-title" for="m_pass"><?php _e('Password', 'suite'); ?></label></div>
        <div class='col-md-9'><input type="password" class="form-control" required oninvalid="this.setCustomValidity('<?php _e('Requied', 'suite'); ?>')" onchange="this.setCustomValidity('')" placeholder="<?php _e('Password', 'suite'); ?>" name="m_pass" id="m_pass" value="<?php echo $pass ?>" /></div>
        <div class='col-md-12 error-text'><label><?php echo $err_pass ?></label></div>
    </div>
    <div class="row">
        <div class='col-md-3'><label class="label-title" for="m_passf"> <?php _e('Password Confirm', 'suite'); ?>
            </label></div>
        <div class='col-md-9'><input type="password" class="form-control" required oninvalid="this.setCustomValidity('<?php _e('Requied', 'suite'); ?>')" onchange="this.setCustomValidity('')" placeholder="<?php _e('Password Confirm', 'suite'); ?>" name="m_passf" id="m_passf" value="<?php echo $passf ?>" /></div>
        <div class='col-md-12 error-text'><label id="mes-passf"><?php echo $err_passf ?></label></div>
    </div>
    <hr /> <!-- =========    -->
    <div class="row">
        <div class='col-md-3'><label class="label-title" for="m_fullname"><?php _e('Full Name Chinses', 'suite'); ?></label></div>
        <div class='col-md-9'><input type="text" class="form-control" required oninvalid="this.setCustomValidity('<?php _e('Requied', 'suite'); ?>')" onchange="this.setCustomValidity('')" placeholder="<?php _e('Full Name', 'suite'); ?>" name="m_fullname" id="m_fullname" value="<?php echo $fullname ?>" /></div>
        <div class='col-md-12 error-text'><label><?php echo $err_fullname ?></label></div>
    </div>
    <div class="row">
        <div class='col-md-3'><label class="label-title" for="m_fullname"><?php _e('Full Name English', 'suite'); ?></label></div>
        <div class='col-md-9'><input type="text" style='margin-top: -2px; width:150px' oninvalid="this.setCustomValidity('<?php _e('Requied', 'suite'); ?>')" onchange="this.setCustomValidity('')" placeholder="<?php _e('姓氏', 'suite'); ?>" name="m_lastname" id="m_lastname" value="<?php echo $lastname ?>" /> <label> , </label>
            <input type="text" style='margin-top: -2px; width:145px' oninvalid="this.setCustomValidity('<?php _e('Requied', 'suite'); ?>')" onchange="this.setCustomValidity('')" placeholder="<?php _e('名字', 'suite'); ?>" name="m_midename" id="m_midename" value="<?php echo $midename ?>" /> <label> - </label>
            <input type="text" style='margin-top: -2px; width:150px' oninvalid="this.setCustomValidity('<?php _e('Requied', 'suite'); ?>')" onchange="this.setCustomValidity('')" placeholder="<?php _e('名字', 'suite'); ?>" name="m_firstname" id="m_firstname" value="<?php echo $firstname ?>" />
        </div>
        <div class='col-md-12 error-text'><label><?php echo $err_englishName ?></label></div>
    </div>
    <div class="row">
        <div class='col-md-3'><label class="label-title" for="m_passport"><?php _e('Passport', 'suite'); ?> </label>
        </div>
        <div class='col-md-9'><input type="text" class="form-control type-number" required oninvalid="this.setCustomValidity('<?php _e('Requied', 'suite'); ?>')" onchange="this.setCustomValidity('')" pattern="[0-9]{9,9}" maxlength="9" placeholder="<?php _e('Passport', 'suite'); ?> " name="m_passport" id="m_passport" value="<?php echo $passport ?>" /></div>
        <div class='col-md-12 error-text'> <label><?php echo $err_passport ?></label></div>
    </div>
    <div class="row">
        <div class='col-md-3'><label class="label-title" for="m_birthdate"><?php _e('Birth Of Date', 'suite'); ?>
            </label></div>
        <div class='col-md-9'>
            <input type="text" class="MyDate" maxlength="10" required name="m_birthdate" id="m_birthdate" value="<?php echo $birthdate ?>">
        </div>
        <div class='col-md-12 error-text'> <label><?php echo $err_birthdate ?></label></div>
    </div>
    <div class="row">
        <div class='col-md-3'><label class="label-title" for="m_sex"><?php _e('Sex', 'suite'); ?> </label></div>
        <div class='col-md-9'>
            <select id="m_sex" name="m_sex" class="selectmenu" style="width: 180px">
                <option value="1" <?php if ($sex == '1') echo ' selected="selected"'; ?>><?php _e('Male', 'suite'); ?>
                </option>
                <option value="2" <?php if ($sex == '2') echo ' selected="selected"'; ?>><?php _e('Female', 'suite'); ?>
                </option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class='col-md-3'><label class="label-title" for="m_address"><?php _e('Address', 'suite'); ?> </label></div>
        <div class='col-md-9'><input type="text" class="form-control" required oninvalid="this.setCustomValidity('<?php _e('Requied', 'suite'); ?>')" onchange="this.setCustomValidity('')" placeholder="<?php _e('Address', 'suite'); ?> " name="m_address" id="m_address" value="<?php echo $address ?>" /></div>
        <div class='col-md-12 error-text'><label><?php echo $err_address ?></label></div>
    </div>
    <div class="row">
        <div class=' col-md-3 '><label class="label-title" for="m_company"> <?php _e('Company', 'suite'); ?> </label>
        </div>
        <div class=' col-md-9'><input type="text" class="form-control" required placeholder="<?php _e('Company', 'suite'); ?>" name="m_company" id="m_company" value="<?php echo $_POST['m_company'] ?>" value="<?php echo $company ?>" /></div>
        <div class='col-md-12 error-text'><label><?php echo $err_company ?></label></div>
    </div>
    <div class="row">
        <div class=' col-md-3 '><label class="label-title" for="m_position"> <?php _e('Position', 'suite'); ?> </label>
        </div>
        <div class=' col-md-9'><input type="text" class="form-control" required placeholder="<?php _e('Position', 'suite'); ?>" name="m_position" id="m_position" value="<?php echo $_POST['m_position'] ?>" value="<?php echo $position ?>" /></div>
        <div class='col-md-12 error-text'><label><?php echo $err_position ?></label></div>
    </div>
    <div class="row">
        <div class=' col-md-3'><label class="label-title" for="m_email"> <?php _e('Email', 'suite'); ?></label></div>
        <div class='col-md-9'><input type="email" class="form-control" required oninvalid="this.setCustomValidity('<?php _e('Requied or Email', 'suite'); ?>')" onchange="this.setCustomValidity('')" placeholder="<?php _e('Email', 'suite'); ?>" name="m_email" id="m_email" value="<?php echo $email ?>" /></div>
        <div class=' col-md-12 error-text'><label><?php echo $err_email; ?></label></div>
    </div>
    <div class="row">
        <div class='col-md-3'><label class="label-title" for="m_phone"><?php _e('Phone', 'suite'); ?> </label></div>
        <div class=' col-md-9'><input type="text" required class="form-control type-phone" maxlength="20" oninvalid="this.setCustomValidity('<?php _e('Requied', 'suite'); ?>')" onchange="this.setCustomValidity('')" pattern="^[0-9 \-]+$" placeholder="<?php _e('Phone', 'suite'); ?> " name="m_phone" id="m_phone" value="<?php echo $phone ?>" /> </div>
        <div class=' col-md-12 error-text'><label><?php echo $err_phone ?></label></div>
    </div>
    <div class="row">
        <div class=' col-md-3'><label class="label-title"><?php _e('Captcha', 'suite') ?></label></div>
        <div class=' col-md-9'><input type="text" maxlength="5" required oninvalid="this.setCustomValidity('<?php _e('Requied', 'suite'); ?>')" onchange="this.setCustomValidity('')" placeholder="<?php _e('Captcha', 'suite') ?>" id="txtCaptcha" name="txtCaptcha" style='margin-top: -2px; margin-right:10px; width:170px' value="<?php echo $captcha ?>"><img src="<?php echo PART_CLASS . 'captcha/captcha.php'; ?>" onclick="this.src = '<?php echo  PART_CLASS . 'captcha/captcha.php?reset=true&' ?>' + Math.random();" style="cursor:pointer" /></div>
        <div class=' col-md-12 error-text'><label><?php echo $err_captcha; ?></label></div>
    </div>
    <div class="row-register">
        <div style="text-align: center">
            <input type="submit" class="btn btn-primary" name="m_submit" id="m_submit" value="<?php _e('Submit', 'suite'); ?>" />
            <input type="reset" class="btn btn-primary" name="m_reset" id="m_reset" value="<?php _e('Reset', 'suite'); ?>" />
        </div>
    </div>
</form>



<div id="div-popup">
    <div id="div-alertInfo">
        <div id="alert-title">
            <?php _e('Notice', 'suite');  ?>
            <input type="button" id="btn-close" name="btn-close" value="X" />
        </div>
        <div id="alert-content">
            <h2><?php _e('congratulation your register success !', 'suite'); ?> </h2>
        </div>
        <div id="alert-footer"></div>
    </div>
    <div id="div-bg"></div>
</div>
<!-- cac ky tu key code cho phep nhap  -->
<script type="text/javascript">
    $(document).ready(function() {
        // ===B ===== EVENT OF POPUP ======================
        var error = "<?php echo $m_error; ?>";
        var post = "<?php echo $_POST['m_user'] ?>";
        if (error === '' && post !== '') {
            $('#div-popup').fadeIn('slow');
            $('#div-alertInfo').css('top', '150px');
            setTimeout(closePopup, 5000);
        }

        function closePopup() {
            $('#div-popup').fadeOut('slow');
            $('#div-alertInfo').css('top', '0px');
            $('#div-alertInfo').css('opacity', '0');
            window.location = '<?php echo home_url() ?>';
        }

        // dong pupop
        $('#div-bg').click(function() {
            closePopup();
        });

        $('#btn-close').click(function() {
            closePopup();
        });
        // ===E ==== EVENT OF POPUP ======================          
        // kiem tra password va comfirm password
        $('#m_passf').on('keyup', function() {
            if ($('#m_pass').val() !== $('#m_passf').val()) {
                $('#mes-passf').html('<?php _e('Not Matching', 'suite');  ?>').css('color', 'red');
            } else {
                $('#mes-passf').html('');
            }
        });
    });
</script>