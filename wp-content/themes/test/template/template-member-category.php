<div>
    <a href="<?php echo home_url('member-test') ?>"  
        style="font-size: 22px; font-weight:bold; color:crimson">Member Category</a>
    <?php
        require_once(DIR_MODEL . 'admin-model-member-cate.php');
        $model = new Admin_Model_Member_Cate;
        $data = $model->getDataGroup(); 
        foreach ($data as $key => $val) { ?>
        <div class="list-group member-group">
            <a href="<?php echo home_url('member-test') . '/category/' . $val['ID'] ?>"><?php echo $val['cate_name'] ?></a>  
        </div>
    <?php } ?>  

    <?php
        require_once(DIR_MODEL . 'admin-model-member-cate.php');
        $model = new Admin_Model_Member_Cate;
        $data = $model->getDataIndustry(); 
        foreach ($data as $key => $val) { ?>
        <div class="list-group member-group">
            <a href="<?php echo home_url('member-test') . '/category/' . $val['ID'] ?>"><?php echo $val['cate_name'] ?></a>  
        </div>
    <?php } ?> 
</div>