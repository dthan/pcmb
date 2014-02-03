<?php
class M_fakultas extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
        //get instance
        $this->CI = get_instance();
    }
	
	function get_fakultas() {
		//pilih nama tabel
		$table_name = "fak";
		$this->db->select('kode_fak,fakultas')->from($table_name);
		$this->CI->flexigrid->build_query();
		
		//Get contents
		$return['records'] = $this->db->get();
		
		//Build count query
		$this->db->select('count(kode_fak) as record_count')->from($table_name);
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		
		//Get Record Count
		$return['record_count'] = $row->record_count;
	
		//Return all
		return $return;
	}
	
	function hapus($id) {
		 $this->db->query("DELETE FROM fak where kode_fak='".$id."'");
    }

	function get_fak2(){
		$query=$this->db->query("select * from fak");
		return $query;
	}

	function fakultas($id){
	    $query=$this->db->query("select * from fak where kode_fak='$id' ");
		return $query;	
	}

	function simpan($data){
		return $this->db->insert('fak',$data);
	}

	function edit($data,$id){
		$this->db->where('kode_fak', $id);
        return $this->db->update('fak', $data); 		
	}
}
?>