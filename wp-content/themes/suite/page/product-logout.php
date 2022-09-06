<?php ob_start()?>
<?php
/*
  Template Name:  Product Logout Page 
 */
?>
<?php get_header(); ?>

<div class="row" style="margin-top: 100px">

    <!-- gọi đến trang template-product-logout.php -->
    <?php get_template_part('template/template', 'product-logout'); ?>
</div>

<?php get_footer();
ob_end_flush() ?>