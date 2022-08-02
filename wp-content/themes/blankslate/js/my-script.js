jQuery(document).ready(function () {
    // START MENU
    jQuery('nav.main-menu ul.sf-menu').superfish();

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
});

