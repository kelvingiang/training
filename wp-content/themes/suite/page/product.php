<?php ob_start(); ?>
<?php
/*
  Template Name:  Product Page 
 */
?>
<?php get_header(); ?>
<?php 
  //kiểm tra khi session bằng rỗng
  if (empty($_SESSION['txt-username']) || $_SESSION['txt-username'] == '') {
    wp_redirect(home_url('product-login')); //về login page
  }else{ //vào product page
?>

  <div class="row" style="margin-top: 100px">
    <div class="button-row btn-group">
      <!-- logout -->
      <button type="submit" name="btn-product-logout" id="btn-product-logout" 
        class="button button-primary button-large btn-logout">
        <a href="<?php echo home_url('product-logout') ?>"><?php echo __('Sign Out') ?></a>
      </button>
      <!-- change-pass -->
      <button type="submit" name="btn-product-change-pass" id="btn-product-change-pass" 
        class="button button-primary button-large btn-change-pass">
        <a href="<?php echo home_url('product-change-password') ?>"><?php echo __('Change Password') ?></a>
      </button>
    </div>
    <!-- gọi đến trang template-product.php -->
    <div class=" product col-lg-7"><?php get_template_part('template/template', 'product'); ?></div>
    <!-- gọi đến trang template-product-category.php --> 
    <div class=" product col-lg-5"><?php get_template_part('template/template', 'product-category'); ?></div> 
  </div>
<?php } ?>

<?php get_footer();
ob_end_flush() ?>
