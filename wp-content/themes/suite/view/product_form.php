<?php
$data=array(
    'setorder' => '',
    'product_name' => '',
    'price' => ''
);
$select_category = getCategoryName();


if ((getParams('action')=='edit')) {
    require_once (DIR_MODEL . 'product_model.php');
    $model = new Product_Model();
    $data = $model->get_item(getParams());

}

?>

<form action="" method="post" enctype="multipart/form-data" id="f_product" name="f_product" >
    <div class="title-row">
        <?php
        $action = getParams('action');
        if ($action == 'edit') {
            $title = __('Update Product Info');
        } elseif ($action == 'add') {
            $title = __('Add New Product');
        }
        ?>
        <h2> <?php echo $title; ?></h2>
    </div>
    <!-- order -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Show Order') ?></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt-order" id="txt-order"  maxlength="4" class="type-number" 
                  placeholder="<?php echo __('The larger the number will show in front'); ?>"  
                    value="<?php echo $data['setorder']; ?>"  />
        </div>
    </div>
      <!-- product  -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Product Name'); ?><i class="error" id="product_merss"></i></label>
        </div>
        <div class="text-cell">
            <input class="type-text" type="text" name="txt-product-name" 
            id="txt-product-name" maxlength="90" value="<?php echo $data['product_name']; ?>" /> 
        </div>
    </div>   
    <!-- price -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Price'); ?></label>
        </div>
        <div class="text-cell">
            <input class="type-number" type="text" name="txt-price" id="txt-price" 
             maxlength="190"value="<?php echo $data['price'] ?>"/> 
        </div>
    </div>    
    <!-- category -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Category') ?><i class="error" id="category_merss"></i></label>
        </div>
        <div class="text-cell">
            <select class="type-text" name="selectbox-category" id="selectbox-category">
                <?php foreach( $select_category as $var => $selects) : ?>
                <option value ="<?php echo implode(' ',$selects) ?>"<?php if( $var == ['selectbox-category'] ): ?> 
                    selected= "<?php $selects ?>" <?php endif; ?>><?php echo implode(' ',$selects) ?></option>

                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div style="clear: both"></div>
    <div class="button-row">
        <input type="submit" name="btn-submit" id="btn-submit" class="button button-primary button-large" value="<?php echo __('Send') ?>"/>
    </div>
</form>

<script type="text/javascript">
    // show hinh anh truoc khi up len
    jQuery(document).ready(function () {

        jQuery('#btn-submit').click(function (e) {
            // KIEM TRA CAC TRUONG KHONG DC RONG 

            var serialVal = jQuery('#txt-product-name').val();
            if (serialVal === '') {
                jQuery('#product_merss').text('<?php echo __('please input the product name'); ?>');
                e.preventDefault();
            }

            var serialVal = jQuery('#selectbox-category').val();
            if (serialVal === '') {
                jQuery('#category_merss').text('<?php echo __('please input the category'); ?>');
                e.preventDefault();
            }
        });



    });

</script>