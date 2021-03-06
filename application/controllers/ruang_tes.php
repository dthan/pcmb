<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ruang_tes extends CI_Controller {
	 public function __construct()
		 {
		   parent::__construct();
		   $this->load->helper(array('form','url', 'text_helper','date'));
           $this->load->library('session');
           $this->load->library('tanggal');
		   $this->load->model('m_admin');
		   $this->load->model('m_ruang_tes');
		   $this->load->model('pcmb');
		   $this->load->library('fpdf');
		   $this->load->helper('flexigrid');
		   $this->load->helper('peserta');
           $this->load->library('flexigrid');
           $this->load->helper('form');
		   define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		 }

		
		public function index(){
           // $data['peserta']=$this->m_admin->get_peserta();
            $data['posisi']='ruang_tes';
			$data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('username');
            $data['gedung']=$this->m_ruang_tes->get_gedung();
			$colModel['id_ruang_tes'] = array('No',30,FALSE,'center',0);
			$colModel['nama_ruang_tes'] = array('Ruang Tes ',100,TRUE,'left',2);
		    $colModel['nama_gedung'] = array('Gedung ',100,TRUE,'left',2);
			$colModel['kapasitas'] = array('Kapasitas',60,TRUE,'left',2);
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
				'title' => 'DATA RUANG TES',
				'showTableToggleBtn' => true
			);
			
			$buttons[] = array('Tambah','tambah','test');
			$buttons[] = array('Unselect','unselect','test');
			$buttons[] = array('Refresh','refresh','test');
			$buttons[] = array('Edit','edit','test');
			$buttons[] = array('Hapus','hapus','test');
			$buttons[] = array('separator');
           
            $data['bread']='<li><a style="text-decoration:none" href="./">Home</a><span class="divider">/</span></li>
                            <li class="active">Ruang Tes</li>';
            

			$grid_js = build_grid_js('flex1',base_url()."ruang_tes/ajax_ruang_tes",$colModel,'id','asc',$gridParams,$buttons);
			
			$data['js_grid'] = $grid_js;
			//$this->load->view('barang',$data);
			if($data['sessi']==''){
                 echo "<script>alert('ANDA BELUM LOGIN');
                          document.location='./';
                         </script>";
			}
			else {
				$this->load->view('admin/head',$data);
				$this->load->view('admin/menu',$data);
				$this->load->view('admin/ruang_tes',$data);
				$this->load->view('admin/footer');
			}

		}

		public function ajax_ruang_tes() {
			
		$valid_fields = array('id_ruang_tes','nama_ruang_tes','nama_gedung','kapasitas');
		$this->flexigrid->validate_post('nama_ruang_tes','asc',$valid_fields);		
		$records = $this->m_ruang_tes->get_ruang_tes();
		$this->output->set_header($this->config->item('json_header'));
		
		$i=1;
		foreach ($records['records']->result() as $row) {
			//$tgl=$this->tanggal->tgl_indo($row->tgl_lahir);
			$gedung[$i]=$row->nama_gedung;
			if($i==1){
                $record_items[] = array($row->id_ruang_tes,
				$i++,
				$row->nama_ruang_tes,
				$row->nama_gedung,
				$row->kapasitas,
				'<a class="edit" value="'.$row->id_ruang_tes.'"" href="'.$this->config->item('base_url').'ruang_tes/edit/'.$row->id_ruang_tes.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
				'<a href="'.$this->config->item('base_url').'ruang_tes/hapus/'.$row->id_ruang_tes.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
				);
			}
			else if($gedung[$i]!=$gedung[$i-1]){
                $record_items[] = array($row->id_ruang_tes,
				$i++,
				$row->nama_ruang_tes,
				$row->nama_gedung,
				$row->kapasitas,
				'<a class="edit" value="'.$row->id_ruang_tes.'"" href="'.$this->config->item('base_url').'ruang_tes/edit/'.$row->id_ruang_tes.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
				'<a href="'.$this->config->item('base_url').'ruang_tes/hapus/'.$row->id_ruang_tes.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
				);
			}
			else{
               $record_items[] = array($row->id_ruang_tes,
				$i++,
				$row->nama_ruang_tes,
				'',
				$row->kapasitas,
				'<a class="edit" value="'.$row->id_ruang_tes.'"" href="'.$this->config->item('base_url').'ruang_tes/edit/'.$row->id_ruang_tes.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
				'<a href="'.$this->config->item('base_url').'ruang_tes/hapus/'.$row->id_ruang_tes.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
				);
			}
				
		}

		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		
	}

		public function tambah(){
			 $data = array(
					'nama_ruang_tes' => $this->input->post('ruang'),
					'id_gedung' => $this->input->post('gedung'),
					'kapasitas' => $this->input->post('kapasitas')
					);
			 $q=$this->m_ruang_tes->simpan($data);
			 //header("location:".base_url()."ruang_tes");
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
             $data['ruang_tes']=$this->m_ruang_tes->ruang_tes($id);
             $data['gedung']=$this->m_ruang_tes->get_gedung();
             $data['posisi']='ruang_tes';
             $data['bread']='<li><a style="text-decoration:none" href="'.base_url().'">Home</a><span class="divider">/</span></li>
             				 <li><a style="text-decoration:none" href="'.base_url().'ruang_tes">Ruang Tes</a><span class="divider">/</span></li>
                            <li class="active">Edit Ruang Tes</li>';
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
				$this->load->view('admin/edit_ruang_tes',$data);
				$this->load->view('admin/footer');
			}
				
			
		}

		public function edit_data(){
			$data = array(
					'nama_ruang_tes' => $this->input->post('ruang'),
					'id_gedung' => $this->input->post('gedung'),
					'kapasitas' => $this->input->post('kapasitas')
					);
			 $this->m_ruang_tes->edit($data,$this->input->post('id'));
			 /*header("location:".base_url()."ruang_tes/edit/".$id);*/
			 echo "sukses";

		}

		public function hapus($id){
			$this->m_ruang_tes->hapus($id);
			header("location:".base_url()."ruang_tes");
		}

		 
         
}

