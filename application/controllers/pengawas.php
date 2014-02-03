<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengawas extends CI_Controller {
   //kontruksi yang dijalan otomatis pada saat class dipanggil 
       public function __construct()
		 {
		   parent::__construct();
		   $this->load->helper(array('form','url', 'text_helper','date'));
           $this->load->library('session');
           $this->load->library('tanggal');
		   $this->load->model('m_admin');
		   $this->load->model('m_pengawas');
		   $this->load->model('pcmb');
		   $this->load->library('fpdf');
		   $this->load->helper('flexigrid');
		   $this->load->helper('peserta');
           $this->load->library('flexigrid');
           $this->load->helper('form');
		   define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		 }
         
         public function index()
		 {
			$data['sessi']=$this->session->userdata('pengawas');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('nama_admin');
			$data['posisi']='home';
			$data['bread']='<li><a style="text-decoration:none" href="./">Home</a><span class="divider">/</span></li>';
			if(($data['sessi']!='') && ($data['level']=='pengawas')) {
			  
			    $this->load->view('admin/head',$data);
				$this->load->view('admin/menu',$data);
				$this->load->view('admin/home',$data);
			}
			else {
			 	 $this->load->view('admin/login_pengawas');
				
			 }
		 }
         
         //fungsi anti injeksi
		function anti_injection($data){
	        $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	        return $filter;
	     }
       


		    public function cek_login(){
			$username = $this->anti_injection($_POST['username']);
            $pass     = $this->anti_injection($_POST['password']);
            if (!ctype_alnum($username) OR !ctype_alnum($pass)){
			  echo "Sekarang loginnya tidak bisa di injeksi lho.";
			}
			else{
					$hasil=$this->m_pengawas->cek_login($username,$pass);
					if($hasil->num_rows() > 0){
			         	foreach ($hasil->result() as $h) {
			         		# code...
			         	}
			         	$this->session->set_userdata('pengawas',$h->username);
			         	$this->session->set_userdata('level','pengawas');
			         	$this->session->set_userdata('nama_admin',$h->username);
			         	$this->session->set_userdata('id_pengawas',$h->id_pengawas);
			         	$this->session->set_userdata('id_ruang_tes',$h->id_ruang_tes);
			         	echo "sukses";
			         }
			         else {
			         	echo "gagal";
			         }
					
			}
		}
        
      
      

		public function absen(){
			$data['sessi']=$this->session->userdata('pengawas');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('nama_admin');
			$data['id_ruang_tes']=$this->session->userdata('id_ruang_tes');
			$data['peserta']=$this->m_pengawas->peserta($this->session->userdata('id_ruang_tes'));
			$data['posisi']='home';
			$data['bread']='<li><a style="text-decoration:none" href="./">Home</a><span class="divider">/</span></li>';
			if(($data['sessi']!='') && ($data['level']=='pengawas')) {
			   
			   $this->load->view('admin/head_pengawas',$data);
				$this->load->view('admin/menu',$data);
				$this->load->view('admin/absen_peserta',$data);
				$this->load->view('admin/footer');
			}
			else {
			 	$this->load->view('admin/login_pengawas');
			}
				
			 
		}

		public function set_absen_agama(){
			$no_pes=$this->input->post('no_pes');
			$q=$this->m_pengawas->set_absen_agama($no_pes);
			if($q){
              echo "sukses";
			}
			else{
              echo "gagal";
			}
		}

		 public function set_tidak_hadir_agama(){
			$no_pes=$this->input->post('no_pes');
			$q=$this->m_pengawas->set_absen_agama_tidak($no_pes);
			if($q){
              echo "sukses";
			}
			else{
              echo "gagal";
			}
		}

		public function set_absen_wawancara(){
			$no_pes=$this->input->post('no_pes');
			$q=$this->m_pengawas->set_absen_wawancara($no_pes);
			if($q){
              echo "sukses";
			}
			else{
              echo "gagal";
			}
		}

		public function set_tidak_hadir_wawancara(){
			$no_pes=$this->input->post('no_pes');
			$q=$this->m_pengawas->set_tidak_hadir_wawancara($no_pes);
			if($q){
              echo "sukses";
			}
			else{
              echo "gagal";
			}
		}

		public function set_absen_wawancara_all(){
			$ruang_tes=$this->input->post('ruang_tes');
			$q=$this->m_pengawas->set_hadir_wawancara_all($ruang_tes);
			if($q){
              echo "sukses";
			}
			else{
              echo "gagal";
			}
		}

		public function set_absen_wawancara_all_no(){
			$ruang_tes=$this->input->post('ruang_tes');
			$q=$this->m_pengawas->set_tidak_hadir_wawancara_all($ruang_tes);
			if($q){
              echo "sukses";
			}
			else{
              echo "gagal";
			}
		}
         

         public function set_absen_umum(){
			$no_pes=$this->input->post('no_pes');
			$q=$this->m_pengawas->set_absen_umum($no_pes);
			if($q){
              echo "sukses";
			}
			else{
              echo "gagal";
			}
		}

		 public function set_tidak_hadir_umum(){
			$no_pes=$this->input->post('no_pes');
			$q=$this->m_pengawas->set_absen_umum_tidak($no_pes);
			if($q){
              echo "sukses";
			}
			else{
              echo "gagal";
			}
		}

		public function set_absen_bahasa(){
			$no_pes=$this->input->post('no_pes');
			$q=$this->m_pengawas->set_absen_bahasa($no_pes);
			if($q){
              echo "sukses";
			}
			else{
              echo "gagal";
			}
		}

		 public function set_tidak_hadir_bahasa(){
			$no_pes=$this->input->post('no_pes');
			$q=$this->m_pengawas->set_absen_bahasa_tidak($no_pes);
			if($q){
              echo "sukses";
			}
			else{
              echo "gagal";
			}
		}



		public function set_absen_agama_all(){
			$ruang_tes=$this->input->post('ruang_tes');
			$q=$this->m_pengawas->set_absen_agama_all($ruang_tes);
			if($q){
              echo "sukses";
			}
			else{
              echo "gagal";
			}
		}

		public function set_absen_agama_all_no(){
			$ruang_tes=$this->input->post('ruang_tes');
			$q=$this->m_pengawas->set_absen_agama_all_no($ruang_tes);
			if($q){
              echo "sukses";
			}
			else{
              echo "gagal";
			}
		}

		public function set_absen_umum_all(){
			$ruang_tes=$this->input->post('ruang_tes');
			$q=$this->m_pengawas->set_absen_umum_all($ruang_tes);
			if($q){
              echo "sukses";
			}
			else{
              echo "gagal";
			}
		}

		public function set_absen_umum_all_no(){
			$ruang_tes=$this->input->post('ruang_tes');
			$q=$this->m_pengawas->set_absen_umum_all_no($ruang_tes);
			if($q){
              echo "sukses";
			}
			else{
              echo "gagal";
			}
		}

		public function set_absen_bahasa_all(){
			$ruang_tes=$this->input->post('ruang_tes');
			$q=$this->m_pengawas->set_absen_bahasa_all($ruang_tes);
			if($q){
              echo "sukses";
			}
			else{
              echo "gagal";
			}
		}

		public function set_absen_bahasa_all_no(){
			$ruang_tes=$this->input->post('ruang_tes');
			$q=$this->m_pengawas->set_absen_bahasa_all_no($ruang_tes);
			if($q){
              echo "sukses";
			}
			else{
              echo "gagal";
			}
		}

	   
        

      

		//fungsi logout
		function logout() {
		  $this->session->unset_userdata('pengawas'); 
		  $this->session->unset_userdata('level');
		  $this->session->unset_userdata('nama_admin');
		  $this->session->unset_userdata('id_pengawas');
		  $this->session->unset_userdata('id_ruang_tes');
	      header("location:".base_url()."pengawas");
		}

}