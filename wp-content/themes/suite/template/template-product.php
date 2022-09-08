<div class="row">
    <ul class="list-group ">
        <li class="list-group-item active" aria-current="true" style="font-size: 20px; color:white; text-align:center"><?php _e('Product') ?></li>
        <?php  
            require_once(DIR_MODEL . 'product_model_function.php');
            $model = new Product_Model_Function();
            $cate = get_query_var('category'); // category trùng với tên khai báo trong rewrite.php
            $data = $model->getAllDataByCategory($cate);
            if (!empty($data)) {
                foreach ($data as $key => $val) {
                    ?>
                    <li class="list-group-item member-group">
                        <a><?php echo $val['product_name'] ?></a>  
                    </li>
                    <?php
                }
            }
        ?>
    </ul>  
</div>        

