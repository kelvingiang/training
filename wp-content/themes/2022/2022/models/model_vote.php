<?php

/* KIEM TRA  WP_List_Table CO TON TAI CHUA NEU CHUA SE INCLUSE VA */
if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php ';
}

class Admin_Model_Vote extends WP_List_Table
{

    private $_pre_page = 30;
    private $_sql;
    private $table = "vote";

    public function __construct($args = array())
    {
        $args = array(
            'plural' => 'ID', /* GIA TRI NAY TUONG UNG VOI key TRONG table */
            'singular' => 'ID', /* GIA TRI NAY TUONG UNG VOI key TRONG table */
            'ajax' => FALSE,
            'screen' => null,
        );
        parent::__construct($args);
    }

    /* HAM NAY BAT BUOT PHAI CO QUAN TRONG DE SHOW LIST RA
      CAC THONG SO VA DU LIEU CAN  CUNG CAP DE HIEN THI GIRDVIEW */

    public function prepare_items()
    {
        $columns = $this->get_columns();  /* NHUNG GI CAN HIEN THI TREN BANG */
        $hidden = $this->get_hidden_columns(); /* NHUNG COT TA SE AN DI */
        $sorttable = $this->get_sortable_columns(); /* CAC COT DC SAP XEP TANG HOAC GIAM DAN */

        $this->_column_headers = array($columns, $hidden, $sorttable); /* DUA 3 GIA TRI TREN VAO DAY DE SHOW DU LIEU */
        $this->items = $this->table_data(); /* LAY DU LIEU TU DATABASE */

        $total_items = $this->total_items(); /* TONG SO DONG DA LIEU */
        $per_page = $this->_pre_page; /* SO TRANG  */
        $total_pages = ceil($total_items / $per_page); /* TONG SO TRANG */
        /* PHAN TRANG */
        $args = array(
            'total_items' => $total_items,
            'per_page' => $per_page,
            'total_pages' => $total_pages
        );
        $this->set_pagination_args($args);
    }

    /*    ---------------------------------------------------------------------------------------------
      Cmt NHOM NHAT DINH  PHAI CO CHO LIST NAY
      ---------------------------------------------------------------------------------------------
      LAY CAC COT TUONG UNG TRONG DATABASE DAN VAO CAC COT TREN LUOI */

    public function get_columns()
    {
        $arr = array(
            'cb' => '<input type="checkbox" />',
            'name' => '姓名',
            'img' => '照片',
            'company' => '公司',
            'kid' => '類別',
            'position' => '當選',
            'agree' => '同意',
            'not_agree' => '不同意',
            'illegal' => '廢票',
            'total' => '總票',
        );
        return $arr;
    }

    /* KHIA BAO CAC COT BI AN DI TREN GRIDVIEW */

    public function get_hidden_columns()
    {
        return array('country', 'email');
    }

    /* COLUMN SAP XEP THU TANG HOAC GIAM DAN */

    public function get_sortable_columns()
    {
        return array(
            'kind' => array('kind', true),
            'total' => array('total', true),
        );
    }

    /* --------------------------------------------------------------------------------------------
      // Cmt NHOM GET DATA TU DATABASE
      //---------------------------------------------------------------------------------------------
      // GET DATA TRONG DATABASE */

    private function table_data()
    {
        $data = array();
        global $wpdb;
        /* LAY GIA TRI SAP XEP DU LIEU TREN COT */
        $orderby = (getParams('orderby') == ' ') ? 'ID' : $_GET['orderby'];
        $order = (getParams('order') == ' ') ? 'ASC' : $_GET['order'];
        $tblTest = $wpdb->prefix . $this->table;
        $sql = 'SELECT m.* FROM ' . $tblTest . ' AS m ';
        $whereArr = array();  /* TAO MANG WHERE */

        if (getParams('customvar') == 'trash') {
            $whereArr[] = "(status = 0)";
        } else {
            $whereArr[] = "(status = 1)";
        }

        if (getParams('s') != ' ') {
            $s = esc_sql(getParams('s'));
            $whereArr[] = "(m.name  LIKE '%$s%')";
        }

        /* CHUYEN CAC GIA TRI where KET VOI NHAU BOI and */
        if (count($whereArr) > 0) {
            $sql .= " WHERE " . join(" AND ", $whereArr);
        }

        /* orderby */
        $sql .= 'ORDER BY m.' . esc_sql($orderby) . ' ' . esc_sql($order);

        $this->_sql = $sql;


        /* LAY GIA TRI PHAN TRANG PAGEING */
        $paged = max(1, @$_REQUEST['paged']);
        $offset = ($paged - 1) * $this->_pre_page;

        $sql .= ' LIMIT  ' . $this->_pre_page . ' OFFSET ' . $offset;

        /* LAY KET QUA  THONG QUA CAU sql */
        $data = $wpdb->get_results($sql, ARRAY_A);

        return $data;
    }

    /* TINH TONG SO DONG DU LIEU  DE AP DUNG CHO VIEC PHAN TRANG */

    public function total_items()
    {
        global $wpdb;
        return $wpdb->query($this->_sql);
    }

