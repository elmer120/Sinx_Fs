<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anagrafica extends MY_Controller {

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

			//carico gli helpers
			
			//carico le librerie
			$this->load->library('result_handling');
			$this->load->library('pagination');

			//carico i model
			$this->load->model('Tipi_ajax_model');
			$this->load->model('Luoghi_ajax_model');
			$this->load->model('Anagrafica_model');
			//carico la lingua selezionata
			$this->lang->load('header', 'italian');
			$this->lang->load('menu', 'italian');	
    }
	public function associati()
	{
		$breadcrumbs = array(
			"Home" => site_url(),
			"Associati" => "" 
		   );
		$data['breadcrumbs'] = $breadcrumbs;
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		$this->load->view('anagrafica/associati',$data);
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
	}
	public function modifica_persona($id)
	{
		$breadcrumbs = array(
			"Home" => site_url(),
			"Ricerca" => site_url("/anagrafica/ricerca?reset=1"),
			"Modifica Persona" => "" 
		   );
		$data['breadcrumbs'] = $breadcrumbs;

		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		$data['persona'] = $this->Anagrafica_model->select_person($id);
		//se associato
		if(isset($data['persona']->fk_associato))
		{
			$this->load->view('anagrafica/modifica_associato',$data);
		} 
		else // se collaboratore
		{
			$this->load->view('anagrafica/modifica_collaboratore',$data);
		}

		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
	}
	public function visualizza_persona($id)
	{
		$breadcrumbs = array(
			"Home" => site_url(),
			"Ricerca" => site_url("/anagrafica/ricerca?reset=1"),
			"Visualizza Persona" => "" 
		   );
		$data['breadcrumbs'] = $breadcrumbs;
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		$data['persona'] = $this->Anagrafica_model->select_person($id);
		//se associato
		if(isset($data['persona']->fk_associato))
		{
			$this->load->view('anagrafica/visualizza_associato',$data);
		} 
		else // se collaboratore
		{
			$this->load->view('anagrafica/visualizza_collaboratore',$data);
		}

		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
	}

	public function collaboratori()
	{
		$breadcrumbs = array(
			"Home" => site_url(),
			"Collaboratori" => "" 
		   );
		$data['breadcrumbs'] = $breadcrumbs;
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		$this->load->view('anagrafica/collaboratori',$data);
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
	}

	public function csv()
	{
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		echo 'csv';
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
	}

	public function ricerca()
	{   
		$breadcrumbs = array(
			"Home" => site_url(),
			"Ricerca" => "" );
		$data['breadcrumbs'] = $breadcrumbs;
		
		//chiamo il model 
		$data['lista'] = $this->parse_persons($this->Anagrafica_model->get_persons());
		//var_dump($data['lista']);
		
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		$this->load->view('anagrafica/ricerca',$data);
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
	}

	public function get_list()
	{
		$lista = $this->parse_persons($this->Anagrafica_model->get_persons());
		echo json_encode($lista);
	}

	public function get_person()
	{
		$id = $this->input->post('id');
		if(isset($id))
		{
			$persona = $this->Anagrafica_model->get_person($id);
			echo json_encode($persona);
		}
	}

	public function rubrica()
	{
		$breadcrumbs = array(
			"Home" => site_url(),
			"Rubrica" => "" 
		   );
		$data['breadcrumbs'] = $breadcrumbs;
		//$config["base_url"] = base_url() . "index.php/anagrafica/rubrica/";
		
		//chiamo il model 
		$data['lista'] = $this->parse_persons($this->Anagrafica_model->get_persons_rubrica());

		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		$this->load->view('anagrafica/rubrica',$data);
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
	}

	private function parse_persons($persons){
		
		foreach ($persons as $row) {
			if(isset($row->fk_collaboratore))
			{	
				$row->type = "C";
			}
			elseif(isset($row->fk_associato))
			{	
				$row->type = "A";
			}
			unset($row->fk_associato);
		    unset($row->fk_collaboratore);
		}
		return $persons;
	}

	public function libro_soci()
	{
		$breadcrumbs = array(
			"Home" => site_url(),
			"Libro soci" => "" 
		   );
		$data['breadcrumbs'] = $breadcrumbs;
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		$this->load->view('anagrafica/libro_soci',$data);
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
	}

	public function update_collaboratore($id)
	{
		//var_dump($_REQUEST);return;
		//load library form - upload(file)
		$this->load->library('form_validation');
		$this->load->library('upload');
		 
	    //configuro la libreria di upload
		$config['upload_path']          = './assets/img/collaboratori/';
		$config['file_name']            = 'logo';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = '999'; //in kb
		$config['max_width']            = '512';
		$config['max_height']           = '512';
		$config['file_ext_tolower']     = TRUE; //estensione to lower es. win10
		$config['overwrite']            = FALSE; //file stesso nome nn vengono sovrascritti
		 
		//aggiorno la libreria
		$this->upload->initialize($config);

		//configuro la libreria di validazione form
		//set_rules(nome input,nome error,regola)
		//persona
        $this->form_validation->set_rules('name', 'Nome', 'trim|required');
        $this->form_validation->set_rules('surname', 'surname', 'trim');
		$this->form_validation->set_rules('fiscal_code', 'codice fiscale', 'trim|valid_fiscal_code');
		$this->form_validation->set_rules('fk_comune', 'comune', 'trim|required');
        $this->form_validation->set_rules('address', 'address', 'trim');
		$this->form_validation->set_rules('phone', 'phone', 'trim');
		$this->form_validation->set_rules('phone_ext', 'phone_ext', 'trim');
        $this->form_validation->set_rules('datebirth', 'datebirth', 'trim');
        $this->form_validation->set_rules('email', 'email', 'trim|valid_email');
        $this->form_validation->set_rules('avatar', 'avatar', 'trim');
		//collaboratore
		$this->form_validation->set_rules('mansione', 'mansione', 'trim|required');
        $this->form_validation->set_rules('note', 'note', 'trim');

        //errore personalizzato per la regola required
		$this->form_validation->set_message('required','{field} is required!');
		$this->form_validation->set_message('valid_fiscal_code','{field} formato codice fiscale errato!');
		//errore tag delimitatore
		$this->form_validation->set_error_delimiters('<div class="uk-alert-danger" uk-alert>', '</div>');

            //se i parametri del form sono validati corretamente 
			if ($this->form_validation->run() === TRUE)
			{
						
			//predispongo l'array
			$data_person = array(
				'id' => $id,
				'name' =>  $this->input->post('name'),
				'surname' =>  $this->input->post('surname'),
				'fiscal_code' => $this->input->post('fiscal_code'),
				'address' => $this->input->post('address'),
				'phone' =>  $this->input->post('phone'),
				'phone_ext' => $this->input->post('phone_ext'),
				'datebirth' => $this->input->post('datebirth'),
				'email' => $this->input->post('email'),
				'avatar' => $this->input->post('avatar'),
				'create_date'=> date("Y-m-d H:i:s"),
				'fk_comune' => $this->input->post('fk_comune'),
				'fk_collaboratore' => $this->input->post('fk_collaboratore'),
				'fk_associato' => NULL
				);
			//istanzio la classe person
			$this->load->library('person',$data_person);
			//predispongo l'array
			$data_collaboratore = array(
				'id' => $this->input->post('fk_collaboratore'),
				'mansione' =>  $this->input->post('mansione'),
				'note' =>  $this->input->post('note')
				);
			//istanzio la classe collaboratore
			$this->load->library('collaboratore',$data_collaboratore);
					//se c'è un file
					if(is_uploaded_file($_FILES['avatar']['tmp_name']))
					{
						//eseguo l'upload
						if($this->upload->do_upload('avatar'))
						{   
						    $this->person->avatar = $this->upload->data('file_name');
							//chiamo il model (passo anche il nome del file)
							if($this->Anagrafica_model->update_collaboratore($this->person,$this->collaboratore))
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
					else
					{
						$this->person->avatar = "avatar.jpg";
						if($this->Anagrafica_model->update_collaboratore($this->person,$this->collaboratore))
							{
								$this->form_success();
							}
							else
							{
								$this->form_error("Aggiornamento database fallito!");
							}         
					}
			}
			else
			{
				$this->modifica_persona($id);
			}
	}

	public function update_associato($id)
	{
		//var_dump($_REQUEST);return;
		//load library form - upload(file)
		$this->load->library('form_validation');
		$this->load->library('upload');
		 
	    //configuro la libreria di upload
		$config['upload_path']          = './assets/img/associati/';
		$config['allowed_types']        = 'jpg|png';
		$config['max_size']             = '999'; //in kb
		$config['max_width']            = '512';
		$config['max_height']           = '512';
		$config['file_ext_tolower']     = TRUE; //estensione to lower es. win10
		$config['overwrite']            = FALSE; //file stesso nome nn vengono sovrascritti
		 
		//aggiorno la libreria
		$this->upload->initialize($config);

		//configuro la libreria di validazione form
		//set_rules(nome input,nome error,regola)
		//persona
        $this->form_validation->set_rules('name', 'Nome', 'trim|required');
        $this->form_validation->set_rules('surname', 'surname', 'trim');
		$this->form_validation->set_rules('fiscal_code', 'codice fiscale', 'trim|valid_fiscal_code');
		$this->form_validation->set_rules('fk_comune', 'comune', 'trim|required');
        $this->form_validation->set_rules('address', 'address', 'trim');
		$this->form_validation->set_rules('phone', 'phone', 'trim');
		$this->form_validation->set_rules('phone_ext', 'phone_ext', 'trim');
        $this->form_validation->set_rules('datebirth', 'datebirth', 'trim');
        $this->form_validation->set_rules('email', 'email', 'trim|valid_email');
        $this->form_validation->set_rules('avatar', 'avatar', 'trim');
		//associato
		$this->form_validation->set_rules('n_card', 'n_card', 'trim|required');
        $this->form_validation->set_rules('privacy', 'privacy', 'trim');
		$this->form_validation->set_rules('active', 'active', 'trim');
		$this->form_validation->set_rules('fk_tipo_associato', 'tipo associato', 'trim|required');
        $this->form_validation->set_rules('fk_cariche_direttivo', 'carica direttivo', 'trim|required');
        $this->form_validation->set_rules('note', 'note', 'trim');

        //errore personalizzato per la regola required
		$this->form_validation->set_message('required','{field} è richiesto!');
		$this->form_validation->set_message('valid_fiscal_code','{field} formato codice fiscale errato!');
		//errore tag delimitatore
		$this->form_validation->set_error_delimiters('<div class="uk-alert-danger" uk-alert>', '</div>');

            //se i parametri del form sono validati corretamente 
			if ($this->form_validation->run() === TRUE)
			{
						
			//predispongo l'array
			$data_person = array(
					'id' => $id,
					'name' =>  $this->input->post('name'),
					'surname' =>  $this->input->post('surname'),
					'fiscal_code' => $this->input->post('fiscal_code'),
					'address' => $this->input->post('address'),
					'phone' =>  $this->input->post('phone'),
					'phone_ext' => $this->input->post('phone_ext'),
					'datebirth' => $this->input->post('datebirth'),
					'email' => $this->input->post('email'),
					'avatar' => $this->input->post('avatar'),
					'create_date'=>date("Y-m-d H:i:s"),
					'fk_comune' => $this->input->post('fk_comune'),
					'fk_collaboratore' => NULL,
					'fk_associato' => $this->input->post('fk_associato')
					);
			//istanzio la classe person
			$this->load->library('person',$data_person);
			//predispongo l'array 
			$data_associato = array(
				'id' =>  $this->input->post('fk_associato'),
				'n_card' =>  $this->input->post('n_card'),
				'privacy' =>  $this->input->post('privacy'),
				'active' => $this->input->post('active'),
				'note' => $this->input->post('note'),
				'fk_tipo_associato' =>  $this->input->post('fk_tipo_associato'),
				//se l'associato non fa parte del direttivo, imposto l'fk a null
				'fk_cariche_direttivo' => ($this->input->post('fk_cariche_direttivo')=="Nessuna")? NULL : $this->input->post('fk_cariche_direttivo')
				);
			//istanzio la classe associato
			$this->load->library('Associato',$data_associato);
					//se c'è un file
					if(is_uploaded_file($_FILES['avatar']['tmp_name']))
					{
						//eseguo l'upload
						if($this->upload->do_upload('avatar'))
						{   
						    $this->person->avatar = $this->upload->data('file_name');
							//chiamo il model (passo anche il nome del file)
							if($this->Anagrafica_model->update_associato($this->person,$this->associato))
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
					else
					{
						$this->person->avatar = "avatar.jpg";
						if($this->Anagrafica_model->update_associato($this->person,$this->associato))
							{
								$this->form_success();
							}
							else
							{
								$this->form_error("Aggiornamento database fallito!");
							}         
					}
			}
			else
			{
				$this->modifica_persona($id);
			}
	}

	public function elimina_persona($id)
	{
		if($this->Anagrafica_model->delete($id))
		{
			$this->form_success();
		}
		else
		{
			$this->form_error("Eliminazione dal database fallita!");
		}

	}
	
	public function create_collaboratore()
	{
		//var_dump($_REQUEST);return;
		//load library form - upload(file)
		$this->load->library('form_validation');
		$this->load->library('upload');
		 
	    //configuro la libreria di upload
		$config['upload_path']          = './assets/img/collaboratori/';
		$config['file_name']            = 'logo';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = '999'; //in kb
		$config['max_width']            = '512';
		$config['max_height']           = '512';
		$config['file_ext_tolower']     = TRUE; //estensione to lower es. win10
		$config['overwrite']            = FALSE; //file stesso nome nn vengono sovrascritti
		 
		//aggiorno la libreria
		$this->upload->initialize($config);

		//configuro la libreria di validazione form
		//set_rules(nome input,nome error,regola)
		//persona
        $this->form_validation->set_rules('name', 'Nome', 'trim|required');
        $this->form_validation->set_rules('surname', 'surname', 'trim');
		$this->form_validation->set_rules('fiscal_code', 'codice fiscale', 'trim|valid_fiscal_code');
		$this->form_validation->set_rules('fk_comune', 'comune', 'trim|required');
        $this->form_validation->set_rules('address', 'address', 'trim');
		$this->form_validation->set_rules('phone', 'phone', 'trim');
		$this->form_validation->set_rules('phone_ext', 'phone_ext', 'trim');
        $this->form_validation->set_rules('datebirth', 'datebirth', 'trim');
        $this->form_validation->set_rules('email', 'email', 'trim|valid_email');
        $this->form_validation->set_rules('avatar', 'avatar', 'trim');
		//collaboratore
		$this->form_validation->set_rules('mansione', 'mansione', 'trim|required');
        $this->form_validation->set_rules('note', 'note', 'trim');

        //errore personalizzato per la regola required
		$this->form_validation->set_message('required','{field} is required!');
		$this->form_validation->set_message('valid_fiscal_code','{field} formato codice fiscale errato!');
		//errore tag delimitatore
		$this->form_validation->set_error_delimiters('<div class="uk-alert-danger" uk-alert>', '</div>');
		            
            //se i parametri del form sono validati corretamente 
			if ($this->form_validation->run() === TRUE)
			{
				//predispongo l'array
				$data_person = array(
					'id' => NULL,
					'name' =>  $this->input->post('name'),
					'surname' =>  $this->input->post('surname'),
					'fiscal_code' => $this->input->post('fiscal_code'),
					'address' => $this->input->post('address'),
					'phone' =>  $this->input->post('phone'),
					'phone_ext' => $this->input->post('phone_ext'),
					'datebirth' => $this->input->post('datebirth'),
					'email' => $this->input->post('email'),
					'avatar' => $this->input->post('avatar'),
					'create_date'=>date("Y-m-d H:i:s"),
					'fk_comune' => $this->input->post('fk_comune'),
					'fk_collaboratore' => NULL,
					'fk_associato' => NULL
					);
				//istanzio la classe person
				$this->load->library('person',$data_person);

				//predispongo l'array
				$data_collaboratore = array(
					'id' => NULL,
					'mansione' =>  $this->input->post('mansione'),
					'note' =>  $this->input->post('note')
					);
				//istanzio la classe collaboratore
				$this->load->library('collaboratore',$data_collaboratore);
				
					//se c'è un file
					if(is_uploaded_file($_FILES['avatar']['tmp_name']))
					{
						
						//eseguo l'upload
						if($this->upload->do_upload('avatar'))
						{   
							
							$this->person->avatar = $this->upload->data('file_name');
							//chiamo il model (passo anche il nome del file)
							if($this->Anagrafica_model->create_collaboratore($this->person,$this->collaboratore))
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
					else
					{
						$this->person->avatar = "avatar.jpg";
						if($this->Anagrafica_model->create_collaboratore($this->person,$this->collaboratore))
						{
							$this->form_success();
						}
						else
						{
							$this->form_error("Aggiornamento database fallito!");
						}         
					}
			}
			else
			{
				$this->load->view('template/head');
				$this->load->view('template/navbar');
				$this->load->view('template/menu');
				$this->load->view('anagrafica/collaboratori');
				$this->load->view('template/side_bar');
				$this->load->view('template/footer');
			}
	}
	public function create_associato()
	{
		
		//load library form - upload(file)
		$this->load->library('upload');
		 
	    //configuro la libreria di upload
		$config['upload_path']          = './assets/img/associati/';
		$config['allowed_types']        = 'jpg|png';
		$config['max_size']             = '999'; //in kb
		$config['max_width']            = '512';
		$config['max_height']           = '512';
		$config['file_ext_tolower']     = TRUE; //estensione to lower es. win10
		$config['overwrite']            = FALSE; //file stesso nome nn vengono sovrascritti

		//aggiorno la libreria
		$this->upload->initialize($config);
		$this->load->library('form_validation');
		
		//r = required
		if( $this->input->post('socio') != NULL) 
		{
			$this->form_validation->set_rules('approvazione_data', 'Data di approvazione', 'required');
			$this->form_validation->set_rules('fk_soci_tipologie', 'Tipo socio', 'required');
			if($this->form_validation->run())
			{
				//predispongo l'array 
				$socio = array(
					'id' => NULL,
					'richiesta_data' =>  $this->input->post('richiesta_data'),
					'approvazione_data' => $this->input->post('approvazione_data'), //r
					'scadenza_data' => $this->input->post('scadenza_data'),
					'fk_soci_tipologie' =>  $this->input->post('fk_soci_tipologie'), //r
					'certificato_scadenza_al' =>  $this->input->post('certificato_scadenza_al')
					);
					//le stringe vuote le imposto a null
					foreach ($socio as $key => $value) {
						if($socio[$key]=='')
						{$socio[$key]= NULL;}
					}
					//echo'<pre>'.var_export($socio,true).'<pre>';
					//echo "<br>";

					//inserisco il socio e recupero id
					$fk_soci = $this->Anagrafica_model->create_socio($socio);
					if($fk_soci==-1)
					{
						echo json_encode(array(
							'status'=>"danger",
							"message"=>"Errore nell'inserimento del socio"
						));
						die();
					}
					
			}
			else
			{
				//echo validation_errors();
				echo json_encode(array(
					'status'=>"warning",
					"message"=>validation_errors('<p>','</p>')
				));
				$this->form_validation->reset_validation();
				die();
			}
		}

		//persona
		//$this->form_validation->set_error_delimiters('<p>','</p>');
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('cognome', 'Cognome', 'required');
		$this->form_validation->set_rules('data_nascita', 'Data di nascita', 'required');
		$this->form_validation->set_rules('fk_comuni', 'Comune di residenza', 'required');
		$this->form_validation->set_rules('fk_comuni_nascita', 'Comune di nascita', 'required');
		if($this->form_validation->run())
		{
			
			//predispongo l'array persona
			$persona = array(
					'id' => NULL,
					'nome' =>  $this->input->post('nome'), //r
					'cognome' =>  $this->input->post('cognome'), //r
					'data_nascita' => $this->input->post('data_nascita'),//r
					'codice_fiscale' => $this->input->post('codice_fiscale'),
					'partita_iva' => $this->input->post('partita_iva'),
					'indirizzo' =>  $this->input->post('indirizzo'),
					'privacy' => $this->input->post('privacy'),
					'telefono' => $this->input->post('telefono'),
					'telefono_ext' => $this->input->post('telefono_ext'),
					'email' => $this->input->post('email'),
					'iban' => $this->input->post('iban'),
					'banca' => $this->input->post('banca'),
					'note'=>$this->input->post("note"),
					'fk_associazioni' => 1, //r
					'fk_soci' => $this->input->post('socio') != NULL ? $fk_soci : NULL, //r
					'fk_comuni' => $this->input->post('fk_comuni'), //r
					'fk_comuni_nascita' => $this->input->post('fk_comuni_nascita'), //r
					'fk_responsabile' => $this->input->post('fk_responsabile')
					);
					//le stringe vuote le imposto a null
					foreach ($persona as $key => $value) {
						if($persona[$key]=='')
						{$persona[$key]= NULL;}
					}
					//echo'<pre>'.var_export($persona,true).'<pre>';
		
					//inserisco persona e recupero id
					$fk_persona = $this->Anagrafica_model->create_person($persona);
					if($fk_persona==-1)
					{
						echo json_encode(array(
							'status'=>"danger",
							"message"=>"Errore nell'inserimento della persona"
						));
						die();
					}
					

		}
		else
		{
			//echo validation_errors();
			echo json_encode(array(
				'status'=>"warning",
				"message"=>validation_errors('<p>','</p>')
			));
			$this->form_validation->reset_validation();
			die();
		}
		
		if( $this->input->post('carica_direttivo') != NULL)
		{
			$this->form_validation->set_rules('fk_cariche_direttivo', 'Carica', 'required');

			if($this->form_validation->run('carica_direttivo'))
			{
				$carica_direttivo = array(
					'carica_direttivo_dal' =>  $this->input->post('carica_direttivo_dal'),
					'carica_direttivo_al'  =>  $this->input->post('carica_direttivo_al'),
					'fk_soci' => $fk_soci, //r
					'fk_cariche_direttivo' =>  $this->input->post('fk_cariche_direttivo') //r
				);

				//echo'<pre>'.var_export($carica_direttivo,true).'<pre>';
				//echo "<br>";
				$fk_carica = $this->Anagrafica_model->create_carica($carica_direttivo);
				if($fk_carica==-1)
				{
					echo json_encode(array(
						'status'=>"danger",
						"message"=>"Errore nell'inserimento della carica"
					));
					die();
				}
			}
			else
			{
				//echo validation_errors();
				echo json_encode(array(
					'status'=>"warning",
					"message"=>validation_errors('<p>','</p>')
				));
				$this->form_validation->reset_validation();
				die();
			}
		}

		if( $this->input->post('tessere') != NULL)
		{
			$this->form_validation->set_rules('numero', 'Numero tessera', 'required');

			if($this->form_validation->run('carica_direttivo'))
			{
				$tessera = array(
					'numero' => $this->input->post('numero'), //r
					'tessere_dal' =>  $this->input->post('tessere_dal'),
					'tessere_al'  =>  $this->input->post('tessere_al'),
					'tessere_tipo' =>  $this->input->post('tessere_tipo'),
					'fk_soci' => $fk_soci //r
				);

				//echo'<pre>'.var_export($tessera,true).'<pre>';
				$fk_tessera = $this->Anagrafica_model->create_tessera($tessera);
				if($fk_tessera==-1)
				{
					echo json_encode(array(
						'status'=>"danger",
						"message"=>"Errore nell'inserimento della tessera"
					));
					die();
				}
				
			}
			else
			{
				//echo validation_errors();
				echo json_encode(array(
					'status'=>"warning",
					"message"=>validation_errors('<p>','</p>')
				));
				$this->form_validation->reset_validation();
				die();
			}		
			
		}
		echo json_encode(array(
			'status'=>"success",
			"message"=>('<p>Invio avvenuto correttamente</p>')
		));
		

	}
}
