<?php
/*
  Template Name: Contact
 */
?>
<?php get_header(); ?>

<style type="text/css">

</style>
<div id="popup_box"> 
    <div id="popup_content">
        <!-- OUR PopupBox DIV-->
        <h3><i class='fas fa-envelope' ></i> <?php _e('Your Message Send Success'); ?></h3>
        <p><?php _e('Thanks You'); ?> </p>
        <!--  <a id="popupBoxClose">Close</a>  -->
    </div>
</div>
<?php
if ($_POST) {
    $arr_error = array();

    if ($_SESSION['check_post'] != $_POST['check_post']) {
        $_SESSION['check_post'] = $_POST['check_post'];
        if (empty($_POST['con_company']))
            $arr_error['con_company'] = __('err_company');
        if (empty($_POST['con_contact']))
            $arr_error['con_contact'] = __('err_contact');
        if (empty($_POST['con_cell']))
            $arr_error['con_cell'] = __('err_phone');
        if (empty($_POST['con_email'])) {
            $arr_error['con_email'] = __('err_email');
        } else {
            if (!filter_var($_POST['con_email'], FILTER_VALIDATE_EMAIL) === TRUE) {
                $arr_error['con_email'] = __('err_sure_email');
            }
        }
//        if (empty($_POST['con_subject']))
//            $arr_error['con_subject'] = __('err_subject');
        if (empty($_POST['con_content']))
            $arr_error['con_content'] = __('err_content');

        if ($_POST['txt_captcha'] != $_POST['hidden_captcha']) {
            $arr_error['con_captcha'] = __("err_captcha");
        }


        if (empty($arr_error)) {
            $to = get_option('commerce_email');
            $subject = __('this information for web contact page');
            $message = '<div><p style="font-weight: bold;font-size: 14px;">' . __('Company Name') . ' : ' . $_POST['con_company'] . '</p></div>';
            $message .= '<div><p style="font-weight: bold;font-size: 14px;">' . __('Full Name') . ' : ' . $_POST['con_contact'] . '</p></div>';
            $message .= '<div><p style="font-weight: bold;font-size: 14px;">' . __('Mobile') . ' : ' . $_POST['con_cell'] . '</p></div>';
            $message .= '<div><p style="font-weight: bold;font-size: 14px;">' . __('Fax') . ' : ' . $_POST['con_fax'] . '</p></div>';
            $message .= '<div><p style="font-weight: bold;font-size: 14px;">' . __('Phone') . '  : ' . $_POST['con_phone'] . '</p></div>';
            $message .= '<div><p style="font-weight: bold;font-size: 14px;">' . __('Address') . '  : ' . $_POST['con_address'] . '</p></div>';
            $message .= '<div><p style="font-weight: bold;font-size: 14px;">' . __('Email') . '  : ' . $_POST['con_email'] . '</p></div>';
            $message .= '<div><p style="font-weight: bold;font-size: 14px;">' . __('Content') . '  : ' . $_POST['con_content'] . '</p></div>';
// kieu data show trong mail
            add_filter('wp_mail_content_type', create_function('', 'return "text/html"; '));
            if (wp_mail($to, $subject, $message)) {
                ?>
                <script type="text/javascript">
                    //  alert('send sucess');
                    loadPopupBox();

                    function loadPopupBox() {    // To Load the Popupbox
                        jQuery('#popup_box').fadeIn('slow');
                        setTimeout("unloadPopupBox('done')", 2000);
                    }

                    var unloadPopupBox = function (value) {    // TO Unload the Popupbox
                        jQuery('#popup_box').fadeOut("slow");
                        //  window.open("http://localhost/isana/contact-us/")
                        if (value === 'done') {
                            window.location = location.href;
                        }
                    };
                </script>
                <?php
            }
        } else {
            $company = $_POST['con_company'];
            $contact = $_POST['con_contact'];
            $cell = $_POST['con_cell'];
            $phone = $_POST['con_phone'];
            $fax = $_POST['con_fax'];
            $address = $_POST['con_address'];
            $email = $_POST['con_email'];
            $subject = $_POST['con_subject'];
            $content = $_POST['con_content'];
        }
    } else {
        //  echo 'ko co session';
    }
}
?>
<div class="row" style="padding-top: 5px" >
    <div class="first-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
        <?php get_sidebar(); ?>
    </div>
    <div class="second-space col-lg-9 col-md-8 col-sm-12 col-xs-12">
        <div class="group-border">
            <div class="group-title">
                <label><?php _e('Contact The Association') ?></label>
            </div>
            <div>
                <ul class="article-list">
                    <li><label> <?php echo __('Address') . '&nbsp; : &nbsp;' . get_option('commerce_address') ?></label></li> 
                    <?php if (!empty(get_option('commerce_mobile'))) { ?>
                        <li><label><?php echo __('Mobile') . '&nbsp; : &nbsp;' . get_option('commerce_mobile') ?></label></li>
                    <?php } ?>
                    <li><label> <?php echo __('Phone') . '&nbsp; : &nbsp;' . get_option('commerce_phone') ?></label></li>
                    <li><label> <?php echo __('Fax') . '&nbsp; : &nbsp;' . get_option('commerce_fax') ?></label></li>
                    <li><label>  <?php echo __('Email') . '&nbsp; : &nbsp;' . get_option('commerce_email') ?></label></li>
                </ul>
            </div>
            <div style="width: 95%; margin: 30px auto 15px;  background-color:  #ffffff; border:  1px  #999999 solid; border-radius: 4px">

                <form id="f-contact" name="f-contact" action=""  method="post">
                    <div style="background-color:  #999999; height: 50px; padding-left: 20px; color: #fff; font-size: 18px; font-weight: bold; line-height: 50px; letter-spacing: 5px">
                        <?php _e('Contact Info'); ?></h2>
                    </div> 
                    <input type="hidden" id="check_post" name="check_post"   value="<?php echo time() ?>">
                    <ul ul class="mem_item">
                        <li>
                            <div class="mem_item_title"> <?php _e('Company Name'); ?> <span>*</span></div>
                            <div class="mem_item_content"><input id="con_company" name="con_company"  type="text" placeholder="<?php _e('Company Name') ?>"   value="<?php echo $company ?>" required/></div>
                            <div class="mem_item_error"><?php echo $arr_error['con_company']; ?></div>
                        </li>
                        <li>
                            <div class="mem_item_title"><?php _e('Full Name'); ?> <span>*</span></div> 
                            <div class="mem_item_content"><input id="con_contact " name="con_contact"  type="text" placeholder="<?php _e('Full Name') ?>" value="<?php echo $contact ?>" required /></div>
                            <div class="mem_item_error"><?php echo $arr_error['con_contact']; ?></div>
                        </li>
                        <li>
                            <div class="mem_item_title"><?php _e('Mobile'); ?> <span>*</span> </div>
                            <div class="mem_item_content"><input id="con_cell" name="con_cell" type="text" placeholder="<?php _e('Mobile') ?>" value="<?php echo $cell; ?>"  class="type-phone" required /></div>
                            <div class="mem_item_error"><?php echo $arr_error['con_cell']; ?></div>
                        </li>
                        <li>
                            <div class="mem_item_title"><?php _e('Phone'); ?> </div>
                            <div class="mem_item_content"><input id="con_phone" name="con_phone"  type="text" placeholder="<?php _e('Phone') ?>" value="<?php echo $phone; ?>" class="type-phone" /></div>
                            <div class="mem_item_error"></div>
                        </li>
                        <li>
                            <div class="mem_item_title"> <?php _e('Fax'); ?></div>
                            <div class="mem_item_content"><input id="con_fax" name="con_fax"  type="text" placeholder="<?php _e('Fax') ?>" value="<?php echo $fax; ?>" class="type-phone"/></div>
                            <div class="mem_item_error"></div>
                        </li>
                        <li>
                            <div class="mem_item_title"> <?php _e('Address'); ?></div>
                            <div class="mem_item_content" style="width: 50%"><input id="con_address" name="con_address" placeholder="<?php _e('Address') ?>"  type="text" value="<?php echo $address; ?>"  style="width: 100%" /></div>
                            <div class="mem_item_error"></div>
                        </li>
                        <li>
                            <div class="mem_item_title"><?php _e('Email'); ?><span> * </span> </div>
                            <div class="mem_item_content"><input id="con_email" name="con_email"  type="text" placeholder="<?php _e('Email') ?>" value="<?php echo $email; ?>" class="type-email" required /></div>
                            <div class="mem_item_error" id="error_email"><?php echo $arr_error['con_email']; ?></div>
                        </li>
            
                        <li>
                            <div class="mem_item_title noidung"><?php _e('Email Contant'); ?><span> * </span></div> 
                            <div class="mem_item_content">
                                <textarea style="margin-left: 5px" id="con_contact" name="con_content"  id="con_content" cols ="60%" rows="5" required><?php echo $content; ?></textarea>
                            </div>
                            <div class="mem_item_error"><?php echo $arr_error['con_content']; ?></div>

                        </li>
                        <li style=" overflow: no-display">

                            <div class="mem_item_title"><?php _e('captcha'); ?> <span> * </span></div>
                            <div class="mem_item_content">
                                <img src="<?php echo PART_CLASS . 'captcha/captcha.php'; ?>" 
                                     onClick="this.src = '<?php echo PART_CLASS . 'captcha/captcha.php?reset=true&'; ?>' + Math.random();"
                                     alt="captcha" title="captcha" 
                                     style="cursor:pointer; float: left;margin: 0px 20px">
                                <input type="hidden" id="hidden_captcha" name="hidden_captcha" value="<?php echo $_SESSION['captcha']; ?>"/> 
                                <input name="txt_captcha" id="txt_captcha" type="text" placeholder="<?php _e('captcha') ?>"
                                       class="required input_field"  
                                       maxlength="5"
                                       required
                                       style="width: 100px; height: 35px; margin-top: 10px;"/>  
                            </div>
                            <div class="mem_item_error" style="margin-top: 15px"> <?php echo $arr_error['con_captcha']; ?></div>

                        </li>
                    </ul>
                    <div style="text-align: center; margin: 15px ">  
                        <input type="reset" value="<?php _e('Reset'); ?>" class="btn btn-primary"  style=" margin-right:  30px "/>
                        <input type="submit" value="<?php _e('Submit'); ?>"class="btn btn-primary" />
                        <label class="mem_item_error" ></label>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="last-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
        <?php get_sidebar('mobile'); ?>
    </div>
</div>


<?php
get_footer();
