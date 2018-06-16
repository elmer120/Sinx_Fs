<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//gestione risultati forms
class Result_handling {

    //tipi di errori
    private $error_type = array("uk-alert-success", "uk-alert-warning", "uk-alert-danger");

    private $message;
    private $level;

    //costruttori multipli https://www.lombardoandrea.com/costruttori-multipli-in-classe-php/
    public function __construct() {
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        } 
    }
    public function __construct2($message, $level) {
        $this->message = $message;
        $this->level = $level;
    }

    public function build_html()
    {
return <<<EOT
<div class="{$this->error_type[$this->level]}" uk-alert>
<a name="result" class="uk-alert-close" uk-close></a>
<p>$this->message</p>
</div>
EOT;
    }
}



/*
<div class="uk-alert-primary" uk-alert>
   
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
</div>

<div class="uk-alert-success" uk-alert>
    
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
</div>

<div class="uk-alert-warning" uk-alert>
    
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
</div>

<div class="uk-alert-danger" uk-alert>
   
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
</div>
*/