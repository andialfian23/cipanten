<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class global_model extends CI_model {

    public function insert_data($table, $values){
        $this->db->insert($table, $values);
    }

    public function update_data($table, $set, $where){
        $this->db->where($where);
        $this->db->update($table, $set);
    }

    public function delete_data($table, $where){
        $this->db->delete($table, $where);
    }

}

?>