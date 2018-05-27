<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	 
	public function __construct()
    	{
	    parent::__construct();
	    			//se l'utente non è loggato faccio un redirect al login
			if(!isset($_SESSION['user'])) {
				redirect('/login');
			}
			$this->load->library('session');
			$this->load->library('form_validation');
	}
	
	public function index()
	{
        $this->load->model('User_model');
        $this->User_model->create_user('admin','admin','elmer','','','1',time(),time());
	}

}
