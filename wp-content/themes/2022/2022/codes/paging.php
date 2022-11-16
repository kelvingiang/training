<?php

class Codes_Paging
{
    public function show_paging($wp_paging = NULL)
    {
        if ($wp_paging != null) {
            global $papingQuery;
            $big = 999999999;
            //#038;
            $pagenum_link = str_replace($big, '%#%', get_pagenum_link($big));
            $pagenum_link = str_replace('#038;', '&', $pagenum_link);

            $args = array(
                'base' => $pagenum_link,
                'format' => '?page=%#%',
                'total' => $wp_paging->max_num_pages,
                'current' => max(1, get_query_var('paged')),
                'show_all' => false,
                'end_size' => 1,
                'mid_size' => 2,
                'prev_next' => false,
                'type' => 'plain',
            );
            return paginate_links($args);
        }
    }
}
