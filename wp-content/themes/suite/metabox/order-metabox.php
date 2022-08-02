<?php

class Order_Metabox {

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create() {
        $id = 'tw-metabox-email';
        $title = translate('Order');
        $callback = array($this, 'display');
        $screen = array('slider'); // CAC POST VA CUSTOMER POST CHO PHEP METABOX NAY HIEN THI
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
        $inputID = 'metabox-order';
        $inputName = 'metabox-order';
        $inputvalue = get_post_meta($post->ID, '_metabox_order', true);
        $arr = array('id' => $inputID, 'class' => 'type-number', 'maxlength'=>'5', 'placeholder' => translate('The larger the number will show in front'));
        echo '<div class="meta-row">'
        . '<div class="title-cell"><label for ="' . $inputID . '">' . translate('Show Order') . ' </label></div>'
        . '<div class="text-cell" >' . $objhtml->textbox($inputName, $inputvalue, $arr) . '</div>'
        . '</div>';


    }

    public function save($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if (is_admin()) {
            if (@$_POST['post_type'] == 'slider') {
                if (isset($_POST['metabox-order'])) {
                    update_post_meta($post_id, '_metabox_order', esc_attr($_POST['metabox-order']));
                }
            }
        }
    }

}
