<div class="clear"></div>
</div>
<?php  if(! is_category())  { ?>
<footer id="footer" role="contentinfo">
    <div id="info" class="row">
        <?php
        require_once (DIR_CLASS . 'online-counter.php');
        $online_count = new Online_counter();
        ?>
        <div  class="col-lg-9 col-md-8 col-sm-12 col-xs12" style="float: left">
            <p> <?php echo __('Address') . '&nbsp; : &nbsp;' . get_option('commerce_address') ?></p>
            <?php if (!empty(get_option('commerce_mobile'))) { ?>
                <p> <?php echo __('Mobile') . '&nbsp; : &nbsp;' . get_option('commerce_mobile') ?></p>
            <?php } ?>
            <p> <?php echo __('Phone') . '&nbsp; : &nbsp;' . get_option('commerce_phone') ?></p>
            <p> <?php echo __('Fax') . '&nbsp; : &nbsp;' . get_option('commerce_fax') ?></p>
            <p>  <?php echo __('Email') . '&nbsp; : &nbsp;' . get_option('commerce_email') ?></p>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12" style="float: right;">
            <div style="width: 150px; text-align: left"><label><i style="letter-spacing: 4px"><?php _e('Online now'); ?>:</i> <i><?php echo $online_count->online(); ?></i></label></div> 
            <div style="width: 150px; text-align: left"><label><i style="letter-spacing: 4px"> <?php _e('Online Total'); ?>:</i><i><?php $online_count->total(); ?></i></label></div>
        </div>


    </div> 
    <div class="clear"></div>
    <div id="copyright">
        <?php
        echo sprintf(__('%1$s %2$s %3$s. All Rights Reserved.', 'blankslate'), '&copy;', date('Y'), esc_html(get_bloginfo('name')));
        echo sprintf(__(' Theme By: %1$s.', 'blankslate'), '<a href="http://digiwin.com/">鼎捷(越南)軟件有限公司</a>');
        ?>
    </div>
</footer>
<?php  }?>
<div id="face-space"><a href="https://www.facebook.com/groups/910977865600074/" target="blank"><i class="fab fa-facebook-square"></i></a></div>

<div id="back-top-wrapper" >
    <a id="back-top" ><i class="fas fa-chevron-circle-up"></i>
</div>


<?php
require_once (DIR_CLASS . 'my-popup.php');
wp_footer();
?>
<style>
    #face-space{
        position:  fixed;
        left: 1px;
        top: 200px;
        z-index: 10;

    } 
    #face-space a{
        font-size: 30px; 
        color:#0458b6;
        margin: 2px 
    }
</style>
</body>
</html>