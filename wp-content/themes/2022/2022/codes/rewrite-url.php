<?php

class Codes_Rewrite_Url
{

  function __construct()
  {
    add_action('init', array($this, 'add_rule_rewrite'));
    add_filter('query_vars', array($this, 'add_query_vars'));
    /*  add_action('init', array($this, 'add_tags_rule')); */
  }

  /*CAC DOI TUONG XEM THONG TIN CUA REWRITE WP_REWRITE, WP_QUERY, WP
      KHAI BAO URL               */
  public function add_rule_rewrite()
  {
    /* CAC REWRITE CUNG PHAI THEO THU TU RO NEU SAI THU TU CO THE SE KHONG HIEN THI DUOC */

    $regex1 = 'forum/([^/]*)/?/p/([^/]*)/?([^/]*)/?$';
    $redirect1 = 'index.php?post_type=forum&name=$matches[1]&page=$matches[2]&cate=$matches[3]';
    add_rewrite_rule($regex1, $redirect1, 'top');

    $regex = '([^/]*)/?/p/([^/]*)/?([^/]*)/?';
    $redirect = 'index.php?pagename=$matches[1]&page=$matches[2]&cate=$matches[3]';
    add_rewrite_rule($regex, $redirect, 'top');

    $regex2 = '([^/]*)/?/p/([^/]*)/?';
    $redirect2 = 'index.php?pagename=$matches[1]&page=$matches[2]';
    add_rewrite_rule($regex2, $redirect2, 'top');

    $regex3 = '([^/]*)/?/c/([^/]*)/?';
    $redirect3 = 'index.php?pagename=$matches[1]&cate=$matches[3]';
    add_rewrite_rule($regex3, $redirect3, 'top');

    $regex4 = '([^/]*)/?/place/([^/]*)/?';
    $redirect4 = 'index.php?pagename=$matches[1]&place=$matches[2]';
    add_rewrite_rule($regex4, $redirect4, 'top');

    $regex5 = '([^/]*)/?/cat/([^/]*)/?';
    $redirect5 = 'index.php?pagename=$matches[1]&cat=$matches[2]';
    add_rewrite_rule($regex5, $redirect5, 'top');

    $regex6 = '([^/]*)/?/b/([^/]*)/?';
    $redirect6 = 'index.php?pagename=$matches[1]&b=$matches[2]';
    add_rewrite_rule($regex6, $redirect6, 'top');

    /* $regex6 = '([^/]*)/?/place/([^/]*)/?/cat/([^/]*)/?';
          $redirect6 = 'index.php?pagename=$matches[1]&place=$matches[2]&cat=$matches[3]';
          add_rewrite_rule($regex6, $redirect6, 'top'); */

    /*
          $regex3 = '/([^/]*)/?/([^/]*)/?';
          $redirect3 = 'index.php?post_type=$matches[1]&cate=$matches[2]';
          add_rewrite_rule($regex3, $redirect3, 'top');
          $regex1 = '/forum/([^/]*)/?$';
          $redirect1 = 'index.php?post_type=forum&name=$matches[1]';
          add_rewrite_rule($regex1, $redirect1, 'top');
          $regex1 = '([^/]*)/?([^/]*)/?';
          $redirect1 = 'index.php?pagename=$matches[1]&page=$matches[2]';
          add_rewrite_rule($regex1, $redirect1, 'top');

          $regex2 = '([^/]*)/?([^/]*)/?([^/]*)/?';
          $redirect2 = 'index.php?pagename=$matches[1]&name=$matches[2]&page=$matches[3]';
          add_rewrite_rule($regex2, $redirect2, 'top');
          $regex2       = 'the-forum';
          $redirect2     = 'index.php?pagename=forum';
          add_rewrite_rule($regex2, $redirect1 ,'top'); */
    /* DUA CUA ADD REWITE VAO DATABASE = FLASS , VAO FILE HTACCSEE = TRUE */
    // flush_rewrite_rules(false);
  }

  /* KHAI BAO THAM SO MOI TREN URL, KHI TRONG WP KHONG CO PARAM NAY */

  public function add_query_vars($vars)
  {
    $vars[] = 'cate';
    $vars[] = 'place';
    $vars[] = 'b';

    return $vars;
  }

  /* REWRITE CUSTPOST  PHAN CHUYEN CHU FORUNM THANH CHU DIENDAN */

  public function add_tags_rule()
  {
    add_rewrite_tag('%forum%', '([^/]+)');
    add_permastruct('forum', 'diendan/%forum%');
    //flush_rewrite_rules(FALSE);
  }

  /* CALL PHAN NAY KHI REWRITE KHONG CHAY VI LOI REWRITE */

  public function deactivetion()
  {
    // flush_rewrite_rules(FALSE);
  }
}
