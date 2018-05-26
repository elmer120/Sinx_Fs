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
}


public function check()
{
      if(!is_ajax())
      {show_404();}
      
}

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
            var_dump($data);
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

     //funzione globale richiamata da ajax rimouve un appuntamento dal db - calendario
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