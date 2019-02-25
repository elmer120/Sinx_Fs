<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipi_ajax_model extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            $this->load->database();
    }

    //ritorna array lista dei tipi di associato
    public function get_tipi_associato()
    {
			//echo'<pre>'.var_export($cariche_direttivo,true).'<pre>'; //xdebug
        $this->db->select('id,nome')->from('soci_tipologie');
        $query = $this->db->get();
        return $query->result_array();
    }

    //ritorna array lista dei tipi di carica del direttivo
    public function get_cariche_direttivo()
    {
			//echo'<pre>'.var_export($cariche_direttivo,true).'<pre>'; //xdebug
      $this->db->select('id,nome')->from('cariche_direttivo');
      $query= $this->db->get();
       return $query->result_array();  
    }

}




