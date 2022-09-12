<?php

class Admin_Model_Member_Function {
    /**
     * =======================================================================
     * -------------------- CÁC FUNCTION XỬ LÝ DATA ------------------------
     * =======================================================================
     * 
     */
    public function get_item($arrData = array(), $option = array())
    {
        global $wpdb;
        $id = absint($arrData['id']); //chuyển id về kiều int
        $table = $wpdb->prefix . 'member'; //prefix tiền tố là wp
        $sql = "SELECT * FROM $table WHERE ID = $id";
        $row = $wpdb->get_row($sql, ARRAY_A);
        return $row; 
    }

    public function trashItem($arrData = array(), $option = array())
    {
        global $wpdb;
        $table = $wpdb->prefix . 'member';
        
        /*
            kiểm tra phần có phân dạng chuỗi hay không
            -- $arrData['ID'] là tên cột ID trong database
            -- $arrData['id'] là từ tên cột ID trong database chuyển đổi qua hàm absint()
        */
        if (!is_array($arrData['ID'])) {
            $data = array('trash' => 1); //data ở trash
            $where = array('ID' => absint($arrData['id']));
            $wpdb->update($table,$data,$where);
        }else {
            /**
             * $arrData['id] chuyển qua ID-barcode, ví dụ 111-222333
             * do sử dụng array_map('absint) nó chỉ lấy số nên khi
             * lấy để dấu '-' không tiếp tục lấy
             * vậy là chỉ lấy phần đầu là ID không cần tách chuỗi
             */
            $arrData['id'] = array_map('absint', $arrData['ID']);
            $ids = join(',', $arrData['id']);
            $sql = "UPDATE $table SET `trash` = '1' WHERE ID IN ($ids)";
            $wpdb->query($sql);
        }
    }

    public function restoreItem($arrData = array(), $option = array())
    {
        global $wpdb;
        $table = $wpdb->prefix . 'member';
        
        /*
            kiểm tra phần có phân dạng chuỗi hay không
            -- $arrData['ID'] là tên cột ID trong database
            -- $arrData['id'] là từ tên cột ID trong database chuyển đổi qua hàm absint()
        */
        if (!is_array($arrData['ID'])) {
            $data = array('trash' => 0); //data ở publish
            $where = array('ID' => absint($arrData['id']));
            $wpdb->update($table,$data,$where);
        }else {
            /**
             * $arrData['id] chuyển qua ID-barcode, ví dụ 111-222333
             * do sử dụng array_map('absint) nó chỉ lấy số nên khi
             * lấy để dấu '-' không tiếp tục lấy
             * vậy là chỉ lấy phần đầu là ID không cần tách chuỗi
             */
            $arrData['id'] = array_map('absint', $arrData['ID']);
            $ids = join(',', $arrData['id']);
            $sql = "UPDATE $table SET `trash` = '0' WHERE ID IN ($ids)";
            $wpdb->query($sql);
        }
    }

    public function deleteItem($arrData = array(), $option = array())
    {
        global $wpdb;
        $table = $wpdb->prefix . 'product';
        $this->deleteImg($arrData['ID']);
        /*
            kiểm tra phần có phân dạng chuỗi hay không
            -- $arrData['ID'] là tên cột ID trong database
            -- $arrData['id'] là từ tên cột ID trong database chuyển đổi qua hàm absint()
        */
        if (!is_array($arrData['ID'])) {
            $where = array('ID' => absint($arrData['id']));
            $wpdb->delete($table,$where);
        }else {
            /**
             * $arrData['id] chuyển qua ID-barcode, ví dụ 111-222333
             * do sử dụng array_map('absint) nó chỉ lấy số nên khi
             * lấy để dấu '-' không tiếp tục lấy
             * vậy là chỉ lấy phần đầu là ID không cần tách chuỗi
             */
            $arrData['id'] = array_map('absint', $arrData['ID']);
            $ids = join(',', $arrData['id']);
            $sql = "DELETE FROM $table WHERE ID IN ($ids)";
            $wpdb->query($sql);
        }
    }

    private function deleteImg($arrID)
    {
        global $wpdb;
        $table = $wpdb->prefix . 'member';
        if(!is_array($arrID)) {
            $sql = "SELECT * FROM $table WHERE ID= $arrID";
            $row = $wpdb->get_row($sql, ARRAY_A);
            //xoá hình trong folder
            unlink(DIR_IMAGE_MEMBER . $row['img']);
        } else{
            foreach($arrID as $key) {
                $sql = "SELECT * FROM $table WHERE ID = $key";
                $row = $wpdb->get_row($sql, ARRAY_A);
                //xóa hình
                unlink(DIR_IMAGE_MEMBER) . $row['img'];
            }
        }
    }

