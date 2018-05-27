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
    
        $this->db->where('id','1');  // <---- x modifiche future in caso di più associazioni
        $this->db->update('associazioni', $data);
        //seleziono anche i dati anagrafici di base dell'associazione
        
        echo $this->db->affected_rows();
        
    }
}