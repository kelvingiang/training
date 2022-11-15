<div class="header">
    <div class="header-logo">
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
<div class="menu-computer"><?php get_template_part('template/template', 'menu'); ?></div>
<?php if( !is_single()) {?>
    <div><?php get_template_part('template/template', 'slider'); ?></div>
<?php } ?>