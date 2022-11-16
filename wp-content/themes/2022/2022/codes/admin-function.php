<?php
//==== QUAN LI CAC COT MAC DINH TRONG POST ===================================================================

add_filter('manage_posts_columns', 'set_custom_edit_columns');

function set_custom_edit_columns($columns)
{
    unset($columns['tags']);
    unset($columns['comments']);
    unset($columns['date']);
    $columns['author'] = __('Author');
    $columns['language'] = __('Language');
    $columns['order'] = __('Order');
    $columns['postdate'] = __('Date');

    return $columns;
}

add_action('manage_posts_custom_column', 'Custom_Post_RenderCols');

function Custom_post_RenderCols($columns)
{
    global $post;
    switch ($columns) {

        case 'home':
            if ((get_post_meta($post->ID, '_metabox_home', true))) {
                echo "<div class='show-home'></div>";
            }
            break;

        case 'category':
            $terms = wp_get_post_terms($post->ID, 'event_category');
            if (count($terms) > 0) {
                foreach ($terms as $key => $term) {
                    echo '<a href=' . custom_redirect($term->slug) . ' &' . $term->taxonomy . '=' . $term->slug . '>' . $term->name . '</a></br>';
                }
            }
            break;

        case 'language':
            _e(get_post_meta($post->ID, '_metabox_language', true));
            break;

        case 'order':
            echo get_post_meta($post->ID, '_metabox_order', true);
            break;

        case 'postdate':
            echo get_the_date('d-m-Y');
            break;
        default:
            break;
    }
}
