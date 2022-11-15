<div class="group-border">
    <div class="group-title">
        <a href="<?php echo home_url('member-test') ?>"><?php _e('Member Category') ?></a>
    </div>
    <div class="member-category-list">
        <?php
            require_once(DIR_MODEL . 'admin-model-member-cate.php');
            $model = new Admin_Model_Member_Cate;
            $data = $model->getDataGroup(); 
            foreach ($data as $key => $val) { ?>
            <li>
                <a href="<?php echo home_url('member-test') . '/category/' . $val['ID'] ?>"><?php echo $val['cate_name'] ?></a>  
            </li>
        <?php } ?>  
        <?php
            require_once(DIR_MODEL . 'admin-model-member-cate.php');
            $model = new Admin_Model_Member_Cate;
            $data = $model->getDataIndustry(); 
            foreach ($data as $key => $val) { ?>
            <li>
                <a href="<?php echo home_url('member-test') . '/category/' . $val['ID'] ?>"><?php echo $val['cate_name'] ?></a>  
            </li>
        <?php } ?>
    </div> 
</div>