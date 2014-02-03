<?php
class Tes extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
        //get instance
        $this->CI = get_instance();
    }

    public function input($data){
    	$this->db->insert('pendaftar',$data);
    }

    
 }