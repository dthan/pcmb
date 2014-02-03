<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gedung extends CI_Controller {
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
           $this->load->helper('flexigrid');
	       $this->load->helper('form');
	       $this->load->library('tanggal');
		   $this->load->model('m_gedung');
           $this->load->helper('form');
		   define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		 }

		
		public function index(){
           // $data['peserta']=$this->m_admin->get_peserta();
            $data['posisi']='gedung';
			$data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('nama_admin');
           // $data['gedung']=$this->m_gedung->get_gedung();
			$colModel['id_gedung'] = array('No',30,FALSE,'center',0);
			$colModel['nama_gedung'] = array('Nama Gedung ',100,TRUE,'left',2);
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
				'title' => 'DATA GEDUNG',
				'showTableToggleBtn' => true
			);
			
			$buttons[] = array('Tambah','tambah','test');
			$buttons[] = array('Unselect','unselect','test');
			$buttons[] = array('Refresh','refresh','test');
			$buttons[] = array('Edit','edit','test');
			$buttons[] = array('Hapus','hapus','test');
			$buttons[] = array('separator');
           
            $data['bread']='<li><a style="text-decoration:none" href="./">Home</a><span class="divider">/</span></li>
                            <li class="active">Gedung</li>';
            

			$grid_js = build_grid_js('flex1',base_url()."gedung/ajax_gedung",$colModel,'id','asc',$gridParams,$buttons);
			
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
				$this->load->view('admin/gedung',$data);
				$this->load->view('admin/footer');
			}

		}

		public function ajax_gedung() {
			
		$valid_fields = array('id_gedung','nama_gedung');
		$this->flexigrid->validate_post('id_gedung','asc',$valid_fields);		
		$records = $this->m_gedung->get_gedung();
		$this->output->set_header($this->config->item('json_header'));
		
		$i=1;
		foreach ($records['records']->result() as $row) {
			//$tgl=$this->tanggal->tgl_indo($row->tgl_lahir);
			$record_items[] = array($row->id_gedung,
			$i++,
			$row->nama_gedung,
			'<a class="edit" value="'.$row->id_gedung.'"" href="'.$this->config->item('base_url').'gedung/edit/'.$row->id_gedung.'">
			<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
			'<a href="'.$this->config->item('base_url').'gedung/hapus/'.$row->id_gedung.'">
			<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
			);
		}

		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		
	    }

		public function tambah(){
			 $data = array(
					'nama_gedung' => $this->input->post('nama_gedung')
					);
			 $this->m_gedung->simpan($data);
			 header("location:".base_url()."gedung");
		}

		public function edit($id){
			$data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('username');
             $data['gedung']=$this->m_gedung->gedung($id);
             $data['posisi']='gedung';
             $data['bread']='<li><a style="text-decoration:none" href="'.base_url().'">Home</a><span class="divider">/</span></li>
             				 <li><a style="text-decoration:none" href="'.base_url().'gedung">Gedung</a><span class="divider">/</span></li>
                            <li class="active">Edit Gedung</li>';
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
				$this->load->view('admin/edit_gedung',$data);
				$this->load->view('admin/footer');
			}
				
			
		}

		public function edit_data($id){
			$data = array(
					'nama_gedung' => $this->input->post('nama_gedung')
					);
			 $this->m_gedung->edit($data,$id);
			 header("location:".base_url()."gedung/edit/".$id);

		}

		public function hapus($id){
			$this->m_gedung->hapus($id);
			header("location:".base_url()."gedung");
		}

		 
         
}

