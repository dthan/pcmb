<?php
class M_sekolah extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
        //get instance
        $this->CI = get_instance();
    }
	
	function get_sekolah() {
		//pilih nama tabel
		$table_name = "v_sekolah";
		$this->db->select('kode_sekolah,nama_smta,nama_propinsi,nama_kota')->from($table_name);
		$this->CI->flexigrid->build_query();
		
		//Get contents
		$return['records'] = $this->db->get();
		
		//Build count query
		$this->db->select('count(kode_sekolah) as record_count')->from($table_name);
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		
		//Get Record Count
		$return['record_count'] = $row->record_count;
	
		//Return all
		return $return;
	}

	function cek_kode($kode){
		$query=$this->db->query("select * from v_sekolah where kode_sekolah='$kode' ");
		 if($query->num_rows() >= 1){
         	return true;
         }
         else {
         	return false;
         }
		
	}

	
	function hapus($id) {
		 $this->db->query("DELETE FROM sekolah where kode_sekolah='".$id."'");
    }

	function get_propinsi(){
		$query=$this->db->query("select * from propinsi");
		return $query;
	}

	function sekolah($id){
	    $query=$this->db->query("select * from sekolah where kode_sekolah='$id' ");
		return $query;	
	}

	function get_kota($id){
	    $query=$this->db->query("select * from kota where id_propinsi='$id' ");
		return $query;	
	}

	function simpan($data){
		return $this->db->insert('sekolah',$data);
	}

	function edit($data,$id){
		$this->db->where('kode_sekolah', $id);
        $this->db->update('sekolah', $data); 		
	}
}
?>