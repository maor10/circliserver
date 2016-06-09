<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Base_Controller extends CI_Controller{
    
    public $model = null;

    public function __construct() {
        parent::__construct();     
    }

    public function asynchronousResponseWithOperation($instance, $customOperation){
        $return_data = $customOperation($instance);
        echo json_encode($return_data);
    }
}
