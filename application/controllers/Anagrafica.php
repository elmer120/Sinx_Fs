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
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		$this->load->view('anagrafica/associati');
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
	}
	public function collaboratori()
	{
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		$this->load->view('anagrafica/collaboratori');
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
		//chiamo il model 
        $data['lista'] = $this->Anagrafica_model->get_all_persons();
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		$this->load->view('anagrafica/ricerca',$data);
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
	}
	public function rubrica()
	{
		//chiamo il model 
        $data['lista'] = $this->Anagrafica_model->get_all_persons();
		foreach($data['lista'] as $array)
		{
			foreach ($array as $key => &$value)
			{	
				if ($key=='id')
				{
					
					$array[$key]='<button class="uk-button uk-button-default" type="button">'.$value.'</button>';
					
				}
			}
		}
		
		
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		$this->load->view('anagrafica/rubrica',$data);
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
	}
	public function libro_soci()
	{
		$this->load->view('template/head');
		$this->load->view('template/navbar');
		$this->load->view('template/menu');
		$this->load->view('anagrafica/libro_soci');
		$this->load->view('template/side_bar');
		$this->load->view('template/footer');
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
		$config['max_size']             = '2048'; //in kb
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

				//collaboratore
				$mansione = $this->input->post('mansione');
				$note = $this->input->post('note');
				
				
					
					//se c'è un file
					if(is_uploaded_file($_FILES['avatar']['tmp_name']))
					{
						
						//eseguo l'upload
						if($this->upload->do_upload('avatar'))
						{   
							$avatar = $this->upload->data('file_name');
							//chiamo il model (passo anche il nome del file)
							if($this->Anagrafica_model->create_collaboratore($mansione,$note,$name,$surname,
							$fiscal_code,$address,$phone,$phone_ext,$datebirth,$email,$avatar,$fk_comune,$fk_tipo_associato=NULL,$fk_collaboratore=NULL,$fk_cariche_direttivo=NULL))
							{

								$this->session->set_flashdata('result',(new result_handling("Inserimento avvenuto correttamente con file!",0))->build_html());
								redirect($_SERVER['HTTP_REFERER']."#result");
								
							}
							else
							{
								
								$this->session->set_flashdata('result',(new result_handling("Errore nel inserimento nel db!",2))->build_html());
								redirect($_SERVER['HTTP_REFERER']."#result");
							}         
						}
						else //upload fallito
						{
							
							$this->session->set_flashdata('result',(new result_handling($this->upload->display_errors(),2))->build_html());
							redirect($_SERVER['HTTP_REFERER']."#result");
						}

					}
					else
					{
						if($this->Anagrafica_model->create_collaboratore($mansione,$note,$name,$surname,
						$fiscal_code,$address,$phone,$phone_ext,$datebirth,$email,$avatar,$fk_comune,$fk_tipo_associato=NULL,$fk_collaboratore=NULL,$fk_cariche_direttivo=NULL))
						{
								
								$this->session->set_flashdata('result',(new result_handling("Inserimento avvenuto correttamente senza file!",0))->build_html());
								redirect($_SERVER['HTTP_REFERER']."#result");
						}
							else
							{
								
								$this->session->set_flashdata('result',(new result_handling("Errore nel inserimento nel db!",2))->build_html());
								redirect($_SERVER['HTTP_REFERER']."#result");
							}         
					}
			}
			else
			{
				$this->session->set_flashdata('result',(new result_handling(validation_errors(),2))->build_html());
				redirect($_SERVER['HTTP_REFERER']."#result");
			}

		return;
	}
	public function create_associato()
	{
		//var_dump($_REQUEST);return;
		//load library form - upload(file)
		$this->load->library('form_validation');
		$this->load->library('upload');
		 
	    //configuro la libreria di upload
		$config['upload_path']          = './assets/img/associati/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = '2048'; //in kb
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
		$this->form_validation->set_message('required','{field} is required!');
		$this->form_validation->set_message('valid_fiscal_code','{field} formato codice fiscale errato!');
		//errore tag delimitatore
		$this->form_validation->set_error_delimiters('<div class="uk-alert-danger" uk-alert>', '</div>');
		            
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
				$fk_tipo_associato = $this->input->post('fk_tipo_associato');
				$fk_cariche_direttivo = $this->input->post('fk_cariche_direttivo');
				
					
					//se c'è un file
					if(is_uploaded_file($_FILES['avatar']['tmp_name']))
					{
						
						//eseguo l'upload
						if($this->upload->do_upload('avatar'))
						{   
							$avatar = $this->upload->data('file_name');
							//chiamo il model (passo anche il nome del file)
							if($this->Anagrafica_model->create_associato($n_card,$privacy,$active,$note,$name,$surname,
							$fiscal_code,$address,$phone,$phone_ext,$datebirth,$email,$avatar,$fk_comune,$fk_tipo_associato,$fk_collaboratore=NULL,$fk_cariche_direttivo))
							{
								$this->session->set_flashdata('result',(new result_handling("Inserimento avvenuto correttamente con file!",0))->build_html());
								redirect($_SERVER['HTTP_REFERER']."#result");
							}
							else
							{
								$this->session->set_flashdata('result',(new result_handling("Errore nel inserimento nel db!",2))->build_html());
								redirect($_SERVER['HTTP_REFERER']."#result");
							}         
						}
						else //upload fallito
						{
							$this->session->set_flashdata('result',(new result_handling($this->upload->display_errors(),2))->build_html());
							redirect($_SERVER['HTTP_REFERER']."#result");
						}

					}
					else
					{
						if($this->Anagrafica_model->create_associato($n_card,$privacy,$active,$note,$name,$surname,
						$fiscal_code,$address,$phone,$phone_ext,$datebirth,$email,$avatar,$fk_comune,$fk_tipo_associato,$fk_collaboratore=NULL,$fk_cariche_direttivo))
							{
								$this->session->set_flashdata('result',(new result_handling("Inserimento avvenuto correttamente senza file!",0))->build_html());
								redirect($_SERVER['HTTP_REFERER']."#result");
							}
							else
							{
								
								$this->session->set_flashdata('result',(new result_handling("Errore nel inserimento nel db!",2))->build_html());
								redirect($_SERVER['HTTP_REFERER']."#result");
							}         
					}
			}
			else
			{
				$this->session->set_flashdata('result',(new result_handling(validation_errors(),2))->build_html());
				redirect($_SERVER['HTTP_REFERER']."#result");
			}

		return;
	}
	//richiamata da ajax ritorna tag option della select
	function get_tipi_associato()
	{
		$tipi=$this->Tipi_ajax_model->get_tipi_associato();
		echo '<option value="">Tipo associato</option>'; //placeholder
		for ($i=0; $i<count($tipi['id']); $i++)
		{
			echo '<option value='.$tipi['id'][$i].'>'.$tipi['name'][$i].'</option>';
		}
	}
	//richiamata da ajax ritorna tag option della select
	function get_cariche_direttivo()
	{
		$cariche=$this->Tipi_ajax_model->get_cariche_direttivo();
		echo '<option value="">Carica direttivo</option>'; //placeholder
		echo '<option>Nessuna</option>';
		for ($i=0; $i<count($cariche['id']); $i++)
		{		
		echo '<option value='.$cariche['id'][$i].'>'.$cariche['name'][$i].'</option>';
		}
	}
	
	 //richiamata da ajax ritorna tag option della select
	 function get_regioni()
	 {
		 $regioni=$this->Luoghi_ajax_model->get_regioni();
		 echo '<option value="">Scegli la regione</option>'; //placeholder
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
		 echo '<option value="">Scegli la provincia</option>'; //placeholder
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
		 echo '<option value="">Scegli il comune</option>';//placeholder
		 for ($i=0; $i<count($comuni['id']); $i++)
		 {
			 echo '<option value='.$comuni['id'][$i].'>'.$comuni['name'][$i].'</option>';
		 }
	 }

}


