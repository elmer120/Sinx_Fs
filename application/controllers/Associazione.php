<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Associazione extends CI_Controller {

    public function __construct()
    {
			parent::__construct();
				
			//se l'utente non è loggato faccio un redirect al login
			if(!isset($_SESSION['user'])) {
				redirect('/login');
			}
			//carico gli helpers
			
			//carico i model
			
			//carico la lingua selezionata
			$this->lang->load('header', 'italian');
			$this->lang->load('menu', 'italian');	
    }

	public function index()
	{
				
	}
	
	public function dati_associazione()
	{
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		$this->load->view('dati_associazione');
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
	}

}


