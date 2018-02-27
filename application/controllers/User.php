<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	 
	public function __construct()
    {
            parent::__construct();
			$this->load->library('session');
			$this->load->library('form_validation');
	}
	
	public function index()
	{
        $this->load->model('User_model');
        $this->User_model->create_user('admin','admin','elmer','','','1',time(),time());
		
	}

}
