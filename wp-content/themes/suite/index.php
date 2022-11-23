<?php get_header(); ?>
<div class="row">
    <h1 class="home-title"><?php _e('Welcome to home page') ?></h1>
    <div class="col-xl-3 col-lg-3 col-md-12">
        <ul class="list-group home-item">
            <li class="list-group-item active" aria-current="true"> </li>
            <li  class="list-group-item">
                <!-- gọi đến single.php -->
                <a href="<?php echo home_url('2022/08/09/hello-wordpress/'); ?>"><?php _e('Post') ?></a>
            </li>
            <li class="list-group-item">
                <!-- gọi đến template-member.php -->
                <a href="<?php echo home_url('members'); ?>"><?php _e('Member') ?> </a>
            </li>
            <li class="list-group-item">
                <!-- gọi đến template-product-login.php -->
                <a href="<?php echo home_url('product-login'); ?>"><?php _e('Product Login') ?> </a>
            </li>
        </ul>    
    </div>
    <div class="col-xl-9 col-lg-9 col-md-12">
        <?php get_template_part('template/template', 'slider-multi'); ?>
    </div>
</div>
<?php get_footer(); ?>