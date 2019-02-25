<?php defined('BASEPATH') OR exit('No direct script access allowed');

//dato l'fk_comune ritorna l'oggetto: "cap comune provincia regione"
if ( ! function_exists('echo_breadcrumbs'))
{
	/*<ul class="uk-breadcrumb">

    <li><a href="#">Item</a></li>
    <li><a href="#">Item</a></li>
    <li class="uk-disabled"><a>Disabled</a></li>
	<li><span>Active</span></li>
	
</ul>*/
   function echo_breadcrumbs($breadcrumbs)
   {
	   if(isset($breadcrumbs))
	   {
		echo '<ul class="uk-breadcrumb">';
			foreach ($breadcrumbs as $key=>$value) {
				if($value!='')
				{
				echo "<li> <a href='$value'>$key</a></li>";
				}
				else
				{
				echo "<li><span>$key</span></li>";
				}
			}
		echo '</ul>';
	   }
	   else
	   {
		die("No breadcrumbs found");
	   }
	   
   }
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
        $ci->db->select('web_site,web_mail,web_mail_pec,facebook,instagram,youtube,twitter,home_banking');
		$ci->db->from('associazioni_links');
		$ci->db->join('associazioni','associazioni.fk_associazioni_links = associazioni_links.id');
        $ci->db->where('associazioni.id','1');  // <---- x modifiche future in caso di più associazioni
        $query = $ci->db->get();
        $links = $query->result_array();
        if(isset($links))
        {
             return $links[0];
        }
        echo 'Nessun risultato da quicks links!';
    }
}


