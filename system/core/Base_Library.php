<?php

class Base_Library{
	public $model;
    public $CI;
	public function __construct() {
        $this->CI =& get_instance();
    }

    public function get($params){
    	return $this->model->get($params);
    }

    public function create($data){
        return $this->model->create($data);
    }
    
    public function update($id, $data){
        return $this->model->update($id, $data);
    }

    public function delete($id){
        return $this->model->delete($id);
    }
}