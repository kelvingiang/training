<div id="headers">
    <div id="headers-logo">
        <a href="<?php echo home_url(''); ?>"><img src="<?php echo get_image('logo.png') ?>" width="75px" /></a>
        <div class="header-title">
            <label title="Digiwin đào tạo"><?php _e('Digiwin Training'); ?></label>
            <br>
            <label>Tầng 12A Golden King, Nguyễn Lương Bằng Q7</label>
        </div> 
    </div>
    <div class="header-search">
        <?php get_search_form(); ?>
    </div>
</div>
<?php get_template_part('template/template', 'menu'); ?>
<div><?php get_template_part('template/template', 'slider'); ?></div>


