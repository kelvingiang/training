<?php
$data=array(
    'setorder' => '',
    'product_name' => '',
    'price' => '',
    'category' => '',
    'create_date' => '',
    'update_date' => '',
);
    
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
            <input class="type-text" type="text" name="txt-category" id="txt-category" value="<?php echo $data['category'] ?>" />
        </div>
    </div>
    
    <div class="meta-row-two-column">
        <!-- create date -->
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Create Date') ?></label>
            </div>
            <div class="text-cell">
                <input type="date" name="txt-create-date" id="txt-create-date" value="<?php echo $data['create_date'] ?>" />
            </div>
        </div>
        <!-- update date -->
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Update Date') ?></label>
            </div>
            <div class="text-cell">
                <input type="date" name="txt-update-date" id="txt-update-date"  maxlength="50" value="<?php echo $data['update_date'] ?>" />
            </div>
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

            var serialVal = jQuery('#txt-category').val();
            if (serialVal === '') {
                jQuery('#category_merss').text('<?php echo __('please input the category'); ?>');
                e.preventDefault();
            }
        });


        jQuery('#txt-product-name').focusout(function (e) {
            var urlPath = '<?php echo get_template_directory_uri() . '/ajax/admin/checkemail.php' ?>';
            jQuery.ajax({
                url: urlPath, // lay doi tuong chuyen sang dang array
                type: 'post',
                data: jQuery(this).serialize(),
                dataType: 'json',
                success: function (data) {  // set ket qua tra ve  data tra ve co thanh phan status va message
                    if (data.status === 'error') {
                        jQuery('#product_merss').text(data.message);
                        jQuery("#btn-submit").prop('disabled', true);
                    } else if (data.status === 'done') {
                        jQuery('#product_merss').text('');
                        if (jQuery('#product_merss').text() === '') {
                            jQuery("#btn-submit").prop('disabled', false);
                        }
                    }
                },
                error: function (xhr) {
                    console.log(xhr.reponseText);
                }
            });
            e.preventDefault();
        });

    });

</script>