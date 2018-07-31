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

    //ritorna il numero totale di persone presenti in anagrafica
    public function get_persons_count($pre_filter = NULL) {
        return $this->db->count_all("persone");
    }


    //se ricerca è null e pre_filter è null
		//ritorna totale // return $this->db->count_all("persone");
		//se ricerca è null e pre_filter è valorizzato
		//ritorno totale pre_filter ok 
		//se ricerca è valorizzato e pre_filter è valorizzato
		//ritorno totale pre_filter e filter (ricercato)

    //ritorna il numero totale filtrato di persone presenti in anagrafica
    public function get_persons_filter_count($research = NULL,$pre_filter = NULL) {
        //se ricerca è null e pre_filter è null
        if(empty($research) && empty($pre_filter))
        {
            //ritorna totale non ricercato/filtrato
            return $this->db->count_all("persone");
        }
        //se ricerca è null e pre_filter è valorizzato
        //oppure
        //se ricerca è valorizzato e pre_filter è valorizzato
        switch ($pre_filter)
        {
                //tutti
                case NULL:
                $pre_filter = "persone.fk_comune = comuni.id";
                break;
                
                //solo associati
                case 1:
                $pre_filter = "persone.fk_comune = comuni.id AND persone.fk_associato != 0";
                break;
                
                //solo collaboratori
                case 2:
                $pre_filter = "persone.fk_comune = comuni.id AND persone.fk_collaboratore != 0";
                break;
        }
        
        $query = $this->db->select('persone.name,persone.surname,persone.phone,persone.phone_ext,
        persone.email,persone.address,comuni.name as comune,province.name as provincia,persone.datebirth')
        ->from('persone')
        ->join('comuni',$pre_filter)

        ->join('province','comuni.fk_provincia=province.id')
        
        ->join('regioni','province.fk_regione = regioni.id')
        
        ->like('persone.name',$research)
        ->or_like('persone.surname', $research)
        ->or_like('persone.email', $research)
        ->or_like('persone.datebirth', $research)
        ->or_like('comuni.name', $research)
        ->or_like('province.name', $research)
        ->order_by('persone.name', 'ASC');

        return $this->db->count_all_results();
    }

    //ritorna le persone presenti in anagrafica limitate dalla paginazione
    public function get_persons_filter($start,$limit,$research = NULL, $pre_filter = NULL)
    {
        //imposto limite per paginazione
        $this->db->limit($limit,$start);
        //se ricerca è null e pre_filter è valorizzato
        //oppure
        //se ricerca è valorizzato e pre_filter è valorizzato
        switch ($pre_filter)
        {
                //tutti
                case NULL:
                $pre_filter = "persone.fk_comune = comuni.id";
                break;
                
                //solo associati
                case 1:
                $pre_filter = "persone.fk_comune = comuni.id AND persone.fk_associato != 0";
                break;
                
                //solo collaboratori
                case 2:
                $pre_filter = "persone.fk_comune = comuni.id AND persone.fk_collaboratore != 0";
                break;
        }
        $query = $this->db->select('persone.name,persone.surname,persone.phone,persone.phone_ext,
        persone.email,persone.address,comuni.name as comune,province.name as provincia,DATE_FORMAT(persone.datebirth, "%d/%m/%Y")')
        ->from('persone')
        ->join('comuni',$pre_filter)

        ->join('province','comuni.fk_provincia=province.id')
        
        ->join('regioni','province.fk_regione = regioni.id')
       

        ->like('persone.name',$research)
        ->or_like('persone.surname', $research)
        ->or_like('persone.email', $research)
        ->or_like('persone.datebirth', $research)
        ->or_like('comuni.name', $research)
        ->or_like('province.name', $research)
        ->order_by('persone.name', 'ASC')
        ->get();
/*
SELECT DISTINCT persone.name,persone.surname,persone.phone,persone.phone_ext,
        persone.email,persone.address,comuni.name as comune,province.name as provincia,persone.fiscal_code,persone.datebirth
        FROM persone,regioni,province,comuni
        WHERE   persone.fk_comune = comuni.id
        AND   comuni.fk_provincia=province.id
        AND   province.fk_regione = regioni.id
        AND   persone.fk_collaboratore!=0
        ORDER BY persone.name ASC

*/
        //not active record
        /*$query2 = $this->db->query('SELECT DISTINCT persone.name,persone.surname,persone.phone,persone.phone_ext,
        persone.email,persone.address,comuni.name as comune,province.name as provincia,persone.fiscal_code,persone.datebirth
        FROM persone,regioni,province,comuni
        WHERE   persone.fk_comune = comuni.id
        AND   comuni.fk_provincia=province.id
        AND   province.fk_regione = regioni.id
        ORDER BY persone.name ASC');*/


        //solo collaboratori
        /*SELECT DISTINCT persone.name,persone.surname,persone.phone,persone.phone_ext,
        persone.email,persone.address,comuni.name as comune,province.name as provincia,persone.fiscal_code,persone.datebirth
        FROM persone,regioni,province,comuni
        WHERE   persone.fk_comune = comuni.id
        AND   comuni.fk_provincia=province.id
        AND   province.fk_regione = regioni.id
        AND   persone.fk_collaboratore != 0
        ORDER BY persone.name ASC*/

        //solo associati
        /*
        SELECT DISTINCT persone.name,persone.surname,persone.phone,persone.phone_ext,
        persone.email,persone.address,comuni.name as comune,province.name as provincia,persone.fiscal_code,persone.datebirth
        FROM persone,regioni,province,comuni
        WHERE   persone.fk_comune = comuni.id
        AND   comuni.fk_provincia=province.id
        AND   province.fk_regione = regioni.id
        AND   persone.fk_associato != 0 
        ORDER BY persone.name ASC
        */


        return $query->result_array();
    }

}