<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stampa_model extends CI_Model {

    //tb persone id	name	surname	address	phone	phone_ext	datebirth	email	avatar	fk_comune	fk_associato	fk_collaboratore
    //tb associati id	n_card	create_date	privacy	active	note	fk_tipo_associato	fk_cariche_direttivo

    public function __construct()
    {
            parent::__construct();
            //carico la libreria per il db
            $this->load->database();
    }

    public function get_associati($ordinamento)
    {
        if(isset($ordinamento))
        {
            $query = $this->db->query('SELECT 
            associati.n_card,
                        persone.name,
                        persone.surname,
                        persone.datebirth,
                        persone.address,
                        comuni.cap as cap,
                        comuni.name as comune,
                        province.name as provincia,
                        regioni.name as regione,
                        persone.fiscal_code,
                        persone.phone,
                        persone.email,
                        tipo_associato.name as tipo_associato,
                        cariche_direttivo.name as carica
            FROM persone
            INNER JOIN comuni
            on persone.fk_comune = comuni.id
            INNER JOIN province 
            on comuni.fk_provincia = province.id
            INNER JOIN regioni 
            on province.fk_regione = regioni.id
            INNER JOIN associati on persone.fk_associato = associati.id
            INNER JOIN tipo_associato on associati.fk_tipo_associato= tipo_associato.id
            LEFT JOIN cariche_direttivo on associati.fk_cariche_direttivo = cariche_direttivo.id 
            ORDER BY '.$ordinamento);
            return $query->result_array();
        }
    }
}