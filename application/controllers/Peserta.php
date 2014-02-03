<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta extends CI_Controller {
   //kontruksi yang dijalan otomatis pada saat class dipanggil 
       public function __construct()
		 {
		   parent::__construct();
		   $this->load->helper(array('form','url', 'text_helper','date'));
           $this->load->library('session');
           $this->load->library('tanggal');
		   $this->load->model('m_admin');
		   $this->load->model('m_peserta');
		   $this->load->library('fpdf');
		   $this->load->helper('flexigrid');
		   $this->load->helper('peserta');
           $this->load->library('flexigrid');
           $this->load->helper('form');
		   define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		 }
 

          //fungsi menampilkan data peserta
		public function index(){
           // $data['peserta']=$this->m_admin->get_peserta();
            $data['posisi']='peserta';
			$data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('username');
			$data["pendidikan"] = $this->m_peserta->pendidikan_ortu();
            $data["pekerjaan"] = $this->m_peserta->pekerjaan_ortu();
            $data["penghasilan"] = $this->m_peserta->penghasilan_ortu();
            $data["prov"]= $this->m_peserta->get_provinsi();
            $data["agama"] = $this->m_peserta->get_agama();
			$data['aktif'] = "pendaftaran";
			$data["sekolah"]= $this->m_peserta->get_sekolah();
            $data["program"]= $this->m_peserta->get_program();
            $data['fakultas'] = $this->m_peserta->get_fak();
			//$data['tanggal']=$this->tgl_indo(date)
			$colModel['no_pes'] = array('No',40,FALSE,'center',0);
			$colModel['nama'] = array('Nama ',200,TRUE,'left',2);
			$colModel['tgl_lahir'] = array('Tanggal Lahir',150,TRUE,'left',2);
			$colModel['pilihan1'] = array('Pilihan 1',150,TRUE,'left',2);
			$colModel['pilihan2'] = array('Pilihan 2',150,TRUE,'left',2);
			$colModel['edit'] = array('edit',25,TRUE,'center',0);
			$colModel['delete'] = array('hapus',25,TRUE,'center',0);
			$gridParams = array(
				'width' => 'auto',
				'height' => 'auto',
				'rp' => 10,
				'singleSelect' => true,
				'rpOptions' => '[5,10,15,20,25,40,100]',
				'pagestat' => 'Displaying: {from} to {to} of {total} items.',
				'blockOpacity' => 0.5,
				'title' => 'DATA PENDAFTAR',
				'showTableToggleBtn' => true
			);
			
			
			$buttons[] = array('Unselect','unselect','test');
			$buttons[] = array('Refresh','refresh','test');
			$buttons[] = array('Edit','edit','test');
			$buttons[] = array('Hapus','hapus','test');
			$buttons[] = array('separator');
           
            $data['bread']='<li><a style="text-decoration:none" href="./">Home</a><span class="divider">/</span></li>
                            <li class="active">Peserta</li>';
           
    		$grid_js = build_grid_js('flex1',base_url()."peserta/ajax_peserta",$colModel,'id','asc',$gridParams,$buttons);
			
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
				$this->load->view('admin/peserta',$data);
				$this->load->view('admin/footer');
			}

		}

		public function ajax_peserta() {
			
		$valid_fields = array('no_pes','nama','tgl_lahir','pilihan1','pilihan2');
		$this->flexigrid->validate_post('no_pes','asc',$valid_fields);		
		$records = $this->m_peserta->get_peserta();
		$this->output->set_header($this->config->item('json_header'));
		
		$i=1;
		foreach ($records['records']->result() as $row) {
			$tgl=$this->tanggal->tgl_indo($row->tgl_lahir);
			$record_items[] = array($row->no_pes,
			$i++,
			$row->nama,
			$tgl,
			$row->pilihan1,
			$row->pilihan2,
			'<a class="edit" value="'.$row->no_pes.'"" href="'.$this->config->item('base_url').'peserta/edit_peserta/'.$row->no_pes.'">
			<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
			'<a href="'.$this->config->item('base_url').'peserta/hapus_peserta/'.$row->no_pes.'">
			<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
			);
		}

		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		
	}
        
        
        //fungsi menampilkan data peserta
		public function data_peserta($id){
			$data = $this->m_peserta->data_diri($id);

			foreach ($data->result() as $k) {
				
			}
			$hasil[]=array("nama"=>$k->nama,
                         "tempat_lahir"=>$k->tempat_lahir
				        );
			$xx['peserta']=$hasil;
			echo json_encode($xx);
		}

		

       

        //fungsi menampilkan data edit peserta
		public function edit_peserta($id){
			$data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('username');
			$data['posisi']='edit_peserta';
			$data["pendidikan"] = $this->m_peserta->pendidikan_ortu();
            $data["pekerjaan"] = $this->m_peserta->pekerjaan_ortu();
            $data["penghasilan"] = $this->m_peserta->penghasilan_ortu();
            $data["prov"]= $this->m_peserta->get_provinsi();
            $data["agama"] = $this->m_peserta->get_agama();
			$data['aktif'] = "pendaftaran";
			$data["sekolah"]= $this->m_peserta->get_sekolah();
            $data["program"]= $this->m_peserta->get_program();
            $data['fakultas'] = $this->m_peserta->get_fak();	   
			if($data['sessi']==''){
                 echo "<script>alert('ANDA BELUM LOGIN');
                          document.location='./';
                         </script>";
			}
			else {
				$data['cek_daftar'] = $this->m_peserta->cek_daftar($id);
				if($data['cek_daftar']==false){
			    	 $data['bread']='<li><a style="text-decoration:none" href="./">Home</a><span class="divider">/</span></li>
		                             <li class="active">Error Page</li>';
			    	$this->load->view('admin/head',$data);
					$this->load->view('admin/menu',$data);
					$this->load->view('admin/error_page',$data);
					$this->load->view('admin/footer');

			    }
			    else {
			    	$data['data_diri'] = $this->m_peserta->data_diri($id);
					foreach ($data['data_diri']->result() as $dta) {
						$dta->nama;
					}
					$data['prov_sekolah']=$this->m_peserta->get_provinsi2($dta->kode_sekolah);
					$data['kota_sekolah']=$this->m_peserta->get_kota2($dta->kode_sekolah);
					$data["sekolah2"]= $this->m_peserta->get_sekolah2($data['kota_sekolah']);
					$data["kota_sek"]= $this->m_peserta->get_kota3($data['prov_sekolah']);
					$data['fak2'] = $this->m_peserta->get_fak2($dta->pil_1);
					$data['fak3'] = $this->m_peserta->get_fak2($dta->pil_2);
					$data['jur'] = $this->m_peserta->get_jur($data['fak2']);
					$data['jur2'] = $this->m_peserta->get_jur($data['fak3']);
					$data['kab'] = $this->m_peserta->get_kab($dta->id_propinsi);
				    $data['tanggal'] = $this->tanggal->tgl_indo($dta->tgl_lahir);
			    	$data['bread']='<li><a style="text-decoration:none" href="./">Home</a><span class="divider">/</span></li>
		                    		<li><a style="text-decoration:none" href="'.base_url().'admin/peserta">Peserta</a><span class="divider">/</span></li>
                            		<li class="active">Edit Peserta</li>';
			    	$this->load->view('admin/head',$data);
					$this->load->view('admin/menu',$data);
					$this->load->view('admin/edit_peserta',$data);
					$this->load->view('admin/footer');

			    }
				
			}
            
		}

        //fungsi untuk update data peserta
		function update_data_peserta($id){
            $config['upload_path']    = "./upload/foto_pendaftar";
		    $config['allowed_types'] = 'jpg|png|jpeg';
		    $config['max_size']     = '500';
		   // $config['max_width'] = '500';
		    //$config['max_height']= '500';
		    //load library upload
		    $this->load->library('upload', $config);
		    //$ruang_tes=$this->m_peserta->ruang_tes();
			
			    if (!$this->upload->do_upload("photo")) {
			        echo "<script>alert('foto terlalu besar');</script>";
			     }else {
			        //state jika berhasil
			     }  
			     $fotox = $this->upload->data("photo");
		         $foto = $fotox['file_name'];

			     if($fotox['file_name']!=''){
			     	$data['data_diri'] = $this->m_peserta->data_diri($id);
						foreach ($data['data_diri']->result() as $dta) {
							
						}
					if($dta->foto!=''){
					  unlink("./upload/foto_pendaftar/".$dta->foto);	
					}
			     	
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
					'pil_2' => $this->input->post('pil_2')
					
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
					'pil_2' => $this->input->post('pil_2')
					
					);
			   }
		      $this->m_peserta->update_data_peserta($data,$this->input->post('no_pes'));
              header("location:".base_url()."peserta/edit_peserta/".$this->input->post('no_pes'));
			
	    }

		//fungsi menghapus data peserta
		public function hapus_peserta($id){
				$data['data_diri'] = $this->m_peserta->data_diri($id);
			    foreach ($data['data_diri']->result() as $dta) {
							
				}
			   if($dta->foto!=''){
					  unlink("./upload/foto_pendaftar/".$dta->foto);	
			   }
               $this->m_peserta->hapus_peserta($id);
               header("location:".base_url()."peserta");
		}

}