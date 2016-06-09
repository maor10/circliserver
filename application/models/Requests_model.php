<?php

class Requests_model extends Base_Model {


    public function __construct()
    {
        parent::__construct();
        $this->table_name = "requests";
        $this->unique_id_field = "id";
    }

    public function get_requests_for_user($user_id){
        $this->select("*")->from($this->table_name)->join("groups", "ON groups.")
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