<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Associazione extends MY_Controller {

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
			$this->load->model('Associazione_model');

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

	public function update_dati_associazione()
	{
		//recupero il logo 

		
	    //configuro la libreria di upload
		$config['upload_path']          = './assets/img/associazione/logo';
		$config['file_name']            = 'logo';
		$config['allowed_types']        = 'png';
		$config['max_size']             = '2048'; //in kb
		$config['max_width']            = '512';
		$config['max_height']           = '512';
		$config['file_ext_tolower']     = TRUE; //estensione to lower es. win10
		$config['overwrite']            = TRUE; //file stesso nome nn vengono sovrascritti
		$this->load->library('upload',$config);

		//se c'è un file
		if(is_uploaded_file($_FILES['logo']['tmp_name']))
		{
			//eseguo l'upload
			if($this->upload->do_upload('logo'))
			{   
				$logo = $this->upload->data('file_name');      
			}
			else //upload fallito
			{
				
				echo $this->upload->display_errors();
			}

		}
		else
		{ 
			$logo=null;
		}

		//recupero i dati associazione da post
            $name = $this->input->post('name');
            $address = $this->input->post('address');
            $phone = $this->input->post('phone');
            $fax = $this->input->post('fax');
            $fiscal_code = $this->input->post('fiscal_code');
            $email = $this->input->post('email');
            $pec = $this->input->post('pec');
            $iban = $this->input->post('iban');
            $bic = $this->input->post('bic');
            $iscrizione = $this->input->post('iscrizione_odv_aps');
			$fk_comune = $this->input->post('fk_comune');
			
			//chiamo il model x aggiornare il db
			$this->Associazione_model->update_dati_associazione($name,$logo,$address,$phone,$fax,$fiscal_code,$email,$pec,$iban,$bic,$iscrizione,$fk_comune);
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


