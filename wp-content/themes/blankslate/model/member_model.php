<?php

// KIEM TRA  WP_List_Table CO TON TAI CHUA NEU CHUA SE INCLUSE VAO
if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php ';
}

class Member_Model extends WP_List_Table
{

    private $_pre_page = 30;
    private $_sql;
    private $_stt = 1;

    public function __construct($args = array())
    {
        $args = array(
            'plural' => 'ID', // GIA TRI NAY TUONG UNG VOI key TRONG table
            'singular' => 'ID', // GIA TRI NAY TUONG UNG VOI key TRONG table
            'ajax' => FALSE,
            'screen' => null,
        );
        parent::__construct($args);
    }

    //===== HAM NAY BAT BUOT PHAI CO QUAN TRONG DE SHOW LIST RA
    //===== CAC THONG SO VA DU LIEU CAN  CUNG CAP DE HIEN THI GIRDVIEW
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
            'serial' => __('Serial'),
            'company' => __('Company Name'),
            'address' => __('Address'),
            'contact' => __('Full Name'),
            //  'position' => __('Regency'),
            'mobile' => __('Mobile'),
            'email' => __('Email'),
            'order' => __('order'),
            // 'service' => __('Service'),
        );
        return $arr;
    }

    // ====KHIA BAO CAC COT BI AN DI TREN GRIDVIEW
    public function get_hidden_columns()
    {
        return array('');
    }

    //==== COLUMN SAP XEP THU TANG HOAC GIAM DAN
    public function get_sortable_columns()
    {
        return array(
            'serial' => array('serial', true),
            'order' => array('order', true),
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
        $orderby = (getParams('orderby') == ' ') ? 'id' : $_GET['orderby'];
        $order = (getParams('order') == ' ') ? 'DESC' : $_GET['order'];
        $tblTest = $wpdb->prefix . 'member';
        $sql = 'SELECT m.* FROM ' . $tblTest . ' AS m  ';
        $whereArr = array();  // TAO MANG WHERE

        if (getParams('customvar') == 'trash') {
            $whereArr[] = "(trash = 0)";
        } else {
            $whereArr[] = "(trash = 1)";
        }


        if (getParams('filter_branch') != ' ') {
            $branch = getParams('filter_branch');
            if ($branch > 0) {
                $whereArr[] = "(m.industry_id LIKE '%,$branch,%')";
            } elseif ($branch == -1) {
                $whereArr[] = "(m.industry_id = ' ')";
            } else {
                $whereArr[] = '';
            }
        }

        if (getParams('s') != ' ') {
            $s = esc_sql(getParams('s'));
            $whereArr[] = "(m.serial  LIKE '$s' OR m.company_cn LIKE '%$s%')";
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
        $tblOrdert = $wpdb->prefix . 'member';
        return $wpdb->get_var("SELECT COUNT(*) FROM $tblOrdert");
    }

    // SO TONG ITEM TRONG TRASH(SO RAC)
    public function total_trash()
    {
        global $wpdb;
        $tblOrdert = $wpdb->prefix . 'member';
        return $wpdb->get_var("SELECT COUNT(*) FROM $tblOrdert WHERE trash = 0");
    }

    // SO TONG ITEM HIEN HANH
    public function total_publish()
    {
        global $wpdb;
        $tblOrdert = $wpdb->prefix . 'member';
        return $wpdb->get_var("SELECT COUNT(*) FROM $tblOrdert WHERE trash = 1");
    }

    //---------------------------------------------------------------------------------------------
    // Cmt NHOM CAC SELECT BOX O DAU CUA LIST
    //---------------------------------------------------------------------------------------------
    //
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

    // CAC ITEM TRONG SELECT BOX CHUC NANG 'UNG DUNG'
    public function get_bulk_actions()
    {
        if ($_GET['customvar'] == 'trash') {
            $actions = array(
                'restore' => __('Restore'),
                'delete' => __('Delete Permanently')
            );
        } else {
            $actions = array(
                'trash' => __('Trash'),
                // 'uncheckin' => '取消報到'
            );
        }
        return $actions;
    }

    // CAC ITEM TRONG SECLETBOX TRONG PHAN FILTER
    public function extra_tablenav($which)
    {
        if ($which == 'top') {
            $htmlObj = new MyHtml();
            $filterVal = @$_REQUEST['filter_branch'];
            $first_row = array(array('ID' => '', 'name' => __('Select Industry')));
            $last_row = array(array('ID' => -1, 'name' => __('Other')));
            $list1 = array_merge($first_row, getMemberIndustry());
            $list = array_merge($list1, $last_row);
            foreach ($list as $val) {
                $arrlist[$val['ID']] = $val['name'];
            }
            $options['data'] = $arrlist;

            //===== THEM PHAN SELECT BOX TIM KIEM  =================================================
            $slbFilter = $htmlObj->selectbox('filter_branch', $filterVal, array(), $options);
            $attr = array('id' => 'filter_action', 'class' => 'button');
            $btnFilter = $htmlObj->button('filter_action', __('Filter'), $attr);
            echo '<div class="alignleft action bulkactions">' . $slbFilter . $btnFilter . '</div>';
        }
    }

    //---------------------------------------------------------------------------------------------
    // Cmt NHOM THIET LAP GIA TRI CHO CAC CLOUMN
    //---------------------------------------------------------------------------------------------
    //
    // TAO CAC CHECK BOS O DAU DONG TRONG 
    public function column_cb($item)
    {
        $singular = $this->_args['singular'];
        $html = '<input type="checkbox" name="' . $singular . '[]" value="' . $item['ID'] . '-' . $item['barcode'] . '"/>';
        return $html;
    }

    // THEM CAC PHAN CHINH SUA NHANH TAI COLUMN NAY
    //DAT TEN column_TEN COLUMN CAN TAO CAC CHINH SUA NHANH
    public function column_serial($item)
    {
        $page = getParams('page');
        $name = 'security_code';

        if ($_GET['customvar'] == 'trash') {
            $actions = array(
                'restore' => '<a href=" ?page=' . $page . '&action=restore&id=' . $item['ID'] . ' " >' . __('Restore') . '</a>',
                'delete' => '<a href=" ?page=' . $page . '&action=delete&id=' . $item['ID'] . ' " >' . __('Delete Permanently') . ' </a>',
            );
        } else {
            $actions = array(
                'edit' => '<a href=" ?page=' . $page . '&action=edit&id=' . $item['ID'] . ' " >' . __('Edit') . '</a>',
                'trash' => '<a href=" ?page=' . $page . '&action=trash&id=' . $item['ID'] . ' " >' . __('Trash') . '</a>',
            );
        }
        $html = '<strong> <a href="?page=' . $page . '&action=edit&id=' . $item['ID'] . ' ">' . $item['serial'] . '</a> </strong>' . $this->row_actions($actions);
        return $html;
    }

    public function column_company($item)
    {
        return $item['company_cn'];
    }

    public function column_address($item)
    {
        echo '<lable>' . $item['address_cn'] . '</lable>';
    }

    //CAC COLUMN MAC DINH KHI LOAD TRANG SE SHOW LEN 
    public function column_default($item, $column_name)
    {
        return $item[$column_name];
    }

    //=========================================================================
    // ============= CAC FUNCTION XU LY DATA ===================================  
    //=========================================================================

    public function get_item($arrData = array(), $option = array())
    {
        global $wpdb;
        $id = absint($arrData['id']);
        $table = $wpdb->prefix . 'member';
        $sql = "SELECT * FROM $table WHERE ID = $id";
        $row = $wpdb->get_row($sql, ARRAY_A);
        return $row;
    }

    public function trashItem($arrData = array(), $option = array())
    {
        global $wpdb;

        $table = $wpdb->prefix . 'member';
        // KIEM TRA PHAN  CÓ PHAN DANG CHUOI HAY KHONG
        if (!is_array($arrData['id'])) {
            $data = array('trash' => 0);
            $where = array('ID' => absint($arrData['id']));
            $wpdb->update($table, $data, $where);
        } else {
            // $arrData['id] chuyen qua ID-barcode  vidu : 1111-22222222
            // do su dung array_map('absint) no chi lay so cho nen khi lay de dau '-' khong tiep tuc lay
            // vay la no chi lay phan dau la ID dung voi gi muon
            // khong can tach chuoi
            $arrData['id'] = array_map('absint', $arrData['id']);
            $ids = join(',', $arrData['id']);
            $sql = "UPDATE $table SET `trash` =  '0'   WHERE ID IN ($ids)";
            $wpdb->query($sql);
        }
    }

    public function restoreItem($arrData = array(), $option = array())
    {
        global $wpdb;

        $table = $wpdb->prefix . 'member';
        // KIEM TRA PHAN DELETE CÓ PHAN DANG CHUOI HAY KHONG
        if (!is_array($arrData['id'])) {
            $data = array('trash' => 1);
            $where = array('ID' => absint($arrData['id']));
            $wpdb->update($table, $data, $where);
        } else {
            // $arrData['id] chuyen qua ID-barcode  vidu : 1111-22222222
            // do su dung array_map('absint) no chi lay so cho nen khi lay de dau '-' khong tiep tuc lay
            // vay la no chi lay phan dau la ID dung voi gi muon
            // khong can tach chuoi
            $arrData['id'] = array_map('absint', $arrData['id']);
            $ids = join(',', $arrData['id']);
            $sql = "UPDATE $table SET `trash` =  '1'   WHERE ID IN ($ids)";
            $wpdb->query($sql);
        }
    }

    //---------------------------------------------------------------------------------------------
    // chuyen ID co 2 phan id-barcode, khi nhan value se tach 2 phan id va barcode de su dung 
    // phan chinh sua data trong table guests_check_in phai sua dung barcode ko the dung guests_id 
    // vi guests_id duoc luu vao tu 2 table member va guests cho nen co kha nang trung ID 
    // vi vay dung barcode lam chuan khi thao tac voi table guests_check_in
    //---------------------------------------------------------------------------------------------

    public function deleteItem($arrData = array(), $option = array())
    {
        global $wpdb;
        $table = $wpdb->prefix . 'member';
        if (!is_array($arrData['id'])) {
            $where = array('ID' => absint($arrData['id']));
            $wpdb->delete($table, $where);
        } else {
            // $arrData['id] chuyen qua ID-barcode  vidu : 1111-22222222
            // do su dung array_map('absint) no chi lay so cho nen khi lay de dau '-' khong tiep tuc lay
            // vay la no chi lay phan dau la ID dung voi gi muon
            // khong can tach chuoi
            $arrData['id'] = array_map('absint', $arrData['id']);
            $ids = join(',', $arrData['id']);
            $sql = "DELETE FROM $table WHERE ID IN ($ids)";
            $wpdb->query($sql);
        }
    }

    public function saveItem($arrData = array(), $option = array())
    {
        global $wpdb;
        $table = $wpdb->prefix . 'member';
        $indus = implode(",", $arrData['industry_id']);



        $data = array(
            'company_vn' => $arrData['txt-company-vn'],
            'company_cn' => $arrData['txt-company-cn'],
            'address_vn' => $arrData['txt-address-vn'],
            'address_cn' => $arrData['txt-address-cn'],
            'contact' => $arrData['txt-contact'],
            'position' => $arrData['txt-position'],
            'mobile' => $arrData['txt-mobile'],
            'phone' => $arrData['txt-phone'],
            'fax' => $arrData['txt-fax'],
            'email' => $arrData['txt-email'],
            'region' => trim($arrData['txt-region']),
            'website' => $arrData['txt-website'],
            'service' => $arrData['txt-service'],
            'industry' => trim($arrData['txt-industry']),
            'industry_id' => ',' . $indus . ',',
            'order' => $arrData['txt-order'],
            'note' => $arrData['txt-note'],
        );

        $dataAdd = array(
            'trash' => 1,
            'create_date' => date('d-m-Y'),
            'serial' => $arrData['txt-serial'],
        );

        $dataInsert = array_merge($data, $dataAdd);

        if ($option['action'] == 'update') {
            $where = array('ID' => $option['ID']);
            $wpdb->update($table, $data, $where);
        } elseif ($option['action'] == 'insert') {
            $wpdb->insert($table, $dataInsert);
        }
    }
}
