<?php
global $post;
// lay phan header
get_header();
wp_link_pages();
?>
<!-- phan noi dung of trang index --------------------------------------- -->

<div class="single-space">
    <label class="single-space-title"><?php the_title(); ?></label>
    <div class="single-space-content"><?php the_content(); ?></div>
    <div class="single-space-more">
        <?php get_template_part('templates/template', 'event-single-category'); ?>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
        $('.item .delete').click(function() {
            var elem = $(this).closest('.item');
            $.confirm({
                'title': 'Delete Confirmation',
                'message': 'You are about to delete this item. <br />It cannot be restored at a later time! Continue?',
                'buttons': {
                    'Yes': {
                        'class': 'blue',
                        'action': function() {
                            elem.slideUp();
                        }
                    },
                    'No': {
                        'class': 'gray',
                        'action': function() {} // Nothing to do in this case. You can as well omit the action property.
                    }
                }
            });
        });
    });
</script>
<?php
// lay phan footer
get_footer();
?>