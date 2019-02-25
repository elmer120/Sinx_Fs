<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Associato {

    //istanza di codeigniter per usare le sue funzioni
    protected $CI;

        public $id;
        public $n_card;
        public $privacy;
        public $active;
        public $note;
        public $fk_tipo_associato;
        public $fk_cariche_direttivo;

        public function __construct($params)
        {
                 //recupero codeigniter
                 $this->CI = & get_instance();
                 $this->id = (isset($params['id']))? $params['id'] : null;
                 $this->n_card = $params['n_card'];
                 $this->privacy = $params['privacy'];
                 $this->active = $params['active'];
                 $this->note = $params['note'];
                 $this->fk_tipo_associato = $params['fk_tipo_associato'];
                 $this->fk_cariche_direttivo = $params['fk_cariche_direttivo'];
        }



        private function esempio_uso_istanza_ci()
        {
                $this->CI->load->helper('url');
                redirect();
        }
}