<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Person {

    //istanza di codeigniter per usare le sue funzioni
    protected $CI;

        public $id;
        public $name;
        public $surname;
        public $fiscal_code;
        public $address;
        public $phone;
        public $phone_ext;
        public $datebirth;
        public $email;
        public $avatar;
        public $create_date;
        public $fk_comune;
        public $fk_collaboratore;
        public $fk_associato;
   

        public function __construct($params)
        {
                 //recupero codeigniter
                 $this->CI = & get_instance();
                 $this->id = (isset($params['id']))? $params['id'] : null;
                 $this->name = $params['name'];
                 $this->surname = $params['surname'];
                 $this->fiscal_code = $params['fiscal_code'];
                 $this->address = $params['address'];
                 $this->phone = $params['phone'];
                 $this->phone_ext = $params['phone_ext'];
                 $this->datebirth = $params['datebirth'];
                 $this->email = $params['email'];
                 $this->avatar = $params['avatar'];
                 $this->create_date = $params['create_date'];
                 $this->fk_comune = $params['fk_comune'];
                 $this->fk_collaboratore = $params['fk_collaboratore'];
                 $this->fk_associato = $params['fk_associato'];
        }



        private function esempio_uso_istanza_ci()
        {
                $this->CI->load->helper('url');
                redirect();
        }
}