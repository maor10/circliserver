<?php

class Requests_model extends Base_Model {


    public function __construct()
    {
        parent::__construct();
        $this->table_name = "requests";
        $this->unique_id_field = "id";
    }

    public function get_requests_for_user($user_id){
        SELECT * FROM `requests` JOIN groups on groups.id = requests.group_id JOIN groups_users ON groups_users.group_id = groups.id WHERE groups_users.user_id = 1
        $this->select("*")->from($this->table_name)->join("groups", "ON groups.")
    }

    public function get_requests_of_user($user_id){
        $this->db->select("*")->from("requests");
        $this->db->where("user_id", $user_id);
    }

    public function get_requests_of_group($group_id){
        $this->db->select("*")->from("requests");
        $this->db->where("group_id", $group_id);

        return $this->db->get()->result();
    }

    public function get_one($id){
        $this->db->select("*")->from("requests");
        $this->db->where("id", $group_id);

        return $this->db->get()->result()[0];   
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