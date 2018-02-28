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
    
    public function create_user($username,$password,$name,$image=NULL,$email=NULL,$level)
    {
        $data = array(
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT), //algoritmo bcrypt
            'name' => $name,
            'image' => $image,
            'email' => $email,
            'level' => $level,
            'create_date' => date("Y-m-d H:i:s"),
            'last_access' => NULL,
    );
    
    $this->db->insert('utenti', $data);
    
    }
    
    //Controlla le credenziali dell'utente
    public function validate_user($username,$password)
    {
        //seleziono l'utente
        $this->db->select('username,password');
        $this->db->from('utenti');
        $this->db->where('username',$username);
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
                $this->db->set('last_access', date("Y-m-d H:i:s"));
                $this->db->where('username', $username);
                $this->db->update('utenti');
                //valorizzo la sessione
                $this->set_session($username);

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

    public function delete_user()
    {

    }

    //popolo la sessione
    private function set_session($username)
    {
        //seleziono l'utente
        $this->db->select('*');
        $this->db->from('utenti');
        $this->db->where('username',$username);
        $query = $this->db->get();
        //inserisco i dati nella var globale sessione
        $_SESSION['user']=serialize($query->row_array());
        
    }

}