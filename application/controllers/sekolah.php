<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sekolah extends CI_Controller {
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
		   $this->load->model('m_sekolah');
           $this->load->helper('form');
		   define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		 }

		
		public function index(){
           // $data['peserta']=$this->m_admin->get_peserta();
            $data['posisi']='sekolah';
			$data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('nama_admin');
			$data['propinsi']=$this->m_sekolah->get_propinsi();
           
			$colModel['kode_sekolah'] = array('No',30,FALSE,'center',0);
			$colModel['nama_smta'] = array('nama sekolah ',200,TRUE,'left',2);
			$colModel['nama_propinsi'] = array('provinsi ',160,TRUE,'left',2);
			$colModel['nama_kota'] = array('kota ',160,TRUE,'left',2);
			$colModel['edit'] = array('edit',25,TRUE,'center',0);
			$colModel['delete'] = array('hapus',25,TRUE,'center',0);
			$gridParams = array(
				'width' => 'auto',
				'height' => 'auto',
				'rp' => 20,
				'singleSelect' => true,
				'rpOptions' => '[5,10,15,20,25,40,100,1000]',
				'pagestat' => 'Displaying: {from} to {to} of {total} items.',
				'blockOpacity' => 0.5,
				'title' => 'DATA SEKOLAH',
				'showTableToggleBtn' => true
			);
			
			$buttons[] = array('Tambah','tambah','test');
			$buttons[] = array('Unselect','unselect','test');
			$buttons[] = array('Refresh','refresh','test');
			$buttons[] = array('Edit','edit','test');
			$buttons[] = array('Hapus','hapus','test');
			$buttons[] = array('separator');
           
            $data['bread']='<li><a style="text-decoration:none" href="./">Home</a><span class="divider">/</span></li>
                            <li class="active">sekolah</li>';
            

			$grid_js = build_grid_js('flex1',base_url()."sekolah/ajax_sekolah",$colModel,'id','asc',$gridParams,$buttons);
			
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
				$this->load->view('admin/sekolah',$data);
				$this->load->view('admin/footer');
			}

		}

		public function ajax_sekolah() {			
		$valid_fields = array('kode_sekolah','nama_smta','nama_propinsi','nama_kota');
		$this->flexigrid->validate_post('kode_sekolah','asc',$valid_fields);		
		$records = $this->m_sekolah->get_sekolah();
		$this->output->set_header($this->config->item('json_header'));
		
		$i=1;
		foreach ($records['records']->result() as $row) {
		 if($i==1){
			//$tgl=$this->tanggal->tgl_indo($row->tgl_lahir);
			$record_items[] = array($row->kode_sekolah,
			$i++,
			$row->nama_smta,
			$row->nama_propinsi,
            $row->nama_kota,
			'<a class="edit" value="'.$row->kode_sekolah.'"" href="'.$this->config->item('base_url').'sekolah/edit/'.$row->kode_sekolah.'">
			<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
			'<a href="'.$this->config->item('base_url').'sekolah/hapus/'.$row->kode_sekolah.'">
			<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
			);
		  }
		  else {
		  	$record_items[] = array($row->kode_sekolah,
			$i++,
			$row->nama_smta,
			'',
			'',
			'<a class="edit" value="'.$row->kode_sekolah.'"" href="'.$this->config->item('base_url').'sekolah/edit/'.$row->kode_sekolah.'">
			<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
			'<a href="'.$this->config->item('base_url').'sekolah/hapus/'.$row->kode_sekolah.'">
			<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
			);
		 }
		}

		 $this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));		
		}
	    

		public function tambah(){
			 $data = array(
					'kode_sekolah' => $this->input->post('kode_sekolah'),
					'nama_smta' => $this->input->post('nama_sekolah'),
					'id_kota' => $this->input->post('kota'),
					'id_propinsi' => $this->input->post('propinsi'),
					);
			 $q=$this->m_sekolah->simpan($data);
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
            $data['sekolah']=$this->m_sekolah->sekolah($id);
            $data['propinsi']=$this->m_sekolah->get_propinsi();
            foreach ($data['sekolah']->result() as $hasil) {
            	# code...
            }
            $data['kota']=$this->m_sekolah->get_kota($hasil->id_propinsi);
            $data['posisi']='sekolah';
            $data['bread']='<li><a style="text-decoration:none" href="'.base_url().'">Home</a><span class="divider">/</span></li>
             				 <li><a style="text-decoration:none" href="'.base_url().'sekolah">sekolah</a><span class="divider">/</span></li>
                            <li class="active">Edit sekolah</li>';
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
				$this->load->view('admin/edit_sekolah',$data);
				$this->load->view('admin/footer');
			}
				
			
		}

		public function edit_data($id){
		 $data = array(
					'kode_sekolah' => $this->input->post('kode_sekolah'),
					'nama_smta' => $this->input->post('nama_sekolah'),
					'id_kota' => $this->input->post('kota'),
					'id_propinsi' => $this->input->post('propinsi'),
					);
			 $q=$this->m_sekolah->edit($data,$id);
			  if($q){
			 	echo "sukses";
			 }
			 else{
			 	echo "gagal";
			 }

		}

		public function hapus($id){
			$this->m_sekolah->hapus($id);
			header("location:".base_url()."sekolah");
		}

		public function cek_kode_sekolah(){
			$kode=$this->input->post('kode');
			$cek=$this->m_sekolah->cek_kode($kode);
			if($cek==true){
               echo "sudah";
			}
			else {
               echo "belum";
			}
			

		}

		 
         
}

