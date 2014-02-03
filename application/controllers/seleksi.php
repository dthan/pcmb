<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seleksi extends CI_Controller {
   //kontruksi yang dijalan otomatis pada saat class dipanggil 
       public function __construct()
		 {
		   parent::__construct();
		   $this->load->helper(array('form','url', 'text_helper','date'));
           $this->load->library('session');
           $this->load->library('tanggal');
		   $this->load->model('m_admin');
		   $this->load->model('m_seleksi');
		   $this->load->model('pcmb');
		   $this->load->library('fpdf');
		   $this->load->helper('flexigrid');
		   $this->load->helper('peserta');
           $this->load->library('flexigrid');
           $this->load->helper('form');
		   define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		   	set_time_limit(0);
			ini_set('memory_limit','2500M');
		 }
         
         public function index()
		 {
		 	//$this->m_seleksi->reset();
			$data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('nama_admin');
			$data['jurusan']=$this->m_seleksi->get_jurusan();
			$data['lulus']=$this->m_seleksi->data_lulus();
			$data['tidak']=$this->m_seleksi->data_tidak();
			$data['posisi']='seleksi';
			$data['bread']='<li><a style="text-decoration:none" href="'.base_url().'admin">Home</a><span class="divider">/</span></li>
			 				
                            <li class="active">seleksi </li>';
			if($data['sessi']==''){
			   $this->load->view('admin/login');
			}
			else {
			 	$this->load->view('admin/head',$data);
				$this->load->view('admin/menu',$data);
				$this->load->view('admin/seleksi',$data);
				$this->load->view('admin/footer');
			}
				
			 
		 }

		 public function jurusan($id){
		 	$data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('nama_admin');
			$data['pendaftar']=$this->m_seleksi->get_pendaftar($id);
			$data['pendaftar2']=$this->m_seleksi->get_pendaftar2($id);
			$data['pendaftar3']=$this->m_seleksi->get_pendaftar3($id);
			$data['jur']=$this->m_seleksi->get_jur($id);           

			$data['posisi']='seleksi';
			$data['bread']='<li><a style="text-decoration:none" href="'.base_url().'admin">Home</a><span class="divider">/</span></li>
			 				<li><a style="text-decoration:none" href="'.base_url().'seleksi">seleksi</a><span class="divider">/</span></li>
                            <li class="active">seleksi jurusan</li>';
			if($data['sessi']==''){
			   $this->load->view('admin/login');
			}
			else {
			 	$this->load->view('admin/head',$data);
				$this->load->view('admin/menu',$data);
				$this->load->view('admin/seleksi_jurusan',$data);
				$this->load->view('admin/footer');
			}
		 }

		 public function set_lulus(){
		 	$this->m_seleksi->set_seleksi($this->input->post('jur'));
		 	$kode_jurusan=$this->input->post('jur');
		 	$no_pes=$this->input->post('no_pes');
		 	$pil=$this->input->post('pilihan');
		 	$cek_kuota=$this->m_seleksi->cek_kuota($kode_jurusan);
            $sudah_seleksi=$this->m_seleksi->sudah_seleksi($no_pes);
		 	 if($cek_kuota=="kosong"){               
                $this->m_seleksi->set_terisi($kode_jurusan); 		  
               	if($pil=='pil_1'){
                 $this->m_seleksi->set_lulus1($no_pes);
		 		}
		 		else{
                 $this->m_seleksi->set_lulus2($no_pes);
		 		}
				
				$this->m_seleksi->kelulusan($no_pes,$kode_jurusan,$pil);
				echo "sukses";
		 	}
		 	else {
		 		echo "penuh";
		 	}

		 }

		  public function set_tidak_lulus(){
		 	$kode_jurusan=$this->input->post('jur');
		 	$no_pes=$this->input->post('no_pes');
		 	$pil=$this->input->post('pilihan');
		 	$cek_kosong=$this->m_seleksi->cek_kosong($kode_jurusan);
		 	$cek_kuota=$this->m_seleksi->cek_kuota($kode_jurusan);
		 	$cek_pes=$this->m_seleksi->cek_pes($no_pes);
		 	if($cek_kuota==true){
			 	if($cek_kosong==true){
			 		$this->m_seleksi->unset_terisi($kode_jurusan);
			 	}
					$this->m_seleksi->set_tidak_lulus($no_pes);
					$this->m_seleksi->hapus_kelulusan($no_pes);
					echo "sukses";
		 	}
		 	else{
		 		if($cek_pes==true){
		 			$this->m_seleksi->unset_terisi($kode_jurusan);
			 	    $this->m_seleksi->set_tidak_lulus($no_pes);
				    $this->m_seleksi->hapus_kelulusan($no_pes);
				    echo "sukses";
		 		}
		 		
		 	}

		 }
         
         public function reset(){
         	$this->m_seleksi->set_seleksi_belum();
		 	$this->m_seleksi->reset();		 	
		 	redirect(''.base_url().'seleksi/', 'refresh');
		 }

         public function do_seleksi(){
         	$this->m_seleksi->set_seleksi_all();
		 	$this->m_seleksi->reset();
		 	$j=$this->m_seleksi->get_jur_all();
		 	foreach ($j->result() as $jur) {
		 		if(($jur->kode_fak=='2') || ($jur->kode_jurusan=='205') || ($jur->kode_jurusan=='206') || ($jur->kode_jurusan=='207') || ($jur->kode_jurusan=='208')){
                  $p=$this->m_seleksi->do_seleksi_sains($jur->kode_jurusan,$jur->kuota);
			 	}
			 	else if(($jur->kode_jurusan=='203') || ($jur->kode_jurusan=='204') || ($jur->kode_jurusan=='502') || ($jur->kode_jurusan=='503') || ($jur->kode_jurusan=='504')){
                  $p=$this->m_seleksi->do_seleksi_bahasa($jur->kode_jurusan,$jur->kuota);
			 	}
			 	else{
			 		$p=$this->m_seleksi->do_seleksi($jur->kode_jurusan,$jur->kuota);
			 	}		 		
		 		foreach ($p->result() as $pes) {			 		
                        $this->m_seleksi->set_terisi($pes->pil_1);
			 			$this->m_seleksi->set_lulus1($pes->no_pes);
			 			$this->m_seleksi->kelulusan($pes->no_pes,$pes->pil_1,'pil_1');		 		      
		 		}	 		
		 	}

		 	$j=$this->m_seleksi->get_jur_all2();
            foreach ($j->result() as $jur2) {           
            	if(($jur2->kode_fak=='2') or ($jur2->kode_jurusan=='205') or ($jur2->kode_jurusan=='206') or ($jur2->kode_jurusan=='207') or ($jur2->kode_jurusan=='208')){
                  $terisi=$jur2->terisi;
                  $kuota=$jur2->kuota;
                  $sekarang=($kuota-$terisi);
                  $p2=$this->m_seleksi->do_seleksi_sains2($jur2->kode_jurusan,$sekarang);
			 	}
			 	else if(($jur2->kode_jurusan=='203') or ($jur2->kode_jurusan=='204') or ($jur2->kode_jurusan=='502') or ($jur2->kode_jurusan=='503') or ($jur2->kode_jurusan=='504')){
                  $terisi=$jur2->terisi;
                  $kuota=$jur2->kuota;
                  $sekarang=($kuota-$terisi);
                  $p2=$this->m_seleksi->do_seleksi_bahasa2($jur2->kode_jurusan,$sekarang);
			 	}
			 	else{
			 	  $terisi=$jur2->terisi;
                  $kuota=$jur2->kuota;
                  $sekarang=($kuota-$terisi);
			 	  $p2=$this->m_seleksi->do_seleksi2($jur2->kode_jurusan,$sekarang);
			 	}		 		
		 		foreach ($p2->result() as $pes2) {			 		
                        $this->m_seleksi->set_terisi($pes2->pil_2);
			 			$this->m_seleksi->set_lulus2($pes2->no_pes);
			 			$this->m_seleksi->kelulusan($pes2->no_pes,$pes2->pil_2,'pil_2');		 		      
		 		}	 	
		 	}	

            $j3=$this->m_seleksi->get_jur_all2();
            foreach ($j3->result() as $jur3) {
           
            	if(($jur3->kode_fak=='2') or ($jur3->kode_jurusan=='205') or ($jur3->kode_jurusan=='206') or ($jur3->kode_jurusan=='207') or ($jur3->kode_jurusan=='208')){
                  $terisi=$jur3->terisi;
                  $kuota=$jur3->kuota;
                  $sekarang=($kuota-$terisi);
                  $p3=$this->m_seleksi->do_seleksi_sains3($sekarang);
			 	}
			 	else if(($jur3->kode_jurusan=='203') or ($jur3->kode_jurusan=='204') or ($jur3->kode_jurusan=='502') or ($jur3->kode_jurusan=='503') or ($jur3->kode_jurusan=='504')){
                  $terisi=$jur3->terisi;
                  $kuota=$jur3->kuota;
                  $sekarang=($kuota-$terisi);
                  $p3=$this->m_seleksi->do_seleksi_bahasa3($sekarang);
			 	}
			 	else{
			 	  $terisi=$jur3->terisi;
                  $kuota=$jur3->kuota;
                  $sekarang=($kuota-$terisi);
			 	  $p3=$this->m_seleksi->do_seleksi3($sekarang);
			 	}
		 		
		 		foreach ($p3->result() as $pes3) {			 		
                        $this->m_seleksi->set_terisi($jur3->kode_jurusan);
			 			$this->m_seleksi->set_lulus3($pes3->no_pes);
			 			$this->m_seleksi->kelulusan($pes3->no_pes,$jur3->kode_jurusan,'pil_3');
		 		      
		 		}	 	
		 	}	

            redirect(''.base_url().'seleksi/', 'refresh');
         }

         //seleksi pilihan 1
		 public function do_seleksi1($id){
		 	$this->m_seleksi->set_seleksi($id);
		 	$this->m_seleksi->reset1($id);
		 	$j=$this->m_seleksi->get_jur_selected($id);
		 	foreach ($j->result() as $jur) {
		 		if(($jur->kode_fak=='2') or ($jur->kode_jurusan=='205') or ($jur->kode_jurusan=='206') or ($jur->kode_jurusan=='207') or ($jur->kode_jurusan=='208')){
                  $p=$this->m_seleksi->do_seleksi_sains($jur->kode_jurusan,$jur->kuota);
			 	}
			 	else if(($jur->kode_jurusan=='203') or ($jur->kode_jurusan=='204') or ($jur->kode_jurusan=='502') or ($jur->kode_jurusan=='503') or ($jur->kode_jurusan=='504')){
                  $p=$this->m_seleksi->do_seleksi_bahasa($jur->kode_jurusan,$jur->kuota);
			 	}
			 	else{
			 		$p=$this->m_seleksi->do_seleksi($jur->kode_jurusan,$jur->kuota);
			 	}		 		
		 		foreach ($p->result() as $pes) {			 		
                        $this->m_seleksi->set_terisi($pes->pil_1);
			 			$this->m_seleksi->set_lulus1($pes->no_pes);
			 			$this->m_seleksi->kelulusan($pes->no_pes,$pes->pil_1,'pil_1');		 		      
		 		}	 		
		 	}
		 	redirect(''.base_url().'seleksi/jurusan/'.$id, 'refresh');
		 }
         
         //seleksi pilihan 2
		 public function do_seleksi2($id){
            $this->m_seleksi->reset($id);
            $j=$this->m_seleksi->get_jur_selected($id);
            foreach ($j->result() as $jur2) {}
            if(($jur2->terisi)<($jur2->kuota)){
            	if(($jur2->kode_fak=='2') or ($jur2->kode_jurusan=='205') or ($jur2->kode_jurusan=='206') or ($jur2->kode_jurusan=='207') or ($jur2->kode_jurusan=='208')){
                  $terisi=$jur2->terisi;
                  $kuota=$jur2->kuota;
                  $sekarang=($kuota-$terisi);
                  $p2=$this->m_seleksi->do_seleksi_sains2($jur2->kode_jurusan,$sekarang);
			 	}
			 	else if(($jur2->kode_jurusan=='203') or ($jur2->kode_jurusan=='204') or ($jur2->kode_jurusan=='502') or ($jur2->kode_jurusan=='503') or ($jur2->kode_jurusan=='504')){
                  $terisi=$jur2->terisi;
                  $kuota=$jur2->kuota;
                  $sekarang=($kuota-$terisi);
                  $p2=$this->m_seleksi->do_seleksi_bahasa2($jur2->kode_jurusan,$sekarang);
			 	}
			 	else{
			 	  $terisi=$jur2->terisi;
                  $kuota=$jur2->kuota;
                  $sekarang=($kuota-$terisi);
			 	  $p2=$this->m_seleksi->do_seleksi2($jur2->kode_jurusan,$sekarang);
			 	}		 		
		 		foreach ($p2->result() as $pes2) {			 		
                        $this->m_seleksi->set_terisi($pes2->pil_2);
			 			$this->m_seleksi->set_lulus($pes2->no_pes);
			 			$this->m_seleksi->kelulusan($pes2->no_pes,$pes2->pil_2,'pil_2');		 		      
		 		}	 		
            }
		 	/*$j2=$this->m_seleksi->get_jurusan2();
		 	foreach ($j2->result() as $jur2) {
		 		
		 	}*/
		 	redirect(''.base_url().'seleksi/jurusan/'.$id, 'refresh');
	}        

	function get_terisi(){
		$kode_jurusan=$this->input->post('jur');
		$terisi=$this->m_seleksi->get_terisi($kode_jurusan);
		echo $terisi;
	}
}