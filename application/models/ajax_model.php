<?php
class Ajax_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
        //get instance
        $this->CI = get_instance();
    }
	
	function get_peserta() {
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
	
	function delete_country($id) {
		$delete_country = $this->db->query('DELETE FROM tbbarang WHERE kodebarang='.$id);
		
		return TRUE;
	}
}
?>