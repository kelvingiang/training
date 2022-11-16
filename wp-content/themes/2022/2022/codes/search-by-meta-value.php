<?php

class Admin_Search_By_Meta_Value
{

    public function __construct()
    {
        if (isset($_GET['s']) && @$_GET['s'] !== '') {   // modify on 29-08
            add_filter('posts_search', array($this, 'Menber_posts_search'), 10, 2);
            add_filter('posts_join', array($this, 'Member_posts_join'), 10, 2);
        }
    }

    public function Menber_posts_search($search, $query)
    {

        global $wpdb;
        if ($query->query_vars['post_type'] == "member" && $query->query_vars['s'] != ' ') :
            $s = $query->query_vars['s'];
            $search = 'AND ( ( ( ' . $wpdb->prefix . 'posts.post_title LIKE \'%' . $s . '%\' ) ' .
                'OR ( ' . $wpdb->prefix . 'posts.post_content LIKE \'%' . $s . '%\' ) ' .
                'OR ( ' . $wpdb->prefix . 'postmeta.meta_value LIKE \'%' . $s . '%\' ' .
                'AND ' . $wpdb->prefix . 'postmeta.meta_key = \'m_user\' )' .
                'OR ( ' . $wpdb->prefix . 'postmeta.meta_value LIKE \'%' . $s . '%\' ' .
                'AND ' . $wpdb->prefix . 'postmeta.meta_key = \'m_email\' )' .
                'OR ( ' . $wpdb->prefix . 'postmeta.meta_value LIKE \'%' . $s . '%\' ' .
                'AND ' . $wpdb->prefix . 'postmeta.meta_key = \'m_company\' )' .
                'OR ( ' . $wpdb->prefix . 'postmeta.meta_value LIKE \'%' . $s . '%\' ' .
                'AND ' . $wpdb->prefix . 'postmeta.meta_key = \'m_country\' )' .
                'OR (' . $wpdb->prefix . 'postmeta.meta_value LIKE \'%' . $s . '%\' ' .
                'AND ' . $wpdb->prefix . 'postmeta.meta_key = \'m_fullname\' )))';
        //modify add them kieu serch m_fullnam va m_email
        endif;

        if ($query->query_vars['post_type'] == "friend" && $query->query_vars['s'] !== ' ') :
            $s = $query->query_vars['s'];
            $search = 'AND ( ( ( ' . $wpdb->prefix . 'posts.post_title LIKE \'%' . $s . '%\' ) ' .
                'OR ( ' . $wpdb->prefix . 'posts.post_content LIKE \'%' . $s . '%\' ) ' .
                'OR ( ' . $wpdb->prefix . 'postmeta.meta_value LIKE \'%' . $s . '%\' ' .
                'AND ' . $wpdb->prefix . 'postmeta.meta_key = \'p_name\' ) ) )';
        endif;

        return $search;
    }

    public function Member_posts_join($join, $query)
    {

        global $wpdb;

        if ($query->query_vars['post_type'] == "member" || $query->query_vars['post_type'] == "friend" && $query->query_vars['s'] !== '') :
            $join = ' INNER JOIN ' . $wpdb->prefix . 'postmeta ON ' . $wpdb->prefix . 'postmeta.post_id = ' . $wpdb->prefix . 'posts.ID ';
        endif;
        return $join;
    }
}
