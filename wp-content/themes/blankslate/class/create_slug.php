<?php
 
class Admin_CreateSlug_helper{
    // CAU TRUC MANG TA CAN QUAN TAM
    //array (
    //  'table => 'wpmw_test,
    //  'field => 'slug
    //  'exception => array('field' = > 'id' , 'value' => '2') 
     //)
    
    public function getSlug( $val = '', $option = array()){
        global $wpdb;
         $table = $wpdb->prefix . $option['table'];
         $field  =$option['field'];
         
        $newVal = $val;
        for($i = 0;  $i < 999; $i++){
            if($i > 0){
                $newVal = $val . '-' .$i;
            }
            // PHAN exception LA PHAN BIET DU LIEU CAN ADD NEW  HAY UPDATE
            if(!isset($option['exception'])){
                $sql    = "SELECT COUNT(id) FROM $table WHERE $field = '$newVal' ";
                $sql = $wpdb->prepare($sql, '%s', '%s', '%s' ); //%s CHO 3 DOI TUONG 'table', ' field', '$newVal'
                $result = $wpdb->get_col($sql);
            }else{
                $excep_field     = $option['exception']['filed'];
                $excep_value    = $option['exception']['value'];
                $sql    = "SELECT COUNT(id) FROM $table WHERE $field = '$newVal'
                              AND  $excep_field != $excep_value ";  // KHI UPDATE DU LIEU TA PHAI CHUYEN THEM 2 THAM SO NAY DE SO SANH
                $sql = $wpdb->prepare($sql, '%s', '%s', '%s' , '%s', '%s' ); //%s CHO 5 DOI TUONG 'table', ' field', '$newVal, 'excep_value', 'excep_field '
                $result = $wpdb->get_col($sql);
            }
                if($result[0]  == 0){                   
                    return $newVal;
                }
        }
    }
}
