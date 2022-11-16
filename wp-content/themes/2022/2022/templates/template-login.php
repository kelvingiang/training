<?php
// dien kien where de lay du lieu
$arr = array(
    'post_type' => 'member',
    'meta_query' => array(
        array('key' => 'm_user', 'value' => @$_SESSION['login'])
    ),
);
?>
<!--  
    phan nay kiem tra bang ajax, code xu ky ajax dc viet tai file js va dc add vao o dau trang (checkajax.js)
-->
<div>
    <div class="login-space">
        <div class="login-from">
            <form id="f_login" name="f_login" method="post" action="">
                <div>
                    <label class='label-title'><?php _e('User Name'); ?><i id="strMessageLogin" class="error-mess"></i></label>
                    <input type="text" required placeholder="Username" id="l_user" name="l_user" autocomplete="off" />
                </div>

                <div>
                    <label class='label-title'><?php _e('Password') ?></label>
                    <input type="password" required placeholder="Password" id="l_pass" name="l_pass" autocomplete="off" />
                </div>
        </div>
        <div class="btn-space" style="margin-top: 2rem">
            <button type=" submit" class="btn-my" name="btn_login" id="btn_submit">
                <?php _e('Login', 'suite'); ?>
            </button>

            <button type="button" class="btn-my" data-bs-toggle="modal" data-bs-target="#ForgetPass">
                <?php _e('Forget Password', 'suite'); ?>
            </button>
        </div>
        </form>
    </div>
</div>

<!-- B ----------  phan cap nhat lai hinh hinh avata cua member ---->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form id="f-avata" name="f-avata" action="" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php _e('Ａvatar', 'suite'); ?></h4>
                    <div style=" clear: both"></div>
                </div>
                <div class="modal-body">
                    <div id="default-imgfe"> </div>
                    <div id="upload-image">
                        <div id="show-img"> </div>
                        <div>
                            <label><?php _e('Choose a Image', 'suite'); ?></label>
                            <input type="file" id="myfile" name="myfile" />
                            <label id="mess"></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="<?php time() ?>" />
                    <input type="submit" value="<?php _e('Submit', 'suite'); ?>" id="btn_changeImg" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>
<!-- E ----------  phan cap nhat lai hinh hinh avata cua member ---->

<!--FORGET PASSWORD-->
<!--  B----------- hien thi popup lay lai password khi bi quen -->
<div class="modal fade" id="ForgetPass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form name="f-getPass" id="f-getPass" action="" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <image id="waiting-img" name="waiting-img" src="<?php echo PART_IMAGES . 'loading.gif' ?>" />
                    </div>

                    <div>
                        <h4 class="modal-title" id="myModalLabel">
                            <?php _e('Get New Password'); ?>
                        </h4>
                    </div>

                    <div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

                <div class="modal-body">
                    <div>
                        <label class="label-title"><?php _e('User Name') ?>
                            <i id="passportMess" class="error-mess"></i>
                        </label>

                        <input type="text" placeholder="<?php _e('User Name'); ?>" id="g-passport" name="g-passport" />
                    </div>

                    <div>
                        <label class="label-title"><?php _e('E-mail') ?>
                            <i id="emailMess" class="error-mess"></i>
                        </label>

                        <input type="text" placeholder="<?php _e('E-mail'); ?>" id="g-email" name="g-email" />
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="btn-space">
                        <button type="submit" id="submit-getPass" class="btn-my">
                            <?php _e('Submit'); ?>
                        </button>
                        <button type="reset" id="cancel-getPass" class="btn-my " data-bs-dismiss="modal" aria-hidden="true">
                            <?php _e('Cancel'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div><!-- /.modal-content -->

<!--  E----------- hien thi popup lay lai password khi bi quen -->

<script type="text/javascript">
    // show hinh anh truoc khi up len
    jQuery(function() {
        jQuery("#myfile").on("change", function() {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader)
                return; // no file selected, or no FileReader support

            if (/^image/.test(files[0].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file

                reader.onloadend = function() { // set image data as background of div
                    jQuery("#show-img").css("background-image", "url(" + this.result + ")");
                };
            }
        });
    });
</script>

<!-- chuyen data den trang ajax  -->
<script type="text/javascript">
    // tại bien de chuyen dg link sang cho js toi file .php de xu va tra ve ket qua sau khi xu ly
    var objLoginData = {
        url: '<?php echo PART_AJAX . 'login.php' ?>'
    };

    // phan quen mat khau xin lai mat khau mmoi    
    var obForgetPass = {
        url: '<?php echo PART_AJAX . 'forgetpass.php' ?>'
    };


    //goi ajax de thay doi hinh avatar cua member
    var objAvatarData = {
        url: '<?php echo PART_AJAX . 'changeavatar.php' ?>'
    };

    jQuery(document).ready(function() {
        jQuery('#btn-registry').click(function() {
            window.location = ('<?php echo home_url('/register/'); ?>');
        });

        // PHAN LAY LAI PASSWORD BI QUEN
        // KHI CLICK SUBMIT CHO SHOW HINIH WIATING
        jQuery('#submit-getPass').click(function() {
            jQuery('#waiting-img').show();
        });
        // KHI NHAP LAI EMAIL XOA CAU THONG BAO
        jQuery('#g-email').keypress(function() {
            jQuery('#forgetPassMess').text('');
            jQuery('#emailMess').text('');
        });
        jQuery('#g-passport').keypress(function() {
            jQuery('#forgetPassMess').text('');
            jQuery('#passportMess').text('');
        });
        //NUT CANCEL
        jQuery('#cancel-getPass').click(function() {
            jQuery('#ForgetPass').modal('hide');
            jQuery('#g-email').val('');
            jQuery('#forgetPassMess').text('');
            jQuery('#emailMess').text('');
            jQuery('#passportMess').text('');
        });


    });
</script>