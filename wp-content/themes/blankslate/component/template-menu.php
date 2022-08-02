<div class="computer-menu">
    <?php get_menu('main-menu'); ?>
</div>
<div class="mobile-menu">
    <div><i class='fas fa-list-alt' style='font-size:30px;color: #800606; cursor:  pointer'></i></div>
        <?php get_menu('cell-menu'); ?>
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {

        jQuery('.mobile-menu').click(function () {
            jQuery('.cell-menu').children('ul').removeClass('sf-menu');
            var dis = jQuery(this).children('.cell-menu').css('display');
            if (dis === 'none') {
                jQuery(this).children('.cell-menu').slideDown();
            } else {
                jQuery(this).children('.cell-menu').slideUp();
            }
        });
    });
</script>