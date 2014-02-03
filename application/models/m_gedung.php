<?php
class M_gedung extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
        //get instance
        $this->CI = get_instance();
    }
	
	function get_gedung() {
		//pilih nama tabel
		$table_name = "gedung";
		$this->db->select('id_gedung,nama_gedung')->from($table_name);
		$this->CI->flexigrid->build_query();
		
		//Get contents
		$return['records'] = $this->db->get();
		
		//Build count query
		$this->db->select('count(id_gedung) as record_count')->from($table_name);
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		
		//Get Record Count
		$return['record_count'] = $row->record_count;
	
		//Return all
		return $return;
	}
	
	function hapus($id) {
		 $this->db->query("DELETE FROM gedung where id_gedung='".$id."'");
    }

	function get_gedung2(){
		$query=$this->db->query("select * from gedung");
		return $query;
	}

	function gedung($id){
	    $query=$this->db->query("select * from gedung where id_gedung='$id' ");
		return $query;	
	}

	function simpan($data){
		$this->db->insert('gedung',$data);
	}

	function edit($data,$id){
		$this->db->where('id_gedung', $id);
        $this->db->update('gedung', $data); 		
	}
}
?>