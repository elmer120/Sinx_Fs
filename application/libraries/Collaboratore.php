<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Collaboratore {

    //istanza di codeigniter per usare le sue funzioni
    protected $CI;

        public $id;
        public $mansione;
        public $note;

        public function __construct($params)
        {
                 //recupero codeigniter
                 $this->CI = & get_instance();
                 $this->id = (isset($params['id']))? $params['id'] : null;
                 $this->mansione = $params['mansione'];
                 $this->note = $params['note'];
        }

        private function esempio_uso_istanza_ci()
        {
                $this->CI->load->helper('url');
                redirect();
        }
}