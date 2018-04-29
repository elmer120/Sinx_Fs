<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stampa extends CI_Controller {

    public function __construct()
    {
			parent::__construct();
				
			//se l'utente non è loggato faccio un redirect al login
			if(!isset($_SESSION['user'])) {
				redirect('/login');
			}
			//carico gli helpers
			
			//carico i model
			$this->load->model('Stampa_model');
			//carico la lingua selezionata
			$this->lang->load('header', 'italian');
			$this->lang->load('menu', 'italian');	
    }
    
    public function libro_soci()
    {
        //recupero l'ordinamento richiesto
        $ordinamento = $this->input->post('ordinamento');
        //chiamo il model 
        $data['lista'] = $this->Stampa_model->get_associati($ordinamento);
		$this->load->view('template/head');
		$this->load->view('stampe/header');
		$this->load->view('stampe/libro_soci',$data);
        $this->load->view('stampe/footer');
    }
}
