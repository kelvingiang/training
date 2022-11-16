<?php
/*
  Template Name: Branch  Page
 */
// neu bao loi PHP Warning: Cannot modify header information – headers already sent by
get_header();
echo $param['b'];
require_once DIR_CODES . 'my-list.php';
$my_list = new Codes_My_List();
$param = $wp->query_vars;
$branch_name = $my_list->get_country($param['b']);

$posts = get_posts([
    'post_type'  => 'brach',
    'title' => $branch_name,
]);

$branch_ID = $posts[0]->ID;


?>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class='head-title-<?php echo $_SESSION['languages'] ?>'>
            <h2> <?php echo $posts[0]->post_title; ?> </h2>
        </div>
        <div class="branch-bg">
            <div>
                <label>
                    <?php _e('President Name') ?> :
                </label>
                <label>
                    <?php echo get_post_meta($branch_ID, 'b_contact', true) ?>
                </label>
            </div>
            <div>
                <label>
                    <?php _e('Phone') ?> :
                </label>
                <label>
                    <?php echo get_post_meta($branch_ID, 'b_phone', true) ?>
                </label>
            </div>
            <div>
                <label>
                    <?php _e('Cell Phone') ?> :
                </label>
                <label>
                    <?php echo get_post_meta($branch_ID, 'b_tel', true) ?>
                </label>
            </div>
            <div>
                <label>
                    <?php _e('E_mail') ?> :
                </label>
                <label>
                    <?php echo get_post_meta($branch_ID, 'b_email', true) ?>
                </label>
            </div>
            <div>
                <label>
                    <?php _e('Chamber of Commerce Address') ?> :
                </label>
                <label>
                    <?php echo get_post_meta($branch_ID, 'b_address', true) ?>
                </label>
            </div>
            <div>
                <label> <?php _e('Introduction'); ?></label><br>
                <?php echo $posts[0]->post_content; ?>
            </div>
        </div>
    </div>
</div>


<?php
get_footer();