    /* SO TONG ITEM DUNG DE PHAN TRANG */

    public function total_list()
    {
        global $wpdb;
        $tblOrdert = $wpdb->prefix . $this->table;
        return $wpdb->get_var("SELECT COUNT(*) FROM $tblOrdert");
    }

    /* SO TONG ITEM TRONG TRASH(SO RAC) */

    public function total_trash()
    {
        global $wpdb;
        $tblOrdert = $wpdb->prefix . $this->table;
        return $wpdb->get_var("SELECT COUNT(*) FROM $tblOrdert WHERE status = 0");
    }

    /*  SO TONG ITEM HIEN HANH */

    public function total_publish()
    {
        global $wpdb;
        $tblOrdert = $wpdb->prefix . $this->table;
        return $wpdb->get_var("SELECT COUNT(*) FROM $tblOrdert WHERE status = 1");
    }

    /* ---------------------------------------------------------------------------------------------
      // Cmt NHOM CAC SELECT BOX O DAU CUA LIST
      //---------------------------------------------------------------------------------------------
      //
      // PHAN SHOW THONG KE SO ITEM O DAU LIST (tong so item, so item hien hanh, so item trong trash) */

    function get_views()
    {
        $views = array();
        $current = (!empty($_REQUEST['customvar']) ? $_REQUEST['customvar'] : 'all');

        /* All link */
        $class = ($current == 'all' ? ' class="current"' : '');
        $all_url = remove_query_arg('customvar');
        $views['all'] = "<strong>" . __('All') . " (" . $this->total_list() . ")</strong>";

        /* Foo link */
        $foo_url = add_query_arg('customvar', 'published');
        $class = ($current == 'foo' ? ' class="current"' : '');
        $views['foo'] = "<a href='{$foo_url}' {$class} > " . __('Published') . " (" . $this->total_publish() . ")</a>";

        /* Bar link */
        $bar_url = add_query_arg('customvar', 'trash');
        $class = ($current == 'bar' ? ' class="current"' : '');
        $views['bar'] = "<a href='{$bar_url}' {$class} >" . __('Trash') . "(" . $this->total_trash() . ")</a>";

        return $views;
    }

    /* CAC ITEM TRONG SELECT BOX CHUC NANG 'UNG DUNG' */

    public function get_bulk_actions()
    {
        if ($_GET['customvar'] == 'trash') {
            $actions = array(
                'restore' => '還原',
                'delete' => '永久刪除'
            );
        } else {
            $actions = array(
                'trash' => '回收桶',
                'uncheckin' => '取消報到'
            );
        }
        return $actions;
    }

    /* CAC ITEM TRONG SECLETBOX TRONG PHAN FILTER */

    public function extra_tablenav($which)
    {
        /*
          if ($which == 'top') {
          $htmlObj = new MyHtml();

          $filterVal = @$_REQUEST['filter_status'];
          $options['data'] = array(
          '0' => 'status filter',
          'active' => 'Active',
          'inactive' => 'Inactive'
          );

          $slbFilter = $htmlObj->selectbox('filter_status', $filterVal, array(), $options);
          $attr = array('id' => 'filter_action', 'class' => 'button');
          $btnFilter = $htmlObj->button('filter_action', 'Filter', $attr);

          echo '<div class="alignleft action bulkactions">' . $slbFilter . $btnFilter . '</div>';
          }
         * 
         */
    }

    /*
      //---------------------------------------------------------------------------------------------
      // Cmt NHOM THIET LAP GIA TRI CHO CAC CLOUMN
      //---------------------------------------------------------------------------------------------
      // TAO CAC CHECK BOS O DAU DONG TRONG
     * 
     */

    public function column_cb($item)
    {
        $singular = $this->_args['singular'];
        $html = '<input type="checkbox" name="' . $singular . '[]" value="' . $item['ID'] . '"/>';
        return $html;
    }

    /* THEM CAC PHAN CHINH SUA NHANH TAI COLUMN NAY */
    /* DAT TEN column_TEN COLUMN CAN TAO CAC CHINH SUA NHANH */

    public function column_name($item)
    {
        $page = getParams('page');
        $name = 'security_code';
        /*
          //        $linkDelete = add_query_arg(array('action' => 'delete', 'id' => $item['id']));
          //        $action = 'delete_id' . $item['id'];
          //        $linkDelete = wp_nonce_url($linkDelete, $action, $name);
         */

        if ($_GET['customvar'] == 'trash') {
            $actions = array(
                'restore' => '<a href=" ?page=' . $page . '&action=restore&id=' . $item['ID'] . ' " >還原 </a>',
                'delete' => '<a href=" ?page=' . $page . '&action=delete&id=' . $item['ID'] . ' " >永久刪除 </a>',
                // 'view' => '<a href ="#">View</a>'
            );
        } else {
            $actions = array(
                'edit' => '<a href=" ?page=' . $page . '&action=edit&id=' . $item['ID'] . ' " > 編輯 </a>',
                'trash' => '<a href=" ?page=' . $page . '&action=trash&id=' . $item['ID'] . ' " > 回收桶 </a>',
                // 'view' => '<a href ="#">View</a>'
            );
        }
        $html = '<strong> <a href="?page=' . $page . '&action=edit&id=' . $item['ID'] . ' ">' . $item['name'] . '</a> </strong>' . $this->row_actions($actions);
        return $html;
    }

