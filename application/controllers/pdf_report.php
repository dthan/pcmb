<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
     * APLICATION INFO  : PDF Report with FPDF 1.6
     * DATE CREATED     : 21 April 2012
	 * DEVELOPED BY     : Anton Sofyan, A.Md
          
     * CONTACT    
     *   - Email        : antonsofyan@yahoo.com
     *   - Blog         : http://antonsofyan.stikeskuningan.ac.id/
     *   - Facebook     : http://facebook.com/antonsofyan     
     *   - Office       : Gedung Lantai 2 UPT Laboratorium Komputer
                          Sekolah Tinggi Ilmu Kesehatan Kuningan (STIKKU)
     *   - Address      : Jalan Lingkar Kadugede No. 02 Kabupaten Kuningan - Propinsi Jawa Barat
     
     * POWERED BY       : CodeIgniter 2.1 & FPDF 1.6	 
	 */

class Pdf_report extends CI_Controller {
	
	public function index()
	{
	    // Load library FPDF 
	    $this->load->library('fpdf');
        
        // Load Database
        $this->load->database();
        
        /* buat konstanta dengan nama FPDF_FONTPATH, kemudian kita isi value-nya
           dengan alamat penyimpanan FONTS yang sudah kita definisikan sebelumnya.
           perhatikan baris $config['fonts_path']= 'system/fonts/'; 
           didalam file application/config/config.php
        */            
        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
        
        // Load model "karyawan_model"
        $this->load->model('karyawan_model');
        
        /* Kita akses function get_all didalam karyawan_model
           function get_all merupakan fungsi yang dibuat untuk mengambil
           seluruh data karyawan didalam database.
        */
        $data['karyawan'] = $this->karyawan_model->get_all();
        
        // Load view "pdf_report" untuk menampilkan hasilnya        
		$this->load->view('pdf_report', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */