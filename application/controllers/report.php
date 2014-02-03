<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {
   //kontruksi yang dijalan otomatis pada saat class dipanggil 
       public function __construct()
		 {
		   parent::__construct();
			//load our new PHPExcel library
		    $this->load->helper(array('form','url', 'text_helper','date'));
            $this->load->library('session');
			$this->load->library('excel');
			$this->load->model('m_report');
			$this->load->library('tanggal');
			set_time_limit(0);
			ini_set('memory_limit','2500M');
		 }

         public function index(){
            $data['sessi']=$this->session->userdata('admin');
			$data['level']=$this->session->userdata('level');
			$data['username']=$this->session->userdata('nama_admin');
			$data['posisi']='report';
			$data['bread']='<li><a style="text-decoration:none" href="./">Home</a><span class="divider">/</span></li>';
			if(($data['sessi']!='') && ($data['level']=='admin')) {
			   
			   	$this->load->view('admin/head',$data);
				$this->load->view('admin/menu',$data);
				$this->load->view('admin/report',$data);
				
			}
			else {
			 	$this->load->view('admin/login');
				
			 }
         }

		/*public function report_peserta(){
			$this->excel->getProperties()->setCreator("Muhammad Deden Firdaus")
							 ->setLastModifiedBy(" ")
							 ->setTitle("Report Peserta PCMB")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("laporan");


			$this->excel->getActiveSheet()->setTitle('PESERTA PCMB');
			$styleThickBrownBorderOutline = array(
				'borders' => array(
					'outline' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			$this->excel->getActiveSheet()->mergeCells('A1:O1');
			$this->excel->getActiveSheet()->setCellValue('A1', 'DAFTAR PESERTA MONITOR 2012');
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('A3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('A3', 'NO');
			$this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('B3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('B3', 'NIM');
			$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('C3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('C3', 'NAMA');
			$this->excel->getActiveSheet()->getStyle('C3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('D3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('D3', 'KELAS');
			$this->excel->getActiveSheet()->getStyle('D3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('E3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('E3', 'ANGKATAN');
			$this->excel->getActiveSheet()->getStyle('E3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('F3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('F3', 'TTL');
			$this->excel->getActiveSheet()->getStyle('F3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('F3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('G3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('G3', 'ALAMAT');
			$this->excel->getActiveSheet()->getStyle('G3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('G3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('G3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('H3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('H3', 'JK');
			$this->excel->getActiveSheet()->getStyle('H3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('H3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('H3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('I3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('I3', 'UKURAN KAOS');
			$this->excel->getActiveSheet()->getStyle('I3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('I3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('J3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('J3', 'NO HP');
			$this->excel->getActiveSheet()->getStyle('J3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('J3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('J3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('K3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('K3', 'EMAIL');
			$this->excel->getActiveSheet()->getStyle('K3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('K3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('K3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('L3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('L3', 'FACEBOOK');
			$this->excel->getActiveSheet()->getStyle('L3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('L3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('M3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('M3', 'TWITTER');
			$this->excel->getActiveSheet()->getStyle('M3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('M3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('M3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('N3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('N3', 'ORANG TUA/WALI');
			$this->excel->getActiveSheet()->getStyle('N3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('N3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('N3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('O3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('O3', 'NO HO ORTU/WALI');
			$this->excel->getActiveSheet()->getStyle('O3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('O3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('O3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('P3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('P3', 'PENYIT PRIBADI');
			$this->excel->getActiveSheet()->getStyle('P3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('P3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('P3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
			$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(6);
			$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(20);


			$filename='test_excel.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
			             
			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');

		}*/

		public function gedung(){

			$this->excel->getProperties()->setCreator("Muhammad Deden Firdaus")
							 ->setLastModifiedBy(" ")
							 ->setTitle("Report Data Gedung")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("laporan");


			$this->excel->getActiveSheet()->setTitle('Data Gedung');
			$styleThickBrownBorderOutline = array(
				'borders' => array(
					'outline' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			$this->excel->getActiveSheet()->mergeCells('A1:B1');
			$this->excel->getActiveSheet()->setCellValue('A1', 'DAFTAR GEDUNG');
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('A3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('A3', 'NO');
			$this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('B3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('B3', 'GEDUNG');
			$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$gedung=$this->m_report->gedung();
			$baris=4;
			$no=1;
			foreach ($gedung->result() as $dt) {
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('A'.$baris.'', ''.$no.'');
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('B'.$baris.'', ''.$dt->nama_gedung.'');
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $baris++;
            $no++;
			}

			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			


			$filename='DATA_GEDUNG.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
			             
			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');
			//echo "sukses";


		}

		public function ruang_tes(){

			$this->excel->getProperties()->setCreator("Muhammad Deden Firdaus")
							 ->setLastModifiedBy(" ")
							 ->setTitle("Report Data Ruang Tes")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("laporan");


			$this->excel->getActiveSheet()->setTitle('Data ruang Tes');
			$styleThickBrownBorderOutline = array(
				'borders' => array(
					'outline' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			$this->excel->getActiveSheet()->mergeCells('A1:D1');
			$this->excel->getActiveSheet()->setCellValue('A1', 'DAFTAR GEDUNG');
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('A3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('A3', 'NO');
			$this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('B3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('B3', 'Ruang Tes');
			$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$this->excel->getActiveSheet()->getStyle('C3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('C3', 'Gedung');
			$this->excel->getActiveSheet()->getStyle('C3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('D3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('D3', 'Kapasitas');
			$this->excel->getActiveSheet()->getStyle('D3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		    
		    $ruang_tes=$this->m_report->ruang_tes();
			$baris=4;
			$no=1;
			foreach ($ruang_tes->result() as $dt) {
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('A'.$baris.'', ''.$no.'');
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('B'.$baris.'', ''.$dt->nama_ruang_tes.'');
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                
                $this->excel->getActiveSheet()->getDefaultStyle('C'.$baris.'')->getAlignment()->setWrapText(true);
				$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('C'.$baris.'', ''.$dt->nama_gedung.'');
				$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

				$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('D'.$baris.'', ''.$dt->kapasitas.'');
				$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $baris++;
            $no++;
			}

			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			


			$filename='DATA_RUANG_TES.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
			             
			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');


		}

		public function pengawas(){

			$this->excel->getProperties()->setCreator("Muhammad Deden Firdaus")
							 ->setLastModifiedBy(" ")
							 ->setTitle("Report Data Pengawas")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("laporan");


			$this->excel->getActiveSheet()->setTitle('Data Pengawas');
			$styleThickBrownBorderOutline = array(
				'borders' => array(
					'outline' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			$this->excel->getActiveSheet()->mergeCells('A1:F1');
			$this->excel->getActiveSheet()->setCellValue('A1', 'DAFTAR PENGAWAS');
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('A3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('A3', 'NO');
			$this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('B3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('B3', 'Nama');
			$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$this->excel->getActiveSheet()->getStyle('C3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('C3', 'Ruang Tes');
			$this->excel->getActiveSheet()->getStyle('C3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('D3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('D3', 'Gedung');
			$this->excel->getActiveSheet()->getStyle('D3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		    
		    $this->excel->getActiveSheet()->getStyle('E3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('E3', 'Username');
			$this->excel->getActiveSheet()->getStyle('E3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('F3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('F3', 'Password');
			$this->excel->getActiveSheet()->getStyle('F3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('F3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		    $pengawas=$this->m_report->pengawas();
			$baris=4;
			$no=1;
			foreach ($pengawas->result() as $dt) {
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('A'.$baris.'', ''.$no.'');
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('B'.$baris.'', ''.$dt->nama_pengawas.'');
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                
                $this->excel->getActiveSheet()->getDefaultStyle('C'.$baris.'')->getAlignment()->setWrapText(true);
				$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('C'.$baris.'', ''.$dt->nama_ruang_tes.'');
				$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

				$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('D'.$baris.'', ''.$dt->nama_gedung.'');
				$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

                $this->excel->getActiveSheet()->getStyle('E'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('E'.$baris.'', ''.$dt->username.'');
				$this->excel->getActiveSheet()->getStyle('E'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('E'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('E'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('E'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

				$this->excel->getActiveSheet()->getStyle('F'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('F'.$baris.'', ''.$dt->password.'');
				$this->excel->getActiveSheet()->getStyle('F'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('F'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('F'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('F'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $baris++;
            $no++;
			}

			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
			


			$filename='DATA_PENGAWAS.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
			             
			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');


		}

		public function fakultas(){

			$this->excel->getProperties()->setCreator("Muhammad Deden Firdaus")
							 ->setLastModifiedBy(" ")
							 ->setTitle("Report Data fakultas")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("laporan");


			$this->excel->getActiveSheet()->setTitle('Data fakultas');
			$styleThickBrownBorderOutline = array(
				'borders' => array(
					'outline' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			$this->excel->getActiveSheet()->mergeCells('A1:B1');
			$this->excel->getActiveSheet()->setCellValue('A1', 'DAFTAR FAKULTAS');
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('A3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('A3', 'NO');
			$this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('B3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('B3', 'FAKULTAS');
			$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$fakultas=$this->m_report->fakultas();
			$baris=4;
			$no=1;
			foreach ($fakultas->result() as $dt) {
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('A'.$baris.'', ''.$no.'');
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('B'.$baris.'', ''.$dt->fakultas.'');
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $baris++;
            $no++;
			}

			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			


			$filename='DATA_FAKULTAS.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
			             
			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');


		}

	    public function jurusan(){

			$this->excel->getProperties()->setCreator("Muhammad Deden Firdaus")
							 ->setLastModifiedBy(" ")
							 ->setTitle("Report Data Jurusan")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("laporan");


			$this->excel->getActiveSheet()->setTitle('Data Jurusan');
			$styleThickBrownBorderOutline = array(
				'borders' => array(
					'outline' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			$this->excel->getActiveSheet()->mergeCells('A1:E1');
			$this->excel->getActiveSheet()->setCellValue('A1', 'DAFTAR JURUSAN');
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('A3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('A3', 'NO');
			$this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('B3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('B3', 'KODE');
			$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('C3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('C3', 'JURUSAN');
			$this->excel->getActiveSheet()->getStyle('C3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$this->excel->getActiveSheet()->getStyle('D3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('D3', 'FAKULTAS');
			$this->excel->getActiveSheet()->getStyle('D3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $this->excel->getActiveSheet()->getStyle('E3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('E3', 'KUOTA');
			$this->excel->getActiveSheet()->getStyle('E3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$jurusan=$this->m_report->jurusan();
			$baris=4;
			$no=1;
			foreach ($jurusan->result() as $dt) {
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('A'.$baris.'', ''.$no.'');
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('B'.$baris.'', ''.$dt->kode_jurusan.'');
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
           
                $this->excel->getActiveSheet()->getStyle('C'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('C'.$baris.'', ''.$dt->nama_jurusan.'');
				$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

                $this->excel->getActiveSheet()->getStyle('D'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('D'.$baris.'', ''.$dt->fakultas.'');
				$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                
                $this->excel->getActiveSheet()->getStyle('E'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('E'.$baris.'', ''.$dt->kuota.'');
				$this->excel->getActiveSheet()->getStyle('E'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('E'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('E'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$this->excel->getActiveSheet()->getStyle('E'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $baris++;
            $no++;
			}

			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
			


			$filename='DATA_JURUSAN.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
			             
			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');


		}

		public function sekolah(){


			$this->excel->getProperties()->setCreator("Muhammad Deden Firdaus")
							 ->setLastModifiedBy(" ")
							 ->setTitle("Report Data Sekolah")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("laporan");


			$this->excel->getActiveSheet()->setTitle('Data Sekolah');
			$styleThickBrownBorderOutline = array(
				'borders' => array(
					'outline' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			$this->excel->getActiveSheet()->mergeCells('A1:F1');
			$this->excel->getActiveSheet()->setCellValue('A1', 'DAFTAR SEKOLAH');
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('A3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('A3', 'NO');
			$this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('B3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('B3', 'Kode Sekolah');
			$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$this->excel->getActiveSheet()->getStyle('C3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('C3', 'Nama Sekolah');
			$this->excel->getActiveSheet()->getStyle('C3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$this->excel->getActiveSheet()->getStyle('D3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('D3', 'Provinsi');
			$this->excel->getActiveSheet()->getStyle('D3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		    
		    $this->excel->getActiveSheet()->getStyle('E3')->applyFromArray($styleThickBrownBorderOutline);
			$this->excel->getActiveSheet()->setCellValue('E3', 'Kota');
			$this->excel->getActiveSheet()->getStyle('E3')->getFont()->setSize(10);
			$this->excel->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$sekolah=$this->m_report->sekolah();
			$baris=4;
			$no=1;
			foreach ($sekolah->result() as $dt) {
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('A'.$baris.'', ''.$no.'');
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('A'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('B'.$baris.'', ''.$dt->kode_sekolah.'');
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                
                $this->excel->getActiveSheet()->getDefaultStyle('C'.$baris.'')->getAlignment()->setWrapText(true);
				$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('C'.$baris.'', ''.$dt->nama_smta.'');
				$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

				$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('D'.$baris.'', ''.$dt->nama_propinsi.'');
				$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

                $this->excel->getActiveSheet()->getStyle('E'.$baris.'')->applyFromArray($styleThickBrownBorderOutline);
				$this->excel->getActiveSheet()->setCellValue('E'.$baris.'', ''.$dt->nama_kota.'');
				$this->excel->getActiveSheet()->getStyle('E'.$baris.'')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('E'.$baris.'')->getFont()->setBold(false);
				$this->excel->getActiveSheet()->getStyle('E'.$baris.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('E'.$baris.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

				$baris++;
            $no++;
			}

			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
			
			


			$filename='DATA_SEKOLAH.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
			             
			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');


		}

		public function hasil_seleksi(){
			header("Content-type: application/vnd-ms-excel"); 
			// Mendefinisikan nama file ekspor "hasil-export.xls"
			header("Content-Disposition: attachment; filename=hasil_seleksi.xls"); 
			echo "
			<table border='1' cellpadding=0 cellspacing=0 width=10111 style='border-collapse:
			 collapse;table-layout:fixed;width:7593pt'>

			 <tr height=17 style='height:12.75pt'>
			  <td>No</td>
			  <td height=17 width=64 style='height:12.75pt;width:48pt'>NIM</td>
			  <td width=118 style='width:89pt'>No. Tes (wajib diisi)</td>
			  <td width=215 style='width:161pt'>Nama (wajib diisi)</td>
			  <td width=145 style='width:109pt'>Jalur Masuk (wajib diisi)</td>
			  <td width=140 style='width:105pt'>Gelombang (wajib diisi)</td>
			  <td width=152 style='width:114pt'>Tahun Masuk (wajib diisi)</td>
			  <td width=269 style='width:202pt'>Kode Program dari Program Studi (wajib
			  diisi)</td>
			  <td width=309 style='width:232pt'>Status Masuk PT (B=Baru, P=Pindahan) (wajib
			  diisi)</td>
			  <td width=190 style='width:143pt'>Tanggal Daftar</td>
			  <td width=66 style='width:50pt'>NIM Lama</td>
			  <td width=146 style='width:110pt'>Kode Kota Tempat Lahir</td>
			  <td width=149 style='width:112pt'>Nama Kota Tempat Lahir</td>
			  <td width=83 style='width:62pt'>Tanggal Lahir</td>
			  <td width=81 style='width:61pt'>Kode Agama</td>
			  <td width=89 style='width:67pt'>Jenis Kelamin</td>
			  <td width=115 style='width:86pt'>Kode Status Nikah</td>
			  <td width=158 style='width:119pt'>Kode Kota Tempat Tinggal</td>
			  <td width=180 style='width:135pt'>Alamat</td>
			  <td width=80 style='width:60pt'>Kode Pos</td>
			  <td width=121 style='width:91pt'>Kode Warga Negara</td>
			  <td width=180 style='width:135pt'>Kode Negara</td>
			  <td width=133 style='width:100pt'>No. Telp/HP</td>
			  <td width=142 style='width:107pt'>Email</td>
			  <td width=81 style='width:61pt'>No. Asuransi</td>
			  <td width=135 style='width:101pt'>Tempat Kerja</td>
			  <td width=134 style='width:101pt'>Beasiswa</td>
			  <td width=122 style='width:92pt'>Kode Status Rumah</td>
			  <td width=119 style='width:89pt'>Kode Sumber Dana</td>
			  <td width=64 style='width:48pt'>Hubungan <span style='display:none'>Biaya</span></td>
			  <td width=79 style='width:59pt'>Kode SMTA</td>
			  <td width=125 style='width:94pt'>Kode Jurusan SMTA</td>
			  <td width=109 style='width:82pt'>Kode Jenis SMTA</td>
			  <td width=114 style='width:86pt'>Tahun Daftar Smta</td>
			  <td width=110 style='width:83pt'>Tahun Lulus Smta</td>
			  <td width=122 style='width:92pt'>Kelas Masuk SMTA</td>
			  <td width=180 style='width:135pt'>Alamat Smta</td>
			  <td width=151 style='width:113pt'>No. Ijazah</td>
			  <td width=150 style='width:113pt'>Tanggal ijazah</td>
			  <td width=143 style='width:107pt'>Ijazah Smta</td>
			  <td width=95 style='width:71pt'>Nilai Uas Smta</td>
			  <td width=99 style='width:74pt'>Jumlah Saudara</td>
			  <td width=180 style='width:135pt'>Nama Ayah</td>
			  <td width=180 style='width:135pt'>Nama Ibu</td>
			  <td width=137 style='width:103pt'>Kode Pendidikan Ayah</td>
			  <td width=187 style='width:140pt'>Kode Pendidikan Terakhir Ayah</td>
			  <td width=126 style='width:95pt'>Kode Pendidikan Ibu</td>
			  <td width=174 style='width:131pt'>Kode Pendidikan Terakhir Ibu</td>
			  <td width=131 style='width:98pt'>Kode Pekerjaan Ayah</td>
			  <td width=118 style='width:89pt'>Kode Pekerjaan Ibu</td>
			  <td width=127 style='width:95pt'>Kode Kota Orang tua</td>
			  <td width=125 style='width:94pt'>Kode Pos Orang tua</td>
			  <td width=140 style='width:105pt'>No. Telp/HP Orang Tua</td>
			  <td width=100 style='width:75pt'>Email Orang tua</td>
			  <td width=111 style='width:83pt'>Alamat Orang Tua</td>
			  <td width=116 style='width:87pt'>Tanggal Lahir Ayah</td>
			  <td width=103 style='width:77pt'>Tanggal Lahir Ibu</td>
			  <td width=194 style='width:146pt'>Ayah Meninggal (1=Ya, 2=Tidak)</td>
			  <td width=150 style='width:113pt'>Tanggal Ayah Meninggal</td>
			  <td width=181 style='width:136pt'>Ibu Meninggal (1=Ya, 2=Tidak)</td>
			  <td width=134 style='width:101pt'>Tanggal Ibu Meninggal</td>
			  <td width=69 style='width:52pt'>Nama Wali</td>
			  <td width=133 style='width:100pt'>Kode Pendidikan Wali</td>
			  <td width=184 style='width:138pt'>Kode Pendidikan Terakhir Wali</td>
			  <td width=127 style='width:95pt'>Kode Pekerjaan Wali</td>
			  <td width=97 style='width:73pt'>Kode Kota Wali</td>
			  <td width=80 style='width:60pt'>No Telp Wali</td>
			  <td width=94 style='width:71pt'>Kode Pos Wali</td>
			  <td width=69 style='width:52pt'>Email Wali</td>
			  <td width=77 style='width:58pt'>Alamat Wali</td>
			  <td width=113 style='width:85pt'>Tanggal Lahir Wali</td>
			  <td width=191 style='width:143pt'>Wali Meninggal (1=Ya, 2=Tidak)</td>
			  <td width=143 style='width:107pt'>Tanggal Wali Meninggal</td>
			  <td width=171 style='width:128pt'>Kode Penghasilan Orang tua</td>
			  <td width=208 style='width:156pt'>Orang Tua Mampu (1=Ya, 2=Tidak)</td>
			  <td width=184 style='width:138pt'>Jumlah Tanggungan Orang Tua</td>
			 </tr>";
			 $no=1;
             $q=$this->m_report->hasil_seleksi();
             foreach ($q->result() as $h) {
             	 echo "
			 <tr height=17 style='height:12.75pt'>
			  <td>$no</td>
			  <td height=17 style='height:12.75pt'></td>
			  <td align=right>".$h->no_pes."</td>
			  <td>".$h->nama."</td>
			  <td>UTL</td>
			  <td align=right>1</td>
			  <td align=right>2013</td>
			  <td align=right>";
              if($h->lulus=='lulus_pil_1'){
                  echo $h->pil_1;
              }
              else {
                  echo $h->pil_2;
              }
             
			  echo "
			  </td>
			  <td>B</td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td>".$h->alamat."</td>
			  <td></td>
			   <td></td>
			  <td></td>
			  <td>".$h->no_hp."</td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			   <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td>".$h->alamat_sekolah."</td>
			  <td></td>
			  <td></td>
			  <td></td>
			   <td></td>
			  <td></td>
			  <td>".$h->ayah."</td>
			  <td>".$h->ibu."</td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			   <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			   <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			   <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			
			
			 </tr>";
			 $no++;
             }
			echo "
			 
			 
			</table>";
     

		}

		public function pendaftar(){
			header("Content-type: application/vnd-ms-excel"); 
			// Mendefinisikan nama file ekspor "hasil-export.xls"
			header("Content-Disposition: attachment; filename=pendaftar_pcmb_2013.xls"); 
			echo "
			<table border='1' cellpadding=0 cellspacing=0 width=10111 style='border-collapse:
			 collapse;table-layout:fixed;width:7593pt'>

			 <tr height=17 style='height:12.75pt'>
			  <td>No</td>
			  <td height=17 width=64 style='height:12.75pt;width:48pt'>NIM</td>
			  <td width=118 style='width:89pt'>No. Tes (wajib diisi)</td>
			  <td width=215 style='width:161pt'>Nama (wajib diisi)</td>
			  <td width=145 style='width:109pt'>Jalur Masuk (wajib diisi)</td>
			  <td width=140 style='width:105pt'>Gelombang (wajib diisi)</td>
			  <td width=152 style='width:114pt'>Tahun Masuk (wajib diisi)</td>
			  <td width=269 style='width:202pt'>Kode Program dari Program Studi (wajib
			  diisi)</td>
			  <td width=309 style='width:232pt'>Status Masuk PT (B=Baru, P=Pindahan) (wajib
			  diisi)</td>
			  <td width=190 style='width:143pt'>Tanggal Daftar</td>
			  <td width=66 style='width:50pt'>NIM Lama</td>
			  <td width=146 style='width:110pt'>Kode Kota Tempat Lahir</td>
			  <td width=149 style='width:112pt'>Nama Kota Tempat Lahir</td>
			  <td width=83 style='width:62pt'>Tanggal Lahir</td>
			  <td width=81 style='width:61pt'>Kode Agama</td>
			  <td width=89 style='width:67pt'>Jenis Kelamin</td>
			  <td width=115 style='width:86pt'>Kode Status Nikah</td>
			  <td width=158 style='width:119pt'>Kode Kota Tempat Tinggal</td>
			  <td width=180 style='width:135pt'>Alamat</td>
			  <td width=80 style='width:60pt'>Kode Pos</td>
			  <td width=121 style='width:91pt'>Kode Warga Negara</td>
			  <td width=180 style='width:135pt'>Kode Negara</td>
			  <td width=133 style='width:100pt'>No. Telp/HP</td>
			  <td width=142 style='width:107pt'>Email</td>
			  <td width=81 style='width:61pt'>No. Asuransi</td>
			  <td width=135 style='width:101pt'>Tempat Kerja</td>
			  <td width=134 style='width:101pt'>Beasiswa</td>
			  <td width=122 style='width:92pt'>Kode Status Rumah</td>
			  <td width=119 style='width:89pt'>Kode Sumber Dana</td>
			  <td width=64 style='width:48pt'>Hubungan <span style='display:none'>Biaya</span></td>
			  <td width=79 style='width:59pt'>Kode SMTA</td>
			  <td width=125 style='width:94pt'>Kode Jurusan SMTA</td>
			  <td width=109 style='width:82pt'>Kode Jenis SMTA</td>
			  <td width=114 style='width:86pt'>Tahun Daftar Smta</td>
			  <td width=110 style='width:83pt'>Tahun Lulus Smta</td>
			  <td width=122 style='width:92pt'>Kelas Masuk SMTA</td>
			  <td width=180 style='width:135pt'>Alamat Smta</td>
			  <td width=151 style='width:113pt'>No. Ijazah</td>
			  <td width=150 style='width:113pt'>Tanggal ijazah</td>
			  <td width=143 style='width:107pt'>Ijazah Smta</td>
			  <td width=95 style='width:71pt'>Nilai Uas Smta</td>
			  <td width=99 style='width:74pt'>Jumlah Saudara</td>
			  <td width=180 style='width:135pt'>Nama Ayah</td>
			  <td width=180 style='width:135pt'>Nama Ibu</td>
			  <td width=137 style='width:103pt'>Kode Pendidikan Ayah</td>
			  <td width=187 style='width:140pt'>Kode Pendidikan Terakhir Ayah</td>
			  <td width=126 style='width:95pt'>Kode Pendidikan Ibu</td>
			  <td width=174 style='width:131pt'>Kode Pendidikan Terakhir Ibu</td>
			  <td width=131 style='width:98pt'>Kode Pekerjaan Ayah</td>
			  <td width=118 style='width:89pt'>Kode Pekerjaan Ibu</td>
			  <td width=127 style='width:95pt'>Kode Kota Orang tua</td>
			  <td width=125 style='width:94pt'>Kode Pos Orang tua</td>
			  <td width=140 style='width:105pt'>No. Telp/HP Orang Tua</td>
			  <td width=100 style='width:75pt'>Email Orang tua</td>
			  <td width=111 style='width:83pt'>Alamat Orang Tua</td>
			  <td width=116 style='width:87pt'>Tanggal Lahir Ayah</td>
			  <td width=103 style='width:77pt'>Tanggal Lahir Ibu</td>
			  <td width=194 style='width:146pt'>Ayah Meninggal (1=Ya, 2=Tidak)</td>
			  <td width=150 style='width:113pt'>Tanggal Ayah Meninggal</td>
			  <td width=181 style='width:136pt'>Ibu Meninggal (1=Ya, 2=Tidak)</td>
			  <td width=134 style='width:101pt'>Tanggal Ibu Meninggal</td>
			  <td width=69 style='width:52pt'>Nama Wali</td>
			  <td width=133 style='width:100pt'>Kode Pendidikan Wali</td>
			  <td width=184 style='width:138pt'>Kode Pendidikan Terakhir Wali</td>
			  <td width=127 style='width:95pt'>Kode Pekerjaan Wali</td>
			  <td width=97 style='width:73pt'>Kode Kota Wali</td>
			  <td width=80 style='width:60pt'>No Telp Wali</td>
			  <td width=94 style='width:71pt'>Kode Pos Wali</td>
			  <td width=69 style='width:52pt'>Email Wali</td>
			  <td width=77 style='width:58pt'>Alamat Wali</td>
			  <td width=113 style='width:85pt'>Tanggal Lahir Wali</td>
			  <td width=191 style='width:143pt'>Wali Meninggal (1=Ya, 2=Tidak)</td>
			  <td width=143 style='width:107pt'>Tanggal Wali Meninggal</td>
			  <td width=171 style='width:128pt'>Kode Penghasilan Orang tua</td>
			  <td width=208 style='width:156pt'>Orang Tua Mampu (1=Ya, 2=Tidak)</td>
			  <td width=184 style='width:138pt'>Jumlah Tanggungan Orang Tua</td>
			 </tr>";
			 $no=1;
             $q=$this->m_report->pendaftar();
             foreach ($q->result() as $h) {
             	 echo "
			 <tr height=17 style='height:12.75pt'>
			  <td>$no</td>
			  <td height=17 style='height:12.75pt'></td>
			  <td align=right>".$h->no_pes."</td>
			  <td>".$h->nama."</td>
			  <td>UTL</td>
			  <td align=right>1</td>
			  <td align=right>2013</td>
			  <td align=right>";
              if($h->lulus=='lulus_pil_1'){
                  echo $h->pil_1;
              }
              else {
                  echo $h->pil_2;
              }
             
			  echo "
			  </td>
			  <td>B</td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td>".$h->alamat."</td>
			  <td></td>
			   <td></td>
			  <td></td>
			  <td>".$h->no_hp."</td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			   <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td>".$h->alamat_sekolah."</td>
			  <td></td>
			  <td></td>
			  <td></td>
			   <td></td>
			  <td></td>
			  <td>".$h->ayah."</td>
			  <td>".$h->ibu."</td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			   <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			   <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			   <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			
			
			 </tr>";
			 $no++;
             }
			echo "
			 
			 
			</table>";
     

		}
}
			