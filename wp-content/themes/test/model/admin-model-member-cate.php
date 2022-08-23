<?php

class Admin_Model_Member_Cate {
    private $table;

    public function __construct()
    {
        global $wpdb;
        $this->table = $wpdb->prefix . 'member_cate';
    }

    //lấy tất cả data của group trong database
    public function getDataGroup()
    {
        global $wpdb;
        $sql = "SELECT * FROM $this->table WHERE type = 1";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    //lấy tất cả data của industry trong database
    public function getDataIndustry()
    {
        global $wpdb;
        $sql = "SELECT * FROM $this->table WHERE type = 2";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    // //lấy data của 1 group item
    public function getGroupItem($id)
    {
        global $wpdb;
        $sql = "SELECT * FROM $this->table WHERE ID = $id && type = 1";
        $row = $wpdb->get_row($sql, ARRAY_A);
        return $row;
    }

    // //lấy data của 1 industry item
    public function getIndustryItem($id)
    {
        global $wpdb;
        $sql = "SELECT * FROM $this->table WHERE ID = $id && type = 2";
        $row = $wpdb->get_row($sql, ARRAY_A);
        return $row;
    }

    public function save($arr, $option)
    {
        global $wpdb;
        $currentUser = wp_get_current_user();
        $user = $currentUser->user_login; //lấy ra tên user
        $data = array(
            'cate_name' => $arr['txt-cate-name'],
            'update_date' => date('d-m-Y'),
            'update_by' => $user,
        );

        $dataAdd = array(
            'create_date' => date('d-m-Y'),
            'create_by'=> $user,
        );
        $insertData = array_merge($data, $dataAdd);

        //kiểm tra option là add hay update
        if ($option == "add") {
            $wpdb->insert($this->table, $insertData);
        } elseif ($option == "update") {
            $where = array('ID' => $arr['hidden_id']);
            $wpdb->update($this->table, $data, $where);
        }
    }

    public function delete($id)
    {
        global $wpdb;
        $where = array('ID' => absint($id));
        $wpdb->delete($this->table, $where);
    }

    public function countGroupItem($id)
    {
        global $wpdb;
        $table = $wpdb->prefix . 'member';
        return $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE group_id = $id");
    }

    public function countIndustryItem($id)
    {
        global $wpdb;
        $table = $wpdb->prefix . 'member';
        return $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE industry_id = $id");
    }
}