<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_pengawas extends CI_Controller {

	
	function  __construct()
    {
	parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->library('tanggal');
		$this->load->model('m_pengawas');
        
    }
	
	
	public function index() {
			
		$valid_fields = array('id_pengawas','nama_pengawas','nama_ruang_tes');
		$this->flexigrid->validate_post('nama_ruang_tes','asc',$valid_fields);		
		$records = $this->m_pengawas->get_pengawas();
		$this->output->set_header($this->config->item('json_header'));
		
		$i=1;
		foreach ($records['records']->result() as $row) {
			//$tgl=$this->tanggal->tgl_indo($row->tgl_lahir);
			$record_items[] = array($row->id_pengawas,
			$i++,
			$row->nama_pengawas,
			$row->nama_ruang_tes,
			'<a class="edit" value="'.$row->id_pengawas.'"" href="'.$this->config->item('base_url').'data_pengawas/edit/'.$row->id_pengawas.'">
			<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
			'<a href="'.$this->config->item('base_url').'pengawas/hapus/'.$row->id_pengawas.'">
			<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
			);
		}

		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		
	}
}
?>