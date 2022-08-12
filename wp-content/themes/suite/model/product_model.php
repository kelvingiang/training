<?php

// KIEM TRA  WP_List_Table CO TON TAI CHUA NEU CHUA SE INCLUSE VAO
if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php ';
}
class Product_Model extends WP_List_Table {

    private $_pre_page = 30;
    private $_sql;

    public function __construct($args = array())
    {
        $args = array(
            'plural' => 'ID', //giá trị này tương ứng với key trong table
            'singular' => 'ID', //giá trị này tương ứng với key trong table
            'ajax' => FALSE,
            'screen' => null,
        );
        parent::__construct($args);
    }

    /* 
        Hàm này bắt buộc phải có quan trọng để show list ra
        Các thông số và dữ liệu cần cung cấp để hiện thị girdview
    */
    public function prepare_items()
    {
        $columns = $this->get_columns(); //lấy ra 1 cột, cần hiển thị trên table
        $hidden = $this->get_hidden_columns(); // những cột sẽ ẩn đi
        $sorttable = $this->get_sortable_columns(); //các cột được sắp xếp asc hoặc desc

        //đưa 3 giá trị trên vào dãy để show dữ liệu
        $this->_column_headers = array($columns,$hidden,$sorttable);
        //lấy dữ liệu từ database
        $this->items = $this->table_data();

        $total_items = $this->total_items(); // tổng số dòng dữ liệu
        $per_page = $this->_pre_page; // số trang
        $total_pages = ceil($total_items / $per_page); // tổng số trang

        //phân trang
        $args = array(
            'total_items' => $total_items,
            'per_page' => $per_page,
            'total_pages' => $total_pages
        );
        $this->set_pagination_args($args);
    }

    /**
     * =========================================================
     * CAC FUNCTION NHẤT ĐỊNH PHẢI CÓ TRONG LIST NÀY
     * =========================================================
     */
    //lấy các cột tương ứng trên database dán vào các cột trên girdview
    public function get_columns()
    {
        $arr = array(
            'cb' => '<input type="checkbox" />', // bắt buộc
            'product_name' => __('Product Name'),
            'price' => __('Price'),
            'category' => __('Category'),
            'create_date' => __('Create Date'),
            'update_date' => __('Update Date'),
            'setorder' => __('Order'),
        );
        return $arr;
    }
     
    //khai báo các cột bị ẩn đi trên girdview
    public function get_hidden_columns()
    {
        return array('');
    }

    //săp xếp cột tăng hay giảm dần
    public function get_sortable_columns() 
    {
        return array(
            'product_name' =>array('product_name',true),
            'setorder' => array('setorder', true),
            'id' => array('id', true),
        );
    }

    /**
     * =========================================================
     * CÁC FUNCTION LẤY DATA TỪ DATABASE
     * ==========================================================
     */
    //lấy dữ liệu trong database
    private function table_data()
    {
        $data = array();
        global $wpdb; //đối tượng trừu tượng database wordpress
        
        //lấy giá trị sắp xếp dữ liệu trên cột
        $orderby = (getParams('orderby') == ' ') ? 'id' : $_GET['orderby'];
        $order = (getParams('setorder') == ' ') ? 'DESC' : $_GET['setorder'];
        $tblTest = $wpdb->prefix . 'product';
        $sql = 'SELECT * FROM ' . $tblTest . ' AS wp_p  ';
        $whereArr = array(); //tạo mảng where

        //kiểm tra trash, trash mặc định là 0 : hiện hành, 1 : đã xóa
        if(getParams('customvar') == 'trash') { //customvar là biến mặc định
            $whereArr[] = "(trash = 1)";
        } else {
            $whereArr[] = "(trash = 0)";
        }

        //kiểm tra nhánh lọc
        if(getParams('filter_branch') != ' ') {
           //chưa sử dụng - gọi tới function extra_tablenav
        }

        //kiểm tra search
        if(getParams('s') != ' ') {
            $s = esc_sql(getParams('s'));
            $whereArr[] = "( wp_p.product_name LIKE '%$s%')";
        }

        //chuyển các giá trị WHERE kết với nhau bởi AND
        if(count($whereArr) > 0){
            $sql .= " WHERE " . join(" AND ", $whereArr);
        }
        //order by
        //$sql .= 'ORDER BY wp_p' . esc_sql($orderby) . ' ' . esc_sql($order);
        
        $this->_sql = $sql;

        //lấy giá trị phân trang pageing
        $paged = max(1, @$_REQUEST['paged']);
        $offset = ($paged - 1) * $this->_pre_page;

        $sql .= ' LIMIT  ' . $this->_pre_page . ' OFFSET ' . $offset;

        //lấy kết quả thông qua câu sql
        $data = $wpdb->get_results($sql, ARRAY_A);
        return $data;
    }   

