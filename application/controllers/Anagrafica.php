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
			$this->load->model('Anagrafica_model');
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
		var_dump($this->input->post());
		//persona
		$name = $this->input->post('name');
		$surname = $this->input->post('surname');
		$fiscal_code = $this->input->post('fiscal_code');
		$address = $this->input->post('address');
		$phone = $this->input->post('phone');
		$phone_ext = $this->input->post('phone_ext');
		$datebirth = $this->input->post('datebirth');
		$email = $this->input->post('email');
		$avatar = $this->input->post('avatar');
		$fk_comune = $this->input->post('fk_comune');

		//associato
		$n_card = $this->input->post('n_card');
		$privacy = $this->input->post('privacy');
		$active = $this->input->post('active');
		$note = $this->input->post('note');
return;
		$this->Anagrafica_model->create_associato($name,$surname,$fiscal_code,$address,$phone,$phone_ext,$datebirth,$email,$avatar,$fk_comune,$n_card,$privacy,$active,$note);
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


