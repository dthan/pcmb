<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fakultas extends CI_Controller {
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
		   $this->load->model('m_fakultas');
           $this->load->helper('form');
		   define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		 }

		
		public function index(){
           // $data['peserta']=$this->m_admin->get_peserta();
            $data['posisi']='fakultas';
			$data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('nama_admin');
           // $data['fakultas']=$this->m_fakultas->get_fakultas();
			$colModel['kode_fak'] = array('No',30,FALSE,'center',0);
			$colModel['fakultas'] = array('Fakultas ',160,TRUE,'left',2);
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
				'title' => 'DATA fakultas',
				'showTableToggleBtn' => true
			);
			
			$buttons[] = array('Tambah','tambah','test');
			$buttons[] = array('Unselect','unselect','test');
			$buttons[] = array('Refresh','refresh','test');
			$buttons[] = array('Edit','edit','test');
			$buttons[] = array('Hapus','hapus','test');
			$buttons[] = array('separator');
           
            $data['bread']='<li><a style="text-decoration:none" href="./">Home</a><span class="divider">/</span></li>
                            <li class="active">fakultas</li>';
            

			$grid_js = build_grid_js('flex1',base_url()."fakultas/ajax_fakultas",$colModel,'id','asc',$gridParams,$buttons);
			
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
				$this->load->view('admin/fakultas',$data);
				$this->load->view('admin/footer');
			}

		}

		public function ajax_fakultas() {
			
		$valid_fields = array('kode_fak','fakultas');
		$this->flexigrid->validate_post('kode_fak','asc',$valid_fields);		
		$records = $this->m_fakultas->get_fakultas();
		$this->output->set_header($this->config->item('json_header'));
		
		$i=1;
		foreach ($records['records']->result() as $row) {
			//$tgl=$this->tanggal->tgl_indo($row->tgl_lahir);
			$record_items[] = array($row->kode_fak,
			$i++,
			$row->fakultas,
			'<a class="edit" value="'.$row->kode_fak.'"" href="'.$this->config->item('base_url').'fakultas/edit/'.$row->kode_fak.'">
			<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
			'<a href="'.$this->config->item('base_url').'fakultas/hapus/'.$row->kode_fak.'">
			<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
			);
		}

		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		
	    }

		public function tambah(){
			 $data = array(
					'fakultas' => $this->input->post('nama_fakultas')
					);
			 $q=$this->m_fakultas->simpan($data);
			 //header("location:".base_url()."fakultas");
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
             $data['fakultas']=$this->m_fakultas->fakultas($id);
             $data['posisi']='fakultas';
             $data['bread']='<li><a style="text-decoration:none" href="'.base_url().'">Home</a><span class="divider">/</span></li>
             				 <li><a style="text-decoration:none" href="'.base_url().'fakultas">fakultas</a><span class="divider">/</span></li>
                            <li class="active">Edit fakultas</li>';
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
				$this->load->view('admin/edit_fakultas',$data);
				$this->load->view('admin/footer');
			}
				
			
		}

		public function edit_data(){
			$data = array(
					'fakultas' => $this->input->post('nama_fakultas')
					);
			$id_fak=$this->input->post('id_fak');
			 $this->m_fakultas->edit($data,$id_fak);
			 //header("location:".base_url()."fakultas/edit/".$this->input->post('id'));
			 echo "sukses";

		}

		public function hapus($id){
			$this->m_fakultas->hapus($id);
			header("location:".base_url()."fakultas");
		}

		 
         
}

