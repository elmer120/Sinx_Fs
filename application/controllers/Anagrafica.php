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
			//carico gli helpers
			
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
		
		//load library form - upload(file)
		$this->load->library('form_validation');
		$this->load->library('upload');
		 
	    //configuro la libreria di upload
		$config['upload_path']          = './assets/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = '2048'; //in kb
		$config['max_width']            = '512';
		$config['max_height']           = '512';
		$config['file_ext_tolower']     = TRUE; //estensione to lower es. win10
		$config['overwrite']            = TRUE; //file stesso nome nn vengono sovrascritti
		 
		//aggiorno la libreria
		$this->upload->initialize($config);

		//configuro la libreria di validazione form
		//set_rules(nome input,nome error,regola)
		//persona
        $this->form_validation->set_rules('name', 'Nome', 'trim|required');
        $this->form_validation->set_rules('surname', 'surname', 'trim');
        $this->form_validation->set_rules('fiscal_code', 'fiscal_code', 'trim');
        $this->form_validation->set_rules('address', 'address', 'trim');
		$this->form_validation->set_rules('phone', 'phone', 'trim');
		$this->form_validation->set_rules('phone_ext', 'phone_ext', 'trim');
        $this->form_validation->set_rules('datebirth', 'datebirth', 'trim');
        $this->form_validation->set_rules('email', 'email', 'trim');
        $this->form_validation->set_rules('avatar', 'avatar', 'trim');
		//associato
		$this->form_validation->set_rules('n_card', 'n_card', 'trim|required');
        $this->form_validation->set_rules('privacy', 'privacy', 'trim');
        $this->form_validation->set_rules('active', 'active', 'trim');
        $this->form_validation->set_rules('note', 'note', 'trim');

        //errore personalizzato per la regola required
		$this->form_validation->set_message('required','{field} is required');
		            
            //se i parametri del form sono validati corretamente 
			if ($this->form_validation->run() === TRUE)
			{
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
					
					
					//se c'è un file
					if(is_uploaded_file($_FILES['avatar']['tmp_name']))
					{
						
						//eseguo l'upload
						if($this->upload->do_upload('avatar'))
						{   
							$avatar = $this->upload->data('file_name');
							//chiamo il model (passo anche il nome del file)
							if($this->Anagrafica_model->create_associato($n_card,$privacy,$active,$note,$name,$surname,$fiscal_code,$address,$phone,$phone_ext,$datebirth,$email,$avatar,$fk_comune))
							{
								
								echo "Inserimento avvenuto correttamente con file!";
								return;
							}
							else
							{
								
								echo "Errore nel inserimento nel db!";
								return;
							}         
						}
						else //upload fallito
						{
							
							echo $this->upload->display_errors();
						}

					}
					else
					{
						if($this->Anagrafica_model->create_associato($n_card,$privacy,$active,$note,$name,$surname,$fiscal_code,$address,$phone,$phone_ext,$datebirth,$email,$avatar,$fk_comune))
							{
								
								echo "Inserimento avvenuto correttamente senza file!";
								return;
							}
							else
							{
								
								echo "Errore nel inserimento nel db!";
								return;
							}         
					}
			}
			else
			{
				echo validation_errors('<div class="error">','</div>');
				$this->index();
			}

		return;
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


