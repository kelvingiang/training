<?php
/*
  Template Name: Print Single Page
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
// KIEM TRA NEU CHUA DANG NHAP SE KHONG THE MO TRANG NAY 'USER LOGIN' 
$current_user = wp_get_current_user();
//echo $current_user->user_login;
if(empty($current_user->user_login)){
    wp_redirect( home_url() ); exit;
}
 $post_id = $_GET['id'];
// $data = get_post($post_id);
  $meta = get_post_meta($post_id);

            ?> 
             <h3 style='text-align: center'><?php _e('個人活動報名詳細表') ?></h3>
                </div>
             <hr>
             <div style=width:800px>
                        <div style="clear: both">
                                <div style="width: 50%; float: left">
                                    <label class="admin-title"><?php _e('登記者姓名 :', 'suite'); ?></label>
                                    <label> <?php echo $meta['e_fullname'][0] ?> </label>
                                </div>  
                                <div style="width: 50%; float: left">
                                </div>    
                        </div> 
             
                       <div style="clear: both">
                               <div style="width: 50%; float: left">
                                    <label  class="admin-title"><?php _e('英文名字 :', 'suite'); ?></label >
                                    <label> <?php echo $meta['e_enname'][0] ?> </label>
                                </div> 
                                <div style="width: 50%; float: left">
                                    <label class="admin-title"><?php _e('性別 :', 'suite'); ?></label>
                                    <label> <?php echo $meta['e_sex'][0] ==1 ? '男' : '女'; ?> </label>
                                </div>  
                       </div> 
             
                       <div style="clear: both">
                                <div style="width: 50%; float: left">
                                    <label class="admin-title"><?php _e('電話號碼 :', 'suite'); ?></label>
                                    <label> <?php echo $meta['e_phone'][0] ?> </label>
                                </div>  
                                <div style="width: 50%; float: left">
                                    <label  class="admin-title"><?php _e('郵電信箱 :', 'suite'); ?></label >
                                    <label> <?php echo $meta['e_email'][0] ?> </label>
                                </div>    
                       </div> 
                    
                        <div style="clear: both">
                                <div style="width: 50%; float: left">
                                    <label class="admin-title"><?php _e('商會名稱 :', 'suite'); ?></label>
                                    <label> <?php echo $meta['e_brach'][0] ?> </label>
                                </div>  
                                <div style="width: 50%; float: left">
                                    <label  class="admin-title"><?php _e('職 稱 :', 'suite'); ?></label >
                                    <label> <?php echo $meta['e_position'][0] ?> </label>
                                </div>    
                         </div> 
             <!-- ========= NGUOI DI CUNG       -->
                        <div style="clear: both">
                                <div style="width: 20%; float: left">
                                     <label class="admin-title"><?php _e('隨行眷屬 :', 'suite'); ?></label>
                                     <label><?php _e('人 數 ', 'suite'); ?></label> <label> <?php echo $meta['e_count'][0] ?> </label>
                                </div>  
                           </div>  
                                 <?php if($meta['e_count'][0]>0){ ?>
                                         <div style="clear: both">
                                             <div style="width: 9%; float: left"> &nbsp;                      
                                              </div>   
                                              <div style="width: 80%; float: left">
                                                  <div style=" float: left; width: 30%"><label class="admin-title"><?php _e('中文名字 ', 'suite'); ?></label></div> 
                                                  <div style=" float: left; width: 40%"><label class="admin-title"><?php _e('英文名字', 'suite'); ?></label> </div>
                                                  <div class=" lbl_3"><label class="admin-title"><?php _e('關 係', 'suite'); ?></label> </div>
                                                  <div class=" lbl_3"><label class="admin-title"><?php _e('性 別', 'suite'); ?></label> </div>
                                                  <div class=" lbl_3"><label class="admin-title"><?php _e('飲 食', 'suite'); ?></label> </div>
                                              </div>  
                                         </div>  
                               <?php  }?>
                                      <?php if(!empty($meta['e_name_1'][0])){ ?>
                                         <div style="clear: both">
                                             <div style="width: 9%; float: left"> &nbsp;                      
                                              </div>   
                                              <div style="width: 80%; float: left">
                                                  <div style=" float: left; width: 30%"><label ><?php echo $meta['e_name_1'][0]?></label></div> 
                                                  <div style=" float: left; width: 40%"><label ><?php echo $meta['e_enname_1'][0] ?></label> </div>
                                                  <div class=" lbl_3"><label ><?php echo $meta['e_relation_1'][0] ?></label> </div>
                                                  <div class=" lbl_3"><label ><?php echo $meta['e_sex_1'][0]==1 ? '男' : '女'; ?></label> </div>
                                                  <div class=" lbl_3"><label ><?php echo $meta['e_eat_1'][0]==1 ? '一般' :'素食'; ?></label> </div>
                                              </div>  
                                         </div> 
                                      <?php } ?>
                                      <?php if(!empty($meta['e_name_2'][0])){ ?>
                                         <div style="clear: both">
                                             <div style="width: 9%; float: left"> &nbsp;                      
                                              </div>   
                                              <div style="width: 80%; float: left">
                                                  <div style=" float: left; width: 30%"><label><?php echo $meta['e_name_2'][0]?></label></div> 
                                                  <div style=" float: left; width: 40%"><label><?php echo $meta['e_enname_2'][0] ?></label> </div>
                                                  <div class=" lbl_3"><label><?php echo $meta['e_relation_2'][0] ?></label> </div>
                                                  <div class=" lbl_3"><label><?php echo $meta['e_sex_2'][0]==1 ? '男' : '女'; ?></label> </div>
                                                  <div class=" lbl_3"><label><?php echo $meta['e_eat_2'][0]==1 ? '一般' :'素食'; ?></label> </div>
                                              </div>  
                                         </div> 
                                      <?php } ?>
                                       <?php if(!empty($meta['e_name_3'][0])){ ?>
                                         <div style="clear: both">
                                             <div style="width: 9%; float: left"> &nbsp;                      
                                              </div>   
                                              <div style="width: 80%; float: left">
                                                  <div style=" float: left; width: 30%"><label><?php echo $meta['e_name_3'][0]?></label></div> 
                                                  <div style=" float: left; width: 40%"><label><?php echo $meta['e_enname_3'][0] ?></label> </div>
                                                  <div class=" lbl_3"><label><?php echo $meta['e_relation_3'][0] ?></label> </div>
                                                  <div class=" lbl_3"><label><?php echo $meta['e_sex_3'][0]==1 ? '男' : '女'; ?></label> </div>
                                                  <div class=" lbl_3"><label><?php echo $meta['e_eat_3'][0]==1 ? '一般' :'素食'; ?></label> </div>
                                              </div>  
                                         </div> 
                                      <?php } ?>
                                       <?php if(!empty($meta['e_name_4'][0])){ ?>
                                         <div style="clear: both">
                                             <div style="width: 9%; float: left"> &nbsp;                      
                                              </div>   
                                              <div style="width: 80%; float: left">
                                                  <div style=" float: left; width: 30%"><label><?php echo $meta['e_name_4'][0]?></label></div> 
                                                  <div style=" float: left; width: 40%"><label><?php echo $meta['e_enname_4'][0] ?></label> </div>
                                                  <div class=" lbl_3"><label><?php echo $meta['e_relation_4'][0] ?></label> </div>
                                                  <div class=" lbl_3"><label><?php echo $meta['e_sex_4'][0]==1 ? '男' : '女'; ?></label> </div>
                                                  <div class=" lbl_3"><label><?php echo $meta['e_eat_4'][0]==1 ? '一般' :'素食'; ?></label> </div>
                                              </div>  
                                         </div> 
                                      <?php } ?>
             <!-- ==========CACH THUC DON TIEP -->
                           <?php $dontiep = unserialize(get_post_meta($post_id,'e_dontiep', TRUE))?>      
                             <div style="clear: both">
                                <div style="width: 10%; float: left">
                                     <label class="admin-title"><?php _e('接送方式 :', 'suite'); ?></label>
                                </div>  
                           </div>  
                             <div style="width: 80%; float: left">
                                   <?php  
                                   foreach ($dontiep as $key => $value) {  ?>
                                        <label style=' line-height: 1.5; '> <?php echo $value; ?> </label></br>
                                   <?php  }?>
                             </div>
             <!-- ====== DAT PHONG NGU ======-->
                           <?php $room = unserialize(get_post_meta($post_id,'e_room', TRUE));?>      
                             <div style="clear: both">
                                <div style="width: 10%; float: left">
                                     <label class="admin-title"><?php _e('訂房資料 :', 'suite'); ?></label>
                                </div>  
                           </div>    
                              <div style="width: 80%; float: left">
                         <?php  if(isset($room['no_room'])){ ?>
                                        <label style=' line-height: 1.5; '> <?php echo $room['no_room']; ?> </label></br>
                         <?php } else { ?>
                                         <label class="admin-title"><?php _e('入住日期 : ', 'suite'); ?></label><label><?php echo  $room['check_in'] .' &nbsp; &nbsp;-- &nbsp; &nbsp;'  ;?></label>
                                         <label class="admin-title"><?php _e('退房日期 : ', 'suite'); ?></label><label><?php echo $room['check_out'];  ?></label></br>
                                         <?php // if(isset($room['s_room'])) { ?>
                                             <label><?php echo $room['s_qty'] .'&nbsp; 間 &nbsp;'. $room['s_room'];  ?></label>  </br>  
                                         <?php // } if(isset($room['b_room'])){ ?>
                                             <label><?php echo $room['b_qty'] .'&nbsp; 間 &nbsp;'. $room['b_room'] .',&nbsp; &nbsp;';  ?></label> 
                                            <label><?php echo $room['s_bed'] .'&nbsp; &nbsp;'. $room['b_bed'];  ?> </label>  </br>  
                                         <?php // } ?>
                           <?php } ?>           
                         </div>  
               <!-- DUNG BUA -->
                        <?php $meal = unserialize(get_post_meta($post_id,'e_meal', TRUE))?>      
                          <div style="clear: both">
                                <div style="width: 10%; float: left">
                                     <label class="admin-title"><?php _e('餐宴 :', 'suite'); ?></label>
                                </div>  
                           </div>  
                             <div style="width: 80%; float: left">
                                   <?php  
                                   foreach ($meal as $key => $value) { 
                                       $arr =  explode(',', $value);
                                       ?>
                                        <label style=' line-height: 1.5; '> <?php echo $arr[0] .' - ' . $arr[1] .' : '. $arr[2]; ?> </label></br>
                                   <?php  }?>
                             </div>
                               <?php $orther = unserialize(get_post_meta($post_id , 'e_orther', TRUE) );
                                      foreach ($orther  as $val){
                                         $arr= explode(',' , $val);
                                   ?>
                            <div style="clear: both">
                                <div style="width: 50%;">
                                     <label class="admin-title"><?php echo $arr[0]. ':'; ?></label> 
                                </div>        
                           </div>  
                                     <div style="width: 80%; margin-left: 10%">
                                         <label style=' line-height: 1.5; '> <?php echo  $arr[1] .' : '. $arr[2]; ?> </label>
                                     </div>
                        
                             <?php } ?> 
               <!--  GHI CHU -->
                         <div style="clear: both">
                                         <div style="width: 9%; float: left">
                                              <label class="admin-title"><?php _e('備註 :', 'suite'); ?></label>
                                         </div>  
                           </div>  
                                      <div style="width: 80%; float: left">
                                                 <label style=' line-height: 1.5; '> <?php echo $meta['e_note'][0]  ?> </label></br>
                                      </div>

        <div style=" height: 20px; padding-top: 5px;clear: both "><hr></div>
            <?php  
      
            ?>
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