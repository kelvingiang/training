<?php
$arr = array(
    'post_type' => 'member',
    'meta_query' => array(
        array('key' => 'm_user', 'value' => @$_SESSION['login'])
    ),
);
$objMember = current(get_posts($arr));
//$_SESSION['login_id'] = $objMember->ID;
if ($objMember) {
    $getMeta = get_post_meta($objMember->ID); // lay gia tri tu metabox 
    $m_image = $getMeta['m_image'][0]; //
}
?>
<div class="login-success-content">

    <div>
        <a href="<?php echo home_url('/register/') ?>">
            <?php _e('Profile'); ?>
        </a>
    </div>

    <?php
    if ($_SESSION['login_type'] == 'recruit') {
    ?>
        <div>
            <a href="<?php echo home_url('/recruit/?dt=4') ?>">
                <?php _e('Recruit'); ?>
            </a>
        </div>
    <?php
    } elseif ($_SESSION['login_type'] == 'apply') { ?>
        <div>
            <a href="<?php echo home_url('/recruit/?dt=3') ?>">
                <?php _e('Curriculum Vitae') ?>
            </a>
        </div>
    <?php } else { ?>
        <div>
            <a href="<?php echo home_url('/article/') ?>">
                <?php _e('Article', 'suite'); ?>
            </a>
        </div>
        <div>
            <a href="<?php echo home_url('/recruit/?dt=4') ?>">
                <?php _e('dangtuyen', 'suite'); ?>
            </a>
        </div>
    <?php } ?>
    <div>
        <a href="<?php echo home_url('/logout/'); ?>">
            <?php _e('Logout'); ?>
        </a>
    </div>

</div>