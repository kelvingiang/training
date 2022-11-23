<div class="clear"></div>
</div></div>
<footer role="contentinfo" class="footer">
    <div class="row info">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <h3><?php echo _('LIÊN HỆ CHÚNG TÔI')?></h3>
            <p> <?php echo __('Address') . '&nbsp; : &nbsp;' . get_option('commerce_address') ?></p>
            <?php if (!empty(get_option('commerce_mobile'))) { ?>
                <p> <?php echo __('Mobile') . '&nbsp; : &nbsp;' . get_option('commerce_mobile') ?></p>
            <?php } ?>
            <p> <?php echo __('Phone') . '&nbsp; : &nbsp;' . get_option('commerce_phone') ?></p>
            <p> <?php echo __('Fax') . '&nbsp; : &nbsp;' . get_option('commerce_fax') ?></p>
            <p>  <?php echo __('Email') . '&nbsp; : &nbsp;' . get_option('commerce_email') ?></p>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12" style="margin-top: 10px">
            <div style="width: 150px; text-align: left"><label><i style="letter-spacing: 4px"><?php _e('Online now'); ?>: 1</i></label></div>
            <div style="width: 150px; text-align: left"><label><i style="letter-spacing: 4px"> <?php _e('Online Total'); ?>:</i></label></div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
            <h3><?php echo _('LIÊN kẾT')?></h3>
            <a href="https://www.facebook.com/Digiwinsoftvn" class="social-link" target="_blank">Facebook</a> |
            <a href="https://zalo.me/2873315813915643766" class="social-link" target="_blank">Zalo</a> |
            <a href="https://www.digiwin.com.vn/" class="social-link" target="_blank">Google</a> |
            <a href="https://www.linkedin.com/company/digiwinsoft-asean/" class="social-link" target="_blank">Linkedin</a> |
            <a href="https://www.youtube.com/channel/UC5wPn6YNU6KHkrgAjCIojVA" class="social-link" target="_blank">Youtube</a> 
        </div>
    </div> 
    <div class="clear"></div>
    <div class="copyright" >
        <?php
        echo sprintf(__('%1$s %2$s %3$s. All Rights Reserved.', 'blankslate'), '&copy;', date('Y'), esc_html(get_bloginfo('name')));
        echo sprintf(__(' Theme By: %1$s.', 'blankslate'), '<a href="http://digiwin.com/">鼎捷(越南)軟件有限公司</a>');
        ?>
    </div>
</footer>
<!-- <div id="face-space"><a href="https://www.facebook.com/groups/910977865600074/" target="blank"><i class="fab fa-facebook-square"></i></a></div>  -->

<div id="back-top-wrapper" >
    <a id="back-top" ><i class="fas fa-chevron-circle-up"></i>
</div>

<script>
    //Hien thi menu mobile
    jQuery('#menu-mobile-icon').on('click', function(e) {
        var show = jQuery('#menu-mobile-content').hasClass('show-nav');
        if(!show){
            jQuery('#menu-mobile-content').addClass('show-nav');
            jQuery('#menu-mobile-content').removeClass('close-nav');
        }else{
            jQuery('#menu-mobile-content').addClass('close-nav');
            jQuery('#menu-mobile-content').removeClass('show-nav');
        }
    })

    jQuery('.menu-item-has-children a').on('click', function(e) {
        jQuery(this).siblings('.sub-menu').slideToggle('slow');
    })
</script>
<script>
    jQuery(document).ready( function () {
        jQuery('.primary-menu').superfish();

        // back to top
        jQuery(function () {
            jQuery(window).scroll(function () {
                if (jQuery(this).scrollTop() > 100) {
                    jQuery('#back-top').fadeIn('fast');
                } else {
                    jQuery('#back-top').fadeOut(1500);
                }
            });
            // scroll body to 0px on click
            jQuery('#back-top').click(function () {
                jQuery('body,html').stop(false, false).animate({
                    scrollTop: 0
                }, 1000);
                return false;
            });
        });

        // Khoi tao chay slider
        jQuery('.skitter-large').skitter({
            dots: false,
            interval: 5000, //thoi gian chuyen ma hinh
            label: true,
        });

        // Phan an hien menu
        var prevScrollpos = window.pageYOffset;
        window.onscroll = function() {
            // Phan an hien header trong mobile
            var currentScrollPos = window.pageYOffset;
            if(prevScrollpos > currentScrollPos) {
                document.getElementById("header-mobile").style.top = "0";
            } else {
                document.getElementById("header-mobile").style.top = "-320px";
            }
            prevScrollpos = currentScrollPos;
        }
    });
    
</script>

</body>
</html>