    //tính tổng số dòng dữ liệu để áp dụng cho việc phân trang
    public function total_items()
    {
        global $wpdb;
        return $wpdb->query($this->_sql);
    }

    //số tổng item dùng để phân trang
    public function total_list() 
    {
        global $wpdb;
        $tblOrdert = $wpdb->prefix . 'product'; //prefix là tiền tố wp
        return $wpdb->get_var("SELECT COUNT(*) FROM $tblOrdert");
    }

    //số tổng item trong trash - trash = 1
    public function total_trash() 
    {
        global $wpdb;
        $tblOrdert = $wpdb->prefix . 'product'; //prefix là tiền tố wp
        return $wpdb->get_var("SELECT COUNT(*) FROM $tblOrdert WHERE trash = 1"); 
    }

    //số tổng item hiện hành - trash = 0
    public function total_publish()
    {
        global $wpdb;
        $tblOrdert = $wpdb->prefix . 'product'; //prefix là tiền tố wp
        return $wpdb->get_var("SELECT COUNT(*) FROM $tblOrdert WHERE trash = 0");
    }

    /**
     * =========================================================
     * CÁC FUNCTION SELECT BOX Ở PHẦN ĐẦU CỦA LIST
     * ==========================================================
     */
    //phần show thống kê số item ở đầu list
    //(tổng số item, số item hiện hành, số item rác)
    function get_views()
    {
        $views = array();
        $current = (!empty($_REQUEST['customvar']) ? $_REQUEST['customvar'] : 'all');

        //all link
        $class = ($current == 'all' ? 'class="current"' : '');
        $all_url = remove_query_arg('customvar');
        $views['all'] = "<strong>" . __('All') . " (" . $this->total_list() . ")</strong>";

        //foo link
        $foo_url = add_query_arg('customvar', 'published');
        $class = ($current == 'foo' ? ' class="current"' : '');
        $views['foo'] = "<a href='{$foo_url}' {$class} > " . __('Published') . " (" . $this->total_publish() . ")</a>";
        
        //bar link
        $bar_url = add_query_arg('customvar', 'trash');
        $class = ($current == 'bar' ? ' class="current"' : '');
        $views['bar'] = "<a href='{$bar_url}' {$class} >" . __('Trash') . "(" . $this->total_trash() . ")</a>";

        return $views;
    }

    //các item trong select box chức năng `ứng dụng`
    public function get_bulk_actions() 
    {   

        if (isset($_GET['customvar']) == 'trash') {
            $actions = array(
                'restore' => __('Restore'), //khôi phục
                'delete' => __('Delete Permanently') //xóa vĩnh viễn
            );
        } else {
            $actions = array(
                'trash' => __('Trash'),
                    // 'uncheckin' => '取消報到'
            );
        }
        return $actions;
    }

    //các item trong select box trong phần filter
    public function extra_tablenav($which) 
    {
        if($which == 'top') {
            ?>
                <select>
                    <option value="selected">Select</option>
                    <option value="1">Novel</option>
                    <option value="2">Textbook</option>
                    <option value="3">Pen</option>
                    <option value="4">Paper</option>
                </select>
            <?php
            // $htmlObj = new MyHtml();
            //$filterVal = @$_REQUEST['filter_branch'];
            // $first_row = array(array('ID' => '', 'name' => __('Select Industry')));
            // $last_row = array(array('ID' => -1, 'name' => __('Other')));
            // $list1 = array_merge($first_row, getMemberIndustry());
            // $list = array_merge($list1, $last_row);
            // foreach ($list as $val) {
            //     $arrlist[$val['ID']] = $val['name'];
            // }
            // $options['data'] = $arrlist; 

            //thêm phần select box tìm kiếm
            // $slbFilter = $htmlObj->selectbox('filter_branch', $filterVal, array(), $options);
            // $attr = array('id' => 'filter_action', 'class' => 'button');
            // $btnFilter = $htmlObj->button('filter_action', __('Filter'), $attr);
            // echo '<div class="alignleft action bulkactions">' . $slbFilter . $btnFilter . '</div>';
        }
    }

    /**
     * =========================================================
     * CÁC FUNCTION THIẾT LẬP GIÁ TRỊ CHO CÁC COLUMN
     * ==========================================================
     */
    //tạo các check box ở đầu dòng trống của cột
    public function column_cb($item) 
    {
        //$singular = $this->args['singular'];
        $html = '<input type="checkbox" name="' . 'singular' . '[]" value="' . $item['ID'] . '"/>';
        return $html;
    }

