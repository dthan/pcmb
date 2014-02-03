<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_peserta extends CI_Model {
    
   	function __construct()
    {
        parent::__construct();
        //get instance
        $this->CI = get_instance();
    }

	public function login($username,$pass){
		$cek=$this->db->query("select * from pendaftar where no_pes='$username' ");
		if ($cek->num_rows() > 0) {
            $q = $this->db->query("SELECT * FROM pendaftar WHERE no_pes='$username' AND password='$pass'");
		}
		else {
			$q = $this->db->query("SELECT * FROM user WHERE username='$username' AND password='$pass'");
		}
		
		if ($q->num_rows() == 1) {
			return true;
		 }
		 else {
		    return false;
		  }

	}

	  public function update_data_peserta($data,$id)
    {
            $this->db->where('no_pes', $id);
            $this->db->update('pendaftar', $data); 
    } 

	public function data_login($username,$pass){
		
            $q = $this->db->query("SELECT * FROM pendaftar WHERE no_pes='$username' AND password='$pass'");
	
		return $q;
	}

		public function data_login2($username){
	
            $q = $this->db->query("SELECT * FROM pendaftar WHERE no_pes='$username' ");
	
		return $q;
	}

	public function get_kab($id){
		$query = $this->db->query("select * from kota where id_propinsi='$id' ");
		return $query;
	}

	public function get_agama()
	{
		$query = $this->db->query("select * from agama");
		return $query;
	}

	public function get_sekolah(){
		$query = $this->db->query("select * from jenis_sekolah");
		return $query;
	}

    public function get_sekolah2($id){
		$query = $this->db->query("select * from sekolah where id_kota='".$id."' order by nama_smta asc");
	return $query;
	}

	public function penghasilan_ortu(){
		$query = $this->db->query("select * from ortu_penghasilan");
		return $query;
	}

	public function pendidikan_ortu(){
		$query = $this->db->query("select * from ortu_pendidikan");
		return $query;
	}

	public function pekerjaan_ortu(){
		$query = $this->db->query("select * from ortu_pekerjaan");
		return $query;
	}

	public function simpan_data1($data)
		{
			$this->db->insert('pendaftar',$data);
		} 

    public function simpan_data2($data,$id)
		{
			$this->db->where('no_pes', $id);
            $this->db->update('pendaftar', $data); 
		} 
      public function update_data1($data,$id)
		{
			$this->db->where('no_pes', $id);
            $this->db->update('pendaftar', $data); 
		} 
	  
	 public function simpan_data3($data,$id)
		{
			$this->db->where('no_pes', $id);
            $this->db->update('pendaftar', $data); 
		} 	

    public function simpan_data4($data,$id)
		{
			$this->db->where('no_pes', $id);
            $this->db->update('pendaftar', $data); 
		} 

    public function get_program(){
    	$query = $this->db->query("select * from program");
		return $query;
    }
	public function get_provinsi(){
		$dt = $this->db->query("select * from propinsi");
		return $dt;
	}

	public function get_provinsi2($id){
		$dt = $this->db->query("select * from sekolah where kode_sekolah='$id' ");
		foreach ($dt->result() as $sk) {
			
		}
		return $sk->id_propinsi;
	}



	public function get_kota2($id){
		$dt = $this->db->query("select * from sekolah where kode_sekolah='$id' ");
		foreach ($dt->result() as $sk) {
			
		}
		return $sk->id_kota;
	}

	public function get_kota3($id){
		$dt = $this->db->query("select * from kota where id_propinsi='$id' ");
		return $dt;
	}


	public function cek_daftar($id){
       $query = $this->db->query("select * from data_diri where no_pes='".$id."' ");
       if ($query->num_rows() == 1) {
			return true;
		 }
		 else {
		    return false;
		 }
	}

	public function cek_form2($id){
       $query = $this->db->query("select nama_sekolah from pendaftar where no_pes='$id' ");
       foreach ($query->result() as $ada) {
         
       }

       if($ada->nama_sekolah==''){
       	  return true;
       }
       else {
       	  return false;
       }
	}

	public function cek_form3($id){
       $query = $this->db->query("select ayah from pendaftar where no_pes='$id' ");
       foreach ($query->result() as $ada) {
         
       }

       if($ada->ayah==''){
       	  return true;
       }
       else {
       	  return false;
       }
	}

	public function cek_form4($id){
       $query = $this->db->query("select pil_1 from pendaftar where no_pes='$id' ");
       foreach ($query->result() as $ada) {
         
       }

       if($ada->pil_1==''){
       	  return true;
       }
       else {
       	  return false;
       }
	}

    
	public function data_diri($id){
		$query = $this->db->query("select * from data_diri where no_pes='$id' ");
		return $query;
	}

	public function data_cetak_kartu($id){
		$query = $this->db->query("select * from data_diri where id_pendaftar='$id' ");
		return $query;
	}

	public function get_fak(){
		$query = $this->db->query("select * from fak ");
		return $query;
	}

	public function get_jur($id){
		$query = $this->db->query("select * from jurusan where kode_fak='$id' ");
		return $query;
	}

	public function get_fak2($id){
		$query = $this->db->query("select * from jurusan where kode_jurusan='$id' ");
		foreach ($query->result() as $q) {
			
		}
		$query2 = $this->db->query("select * from fak where kode_fak='".$q->kode_fak."' ");
		foreach ($query2->result() as $h) {
			
		}
		return $h->kode_fak;
	}

    public function ruang_tes(){
    	$query=$this->db->query("select * from ruang_tes where kapasitas>terisi order by id_ruang_tes asc limit 1");
    	//$query=$this->db->query("select * from ruangan_tes where jumlah<=40 order by ruang_tes asc limit 1");
    	foreach ($query->result() as $hasil) {
    		
    	}
    	return $hasil->id_ruang_tes;
    }

    public function isi_ruangan($data){
    	$query=$this->db->query("select * from ruang_tes where id_ruang_tes='$data' ");
    	foreach ($query->result() as $hasil) {
    		$terisi=$hasil->terisi;
    	}
    	$sekarang=$terisi+1;
    	$this->db->query("update ruang_tes set terisi='$sekarang' where id_ruang_tes='$data' ");
    }

    public function get_peserta() {
		//pilih nama tabel
		$table_name = "data_diri";
		$this->db->select('no_pes,nama,tgl_lahir,pilihan1,pilihan2')->from($table_name);
		$this->CI->flexigrid->build_query();
		
		//Get contents
		$return['records'] = $this->db->get();
		
		//Build count query
		$this->db->select('count(no_pes) as record_count')->from($table_name);
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		
		//Get Record Count
		$return['record_count'] = $row->record_count;
	
		//Return all
		return $return;
	}
	
	  public function hapus_peserta($id){
        $query=$this->db->query("delete from pendaftar where no_pes='$id' ");
    }

}