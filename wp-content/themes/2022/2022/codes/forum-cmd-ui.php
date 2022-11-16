<?php
/* forum comment ui style ---------------------------------------------------- */

function suite_comment($comment, $args, $depth)
{
    $GLOBAL['comment'] = $comment;
    $arrArgs = array(
        'post_type' => 'member',
        'meta_query' => array(
            array('key' => 'm_user', 'value' => get_comment_author()),
        )
    );
    /*  KIEM TRA DU LIEU CO TRUNG HOP KHONG */
    $objMember = current(get_posts($arrArgs));
    $getMeta = get_post_meta($objMember->ID);
    $member_img = $getMeta['m_image'][0];
    if ($member_img == '') {
        $avatar = 'm_img.jpg';
    } else {
        $avatar = $member_img;
    }
    $author = $getMeta['m_user'][0];
    if (empty($author)) {
        $author_name = 'Admin';
    } else {
        $author_name =  $getMeta['m_fullname'][0] . ' <span style="color : #AAAAAA">( ' . $getMeta['m_user'][0] . ' )</span>';
    }
?>
    <li <?php comment_class() ?> id="li-comment-<?php comment_ID(); ?>">
        <div id="comment-<?php comment_ID(); ?>" class="clearfix comment-item ">
            <div class="comment-author vcard row ">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <img class="avatar" src="<?php echo PART_IMAGES_AVATAR . $avatar; ?>" />
                    <?php printf(__('<lable class=fn>%s</lable>'), $author_name); ?>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <lable class="comment-meta commentmetadata">
                        <?php comment_time('H:i') ?> --
                        <?PHP printf(get_comment_date('d-m-Y')); ?> <?php edit_comment_link(__('(Eidt)', '', '')); ?>
                    </lable>
                </div>
                <!-- phan kiem tra bai cmt duoc approved hay khong trong bai nay khong use den chuc nang nay -->
                <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php echo 'your comment is waiting for moderation' ?></em>
                <?php endif; ?>
            </div>
            <div class="comment-body commentbody spaceTop">
                <?php comment_text() ?>
                <p class="reply">
                    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                </p>
            </div>
        </div>

    <?php
}

  /*===================================================================*/ 
    /*
function list_posts_by_taxonomy( $post_type, $taxonomy, $get_terms_args = array(), $wp_query_args = array() ){
    $tax_terms = get_terms( $taxonomy, $get_terms_args );
    if( $tax_terms ){
        foreach( $tax_terms  as $tax_term ){
            $query_args = array(
                'post_type' => $post_type,
                "$taxonomy" => $tax_term->slug,
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'ignore_sticky_posts' => true
            );
            $query_args = wp_parse_args( $wp_query_args, $query_args );
 
            $my_query = new WP_Query( $query_args );
            if( $my_query->have_posts() ) { ?>
    <h2 id="<?php echo $tax_term->slug; ?>" class="tax_term-heading"><?php echo $tax_term->name; ?></h2>
    <ul>
        <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
        <li><a href="<?php the_permalink() ?>" rel="bookmark"
                title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
        <?php endwhile; ?>
    </ul>
    <?php
            }
            wp_reset_query();
        }
    }
}
*/