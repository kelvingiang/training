<?php
$currentPage = get_page_uri();
if ($currentPage == 'event-upcoming') {
    $postCate = 'event-upcoming';
} elseif ($currentPage == 'event-review') {
    $postCate = 'event-review';
}

$postName = 'event';
$postcateName = 'event_category';

$offset = 2;

// LAY CAC THONG TIN TRONG POST TYPE FORUM VA VI TRI LAY DONG THONG TIN

$myQuery = query_custom_post_list_more($postName, $postCate, COUNT_POST_ANOTHER, $offset, $_SESSION['languages']);
if ($myQuery->have_posts()) :
    $stt = 3;
?>
    <ul id="data-list" class="article-list">
        <?php
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
<?php
endif;
wp_reset_query();
?>

<script>
    jQuery(document).ready(function() {
        jQuery('#load-more').click(function() {
            var lastID = jQuery("#data-list > li:last-child").attr("data-id");
            var post = '<?php echo $postName ?>';
            var category = '<?php echo $postCate ?>';
            var categoryName = '<?php echo $postcateName ?>';
            var language = '<?php echo $_SESSION['languages'] ?>';

            jQuery.ajax({
                url: '<?php echo get_template_directory_uri() . '/ajax/load-custom-post-more.php' ?>', // lay doi tuong chuyen sang dang array
                type: 'post', //                data: $(this).serialize(),
                data: {
                    lastID: lastID,
                    post: post,
                    category: category,
                    categoryName: categoryName,
                    language: language,
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