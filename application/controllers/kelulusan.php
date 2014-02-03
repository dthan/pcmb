<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kelulusan extends CI_Controller {
	 public function __construct()
		 {
		   parent::__construct();
		   $this->load->helper(array('form','url', 'text_helper','date'));
           $this->load->library('session');
           $this->load->library('tanggal');
		   $this->load->model('m_berita');
		   $this->load->model('pcmb');
		   $this->load->model('m_kelulusan');
		   $this->load->library('fpdf');
		   $this->load->helper('flexigrid');
		   $this->load->helper('peserta');
           $this->load->library('flexigrid');
           $this->load->helper('form');
	       $this->load->library('tanggal');
		   $this->load->model('m_gedung');
           define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		 }

		 public function index(){
		 	$data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('nama_admin');
			$data['title']="kelulusan";
			$data['aktif']="kelulusan";
            //$id = $this->session->userdata('username');
            $data["prov"]= $this->pcmb->get_provinsi();
            $data["agama"] = $this->pcmb->get_agama();
            $data['headline'] = $this->m_berita->berita_headline();
			$data['cek_daftar'] = $this->pcmb->cek_daftar($data['sessi']);
			$data['data_diri'] = $this->pcmb->data_diri($data['sessi']);
		 	$this->load->view('head',$data);
			$this->load->view('menu',$data);
			$this->load->view('kelulusan',$data);
			$this->load->view('footer',$data);
		 }

		 public function cek_kelulusan(){
		 	$no_pes= $this->input->post('no_pes');
		 	$cek_no_pes = $this->m_kelulusan->cek_no_pes($no_pes);
		 	$kelulusan = $this->m_kelulusan->cek_kelulusan($no_pes);
            if($cek_no_pes==true){

            	if($kelulusan->num_rows()>0){
		                 foreach ($kelulusan->result() as $k) {
		                
		                 }
		                 if($k->keterangan=='pil_1'){
		                 	echo "
 								<div class='info-box' style='background:rgb(121, 190, 11)'>
							    <h2 id='hasil_kelulusan' style='color:#fff;text-align:center'>selamat atas nama <br>".strtoupper($k->nama)."<br>anda masuk jurusan ".$k->jurusan."</h2>					
				    			</div>
		                 	    ";
		                 }
		                 else if($k->keterangan=='pil_3'){
		                 		echo "
 								<div class='info-box' style='background:rgb(121, 190, 11)'>
							    <h2 id='hasil_kelulusan' style='color:#fff;text-align:center'>
							    Maaf atas nama <br>".strtoupper($k->nama)."<br>Anda tidak masuk pilihan 1 atau pilihan 2, <br>
							    anda masuk pilihan tawaran dari uin yaitu juruan ".$k->jurusan."
							    </h2>					
				    			</div>
		                 	    ";
		                 }
				 	}
				 	else{ 
				 		 $kelulusan = $this->m_kelulusan->cek_pes($no_pes);
				 		 foreach ($kelulusan->result() as $k) {
		                
		                 }
				 		echo "<div class='info-box' style='background: #ff6347'>
							  <h2 id='hasil_kelulusan' style='color:#fff;text-align:center'>Maaf atas nama <br>".strtoupper($k->nama)."<br> tidak lulus, silahkan coba lagi tahun depan</h2>					
				    		 </div>";
				 	}
            }
            else {
            	echo "<div class='info-box' style='background:red'>
					 <h2 id='hasil_kelulusan' style='color:#fff;text-align:center'>No Peserta Tidak Terdaftar</h2>					
				    </div>";
            }
				 	
		 }
}