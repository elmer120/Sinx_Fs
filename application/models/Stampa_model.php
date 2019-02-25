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
			//libro soci tesserati e non
			$query = $this->db->query
			('SELECT tessere.numero as tessera_numero,
			persone.nome,
			persone.cognome,
			DATE_FORMAT(persone.data_nascita, "%d/%m/%Y") as data_nascita,
			persone.comune_nascita,
			persone.indirizzo,
			comuni.cap as cap,
			comuni.nome as comune,
			province.nome as provincia,
			regioni.nome as regione,
			persone.email,
			persone.codice_fiscale,
			persone.telefono,
			soci_tipologie.nome as tipo_socio, 
			carica_direttivo.nome as carica_direttivo
			FROM   persone INNER JOIN comuni
			ON     persone.fk_comuni = comuni.id
			INNER JOIN province
			ON comuni.fk_province = province.id
			INNER JOIN regioni
			ON province.fk_regioni = regioni.id
			INNER JOIN soci
			ON persone.fk_soci = soci.id
			INNER JOIN soci_tipologie
			ON soci.fk_soci_tipologie = soci_tipologie.id
			LEFT JOIN tessere
			ON tessere.fk_soci = soci.id
			LEFT JOIN soci_carica_direttivo
			on soci.id = soci_carica_direttivo.fk_soci
			LEFT JOIN carica_direttivo
			on soci_carica_direttivo.fk_carica_direttivo = carica_direttivo.id
            ORDER BY '.$ordinamento);
            return $query->result_array();
        }
    }
}
