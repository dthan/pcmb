<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_peserta extends CI_Controller {
	/*
	public function Ajax () {
		parent::Controller();	
		$this->load->model('ajax_model');
		$this->load->library('flexigrid');
	}
	*/
	
	function  __construct()
    {
	parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->library('tanggal');
		$this->load->model('ajax_model');
        
    }
	
	
	public function index() {
			
		$valid_fields = array('no_pes','nama','tgl_lahir','pilihan1','pilihan2');
		$this->flexigrid->validate_post('no_pes','asc',$valid_fields);		
		$records = $this->ajax_model->get_peserta();
		$this->output->set_header($this->config->item('json_header'));
		
		$i=1;
		foreach ($records['records']->result() as $row) {
			$tgl=$this->tanggal->tgl_indo($row->tgl_lahir);
			$record_items[] = array($row->no_pes,
			$i++,
			$row->nama,
			$tgl,
			$row->pilihan1,
			$row->pilihan2,
			'<a class="edit" value="'.$row->no_pes.'"" href="'.$this->config->item('base_url').'peserta/edit_peserta/'.$row->no_pes.'">
			<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
			'<a href="'.$this->config->item('base_url').'peserta/hapus_peserta/'.$row->no_pes.'">
			<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
			);
		}

		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		
	}
}
?>