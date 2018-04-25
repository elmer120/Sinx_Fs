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
    
    //popola associato nel db ritorna bool
    public function create_associato($n_card=NULL,$privacy=NULL,$active=NULL,
                                    $note=NULL,$name=NULL,$surname=NULL,
                                    $fiscal_code=NULL,$address=NULL,$phone=NULL,
                                    $phone_ext=NULL,$datebirth=NULL,$email=NULL,
                                    $avatar=NULL,$fk_comune=NULL,$fk_tipo_associato=NULL,
                                    $fk_collaboratore=NULL,$fk_cariche_direttivo=NULL)
    {
        $fk_collaboratore=NULL;
        //se l'associato non fa parte del direttivo, imposto l'fk a null
        if($fk_cariche_direttivo=="Nessuna"){$fk_cariche_direttivo=NULL;}
        //predispongo l'array per la query
        $data = array(
            'n_card' => $n_card,
            'privacy' => $privacy,
            'active' => $active,
            'note' => $note,
            'fk_tipo_associato' => $fk_tipo_associato,
            'fk_cariche_direttivo' => $fk_cariche_direttivo,
        );
        //inserisco nel db l'associato
        if($this->db->insert('associati', $data))
        {
            //recupero l'id
            $fk_associato= $this->db->insert_id();
            if($fk_associato!=0)
            {
                //inserisco la persona
                if($this->create_person($fk_comune,$fk_associato,$fk_collaboratore,
                                        $name,$surname,$fiscal_code,$address,$phone,
                                        $phone_ext,$datebirth,$email,$avatar))
                {
                    return true;
                }
            }
            
        }
        return false;
    }

    //popola il collaboratore nel db ritorna bool
    public function create_collaboratore($mansione=NULL,$note=NULL,
                                        $name=NULL,$surname=NULL,$fiscal_code=NULL,
                                        $address=NULL,$phone=NULL,$phone_ext=NULL,
                                        $datebirth=NULL,$email=NULL,$avatar=NULL,
                                        $fk_comune=NULL,$fk_tipo_associato=NULL,$fk_collaboratore=NULL,
                                        $fk_cariche_direttivo=NULL)
    {
        $fk_associato=NULL;
        $fk_cariche_direttivo=NULL;
        //predispongo l'array per la query
        $data = array(
            'mansione' => $mansione,
            'note' => $note,
        );
         //inserisco nel db il collaboratore
        if($this->db->insert('collaboratori', $data))
        {
            //recupero l'id
            $fk_collaboratore=$this->db->insert_id();
            if($fk_collaboratore!=0)
            {
                //inserisco la persona (null fk_tipo_associato)
                if($this->create_person($fk_comune,$fk_associato,$fk_collaboratore,$name,$surname,$fiscal_code,$address,$phone,$phone_ext,$datebirth,$email,$avatar))
                {
                    return true;
                }
            }
        }
        return false;
    }

    //popola la persona nel db ritorna bool
    private function create_person($fk_comune=NULL,$fk_associato=NULL,$fk_collaboratore=NULL,
                                    $name=NULL,$surname=NULL,$fiscal_code=NULL,
                                    $address=NULL,$phone=NULL,$phone_ext=NULL,
                                    $datebirth=NULL,$email=NULL,$avatar=NULL)
    {
        //predispongo l'array per la query
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
    //inserisco la persona nel db
    if($this->db->insert('persone', $data))
    { return true;}
    return false;
    }

    //ritorna tutte le persone inserite in anagrafica
    private function get_all_persons()
    {
        /*$this->db->select('associati.n_card,persone.name,persone.surname,persone.datebirth,regioni.name as r_name,province.name as p_name,comuni.name as c_name,
        comuni.cap,persone.address,persone.fiscal_code,tipo_associato.name as ta_name');
        $this->db->from('persone');
        $this->db->join('comuni','persone.fk_comune=comuni.id','inner');
        $this->db->join('province','comuni.fk_provincia=province.id','inner');
        $this->db->join('regioni','province.fk_regione=regioni.id','inner');
        $this->db->join('associati','persone.fk_associato=associati.id','inner');
        $this->db->join('tipo_associato','associati.fk_tipo_associato=tipo_associato.id','inner');
        */
        $this->db->select('');
        $query = $this->db->get();
        return $query->result_array();

    }


}