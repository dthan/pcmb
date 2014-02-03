<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/*
class untuk konversi librari tanggal
*/
class cek_login extends CI_Controller
{
	public function __construct()
		 {
		  
          $this->load->library('session');
		  $sessi=$this->session->userdata('admin');
		  $level=$this->session->userdata('level');
		  if($sessi==''){
                 echo "<script>alert('ANDA BELUM LOGIN');
                          document.location='".base_url()."admin';
                         </script>";
		   }
		   else if((isset($level)) && ($level!='admin')){
				  echo "<script>alert('ANDA TIDAK BERHAK MENGAKSES MODUL INI');
                          document.location='".base_url()."pengawas';
                       </script>";
			}
	}

}