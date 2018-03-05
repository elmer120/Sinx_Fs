<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anagrafica extends CI_Controller {

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
				
			//se l'utente non è loggato faccio un redirect al login
			if(!isset($_SESSION['user'])) {
				redirect('/login');
			}
			//carico la lingua selezionata
			$this->lang->load('header', 'italian');
			$this->lang->load('menu', 'italian');	
    }

	public function index()
	{
				
		
		$this->load->view('template/header');
		$this->load->view('template/menu');
		
		$this->load->view('ins');
		
	}

	public function create_associato()
	{
		$this->input->post('');
	}
}
