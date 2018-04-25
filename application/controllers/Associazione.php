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
			$this->load->model('Luoghi_ajax_model');

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

		 //richiamata da ajax ritorna tag option della select
		 function get_regioni()
		 {
			 $regioni=$this->Luoghi_ajax_model->get_regioni();
			 echo '<option value="">Regione</option>'; //placeholder
			 for ($i=0; $i<count($regioni['id']); $i++)
			 {
				 echo '<option value='.$regioni['id'][$i].'>'.$regioni['name'][$i].'</option>';
			 }
		 }
		 
		 //richiamata da ajax dato l'id ritorna le province della regione 
		 function get_province()
		 {
			 $id=$this->input->post('region_select');
			 $province=$this->Luoghi_ajax_model->get_province($id);
			 echo '<option value="" disabled selected>Scegli la tua provincia</option>'; //placeholder
			 for ($i=0; $i<count($province['id']); $i++)
			 {
				 echo '<option value='.$province['id'][$i].'>'.$province['name'][$i].'</option>';
			 }
		 }
	
		//richiamata da ajax dato l'id ritorna i comuni della provincia
		 function get_comuni()
		 {
			 $id=$this->input->post('provincia_select');
			 $comuni=$this->Luoghi_ajax_model->get_comuni($id);
			 echo '<option value="" disabled selected>Scegli il tuo comune</option>';//placeholder
			 for ($i=0; $i<count($comuni['id']); $i++)
			 {
				 echo '<option value='.$comuni['id'][$i].'>'.$comuni['name'][$i].'</option>';
			 }
		 }

}


