<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

//tb utenti
//username
//password
//name
//image
//email
//level
//create_date
//last_access

    public function __construct()
    {
            parent::__construct();
            $this->load->library('session');
            $this->load->database();
    }
    
    //crea utente
    public function create_user($name,$password,$image=NULL,$email=NULL,$level)
    {
        $data = array(
            'nome' => $name,
            'password' => password_hash($password, PASSWORD_DEFAULT), //algoritmo bcrypt
			'immagine' => $image,
			'email' => $email,
			'livello' => $level,
			'creato_al' => date("Y-m-d H:i:s"),
			'aggiornato_al' => date("Y-m-d H:i:s"),			
			'remember_token' => 'test',
			'fk_associazioni' => 1,
			'ultimo_accesso' => date("Y-m-d H:i:s")
    );
    $this->db->insert('utenti', $data);
    
    }
    
    //Controlla le credenziali dell'utente
    public function validate_user($name,$password)
    {
        //seleziono l'utente
        $this->db->select('nome,password');
        $this->db->from('utenti');
        $this->db->where('nome',$name);
        $query = $this->db->get();
        $result_obj = $query->row();
        
        //se ci sono risultati
        if(isset($result_obj))
        {
            $result_password=$result_obj->password;

            //se la password coincide
            if(password_verify($password,$result_password))
            {
                //aggiorno l'ultimo accesso
                $this->db->set('ultimo_accesso', date("Y-m-d H:i:s"));
                $this->db->where('nome', $name);
                $this->db->update('utenti');
                //valorizzo la sessione con l'utente
                $this->set_session($name);
                //valorizzo la sessione and con i dati dell'associazione
                $this->load->model('associazione_model');
                $this->associazione_model->get_dati_associazione();
                return TRUE;
            }
            else
            {
                return FALSE;
            }
            
        }
        else
        {
            return FALSE;
        }
    }

    //elimina utente
    public function delete_user()
    {

    }

    //popolo la sessione
    private function set_session($name)
    {
        //seleziono l'utente
        $this->db->select('*');
        $this->db->from('utenti');
        $this->db->where('nome',$name);
        $query = $this->db->get();
        //inserisco i dati nella var globale sessione
        $_SESSION['user'] = $query->row_array();
    }

}
