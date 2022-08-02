<?php

class Prioritize_Metabox {

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create() {
        $id = 'tw-metabox-email';
        $title = translate('Prioritize Show');
        $callback = array($this, 'display');
        $screen = array('post'); // CAC POST VA CUSTOMER POST CHO PHEP METABOX NAY HIEN THI
        add_meta_box($id, $title, $callback, $screen);
        // FUNCTION NAY DE O DAY, DE KHI NAO DUNG DE METABOX THI TA MOI GOI FILE CSS NAY VO 
        //  add_action('admin_enqueue_scripts', array($this, 'add_css_file'));
    }

    public function display($post) {
        //        echo __METHOD__;
        // thanh an nham bao mat trong wp
        $action = 'dn-metabox-data';
        $name = 'dn-metabox-data-nonce';
        wp_nonce_field($action, $name);

        $objhtml = new MyHtml();

        // TAO TEXTBOX TITLE
         $currentValue = get_post_meta($post->ID, '_metabox_prioritize', true) == 1 ?  "checked" : " ";

        echo '<div class="meta-row">'
        . '<div class="title-cell">'
        . ' <input type="checkbox" name="metabox-prioritize" id="metabox-prioritize"   ' . $currentValue . '>'
        . '<label for ="metabox-prioritize">' . translate('Prioritize Show On Home Page') . ' </label> </div>'
        . '<div class="text-cell"></div>'
        . '</div>';


    }

    public function save($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if (is_admin()) {
          //  if (@$_POST['post_type'] == 'slider') {
                $chk = $_POST['metabox-prioritize'] == 'on' ? "1" : "0";
                update_post_meta($post_id, '_metabox_prioritize', $chk);
          //  }
        }
    }

}
