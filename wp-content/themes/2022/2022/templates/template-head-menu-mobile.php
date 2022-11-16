<?php
if (isset($_SESSION['login'])) {
    $login_type = $_SESSION['login_type'];
} else {
    $login_type = 0;
}
?>
<style>
    .menu-item-14710,
    .menu-item-14711,
    .menu-item-66,
    .menu-item-71,
    .menu-item-2038,
    .menu-item-2039 {
        display: none;
    }
</style>
<!--MAIN MENU FOR MOBILE-->
<div id="menu-mobile">
    <div id="mobile-menu-icon">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </div>

    <div id="mobile-menu-content">
        <div class="ex-mobile-menu">
            <a href="<?php echo HOME_LINK ?>">
                <i class="fa fa-home" aria-hidden="true"></i>
            </a>
        </div>
        <?php
        switch ($_SESSION['languages']) {
            case 'cn':
                mobile_menu('mobile-menu-cn');
                break;
            case 'en':
                mobile_menu('mobile-menu-en');
                break;
            case 'vn':
                mobile_menu('mobile-menu-vn');
                break;
        }
        ?>
        <div class="ex-mobile-menu">
            <?php if (empty($_SESSION['login_id'])) { ?>
                <a href="<?php echo HOME_LINK . '/member-login' ?>" title="<?php _e('Login') ?>">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </a>
            <?php } else { ?>
                <div class="login-success">
                    <label>
                        <?php
                        echo $_SESSION['login'];
                        echo " " . __('How Are You');
                        ?>

                    </label>
                    <?php get_template_part('templates/template', 'login-success') ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function() {
        var login_type = "<?php echo $login_type ?>";

        if (login_type === "apply") {
            // local =================================================
            //menu tieng viet
            jQuery('.menu-item-66').css('display', 'block');
            jQuery('.menu-item-71').css('display', 'none');
            // menu tieng hoa                
            jQuery('.menu-item-14710').css('display', 'block');
            jQuery('.menu-item-14711').css('display', 'none');


            // hosting ==========================================================
            jQuery('.menu-item-2039').css('display', 'block');
            jQuery('.menu-item-2038').css('display', 'none');
        }

        if (login_type === "recruit" || login_type === "on") {
            // local ==================================================
            // menu tieng viet
            jQuery('.menu-item-66').css('display', 'none');
            jQuery('.menu-item-71').css('display', 'block');
            // menu tieng hoa
            jQuery('.menu-item-14710').css('display', 'none');
            jQuery('.menu-item-14711').css('display', 'block');

            // hosting ======================================================
            jQuery('.menu-item-2039').css('display', 'none');
            jQuery('.menu-item-2038').css('display', 'block');
        }
    });
</script>