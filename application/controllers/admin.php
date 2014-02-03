<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
   //kontruksi yang dijalan otomatis pada saat class dipanggil 
       public function __construct()
		 {
		   parent::__construct();
		   $this->load->helper(array('form','url', 'text_helper','date'));
           $this->load->library('session');
           $this->load->library('tanggal');
		   $this->load->model('m_admin');
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
			$data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('nama_admin');
			$data['posisi']='home';
			$data['bread']='<li><a style="text-decoration:none" href="./">Home</a><span class="divider">/</span></li>';
			if(($data['sessi']!='') && ($data['level']=='admin')) {
			   
			   	$this->load->view('admin/head',$data);
				$this->load->view('admin/menu',$data);
				$this->load->view('admin/home',$data);
				
			}
			else {
			 	$this->load->view('admin/login');
				
			 }
		 }
         
         //fungsi anti injeksi
		public function anti_injection($data){
	        $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	        return $filter;
	     }
       
        //fungsi cek login
		public function cek_login(){
			$username = $this->anti_injection($_POST['username']);
            $pass     = $this->anti_injection(md5($_POST['password']));
            if (!ctype_alnum($username) OR !ctype_alnum($pass)){
			  echo "Sekarang loginnya tidak bisa di injeksi lho.";
			}
			else{
					$hasil=$this->m_admin->cek_login($username,$pass);
					if($hasil==true){
						$data= array('admin' => $username ,
						             'level' => 'admin',
						             'nama_admin' => $username
						             );
						$this->session->set_userdata($data);
		                echo "sukses";
					}
					else {
						echo "gagal";
					}
			}
		}

		 
        
        //fungsi menampilkan home
		public function home(){
			$data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('username');
			if($data['level']!='admin'){
                 echo "<script>alert('ANDA BELUM LOGIN');
                          document.location='./';
                       </script>";
			}

			else {
				$this->load->view('admin/head',$data);
				$this->load->view('admin/menu',$data);
				$this->load->view('admin/home',$data);
			}
			
		}
        
      

		//fungsi logout
		function logout() {
		  $this->session->unset_userdata('admin'); 
		  $this->session->unset_userdata('level');
		  $this->session->unset_userdata('nama_admin');
	      header("location:".base_url()."admin");
		}

}