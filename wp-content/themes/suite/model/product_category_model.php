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
}