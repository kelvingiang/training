<?php 

// KIEM TRA  WP_List_Table CO TON TAI CHUA NEU CHUA SE INCLUSE VAO
if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php ';
}

class Admin_Model_Member extends WP_List_Table {
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

    /**
     * hàm này bắt buộc phải có quan trọng để show list ra
     * các thông sô và dữ liệu cần cung cấp để hiện thị girdview
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
     * ============================================================
     * CÁC FUNCTION NHẤT ĐỊNH PHẢI CÓ TRONG LIST
     * ============================================================
     */
    //lấy các cột tương ứng trên database dán vào cột girdview
    public function get_columns()
    {
        $arr = array(
            'cb' => '<input type="checkbox" />', // bắt buộc
            'company_name' => __('Company Name'),
            'user_name' => __('User Name'),
            'password' => __('Password'),
            'img' => __('Image'),
            'contact_name' => __('Contact Name'),
            'phone' => __('Phone'),
            //'cell_phone' => __('Cell Phone'),
            'create_date' => __('Create Date'),
            'update_date' => __('Update Date'),
            'setorder' => __('Order'),
        );
        return $arr;
    }

    //khai báo các cột bị ẩn trên girdview
    public function get_hidden_columns()
    {
        return array('');
    }

    //sắp xếp cột tăng hay giảm dần
    public function get_sortable_columns()
    {
        return array(
            'company_name' =>array('company_name',true),
            'setorder' => array('setorder', true),
            'id' => array('ID', true),
        );
    }

