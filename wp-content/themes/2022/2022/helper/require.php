<?php

require_once(DIR_CONTROLLER . 'controller-main.php');
new Admin_Controller_Main();

require_once(DIR_METABOX . 'metabox-main.php');
new Admin_metabox_Main();

require_once(DIR_TAXONOMY . 'taxonomy-main.php');
new Admin_Taxonomy_Main();



require_once(DIR_CLASS . 'html.php');
new MyHtml;

include_once(DIR_CODES . 'rewrite-url.php');
new Codes_Rewrite_Url;


/* CHUC NANG SEARCH TU TABLE POSTSMETA */
require_once(DIR_CODES . 'search-by-meta-value.php');
new Admin_Search_By_Meta_Value();

