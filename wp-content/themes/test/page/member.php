<?php ob_start(); ?>
<?php
/*
  Template Name:  Member Page (Test) 
 */
?>
<?php get_header(); ?>
<?php 
  //kiểm tra khi session bằng rỗng
  if (empty($_SESSION['txt-username']) || $_SESSION['txt-username'] == '') {
    wp_redirect(home_url('member-login')); //về login page
  }else{ //vào member page
?>
<div class="row" style="margin-top: 100px">
    <div class="button-row btn-group">
      <!-- logout -->
      <button type="submit" name="btn-member-logout" id="btn-member-logout" 
        class="button button-primary button-large btn-logout">
        <a href="<?php echo home_url('member-logout') ?>"><?php echo __('Sign Out') ?></a>
      </button>
      <!-- change-pass -->
      <button type="submit" name="btn-member-change-pass" id="btn-member-change-pass" 
        class="button button-primary button-large btn-change-pass">
        <a href="<?php echo home_url('member-change-password') ?>"><?php echo __('Change Password') ?></a>
      </button>
    </div>
    <!-- gọi đến trang template-member.php -->
    <div class=" member col-lg-7"><?php get_template_part('template/template', 'member'); ?></div>
    <!-- gọi đến trang template-member-category.php --> 
    <div class=" member col-lg-5"><?php get_template_part('template/template', 'member-category'); ?></div> 
  </div>
<?php } ?>
<?php get_footer();