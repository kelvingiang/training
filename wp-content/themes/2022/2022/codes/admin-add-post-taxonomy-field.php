<?php

//==== ADD NEW FIELD ============================================================================

function taxonomy_add_field() {
    ?>
    <div class="form-field">
        <label for="cate_vn"> <?php _e('Name') ?> ( <?php _e('Vietnamese') ?>)</label>
        <input  type="hidden" name="cate_cn" id="cate_cn" value="" />
        <input  type="text" name="cate_vn" id="cate_vn" value="" />
    </div>
    <div class="form-field">
        <label for="cate_en"> <?php _e('Name') ?> ( <?php _e('English') ?>)</label>
        <input type="text" name="cate_en" id="cate_en" value="" />
    </div>
    <div class="form-field">
        <label for="cate_order"><?php _e('Show Order') ?></label>
        <input  type="text" name="cate_order" id="cate_order" value="" />
    </div>
    <script>
        jQuery('#tag-name').focusout(function () {
            jQuery('#cate_cn').val(jQuery(this).val());
        });
    </script>
    <?php
}

add_action('category_add_form_fields', 'taxonomy_add_field', 10, 2);

//==== ADD NEW FIELD ============================================================================
function taxonomy_edit_field($term) {

    // put the term ID into a variable
    $t_id = $term->term_id;

    // retrieve the existing value(s) for this meta field. This returns an array
    $val = get_option("post_cate_$term->term_id");
    ?>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label><?php _e('Name') ?> ( <?php _e('Vietnamese') ?>)</label>
        </th>
        <td>
            <input type="hidden" name="cate_cn" id="cate_cn" value="<?php echo $val['cate_cn'] ?>">
            <input type="text" name="cate_vn" id="cate_vn" value="<?php echo $val['cate_vn'] ?>">
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label><?php _e('Name') ?> ( <?php _e('English') ?>)</label>
        </th>
        <td>
            <input type="text" name="cate_en" id="cate_en" value="<?php echo $val['cate_en'] ?>">
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label><?php _e('Show Order') ?></label>
        </th>
        <td>
            <input type="text" name="cate_order" id="cate_order" value="<?php echo $val['cate_order'] ?>">
        </td>
    </tr>
    <script>
        jQuery('#name').focusout(function () {
            jQuery('#cate_cn').val(jQuery(this).val());
        });
    </script>
    <?php
}

add_action('category_edit_form_fields', 'taxonomy_edit_field', 10, 2);

//==== SAVE FIELD ============================================================================
function save_cate_fields($term_id) {
    $arr = array(
        'cate_cn' => $_POST['cate_cn'],
        'cate_vn' => $_POST['cate_vn'],
        'cate_en' => $_POST['cate_en'],
        'cate_order' => $_POST['cate_order'],
    );
    $option_name = "post_cate_$term_id";
    $option_value = $arr;
    update_option($option_name, $option_value);
}

add_action('edited_category', 'save_cate_fields', 10, 2);
add_action('create_category', 'save_cate_fields', 10, 2);

//=====DETELE TAG  FIELD =========================================================================
add_action('delete_category', 'delete_cate_fields');

function delete_cate_fields() {
    $param = getParams();
    delete_option("post_cate_" . $param['tag_ID']);
}

//===== MANAGE  CATEGORY COLUMNS  ===============================================================
add_filter("manage_edit-category_columns", 'category_columns', 10, 3);
add_filter("manage_category_custom_column", 'category_columns_manage', 10, 3);

function category_columns() {
    $new_columns = array(
        'cb' => '<input type="checkbox" />',
        'name' => __('Name'),
        'slug' => __('Slug'),
//            'description' => __('Description'),
        'vietnamese' => __('Vietnamese'),
        'english' => __('English'),
        'order' => __('Show Order'),
        'posts' => __('Count')
    );

    return $new_columns;
}

function category_columns_manage($out, $column_name, $theme_id) {
    $theme = get_term($theme_id, 'category');

    $val = get_option('post_cate_' . $theme->term_id);

    switch ($column_name) {
        case 'order':
            echo isset($val['cate_order']) ? $val['cate_order'] : '0';
            break;
        case 'vietnamese':
            echo isset($val['cate_vn']) ? $val['cate_vn'] : '';
            break;
        case 'english':
            echo isset($val['cate_en']) ? $val['cate_en'] : '';
            break;
        default:
            break;
    }
    return $out;
}
