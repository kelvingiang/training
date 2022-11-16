<?php
if (isset($_SESSION['login'])) {
    $login_type = $_SESSION['login_type'];
} else {
    $login_type = 0;
}
?>
<style>
    .menu-item-14692,
    .menu-item-14693,

    .menu-item-14725,
    .menu-item-14726,
    .menu-item-2038,
    .menu-item-2039 {
        display: none;
    }
</style>

<!--MAIN MENU FOR COMPUTER-->

<div id="menu-computer">
    <div class="menu-computer-additional" title="<?php _e('Home') ?>">
        <a href="<?php echo HOME_LINK ?>">
            <i class="fa fa-home" aria-hidden="true"></i>
        </a>
    </div>
    <div>
        <?php
        switch ($_SESSION['languages']) {
            case 'cn':
                suite_menu('company-menu-cn');
                break;
            case 'en':
                suite_menu('company-menu-en');
                break;
            case 'vn':
                suite_menu('company-menu-vn');
                break;
        }
        ?>
    </div>
    <div class="menu-computer-additional">
        <?php if (empty($_SESSION['login_id'])) { ?>
            <a href="<?php echo HOME_LINK . '/member-login' ?>" title="<?php _e('Login') ?>">
                <i class="fa fa-user" aria-hidden="true"></i>
            </a>
        <?php } else { ?>
            <div class="login-success">
                <label> <?php echo $_SESSION['login'] ?>
                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                </label>
                <?php get_template_part('templates/template', 'login-success') ?>
            </div>
        <?php } ?>
    </div>
</div>


<script>
    jQuery(document).ready(function() {
        var login_type = "<?php echo $login_type ?>";

        if (login_type === "apply") {
            // local =================================================

            // menu tieng hoa                
            jQuery('.menu-item-14692').css('display', 'none');
            jQuery('.menu-item-14693').css('display', 'block');
            //menu tieng viet
            jQuery('.menu-item-66').css('display', 'block');
            jQuery('.menu-item-71').css('display', 'none');



            // hosting ==========================================================
            jQuery('.menu-item-2039').css('display', 'block');
            jQuery('.menu-item-2038').css('display', 'none');
        }

        if (login_type === "recruit" || login_type === "on") {
            // local ==================================================

            // menu tieng hoa
            jQuery('.menu-item-14692').css('display', 'block');
            jQuery('.menu-item-14693').css('display', 'none');
            // menu tieng viet
            jQuery('.menu-item-66').css('display', 'none');
            jQuery('.menu-item-71').css('display', 'block');


            // hosting ======================================================
            jQuery('.menu-item-2039').css('display', 'none');
            jQuery('.menu-item-2038').css('display', 'block');
        }
    });
</script>