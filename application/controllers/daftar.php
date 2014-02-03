<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftar extends CI_Controller {
        
       //kontruksi yang dijalan otomatis pada saat class dipanggil 
       public function __construct()
		 {
		   parent::__construct();
		   $this->load->helper(array('form','url', 'text_helper','date'));
           $this->load->library('session');
           $this->load->library('tanggal');
		   $this->load->model('pcmb');
		   $this->load->model('m_berita');
		   $this->load->library('fpdf');
		   define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		 }

		public function index()
		{
			$data['aktif'] = "pendaftaran";
			$data['title'] = "login";
			$data['sessi'] = $this->session->userdata('id_user');
            $data["prov"]= $this->pcmb->get_provinsi();
            $data["agama"] = $this->pcmb->get_agama();
			$data['aktif'] = "pendaftaran";
			 $data['headline'] = $this->m_berita->berita_headline();
			$data['cek_daftar'] = $this->pcmb->cek_daftar($data['sessi']);
			$data['data_diri'] = $this->pcmb->data_diri($data['sessi']);
			if($data['sessi']!=''){
				header('location:daftar/formulir');
			}
			else {
			 $this->load->view('head',$data);
			$this->load->view('menu',$data);
			$this->load->view('pendaftaran');
			$this->load->view('footer');	
			}
			
		}

		//fungsi mencetek kartu ujian
		public function cetak_kartu(){
		   $id_user = $this->session->userdata('id_user');
           $data['data_diri'] = $this->pcmb->data_cetak_kartu($id_user);
           $data['sessi'] = $this->session->userdata('username');
           if($data['sessi']==''){
                 echo "<script>alert('ANDA BELUM LOGIN');
                          document.location='./../../';
                         </script>";
			}
			else {
			  $this->load->view('kartu_ujian',$data);	
			}
           
		}

        
        //fungsi menampilkan form pertama dan form data diri
		function formulir(){
            $data['sessi'] = $this->session->userdata('username');
            $data['title'] = "Input data diri";
            $data["pendidikan"] = $this->pcmb->pendidikan_ortu();
            $data["pekerjaan"] = $this->pcmb->pekerjaan_ortu();
            $data["penghasilan"] = $this->pcmb->penghasilan_ortu();
            $data["prov"]= $this->pcmb->get_provinsi();
            $data["agama"] = $this->pcmb->get_agama();
			$data['aktif'] = "pendaftaran";
			$data["sekolah"]= $this->pcmb->get_sekolah();
            $data["program"]= $this->pcmb->get_program();
            $data['fakultas'] = $this->pcmb->get_fak();
			$data['cek_daftar'] = $this->pcmb->cek_daftar($data['sessi']);	
			//$data['tanggal'] = $this->tanggal->tgl_indo($dta->tgl_lahir);
			$this->load->view('head',$data);
			$this->load->view('menu',$data);
			if($data['cek_daftar']==true){
				
				$data['data_diri'] = $this->pcmb->data_diri($data['sessi']);
				foreach ($data['data_diri']->result() as $dta) {
					$dta->nama;
				}

				$data['prov_sekolah']=$this->pcmb->get_provinsi2($dta->kode_sekolah);
				$data['kota_sekolah']=$this->pcmb->get_kota2($dta->kode_sekolah);
				$data["sekolah2"]= $this->pcmb->get_sekolah2($data['kota_sekolah']);
				$data["kota_sek"]= $this->pcmb->get_kota3($data['prov_sekolah']);
				$data['fak2'] = $this->pcmb->get_fak2($dta->pil_1);
				$data['fak3'] = $this->pcmb->get_fak2($dta->pil_2);
				$data['jur'] = $this->pcmb->get_jur($data['fak2']);
				$data['jur2'] = $this->pcmb->get_jur($data['fak3']);
				$data['kab'] = $this->pcmb->get_kab($dta->id_propinsi);
				$data['tanggal'] = $this->tanggal->tgl_indo($dta->tgl_lahir);
				$data['sessi'] = $this->session->userdata('username');
                $this->load->view('profil',$data);
			}
			else {
				$data['sessi'] = $this->session->userdata('username');
				$this->load->view('formulir',$data);
			}
			
			$this->load->view('footer');
		}
        
        //fungsi menampilkan form pada step2
		function form2(){
			$data['sessi'] = $this->session->userdata('username');
            $data["sekolah"]= $this->pcmb->get_sekolah();
            $data["program"]= $this->pcmb->get_program();
            $data["agama"] = $this->pcmb->get_agama();
            $data["prov"]= $this->pcmb->get_provinsi();
           	$data['aktif'] = "pendaftaran";
           	$data['cek_daftar'] = $this->pcmb->cek_form2($data['sessi']);
			
			$this->load->view('head');
			$this->load->view('menu',$data);
			$this->load->view('formulir2',$data);
			$this->load->view('footer');
		   
		}

        //fungsi menampilkan form pada step3
		function form3(){
			$data['sessi'] = $this->session->userdata('username');
            $data["sekolah"]= $this->pcmb->get_sekolah();
            $data["program"]= $this->pcmb->get_program();
            $data["agama"] = $this->pcmb->get_agama();
            $data["pendidikan"] = $this->pcmb->pendidikan_ortu();
            $data["pekerjaan"] = $this->pcmb->pekerjaan_ortu();
            $data["penghasilan"] = $this->pcmb->penghasilan_ortu();
            $data["agama"] = $this->pcmb->get_agama();
            $data["prov"]= $this->pcmb->get_provinsi();
           	$data['aktif'] = "pendaftaran";
           	$data['cek_daftar'] = $this->pcmb->cek_form3($data['sessi']);
			if($data['cek_daftar']==false){
				 header("location:".base_url()."daftar/formulir/".$data['sessi']);
			}
			else {
			$this->load->view('head');
			$this->load->view('menu',$data);
			$this->load->view('formulir3',$data);
			$this->load->view('footer');
		   }
		}

        //fungsi menampilkan form pada step 4
		function form4(){
			$data['sessi'] = $this->session->userdata('username');
            $data['fakultas'] = $this->pcmb->get_fak();
            $data['aktif'] = "pendaftaran";
           	$data['cek_daftar'] = $this->pcmb->cek_form4($data['sessi']);
           	if($data['cek_daftar']==false){
				 header("location:".base_url()."daftar/formulir/".$data['sessi']);
			}
			else {
			$this->load->view('head');
			$this->load->view('menu',$data);
			$this->load->view('formulir4',$data);
			$this->load->view('footer');
		   }
		}

	   //fungsi login
		function login() {
			$username = $this->input->post('username'); //membaca data dari form username
			$password = $this->input->post('password'); //membaca data dari pssword
			$passwordx = md5($password); //enkrip password menjadi md5
			$hasil=$this->pcmb->login($username,$passwordx);
			$login=$this->pcmb->data_login($username,$passwordx);
			if($hasil==true){
			if ($login->num_rows() > 0) {
					 foreach ($login->result() as $p) {
					# code...
				   }
				$this->session->set_userdata('id_user',$p->id_pendaftar);
			}
		        $this->session->set_userdata('password',$passwordx);
				$this->session->set_userdata('username',$username);				
				echo "sukses";
			}
			else {
				echo "gagal";
			}
			
		}

        //fungsi medapatkan data dari tabel kota
		function get_kota(){
			$prov = $this->input->post('id');
			$kota = $this->pcmb->get_kab($prov);
			echo "<option value='' selected>-pilih kota-</option>";
			foreach ($kota->result() as $pr) {
				echo "<option value='".$pr->id_kota."'>".$pr->nama_kota."</option>";
			}
		}

		//fungsi medapatkan data dari tabel kota
		function get_kota2(){
			$prov = $this->input->post('id');
			$kota = $this->pcmb->get_kab($prov);
			
			foreach ($kota->result() as $pr) {
				echo "<option value='".$pr->id_kota."'>".$pr->nama_kota."</option>";
			}
		}
        
        //fungsi mendapatkan data dari tabel jurusan
		function get_jur(){
			$fak = $this->input->post('id');
			$jur = $this->pcmb->get_jur($fak);
			foreach ($jur->result() as $j) {
				echo "<option value='".$j->kode_jurusan."'>".$j->nama_jurusan."</option>";
			}
		}

		   //fungsi mendapatkan data dari tabel sekolah
		function get_sekolah(){
			$kota = $this->input->post('id');
			$sekolah = $this->pcmb->get_sekolah2($kota);
			echo "<option required='' value=''>-pilih sekolah-</option>";
			foreach ($sekolah->result() as $sek) {
				echo "<option value='".$sek->kode_sekolah."'>".$sek->nama_smta."</option>";
			}
		}
        
        //fungsi untuk aksi input pada form step 1
		function input_1(){
            $config['upload_path']    = "./upload/foto_pendaftar";
		    $config['allowed_types'] = 'gif|jpg|png|jpeg';
		    $config['max_size']     = '2000';
		    $config['max_width'] = '2000';
		    $config['max_height']= '2000';
		    //load library upload
		    $this->load->library('upload', $config);
		   //photo adalah nama field
		   
			 
			    if (!$this->upload->do_upload("photo")) {
			        $error = array('error' => $this->upload->display_errors());
			        print_r($error);
			     }else {
			        //state jika berhasil
			     }  
			     $fotox = $this->upload->data("photo");
		         $foto = $fotox['file_name'];
		         if($fotox['file_name']!=''){
		         $data = array(
					'nama' => $this->input->post('nama'),
					'tempat_lahir' => $this->input->post('tempat'),
					'tgl_lahir' => $this->input->post('ttl'),
					'jk' => $this->input->post('jk'),
					'warga' => $this->input->post('warga'),
					'id_agama' => $this->input->post('agama'),
					'id_propinsi' => $this->input->post('provinsi'),
					'id_kota' => $this->input->post('kota'),
					'no_pes' => $this->input->post('no_pes'),
					'no_hp' => $this->input->post('no_hp'),
					'foto' => $foto,
					'alamat' => $this->input->post('alamat')
					);
			   }

			   else {
			   	$data = array(
					'nama' => $this->input->post('nama'),
					'tempat_lahir' => $this->input->post('tempat'),
					'tgl_lahir' => $this->input->post('ttl'),
					'jk' => $this->input->post('jk'),
					'warga' => $this->input->post('warga'),
					'id_agama' => $this->input->post('agama'),
					'id_propinsi' => $this->input->post('provinsi'),
					'id_kota' => $this->input->post('kota'),
					'no_hp' => $this->input->post('no_hp'),
					'alamat' => $this->input->post('alamat')
					);
			   }
		
			
				$this->pcmb->update_data1($data,$this->input->post('no_pes'));
				header("location:".base_url()."daftar/formulir/".$this->input->post('no_pes'));
			
			

		}

        //fungsi untuk aksi input pada form step 2
		function input_2(){
             $user = $this->input->post('username');
			$data = array(
			'kode_sekolah' => $this->input->post('nama_sekolah'),
			'jenis_sekolah' => $this->input->post('jenis_sekolah'),
			'alamat_sekolah' => $this->input->post('alamat_sekolah'),
			'program' => $this->input->post('program'),
			'tahun_lulus' => $this->input->post('tahun_lulus'),
			'nilai_ijazah' => $this->input->post('nilai_ijazah')			
			);
			$this->pcmb->simpan_data2($data,$user);
			if($this->input->post('aksi')=='input'){
			  header("location:".base_url()."daftar/form3/");
             }
             else {
             	header("location:".base_url()."daftar/formulir/".$user);
             }
		}
        

        //fungsi untuk aksi input pada form step 3
		function input_3(){
             $user = $this->input->post('username');
			$data = array(
			'ayah' => $this->input->post('ayah'),
			'ibu' => $this->input->post('ibu'),
			'provinsi_ortu' => $this->input->post('provinsi_ortu'),
			'kota_ortu' => $this->input->post('kota_ortu'),
			'alamat_ortu' => $this->input->post('alamat_ortu'),
			'pend_ayah' => $this->input->post('pend_ayah'),
			'pend_ibu' => $this->input->post('pend_ibu'),
			'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah'),			
			'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu'),		
			'penghasilan_ortu' => $this->input->post('penghasilan_ortu'),		
			'telp_ayah' => $this->input->post('telp_ayah'),		
			'telp_ibu' => $this->input->post('telp_ibu'),	
			'kode_post_ortu' => $this->input->post('kode_post_ortu')
			);
			$this->pcmb->simpan_data3($data,$user);
			if($this->input->post('aksi')=='input'){
			   header("location:".base_url()."daftar/form4/");
		    }
		    else {
		       header("location:".base_url()."daftar/formulir/".$user);	
		    }

		}

		//fungsi untuk aksi input pada form step 4
		function input_4(){
             $user = $this->input->post('username');
			$data = array(
			'pil_1' => $this->input->post('pil_1'),
			'pil_2' => $this->input->post('pil_2')
			);
			$this->pcmb->simpan_data4($data,$user);
			
			header("location:".base_url()."daftar/formulir/".$user);

		}

		function input_data(){
            $config['upload_path']    = "./upload/foto_pendaftar";
		    $config['allowed_types'] = 'gif|jpg|png|jpeg';
		    $config['max_size']     = '2000';
		    $config['max_width'] = '2000';
		    $config['max_height']= '2000';
		    //load library upload
		    $this->load->library('upload', $config);
		    $ruang_tes=$this->pcmb->ruang_tes();
			  if($this->upload->data("photo")!=''){
			    if (!$this->upload->do_upload("photo")) {
			        $error = array('error' => $this->upload->display_errors());
			        print_r($error);
			     }else {
			        //state jika berhasil
			     }  
			     $fotox = $this->upload->data("photo");
		         $foto = $fotox['file_name'];
		         $data = array(
					'nama' => $this->input->post('nama'),
					'tempat_lahir' => $this->input->post('tempat'),
					'tgl_lahir' => $this->input->post('ttl'),
					'jk' => $this->input->post('jk'),
					'warga' => $this->input->post('warga'),
					'id_agama' => $this->input->post('agama'),
					'id_propinsi' => $this->input->post('provinsi'),
					'id_kota' => $this->input->post('kota'),
					'no_pes' => $this->input->post('no_pes'),
					'foto' => $foto,
					'alamat' => $this->input->post('alamat'),
					'no_hp' => $this->input->post('no_hp'),
					'kode_sekolah' => $this->input->post('nama_sekolah'),
					'jenis_sekolah' => $this->input->post('jenis_sekolah'),
					'alamat_sekolah' => $this->input->post('alamat_sekolah'),
					'program' => $this->input->post('program'),
					'tahun_lulus' => $this->input->post('tahun_lulus'),
					'nilai_ijazah' => $this->input->post('nilai_ijazah'),
					'ayah' => $this->input->post('ayah'),
					'ibu' => $this->input->post('ibu'),
					'provinsi_ortu' => $this->input->post('provinsi_ortu'),
					'kota_ortu' => $this->input->post('kota_ortu'),
					'alamat_ortu' => $this->input->post('alamat_ortu'),
					'pend_ayah' => $this->input->post('pend_ayah'),
					'pend_ibu' => $this->input->post('pend_ibu'),
					'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah'),			
					'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu'),		
					'penghasilan_ortu' => $this->input->post('penghasilan_ortu'),		
					'telp_ayah' => $this->input->post('telp_ayah'),		
					'telp_ibu' => $this->input->post('telp_ibu'),	
					'kode_post_ortu' => $this->input->post('kode_post_ortu'),
					'pil_1' => $this->input->post('pil_1'),
					'pil_2' => $this->input->post('pil_2'),
					'password' => $this->session->userdata('password'),
					'id_ruang_tes' => $ruang_tes
					);
			   }

			   else {
			   	$data = array(
					'nama' => $this->input->post('nama'),
					'tempat_lahir' => $this->input->post('tempat'),
					'tgl_lahir' => $this->input->post('ttl'),
					'jk' => $this->input->post('jk'),
					'warga' => $this->input->post('warga'),
					'id_agama' => $this->input->post('agama'),
					'id_propinsi' => $this->input->post('provinsi'),
					'id_kota' => $this->input->post('kota'),
					'no_pes' => $this->input->post('no_pes'),
					'alamat' => $this->input->post('alamat'),
					'no_hp' => $this->input->post('no_hp'),
			    	'kode_sekolah' => $this->input->post('nama_sekolah'),
					'jenis_sekolah' => $this->input->post('jenis_sekolah'),
					'alamat_sekolah' => $this->input->post('alamat_sekolah'),
					'program' => $this->input->post('program'),
					'tahun_lulus' => $this->input->post('tahun_lulus'),
					'nilai_ijazah' => $this->input->post('nilai_ijazah'),
					'ayah' => $this->input->post('ayah'),
					'ibu' => $this->input->post('ibu'),
					'provinsi_ortu' => $this->input->post('provinsi_ortu'),
					'kota_ortu' => $this->input->post('kota_ortu'),
					'alamat_ortu' => $this->input->post('alamat_ortu'),
					'pend_ayah' => $this->input->post('pend_ayah'),
					'pend_ibu' => $this->input->post('pend_ibu'),
					'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah'),			
					'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu'),		
					'penghasilan_ortu' => $this->input->post('penghasilan_ortu'),		
					'telp_ayah' => $this->input->post('telp_ayah'),		
					'telp_ibu' => $this->input->post('telp_ibu'),	
					'kode_post_ortu' => $this->input->post('kode_post_ortu'),
					'pil_1' => $this->input->post('pil_1'),
					'pil_2' => $this->input->post('pil_2'),
					'password' => $this->session->userdata('password'),
					'id_ruang_tes' => $ruang_tes
					);
			   }
			   $this->pcmb->simpan_data1($data);
			   $this->pcmb->isi_ruangan($ruang_tes);	
			   $this->pcmb->set_kehadiran($this->input->post('no_pes'),$ruang_tes);	
			   $this->pcmb->set_nilai($this->input->post('no_pes'));	   
			   $login=$this->pcmb->data_login2($this->session->userdata('username'));
		       foreach ($login->result() as $p) {
					# code...
				}
				$this->session->set_userdata('id_user',$p->id_pendaftar);
			    header("location:".base_url()."daftar/formulir/".$this->input->post('no_pes'));
		
		}



		//fungsi logout
		function logout() {
		$this->session->unset_userdata('username'); 
		$this->session->unset_userdata('id_user'); 
		$this->session->unset_userdata('password'); 
	    header("location:".base_url());
		}

		//fungsi untuk upload photo
		function upload_photo(){
		    $config['upload_path']    = "./upload/foto_pendaftar";
		    $config['allowed_types'] = 'gif|jpg|png|jpeg';
		    $config['max_size']     = '2000';
		    $config['max_width'] = '2000';
		    $config['max_height']= '2000';
		    //load library upload
		    $this->load->library('upload', $config);
		   //photo adalah nama field
		    if (!$this->upload->do_upload("photo")) {
		        $error = array('error' => $this->upload->display_errors());
		        print_r($error);
		     }else {
		        //state jika berhasil
		     }       
		}

		function edit_form(){
			$this->load->view('edit_form');
		}
        
}
