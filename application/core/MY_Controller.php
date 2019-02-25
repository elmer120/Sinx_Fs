<?php
defined('BASEPATH') OR exit('No direct script access allowed');



/*Estendo la classe controller di base cosi posso gestire le richieste ajax da tutte le view,
richiede di configurare correttamente il prefisso in application/config/config.php

|--------------------------------------------------------------------------
| Class Extension Prefix
|--------------------------------------------------------------------------
|
| This item allows you to set the filename/classname prefix when extending
| native libraries.  For more information please see the user guide:
|
| https://codeigniter.com/user_guide/general/core_classes.html
| https://codeigniter.com/user_guide/general/creating_libraries.html
|
*/
//$config['subclass_prefix'] = 'MY_';


Class MY_Controller Extends CI_Controller{

public function __construct(){

    parent::__construct();
    //se l'utente non è loggato faccio un redirect al login
	if(!isset($_SESSION['user'])) {
		redirect('/login');
	}
   

}
public function check()
{
      if(!is_ajax())
      {show_404();}
      
}

//form eseguito con successo
public function form_success()
{
	$this->load->view('template/head');
	$data['previous_page'] = $_SERVER['HTTP_REFERER'];
	if(isset($data['previous_page']))
	{
		$this->load->view('template/form_success',$data);
	}else{ die("Parametro previous_page nella funzione form_success non impostato");}	
}

//errore in un form
public function form_error($error)
{
	if(isset($error))
	{
        $this->load->view('template/head');
		$data['error'] = $error;
		$data['previous_page'] = $_SERVER['HTTP_REFERER'];
		$this->load->view('template/form_error',$data);
	}else{ die("Parametro error nella funzione form_error non impostato");}	
}
//----------------------------------------------------------------------- AJAX ---------------------------------------------------------------
//---- Luoghi ----
 //richiamata da ajax ritorna tag option della select
 function get_regioni()
 {
	 $regioni=$this->Luoghi_ajax_model->get_regioni();
	 //echo'<pre>'.var_export($responsabili,true).'<pre>'; //x debug
     echo '<option value="">Scegli la regione</option>'; //placeholder
     for ($i=0; $i<count($regioni); $i++)
     {
         echo '<option value='.$regioni[$i]['id'].'>'.$regioni[$i]['nome'].'</option>';
     }
 }
 
 //richiamata da ajax dato l'id ritorna le province della regione 
 function get_province()
 {
	 $id=$this->input->post('region_select');
	 //echo'<pre>'.var_export($responsabili,true).'<pre>'; //x debug
	 $province=$this->Luoghi_ajax_model->get_province($id);
     echo '<option value="" disabled selected>Scegli la provincia</option>'; //placeholder
     for ($i=0; $i<count($province); $i++)
     {
         echo '<option value='.$province[$i]['id'].'>'.$province[$i]['nome'].'</option>';
     }
 }

//richiamata da ajax dato l'id ritorna i comuni della provincia
 
function get_comuni()
 {
	 $id=$this->input->post('provincia_select');
	 //echo'<pre>'.var_export($responsabili,true).'<pre>'; //x debug
     $comuni=$this->Luoghi_ajax_model->get_comuni($id);
     echo '<option value="" disabled selected>Scegli il comune</option>';//placeholder
     for ($i=0; $i<count($comuni); $i++)
     {
         echo '<option value='.$comuni[$i]['id'].'>'.$comuni[$i]['nome'].'</option>';
     }
 }

//---- Tipi ----

//richiamata da ajax ritorna tag option della select
function get_tipi_associato()
{
	$tipi=$this->Tipi_ajax_model->get_tipi_associato();
	//echo'<pre>'.var_export($responsabili,true).'<pre>'; //x debug
    echo '<option value="">Tipo associato</option>'; //placeholder
    for ($i=0; $i<count($tipi); $i++)
    {
        echo '<option value='.$tipi[$i]['id'].'>'.$tipi[$i]['nome'].'</option>';
    }
}
//richiamata da ajax ritorna tag option della select
function get_cariche_direttivo()
{
	$cariche=$this->Tipi_ajax_model->get_cariche_direttivo();
	//echo'<pre>'.var_export($responsabili,true).'<pre>'; //x debug
    echo '<option value="">Carica direttivo</option>'; //placeholder
    for ($i=0; $i<count($cariche); $i++)
    {		
    echo '<option value='.$cariche[$i]['id'].'>'.$cariche[$i]['nome'].'</option>';
    }
}

//richiamata da ajax ritorna tag option della select
function get_responsabili()
{
	$responsabili = $this->Anagrafica_model->get_responsabili();
	//echo'<pre>'.var_export($responsabili,true).'<pre>'; //x debug
    echo '<option value="">Responsabile</option>'; //placeholder
    for ($i=0; $i<count($responsabili); $i++)
    {		
    echo '<option value='.$responsabili[$i]['id'].'>'.$responsabili[$i]['nome'].' '.$responsabili[$i]['cognome'].'</option>';
	}
}


//---- Calendario ----
//funzione globale richiamata da ajax salva i nuovi eventi del calendario
  public function save_event()
  {
            
     //load databse library
     $this->load->database();
     

        //predispongo l'array per la query
        $data = array(
            'title' => htmlentities($this->input->post('title')),
            'date' =>  $this->input->post('date'),
            'time' => null,
            'all_users' => $this->input->post('all_users'),
            'fk_utente' => $_SESSION['user']['id'],
            );
            //var_dump($data);
        //inserisco la persona nel db
        if($this->db->insert('appuntamenti', $data))
        { 
            echo "Inserimento avvenuto!";
        }
        else
        {
            echo "Inserimento fallito!";
        }
       
    }

    //funzione globale richiamata da ajax legge gli appuntamenti dal db - calendario
  public function get_events()
  {
     //load databse library
     $this->load->database();
     
        //recupero gli appuntamenti di tutti e del utente corrente dal db per tutti e i personali dell'utente      
         $query =  $this->db->query("SELECT title,DATE_FORMAT(date, '%d/%m/%Y') AS date,time 
            FROM appuntamenti
            WHERE `all_users` = 1 
            OR (`all_users`=0 AND `fk_utente`=".$_SESSION['user']['id'].")");
         echo json_encode($query->result());
    }

    //funzione globale richiamata da ajax rimuove un appuntamento dal db - calendario
  public function remove_event()
  {
     //load databse library
     $this->load->database();
     
     $title = $this->input->post('title');
     $date =  $this->input->post('date');
        //Cancello l'appuntamento creato dall'utente in quell giorno con quella descrizione

            $query_string = "DELETE FROM appuntamenti WHERE fk_utente =".$_SESSION['user']['id']." AND date = '".$date."' AND title ='".$title."'";
            $query= $this->db->query($query_string); 
            //$query = $this->db->delete('appuntamenti',array('fk_utente' => $_SESSION['user']['id'],'date' => $date,'title' => $title)); 
            //echo $query;
            if($this->db->affected_rows())
            {
                echo "Rimozione avvenuta con successo";
            }
            else{
                echo "Rimozione fallita";
                
                
            }

            
    }







}
