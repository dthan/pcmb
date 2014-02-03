<?php
class M_berita extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
        //get instance
        $this->CI = get_instance();
    }
	
	function get_berita() {
		//pilih nama tabel
		$table_name = "berita";
		$this->db->select('id_berita,judul,isi,tanggal_posting,penulis,gambar')->from($table_name);
		$this->CI->flexigrid->build_query();
		
		//Get contents
		$return['records'] = $this->db->get();
		
		//Build count query
		$this->db->select('count(id_berita) as record_count')->from($table_name);
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		
		//Get Record Count
		$return['record_count'] = $row->record_count;
	
		//Return all
		return $return;
	}
	
	function hapus($id) {
		 $this->db->query("DELETE FROM berita where id_berita='".$id."'");
    }

    public function ambil_berita($num, $offset)
	 {
		$this->db->order_by('id_berita', 'desc');
		$data = $this->db->get('berita', $num, $offset);
		return $data;
    }

    function get_berita_selected($id){
		$query=$this->db->query("select * from berita where judul_seo='$id' ");
		return $query;
	}

	  function berita_headline(){
		$query=$this->db->query("select * from berita order by id_berita desc limit 3 ");
		return $query;
	}

	  function berita_headline_awal(){
		$query=$this->db->query("select * from berita order by id_berita desc limit 7 ");
		return $query;
	}

	function get_berita2(){
		$query=$this->db->query("select * from berita");
		return $query;
	}

	function berita_all(){
		$query=$this->db->get('berita');
		return $query;
	}

	function berita($id){
	    $query=$this->db->query("select * from berita where id_berita='$id' ");
		return $query;	
	}

	function simpan($data){
		$this->db->insert('berita',$data);
	}

	function edit($data,$id){
		$this->db->where('id_berita', $id);
        $this->db->update('berita', $data); 		
	}
}
?>