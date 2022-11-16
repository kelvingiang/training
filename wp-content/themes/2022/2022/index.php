<?php
// lay phan header
get_header();
?>
<!-- phan noi dung of trang index --------------------------------------- -->
<div> <?php mySlider('home') ?> </div>
<div id="map-computer"> <?php get_template_part('templates/template', 'home-map-small'); ?> </div>
<div id="map-mobile"> <?php get_template_part('templates/template', 'home-map-small-mobile'); ?> </div>
<div> <?php get_template_part('templates/template', 'home-current-presidents'); ?></div>
<div> <?php get_template_part('templates/template', 'home-event'); ?> </div>
<div> <?php get_template_part('templates/template', 'footer') ?></div>
<?php
// lay phan footer
get_footer();
