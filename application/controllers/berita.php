<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Berita extends CI_Controller {
	 public function __construct()
		 {
		   parent::__construct();
		   $this->load->helper(array('form','url', 'text_helper','date'));
           $this->load->library('session');
           $this->load->library('tanggal');
           $this->load->library('fungsi_seo');
           //$this->load->library('editor');
		   $this->load->model('m_peserta');
		   $this->load->model('m_berita');
		   $this->load->library('fpdf');
		   $this->load->helper('peserta');
           $this->load->library('flexigrid');
           $this->load->helper('flexigrid');
	       $this->load->model('m_berita');
           $this->load->helper('form');
           $this->load->library('table');
           
 		   
           $this->load->library('upload');
           require_once "fckeditor/fckeditor.php"; 
		   define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		 }

		 public function index($id=1){
		 	$data['aktif'] = "berita";
		 	$data['title'] = "Berita PCMB";
		    $data['sessi'] = $this->session->userdata('username');
            $jml = $this->db->get('berita');
 			//pengaturan pagination
			 $config['base_url'] = base_url().'berita/page';
			 $config['total_rows'] = $jml->num_rows();
			 $config['per_page'] = '5';
			 $config['first_page'] = 'Awal';
			 $config['last_page'] = 'Akhir';
			 $config['next_page'] = '&laquo;';
			 $config['prev_page'] = '&raquo;';
			
			//inisialisasi config
			 $this->pagination->initialize($config);
			//buat pagination
			 $data['halaman'] = $this->pagination->create_links();
			//tamplikan data
			 $data['berita'] = $this->m_berita->ambil_berita($config['per_page'], $id);
			 $data['headline'] = $this->m_berita->berita_headline();
             //$data['berita']=$this->m_berita->berita_all();

			$data['cek_daftar'] = $this->m_peserta->cek_daftar($data['sessi']);
			$data['data_diri'] = $this->m_peserta->data_diri($data['sessi']);
		 	$this->load->view('head',$data);
			$this->load->view('menu',$data);
			$this->load->view('berita',$data);
			$this->load->view('footer',$data);
		 }

		 public function page($id=NULL){
		 	$data['aktif'] = "berita";
		 	$data['title'] = "Berita PCMB";
		    $data['sessi'] = $this->session->userdata('username');
            $jml = $this->db->get('berita');
 			//pengaturan pagination
			 $config['base_url'] = base_url().'berita/page';
			 $config['total_rows'] = $jml->num_rows();
			 $config['per_page'] = '5';
			 $config['first_page'] = 'Awal';
			 $config['last_page'] = 'Akhir';
			 $config['next_page'] = '&laquo;';
			 $config['prev_page'] = '&raquo;';
			//inisialisasi config
			 $this->pagination->initialize($config);
			//buat pagination
			 $data['halaman'] = $this->pagination->create_links();
			//tamplikan data
			 $data['berita'] = $this->m_berita->ambil_berita($config['per_page'], $id);
			 $data['headline'] = $this->m_berita->berita_headline();
             //$data['berita']=$this->m_berita->berita_all();

			$data['cek_daftar'] = $this->m_peserta->cek_daftar($data['sessi']);
			$data['data_diri'] = $this->m_peserta->data_diri($data['sessi']);
		 	$this->load->view('head',$data);
			$this->load->view('menu',$data);
			$this->load->view('berita',$data);
			$this->load->view('footer',$data);
		 }

		 public function detail($id){
		 	$data['aktif'] = "berita";
		    $data['sessi'] = $this->session->userdata('username');
            $data['berita'] = $this->m_berita->get_berita_selected($id);
            foreach ($data['berita']->result() as $b) {
            	# code...
            }
            $data['title'] = $b->judul;
			$data['cek_daftar'] = $this->m_peserta->cek_daftar($data['sessi']);
			$data['data_diri'] = $this->m_peserta->data_diri($data['sessi']);
			$data['headline'] = $this->m_berita->berita_headline();
		 	$this->load->view('head',$data);
			$this->load->view('menu',$data);
			$this->load->view('detail_berita',$data);
			$this->load->view('footer',$data);
		 }

		 public function list_berita(){
		 	// $data['peserta']=$this->m_admin->get_peserta();
            $data['posisi']='berita';
			$data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('nama_admin');
           // $data['berita']=$this->m_berita->get_berita();
			$colModel['id_berita'] = array('No',30,FALSE,'center',0);
			$colModel['judul'] = array('Judul Berita ',400,TRUE,'left',2);
            $colModel['penulis'] = array('Penulis ',100,TRUE,'left',2);
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
				'title' => 'DATA berita',
				'showTableToggleBtn' => true
			);
			
			$buttons[] = array('Tambah','tambah','test');
			$buttons[] = array('Unselect','unselect','test');
			$buttons[] = array('Refresh','refresh','test');
			$buttons[] = array('Edit','edit','test');
			$buttons[] = array('Hapus','hapus','test');
			$buttons[] = array('separator');
           
            $data['bread']='<li><a style="text-decoration:none" href="./">Home</a><span class="divider">/</span></li>
                            <li class="active">berita</li>';
            

			$grid_js = build_grid_js('flex1',base_url()."berita/ajax_berita",$colModel,'id','asc',$gridParams,$buttons);
			
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
				$this->load->view('admin/berita',$data);
				$this->load->view('admin/footer');
			}

		 }

		public function ajax_berita() {		

		$valid_fields = array('id_berita','judul','isi','tanggal_posting','penulis','gambar');
		$this->flexigrid->validate_post('id_berita','asc',$valid_fields);		
		$records = $this->m_berita->get_berita();
		$this->output->set_header($this->config->item('json_header'));		
		$i=1;
		foreach ($records['records']->result() as $row) {
			//$tgl=$this->tanggal->tgl_indo($row->tgl_lahir);
			$penulis[$i]=$row->penulis;
			if($i==1){
                $record_items[] = array($row->id_berita,
				$i++,
				$row->judul,
				$row->penulis,
			    '<a class="edit" value="'.$row->id_berita.'"" href="'.$this->config->item('base_url').'berita/edit/'.$row->id_berita.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
				'<a href="'.$this->config->item('base_url').'berita/hapus/'.$row->id_berita.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
				);
			}
			else if($penulis[$i]!=$penulis[$i-1]){
                $record_items[] = array($row->id_berita,
				$i++,
				$row->judul,
				$row->penulis,
			    '<a class="edit" value="'.$row->id_berita.'"" href="'.$this->config->item('base_url').'berita/edit/'.$row->id_berita.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
				'<a href="'.$this->config->item('base_url').'berita/hapus/'.$row->id_berita.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
				);
			}
			else{
                $record_items[] = array($row->id_berita,
				$i++,
				$row->judul,
				'',
			    '<a class="edit" value="'.$row->id_berita.'"" href="'.$this->config->item('base_url').'berita/edit/'.$row->id_berita.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/edit.png\' width=20></a>',
				'<a href="'.$this->config->item('base_url').'berita/hapus/'.$row->id_berita.'">
				<img border=\'0\' src=\''.$this->config->item('base_url').'asset/images/hapus.png\' width=20></a>'
				);
			}
				
		}

		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		
	    }

		public function tambah(){
			$config['upload_path']    = "./foto_berita";
		    $config['allowed_types'] = 'gif|jpg|png|jpeg';
		    $config['max_size']     = '20000';
		    $config['max_width'] = '20000';
		    $config['max_height']= '20000';
		    //load library upload
		    $this->upload->initialize($config);
		    $judul=$this->input->post('judul');
		    $judul_seo=$this->fungsi_seo->seo_title($judul);
		    $penulis=$this->session->userdata('admin');
		    $tgl=date("Y-m-d");
		    $isi=$this->input->post('FCKeditor1');
		    if($this->upload->data("poto")!=''){
			    if (!$this->upload->do_upload("poto")) {
			        $error = array('error' => $this->upload->display_errors());
			        print_r($error);
			     }else {
			        //state jika berhasil
			     }  
			     $fotox = $this->upload->data("poto");
		         $foto = $fotox['file_name'];
		         echo $foto;
		         
		         $data = array(
					'judul' => $judul,
					'judul_seo' => $judul_seo,
					'isi' => $isi,
					'tanggal_posting' => $tgl,
					'penulis' => $penulis,
					'gambar' => $foto
					);
			}
			else{
				  $data = array(
					'judul' => $judul,
					'judul_seo' => $judul_seo,
					'isi' => $isi,
					'tanggal_posting' => $tgl,
					'penulis' => $penulis					
					);
			}
			 
			 $this->m_berita->simpan($data);
			 header("location:".base_url()."berita/list_berita");
			

			
		}

		public function edit($id){
			$data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('username');
             $data['berita']=$this->m_berita->berita($id);
             $data['posisi']='berita';
             $data['bread']='<li><a style="text-decoration:none" href="'.base_url().'">Home</a><span class="divider">/</span></li>
             				 <li><a style="text-decoration:none" href="'.base_url().'berita/list_berita">berita</a><span class="divider">/</span></li>
                            <li class="active">Edit berita</li>';
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
				$this->load->view('admin/edit_berita',$data);
				$this->load->view('admin/footer');
			}
				
			
		}

		public function edit_data(){
			$config['upload_path']    = "./foto_berita";
		    $config['allowed_types'] = 'gif|jpg|png|jpeg';
		    $config['max_size']     = '20000';
		    $config['max_width'] = '20000';
		    $config['max_height']= '20000';
		    //load library upload
		    $this->upload->initialize($config);
		    $judul=$this->input->post('judul');
		    $judul_seo=$this->fungsi_seo->seo_title($judul);
		    $penulis=$this->session->userdata('admin');
		    $tgl=date("Y-m-d");
		    $isi=$this->input->post('FCKeditor1');
		  /*  $allowedExts = array("gif", "jpeg", "jpg", "png");
			$temp = explode(".", $_FILES["file"]["name"]);
			$extension = end($temp);
			if ((($_FILES["file"]["type"] == "image/gif")
			|| ($_FILES["file"]["type"] == "image/jpeg")
			|| ($_FILES["file"]["type"] == "image/jpg")
			|| ($_FILES["file"]["type"] == "image/pjpeg")
			|| ($_FILES["file"]["type"] == "image/x-png")
			|| ($_FILES["file"]["type"] == "image/png"))
			&& ($_FILES["file"]["size"] < 200000)
			&& in_array($extension, $allowedExts))
			  {
			  if ($_FILES["file"]["error"] > 0)
			    {
			    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
			    }
			  else
			    {
			    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			    echo "Type: " . $_FILES["file"]["type"] . "<br>";
			    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

			    /*if (file_exists("./foto_berita/" . $_FILES["file"]["name"]))
			      {
			      echo $_FILES["file"]["name"] . " already exists. ";
			      }
			    else
			      {
			      move_uploaded_file($_FILES["file"]["tmp_name"],
			      "./foto_berita/" . $_FILES["file"]["name"]);
			      echo "Stored in: " . "./upload/" . $_FILES["file"]["name"];
			      }
			    }
			  }
			else
			  {
			  echo "Invalid file";
			  }*/
		  /* $fotox = $this->upload->data("poto");
		    $foto = $fotox['file_name'];*/
		    if($this->upload->data("userfile")!=''){
			    if (!$this->upload->do_upload("userfile")) {
			        $error = array('error' => $this->upload->display_errors());
			        print_r($error);
			     }else {
			        echo "gagal";
			     }  
			     
			     $fotox = $this->upload->data("userfile");
		         $foto = $fotox['file_name'];
		         //echo $foto;
		         if($foto!=''){
                    $data = array(
					'judul' => $judul,
					'judul_seo' => $judul_seo,
					'isi' => $isi,
					'tanggal_posting' => $tgl,
					'penulis' => $penulis,
					'gambar' => $foto
					);
		         }
		         else{
                     $data = array(
					'judul' => $judul,
					'judul_seo' => $judul_seo,
					'isi' => $isi,
					'tanggal_posting' => $tgl,
					'penulis' => $penulis					
					);
		         }
		         
		         
                 
                  
			}
			else{
				  $data = array(
					'judul' => $judul,
					'judul_seo' => $judul_seo,
					'isi' => $isi,
					'tanggal_posting' => $tgl,
					'penulis' => $penulis					
					); 
            
                  //echo "eweuh gambaran";
                 
			}
			 $id=$this->input->post('id');
			 $this->m_berita->edit($data,$id);
			header("location:".base_url()."berita/list_berita");

		}

		public function hapus($id){
			$this->m_berita->hapus($id);
			header("location:".base_url()."berita/list_berita");
		}

		 
         
}