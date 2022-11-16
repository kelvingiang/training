<!--  phan login  --> 
<div id="login">
    <div id="login-yet">
        <h3> Login </h3>
        <p>hay su dung tai khoang cua ban, <a href="<?php echo home_url('/register/') ?>">đăng ký tại đây</a>.</p>
        <?php
        $args = array(
            'redirect' => site_url($_SERVER['REQUEST_URI']),
            'form_id' => 'dangnhap', //Để dành viết CSS
            'label_username' => __('Tên tài khoản'),
            'label_password' => __('Mật khẩu'),
            'label_remember' => __('Ghi nhớ'),
            'label_log_in' => __('Đăng nhập'),
        );
        wp_login_form($args);
        ?>
    </div>
    <div id="login-success">
        <h3> hello</h3>
    </div>
    
</div>

<?php
$login = (isset($_GET['login']) ) ? $_GET['login'] : 0;
if ($login === "failed") {
    echo '<p><strong>ERROR:</strong> Sai username hoặc mật khẩu.</p>';
} elseif ($login === "empty") {
    echo '<p><strong>ERROR:</strong> Username và mật khẩu không thể bỏ trống.</p>';
} elseif ($login === "false") {
    echo '<p><strong>ERROR:</strong> Bạn đã thoát ra.</p>';
} elseif ($login === 'success') {
    echo '<p><strong>success:</strong> dang nhap thanh cong.</p>';
}
?>


<!--  phan dang ky  --->
<?php if(is_user_logged_in()) { $user_id = get_current_user_id();
$current_user = wp_get_current_user();
$profile_url = get_author_posts_url($user_id);
$edit_profile_url = get_edit_profile_url($user_id);
?>
<div class="regted">
    Bạn đã đăng nhập với tên nick <a href="<?php echo $profile_url ?>"><?php echo $current_user->display_name; ?></a> Bạn có muốn <a href="<?php echo esc_url(wp_logout_url($current_url)); ?>">Thoát</a> không ?
</div>
    <?php } else { ?>
<div class="dangkytaikhoan">
    <?php
    $err = '';
    $success = '';
    global $wpdb, $PasswordHash, $current_user, $user_ID;
    if(isset($_POST['task']) && $_POST['task'] == 'register' ) {
    $pwd1 = $wpdb->escape(trim($_POST['pwd1']));
    $pwd2 = $wpdb->escape(trim($_POST['pwd2']));
    $email = $wpdb->escape(trim($_POST['email']));
    $username = $wpdb->escape(trim($_POST['username']));

    if( $email == "" || $pwd1 == "" || $pwd2 == "" || $username == "") {
    $err = 'Vui lòng không bỏ trống những thông tin bắt buộc!';
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err = 'Địa chỉ Email không hợp lệ!.';
    } else if(email_exists($email) ) {
    $err = 'Địa chỉ Email đã tồn tại!.';
    } else if($pwd1 <> $pwd2 ){
    $err = '2 Password không giống nhau!.';
    } else {

    $user_id = wp_insert_user( array ('user_pass' => apply_filters('pre_user_user_pass', $pwd1), 'user_login' => apply_filters('pre_user_user_login', $username), 'user_email' => apply_filters('pre_user_user_email', $email), 'role' => 'subscriber' ) );
    if( is_wp_error($user_id) ) {
    $err = 'Error on user creation.';
    } else {
    do_action('user_register', $user_id);

    $success = 'Bạn đã đăng ký thành công!';
    }
    }
    }
    ?>
    <!--display error/success message-->
    <div id="message">
        <?php
        if(!empty($err) ) :
        echo '<p class="thongbaoregloi">'.$err.'</p>';
        endif;
        ?>

        <?php
        if(!empty($success) ) :
        $login_page = home_url();
        echo '<p class="regsuccess">'.$success. '<a href='.$login_page.'> Đăng nhập</a>'.'</p>';
        endif;
        ?>
    </div>
    <form method="post">
        <div class="row"><label>Tên đăng nhập</label><input class="input" type="text" value="" name="username" id="username" /></div>
        <div class="row"><label>Email</label><input id="email" class="input" type="text" value="" name="email" id="email" /></div>
        <div class="row"><label>Password</label><input class="input" type="password" value="" name="pwd1" id="pwd1" /></div>
        <div class="row"><label>Nhập lại Password</label><input class="input" type="password" value="" name="pwd2" id="pwd2" /></div>
        <button type="submit" name="btnregister" class="submit-reg button button-primary" >Đăng ký</button>
        <input type="hidden" name="task" value="register" />
    </form>
</div>
<div class="thongbaologin">
    <?php
    $login = (isset($_GET['login']) ) ? $_GET['login'] : 0;
    if ( $login === "failed" ) {
    echo '<p><strong>ERROR:</strong> Sai username hoặc mật khẩu.!</p>';
    } elseif ( $login === "empty" ) {
    echo '<p><strong>ERROR:</strong> Username và mật khẩu không thể bỏ trống.</p>';
    } elseif ( $login === "false" ) {
    echo '<p><strong>ERROR:</strong> Bạn đã thoát ra.</p>';
    }
    ?>
</div>
<?php } ?>