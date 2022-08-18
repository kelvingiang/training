<?php

class Product_Category_Model {

    private $table;

    public function __construct()
    {
        global $wpdb;
        $this->table = $wpdb->prefix . 'product_category';
    }

    //lấy tất cả data trong database
    public function getData()
    {
        global $wpdb;
        $sql = "SELECT * FROM $this->table";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    //lấy data của 1 item
    public function getItem($id)
    {
        global $wpdb;
        $sql = "SELECT * FROM $this->table WHERE ID = $id";
        $row = $wpdb->get_row($sql, ARRAY_A);
        return $row;
    }

    public function save($arr, $option)
    {
        global $wpdb;
        $data = array(
            'category_name' => $arr['txt-category-name'],
        );

        //kiểm tra option là add hay update
        if ($option == "add") {
            $wpdb->insert($this->table, $data);
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

    public function countItem($item)
    {
        global $wpdb;
        $table = $wpdb->prefix . 'product';
        return $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE category = $item");
    }
}