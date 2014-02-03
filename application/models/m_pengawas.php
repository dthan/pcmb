<?php
class M_pengawas extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
        //get instance
        $this->CI = get_instance();
    }
	
	function get_pengawas() {
		//pilih nama tabel
		$table_name = "v_pengawas";
		$this->db->select('id_pengawas,nama_pengawas,nama_gedung,nama_ruang_tes,username,password')->from($table_name);
		$this->CI->flexigrid->build_query();
		
		//Get contents
		$return['records'] = $this->db->get();
		
		//Build count query
		$this->db->select('count(id_pengawas) as record_count')->from($table_name);
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		
		//Get Record Count
		$return['record_count'] = $row->record_count;
	
		//Return all
		return $return;
	}

	 public function cek_login($username,$password){
        $q=$this->db->query("select * from pengawas where username='".$username."' and password='".$password."'");
        return $q;
    }

    public function set_absen_agama($id){
    	$q=$this->db->query("update kehadiran set ujian_agama='Y' where no_pes='$id' ");
    	return $q;
    }

      public function set_absen_wawancara($id){
        $q=$this->db->query("update kehadiran set wawancara='Y' where no_pes='$id' ");
        return $q;
    }

        public function set_tidak_hadir_wawancara($id){
        $q=$this->db->query("update kehadiran set wawancara='N' where no_pes='$id' ");
        return $q;
    }

     public function set_hadir_wawancara_all($id){
        $q=$this->db->query("update kehadiran set wawancara='Y' where id_ruang_tes='$id' ");
        return $q;
    }

      public function set_tidak_hadir_wawancara_all($id){
        $q=$this->db->query("update kehadiran set wawancara='N' where id_ruang_tes='$id' ");
        return $q;
    }

     public function set_absen_agama_all($id){
    	$q=$this->db->query("update kehadiran set ujian_agama='Y' where id_ruang_tes='$id' ");
    	return $q;
    }

      public function set_absen_agama_all_no($id){
    	$q=$this->db->query("update kehadiran set ujian_agama='N' where id_ruang_tes='$id' ");
    	return $q;
    }

    public function set_absen_agama_tidak($id){
    	$q=$this->db->query("update kehadiran set ujian_agama='N' where no_pes='$id' ");
    	return $q;
    }

    public function set_absen_umum($id){
    	$q=$this->db->query("update kehadiran set ujian_umum='Y' where no_pes='$id' ");
    	return $q;
    }

     public function set_absen_umum_all($id){
    	$q=$this->db->query("update kehadiran set ujian_umum='Y' where id_ruang_tes='$id' ");
    	return $q;
    }

      public function set_absen_umum_all_no($id){
    	$q=$this->db->query("update kehadiran set ujian_umum='N' where id_ruang_tes='$id' ");
    	return $q;
    }

    public function set_absen_umum_tidak($id){
    	$q=$this->db->query("update kehadiran set ujian_umum='N' where no_pes='$id' ");
    	return $q;
    }

    public function set_absen_bahasa($id){
    	$q=$this->db->query("update kehadiran set ujian_bahasa='Y' where no_pes='$id' ");
    	return $q;
    }

     public function set_absen_bahasa_all($id){
    	$q=$this->db->query("update kehadiran set ujian_bahasa='Y' where id_ruang_tes='$id' ");
    	return $q;
    }

      public function set_absen_bahasa_all_no($id){
    	$q=$this->db->query("update kehadiran set ujian_bahasa='N' where id_ruang_tes='$id' ");
    	return $q;
    }

    public function set_absen_bahasa_tidak($id){
    	$q=$this->db->query("update kehadiran set ujian_bahasa='N' where no_pes='$id' ");
    	return $q;
    }

	
	function hapus($id) {
		 $this->db->query("DELETE FROM pengawas where id_pengawas='".$id."'");
    }

    function peserta($id_ruang_tes){
    	$q=$this->db->query("select * from v_kehadiran where id_ruang_tes='$id_ruang_tes' ");
    	return $q;

    }

	function get_ruang_tes_all(){
		$query=$this->db->query("select * from ruang_tes");
		return $query;
	}

	function get_gedung(){
		$query=$this->db->query("select * from gedung");
		return $query;
	}

	function get_ruang_tes($id){
		$query=$this->db->query("select * from pengawas where id_pengawas='$id' ");
		foreach ($query->result() as $hasil) {
			# code...
		}
		return $hasil->id_ruang_tes;
	}

	function get_ruangan(){
		$query=$this->db->query("select * from ruang_tes where status_pengawas='tidak' limit 1");
	
		return $query;
	}

	function cek_ruang_tes($id){
		$query=$this->db->query("select * from pengawas where id_ruang_tes='$id' ");
		if ($query->num_rows() > 0) {
			return true;
		 }
		 else {
		    return false;
		  }
	}

    function set_ada($id){
        $this->db->query("update ruang_tes set status_pengawas='ada' where id_ruang_tes='$id' ");
    }
    
     function set_tidak($id){
        $this->db->query("update ruang_tes set status_pengawas='tidak' where id_ruang_tes='$id' ");
    }
	function get_pengawas_before($id){
        $query=$this->db->query("select * from pengawas where id_ruang_tes='$id' ");
        return $query;
	}

	function get_pengawas_by_id($id){
        $query=$this->db->query("select * from pengawas where id_pengawas='$id' ");
        return $query;
	}

	function pengawas($id){
	    $query=$this->db->query("select * from pengawas where id_pengawas='$id' ");
		return $query;	
	}
    
    function get_ruang($id){
        $query=$this->db->query("select * from ruang_tes where id_gedung='$id' ");
        return $query;
    }


	function simpan($data){
		$this->db->insert('pengawas',$data);
	}

	function edit($data,$id){
		$this->db->where('id_pengawas', $id);
        $this->db->update('pengawas', $data); 		
	}

    function jml_ruang_tes(){
        $q=$this->db->query("select count(id_ruang_tes) as jml from v_ruang_tes ");
        foreach ($q->result() as $k) { }
        return $k->jml;
    }

    function terisi(){
        $q=$this->db->query("select count(id_ruang_tes) as terisi from ruang_tes where status_pengawas='ada' ");
        foreach ($q->result() as $k) { }
        return $k->terisi;
    }
}
?>