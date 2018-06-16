<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gestione_model extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            //carico la libreria per il db
            $this->load->database();
    }

    public function update_link_rapidi($link_website,$link_webmail,$link_webmail_pec,$link_facebook,$link_instagram,$link_youtube,$link_twitter,$link_home_banking)
    {
            $data = array(
                'link_website' => $link_website,
                'link_webmail' => $link_webmail,
                'link_webmail_pec' => $link_webmail_pec,
                'link_facebook' => $link_facebook,
                'link_instagram' => $link_instagram,
                'link_youtube' => $link_youtube,
                'link_twitter' => $link_twitter,
                'link_home_banking' => $link_home_banking,
            );
    
        $this->db->where('id','1');  // <---- x modifiche future in caso di più associazioni
        return $this->db->update('associazioni', $data);
        
        
    }
}