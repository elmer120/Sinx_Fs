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
        /* 
        SELECT DISTINCT associati.n_card,persone.name,persone.surname,regioni.name,province.name,comuni.name,comuni.cap,persone.address,persone.fiscal_code,tipo_associato.name
        FROM persone
        INNER JOIN associati ON persone.fk_associato=associati.id
        INNER JOIN comuni ON persone.fk_comune=comuni.id
        INNER JOIN province ON comuni.fk_provincia=province.id
        INNER JOIN regioni ON province.fk_regione=regioni.id
        INNER JOIN tipo_associato ON associati.fk_tipo_associato=tipo_associato.id */

        
       /*  $sql='SELECT DISTINCT associati.n_card,persone.name,persone.surname,regioni.name as r_name,province.name as p_name,comuni.name as c_name,
        comuni.cap,persone.address,persone.fiscal_code,tipo_associato.name as ta_name
        FROM persone
        INNER JOIN associati ON persone.fk_associato=associati.id
        INNER JOIN comuni ON persone.fk_comune=comuni.id
        INNER JOIN province ON comuni.fk_provincia=province.id
        INNER JOIN regioni ON province.fk_regione=regioni.id
        INNER JOIN tipo_associato ON associati.fk_tipo_associato=tipo_associato.id'; */
        //$query = $this->db->query($sql);

        if(isset($ordinamento))
        {
            /*$this->db->select('associati.n_card,persone.name,persone.surname,persone.datebirth,regioni.name as r_name,province.name as p_name,comuni.name as c_name,
                            comuni.cap,persone.address,persone.fiscal_code,tipo_associato.name as ta_name');
            $this->db->from('persone');
            $this->db->join('comuni','persone.fk_comune=comuni.id','inner');
            $this->db->join('province','comuni.fk_provincia=province.id','inner');
            $this->db->join('regioni','province.fk_regione=regioni.id','inner');
            $this->db->join('associati','persone.fk_associato=associati.id','inner');
            $this->db->join('tipo_associato','associati.fk_tipo_associato=tipo_associato.id','inner');
            $this->db->order_by($ordinamento,'ASC');
            $query = $this->db->get();*/
           

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

            return array_merge($associati,$direttivo);



        }
    }
}