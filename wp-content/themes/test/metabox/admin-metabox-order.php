<?php

class Admin_Metabox_Order {

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create() {
        $id = 'tw-metabox-order';
        $title = translate('Order');
        $callback = array($this, 'display');
        $screen = array('news','slider'); // CAC POST VA CUSTOMER POST CHO PHEP METABOX NAY HIEN THI
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

        echo '<div class="meta-row">'
        . '<div class="title-cell"><label for ="metabox-order">' . translate('Show Order') . ' </label></div>'
        . '<div class="text-cell" >'
            .'<input class="type-number" id="metabox-order" name="metabox-order" maxlength="5"
            placeholder = ' .translate('The larger the number will show in front ') .
            'value= ' . get_post_meta($post->ID, '_metabox_order', true) 
            . '></div>'
        . '</div>';

    }

    public function save($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if (is_admin()) {
            //su dung cho nhieu trang
            if (isset($_POST['metabox-order'])) {
                update_post_meta($post_id, '_metabox_order', esc_attr($_POST['metabox-order']));
            }
        }
    }

}