    //thêm cac phần chỉnh sửa nhanh tại column này
    //đặt tên column_ten column cần tạo các chỉnh sửa nhanh
    public function column_product_name($item)
    {
        $page = getParams('page');
        $name = 'security_code';

        if(isset($_GET['customvar']) == 'trash') {
            $actions = array(
                'restore' => '<a href=" ?page=' . $page . '&action=restore&id=' . $item['ID'] . ' " >' . __('Restore') . '</a>',
                'delete' => '<a href=" ?page=' . $page . '&action=delete&id=' . $item['ID'] . ' " >' . __('Delete Permanently') . ' </a>',
            );
        }else {
            $actions = array(
                'edit' => '<a href=" ?page=' . $page . '&action=edit&id=' . $item['ID'] . ' " >' . __('Edit') . '</a>',
                'trash' => '<a href=" ?page=' . $page . '&action=trash&id=' . $item['ID'] . ' " >' . __('Trash') . '</a>',
            );
        }
        $html = '<strong> <a href="?page=' . $page . '&action=edit&id=' . $item['ID'] . ' ">' . $item['product_name'] . '</a> </strong>' . $this->row_actions($actions);
        return $html;
    }

    public function column_setorder($item)
    {
        echo '<label>' . $item['setorder'] . '</label>';
    }

    //các column mặc định khi load trang sẽ hiện lên
    public function column_default($item,$column_name)
    {
        return $item[$column_name];
    }

    /*=========================================================
        ---------------- CÁC FUNCTION XỬ LÝ DATA ------------
      ==========================================================
      //từ đoạn này trở lên là các function phía trên bắt buộc có  
    */

    public function get_item($arrData = array(), $option = array())
    {
        global $wpdb;
        $id = absint($arrData['id']); //chuyển id về kiều int
        $table = $wpdb->prefix . 'product'; //prefix tiền tố là wp
        $sql = "SELECT * FROM $table WHERE ID = $id";
        $row = $wpdb->get_row($sql, ARRAY_A);
        return $row;
    }

    public function trashItem($arrData = array(), $option = array())
    {
        global $wpdb;
        $table = $wpdb->prefix . 'product';
        
        //kiểm tra phần có phân dạng chuỗi hay không
        if (!is_array($arrData['id'])) {
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
            $arrData['id'] = array_map('absint', $arrData['id']);
            $ids = join(',', $arrData['id']);
            $sql = "UPDATE $table SET `trash` = '1' WHERE ID IN ($ids)";
            $wpdb->query($sql);
        }
        
    }

    public function restoreItem($arrData = array(), $option = array())
    {
        global $wpdb;
        $table = $wpdb->prefix . 'product';
        
        //kiểm tra phần có phân dạng chuỗi hay không
        if (!is_array($arrData['id'])) {
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
            $arrData['id'] = array_map('absint', $arrData['id']);
            $ids = join(',', $arrData['id']);
            $sql = "UPDATE $table SET `trash` = '0' WHERE ID IN ($ids)";
            $wpdb->query($sql);
        }
    }

    public function deleteItem($arrData = array(), $option = array())
    {
        global $wpdb;
        $table = $wpdb->prefix . 'product';
        
        //kiểm tra phần có phân dạng chuỗi hay không
        if (!is_array($arrData['id'])) {
            $where = array('ID' => absint($arrData['id']));
            $wpdb->delete($table,$where);
        }else {
            /**
             * $arrData['id] chuyển qua ID-barcode, ví dụ 111-222333
             * do sử dụng array_map('absint) nó chỉ lấy số nên khi
             * lấy để dấu '-' không tiếp tục lấy
             * vậy là chỉ lấy phần đầu là ID không cần tách chuỗi
             */
            $arrData['id'] = array_map('absint', $arrData['id']);
            $ids = join(',', $arrData['id']);
            $sql = "DELETE FROM $table WHERE ID IN ($ids)";
            $wpdb->query($sql);
        }
    }

    public function saveItem($arrData = array(), $option = array())
    {
        global $wpdb;
        $table = $wpdb->prefix . 'product';

        $create_date = $arrData['txt-create-date'];
        $update_date = $arrData['txt-update-date'];
        $data = array(
            'product_name' => $arrData['txt-product-name'],
            'price' => $arrData['txt-price'],
            'category' => $arrData['txt-category'],
            'create_date' => $create_date,
            'update_date' => $update_date,
            'setorder' => $arrData['txt-order'],
        );

        $dataAdd = array(
            'trash' => 0,
            'create_date' => date('d-m-Y'),
            'update_date' => date('d-m-Y'),
        );

        $dataInsert = array_merge($data,$dataAdd);

        //kiểm tra action update hay insert
        if($option['action'] == 'update'){
            $where = array('ID' => $option['ID']);
            $wpdb->update($table,$data,$where);
        }elseif ($option['action' == 'insert']){
            $wpdb->insert($table,$dataInsert);
        }
    }
}