    public function column_img($item)
    {
        if (!empty($item['img'])) {
            echo '<img style="width:50px" src=" ' . PART_IMAGES_VOTE . $item["img"] . ' " />';
        }
    }

    public function column_kid($item)
    {
        echo "<lable style=' letter-spacing: 5px;;'>" . kid_name($item['kind']) . "</lable>";
    }

    public function column_position($item)
    {
        if ($item['position'] !== '0') {
            echo "<div class ='check-icon'></div>";
        }
    }

    public function column_vote_total($item)
    {
        echo '<lable>' . $item["total"] . '</lable>';
    }

    /* CAC COLUMN MAC DINH KHI LOAD TRANG SE SHOW LEN  */

    public function column_default($item, $column_name)
    {
        return $item[$column_name];
    }

    /* CAC FUNCTION XU LY DATA   */

    public function trashItem($arrData = array(), $option = array())
    {
        global $wpdb;

        $table = $wpdb->prefix . $this->table;
        /* KIEM TRA PHAN  CÓ PHAN DANG CHUOI HAY KHONG */
        if (!is_array($arrData['id'])) {
            $data = array('status' => 0);
            $where = array('id' => absint($arrData['id']));
            $wpdb->update($table, $data, $where);
        } else {
            $arrData['id'] = array_map('absint', $arrData['id']);
            $ids = join(',', $arrData['id']);
            $sql = "UPDATE $table SET `status` =  '0'   WHERE ID IN ($ids)";
            $wpdb->query($sql);
        }
    }

    public function restoreItem($arrData = array(), $option = array())
    {
        global $wpdb;

        $table = $wpdb->prefix . $this->table;
        /* KIEM TRA PHAN DELETE CÓ PHAN DANG CHUOI HAY KHONG  */
        if (!is_array($arrData['id'])) {
            $data = array('status' => 1);
            $where = array('id' => absint($arrData['id']));
            $wpdb->update($table, $data, $where);
        } else {
            $arrData['id'] = array_map('absint', $arrData['id']);
            $ids = join(',', $arrData['id']);
            $sql = "UPDATE $table SET `status` =  '1'   WHERE ID IN ($ids)";
            $wpdb->query($sql);
        }
    }

    public function deleteItem($arrData = array(), $option = array())
    {
        global $wpdb;
        $table = $wpdb->prefix . $this->table;
        if (!is_array($arrData['id'])) {
            $this->del_img(absint($arrData['id']));
            // XOA TRONG CSDL
            $where = array('ID' => absint($arrData['id']));
            $wpdb->delete($table, $where);
        } else {
            $arrData['id'] = array_map('absint', $arrData['id']);
            foreach ($arrData['id'] as $item) {
                $this->del_img($item);
            }
            $ids = join(',', $arrData['id']);
            $sql = "DELETE FROM $table  WHERE ID IN ($ids)";
            $wpdb->query($sql);
        }
    }

    private function del_img($id)
    {
        global $wpdb;
        $table = $wpdb->prefix . $this->table;
        $sql = "SELECT `img` FROM $table WHERE ID =" . $id;
        $row = $wpdb->get_row($sql, ARRAY_A);
        /*  XOA HINH DAI DIEN */
        if (is_file(DIR_IMAGES_VOTE . $row['img'])) {
            unlink(DIR_IMAGES_VOTE . $row['img']);
        }
    }

    public function saveItem($arrData = array(), $imgFile, $option = array())
    {
        global $wpdb;
        $table = $wpdb->prefix . $this->table;

        $data = array(
            'name' => trim($arrData['txt_name']),
            'company' => trim($arrData['txt_company']),
            'img' => $imgFile,
            'kind' => $arrData['sel_kid'],
            'position' => $arrData['sel_position'],
            'agree' => $arrData['txt_agree'],
            'not_agree' => $arrData['txt_not_agree'],
            'illegal' => $arrData['txt_illegal'],
            'total' => $arrData['txt_total'],
        );

        if ($option['action'] == 'add') {
            $data['create_date'] = date('Y-m-d');
        }

        if ($option['action'] == 'edit') {
            $where = array('ID' => absint($arrData['hid_id']));
            $wpdb->update($table, $data, $where);
        } elseif ($option['action'] == 'add') {
            $wpdb->insert($table, $data);
        }
    }

    public function getItem($id, $option = array())
    {
        global $wpdb;
        $table = $wpdb->prefix . $this->table;
        $sql = "SELECT * FROM $table WHERE ID = $id";
        $row = $wpdb->get_row($sql, ARRAY_A);
        return $row;
    }

    public function resetVoteToZero()
    {
        global $wpdb;
        $table = $wpdb->prefix . $this->table;
        $sql = "UPDATE $table SET `total` =  '0'   WHERE 1 =1 ";
        $wpdb->query($sql);
    }


    public function VoteExportToExcel($kid)
    {
        echo $kid;
    }
}