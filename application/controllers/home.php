<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    
      public function __construct()
		 {
		   parent::__construct();
		   $this->load->helper(array('form','url', 'text_helper','date'));
           $this->load->library('session');
		   $this->load->model('pcmb');
		   $this->load->model('m_berita');
		 }
	public function index()
	{
	    
		$data['aktif'] = "home";
		$data['title'] = "PCMB UIN Sunan Gunung Djati Bandung";
		$data['sessi'] = $this->session->userdata('username');
            //$id = $this->session->userdata('username');
        $data["prov"]= $this->pcmb->get_provinsi();
        $data["agama"] = $this->pcmb->get_agama();
	    $data['cek_daftar'] = $this->pcmb->cek_daftar($data['sessi']);
	    $data['data_diri'] = $this->pcmb->data_diri($data['sessi']);
	    $data['headline'] = $this->m_berita->berita_headline_awal();
		//$this->load->helper(array('form','url', 'text_helper','date'));
		$this->load->view('head',$data);
		$this->load->view('menu',$data);
		$this->load->view('slider',$data);
		$this->load->view('awal',$data);
		$this->load->view('footer',$data);
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */