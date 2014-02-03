<?php
class M_kelulusan extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
        //get instance
        $this->CI = get_instance();
    }
	
     function cek_kelulusan($id){
     	$q=$this->db->query("select * from v_kelulusan where no_pes='$id' ");
     	return $q;
     }

     function cek_pes($id){
        $q=$this->db->query("select * from data_diri where no_pes='$id' ");
        return $q;
     }

     function cek_no_pes($id){
     	$q=$this->db->query("select * from pendaftar where no_pes='$id' ");
     	if($q->num_rows>0){
     		return true;
     	}
     	else {
     		return false;
     	}
     	
     }
}
?>