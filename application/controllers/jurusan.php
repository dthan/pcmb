<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jurusan extends CI_Controller {
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
		   $this->load->model('m_jurusan');
           $this->load->helper('form');
		   define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		    $data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('nama_admin');
		 
			if($data['sessi']==''){
                 echo "<script>alert('ANDA BELUM LOGIN');
                          document.location='".base_url()."admin';
                         </script>";
			}
			else if((isset($data['level'])) && ($data['level']!='admin')){
				  echo "<script>alert('ANDA TIDAK BERHAK MENGAKSES MODUL INI');
                          document.location='".base_url()."pengawas';
                       </script>";
			}
		 }

		
		public function index(){
           // $data['peserta']=$this->m_admin->get_peserta();
            $data['posisi']='jurusan';
			$data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('nama_admin');
			$data['fakultas']=$this->m_jurusan->get_fakultas();
           // $data['jurusan']=$this->m_jurusan->get_jurusan();
			$colModel['kode_jurusan'] = array('No',30,FALSE,'center',0);
			$colModel['nama_jurusan'] = array('jurusan ',160,TRUE,'left',2);			
			$colModel['fakultas'] = array('fakultas ',160,TRUE,'left',2);
			$colModel['kuota'] = array('kuota ',60,TRUE,'left',2);
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
				'title' => 'DATA jurusan',
				'showTableToggleBtn' => true
			);
			
			$buttons[] = array('Tambah','tambah','test');
			$buttons[] = array('Unselect','unselect','test');
			$buttons[] = array('Refresh','refresh','test');
			$buttons[] = array('Edit','edit','test');
			$buttons[] = array('Hapus','hapus','test');
			$buttons[] = array('separator');
           
            $data['bread']='<li><a style="text-decoration:none" href="./">Home</a><span class="divider">/</span></li>
                            <li class="active">jurusan</li>';
            

			$grid_js = build_grid_js('flex1',base_url()."jurusan/ajax_jurusan",$colModel,'id','asc',$gridParams,$buttons);
			
			$data['js_grid'] = $grid_js;
			//$this->load->view('barang',$data);
		
				$this->load->view('admin/head',$data);
				$this->load->view('admin/menu',$data);
				$this->load->view('admin/jurusan',$data);
				$this->load->view('admin/footer');
			

		}

		public function ajax_jurusan() {
			
		$valid_fields = array('kode_jurusan','nama_jurusan','fakultas','kuota');
		$this->flexigrid->validate_post('kode_fak','asc',$valid_fields);		
		$records = $this->m_jurusan->get_jurusan();
		$this->output->set_header($this->config->item('json_header'));
		
		$i=1;
		foreach ($records['records']->result() as $row) {
			//$tgl=$this->tanggal->tgl_indo($row->tgl_lahir);
			$fak[$i]=$row->fakultas;	
			if($i==1){				
				$record_items[] = array($row->kode_jurusan,		
				$i++,	
				$row->nama_jurusan,				
				$row->fakultas,				
				$row->kuota,
				'<a class="edit" value="'.$row->kode_jurusan.'"" href="'.$this->config->item('base_url').'jurusan/edit/'.$row->kode_jurusan.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
				'<a href="'.$this->config->item('base_url').'jurusan/hapus/'.$row->kode_jurusan.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
				);
				}
			else if(($fak[$i])!=($fak[$i-1])){
               	$record_items[] = array($row->kode_jurusan,	
               	$i++,		
				$row->nama_jurusan,				
				$row->fakultas,				
				$row->kuota,
				'<a class="edit" value="'.$row->kode_jurusan.'"" href="'.$this->config->item('base_url').'jurusan/edit/'.$row->kode_jurusan.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
				'<a href="'.$this->config->item('base_url').'jurusan/hapus/'.$row->kode_jurusan.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
				);
				
			}
			else {
				$record_items[] = array($row->kode_jurusan,	
				$i++,		
				$row->nama_jurusan,				
				'',	
				$row->kuota,
				'<a class="edit" value="'.$row->kode_jurusan.'"" href="'.$this->config->item('base_url').'jurusan/edit/'.$row->kode_jurusan.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
				'<a href="'.$this->config->item('base_url').'jurusan/hapus/'.$row->kode_jurusan.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
				);
				
			}		
		}	
		
		

		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		
	    }

		public function tambah(){
			 $data = array(
					'kode_jurusan' => $this->input->post('kode_jurusan'),
					'kode_fak' => $this->input->post('fakultas'),
					'nama_jurusan' => $this->input->post('nama_jurusan'),
					'kuota' => $this->input->post('kuota')
					);
			 /*echo $this->input->post('kode_jurusan');
			 echo $this->input->post('fakultas');
			 echo $this->input->post('nama_jurusan');*/
			 $q=$this->m_jurusan->simpan($data);
			 if($q){
			 	echo "sukses";
			 }
			 else{
			 	echo "gagal";
			 }
			
		}

		public function edit($id){
			$data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('username');
             $data['jurusan']=$this->m_jurusan->jurusan($id);
             $data['fakultas']=$this->m_jurusan->get_fakultas();
             $data['posisi']='jurusan';
             $data['bread']='<li><a style="text-decoration:none" href="'.base_url().'">Home</a><span class="divider">/</span></li>
             				 <li><a style="text-decoration:none" href="'.base_url().'jurusan">jurusan</a><span class="divider">/</span></li>
                            <li class="active">Edit jurusan</li>';
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
				$this->load->view('admin/edit_jurusan',$data);
				$this->load->view('admin/footer');
			}
				
			
		}

		public function edit_data($id){
		 $data = array(
					'kode_jurusan' => $this->input->post('kode_jurusan'),
					'kode_fak' => $this->input->post('fakultas'),
					'nama_jurusan' => $this->input->post('nama_jurusan'),
					'kuota' => $this->input->post('kuota')
					);
			 $q=$this->m_jurusan->edit($data,$id);
			  if($q){
			 	echo "sukses";
			 }
			 else{
			 	echo "gagal";
			 }

		}

		public function hapus($id){
			$this->m_jurusan->hapus($id);
			header("location:".base_url()."jurusan");
		}

		public function cek_kode_jurusan(){
			$kode=$this->input->post('kode');
			$cek=$this->m_jurusan->cek_kode($kode);
			if($cek==true){
               echo "sudah";
			}
			else {
               echo "belum";
			}
			

		}

		 
         
}

