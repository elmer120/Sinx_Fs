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

    public function get_associati()
    {
        /* 
        SELECT DISTINCT associati.n_card,persone.name,persone.surname,regioni.name,province.name,comuni.name,comuni.cap,persone.address,persone.fiscal_code,tipo_associato.name
        FROM persone
        INNER JOIN associati ON persone.fk_associato=associati.id
        INNER JOIN comuni ON persone.fk_comune=comuni.id
        INNER JOIN province ON comuni.fk_provincia=province.id
        INNER JOIN regioni ON province.fk_regione=regioni.id
        INNER JOIN tipo_associato ON associati.fk_tipo_associato=tipo_associato.id */
        
        $this->db->select('associati.n_card,persone.name,persone.surname,persone.datebirth,regioni.name as r_name,province.name as p_name,comuni.name as c_name,
                            comuni.cap,persone.address,persone.fiscal_code,tipo_associato.name as ta_name');
        $this->db->from('persone');
        $this->db->join('comuni','persone.fk_comune=comuni.id','inner');
        $this->db->join('province','comuni.fk_provincia=province.id','inner');
        $this->db->join('regioni','province.fk_regione=regioni.id','inner');
        $this->db->join('associati','persone.fk_associato=associati.id','inner');
        $this->db->join('tipo_associato','associati.fk_tipo_associato=tipo_associato.id','inner');
        $query = $this->db->get();

       /*  $sql='SELECT DISTINCT associati.n_card,persone.name,persone.surname,regioni.name as r_name,province.name as p_name,comuni.name as c_name,
        comuni.cap,persone.address,persone.fiscal_code,tipo_associato.name as ta_name
        FROM persone
        INNER JOIN associati ON persone.fk_associato=associati.id
        INNER JOIN comuni ON persone.fk_comune=comuni.id
        INNER JOIN province ON comuni.fk_provincia=province.id
        INNER JOIN regioni ON province.fk_regione=regioni.id
        INNER JOIN tipo_associato ON associati.fk_tipo_associato=tipo_associato.id'; */
        //$query = $this->db->query($sql);
       
        
        return $query->result_array();

    }
}