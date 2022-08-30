<?php
/*
  Template Name:  Product Page 
 */
?>
<?php get_header(); ?>

<div class="row" style="margin-top: 100px">
    <div class="first-space ">
        <div class="row">
            <!-- gọi đến trang template-product.php -->
            <div class=" product col-lg-7"><?php get_template_part('template/template', 'product'); ?></div>
            <!-- gọi đến trang template-product-category.php --> 
            <div class=" product col-lg-5"><?php get_template_part('template/template', 'product-category'); ?></div> 
    </div>
</div>

<?php get_footer();
