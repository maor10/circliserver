<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends Base_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
        parent::__construct();

        $this->load->model("groups_model");
    }

	public function get(){
        parent::asynchronousResponseWithOperation($this, function($instance) {
            return $this->users_model->get(array());
        });
    }

    public function get_one($id){
    	$this->id = $id;
        parent::asynchronousResponseWithOperation($this, function($instance) {
            $users = $this->users_model->get(array("id"=>$this->id));
            if (count($users) > 0) {
            	return $users;
            }else{
            	return array();
            }
        });
    }

    public function get_users($id){
    	$this->load->model("users_model");
    	$this->id = $id;
        parent::asynchronousResponseWithOperation($this, function($instance) {
            return $this->groups_model->get_users_of_group($this->id);
        });
    }

    public function get_requests_of_group($id){
        $this->load->model("requests_model");

        $this->group_id = $id;
         parent::asynchronousResponseWithOperation($this, function($instance) {
            return $this->requests_model->get_requests_of_group($this->group_id);
        });
    }

    public function create(){
        $this->createArr = array(
            "name" => $this->input->post("name"),
            "managing_user_id" => $this->input->post("managing_user_id")
            );
        parent::asynchronousResponseWithOperation($this, function($instance) {
            return $this->groups_model->create($this->createArr);
        });   

    }
}