    public function saveItem($arrData = array(), $option = array())
    {
        global $wpdb;
        $table = $wpdb->prefix . 'member';
        $currentUser = wp_get_current_user();
        $user = $currentUser->user_login; //lấy ra tên user

        //xử lý hình
        if(!empty($_FILES['member_img']['name'])) { 
            $errors = array();
            $file_name = $_FILES['member_img']['name'];
            $file_size = $_FILES['member_img']['size'];
            $file_tmp = $_FILES['member_img']['tmp_name'];
            $file_type = $_FILES['member_img']['type'];

            $file_trim = ((explode('.', $_FILES['member_img']['name']))); //tách chuỗi 
            $trim_name = strtolower($file_trim[0]);
            $trim_type = strtolower($file_trim[1]);

            $extensions = array("jpeg", "jpg", "png", "bmp"); //đuôi hình
            if (in_array($trim_type, $extensions) === false) {
                $errors[] = "上傳照片檔案是 JPEG, PNG, BMP.";
            }
            if ($file_size > 2097152) {
                $errors[] = '上傳檔案容量不可大於 2 MB';
            }

            //kiểm tra lỗi
            if(empty($errors) == true) {
                //upload hình
                //xóa hình barcode cũ, hình không sử dụng
                if(is_file(DIR_IMAGE_MEMBER . $arrData['hidden_img'])) {
                    unlink(DIR_IMAGE_MEMBER . $arrData['hidden_img']);
                }
                $file_name =$arrData['txt-contact-name'].'.'.$trim_type;
                move_uploaded_file($file_tmp, (DIR_IMAGE_MEMBER . $file_name));
            }else {
                return $errors;
            }
        } else {
            $file_name = $arrData['hidden_img'];
            
        }

        $data = array(
            'company_name' => $arrData['txt-company-name'],
            'contact_name' => $arrData['txt-contact-name'],
            'phone' => $arrData['txt-phone'],
            'cell_phone' => $arrData['txt-cell-phone'],
            'update_date' => date('d-m-Y'),
            'update_by' => $user,
            'setorder' => $arrData['txt-order'],
            'industry_id' => $arrData['sel_industry_id'],
            'group_id' => $arrData['sel_group_id'],
            'img' => $file_name,
            'user_name' => $arrData['txt-username'],
            'password' => md5($arrData['txt-password']),
        );

        $dataAdd = array(
            'trash' => 0,
            'create_date' => date('d-m-Y'),
            'create_by'=> $user,

        );

        $dataInsert = array_merge($data,$dataAdd);

        //kiểm tra action update hay insert
        if($option['action'] == 'update'){
            $where = array('ID' => $option['ID']);
            $wpdb->update($table,$data,$where);    
        }elseif ($option['action'] == 'insert'){
            $wpdb->insert($table,$dataInsert);
        }
    }

    //type 1: group_id, 2: industry_id
    //function lay category name tu database qua group_id
    function getCategoryNameByGroupID()
    {
        global $wpdb;
        $table = $wpdb->prefix . 'member_cate';
        $sql = "SELECT * FROM  $table WHERE type = 1";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    //function lay category name tu database qua industry_id
    function getCategoryNameByIndustryID()
    {
        global $wpdb;
        $table = $wpdb->prefix . 'member_cate';
        $sql = "SELECT * FROM  $table WHERE type = 2";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    public function getAllDataByCategory($item)
    {   
        global $wpdb;
        $table = $wpdb->prefix . 'member'; //prefix tiền tố là wp
        $item == '' ? $sql = "SELECT * FROM $table " : $sql = "SELECT * FROM $table WHERE category = $item";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    public function memberLogin($user, $pass)
    {
        global $wpdb;
        $table = $wpdb->prefix . 'member'; //prefix tiền tố là wp
        $sql = "SELECT * FROM $table WHERE user_name = '$user' and password = '$pass'";
        $row = $wpdb->get_row($sql, ARRAY_A);
        if(empty($row)){
            $rs = " Wrong username or password!";
        }else{
            $_SESSION['txt-username'] = $row['ID']; //lưu session username gắn bằng id
            wp_redirect(home_url('member-test')); 
        }
        return $rs;
    }

    public function memberLogout()
    {
        if(isset($_SESSION['txt-username'])){
            unset($_SESSION['txt-username']); //xóa session login
            wp_redirect(home_url('member-login')); 
        }
    
    }

    public function changeMemberPassword($oldPass,$newPass)
    {
        global $wpdb;
        $table = $wpdb->prefix . 'member';
        $sql = "SELECT password FROM $table WHERE ID = " . $_SESSION['txt-username'] . " and password = '$oldPass'";
        $row = $wpdb->get_row($sql, ARRAY_A);
        if(!empty($row['password'])){
            if($oldPass == $row['password']){
                $sql = "UPDATE $table set password = '$newPass' WHERE ID = " . $_SESSION['txt-username'];
                $wpdb->query($sql);
                $mess = "Password changed sucessfully!"; 
            }else{
                $mess = "Password is not correct!";
            }
            return $mess;
        }        
    }
}