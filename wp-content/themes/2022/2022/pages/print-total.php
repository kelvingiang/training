<?php
/*
  Template Name: Print Total Page
 */

?>
<html>
    <head>
        <style type='text/css'>
            .admin-title {
               font-weight: bold;
            }
            #print_report{
                cursor: pointer;
                background-color: #008EC2;
                position:  absolute;
                padding: 7px 20px;
                margin-top: 0px;
                border-radius: 5px;
                color: white;
                font-size: 13px; 
                right: 20px;
                top: 20px;
            }
            #print_report:hover{
                  background-color: #0075A0;
                  color: #d7d7d7;
            }
            
            .lbl_3{
                float: left; 
                width: 10%; 
                text-align: center;
            }
        </style>
            <script src="<?php echo get_template_directory_uri() . '/js/jquery-1.11.3.min.js'; ?>" type="text/javascript"></script>
    </head>
    <body>
      <h3 id="print_report" >列 印</h3>
<?php

$current_user = wp_get_current_user();
//echo $current_user->user_login;
if(empty($current_user->user_login)){
    wp_redirect( home_url() ); exit;
}
                  $mealArray = array();
                  $roomArray = array();
                  $ortherArray  = array();
                  
                 $arrEvent1 = array(
                         'post_type' => 'join',
                         'orderby' => 'date',
                         'posts_per_page' => -1,
                         'order' => 'DECS',
                    );
                    $myQuery1 = new WP_Query($arrEvent1 );
                          if ($myQuery1->have_posts()):
                              while ($myQuery1->have_posts()):
                                    $myQuery1->the_post();
                                    $id = get_the_ID();
                                    $meta = get_post_meta($id);
                            // SO NGUOI THAM GIA
                                 $dependents +=(int)$meta['e_count'][0];
                                 $member ++;
                                 $total = $dependents + $member;
                            // AN UONG 
                                  if($meta['e_eat'][0] =='1') {$eat1 ++;} elseif($meta['e_eat'][0] =='2') {$eat2 ++;};  
                                  if($meta['e_eat_1'][0] =='1') {$eat1 ++;} elseif($meta['e_eat_1'][0] =='2')  {$eat2 ++;};  
                                  if($meta['e_eat_2'][0] =='1') {$eat1 ++;} elseif($meta['e_eat_2'][0] =='2')  {$eat2 ++;};  
                                  if($meta['e_eat_3'][0] =='1') {$eat1 ++;} elseif($meta['e_eat_3'][0] =='2')  {$eat2 ++;};
                                  if($meta['e_eat_4'][0] =='1') {$eat1 ++;} elseif($meta['e_eat_4'][0] =='2')  {$eat2 ++;};
                                  
                             // THAM GIA DUNG BUA
                                  $meal= unserialize(get_post_meta($id,'e_meal', TRUE)); 
                                  if(!empty($meal)){
                                  foreach ($meal as $key=>$value){
                                    $mealData = explode(',', $value); 
                                    $mealArray[] = array( 'name' => $mealData[0], 'count' =>(int)$mealData[2]) ;
                                  }}
                                 
                                  // CAC THANH PHAN THEM MOI KHAC
                                  $orther = unserialize(get_post_meta($id,'e_orther',TRUE));
                                   if(!empty($orther)){
                                       foreach ($orther as $value){
                                           $ortherData = explode(',', $value);
                                           $ortherArray[] = array('title' => $ortherData[0], 'count' => (int)$ortherData[2]);
                                       }
                                   }
                                  
                               // DAT PHONG  
                                  $room = unserialize(get_post_meta($id,'e_room', TRUE));
                                     if(!empty($room)){$roomArray[]= $room;}
                               endwhile;
                         endif;
                         
             
                 //  LAY TAT CA VA GROUP CAC TEN TRUNG CHI LAY 1;
                         $arrGroup = array();
                         if(!empty($mealArray)){
                            foreach ($mealArray as  $key => $value){
                                $arrGroup[$value['name']] =1;
                                }  
                         }
                         
                              $arrGruopOrther = array();
                         if(!empty($ortherArray)){
                             foreach ($ortherArray as $key =>$value){
                                       $arrGruopOrther[$value['title']] = 1;
                             }
                         }
             // LAY SO LUONG NGUOI THAM GIA DE THONG KE TOTAL
                         $arrTotal = array();
                         if(!empty($arrGroup)){
                                foreach ( $arrGroup as $key=>$value ){
                                    $dd='';
                                  foreach ($mealArray as  $value2){
                                         if($key == $value2['name']){
                                            $dd[] =$value2['count'];
                                         }
                                  }
                               $arrTotal[] = array($key,$dd);
                                }
                         }
             $arrOrtherTotal = array();
                         if(!empty($arrGruopOrther)){
                             foreach ($arrGruopOrther as $key=>$value){
                                 $or ='';
                                 foreach ($ortherArray as $value2){
                                     if($key ==$value2['title']){
                                         $or[] =$value2['count'];
                                     }
                                 }
                             $arrOrtherTotal[] = array($key,$or);   
                             }
                         }
                  //SO LUONG VA LOAI PHONG DUOC DAT
                         $arrRoom = array();
                         $arrRoom[] = $roomArray[1]['b_room'];
                         $arrRoom[] = $roomArray[1]['s_room'];
                         foreach ($roomArray as $value){
                             $b_qty[]= $value['b_qty'];
                             $s_qty[]=$value['s_qty'];
                         }
                         $arrRoom[]=$b_qty;
                         $arrRoom[]=$s_qty;
// SHOW   ?> 
                <?php
                echo '<div style=" background-color : #FCF9E3; font-weight: bold; font-size: 13px; line-height:1.4;padding: 10px; color: back">';
                    echo '<h3>總計數據</h3>';
//                    echo 'Dependents : '. $this->dependents;
//                    echo '</br> member : '. $this->member;
                    echo '<div><label> 參加總人數  =  '.$total.' 位 </label></div>';
                    echo '<div><label> 飲食(一般)  =  '. $eat1.' 位  </label></div>';
                    echo '<div><label> 飲食(素養)  =  '. $eat2.' 位 </label></div>';
                    // SHOW THAM GIA DUN GBUA
                    if(!empty($arrTotal)){
                     foreach ( $arrTotal as $value){
                             echo $value[0] . ' = ';
                             echo array_sum($value[1]);
                             echo ' 位 <br>';
                         }
                    }    
                    // SHOW LOAI VA SO PHONG PHAI DAT
                 if(!empty($arrRoom)){   
                    echo  $arrRoom[0]. ' = '. array_sum($arrRoom[2]).' 房<br>'; 
                    echo  $arrRoom[1]. ' = '. array_sum($arrRoom[3]).' 房<br>'; 
                 }
                       //ORTHER THONG KE CAC PHAN ADD THEM
                    if(!empty($arrOrtherTotal)){
                        foreach ($arrOrtherTotal as $value){
                            echo $value[0] . '  = ';
                            echo array_sum($value[1]);
                            echo ' 位 <br>';
                        }
                    }
                echo '</div>';
            ?> 
                                      </div>

        <div style=" height: 1px; margin-top:35px;  margin-bottom: 15px; background-color: #999999; clear: both "></div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
       jQuery('#print_report').click(function(){
             jQuery(this).hide();
                 window.print();
             jQuery(this).show();
       });
    });
 </script>
</body>
</html>