<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Base_Controller {

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

        $this->load->model("users_model");
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

    public function get_groups($id){
    	$this->load->model("groups_model");
    	$this->id = $id;
        parent::asynchronousResponseWithOperation($this, function($instance) {
            return $this->groups_model->get_groups_of_user($this->id);
        });
    }

    public function create_one(){
        $this->google_token = $this->input->post("google_token");

        parent::asynchronousResponseWithOperation($this, function($instance) {
            return $this->users_model->create(array("google_token" => $this->google_token));
        });   
    }
}
