<div style="position: fixed;  background-color: #fff; border-bottom: 2px #fff solid;  display: block; width: 100%;  z-index: 100; margin-bottom: 20px">
    <header id="header" role="banner">
        <section class="head-logo">
            <a href="<?php echo home_url(); ?>"><img src="<?php echo get_image('logo.png') ?>" width="60px" /></a>
        </section>
        <section class="head-title">
            <h4 style=" font-weight: bold; letter-spacing: 5px"><?php _e('Dong Nai Taiwan Chamber of Commerce'); ?> </h4>
            <h5>   HIỆP HỘI THUƠNG MẠI ĐÀI LOAN TẠI ĐỒNG NAI</h5>
        </section>   
        <section class="head-search">
            <?php get_search_form(); ?>
        </section>
    </header>
    <div id="menu">
       <?php get_template_part('component/template', 'menu');  ?>
    </div>
</div>


