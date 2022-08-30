<div>
    <a href="<?php echo home_url('products') ?>"  
        style="font-size: 22px; font-weight:bold; color:crimson">Product Category</a>
    <?php
        require_once(DIR_MODEL . 'product_category_model.php');
        $model = new Product_Category_Model();
        $data = $model->getData(); 
        foreach ($data as $key => $val) { ?>
        <div class="list-group member-group">
            <a href="<?php echo home_url('products') . '/category/' . $val['ID'] ?>"><?php echo $val['category_name'] ?></a>  
        </div>
    <?php } ?>  
</div>