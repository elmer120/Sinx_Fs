<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Associazione_model extends CI_Model {

    //tb persone id	nome	surnome	indirizzo	telefono	phone_ext	datebirth	email	avatar	fk_comune	fk_associato	fk_collaboratore
    //tb associati id	n_card	create_date	privacy	active	note	fk_tipo_associato	fk_cariche_direttivo

    public function __construct()
    {
            parent::__construct();
            //carico la libreria per il db
            $this->load->database();
    }

	public function update_dati_associazione($name,$tipo,$anno_fondazione,$logo,$address,$phone,$fiscal_code,$partita_iva,$vat,$email,$pec,$iscrizione,$fk_comune)
    {
        if($logo!=NULL)
        {
            $data = array(
				'nome' => $name,
				'tipo' => $tipo,
				'anno_fondazione' => $anno_fondazione,
				'indirizzo' => $indirizzo,
				'codice_fiscale' => $codice_fiscale,
				'vat' => $vat,
				'telefono' => $telefono,
				'telefono_ext' => $telefono_ext,
				'logo' => $logo,
                'email' => $email,
                'email_pec' => $email_pec,
				'registration' => $registration,
				'partita_iva' => $partita_iva,
                'fk_comuni' => $fk_comuni
            );
        }
        else
        {  //logo prende il valore di default dal db
                
                 $data = array(
					'nome' => $nome,
					'tipo' => $tipo,
					'anno_fondazione' => $anno_fondazione,
					'indirizzo' => $indirizzo,
					'codice_fiscale' => $codice_fiscale,
					'vat' => $vat,
					'telefono' => $telefono,
					'telefono_ext' => $telefono_ext,
					'email' => $email,
					'email_pec' => $email_pec,
					'registration' => $registration,
					'partita_iva' => $partita_iva,
					'fk_comuni' => $fk_comuni
				 );
        }
        var_dump($data);
		die();
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

        $query = $this->db->query('SELECT DISTINCT 
		associazioni.nome,
		associazioni.tipo,
		associazioni.anno_fondazione,
		associazioni.indirizzo,
		codice_fiscale,
		vat,
		telefono,
		telefono_ext,
		logo,
		email,
		email_pec,
		registration,
		partita_iva,
        comuni.cap,
        fk_comuni as c_id,
        comuni.nome as c_nome,
        province.id as p_id,
		province.sigla as p_sigla,
        province.nome as p_nome,
        regioni.id as r_id,
        regioni.nome as r_nome
        FROM associazioni,regioni,province,comuni
        WHERE associazioni.id = 1 
        AND   associazioni.fk_comuni = comuni.id
        AND   comuni.fk_province = province.id
        AND   province.fk_regioni = regioni.id');

        //recupero nome indirizzo e fk_comune
        $info_association = $query->row_array();
        //var_dump($info_association);
        
        if(isset($info_association))
        {
            //inserisco i dati nella var globale sessione
            return $_SESSION['association'] = $info_association;
        }
        else
        {
            die('Nessun risultato da dati associazione!');
            
        }
    }
}
