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
          //METTERE L'ARRAY NELLE PROPRIETA' DELLA CLASSE
        $tipi_associato = [
          'id'=>[],
          'name'=>[],
        ];
        $this->db->select('id,name')->from('tipo_associato');
        $query_tipo_associato= $this->db->get();
        foreach ($query_tipo_associato->result() as $row)
        {
            array_push($tipi_associato['id'],$row->id);
            array_push($tipi_associato['name'],$row->name);

        }
        return $tipi_associato;
    }

    //ritorna array lista dei tipi di carica del direttivo
    public function get_cariche_direttivo()
    {
      //METTERE L'ARRAY NELLE PROPRIETA' DELLA CLASSE
       $cariche_direttivo = [
         'id'=>[],
         'name'=>[],
       ];
       $this->db->select('id,name')->from('cariche_direttivo');
      $query_cariche= $this->db->get();
      foreach ($query_cariche->result() as $row)
       {
         array_push($cariche_direttivo['id'],$row->id);
         array_push($cariche_direttivo['name'],$row->name);
    
       }
       return $cariche_direttivo;  
    }

}




