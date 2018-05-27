<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

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
			$this->load->helper('url');
			$this->load->library('form_validation');

			//carico la lingua selezionata
			$this->lang->load('header', 'italian');
	}
	
	public function index()
	{
		//se l'utente è già loggato faccio un redirect alla index
		if(isset($_SESSION['user'])) {
			redirect('/index/index');
		} else { //altrimenti mostro il la pagina di login
			$this->load->view('template/head');
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
			 if($this->User_model->validate_user($username,$password))
			 {
				 
				 //redirect alla index
				 redirect('/index/index');

			 }
			 else
			 {
				
				$data['error']="Username o password errati!";
				$this->load->view('template/head');
				$this->load->view('login',$data);
			 }

		 }
	}
	//uscita dall'applicazione
	public function logout()
	{
		//elimino la sessione
		if(session_destroy())
		{
			header( "refresh:3; url=index" ); //redirect con ritardo
			echo "Logout effettuato correttamente, attendere..."; //stampo messaggio
		}
		else //se la sessione resta intatta
		{
			echo "Problemi nell'uscita dall'applicazione";
		}
		
	}
}
