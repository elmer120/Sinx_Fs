<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {


    public function __construct()
    {
            parent::__construct();
			$this->load->library('session');
    }
    
    public function create_user()
    {
        $data['firstName'] = $userData['firstName'];
        $data['lastName'] = $userData['lastName'];
        $data['teamId'] = (int) $userData['teamId'];
        $data['isAdmin'] = (int) $userData['isAdmin'];
        $data['avatar'] = $this->getAvatar();
        $data['email'] = $userData['email'];
        $data['tagline'] = "Click here to edit tagline.";
        $data['password'] = sha1($userData['password1']);
        return $this->db->insert('user',$data);
    }
    
    public function validate_user()
    {
        
    }

}