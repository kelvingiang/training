<?php
$data=array(
    'setorder' => '',
    'product_name' => '',
    'price' => '',
    'category' => '',
    'ID' => '',

);

global $wpdb;
$table = $wpdb->prefix . 'product';

?>
<div class="group-border" >
    <div class="group-title">
        <label> <?php _e('Product') ?></label>
    </div>

    <div>
        <ul class="article-list" >
            <?php 
            $sql = "SELECT ID,product_name FROM $table limit 7";
            $data = $wpdb->get_results($sql, ARRAY_A);
            if (!empty($data)) {
                foreach ($data as $key => $val) {
                    ?>
                    <li class="">
                        <a href="<?php echo home_url('products') . '/' . $val['ID']; ?>"><?php echo $val['product_name'] ?></a>  
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</div>

