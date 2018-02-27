<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {


    public function __construct()
    {
            parent::__construct();
            $this->load->library('session');
            $this->load->database();
    }
    
    public function create_user()
    {
        $data['firstName'] = $userData['firstName'];
        $data['lastName'] = $userData['lastName'];
        $data['teamId'] = (int) $userData['teamId'];
        $data['isAdmin'] = (int) $userData['isAdmin'];
        $data['avatar'] = $this->getAvatar();
        $data['email'] = $userData['email'];
        $data['tagline'] = "Click here to edit tagline.";
        $data['password'] = sha1($userData['password1']);
        return $this->db->insert('user',$data);
    }
    
    //Controlla le credenziali dell'utente
    public function validate_user($username,$password)
    {
        $this->db->select('*');
        $this->db->from('utenti');
        $this->db->where('username',$username);
        $query = $this->db->get();
        $result_username = $query->row();
        
        //se l'username esiste
        if(isset($result_username))
        {
            //controllo la password
            $this->db->select('*');
            $this->db->from('utenti');
            $this->db->where('password',$password);
            $query = $this->db->get();
            $result_password = $query->row();
            
            //se la password esiste
            if(isset($result_password))
            {
                //valorizzo la sessione

            }
            
        }
        else
        {
            return FALSE;
        }


        foreach ($query->result_array() as $row)
        {
            echo $row['title'];
            echo $row['name'];
            echo $row['email'];
        }
    }

    public function delete_user()
    {

    }

}