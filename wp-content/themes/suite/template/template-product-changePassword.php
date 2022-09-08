<?php 
    $check = '';
    if(isPost()){
        require_once(DIR_MODEL . 'product_model_function.php');
        $model = new Product_Model_Function();
        $check = $model->changeProductPassword(md5($_POST['txt-currentPass']),md5($_POST['txt-newPass'])) ;           
    } 
?>
<form action="" method="post" enctype="multipart/form-data" id="f_product_change_pass" name="f_product_change_pass" >
    <div class="col-md-4"></div>
    <div class="col-md-4 login-form">
        <h5 class="lbl-login">Change Password</h5>
        <div class="form-group">
            <label for="current_pass" class="lbl-form"><?php echo __('Current Password') ?> <i class="error" id="cur_pass_merss"></i></label>
            <input type="password" class="form-control " name="txt-currentPass" id="txt-currentPass"
                placeholder="Enter the current password"/>
            <input type="checkbox" onclick="showCurrentPassword()">Show
        </div> 
        <!-- new pass -->
        <div class="form-group">
            <label for="new_pass" class="lbl-form"><?php echo __('New Password') ?> <i class="error" id="new_pass_merss"></i></label>
            <input type="password" class="form-control " name="txt-newPass" id="txt-newPass"
                placeholder="Enter the new password"/>
            <input type="checkbox" onclick="showNewPassword()">Show
        </div> 
        <!-- confirm pass -->
        <div class="form-group">
            <label for="confirm_pass" class="lbl-form"><?php echo __('Confirm Password') ?> <i class="error" id="confirm_pass_merss"></i></label>
            <input type="password" class="form-control " name="txt-confirmPass" id="txt-confirmPass"
                placeholder="Enter the confirm password"/>
            <i class="error" id="check_confirm_pass_merss"></i>    
        </div> 
        <span style="margin-bottom:10px; font-size: 15px; font-weight:bold; color:red; text-align:center">
            <?php echo $check; ?>
        </span>
        <div style="clear: both"></div>
        <div class="button-row">
            <button type="submit" name="btn-product-change" id="btn-product-change" class="button button-primary button-large btn-login">
                <a><?php echo __('Change') ?></a>
            </button>    
        </div>
    </div>         
</form>
<script type="text/javascript">

    jQuery(document).ready(function() {
        jQuery('#btn-product-change').click(function(e) {
            //kiểm tra current pass không rỗng
            var serialVal = jQuery('#txt-currentPass').val();
            if (serialVal === '') {
                jQuery('#cur_pass_merss').text('<?php echo __('please input the current password'); ?>');
                e.preventDefault();
            }
            //kiểm tra new pass không rỗng
            var serialVal = jQuery('#txt-newPass').val();
            if (serialVal === '') {
                jQuery('#new_pass_merss').text('<?php echo __('please input the new password'); ?>');
                e.preventDefault();
            }
            //kiểm tra new pass không rỗng
            var serialVal = jQuery('#txt-confirmPass').val();
            if (serialVal === '') {
                jQuery('#confirm_pass_merss').text('<?php echo __('please input the confirm password'); ?>');
                e.preventDefault();
            }
        });

        jQuery('#txt-confirmPass').on('keyup', function() {
            if(jQuery('#txt-newPass').val() == jQuery('#txt-confirmPass').val()) {
                console.log('aaa');
                jQuery('#check_confirm_pass_merss').html('Password matching!').css('color', 'green');
                jQuery('#btn-product-change').attr("disabled", false).addClass('btn-login').removeClass('btn-disabled');
            }else{
                jQuery('#check_confirm_pass_merss').html('Password not matching!').css('color', 'red');
                jQuery('#btn-product-change').attr("disabled", true).addClass('btn-disabled'); 
            }
        });

    })

    function showCurrentPassword() {
        var str = document.getElementById('txt-currentPass');
        str.type === "password" ? str.type = "text" : str.type = "password";        
    }
    function showNewPassword() {
        var str = document.getElementById('txt-newPass');
        str.type === "password" ? str.type = "text" : str.type = "password";
    }
</script>