<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Associazione_model extends CI_Model {

    //tb persone id	name	surname	address	phone	phone_ext	datebirth	email	avatar	fk_comune	fk_associato	fk_collaboratore
    //tb associati id	n_card	create_date	privacy	active	note	fk_tipo_associato	fk_cariche_direttivo

    public function __construct()
    {
            parent::__construct();
            //carico la libreria per il db
            $this->load->database();
    }

    public function update_dati_associazione($name,$logo,$address,$phone,$fax,$fiscal_code,$email,$pec,$iban,$bic,$iscrizione,$fk_comune)
    {
        if($logo!=NULL)
        {
            $data = array(
                'name' => $name,
                'logo' => $logo,
                'address' => $address,
                'phone' => $phone,
                'fax' => $fax,
                'fiscal_code' => $fiscal_code,
                'email' => $email,
                'pec' => $pec,
                'iban' => $iban,
                'bic' => $bic,
                'iscrizione_odv_aps' => $iscrizione,
                'fk_comune' => $fk_comune
            );
        }
        else
        {
            $data = array(
                'name' => $name,
                 //logo prende il valore di default dal db
                'address' => $address,
                'phone' => $phone,
                'fax' => $fax,
                'fiscal_code' => $fiscal_code,
                'email' => $email,
                'pec' => $pec,
                'iban' => $iban,
                'bic' => $bic,
                'iscrizione_odv_aps' => $iscrizione,
                'fk_comune' => $fk_comune
            );
        }
    
        $this->db->where('id','1');  // <---- x modifiche future in caso di più associazioni
        if($this->db->update('associazioni', $data))
        {
            //aggiorno la sessione con i dati dell'associazione
            $this->load->model('associazione_model');
            $this->associazione_model->get_dati_associazione();
            return true;
        }
        return false;
        
    }

    public function get_dati_associazione()
    { 

        //seleziono i dati anagrafici di base dell'associazione

        $query = $this->db->query('SELECT DISTINCT associazioni.name,logo,address,phone,fax,fiscal_code,email,pec,iban,bic,iscrizione_odv_aps,
                                    comuni.cap,
                                    fk_comune as c_id,
                                    comuni.name c_name,
                                    province.id as p_id,
                                    province.name as p_name,
                                    regioni.id as r_id,
                                    regioni.name as r_name
                                    FROM associazioni,regioni,province,comuni
                                    WHERE associazioni.id=1 
                                    AND   associazioni.fk_comune=comuni.id
                                    AND   comuni.fk_provincia=province.id
                                    AND   province.fk_regione = regioni.id');

        //recupero nome indirizzo e fk_comune
        $info_association = $query->row_array();
        
        if(isset($info_association))
        {
            //inserisco i dati nella var globale sessione
            return $_SESSION['association']= $info_association;
        }
        else
        {
            echo 'Nessun risultato da dati associazione!';
        }
    }
}