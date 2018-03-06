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
			//carico i model
			$this->load->model('Luoghi_ajax_model');
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
		//	surname	address	phone	phone_ext	datebirth	email	avatar	fk_comune	fk_associato	fk_collaboratore
		//tb associati id	n_card	create_date	privacy	active	note	fk_tipo_associato	fk_cariche_direttivo
		echo "ok";
		var_dump($this->input->post());
		//persona
		$this->input->post('name');
		$this->input->post('surname');
		$this->input->post('fiscal_code');
		$this->input->post('address');
		$this->input->post('phone');
		$this->input->post('phone_ext');
		$this->input->post('datebirth');
		$this->input->post('email');
		$this->input->post('avatar');
		$this->input->post('create_date');
		$this->input->post('fk_comune');

		//associato
		$this->input->post('n_card');
		$this->input->post('privacy');
		$this->input->post('active');
		$this->input->post('note');

	}

	 //richiamata da ajax ritorna tutte le regioni come tag option della select
	 function get_regioni()
	 {
		 $regioni=$this->Luoghi_ajax_model->get_regioni();
		 echo '<option value="">Regione</option>';
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
		 echo '<option value="" disabled selected>Scegli la tua provincia</option>';
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
		 echo '<option value="" disabled selected>Scegli il tuo comune</option>';
		 for ($i=0; $i<count($comuni['id']); $i++)
		 {
			 
			 echo '<option value='.$comuni['id'][$i].'>'.$comuni['name'][$i].'</option>';
		 }
	 }

}


