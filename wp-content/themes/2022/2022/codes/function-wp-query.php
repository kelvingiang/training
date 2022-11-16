<?php



function query_custom_post_list($postName, $category, $count, $language)
{
    $args = array(
        'post_type' => $postName,
        'event_category' => $category,
        'posts_per_page' => $count,
        'meta_query' => array(
            array(
                'key'       => '_metabox_language',
                'value'     =>  $language,
                'compare'   => '=',
            ),
        ),
    );
    $Query = new WP_Query($args);
    return $Query;
}

function query_custom_post_list_show_home($postName, $category, $count, $language)
{
    $args = array(
        'post_type' => $postName,
        'event_category' => $category,
        'posts_per_page' => $count,
        'meta_query' => array(
            array(
                'key'       => '_metabox_language',
                'value'     =>  $language,
                'compare'   => '=',
            ),
            array(
                'key' => '_admin_metabox_special',
                'value' => 'on',
            )
        ),

    );
    $Query = new WP_Query($args);
    return $Query;
}



function query_custom_post_list_more($postName, $category, $count, $offset, $language)
{
    $args = array(
        'post_type' => $postName,
        'event_category' => $category,
        'posts_per_page' => $count,
        'offset' => $offset,
        'orderby' => 'date',
        'order' => 'DESC',

        'meta_query' => array(
            array(
                'key'       => '_metabox_language',
                'value'     =>  $language,
                'compare'   => '=',
            ),
        ),
    );
    $Query = new WP_Query($args);
    return $Query;
}



function query_supervisor_list($val)
{
    $args = array(
        'post_type' => 'supervisor',
        'posts_per_page' => -1,
        'orderby' => 'meta_value',
        'order' => 'DESC',
        'meta_key' => '_metabox_order',
        'meta_query' => array(array('key' => '_admin_metabox_special', 'value' => $val,)),
    );
    $Query = new WP_Query($args);
    return $Query;
}
