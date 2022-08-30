<div class="row">
    <div class="group-border" >
        <div class="group-title">
            <label> <?php _e('Product') ?></label>
        </div>

        <div>
            <ul class="article-list" >
                <?php  
                require_once(DIR_MODEL . 'product_model_function.php');
                $model = new Product_Model_Function();
                $cate = get_query_var('category'); // category trùng với tên khai báo trong rewrite.php
                if($cate == ''){
                    $data = $model->getAllData();
                }else{
                    $data = $model->getAllDataByCategory($cate);
                }
                if (!empty($data)) {
                    foreach ($data as $key => $val) {
                        ?>
                        <li>
                            <a><?php echo $val['product_name'] ?></a>  
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>        

