<?php

class Users_model extends Base_Model {


    public function __construct()
    {
        parent::__construct();
        $this->table_name = "users";
        $this->unique_id_field = "id";
    }

    public function get_users_of_group($group_id){
        $this->db->select("*")->from($this->table_name);
        $this->db->join("groups", "groups.id = users.id");
        $this->db->where("groups.id", $group_id);
        return $this->db->get()->result();
    }

    /*
    public function get_running_campaign($institute_id){
    
    	$this->db->select("*")->from("campaigns")->where("InstituteID", $institute_id)->where("IsPaused", 0)->where("CURDATE() >= DATE(StartDate)")->where("CURDATE() <= DATE(EndDate)");
    	$campaigns_result = $this->db->get()->result();
    	if (count($campaigns_result) == 0) {
    		return null;
    	}else{
    		return $campaigns_result[0];
    	}
    }   
    */
}