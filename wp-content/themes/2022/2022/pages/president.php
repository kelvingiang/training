<?php
/*
  Template Name:  Presidents  Page
 */

ob_start();  // neu bao loi PHP Warning: Cannot modify header information – headers already sent by
get_header();

get_template_part('templates/template', 'presidents');

get_footer();
ob_flush();   // neu bao loi PHP Warning: Cannot modify header information – headers already sent by
