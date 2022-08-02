<?php

class executive_Metabox {

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create() {
        $id = 'tw-metabox-email';
        $title = translate('Executive');
        $callback = array($this, 'display');
        $screen = array('executive'); // CAC POST VA CUSTOMER POST CHO PHEP METABOX NAY HIEN THI
        add_meta_box($id, $title, $callback, $screen);
        // FUNCTION NAY DE O DAY, DE KHI NAO DUNG DE METABOX THI TA MOI GOI FILE CSS NAY VO 
        //  add_action('admin_enqueue_scripts', array($this, 'add_css_file'));
    }

    public function display($post) {
        // thanh an nham bao mat trong wp
        $action = 'dn-metabox-data';
        $name = 'dn-metabox-data-nonce';
        wp_nonce_field($action, $name);


        $objhtml = new MyHtml();

        // TAO TEXTBOX TITLE
        $currentValue = get_post_meta($post->ID, '_metabox_current', true) == 1 ? "checked" : " ";
        $successiveValue = get_post_meta($post->ID, '_metabox_successive', true) == 1 ? "checked" : " ";

        echo '<div class="meta-row">'
        . '<div class="title-cell">'
        . ' <input type="checkbox" name="metabox-current" id="metabox-current"   ' . $currentValue . '>'
        . '<label for ="metabox-current" style="margin-right:30px">' . translate('current') . ' </label>'
        . '<input type="checkbox" name="metabox-successive" id="metabox-successive"   ' . $successiveValue . '>'
        . '<label for ="metabox-successive">' . translate('Successive') . ' </label> </div>';


        // TAO TEXTBOX TITLE
        $linkID = 'metabox-job-title';
        $linkName = 'metabox-job-title';
        $linkValue = get_post_meta($post->ID, '_metabox_job_title', true);
        $linkArr = array('id' => $linkID);

        echo '<div class = "meta-row">'
        . '<div class = "title-cell"><label for = "' . $linkID . '">' . translate('Job Title') . '</label></div>'
        . '<div class = "text-cell">' . $objhtml->textbox($linkName, $linkValue, $linkArr) . '</div>'
        . '</div>';

        $companyID = 'metabox-company';
        $companyName = 'metabox-company';
        $companyValue = get_post_meta($post->ID, '_metabox_company', true);
        $companyArr = array('id' => $companyID);

        echo '<div class = "meta-row">'
        . '<div class = "title-cell"><label for = "' . $companyID . '">' . translate('Company Name') . '</label></div>'
        . '<div class = "text-cell">' . $objhtml->textbox($companyName, $companyValue, $companyArr) . '</div>'
        . '</div>';

        $expiresID = 'metabox-prorogue';
        $expiresName = 'metabox-prorogue';
        $expiresValue = get_post_meta($post->ID, '_metabox_prorogue', true);
        $expiresArr = array('id' => $expiresID);

        echo '<div class = "meta-row">'
        . '<div class = "title-cell"><label for = "' . $expiresID . '">' . translate('Prorogue') . ' </label></div>'
        . '<div class = "text-cell">' . $objhtml->textbox($expiresName, $expiresValue, $expiresArr) . '</div>'
        . '</div>';

        // TAO TEXTBOX o
        $inputID = 'metabox-order';
        $inputName = 'metabox-order';
        $inputvalue = get_post_meta($post->ID, '_metabox_order', true);
        $arr = array('id' => $inputID, 'class' => 'type-number', 'maxlength' => '5', 'placeholder' => translate('The larger the number will show in front'));

        echo '<div class = "meta-row">'
        . '<div class = "title-cell"><label for = "' . $inputID . '">' . translate('Show Order') . ' </label></div>'
        . '<div class = "text-cell" >' . $objhtml->textbox($inputName, $inputvalue, $arr) . '</div>'
        . '</div>';
    }

    public function save($post_id) {

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if (is_admin()) {

            if (@$_POST['post_type'] == 'executive') {

                $chk = $_POST['metabox-current'] == 'on' ? "1" : "0";
                update_post_meta($post_id, '_metabox_current', $chk);

                $chk2 = $_POST['metabox-successive'] == 'on' ? "1" : "0";
                update_post_meta($post_id, '_metabox_successive', $chk2);

                if (isset($_POST['metabox-prorogue'])) {
                    update_post_meta($post_id, '_metabox_prorogue', esc_attr($_POST['metabox-prorogue']));
                };

                if (isset($_POST['metabox-order'])) {
                    update_post_meta($post_id, '_metabox_order', esc_attr($_POST['metabox-order']));
                };

                if (isset($_POST['metabox-job-title'])) {
                    update_post_meta($post_id, '_metabox_job_title', esc_attr($_POST['metabox-job-title']));
                };

                if (isset($_POST['metabox-company'])) {
                    update_post_meta($post_id, '_metabox_company', esc_attr($_POST['metabox-company']));
                };
            }
        }
    }

}
