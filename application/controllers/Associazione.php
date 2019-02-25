<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Associazione extends MY_Controller {

    public function __construct()
    {
			parent::__construct();
				
			//carico gli helpers
			
			//carico le librerie
			$this->load->library('result_handling');

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
		$breadcrumbs = array(
			"Home" => site_url(),
			"Dati associazione" => "" 
		   );
		$data['breadcrumbs'] = $breadcrumbs;
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		$this->load->view('associazione/dati_associazione',$data);
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
	}

	public function update_dati_associazione()
	{
		$breadcrumbs = array(
			"Home" => site_url(),
			"Dati associazione" => "" 
		   );
		$data['breadcrumbs'] = $breadcrumbs;
		//var_dump($_REQUEST);return;
		//recupero il logo 
	    //configuro la libreria di upload
		$config['upload_path']          = './assets/img/associazione/logo';
		$config['file_name']            = 'logo';
		$config['allowed_types']        = 'png';
		$config['max_size']             = '999'; //in kb
		$config['max_width']            = '512';
		$config['max_height']           = '512';
		$config['file_ext_tolower']     = TRUE; //estensione to lower es. win10
		$config['overwrite']            = TRUE; //file stesso nome nn vengono sovrascritti
		$this->load->library('upload',$config);

		//carico la libreria di validazione form
		$this->load->library('form_validation');

		//configuro la libreria di validazione form
		//set_rules(nome input,nome error,regola)
        $this->form_validation->set_rules('nome', 'Nome', 'required|trim');
        $this->form_validation->set_rules('indirizzo', 'Indirizzo', 'required|trim');
        $this->form_validation->set_rules('telefono', 'Telefono', 'trim');
		$this->form_validation->set_rules('codice_fiscale', 'Codice fiscale', 'trim');
		$this->form_validation->set_rules('partita_iva', 'Partita iva', 'trim');
		$this->form_validation->set_rules('email', 'Indirizzo E-mail', 'trim|valid_email');
        $this->form_validation->set_rules('email_pec', 'Indirizzo e-mail (pec)', 'trim|valid_email');
		$this->form_validation->set_rules('registration', 'iscrizione_odv_aps', 'trim');
		$this->form_validation->set_rules('fk_comune', 'fk_comune', 'required|trim');
		$this->form_validation->set_rules('logo', 'logo', 'trim');
		
        //errore personalizzato per le varie regole
		$this->form_validation->set_message('required','{field} è richiesto!');
		$this->form_validation->set_message('valid_url_check','{field} not url address valid!');
		//errore tag delimitatore
		$this->form_validation->set_error_delimiters('<div class="uk-alert-danger" uk-alert>', '</div>');

        //se i parametri del form sono validati corretamente 
		if ($this->form_validation->run() === TRUE)
		{
		  //recupero i dati associazione da post
			$name = $this->input->post('nome');
			$tipo = $this->input->post('tipo');
            $anno_fondazione = $this->input->post('anno_fondazione');
            $address = $this->input->post('indirizzo');
            $phone = $this->input->post('telefono');
			$fiscal_code = $this->input->post('codice_fiscale');
			$codice_fiscale = $this->input->post('codice_fiscale');
			$vat = $this->input->post('vat');
            $email = $this->input->post('email');
            $pec = $this->input->post('email_pec');
            $iscrizione = $this->input->post('registration');
			$fk_comune = $this->input->post('fk_comune');
			
			
			//se c'è un file
			if(is_uploaded_file($_FILES['logo']['tmp_name']))
			{
				//eseguo l'upload
				if($this->upload->do_upload('logo'))
				{   
					$logo = $this->upload->data('file_name');
					//chiamo il model x aggiornare il db
					if($this->Associazione_model->update_dati_associazione($name,$tipo,$anno_fondazione,$logo,$address,$phone,$fiscal_code,$partita_iva,$vat,$email,$pec,$iscrizione,$fk_comune))
					{
						$this->form_success();
					}
					else
					{
						$this->form_error("Aggiornamento database fallito!");
					}
				}
				else //upload fallito
				{
					$this->form_error("Upload fallito!".$this->upload->display_errors());
				}
			}
			else // imposto logo a null cosi mantiene quello già presente
			{ 
				$logo=null;
				//chiamo il model x aggiornare il db
				if($this->Associazione_model->update_dati_associazione($name,$tipo,$anno_fondazione,$logo,$address,$phone,$fiscal_code,$partita_iva,$vat,$email,$pec,$iscrizione,$fk_comune))
				{
					$this->form_success();
				}
				else
				{
					$this->form_error("Aggiornamento database fallito!");
				}
			}
		}
		else //dati non validati
		{
			$this->load->view('template/head');
			$this->load->view('template/navbar');
			$this->load->view('template/menu');
			$this->load->view('associazione/dati_associazione',$data);
			$this->load->view('template/side_bar');
			$this->load->view('template/footer');
		}
	}

}


