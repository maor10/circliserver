<?php

class Groups_model extends Base_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table_name = "groups";
        $this->unique_id_field = "id";
    }

    public function get_groups_of_user($user_id){
        $this->db->select("*")->from($this->table_name);
        $this->db->join("users", "groups.id = users.id");
        $this->db->where("users.id", $user_id);
        return $this->db->get()->result();
    }
}