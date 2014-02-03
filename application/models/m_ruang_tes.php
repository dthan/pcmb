<?php
class M_ruang_tes extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
        //get instance
        $this->CI = get_instance();
    }
	
	function get_ruang_tes() {
		//pilih nama tabel
		$table_name = "v_ruang_tes";
		$this->db->select('id_ruang_tes,nama_ruang_tes,kapasitas,nama_gedung')->from($table_name);
		$this->CI->flexigrid->build_query();
		
		//Get contents
		$return['records'] = $this->db->get();
		
		//Build count query
		$this->db->select('count(id_ruang_tes) as record_count')->from($table_name);
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		
		//Get Record Count
		$return['record_count'] = $row->record_count;
	
		//Return all
		return $return;
	}
	
	function hapus($id) {
		 $this->db->query("DELETE FROM ruang_tes where id_ruang_tes='".$id."'");
    }

	function get_gedung(){
		$query=$this->db->query("select * from gedung");
		return $query;
	}

	function ruang_tes($id){
	    $query=$this->db->query("select * from ruang_tes where id_ruang_tes='$id' ");
		return $query;	
	}

	function simpan($data){
		return $this->db->insert('ruang_tes',$data);
	}

	function edit($data,$id){
		$this->db->where('id_ruang_tes', $id);
        $this->db->update('ruang_tes', $data); 		
	}
}
?>