<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
	public function __construct()
    {
            parent::__construct();
			$this->load->library('session');
			$this->load->library('form_validation');
	}
	
	public function index()
	{
		//se l'utente è già loggato faccio un redirect alla index
		if( $this->session->has_userdata('isLoggedIn') ) {
			redirect('/index');
		} else { //altrimenti mostro il la pagina di login
			$this->load->view('login');
		}
		
	}

	//al tentativo di login
	public function login_user()
	{
		//creo un istanza del modello che accederà al db
		$this->load->model('User_model');

		//recupero username e password da post
		 $username = $this->input->post('username');
		 $password = $this->input->post('password');

		 //se valorizzati
		 if(isset($username) && isset($password))
		 {
			 //li controllo chiamando il metodo del controller (che valorizza anche la sessione)
			 if(true)
			 {
				 
				 //redirect alla index
				 redirect('/index');

			 }
			 else
			 {
				$data['error']="Username o password errati!";
				$this->load->view('login',$data);
			 }

		 }
	}
}
