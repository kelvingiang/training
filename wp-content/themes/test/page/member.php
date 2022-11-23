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
<!-- hien thi slider trang home -->
<div><?php mySlider(3); ?></div>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12">
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
    </div>
  </div>  
  <div class="row">
    <!-- gọi đến trang template-member.php -->
    <div class="col-lg-8 col-md-12 order-lg-1 order-md-2"><?php get_template_part('template/template', 'member'); ?></div>
    <!-- gọi đến trang template-member-category.php --> 
    <div class="col-lg-4 col-md-12 order-lg-2 order-md-1"><?php get_template_part('template/template', 'member-category'); ?></div> 
  </div>
</div>
<?php } ?>
<?php get_footer();