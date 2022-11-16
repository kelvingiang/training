<?php

function Post_list_style($category, $post_count)
{
?>
    <div>
        <?php
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $post_count,
            'category_name' => $category,
            'meta_query' => array(
                array(
                    'key'       => '_metabox_language',
                    'value'     =>  $_SESSION['languages'],
                    'compare'   => '=',
                ),
            ),
        );
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) :
            while ($wp_query->have_posts()) :
                $wp_query->the_post();
        ?>
                <div class="gray-group">
                    <div class="gray-title">
                        <a class="link-style" href="<?php the_permalink(); ?>"> <?php the_title() ?> </a>
                    </div>
                    <div class="gray-content"><?php the_content(); ?></div>
                </div>
        <?php
            endwhile;
        endif;
        wp_reset_postdata();
        wp_reset_query();
        ?>
    </div>

    <ul id="data-list" class="article-list">
        <?php
        // LAY CAC THONG TIN TRONG POST TYPE FORUM VA VI TRI LAY DONG THONG TIN

        $argsforum = array(
            'post_type' => 'post',
            'posts_per_page' => COUNT_POST_ANOTHER,
            'offset' => $post_count,
            'category_name' => $category,
            'orderby' => 'date',
            'order' => 'DESC',
            'meta_query' => array(
                array(
                    'key'       => '_metabox_language',
                    'value'     =>  $_SESSION['languages'],
                    'compare'   => '=',
                ),
            ),
        );
        $myQuery = new WP_Query($argsforum);
        if ($myQuery->have_posts()) :
            $stt = $post_count + 1;
            while ($myQuery->have_posts()) :
                $myQuery->the_post();
        ?>
                <li data-id="<?php echo $stt ?>">
                    <a class="link-style" href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </li>
            <?php
                $stt += 1;
            endwhile;
            ?>
    </ul>

    <div id="load-more">
        <i class="fa fa-angle-double-down" aria-hidden="true"></i>
    </div>
<?php endif;
        wp_reset_query();
?>
<script>
    jQuery(document).ready(function() {
        jQuery('#load-more').click(function() {
            var lastID = jQuery("#data-list > li:last-child").attr("data-id");
            var category = '<?php echo $category ?>';
            jQuery.ajax({
                url: '<?php echo get_template_directory_uri() . '/ajax/load-news.php' ?>', // lay doi tuong chuyen sang dang array
                type: 'post', //                data: $(this).serialize(),
                data: {
                    lastID: lastID,
                    category: category
                },
                dataType: 'json',
                success: function(
                    data) { // set ket qua tra ve  data tra ve co thanh phan status va message
                    if (data.status === 'done') {
                        jQuery("#data-list").append(data.html);
                    } else if (data.status === 'empty') {
                        jQuery("#load-more").hide();
                    }
                },
                error: function(xhr) {
                    console.log(xhr.reponseText);
                    //console.log(data.status);
                }
            });
        });
    });
</script>
<?php
}
