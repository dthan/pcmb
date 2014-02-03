<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tes_input extends CI_Controller {
		 public function __construct()
		 {
		   parent::__construct();
		   $this->load->helper(array('form','url', 'text_helper','date'));
           $this->load->library('session');
		   $this->load->model('tes');
		   $this->load->model('pcmb');
           $this->load->helper('form');
		   define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		 }

		 public function index(){
		 $no_pes=131000049;
	
		 $i=1;
		   $pass=md5('1234');
		   for($i=1;$i<=100;$i++){
		   //while($i<5){
		   	 $numbers = array(
					      '20201','45201','46201','47201','54211','44201'
					      );
			  shuffle($numbers);
			    //echo $numbers[0];		   	  
		   	  $ruang_tes=$this->pcmb->ruang_tes();
		   	  $data = array(
					'nama' => 'matematika'.$i,
					'tempat_lahir' => 'subang'.$i,
					'tgl_lahir' => '1991-03-12',
					'id_propinsi' => '2',
					'id_kota' => '219',
					'no_pes' => $no_pes,
					'alamat' => 'Subang'.$i,
					'jk' => 'L',
					'warga' => 'WNI',
					'id_agama' => '1',
					'pil_1' => '46201',
					'pil_2' => '55201',		
					'kode_sekolah' => '10100112',
					'jenis_sekolah' => '1',
					'alamat_sekolah' => 'Tanjungsiang',
					'program' => '1',
					'tahun_lulus' => '2008',
					'nilai_ijazah' => '50',
					'ayah' => 'akbar',
					'ibu' => 'anis',
					'provinsi_ortu' => '2',
					'kota_ortu' => '219',
					'alamat_ortu' => 'subang',
					'pend_ayah' => '5',
					'pend_ibu' => '5',
					'pekerjaan_ayah' => '1',			
					'pekerjaan_ibu' => '1',		
					'penghasilan_ortu' => '9',		
					'telp_ayah' => '07843748343',		
					'telp_ibu' => '087483434',	
					'kode_post_ortu' => '41284',					
					'id_ruang_tes' => $ruang_tes,
					'no_hp' => '085220795671',
					'password'=> $pass
					);
		   	  $this->pcmb->simpan_data1($data);
		   	  $this->pcmb->isi_ruangan($ruang_tes);
		   	 $no_pes++;
		  }
          
		 }

		 public function well(){
				$numbers = array(
					      '1','2','3','4','5'
					      );
				shuffle($numbers);
			    echo $numbers[0];
				    
				
		 }
}