<?php
class M_jurusan extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
        //get instance
        $this->CI = get_instance();
    }
	
	function get_jurusan() {
		//pilih nama tabel
		$table_name = "v_jurusan";
		$this->db->select('kode_jurusan,nama_jurusan,fakultas,kuota')->from($table_name);
		$this->CI->flexigrid->build_query();
		
		//Get contents
		$return['records'] = $this->db->get();
		
		//Build count query
		$this->db->select('count(kode_jurusan) as record_count')->from($table_name);
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		
		//Get Record Count
		$return['record_count'] = $row->record_count;
	
		//Return all
		return $return;
	}
	
	function hapus($id) {
		 $this->db->query("DELETE FROM jurusan where kode_jurusan='".$id."'");
    }

	function get_fakultas(){
		$query=$this->db->query("select * from fak");
		return $query;
	}

	function cek_kode($kode){
		$query=$this->db->query("select * from v_jurusan where kode_jurusan='$kode' ");
		 if($query->num_rows() >= 1){
         	return true;
         }
         else {
         	return false;
         }
		
	}

	function jurusan($id){
	    $query=$this->db->query("select * from jurusan where kode_jurusan='$id' ");
		return $query;	
	}

	function simpan($data){
		return $this->db->insert('jurusan',$data);

	}

	function edit($data,$id){
		$this->db->where('kode_jurusan', $id);
        $q=$this->db->update('jurusan', $data); 	
        return 	$q;
	}
}
?>