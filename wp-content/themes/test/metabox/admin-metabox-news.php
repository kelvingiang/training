<?php 

class Admin_Metabox_News {
    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create() {
        $id = 'tw-metabox-news';
        $title = translate('News');
        $callback = array($this, 'display');
        $screen = array('news'); // CAC POST VA CUSTOMER POST CHO PHEP METABOX NAY HIEN THI
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
        
        // TAO TEXTBOX TITLE
        //create date
        echo '<div class="meta-row">
            <div class="title-cell"><label for ="metabox-news-create-date">'. translate('Create Date') .'</label></div>
            <div class="text-cell" >
            <input class="type-phone" type="text" id="metabox-news-create-date" name="metabox-news-create-date" maxlength="100"
                placeholder = ' . translate('Create Date ') .
                'value= ' . get_post_meta($post->ID, '_metabox_news_create_date', true)
            .'></div>
        </div>';
        //create by
        echo '<div class="meta-row">
            <div class="title-cell"><label for ="metabox-news-create-by">' .translate('Create By') .'</label></div>
            <div class="text-cell" >
                <input class="type-text" type="text" id="metabox-news-create-by" name="metabox-news-create-by" maxlength="100"
                    placeholder = '. translate('Create By ') .
                    'value=  ' . get_post_meta($post->ID, '_metabox_news_create_by', true) 
                .'></div>
        </div>';
        //email
        echo '<div class="meta-row">
            <div class="title-cell"><label for ="metabox-news-email">' . translate('Email') . '</label>
                <i id="error-email" class="error"></i></div>
            <div class="text-cell" >
                <input class="type-email" id="metabox-news-email" name="metabox-news-email" maxlength="50"
                placeholder = ' . translate('Email ')  .
                'value= ' . get_post_meta($post->ID, '_metabox_news_email', true) 
                .'></div>
        </div>';
    }

    public function save($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if (is_admin()) {
            if (@$_POST['post_type'] == 'news') {  

                if (isset($_POST['metabox-news-create-date'])) {
                    update_post_meta($post_id, '_metabox_news_create_date', esc_attr($_POST['metabox-news-create-date']));
                }
                if (isset($_POST['metabox-news-create-by'])) {
                    update_post_meta($post_id, '_metabox_news_create_by', esc_attr($_POST['metabox-news-create-by']));
                }
                if (isset($_POST['metabox-news-email'])) {
                    update_post_meta($post_id, '_metabox_news_email', esc_attr($_POST['metabox-news-email']));
                }

            }
        }
    }
}