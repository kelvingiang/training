<?php

class Member_Industry_Model {

    private $table;

    public function __construct() {
        global $wpdb;
        $this->table = $wpdb->prefix . 'member_industry';
    }

    public function getData() {
        global $wpdb;
        $sql = "SELECT * FROM $this->table";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    public function getItem($id) {
        global $wpdb;
        $sql = "SELECT * FROM $this->table WHERE  ID = $id";
        $row = $wpdb->get_row($sql, ARRAY_A);
        return $row;
    }

    public function save($arr, $option) {
        global $wpdb;
        $data = array(
            'name' => $arr['txt_name'],
            'order' => $arr['txt_order']
        );

        $date = array(
            'create_date' => date('Y-m-d')
        );
        $insertData = array_merge($data, $date);

        if ($option == "add") {
            $wpdb->insert($this->table, $insertData);
        } elseif ($option == "update") {
            $where = array('ID' => $arr['hidden_id']);
            $wpdb->update($this->table, $data, $where);
        }
    }

    public function getMemberIndustry() {
        global $wpdb;
        $table = $wpdb->prefix . 'member';
        $sql = "SELECT industry_id FROM $table WHERE industry_id != '' ";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    public function delete($id) {
        global $wpdb;
        $where = array('ID' => absint($id));
        $wpdb->delete($this->table, $where);
    }

}
