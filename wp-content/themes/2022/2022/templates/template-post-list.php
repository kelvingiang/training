<div>
    <?php
    $argsevent = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $post_count,
        'category_name' => $caterogy,
    );
    $wp_query = new WP_Query($argsevent);
    if ($wp_query->have_posts()) :
        while ($wp_query->have_posts()) :
            $wp_query->the_post();
    ?>
            <div class="gray-group">
                <div class="gray-title">
                    <label><a href="<?php the_permalink(); ?>"> <?php the_title() ?> </a></label>
                </div>
                <div style="margin:10px 5px"><?php the_content_feed(); ?></div>
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

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 10,
        'offset' => $post_count,
        'category_name' => $caterogy,
        'orderby' => 'date',
        'order' => 'DESC',
    );
    $myQuery = new WP_Query($args);
    if ($myQuery->have_posts()) :
        $stt = $post_count + 1;
        while ($myQuery->have_posts()) :
            $myQuery->the_post();
    ?>
            <li data-id="<?php echo $stt ?>">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </li>
    <?php
            $stt += 1;
        endwhile;
    endif;
    wp_reset_query();
    ?>
</ul>

<div id="load-more">
    <i class="fa fa-angle-double-down" aria-hidden="true"></i>
</div>

<script>
    jQuery(document).ready(function() {
        jQuery('#load-more').click(function() {
            var lastID = jQuery("#data-list > li:last-child").attr("data-id");
            var caterogy = '<?php echo $caterogy ?>';
            jQuery.ajax({
                url: '<?php echo get_template_directory_uri() . '/ajax/load-news.php' ?>', // lay doi tuong chuyen sang dang array
                type: 'post', //                data: $(this).serialize(),
                data: {
                    lastID: lastID,
                    caterogy: caterogy
                },
                dataType: 'json',
                success: function(data) { // set ket qua tra ve  data tra ve co thanh phan status va message
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