<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anagrafica_model extends CI_Model {

    //tb persone id	name	surname	address	phone	phone_ext	datebirth	email	avatar	fk_comune	fk_associato	fk_collaboratore
    //tb associati id	n_card	create_date	privacy	active	note	fk_tipo_associato	fk_cariche_direttivo

    public function __construct()
    {
            parent::__construct();
            $this->load->library('session');
            $this->load->database();
    }
    
    public function create_associato($n_card,$privacy,$active,$note,$name,$surname,$fiscal_code,$address,$phone,$phone_ext,$datebirth,$email,$avatar,$fk_comune)
    {
        $data = array(
            'n_card' => $n_card,
            'privacy' => $privacy,
            'active' => $active,
            'note' => $note,
        );
        $fk_associato=$this->db->insert_id('associato', $data);
        $this->create_person($fk_comune,$fk_associato,NULL,$name,$surname,$fiscal_code,$address,$phone,$phone_ext,$datebirth,$email,$avatar);
    }

    public function create_collaboratore($mansione,$note,$name,$surname,$fiscal_code,$address,$phone,$phone_ext,$datebirth,$email,$avatar)
    {
        $data = array(
            'mansione' => $mansione,
            'note' => $note,
        );
        $fk_collaboratore=$this->db->insert_id('collaboratori', $data);
        $this->create_person($fk_comune,NULL,$fk_collaboratore,$name,$surname,$fiscal_code,$address,$phone,$phone_ext,$datebirth,$email,$avatar);
    }


    private function create_person($fk_comune,$fk_associato=NULL,$fk_collaboratore=NULL,$name,$surname,$fiscal_code,$address,$phone,$phone_ext,$datebirth,$email,$avatar)
    {

        $data = array(
            'name' => $name,
            'surname' => $surname,
            'fiscal_code' => $fiscal_code,
            'address' => $address,
            'phone' => $phone,
            'phone_ext' => $phone_ext,
            'datebirth' => $datebirth,
            'email' => $email,
            'avatar' => $avatar,
            'create_date'=>date("Y-m-d H:i:s"),
            'fk_comune' => $fk_comune,
            'fk_collaboratore' => $fk_collaboratore,
            'fk_associato' => $fk_associato
    );
    
    $this->db->insert('persone', $data);
    
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