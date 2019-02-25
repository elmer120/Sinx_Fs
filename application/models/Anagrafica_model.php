<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anagrafica_model extends CI_Model {

    //tb persone id	name	surname	address	phone	phone_ext	datebirth	email	avatar	fk_comuni	fk_associato	fk_collaboratore
    //tb associati id	n_card	create_date	privacy	active	note	fk_tipo_associato	fk_persone_maggiorenni
//CRUD create read update delete
    public function __construct()
    {
            parent::__construct();
            $this->load->library('session');
            $this->load->database();
    }
	//----------------------------------------CREATE-------------------------------------------------
	//popola la persona nel db ritorna l'id altrimenti -1
    public function create_person($persona)
    {
		if($persona!=null)
		{
			//inserisco la persona nel db
			if($this->db->insert('persone', $persona))
			{ 
				return $this->db->insert_id();
			}
			else
			{
				return -1;
			}
		}
		return null;
    }
    //popola socio e ritorna id altrimenti -1
    public function create_socio($socio)
    {
        //inserisco nel db l'associato
        if($this->db->insert('soci', $socio))
        {
			return $this->db->insert_id();
		}
		else{
			return -1;
		}

	}
	
	public function create_carica($carica_direttivo)
	{
		 //inserisco nel db l'associato
		 if($this->db->insert('soci_cariche_direttivo', $carica_direttivo))
		 {
			 return $this->db->insert_id();
		 }
		 else{
			 return -1;
		 }
	}
	public function create_tessera($tessere)
	{
		 //inserisco nel db l'associato
		 if($this->db->insert('tessere', $tessere))
		 {
			 return $this->db->insert_id();
		 }
		 else{
			 return -1;
		 }
	}
	
    

     //--------------------------------------READ--------------------------------------------------------------
     public function select_person($id)
     {
         //cerco se persona è collaboratore o no
         $query = $this->db->select('persone.fk_associato,persone.fk_collaboratore')
         ->from('persone')
         ->where('persone.id',$id)
         ->get();
         $object_result=$query->row();
         
         //esiste?
         if(isset($object_result))
         {
             //associato
             if(isset($object_result->fk_associato))
             {
                 $query = $this->db->query('SELECT
                             persone.id, 
                             persone.name,
                             persone.surname,
                             persone.datebirth as datebirth,
                             persone.fiscal_code,
                             regioni.id as r_id,
                             regioni.name as regione,
                             province.id as p_id,
                             province.name as provincia,
                             comuni.id as c_id,
                             comuni.name as comune,
                             persone.address,
                             persone.phone,
                             persone.phone_ext,
                             persone.email,
                             persone.fk_associato,
                             associati.n_card,
                             associati.privacy,
                             associati.active,
                             tipo_associato.name as tipo_associato,
                             persone_maggiorenni.name as carica,
                             associati.note
                 FROM persone
                 INNER JOIN comuni
                 on persone.fk_comuni = comuni.id
 
                 INNER JOIN province 
                 on comuni.fk_provincia = province.id
 
                 INNER JOIN regioni 
                 on province.fk_regione = regioni.id
 
                 INNER JOIN associati on persone.fk_associato = associati.id
                 INNER JOIN tipo_associato on associati.fk_tipo_associato= tipo_associato.id
                 LEFT JOIN persone_maggiorenni on associati.fk_persone_maggiorenni = persone_maggiorenni.id 
                 WHERE persone.id = '.$id);
             }
             else
             {
                 //collaboratore
                 $query = $this->db->query('SELECT 
                             persone.id, 
                             persone.name,
                             persone.surname,
                             persone.datebirth as datebirth,
                             persone.fiscal_code,
                             persone.fk_collaboratore,
                             regioni.id as r_id,
                             regioni.name as regione,
                             province.id as p_id,
                             province.name as provincia,
                             comuni.id as c_id,
                             comuni.name as comune,
                             persone.address,
                             persone.phone,
                             persone.phone_ext,
                             persone.email,
                             collaboratori.mansione,
                             collaboratori.note
                 FROM persone
                 INNER JOIN comuni
                 on persone.fk_comuni = comuni.id
 
                 INNER JOIN province 
                 on comuni.fk_provincia = province.id
 
                 INNER JOIN regioni 
                 on province.fk_regione = regioni.id
 
                 INNER JOIN collaboratori on persone.fk_collaboratore = collaboratori.id
             
                 WHERE persone.id = '.$id);
                 return $query->row();
             }
         }
         else
         {
             show_404();
         }
 
     }
    //---------------------------------------UPDATE-----------------------------------------------------
    private function update_person($person)
    {
        $this->db->where('id',$person->id);
        //aggiorno la persona nel db
        if($this->db->update('persone', $person))
        { 
            return true;
        }
        return false;
    }

    public function update_associato($obj_person,$obj_associato)
    {
        //istanzio la classe person
        $this->load->library('person',$obj_person);
        //istanzio la classe associato
        $this->load->library('associato',$obj_associato);
        if($this->update_person($this->person))
        {
            $this->db->where('id',$this->associato->id);
            //aggiorno l'associato nel db
            if($this->db->update('associati', $this->associato))
            { 
                return true;
            }
        }
        return false;
    }

    public function update_collaboratore($obj_person,$obj_collaboratore)
    {
        //istanzio la classe person
        $this->load->library('person',$obj_person);
        //istanzio la classe associato
        $this->load->library('collaboratore',$obj_collaboratore);
        if($this->update_person($this->person))
        { 
            $this->db->where('id',$this->collaboratore->id);
            //aggiorno l'associato nel db
            if($this->db->update('collaboratori', $this->collaboratore))
            { 
                return true;
            }
        }
        return false;
    }

    //---------------------------------------DELETE-----------------------------------------------------
    public function delete($id)
    {
             //cerco se persona è collaboratore o no
             $query = $this->db->select('persone.fk_associato,persone.fk_collaboratore')
             ->from('persone')
             ->where('persone.id',$id)
             ->get();
             $object_result=$query->row();
             
             //esiste?
             if(isset($object_result))
             {
                 //associato
                 if(isset($object_result->fk_associato))
                 {
                    //cancello prima la persona
                    if($this->delete_person($id))
                    {
                        //poi l'associato
                        $this->db->where('id',$object_result->fk_associato);
                        if($this->db->delete('associati'))
                        {
                            return true;
                        }
                    }
                 }
                else //collaboratore
                {
                    //associato
                    if(isset($object_result->fk_collaboratore))
                    {
                        
                        //cancello prima la persona
                        if($this->delete_person($id))
                        {
                            //poi il collaboratore
                            $this->db->where('id',$object_result->fk_collaboratore);
                            if($this->db->delete('collaboratori'))
                            {
                                return true;
                            }
                        }
                    }
                }
            }
            return false;
    }

    private function delete_person($id)
    {
        $this->db->where('id',$id);
        //aggiorno la persona nel db
        if($this->db->delete('persone'))
        { 
            return true;
        }
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
    public function get_persons() {
        $query = $this->db->query
			('SELECT DISTINCT
			persone.id,
			persone.nome,
			persone.cognome,
            persone.fk_comuni_nascita as comune_nascita,
			comuni.nome as comune_residenza,
            DATE_FORMAT(persone.data_nascita, "%d/%m/%Y") as data_nascita,
            soci_tipologie.nome as soci_tipologia,
            cariche_direttivo.nome as carica_direttivo,
            tessere.numero as tessera_numero,
            DATE_FORMAT(soci.certificato_scadenza_al, "%d/%m/%Y") as certificato_scadenza_al,
            DATE_FORMAT(soci.approvazione_data, "%d/%m/%Y") as approvazione_data,
            DATE_FORMAT(soci.quota_scadenza_al, "%d/%m/%Y") as quota_scadenza
			FROM   persone INNER JOIN comuni
			ON     persone.fk_comuni = comuni.id
			INNER JOIN province
			ON comuni.fk_province = province.id
			INNER JOIN regioni
			ON province.fk_regioni = regioni.id
			LEFT JOIN soci
			ON persone.fk_soci = soci.id
            INNER JOIN soci_tipologie
            ON soci.fk_soci_tipologie = soci.id
			LEFT JOIN tessere
			ON tessere.fk_soci = soci.id
            LEFT JOIN soci_cariche_direttivo
            ON soci_cariche_direttivo.fk_soci = soci.id
            LEFT JOIN cariche_direttivo
            ON cariche_direttivo.id = soci_cariche_direttivo.fk_cariche_direttivo
            ORDER BY persone.nome');
		
		return $query->result();
	}

	public function get_person($id) {

        $query = $this->db->query
			("SELECT DISTINCT
			persone.id,
			persone.nome,
			persone.cognome,
            persone.data_nascita as data_nascita,
            persone.fk_comuni_nascita as comune_nascita,
            persone.codice_fiscale,
            persone.partita_iva,
			comuni.nome as comune_residenza,
            persone.indirizzo,
            persone.privacy,
            persone.telefono,
            persone.telefono_ext,
            persone.email,
            persone.fk_responsabile,
            persone.iban,
            persone.banca,
            persone.note,
            soci.fk_soci_tipologie,
            soci.richiesta_data,
            soci.approvazione_data,
            soci.scadenza_data,
            soci.certificato_scadenza_al,
            cariche_direttivo.id as fk_cariche_direttivo,
            soci_cariche_direttivo.carica_direttivo_dal,
            soci_cariche_direttivo.carica_direttivo_al,
            tessere.numero,
            tessere.tessere_dal,
            tessere.tessere_al,
            tessere.tessere_tipo
			FROM   persone INNER JOIN comuni
			ON     persone.fk_comuni = comuni.id
			INNER JOIN province
			ON comuni.fk_province = province.id
			INNER JOIN regioni
			ON province.fk_regioni = regioni.id
			LEFT JOIN soci
			ON persone.fk_soci = soci.id
            LEFT JOIN soci_tipologie
            ON soci.fk_soci_tipologie = soci.id
			LEFT JOIN tessere
			ON tessere.fk_soci
            LEFT JOIN soci_cariche_direttivo
            ON soci_cariche_direttivo.fk_soci = soci.id
            LEFT JOIN cariche_direttivo
            ON cariche_direttivo.id = soci_cariche_direttivo.fk_cariche_direttivo
            WHERE persone.id = $id
			ORDER BY persone.nome");
		
		return $query->result();
    }


	//ritorna array lista delle persone responsabile > 18 anni
    public function get_responsabili()
    {
		//echo'<pre>'.var_export($cariche_direttivo,true).'<pre>'; //xdebug
	   $query = $this->db->query
			("SELECT persone.id,persone.nome,persone.cognome FROM persone WHERE (DATEDIFF(CURRENT_DATE,persone.data_nascita)) >= '1' ORDER BY persone.nome");
       return $query->result_array();  
    }

    //ritorna le persone presenti in anagrafica
    public function get_persons_rubrica()
    {
		$query = $this->db->query
			('SELECT 
			persone.id,
			tessere.numero as tessera_numero, 
			tessere.al as tessera_scadenza,
			persone.nome,
			persone.cognome,
			persone.indirizzo,
			comuni.nome as comune,
			province.nome as provincia,
			persone.telefono,
			persone.telefono_ext,
			persone.email,
			DATE_FORMAT(persone.data_nascita, "%d/%m/%Y") as data_nascita
			FROM   persone INNER JOIN comuni
			ON     persone.fk_comuni = comuni.id
			INNER JOIN province
			ON comuni.fk_province = province.id
			INNER JOIN regioni
			ON province.fk_regioni = regioni.id
			INNER JOIN soci
			ON persone.fk_soci = soci.id
			LEFT JOIN tessere
			ON tessere.fk_soci = soci.id
            ORDER BY persone.nome');
		
		return $query->result();
/*
SELECT DISTINCT persone.name,persone.surname,persone.phone,persone.phone_ext,
        persone.email,persone.address,comuni.name as comune,province.name as provincia,persone.fiscal_code,persone.datebirth
        FROM persone,regioni,province,comuni
        WHERE   persone.fk_comuni = comuni.id
        AND   comuni.fk_provincia=province.id
        AND   province.fk_regione = regioni.id
        AND   persone.fk_collaboratore!=0
        ORDER BY persone.name ASC

*/
        //not active record
        /*$query2 = $this->db->query('SELECT DISTINCT persone.name,persone.surname,persone.phone,persone.phone_ext,
        persone.email,persone.address,comuni.name as comune,province.name as provincia,persone.fiscal_code,persone.datebirth
        FROM persone,regioni,province,comuni
        WHERE   persone.fk_comuni = comuni.id
        AND   comuni.fk_provincia=province.id
        AND   province.fk_regione = regioni.id
        ORDER BY persone.name ASC');*/


        //solo collaboratori
        /*SELECT DISTINCT persone.name,persone.surname,persone.phone,persone.phone_ext,
        persone.email,persone.address,comuni.name as comune,province.name as provincia,persone.fiscal_code,persone.datebirth
        FROM persone,regioni,province,comuni
        WHERE   persone.fk_comuni = comuni.id
        AND   comuni.fk_provincia=province.id
        AND   province.fk_regione = regioni.id
        AND   persone.fk_collaboratore != 0
        ORDER BY persone.name ASC*/

        //solo associati
        /*
        SELECT DISTINCT persone.name,persone.surname,persone.phone,persone.phone_ext,
        persone.email,persone.address,comuni.name as comune,province.name as provincia,persone.fiscal_code,persone.datebirth
        FROM persone,regioni,province,comuni
        WHERE   persone.fk_comuni = comuni.id
        AND   comuni.fk_provincia=province.id
        AND   province.fk_regione = regioni.id
        AND   persone.fk_associato != 0 
        ORDER BY persone.name ASC
        */
    }

}
