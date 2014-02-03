<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_gedung extends CI_Controller {

	
	function  __construct()
    {
	parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->library('tanggal');
		$this->load->model('m_gedung');
        
    }
	
	
	public function index() {
			
		$valid_fields = array('id_gedung','nama_gedung');
		$this->flexigrid->validate_post('id_gedung','asc',$valid_fields);		
		$records = $this->m_gedung->get_gedung();
		$this->output->set_header($this->config->item('json_header'));
		
		$i=1;
		foreach ($records['records']->result() as $row) {
			//$tgl=$this->tanggal->tgl_indo($row->tgl_lahir);
			$record_items[] = array($row->id_gedung,
			$i++,
			$row->nama_gedung,
			'<a class="edit" value="'.$row->id_gedung.'"" href="'.$this->config->item('base_url').'gedung/edit/'.$row->id_gedung.'">
			<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
			'<a href="'.$this->config->item('base_url').'gedung/hapus/'.$row->id_gedung.'">
			<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
			);
		}

		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		
	}
}
?>