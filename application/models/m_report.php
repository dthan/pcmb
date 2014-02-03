<?php
class M_report extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
        //get instance
        $this->CI = get_instance();
    }

    public function gedung(){
    	$q=$this->db->query('select * from gedung');
    	return $q;
    }

     public function fakultas(){
    	$q=$this->db->query('select * from fak');
    	return $q;
    }

    public function jurusan(){
    	$q=$this->db->query('select * from v_jurusan');
    	return $q;
    }

     public function sekolah(){
    	$q=$this->db->query('select * from v_sekolah  limit 10000');
    	return $q;
    }
    
    public function ruang_tes(){
    	$q=$this->db->query('select * from v_ruang_tes order by nama_gedung asc');
    	return $q;
    }

    public function hasil_seleksi(){
        $q=$this->db->query("SELECT * FROM data_diri where lulus!='tidak' order by pil_1 asc,pil_2 asc ");
        return $q;
    }

    public function pendaftar(){
        $q=$this->db->query("SELECT * FROM data_diri  order by pil_1 asc,pil_2 asc ");
        return $q;
    }

     public function pengawas(){
    	$q=$this->db->query('select * from v_pengawas order by nama_gedung asc');
    	return $q;
    }

}