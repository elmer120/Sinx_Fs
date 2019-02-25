<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Luoghi_ajax_model extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            $this->load->database();
    }

    //ritorna array lista di tutte le regioni
    public function get_regioni()
    {
        $this->db->select('id,nome')->from('regioni');
        $query= $this->db->get();
        return $query->result_array();
    }

    //dato l'id di una regiona ritorna array lista province
    public function get_province($id)
    {
       if(!empty($id))
       {$this->db->select('id,nome,sigla')->where('fk_regioni',$id)->from('province');}
       else
       {
        $this->db->select('id,nome,sigla')->from('province');
       }
      $query= $this->db->get();
      return $query->result_array();  
    }
    
     //dato l'id di una provincia ritorna la array lista dei comuni
    public function get_comuni($id)
    {
      if(isset($id))
      {$this->db->select('id,nome,cap')->where('fk_province',$id)->from('comuni');}
      else
      {$this->db->select('id,nome,cap')->from('comuni');}
			
			$query= $this->db->get();
      return $query->result_array();  
    }

}




