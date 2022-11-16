<?php

// KIEM TRA  WP_List_Table CO TON TAI CHUA NEU CHUA SE INCLUSE VAO
if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
    //echo ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Admin_Model_Download extends WP_List_Table
{

    private $_pre_page = 30;
    private $_sql;
    private $_table = 'download';

    public function __construct($args = array())
    {
        $args = array(
            'plural' => 'id', // GIA TRI NAY TUONG UNG VOI key TRONG table
            'singular' => 'id', // GIA TRI NAY TUONG UNG VOI key TRONG table
            'ajax' => FALSE,
            'screen' => null,
        );
        parent::__construct($args);
    }

    // HAM NAY BAT BUOT PHAI CO QUAN TRONG DE SHOW LIST RA
    //  CAC THONG SO VA DU LIEU CAN  CUNG CAP DE HIEN THI GIRDVIEW
    public function prepare_items()
    {
        $columns = $this->get_columns();  // NHUNG GI CAN HIEN THI TREN BANG 
        $hidden = $this->get_hidden_columns(); // NHUNG COT TA SE AN DI
        $sorttable = $this->get_sortable_columns(); // CAC COT DC SAP XEP TANG HOAC GIAM DAN

        $this->_column_headers = array($columns, $hidden, $sorttable); //DUA 3 GIA TRI TREN VAO DAY DE SHOW DU LIEU
        $this->items = $this->table_data(); // LAY DU LIEU TU DATABASE

        $total_items = $this->total_items(); // TONG SO DONG DA LIEU
        $per_page = $this->_pre_page; // SO TRANG 
        $total_pages = ceil($total_items / $per_page); // TONG SO TRANG
        // PHAN TRANG
        $args = array(
            'total_items' => $total_items,
            'per_page' => $per_page,
            'total_pages' => $total_pages
        );
        $this->set_pagination_args($args);
    }

    //---------------------------------------------------------------------------------------------
    // Cmt NHOM NHAT DINH  PHAI CO CHO LIST NAY
    //---------------------------------------------------------------------------------------------
    // LAY CAC COT TUONG UNG TRONG DATABASE DAN VAO CAC COT TREN LUOI
    public function get_columns()
    {
        $arr = array(
            'cb' => '<input type="checkbox" />',
            'title' => __('Title'),
            'img' => __('Image'),
            'kind' => __('Category'),
            'file' => __('File Name'),
        );
        return $arr;
    }

    // KHIA BAO CAC COT BI AN DI TREN GRIDVIEW
    public function get_hidden_columns()
    {
        return array();
    }

    // COLUMN SAP XEP THU TANG HOAC GIAM DAN
    public function get_sortable_columns()
    {
        return array(
            'kind' => array('kind', true),
            'id' => array('id', true),
        );
    }

    //---------------------------------------------------------------------------------------------
    // Cmt NHOM GET DATA TU DATABASE
    //---------------------------------------------------------------------------------------------
    // GET DATA TRONG DATABASE 
    private function table_data()
    {
        $data = array();
        global $wpdb;
        // LAY GIA TRI SAP XEP DU LIEU TREN COT
        $orderby = (getParams('orderby') == ' ') ? 'ID' : $_GET['orderby'];
        $order = (getParams('order') == ' ') ? 'DESC' : $_GET['order'];
        $tblTest = $wpdb->prefix . $this->_table;
        $sql = 'SELECT m.* FROM ' . $tblTest . ' AS m ';
        $whereArr = array();  // TAO MANG WHERE



        if (getParams('customvar') == 'trash') {
            $whereArr[] = "(trash = 1)";
        } else {
            $whereArr[] = "(trash = 0)";
        }

        if (getParams('s') != ' ') {
            $s = esc_sql(getParams('s'));
            $whereArr[] = "(m.title  LIKE '%$s%')";
        }

        // CHUYEN CAC GIA TRI where KET VOI NHAU BOI and
        if (count($whereArr) > 0) {
            $sql .= " WHERE " . join(" AND ", $whereArr);
        }

        // orderby
        $sql .= 'ORDER BY m.' . esc_sql($orderby) . ' ' . esc_sql($order);

        $this->_sql = $sql;


        //LAY GIA TRI PHAN TRANG PAGEING
        $paged = max(1, @$_REQUEST['paged']);
        $offset = ($paged - 1) * $this->_pre_page;

        $sql .= ' LIMIT  ' . $this->_pre_page . ' OFFSET ' . $offset;

        // LAY KET QUA  THONG QUA CAU sql
        $data = $wpdb->get_results($sql, ARRAY_A);

        return $data;
    }

    // TINH TONG SO DONG DU LIEU  DE AP DUNG CHO VIEC PHAN TRANG
    public function total_items()
    {
        global $wpdb;
        return $wpdb->query($this->_sql);
    }

    // SO TONG ITEM DUNG DE PHAN TRANG
    public function total_list()
    {
        global $wpdb;
        $tblOrdert = $wpdb->prefix . $this->_table;
        return $wpdb->get_var("SELECT COUNT(*) FROM $tblOrdert");
    }

    // SO TONG ITEM TRONG TRASH(SO RAC)
    public function total_trash()
    {
        global $wpdb;
        $tblOrdert = $wpdb->prefix . $this->_table;
        return $wpdb->get_var("SELECT COUNT(*) FROM $tblOrdert WHERE trash = 1");
    }

    // SO TONG ITEM HIEN HANH
    public function total_publish()
    {
        global $wpdb;
        $tblOrdert = $wpdb->prefix . $this->_table;
        return $wpdb->get_var("SELECT COUNT(*) FROM $tblOrdert WHERE trash = 0");
    }

    // PHAN SHOW THONG KE SO ITEM O DAU LIST (tong so item, so item hien hanh, so item trong trash)
    function get_views()
    {
        $views = array();
        $current = (!empty($_REQUEST['customvar']) ? $_REQUEST['customvar'] : 'all');

        //All link
        $class = ($current == 'all' ? ' class="current"' : '');
        $all_url = remove_query_arg('customvar');
        $views['all'] = "<strong>" . __('All') . " (" . $this->total_list() . ")</strong>";

        //Foo link
        $foo_url = add_query_arg('customvar', 'published');
        $class = ($current == 'foo' ? ' class="current"' : '');
        $views['foo'] = "<a href='{$foo_url}' {$class} > " . __('Published') . " (" . $this->total_publish() . ")</a>";

        //Bar link
        $bar_url = add_query_arg('customvar', 'trash');
        $class = ($current == 'bar' ? ' class="current"' : '');
        $views['bar'] = "<a href='{$bar_url}' {$class} >" . __('Trash') . "(" . $this->total_trash() . ")</a>";

        return $views;
    }

    //---------------------------------------------------------------------------------------------
    // Cmt NHOM CAC SELECT BOX O DAU CUA LIST
    //---------------------------------------------------------------------------------------------
    // CAC ITEM TRONG SELECT BOX CHUC NANG 'UNG DUNG'
    public function get_bulk_actions()
    {
        if (!empty($_GET['customvar']) && $_GET['customvar'] == 'trash') {
            $actions = array(
                'restore' => __('Restore'),
                'delete' => __('Delete Permanently'),
            );
        } else {
            $actions = array(
                'trash' => __('Trash'),
            );
        }
        return $actions;
    }

    // CAC ITEM TRONG SECLETBOX TRONG PHAN FILTER
    //---------------------------------------------------------------------------------------------
    // Cmt NHOM THIET LAP GIA TRI CHO CAC CLOUMN
    //---------------------------------------------------------------------------------------------
    // TAO CAC CHECK BOS O DAU DONG TRONG 
    public function column_cb($item)
    {
        $singular = $this->_args['singular'];
        $html = '<input type="checkbox" name="' . $singular . '[]" value="' . $item['ID'] . '"/>';
        return $html;
    }

    // THEM CAC PHAN CHINH SUA NHANH TAI COLUMN NAY
    //DAT TEN column_TEN COLUMN CAN TAO CAC CHINH SUA NHANH
    public function column_title($item)
    {
        $page = getParams('page');
        $name = 'security_code';

        //        $linkDelete = add_query_arg(array('action' => 'delete', 'id' => $item['ID']));
        //        $action = 'delete_id' . $item['id'];
        //        $linkDelete = wp_nonce_url($linkDelete, $action, $name);


        if (!empty($_GET['customvar']) && $_GET['customvar'] == 'trash') {
            $actions = array(
                'restore' => '<a href=" ?page=' . $page . '&action=restore&id=' . $item['ID'] . ' " >' . __('Restore') . '</a>',
                'delete' => '<a href=" ?page=' . $page . '&action=delete&id=' . $item['ID'] . ' " >' . __('Delete Permanently') . '</a>',
                // 'view' => '<a href ="#">View</a>'
            );
        } else {
            $actions = array(
                'edit' => '<a href=" ?page=' . $page . '&action=edit&id=' . $item['ID'] . ' " > ' . __('Edit') . ' </a>',
                'trash' => '<a href=" ?page=' . $page . '&action=trash&id=' . $item['ID'] . ' " > ' . __('Trash') . ' </a>',
                // 'view' => '<a href ="#">View</a>'
            );
        }
        $html = '<strong> <a href="?page=' . $page . '&action=edit&id=' . $item['ID'] . ' ">' . $item['title'] . '</a> </strong>' . $this->row_actions($actions);
        return $html;
    }

    public function column_img($item)
    {

        // TAO SECURITY CODE
        $src = PART_IMAGES_DOWNLOAD  . $item['img'];

        $html = '<img alt="" src=" ' . $src . ' "  style=" width:100px" />';

        return $html;
    }

    public function column_kind($item)
    {

        // TAO SECURITY CODE
        require_once DIR_CODES . 'my-list.php';
        $myList = new Codes_My_List();
        echo $myList->Get_download($item['kind']);
    }

    //CAC COLUMN MAC DINH KHI LOAD TRANG SE SHOW LEN 
    public function column_default($item, $column_name)
    {
        return $item[$column_name];
    }

    //---------------------------------------------------------------------------------------------
    // Cmt  CAC CHUC ADD EDIT DELETE 
    //---------------------------------------------------------------------------------------------
    //
    //    // LAY DU LIEU CAN CHINH SUA
    public function get_item($ID, $option = array())
    {
        global $wpdb;
        $table = $wpdb->prefix . $this->_table;
        $sql = "SELECT * FROM $table WHERE ID = $ID";
        $row = $wpdb->get_row($sql, ARRAY_A);  // LAY DONG DU LIEU TRA VE KIEU array
        return $row;
    }

    //  INSERT OR UPDATE DATABASE
    public function save_item($arrData = array(), $fileName, $fileImg, $option = array())
    {
        global $wpdb;
        // kIEM ADD NEW OR UPDATE
        $table = $wpdb->prefix . $this->_table;
        $data = array(
            'title' => $arrData['txt_title'],
            'file' => $fileName,
            'img' => $fileImg,
            'kind' => $arrData['sel_kind'],
        );

        if ($option == 'add') {
            $data['create_date'] = date('Y-m-d');
            $wpdb->insert($table, $data);
        } else if ($option == 'edit') {
            $where = array('ID' => absint($arrData['hid_ID']));  // CHUYEN THEM DK DE UPDATE 
            $wpdb->update($table, $data, $where);
        }
    }

    // TO TRASH OR RESTOR DATA
    public function toTrash($arrData = array(), $options = array())
    {
        global $wpdb;
        $table = $wpdb->prefix . $this->_table;
        $trash = $options == 'trash' ? '1' : '0';
        //        $status = ($arrData['action'] == 'active') ? 1 : 0;
        // KIEM TRA PHAN UPFDATE CÓ PHAN DANG CHUOI HAY KHONG
        if (!is_array($arrData['id'])) {
            $data = array('trash' => $trash);
            $where = array('ID' => absint($arrData['id']));
            $wpdb->update($table, $data, $where);
        } else {

            $arrData['id'] = array_map('absint', $arrData['id']);
            $ids = join(',', $arrData['id']);
            $sql = "UPDATE $table SET trash = $trash WHERE id IN ($ids)";
            $wpdb->query($sql);
        }
    }

    // DELETE DATA
    public function deleteItem($arrData = array(), $options = array())
    {
        global $wpdb;

        $table = $wpdb->prefix . $this->_table;
        // KIEM TRA PHAN DELETE CÓ PHAN DANG CHUOI HAY KHONG
        if (!is_array($arrData['id'])) {
            $where = array('ID' => absint($arrData['id']));
            $wpdb->delete($table, $where);
        } else {
            $arrData['id'] = array_map('absint', $arrData['id']);
            $ids = join(',', $arrData['id']);
            $sql = "DELETE FROM $table  WHERE ID IN ($ids)";
            $wpdb->query($sql);
        }
    }
}
