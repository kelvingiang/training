<?php  
    if(!empty($_SESSION['txt-username'])) {
        unset($_SESSION['txt-username']); //xóa session login
        wp_redirect(home_url('member-login')); //về trang login
    }
?>