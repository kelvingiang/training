<?php 
    $check = '';
    if(isPost()){
        require_once(DIR_MODEL . 'admin-model-member-function.php');
        $model = new Admin_Model_Member_Function;
        $check = $model->memberLogin($_POST['txt-username'],md5($_POST['txt-password'])) ;           
    } 
?>
<form action="" method="post" enctype="multipart/form-data" id="f_member_login" name="f_member_login" >
    <div class="col-md-4"></div>
    <div class="col-md-4 login-form">
        <h5 class="lbl-login">Login</h5>
        <div class="form-group">
            <label for="user_name" class="lbl-form"><?php echo __('User Name') ?> <i class="error" id="user_merss"></i></label>
            <input type="text" class="form-control type-text" name="txt-username" id="txt-username"
                placeholder="Enter the user name"/>
        </div> 
        <div class="form-group">
            <label for="password" class="lbl-form"><?php echo __('Password') ?> <i class="error" id="pass_merss"></i></label>
            <input type="password" class="form-control type-text" name="txt-password" id="txt-password"
                placeholder="Enter the password"/>
            <input type="checkbox" onclick="showPassword()">Show Password   
        </div> 
        <span style="margin-bottom:10px; font-size: 15px; font-weight:bold; color:red; text-align:center">
            <?php echo $check; ?>
        </span>
        <div style="clear: both"></div>
        <div class="button-row">
            <button type="submit" name="btn-member-login" id="btn-member-login" class="button button-primary button-large btn-login">
                <a><?php echo __('Sign In') ?></a>
            </button>    
        </div>
    </div>
</form>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#btn-member-login').click(function(e) {

            //kiểm tra user name không rỗng
            var serialVal = jQuery('#txt-username').val();
            if (serialVal === '') {
                jQuery('#user_merss').text('<?php echo __('please input the user name'); ?>');
                e.preventDefault();
            }
            //kiểm tra password không rỗng
            var serialVal = jQuery('#txt-password').val();
            if (serialVal === '') {
                jQuery('#pass_merss').text('<?php echo __('please input the password'); ?>');
                e.preventDefault();
            }
        });
    })

    function showPassword() {
        var str =document.getElementById('txt-password');
        str.type === "password" ? str.type = "text" : str.type = "password";
    }
</script>