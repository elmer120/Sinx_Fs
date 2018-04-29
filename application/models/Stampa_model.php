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
            $query_direttivo = $this->db->query('SELECT DISTINCT 
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
            FROM persone,associati,tipo_associato,regioni,province,comuni,cariche_direttivo
            WHERE persone.fk_associato=associati.id
            AND   associati.fk_tipo_associato = tipo_associato.id
            AND   persone.fk_comune = comuni.id
            AND   comuni.fk_provincia=province.id
            AND   province.fk_regione = regioni.id
            AND    associati.fk_cariche_direttivo = cariche_direttivo.id');
            $direttivo = $query_direttivo->result_array();

            $query_associati = $this->db->query('SELECT DISTINCT 
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
            tipo_associato.name as tipo_associato
            
            FROM persone,associati,tipo_associato,regioni,province,comuni
            WHERE persone.fk_associato=associati.id
            AND   associati.fk_tipo_associato = tipo_associato.id
            AND   persone.fk_comune = comuni.id
            AND   comuni.fk_provincia=province.id
            AND   province.fk_regione = regioni.id
            AND   associati.fk_cariche_direttivo is NULL');
            $associati = $query_associati->result_array();

            $result = array_merge($associati,$direttivo);

            asort($result);
            return $result;

        }
    }
}