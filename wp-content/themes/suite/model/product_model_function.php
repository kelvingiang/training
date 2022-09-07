<?php 

class Product_Model_Function {

    public function get_item($arrData = array(), $option = array())
    {
        global $wpdb;
        $table = $wpdb->prefix . 'product'; //prefix tiền tố là wp
        $id = absint($arrData['id']); //chuyển id về kiều int
        $sql = "SELECT * FROM $table WHERE ID = $id";
        $row = $wpdb->get_row($sql, ARRAY_A);
        return $row;
    }

    public function trashItem($arrData = array(), $option = array())
    {
        global $wpdb;
        $table = $wpdb->prefix . 'product';

        /*
            kiểm tra phần có phân dạng chuỗi hay không
            -- $arrData['ID'] là tên cột ID trong database
            -- $arrData['id'] là từ tên cột ID trong database chuyển đổi qua hàm absint()
        */
        if (!is_array($arrData['ID'])) {
            $data = array('trash' => 1); //data ở trash
            $where = array('ID' => absint($arrData['id']));
            $wpdb->update($table, $data, $where);
        } else {
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
        $table = $wpdb->prefix . 'product';

        /*
            kiểm tra phần có phân dạng chuỗi hay không
            -- $arrData['ID'] là tên cột ID trong database
            -- $arrData['id'] là từ tên cột ID trong database chuyển đổi qua hàm absint()
        */
        if (!is_array($arrData['ID'])) {
            $data = array('trash' => 0); //data ở publish
            $where = array('ID' => absint($arrData['id']));
            $wpdb->update($table, $data, $where);
        } else {
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

        /*
            kiểm tra phần có phân dạng chuỗi hay không
            -- $arrData['ID'] là tên cột ID trong database
            -- $arrData['id'] là từ tên cột ID trong database chuyển đổi qua hàm absint()
        */
        if (!is_array($arrData['ID'])) {
            $where = array('ID' => absint($arrData['id']));
            $wpdb->delete($table, $where);
        } else {
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

    public function saveItem($arrData = array(), $option = array())
    {
        global $wpdb;
        $table = $wpdb->prefix . 'product';
        $currentUser = wp_get_current_user();
        $user = $currentUser->user_login; //lấy ra tên user

        $data = array(
            'product_name' => $arrData['txt-product-name'],
            'price' => $arrData['txt-price'],
            'category' => $arrData['selectbox-category'],
            'update_date' => date('d-m-Y'),
            'update_by' => $user,
            'setorder' => $arrData['txt-order'],
            'user_name' => $arrData['txt-username'],
            'password' => md5($arrData['txt-password']),
        );

        $dataAdd = array(
            'trash' => 0,
            'create_date' => date('d-m-Y'),
            'create_by' => $user,

        );

        $dataInsert = array_merge($data, $dataAdd);

        //kiểm tra action update hay insert
        if ($option['action'] == 'update') {
            $where = array('ID' => $option['ID']);
            $wpdb->update($table, $data, $where);
        } elseif ($option['action'] == 'insert') {
            $wpdb->insert($table, $dataInsert);
        }
    }

    public function getAllData()
    {
        global $wpdb;
        $table = $wpdb->prefix . 'product'; //prefix tiền tố là wp
        $sql = "SELECT * FROM $table";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    } 

    public function getAllDataByCategory($item)
    {   
        global $wpdb;
        $table = $wpdb->prefix . 'product'; //prefix tiền tố là wp
        $item == '' ? $sql = "SELECT * FROM $table " : $sql = "SELECT * FROM $table WHERE category = $item";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    public function productLogin($user, $pass)
    {
        global $wpdb;
        $table = $wpdb->prefix . 'product'; //prefix tiền tố là wp
        $sql = "SELECT * FROM $table WHERE user_name = '$user' and password = '$pass'";
        $row = $wpdb->get_row($sql, ARRAY_A);
        if(empty($row)){
            $rs = " Wrong username or password!";
        }else{
            $_SESSION['txt-username'] = $row['ID']; //lưu session username gắn bằng id
            wp_redirect(home_url('products')); 
        }
        return $rs;
    }

    public function productLogout()
    {
        if(isset($_SESSION['txt-username'])){
            unset($_SESSION['txt-username']); //xóa session login
            wp_redirect(home_url('product-login')); 
        }
    
    }

    public function changeProductPassword($oldPass,$newPass)
    {
        global $wpdb;
        $table = $wpdb->prefix . 'product';
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