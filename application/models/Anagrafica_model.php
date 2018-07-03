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

    //ritorna il numero di persone presenti in anagrafica
    public function get_persons_count() {
        return $this->db->count_all("persone");
    }

    

    //ritorna le persone presenti in anagrafica limitate dalla paginazione
    public function get_all_persons($start,$limit)
    {
        $this->db->limit($limit,$start); 
        $query = $this->db->select('persone.name,persone.surname,persone.phone,persone.phone_ext,
        persone.email,persone.address,comuni.name as comune,province.name as provincia,persone.datebirth')
        ->from('persone')
        ->join('comuni','persone.fk_comune = comuni.id')

        ->join('province','comuni.fk_provincia=province.id')
        
        ->join('regioni','province.fk_regione = regioni.id')
        
        ->order_by('persone.name', 'ASC')
        ->get();

        
       
        //not active record
        /*$query2 = $this->db->query('SELECT DISTINCT persone.name,persone.surname,persone.phone,persone.phone_ext,
        persone.email,persone.address,comuni.name as comune,province.name as provincia,persone.fiscal_code,persone.datebirth
        FROM persone,regioni,province,comuni
        WHERE   persone.fk_comune = comuni.id
        AND   comuni.fk_provincia=province.id
        AND   province.fk_regione = regioni.id
        ORDER BY persone.name ASC');*/
        

        return $query->result_array();
    }


    //ritona i club della provincia richiesti dalla paginazione 
    public function Get_clubs($prov,$limit,$start)
    {       
        /*$query = $this->db->query('SELECT DISTINCT persone.name,persone.surname,persone.phone,persone.phone_ext,
        persone.email,persone.address,comuni.name as comune,province.name as provincia,persone.fiscal_code,persone.datebirth
        FROM persone,regioni,province,comuni
        WHERE   persone.fk_comune = comuni.id
        AND   comuni.fk_provincia=province.id
        AND   province.fk_regione = regioni.id
        ORDER BY persone.name ASC');
        return $query->result_array();
                  
              //per ogni comune recupero tutti i club
              $query = $this->db->select('persone.name,persone.surname,persone.phone,persone.phone_ext,
              persone.email,persone.address,comuni.name as comune,province.name as provincia,persone.fiscal_code,persone.datebirth')
              ->from('persone,regioni,province,comuni')
              ->join('persone','persone.fk_comune = comuni.id')
              ->join('comuni','comuni.fk_provincia=province.id')
              ->join('province','province.fk_regione = regioni.id')
              ->order_by('persone.name', 'ASC')
              ->get();
              
              
              ->limit($limit, $start); //impostato limite per la paginazione
              $query_club_prov=$this->db->get();
              
              //ciclo i club
              foreach ($query_club_prov->result() as $rows) 
              {      
                array_push($clubs ['denominazione'], $rows->denominazione);
                //array_push($clubs ['comune'], $nome_comuni[$index]);
                array_push($clubs ['mail'] , $rows->mail);
                array_push($clubs ['url_sito'] , $rows->url_sito);
                array_push($clubs ['facebook'] , $rows->facebook);
                array_push($clubs ['telefono'] , $rows->telefono);
                array_push($clubs ['logo'] , $rows->logo);
                array_push($clubs ['membri'] , $rows->membri);
                
                $index++;
              }
        
        
        return $clubs;*/
        
        
    }


}