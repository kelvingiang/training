<div style="position: fixed; background-color: #fff; border-bottom: 2px #fff solid;  display: block; width: 100%;  z-index: 100; margin-bottom: 20px">
    <header id="header" role="banner">
        <section class="head-logo">
           <a href="<?php echo home_url(''); ?>"><img src="<?php echo get_image('logo.png') ?>" width="60px" /></a>
        </section>
        <section class="head-title">
            <h4 title="Digiwin đào tạo" style=" font-weight: bold; letter-spacing: 5px; margin-top:5px; font-size:20px">
                <?php _e('Digiwin Training'); ?> 
            </h4>
            <h6 style="margin-top: 10px; color:blueviolet">Tầng 12A Golden King, Nguyễn Lương Bằng Q7</h6>
        </section>   
        <section class="head-search">
            <?php get_search_form(); ?>
        </section>
    </header>
    <?php get_template_part('template/template', 'menu'); ?>
</div>
<div class="row"><?php get_template_part('template/template', 'slider'); ?></div>


