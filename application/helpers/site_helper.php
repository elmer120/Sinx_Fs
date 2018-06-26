<?php defined('BASEPATH') OR exit('No direct script access allowed');

//dato l'fk_comune ritorna l'oggetto: "cap comune provincia regione"
if ( ! function_exists('get_all_location'))
{
   /* function get_all_location($fk_comune = NULL)
    {
             //get main CodeIgniter object
     $ci=& get_instance();
       
     //load databse library
     $ci->load->database();
        /* SELECT comuni.cap,comuni.name,province.name,regioni.name
        FROM regioni
        INNER JOIN province
        ON regioni.id=province.fk_regione
        INNER JOIN comuni
        ON province.id=comuni.fk_provincia
        WHERE  comuni.id='7131' */

      /*  if(isset($fk_comune))
        {
        //con fk_comune recupero il cap, id e nome di comune provincia e regione 
        $ci->db->select('comuni.cap,comuni.id as c_id,comuni.name as c_name,province.id as p_id,province.name as p_name,regioni.id as r_id,regioni.name as r_name');
        $ci->db->from('regioni');
        $ci->db->join('province','regioni.id = province.fk_regione','inner');
        $ci->db->join('comuni','province.id=comuni.fk_provincia','inner');
        $ci->db->where('comuni.id',$fk_comune);
        $query = $ci->db->get();
        
       $result_array = $query->result_array();
       //se ci sono risultati
        if(isset($result_array))
            {
               return $result_array;
            }
            echo 'Nessun risultato!';
        }
        
            echo 'parametro id comune assente!';
    }*/
}

//dato l'fk_comune ritorna l'array: con info dell'associazione
if ( ! function_exists('info_association'))
{
    /*function info_association ($fk_comune = NULL)
    {
     //get main CodeIgniter object
     $ci=& get_instance();
       
     //load databse library
     $ci->load->database();

        //seleziono anche i dati anagrafici di base dell'associazione
        $ci->db->select('name,logo,address,phone,fax,fk_comune,fiscal_code,email,pec,iban,bic,iscrizione_odv_aps');
        $ci->db->from('associazioni');
        $ci->db->where('id','1');  // <---- x modifiche future in caso di più associazioni
        $query = $ci->db->get();
        
        //recupero nome indirizzo e fk_comune
        $info_association = $query->result_array();
        if(isset($info_association))
        {
            //recupero comune provincia e regione
            $all_location = get_all_location($info_association[0]['fk_comune']);
            //unisco gli array e return
             return array_merge($info_association[0],$all_location[0]);
        }
        echo 'Nessun risultato da dati associazione!';
    }*/
}

//ritorna i link rapidi ai siti attinenti all'associazione
if ( ! function_exists('quick_links'))
{
    function quick_links()
    {
     //get main CodeIgniter object
     $ci=& get_instance();
       
     //load databse library
     $ci->load->database();

        //seleziono i link rapidi ai siti attinenti all'associazione
        $ci->db->select('link_website,link_webmail,link_webmail_pec,link_facebook,link_instagram,link_youtube,link_twitter,link_home_banking');
        $ci->db->from('associazioni');
        $ci->db->where('id','1');  // <---- x modifiche future in caso di più associazioni
        $query = $ci->db->get();
        $links = $query->result_array();
        if(isset($links))
        {
             return $links[0];
        }
        echo 'Nessun risultato da quicks links!';
    }
}


