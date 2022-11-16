<?php

class Admin_Metabox_Branch
{

    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create()
    {
        global $post;
        $id = 'brach-meta-box';
        $title = __('Branch Information');
        $callback = array($this, 'display');
        $screen = array('brach'); // CAC POST VA CUSTOMER POST CHO PHEP METABOX NAY HIEN THI
        add_meta_box($id, $title, $callback, $screen, 'normal', 'high');
    }

    public function display($post)
    {
        global $suite;
        // $editor_settings = Common::$_wpeditor;
        // get cac thong tin khi sp co san (cho phan chinh sua update)
        $b_contact = get_post_meta($post->ID, 'b_contact', true);
        $b_phone = get_post_meta($post->ID, 'b_phone', true);
        $b_tel = get_post_meta($post->ID, 'b_tel', true);
        $b_fax = get_post_meta($post->ID, 'b_fax', true);
        $b_address = get_post_meta($post->ID, 'b_address', true);
        $b_email = get_post_meta($post->ID, 'b_email', true);
        $b_website = get_post_meta($post->ID, 'b_website', true);
        $b_fanpage = get_post_meta($post->ID, 'b_fanpage', true);
        $b_x = get_post_meta($post->ID, 'b_x', true);
        $b_y = get_post_meta($post->ID, 'b_y', true);
?>

        <div class="row-one-column">
            <div class="col">
                <div class="cell-title">
                    <label for="b_contact" class="admin-title"><?php _e('President', 'suite'); ?></label>
                </div>
                <div class="cell-text">
                    <input type="text" name="b_contact" id="b_contact" class="my-input" value="<?php echo $b_contact; ?>" />
                </div>
            </div>
        </div>

        <div class="row-one-column">
            <div class="col">
                <div class="cell-title">
                    <label for="b_phone" class="admin-title"><?php _e('Cell Phone', 'suite'); ?></label>
                </div>
                <div class="cell-text">
                    <input type="text" name="b_phone" id="b_phone" class="my-input type-phone" value="<?php echo $b_phone; ?>" />
                </div>
            </div>
        </div>

        <div class="row-one-column">
            <div class="col">
                <div class="cell-title">
                    <label for="b_tel" class="admin-title"><?php _e('Phone', 'suite'); ?></label>
                </div>
                <div class="cell-text">
                    <input type="text" name="b_tel" id="b_tel" class="my-input type-phone" value="<?php echo $b_tel; ?>" />
                </div>
            </div>
        </div>



        <div class="row-one-column">
            <div class="col">
                <div class="cell-title">
                    <label for="b_fax" class="admin-title"><?php _e('Fax', 'suite'); ?></label>
                </div>
                <div class="cell-text">
                    <input type="text" name="b_fax" id="b_fax" class="my-input type-phone" value="<?php echo $b_fax; ?>" />
                </div>
            </div>
        </div>

        <div class="row-one-column">
            <div class="col">
                <div class="cell-title">
                    <label for="b_address" class="admin-title"><?php _e('Address', 'suite'); ?></label>
                </div>
                <div class="cell-text">
                    <input type="text" name="b_address" id="b_address" class="my-input" value="<?php echo $b_address; ?>" />
                </div>
            </div>
        </div>

        <div class="row-one-column">
            <div class="col">
                <div class="cell-title">
                    <label for="b_email" class="admin-title"><?php _e('Email', 'suite'); ?></label>
                </div>
                <div class="cell-text">
                    <input type="text" name="b_email" id="b_email" class="my-input" value="<?php echo $b_email; ?>" />
                </div>
            </div>
        </div>

        <div class="row-one-column">
            <div class="col">
                <div class="cell-title">
                    <label for="b_tel" class="admin-title"><?php _e('Fanpage', 'suite'); ?></label>
                </div>
                <div class="cell-text">
                    <input type="text" name="b_fanpage" id="b_fanpage" class="my-input" value="<?php echo $b_fanpage; ?>" />
                </div>
            </div>
        </div>


        <div class="row-one-column">
            <div class="col">
                <div class="cell-title">
                    <label for="b_tel" class="admin-title"><?php _e('Website', 'suite'); ?></label>
                </div>
                <div class="cell-text">
                    <input type="text" name="b_website" id="b_website" class="my-input" value="<?php echo $b_website; ?>" />
                </div>
            </div>
        </div>

        <div class="row-two-column">
            <div class="col">
                <div class="cell-title">
                    <label for="b_x" class="admin-title"><?php _e('maps-x', 'suite'); ?></label>
                </div>
                <div class="cell-text">
                    <input type="text" required name="b_x" id="b_x" class="my-input" value="<?php echo $b_x; ?>" />
                </div>
            </div>
            <div class="col">
                <div class="cell-title">
                    <label for="b_phone" class="admin-title"><?php _e('maps-y', 'suite'); ?></label>
                </div>
                <div class="cell-text">
                    <input type="text" required name="b_y" id="b_y" class="my-input" value="<?php echo $b_y; ?>" />
                </div>
            </div>
        </div>



<?php
    }

    public function save($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (is_admin()) {
            if (@$_POST['post_type'] == 'brach') {

                if (isset($_POST['b_contact'])) {
                    update_post_meta($post_id, 'b_contact', esc_attr($_POST['b_contact']));
                }

                if (isset($_POST['b_phone'])) {
                    update_post_meta($post_id, 'b_phone', esc_attr($_POST['b_phone']));
                }

                if (isset($_POST['b_tel'])) {
                    update_post_meta($post_id, 'b_tel', esc_attr($_POST['b_tel']));
                }

                if (isset($_POST['b_fax'])) {
                    update_post_meta($post_id, 'b_fax', esc_attr($_POST['b_fax']));
                }

                if (isset($_POST['b_address'])) {
                    update_post_meta($post_id, 'b_address', esc_attr($_POST['b_address']));
                }

                if (isset($_POST['b_email'])) {
                    update_post_meta($post_id, 'b_email', esc_attr($_POST['b_email']));
                }

                if (isset($_POST['b_website'])) {
                    update_post_meta($post_id, 'b_website', $_POST['b_website']);
                }

                if (isset($_POST['b_fanpage'])) {
                    update_post_meta($post_id, 'b_fanpage', $_POST['b_fanpage']);
                }


                if (isset($_POST['b_x'])) {
                    update_post_meta($post_id, 'b_x', esc_attr($_POST['b_x']));
                }

                if (isset($_POST['b_y'])) {
                    update_post_meta($post_id, 'b_y', esc_attr($_POST['b_y']));
                }

                add_action('redirect_post_location', 'custom_redirect');
            }
        }
    }
}
