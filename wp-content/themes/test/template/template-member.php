<div class="row">
    <ul class="list-group ">
        <li class="list-group-item active" aria-current="true" style="font-size: 20px; color:white; text-align:center"><?php _e('Member') ?></li>
        <?php  
            require_once(DIR_MODEL . 'admin-model-member-function.php');
            $model = new Admin_Model_Member_Function();
            $cate = get_query_var('category'); // category trùng với tên khai báo trong rewrite.php
            $data = $model->getAllDataByCategory($cate);
            if (!empty($data)) {
                foreach ($data as $key => $val) {
                    ?>
                    <li class="list-group-item member-group">
                        <a><?php echo $val['company_name'] ?></a>  
                    </li>
                    <?php
                }
            }
        ?>
    </ul>  
</div>  