    /**
     * ============================================================
     * CÁC FUNCTION LẤY DATA TỪ DATABASE
     * ============================================================
     */
    //lấy dữ liệu trong database
    private function table_data()
    {
        $data = array();
        global $wpdb; //đối tượng trừu tượng database wordpress
        
        //lấy giá trị sắp xếp dữ liệu trên cột
        $orderby = (getParams('orderby') == ' ') ? 'ID' : $_GET['orderby'];
        $order = (getParams('order') == ' ') ? 'DESC' : $_GET['order'];
        $tblTest = $wpdb->prefix . 'member';
        $sql = 'SELECT * FROM ' . $tblTest ;
        $whereArr = array(); //tạo mảng where

        //kiểm tra trash, trash mặc định là 0 : hiện hành, 1 : đã xóa
        if(getParams('customvar') == 'trash') { //customvar là biến mặc định
            $whereArr[] = "(trash = 1)";
        } else {
            $whereArr[] = "(trash = 0)";
        }

        //kiểm tra filter industry 
        if(getParams('filter_group') != ' ') {
            $branch = getParams('filter_group');
            if ($branch > 0) {
                $whereArr[] = "(group_id = $branch )"; 
            } elseif ($branch == -1) {
                $whereArr[] = "(group_id  = ' ')";
            } else {
                $whereArr[] = '';
            }
        }

        //kiểm tra filter industry 
        if(getParams('filter_industry') != ' ') {
            $branch = getParams('filter_industry');
            if ($branch > 0) {
                $whereArr[] = "(industry_id = $branch )"; 
            } elseif ($branch == -1) {
                $whereArr[] = "(industry_id  = ' ')";
            } else {
                $whereArr[] = '';
            }
        }

        //kiểm tra search
        if(getParams('s') != ' ') {
            $s = esc_sql(getParams('s'));
            $whereArr[] = "( company_name LIKE '%$s%')"; 
        }


        //chuyển các giá trị WHERE kết với nhau bởi AND
        if(count($whereArr) > 0){
            $sql .= " WHERE " . join(" AND ", $whereArr);
        }
        //order by
        $sql .= 'ORDER BY ' . esc_sql($orderby) . ' ' . esc_sql($order);

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

    //số item dùng để phân trang
    public function total_list()
    {
        global $wpdb;
        $tblOrdert = $wpdb->prefix . 'member'; // prefix là tiền tố wp
        return $wpdb->get_var("SELECT COUNT(*) FROM $tblOrdert");
    }

    //số tổng item trong trash/ trash = 1
    public function total_trash()
    {
        global $wpdb;
        $tblOrdert = $wpdb->prefix . 'member'; //prefix là tiền tố wp
        return $wpdb->get_var("SELECT COUNT(*) FROM $tblOrdert WHERE trash = 1");  
    }

    //số tổng item hiện hành/ trash = 0
    public function total_publish()
    {
        global $wpdb;
        $tblOrdert = $wpdb->prefix . 'member'; //prefix là tiền tố wp
        return $wpdb->get_var("SELECT COUNT(*) FROM $tblOrdert WHERE trash = 0");
    }

    /**
     * =======================================================================
     * CÁC FUNCTION SELECTBOX Ở PHẦN ĐẦU CỦA LIST
     * =======================================================================
     */
    //phần show thông ke số item ở đầu list (All | Publish | Trash)
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

    //các item trong select box chức năng 'ứng dụng'
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

    //các item trong selectbox trong phần filter
    public function extra_tablenav($which)
    {
        require_once(DIR_MODEL . 'admin-model-member-function.php');
        $model = new Admin_Model_Member_Function();
        if($which == 'top') {

            $first_row = array(array('ID' => 0, 'cate_name' => __('All Groups')));
            $last_row = array(array('ID' => -1, 'cate_name' => __('Other')));
            $list1 = array_merge($first_row, $model->getCategoryNameByGroupID());
            $list = array_merge($list1, $last_row);
            foreach ($list as $val) {
                $arrlist[$val['ID']] = $val['cate_name'];
            }
            $options['data'] = $arrlist;

            ?>
                <select name="filter_group" id="filter_group">
                    <?php foreach( $list as $selects) : ?>
                    <option value ="<?php echo $selects['ID'] ?>"<?php if( $selects['ID'] == getParams('filter_group') ): ?> 
                            selected= "selected" <?php endif; ?>><?php echo $selects['cate_name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" name="filter_action" id="filter_action" class="button" value="Filter">
            <?php

        }

        if($which == 'top') {

            $first_row = array(array('ID' => 0, 'cate_name' => __('All Industries')));
            $last_row = array(array('ID' => -1, 'cate_name' => __('Other')));
            $list1 = array_merge($first_row, $model->getCategoryNameByIndustryID());
            $list = array_merge($list1, $last_row);
            foreach ($list as $val) {
                $arrlist[$val['ID']] = $val['cate_name'];
            }
            $options['data'] = $arrlist;

            ?>
             <select name="filter_industry" id="filter_industry">
                    <?php foreach( $list as $selects) : ?>
                     <option value ="<?php echo $selects['ID'] ?>"<?php if( $selects['ID'] == getParams('filter_industry') ): ?> 
                             selected= "selected" <?php endif; ?>><?php echo $selects['cate_name'] ?></option>
                     <?php endforeach; ?>
                </select>
                <input type="submit" name="filter_action" id="filter_action" class="button" value="Filter"> 
            <?php
         }
        ?>
        <!-- <input type="submit" name="filter_action" id="filter_action" class="button" value="Filter">  -->
        <?php
        
    }

    /**
     * =======================================================================
     * CÁC FUNCTION THIẾT LẬP GIÁ TRỊ CHO CÁC COLUMN
     * =======================================================================
     */
    //tạo các check box ở đầu dòng trống của cột
    public function column_cb($item)
    {
        $html = '<input type="checkbox" name="' . 'ID' . '[]" value="' . $item['ID'] . '"/>';
        return $html;
    }

    //thêm các phần chỉnh sửa nhanh tại column này
    //đặt tên column_name column cần tạo các chỉnh sửa nhanh
    public function column_company_name($item)
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
        $html = '<strong> <a href="?page=' . $page . '&action=edit&id=' . $item['ID'] . ' ">' . $item['company_name'] . '</a> </strong>' . $this->row_actions($actions);
        return $html;
    }

    public function column_img($item)
    {
        if(!empty($item['img'])) {
            echo '<img style="width:100px" src=" ' . PART_IMAGES_MEMBER . $item["img"] . ' " />' ;
        }
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

}