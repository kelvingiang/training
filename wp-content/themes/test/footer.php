<div class="clear"></div>
</div> 
<?php  if(! is_category())  { ?>
<footer id="footer" role="contentinfo" class="footer">
    <div id="info" class="row">
        <div class="col-lg-6 col-md-4 col-sm-12 col-xs12" style="float: left; padding: 15px;">
            <h3 style="font-size: 15px; font-weight:bold; margin-bottom:10px"><?php echo _('LIÊN HỆ CHÚNG TÔI')?></h3>
            <p> <?php echo __('Address') . '&nbsp; : &nbsp;' . get_option('commerce_address') ?></p>
            <?php if (!empty(get_option('commerce_mobile'))) { ?>
                <p> <?php echo __('Mobile') . '&nbsp; : &nbsp;' . get_option('commerce_mobile') ?></p>
            <?php } ?>
            <p> <?php echo __('Phone') . '&nbsp; : &nbsp;' . get_option('commerce_phone') ?></p>
            <p> <?php echo __('Fax') . '&nbsp; : &nbsp;' . get_option('commerce_fax') ?></p>
            <p>  <?php echo __('Email') . '&nbsp; : &nbsp;' . get_option('commerce_email') ?></p>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12" style="float: right; padding: 15px">
            <div style="width: 150px; text-align: left"><label><i style="letter-spacing: 4px"><?php _e('Online now'); ?>: 1</i></label></div>
            <div style="width: 150px; text-align: left"><label><i style="letter-spacing: 4px"> <?php _e('Online Total'); ?>:</i></label></div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12" style=" padding: 15px;">
            <h3 style="font-size: 15px; font-weight:bold; margin-bottom:10px"><?php echo _('LIÊN kẾT')?></h3>
            <a href="https://www.facebook.com/Digiwinsoftvn" class="social-link" target="_blank">Facebook</a> |
            <a href="https://zalo.me/2873315813915643766" class="social-link" target="_blank">Zalo</a> |
            <a href="https://www.digiwin.com.vn/" class="social-link" target="_blank">Google</a> |
            <a href="https://www.linkedin.com/company/digiwinsoft-asean/" class="social-link" target="_blank">Linkedin</a> |
            <a href="https://www.youtube.com/channel/UC5wPn6YNU6KHkrgAjCIojVA" class="social-link" target="_blank">Youtube</a> 
        </div>
    </div> 
    <div class="clear"></div>
    <div id="copyright" >
        <?php
        echo sprintf(__('%1$s %2$s %3$s. All Rights Reserved.', 'blankslate'), '&copy;', date('Y'), esc_html(get_bloginfo('name')));
        echo sprintf(__(' Theme By: %1$s.', 'blankslate'), '<a href="http://digiwin.com/">鼎捷(越南)軟件有限公司</a>');
        ?>
    </div>
</footer>
<?php }?>
<!-- <div id="face-space"><a href="https://www.facebook.com/groups/910977865600074/" target="blank"><i class="fab fa-facebook-square"></i></a></div>  -->

<div id="back-top-wrapper" >
    <a id="back-top" ><i class="fas fa-chevron-circle-up"></i>
</div>
<script>
    jQuery(document).ready( function () {
        jQuery('.primary-menu').superfish();
    });
    
</script>

</body>
</html>