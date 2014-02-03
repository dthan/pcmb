<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hasil_tes extends CI_Controller {
   //kontruksi yang dijalan otomatis pada saat class dipanggil 
       public function __construct()
		 {
		   parent::__construct();
		   $this->load->helper(array('form','url', 'text_helper','date'));
		    $this->load->helper('file');
           $this->load->library('session');
           $this->load->library('tanggal');
		   $this->load->model('m_hasil_tes');
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
			$data['posisi']='hasil_tes';
			$data['bread']='<li><a style="text-decoration:none" href="./">Home</a><span class="divider">/</span></li>';
			if($data['sessi']==''){
			   $this->load->view('admin/login');
			}
			else {
				$data['sessi']=$this->session->userdata('admin');
				$data['level']=$this->session->userdata('level');
				$data['username']=$this->session->userdata('username');
				$data['posisi']='hasil_tes';
				$colModel['no_pes2'] = array('No',30,FALSE,'center',0);
				$colModel['no_pes'] = array('No Peserta ',100,TRUE,'left',2);
				$colModel['nama'] = array('Nama ',100,TRUE,'left',2);
				$colModel['pilihan1'] = array('Pilihan 1 ',100,TRUE,'left',2);
				$colModel['pilihan2'] = array('Pilihan 2 ',100,TRUE,'left',2);
				$colModel['nilai_umum'] = array('ujian umum ',100,TRUE,'left',2);
				$colModel['nilai_agama'] = array('ujian agama',100,TRUE,'left',2);
				$colModel['nilai_bahasa'] = array('ujian bahasa ',100,TRUE,'left',2);
				$colModel['nilai_essay'] = array('Essay ',100,TRUE,'left',2);
				$gridParams = array(
					'width' => 'auto',
					'height' => 'auto',
					'rp' => 10,
					'singleSelect' => true,
					'rpOptions' => '[5,10,15,20,25,40,100]',
					'pagestat' => 'Displaying: {from} to {to} of {total} items.',
					'blockOpacity' => 0.5,
					'title' => 'DATA hasil_tes',
					'showTableToggleBtn' => true
				);
				
				
				$buttons[] = array('Refresh','refresh','test');
				$buttons[] = array('separator');
	           
	            $data['bread']='<li><a style="text-decoration:none" href="./">Home</a><span class="divider">/</span></li>
	                            <li class="active">hasil_tes</li>';
	            

				$grid_js = build_grid_js('flex1',base_url()."hasil_tes/ajax_hasil_tes",$colModel,'id','asc',$gridParams,$buttons);
				
				$data['js_grid'] = $grid_js;
				//$this->load->view('barang',$data);
			    if($data['level']!='admin'){
					  echo "<script>alert('ANDA TIDAK BERHAK MENGAKSES MODUL INI');
	                          document.location='".base_url()."pengawas';
	                       </script>";
				}
				else if($data['sessi']==''){
	                 echo "<script>alert('ANDA BELUM LOGIN');
	                          document.location='./';
	                         </script>";
				}
				else {
					$this->load->view('admin/head',$data);
					$this->load->view('admin/menu',$data);
					$this->load->view('admin/hasil_tes',$data);
					$this->load->view('admin/footer');
				}
			 	
				
			 }
		 }

		 public function ajax_hasil_tes() {
			
		$valid_fields = array('no_pes','nama','pilihan1','pilihan2','nilai_umum','nilai_agama','nilai_bahasa','nilai_essay');
		$this->flexigrid->validate_post('no_pes','asc',$valid_fields);		
		$records = $this->m_hasil_tes->get_nilai();
		$this->output->set_header($this->config->item('json_header'));
		
		$i=1;
		foreach ($records['records']->result() as $row) {
			//$tgl=$this->tanggal->tgl_indo($row->tgl_lahir);
			$record_items[] = array($row->no_pes,
			$i++,
			$row->no_pes,
			$row->nama,
			$row->pilihan1,
			$row->pilihan2,
			$row->nilai_umum,
			$row->nilai_agama,
			$row->nilai_bahasa,
			$row->nilai_essay
			
			);
		}

		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		
	    }

		function do_upload()
		{
			$data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('username');
			$data['posisi']='hasil_tes';
			$data['bread']='<li><a style="text-decoration:none" href="./">Home</a><span class="divider">/</span></li>';
			if($data['sessi']==''){
			   $this->load->view('admin/login');
			}
			else {
			$config['upload_path'] = './temp_upload/';
			$config['allowed_types'] = 'xls';
	                
			$this->load->library('upload', $config);
	                

			if ( ! $this->upload->do_upload())
			{
				$data = array('error' => $this->upload->display_errors());
				
			}
			else
			{
	            $data = array('error' => false);
				$upload_data = $this->upload->data();

	            $this->load->library('excel_reader');
				$this->excel_reader->setOutputEncoding('CP1251');

				$file =  $upload_data['full_path'];
				$this->excel_reader->read($file);
				error_reporting(E_ALL ^ E_NOTICE);

				// Sheet 1
				$data = $this->excel_reader->sheets[0] ;
	                        $dataexcel = Array();
	        /*     $items = Array('50','51','52','53','54','55','56','57','58','59','60',
	            	           '61','62','63','64','65','66','67','68','69','70',
	            	           '71','72','73','74','75','76','77','78','79','89',
	            	           '81','82','84','84','85','86','87','88','89','90',
            	           '91','92','94','94','95','96','97','98','99');*/
				for ($i = 1; $i <= $data['numRows']; $i++) {

	                            if($data['cells'][$i][1] == '') break;
	                            $dataexcel[$i-1]['no_pes'] = $data['cells'][$i][1];
	                            $dataexcel[$i-1]['ujian_umum'] = $data['cells'][$i][2];
	                            $dataexcel[$i-1]['ujian_agama'] = $data['cells'][$i][3];
	                            $dataexcel[$i-1]['ujian_bahasa'] = $data['cells'][$i][4];
	                            $dataexcel[$i-1]['ujian_essay'] = $data['cells'][$i][5];

				}
	                        
	                        
	            delete_files($upload_data['file_path']);
	            $q=$this->m_hasil_tes->input_nilai_ujian($dataexcel);
	            //$data['user'] = $this->m_hasil_tes->getuser();
	            if($q=="sukses"){
	            	$data['hasil']="sukses";
	            }
	            else{
	            	$data['hasil']="gagal";
	            }
			}
			   $data['sessi']=$this->session->userdata('admin');
				$data['level']=$this->session->userdata('level');
				$data['username']=$this->session->userdata('username');
				
				$data['posisi']='hasil_tes';
				$colModel['no_pes2'] = array('No',30,FALSE,'center',0);
				$colModel['no_pes'] = array('No Peserta ',100,TRUE,'left',2);
				$colModel['nama'] = array('Nama ',100,TRUE,'left',2);
				$colModel['pilihan1'] = array('Pilihan 1 ',100,TRUE,'left',2);
				$colModel['pilihan2'] = array('Pilihan 2 ',100,TRUE,'left',2);
				$colModel['nilai_umum'] = array('ujian umum ',100,TRUE,'left',2);
				$colModel['nilai_agama'] = array('ujian agama',100,TRUE,'left',2);
				$colModel['nilai_bahasa'] = array('ujian bahasa ',100,TRUE,'left',2);
				$colModel['nilai_essay'] = array('Essay ',100,TRUE,'left',2);
				$gridParams = array(
					'width' => 'auto',
					'height' => 'auto',
					'rp' => 10,
					'singleSelect' => true,
					'rpOptions' => '[5,10,15,20,25,40,100]',
					'pagestat' => 'Displaying: {from} to {to} of {total} items.',
					'blockOpacity' => 0.5,
					'title' => 'DATA hasil_tes',
					'showTableToggleBtn' => true
				);
				
				$buttons[] = array('Refresh','refresh','test');
				$buttons[] = array('separator');
	            $data['bread']='<li><a style="text-decoration:none" href="./">Home</a><span class="divider">/</span></li>
	                            <li class="active">hasil_tes</li>';
	            

				$grid_js = build_grid_js('flex1',base_url()."hasil_tes/ajax_hasil_tes",$colModel,'id','asc',$gridParams,$buttons);
				
				$data['js_grid'] = $grid_js;
				//$this->load->view('barang',$data);
			    if($data['level']!='admin'){
					  echo "<script>alert('ANDA TIDAK BERHAK MENGAKSES MODUL INI');
	                          document.location='".base_url()."pengawas';
	                       </script>";
				}
				else if($data['sessi']==''){
	                 echo "<script>alert('ANDA BELUM LOGIN');
	                          document.location='./';
	                         </script>";
				}
				else {
					$this->load->view('admin/head',$data);
					$this->load->view('admin/menu',$data);
					$this->load->view('admin/hasil_tes',$data);
					$this->load->view('admin/footer');
				}
				
			 }
			
		}
         
       
}