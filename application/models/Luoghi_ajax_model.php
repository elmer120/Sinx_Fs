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
          //METTERE L'ARRAY NELLE PROPRIETA' DELLA CLASSE
        $regioni = [
          'id'=>[],
          'name'=>[],
        ];
        $this->db->select('id,name')->from('regioni');
        $query_all_regions= $this->db->get();
        foreach ($query_all_regions->result() as $row)
        {
            array_push($regioni['id'],$row->id);
            array_push($regioni['name'],$row->name);

        }
        return $regioni;
    }

    //dato l'id di una regiona ritorna array lista province
    public function get_province($id)
    {
      //METTERE L'ARRAY NELLE PROPRIETA' DELLA CLASSE
       $province = [
         'id'=>[],
         'name'=>[],
       ];
       if(isset($id))
       {$this->db->select('id,name')->where('fk_regione',$id)->from('province');}
       else
       {
        $this->db->select('id,name')->from('province');
       }
      
      $query_provinces= $this->db->get();
      foreach ($query_provinces->result() as $row)
       {
         array_push($province['id'],$row->id);
         array_push($province['name'],$row->name);
    
       }
       return $province;  
    }
    
     //dato l'id di una provincia ritorna la array lista dei comuni
    public function get_comuni($id)
    {
      //METTERE L'ARRAY NELLE PROPRIETA' DELLA CLASSE
      $comuni = [
        'id'=>[],
        'name'=>[],
        'cap'=>[],
      ];
      if(isset($id))
      {$this->db->select('id,name,cap')->where('fk_provincia',$id)->from('comuni');}
      else
      {$this->db->select('id,name,cap')->from('comuni');}
      $query_comuni= $this->db->get();
      foreach ($query_comuni->result() as $row)
      {
        array_push($comuni['id'],$row->id);
        array_push($comuni['name'],$row->name);
        array_push($comuni['cap'],$row->cap);
      }
      return $comuni;  
    }

}




