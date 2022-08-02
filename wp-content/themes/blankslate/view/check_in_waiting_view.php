<?php

?>
<div>
    <h2 style="letter-spacing: 2px"> <?php echo   __('Setting Meeting Title and Start Check In Time') ?> </h2>
</div>
<form action="" method="post" id="checkInTime" name="checkInTime">
    <div>
      <div class="wait_row">
        <div style="width: 10%">
          <label><?php  echo __('Meeting Title')?></label>  
        </div>
        <div style=" width: 90%">
           <input type="text"name="txtTitle" 
                  id="txtTitle" 
                  value="<?php echo get_option('check_in_title'); ?>" 
                  style =" width:550px; margin-right: 10px; height: 30px"  />  
        </div>
        <div style="height: 10px; width: 100%"></div>
        <div style="width: 10%">
           <label><?php echo __('Start Check In Time') ?></label>
        </div>
        <div style=" width: 90%">
           <input type="text"name="txtWait" 
                  id="txtWait" 
                  value="<?php echo get_option('check_in_waitting'); ?>" 
                  style =" width:550px; margin-right: 10px; height: 30px"  />  
         </div>
        </div>
        <div style=" width: 65%; text-align: right">
            <input name="submit" id="submit" 
                   class="button button-primary" 
                   value="<?php echo __('Submit') ?>" type="submit" 
                   style="margin-top: 30px; letter-spacing: 3px"> 
        </div>
    </div>
    </form>
 
<style>
    .wait_row{ margin-left: 50px;  margin-top: 20px}
    .wait_row div{
        float:  left;
    }
    .wait_row label{
        font-weight: bold;
        font-size: 14px;
        line-height: 2.3;    
    }
</style>
