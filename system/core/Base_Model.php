<?php

class Base_Model extends CI_Model{
        
    public $table_name = null;
    public $unique_id_field = null;

    public function __construct() {
        parent::__construct();
    }

    public function create($data){
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }
    
    public function get($params, $select_column = "*"){
        $this->db->select($select_column)->from($this->table_name);
        
        foreach ($params as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get();
        $result = $query->result();
        
        return $result;
    }
    
    public function update($id, $data){
        $this->db->where($this->unique_id_field, $id);
        $this->db->update($this->table_name, $data);
    }

    public function delete($id){
        $this->db->where($this->unique_id_field, $id);
        $this->db->delete($this->table_name);
    }
}
