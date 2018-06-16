<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gestione extends MY_Controller {

    public function __construct()
    {
			parent::__construct();
				
			//carico gli helpers
			

			//carico le librerie
			$this->load->library('result_handling');

			//carico i model
			$this->load->model('Luoghi_ajax_model');
			$this->load->model('Gestione_model');

			//carico la lingua selezionata
			$this->lang->load('header', 'italian');
			$this->lang->load('menu', 'italian');	
    }

	public function moduli()
	{
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		echo "moduli";
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
    }
    
    public function calendario()
	{
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		echo "calendario";
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
    }
    
    public function link_rapidi()
	{
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		$this->load->view('gestione/link_rapidi');
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
	}
	
	public function update_link_rapidi()
	{
		//carico la libreria di validazione form
		$this->load->library('form_validation');

		//configuro la libreria di validazione form
		//set_rules(nome input,nome error,regola)
		//persona
        $this->form_validation->set_rules('link_website', 'Website', 'trim|callback_valid_url_check');
        $this->form_validation->set_rules('link_webmail', 'Webmail', 'trim|callback_valid_url_check');
        $this->form_validation->set_rules('link_webmail_pec', 'Webmail pec', 'trim|callback_valid_url_check');
        $this->form_validation->set_rules('link_facebook', 'Facebook', 'trim|callback_valid_url_check');
		$this->form_validation->set_rules('link_instagram', 'Instagram', 'trim|callback_valid_url_check');
		$this->form_validation->set_rules('link_youtube', 'Youtube', 'trim|callback_valid_url_check');
        $this->form_validation->set_rules('link_twitter', 'Twitter', 'trim|callback_valid_url_check');
		$this->form_validation->set_rules('link_home_banking', 'Home_banking', 'trim|callback_valid_url_check');
		
        //errore personalizzato per le varie regole
		$this->form_validation->set_message('required','{field} is required!');
		$this->form_validation->set_message('valid_url_check','{field} not url address valid!');

            //se i parametri del form sono validati corretamente 
			if ($this->form_validation->run() === TRUE)
			{
				//recupero i link da post
				$link_website = $this->input->post('link_website');
				$link_webmail = $this->input->post('link_webmail');
				$link_webmail_pec = $this->input->post('link_webmail_pec');
				$link_facebook = $this->input->post('link_facebook');
				$link_instagram = $this->input->post('link_instagram');
				$link_youtube = $this->input->post('link_youtube');
				$link_twitter = $this->input->post('link_twitter');
				$link_home_banking = $this->input->post('link_home_banking');
				
							//chiamo il model 
							if($this->Gestione_model->update_link_rapidi($link_website,$link_webmail,$link_webmail_pec,$link_facebook,$link_instagram,$link_youtube,$link_twitter,$link_home_banking))
							{
								$this->session->set_flashdata('result',(new result_handling("Operazione conclusa con successo!!!",0))->build_html());
								redirect($_SERVER['HTTP_REFERER']."#result");
							}
							else
							{
								$this->session->set_flashdata('result',(new result_handling("Errore nel inserimento nel db!",2))->build_html());
								redirect($_SERVER['HTTP_REFERER']."#result");
							}         
			}
			else //dati non validati
			{
				$this->session->set_flashdata('result',(new result_handling(validation_errors(),2))->build_html());
				redirect($_SERVER['HTTP_REFERER']."#result");
			}
	}

	//callback regola di validazione per gli url del form
	public function valid_url_check($url){

		if(!empty($url))
		{
			if (filter_var($url, FILTER_VALIDATE_URL)) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
		else
		{
			return TRUE;
		}
	}


    public function blocco_note()
	{
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		echo "blocco_note";
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
    }
    
    public function e_mail()
	{
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		echo "e_mail";
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
    }
    
    public function utenti()
	{
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		echo "utenti";
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
    }
    
    public function files()
	{
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		echo "files";
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
    }
    
    public function log()
	{
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		echo "log";
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
    }
    
    public function backup ()
	{
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		echo "backup";
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
	}
	
}


