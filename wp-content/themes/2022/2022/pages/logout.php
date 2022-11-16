<?php
/*
  Template Name: Logout Page
 */
ob_start(); 
// get_header(); 
// echo '<br>'.$_SESSION['login'];

if (isset($_SESSION['login']) || $_SESSION['login'] == '') {
 //   echo '<br> session có'.$_SESSION['login'];
    unset($_SESSION['login']);
    unset($_SESSION['login_id']);
    unset($_SESSION['email']);
    unset($_SESSION['login_type']);
    unset($_SESSION['company']);
   wp_redirect(home_url());
}else{
    echo 'sai roi';
}
//echo '<br> session dang nhap sau cung'. $_SESSION['login'];
//get_footer();
wp_redirect(home_url());
 ob_flush();