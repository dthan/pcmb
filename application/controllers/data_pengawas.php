<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_pengawas extends CI_Controller {
	 public function __construct()
		 {
		   parent::__construct();
		   $this->load->helper(array('form','url', 'text_helper','date'));
           $this->load->library('session');
           $this->load->library('tanggal');
		   $this->load->model('m_admin');
		   $this->load->model('m_pengawas');
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
            $data['posisi']='pengawas';
		    $data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('nama_admin');
			$data['jml_ruang_tes']=$this->m_pengawas->jml_ruang_tes();
			$data['terisi']=$this->m_pengawas->terisi();
            $data['ruang_tes']=$this->m_pengawas->get_ruang_tes_all();
			$colModel['id_pengawas'] = array('No',30,FALSE,'center',0);
			$colModel['nama_pengawas'] = array('Nama pengawas ',100,TRUE,'left',2);
			$colModel['nama_gedung'] = array('gedung ',100,TRUE,'left',2);
			$colModel['nama_ruang_tes'] = array('Ruang tes ',100,TRUE,'left',2);
			$colModel['username'] = array('username ',100,TRUE,'left',2);
			$colModel['password'] = array('password',100,TRUE,'left',2);
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
				'title' => 'DATA PENGAWAS',
				'showTableToggleBtn' => true
			);
			
			$buttons[] = array('Tambah','tambah','test');
			$buttons[] = array('Unselect','unselect','test');
			$buttons[] = array('Refresh','refresh','test');
			$buttons[] = array('Edit','edit','test');
			$buttons[] = array('Hapus','hapus','test');
			$buttons[] = array('separator');
           
            $data['bread']='<li><a style="text-decoration:none" href="./">Home</a><span class="divider">/</span></li>
                            <li class="active">pengawas</li>';
            

			$grid_js = build_grid_js('flex1',base_url()."data_pengawas/ajax_pengawas",$colModel,'id','asc',$gridParams,$buttons);
			
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
				$this->load->view('admin/data_pengawas',$data);
				$this->load->view('admin/footer');
			}

		}

		public function ajax_pengawas() {
			
		$valid_fields = array('id_pengawas','nama_pengawas','nama_gedung','nama_ruang_tes','username','password');
		$this->flexigrid->validate_post('nama_gedung','asc',$valid_fields);		
		$records = $this->m_pengawas->get_pengawas();
		$this->output->set_header($this->config->item('json_header'));
		
		$i=1;
		foreach ($records['records']->result() as $row) {
			//$tgl=$this->tanggal->tgl_indo($row->tgl_lahir);
			$gedung[$i]=$row->nama_gedung;
			if($i==1){
               $record_items[] = array($row->id_pengawas,
				$i++,
				$row->nama_pengawas,
				$row->nama_gedung,
				$row->nama_ruang_tes,
				$row->username,
				$row->password,
				'<a class="edit" value="'.$row->id_pengawas.'"" href="'.$this->config->item('base_url').'data_pengawas/edit/'.$row->id_pengawas.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
				'<a href="'.$this->config->item('base_url').'data_pengawas/hapus/'.$row->id_pengawas.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
				);
			}
			else if($gedung[$i]!=$gedung[$i-1]){
				$record_items[] = array($row->id_pengawas,
				$i++,
				$row->nama_pengawas,
				$row->nama_gedung,
				$row->nama_ruang_tes,
				$row->username,
				$row->password,
				'<a class="edit" value="'.$row->id_pengawas.'"" href="'.$this->config->item('base_url').'data_pengawas/edit/'.$row->id_pengawas.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
				'<a href="'.$this->config->item('base_url').'pengawas/hapus/'.$row->id_pengawas.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
				);
			}
			else{
				$record_items[] = array($row->id_pengawas,
				$i++,
				$row->nama_pengawas,
				'',
				$row->nama_ruang_tes,
				$row->username,
				$row->password,
				'<a class="edit" value="'.$row->id_pengawas.'"" href="'.$this->config->item('base_url').'data_pengawas/edit/'.$row->id_pengawas.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
				'<a href="'.$this->config->item('base_url').'pengawas/hapus/'.$row->id_pengawas.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
				);
			}
				
		}

		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		
	}

		public function tambah(){
			 $ruang_tes=$this->m_pengawas->get_ruangan();
			 if($ruang_tes->num_rows() > 0){
                 foreach ($ruang_tes->result() as $dd) {
		     }
			     $this->m_pengawas->set_ada($dd->id_ruang_tes);
			     $q=$this->db->query("select count(id_pengawas) as jumlah from pengawas ");
			       foreach ($q->result() as $jml) {   
			       }
			       
			       if(($jml->jumlah<100) && ($jml->jumlah>=0)){
			       	  if(($jml->jumlah<9) && ($jml->jumlah>=0)){
			       	  	$ur=$jml->jumlah + 1;
			       	  	$urut="000".$ur;
			       	  }
			       	  else {
			       	  	$ur=$jml->jumlah + 1;
			            	$urut="00".$ur;
			       	  }
			       }

			        else if(($jml->jumlah<1000) && ($jml->jumlah>=100)){
			           	  	$ur=$jml->jumlah + 1;
			            	$urut="0".$ur;
			        }

			        else if(($jml->jumlah<10000) && ($jml->jumlah>=1000)){		     
			       	  	$ur=$jml->jumlah + 1;
			            	$urut=$ur; 	  
			       }
			       $username="P".$urut;
				 $data = array(
						'nama_pengawas' => $this->input->post('nama_pengawas'),
						'password' => $this->input->post('password'),
						'id_ruang_tes'=> $dd->id_ruang_tes,
						'username'=> $username
						);
				 $this->m_pengawas->simpan($data);
				 echo "sukses";
			 }
			 else {
			 	echo "penuh";
			 }
			
			 //header("location:".base_url()."pengawas");
		}

		public function edit($id){
			$data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('username');
             $data['pengawas']=$this->m_pengawas->pengawas($id);

            
             $data['posisi']='pengawas';
             $data['bread']='<li><a style="text-decoration:none" href="'.base_url().'">Home</a><span class="divider">/</span></li>
             				 <li><a style="text-decoration:none" href="'.base_url().'pengawas">pengawas</a><span class="divider">/</span></li>
                            <li class="active">Edit pengawas</li>';
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
				 if($data['pengawas']->num_rows() > 0){
				 	 $data['gedung']=$this->m_pengawas->get_gedung();
		             $data['ruang_tes']=$this->m_pengawas->get_ruang_tes($id);
		             $data['ruang_tes_all']=$this->m_pengawas->get_ruang_tes_all();
				   $this->load->view('admin/edit_pengawas',$data); 	
				 }
				 else {
				 	$this->load->view('admin/error',$data); 	
				 }
				
				$this->load->view('admin/footer');
			}
		}

		public function get_ruang(){

			$ruangan=$this->m_pengawas->get_ruang($this->input->post('id'));
			//echo "<option value='' selected>-ruangan-</option>";
			foreach ($ruangan->result() as $ruang) {
				echo "<option value='".$ruang->id_ruang_tes."'>".$ruang->nama_ruang_tes."</option>";
			}
		}

		public function edit_data($id){
			$cek_ruang_tes=$this->m_pengawas->cek_ruang_tes($this->input->post('ruang_tes'));
			$cek_beda=$this->m_pengawas->get_pengawas_by_id($id);
			foreach ($cek_beda->result() as $bd) {
				
			}
			if($this->input->post('ruang_tes')!=$bd->id_ruang_tes){
				$data_pengawas_before1=$this->m_pengawas->get_pengawas_before($this->input->post('ruang_tes'));
				$data_pengawas_before2=$this->m_pengawas->get_pengawas_by_id($id);
                foreach ($data_pengawas_before1->result() as $p1) {
                	
                }
                foreach ($data_pengawas_before2->result() as $p2) {
                
                }
                $data = array(
						'id_ruang_tes' => $p2->id_ruang_tes
					);
			    $this->m_pengawas->edit($data,$p1->id_pengawas);
                
                $data2 = array(
                	    'nama_pengawas' => $this->input->post('nama_pengawas'),
						'id_ruang_tes' => $this->input->post('ruang_tes')
					);
			    $q=$this->m_pengawas->edit($data2,$id);
			    if($q){
			    	echo "sukses";
			    }
			    else {
			    	echo "gagal";
			    }
			    //echo $p1->nama_pengawas." dan ".$p1->id_ruang_tes." - ".$p2->nama_pengawas." dan ".$p2->id_ruang_tes;
			   // echo $data['id_ruang_tes']."-".$data2['id_ruang_tes'];
			}
			else {
				//echo "sama";
				$data = array(
					'nama_pengawas' => $this->input->post('nama_pengawas'),
					'id_ruang_tes' => $this->input->post('ruang_tes')
					);
			   $q=$this->m_pengawas->edit($data,$id);
			       if($q){
			    	echo "sukses";
			    }
			    else {
			    	echo "gagal";
			    }

			}
			
			// header("location:".base_url()."pengawas/edit/".$id);

		}

		public function hapus($id){
			$pengawas=$this->m_pengawas->pengawas($id);
			foreach ($pengawas->result() as $peng) {
				# code...
			}
			$this->m_pengawas->set_tidak($peng->id_ruang_tes);
			$this->m_pengawas->hapus($id);
			header("location:".base_url()."data_pengawas");
		}


		 
         
}

