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
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		$this->load->view('associazione/dati_associazione');
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
				$this->session->set_flashdata('result',(new result_handling($this->upload->display_errors(),2))->build_html());
				redirect($_SERVER['HTTP_REFERER']."#result");
			}
		}
		else // imposto logo a null cosi mantiene quello già presente
		{ 
			$logo=null;
		}

		//carico la libreria di validazione form
		$this->load->library('form_validation');

		//configuro la libreria di validazione form
		//set_rules(nome input,nome error,regola)
        $this->form_validation->set_rules('name', 'Nome', 'required|trim');
        $this->form_validation->set_rules('address', 'Indirizzo', 'required|trim');
        $this->form_validation->set_rules('phone', 'Telefono', 'trim');
        $this->form_validation->set_rules('fax', 'Fax', 'trim');
		$this->form_validation->set_rules('fiscal_code', 'Codice fiscale', 'trim');
		$this->form_validation->set_rules('email', 'Indirizzo E-mail', 'trim|valid_email');
        $this->form_validation->set_rules('pec', 'Indirizzo e-mail (pec)', 'trim|valid_email');
		$this->form_validation->set_rules('iban', 'Codice iban', 'trim');
		$this->form_validation->set_rules('bic', 'codice bic', 'trim');
		$this->form_validation->set_rules('iscrizione_odv_aps', 'iscrizione_odv_aps', 'trim');
		$this->form_validation->set_rules('fk_comune', 'fk_comune', 'trim');
		
        //errore personalizzato per le varie regole
		$this->form_validation->set_message('required','{field} is required!');
		$this->form_validation->set_message('valid_url_check','{field} not url address valid!');

        //se i parametri del form sono validati corretamente 
		if ($this->form_validation->run() === TRUE)
		{
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
			if($this->Associazione_model->update_dati_associazione($name,$logo,$address,$phone,$fax,$fiscal_code,$email,$pec,$iban,$bic,$iscrizione,$fk_comune))
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


