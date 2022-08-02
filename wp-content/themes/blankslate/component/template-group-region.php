<?php
global $wpdb;
$table = $wpdb->prefix . 'member';
?>
<div class="group-border">
    <div class="group-title">
        <label> <?php _e("Member") ?></label>
    </div>
    <div>
        <ul class="article-list">
            <?php
            $sql = "SELECT DISTINCT region FROM $table";
            $regionList = $wpdb->get_results($sql, ARRAY_A);
            if (!empty($regionList)) {
                foreach ($regionList as $key => $val) {
                    if($val['region']==' ')  continue;
                    ?>
            <li><a class="article-title" href="<?php echo home_url('member') .'/region/'.$val['region']; ?>">  <?php echo $val['region'] ?></a></li>
                        <?php
                    }
                }
                ?>
        </ul>
    </div>
</div>

