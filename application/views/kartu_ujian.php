<?php


/* setting zona waktu */ 
date_default_timezone_set('Asia/Jakarta');

/* konstruktor halaman pdf sbb :    
   P  = Orientasinya "Potrait"
   cm = ukuran halaman dalam satuan centimeter
   A4 = Format Halaman
   
   jika ingin mensetting sendiri format halamannya, gunakan array(width, height)  
   contoh : $this->fpdf->FPDF("P","cm", array(20, 20));  
*/

$this->fpdf->FPDF("P","cm","A4");

// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$this->fpdf->SetMargins(1,1,1);


/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
   di footer, nanti kita akan membuat page number dengan format : number page / total page
*/
$this->fpdf->AliasNbPages();

// AddPage merupakan fungsi untuk membuat halaman baru
$this->fpdf->AddPage();

// Setting Font : String Family, String Style, Font size 
$this->fpdf->SetFont('Times','B',14);

/* Kita akan membuat header dari halaman pdf yang kita buat 
   -------------- Header Halaman dimulai dari baris ini -----------------------------
*/
$this->fpdf->Cell(19,0.7,'UIN SUNAN GUNUNG DJATI BANDUNG',0,0,'C');

// fungsi Ln untuk membuat baris baru
$this->fpdf->Ln();
$this->fpdf->Cell(19,0.7,'SELEKSI PENERIMAAN MAHASISWA BARU(PCMB)',0,0,'C');

$this->fpdf->Ln();
/* Setting ulang Font : String Family, String Style, Font size
   kenapa disetting ulang ???
   jika tidak disetting ulang, ukuran font akan mengikuti settingan sebelumnya.
   tetapi karena kita menginginkan settingan untuk penulisan alamatnya berbeda,
   maka kita harus mensetting ulang Font nya.
   jika diatas settingannya : helvetica, 'B', '12'
   khusus untuk penulisan alamat, kita setting : helvetica, '', 10
   yang artinya string stylenya normal / tidak Bold dan ukurannya 10 
*/
$this->fpdf->SetFont('helvetica','',10);
//$this->fpdf->Cell(19,0.5,'KARTU UJIAN PESERTA',0,0,'C');


//logo uin
//$this->fpdf->setXY(1,1);
$this->fpdf->Image(base_url()."asset/images/uin.jpg",1.6,0.7,1.8);

$this->fpdf->Cell(19,0.5,'homepage : www.uinsgd.ac.id  || email : pcmb@uinsgd.ac.id',0,0,'C');

/* Fungsi Line untuk membuat garis */
$this->fpdf->Line(1,3.5,20,3.5);
$this->fpdf->Line(1,3.55,20,3.55);

/* -------------- Header Halaman selesai ------------------------------------------------*/

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Times','B',14);
$this->fpdf->Cell(19,1,'KARTU UJIAN',0,0,'C');
foreach ($data_diri->result() as $dta) {
  
}

/* setting header table */

$this->fpdf->SetFont('Times','',10);


$this->fpdf->setXY(12,4.5);
$this->fpdf->Cell(8,0.5,"Jadwal Ujian ",1,1,"C");
$this->fpdf->setXY(12,5);
$this->fpdf->Cell(8,3,"",1,1,"L");
$this->fpdf->setXY(12,5);
$this->fpdf->Cell(8,0.5,"Selasa 25 Juni 2014",1,1,"L");
$this->fpdf->setXY(12,5.5);
$this->fpdf->Multicell(8,0.5,"1. Validasi Peserta (07.00 - 07.30 WIB) \n2. Tes Potensi Akademik (07.30 - 08.15 WIB) \n3. Tes Bidang Studi Dasar (08.15 - 09.15 WIB) \n4. Istirahat (09.15 - 09.30 WIB) \n5. Tes Wawasan Keislaman (09.30 - 10.30 WIB)");
$this->fpdf->setXY(12,8);
$this->fpdf->Cell(8,1.2,"",1,1,"L");
$this->fpdf->setXY(12,8);
$this->fpdf->Cell(8,0.5,"Rabu 26 Juni 2014",1,1,"L");
$this->fpdf->setXY(12,8.5);
$this->fpdf->Cell(8,0.5,"1. Tes Bidang Studi Umum (08.45 - 09.45 WIB)",0,0,"L");
//$this->fpdf->setXY(13,6);
//$this->fpdf->Cell(7,0.5,"2. Tes Potensi Akademik (07.30 - 08.15 WIB)",1,1,"L");

$this->fpdf->setXY(1,4.5);
$this->fpdf->Cell(2,0.5,"No Peserta ",0,0,"L");
$this->fpdf->setXY(4,4.5);
$this->fpdf->Cell(3,0.5,": ".$dta->no_pes,0,0,"L");

$this->fpdf->setXY(1,5);
$this->fpdf->Cell(2,0.5,"Nama ",0,0,"L");
$this->fpdf->setXY(4,5);
$this->fpdf->Cell(3,0.5,": ".strtoupper($dta->nama),0,0,"L");

$this->fpdf->setXY(1,5.5);
$this->fpdf->Cell(2,0.5,"Tempat/tgl lahir ",0,0,"L");
$this->fpdf->setXY(4,5.5);
$this->fpdf->Cell(3,0.5,": ".$dta->tempat_lahir.", ".$this->tanggal->tgl_indo($dta->tgl_lahir),0,0,"L");

$this->fpdf->setXY(1,6);
$this->fpdf->Cell(2,0.5,"Pilihan 1 ",0,0,"L");
$this->fpdf->setXY(4,6);
$this->fpdf->Cell(3,0.5,": ".$dta->pilihan1,0,0,"L");

$this->fpdf->setXY(1,6.5);
$this->fpdf->Cell(2,0.5,"Pilihan 2 ",0,0,"L");
$this->fpdf->setXY(4,6.5);
$this->fpdf->Cell(3,0.5,": ".$dta->pilihan2,0,0,"L");

$this->fpdf->setXY(1,7);
$this->fpdf->Cell(2,0.5,"Gedung/Ruang Tes ",0,0,"L");
$this->fpdf->setXY(4,7);
$this->fpdf->Cell(3,0.5,": ".$dta->nama_gedung.",  ".$dta->nama_ruang_tes,0,0,"L");

$this->fpdf->setXY(2,10);
$this->fpdf->Cell(5,0.5,"Tanda Tangan Peserta ",0,0,"C");
$this->fpdf->setXY(2,13);
$this->fpdf->Cell(5,0.5,strtoupper($dta->nama),0,0,"C");

$this->fpdf->setXY(14,10);
$this->fpdf->Cell(5,0.5,"Bandung   Juni 2014 ",0,0,"C");
$this->fpdf->setXY(14,13);
$this->fpdf->Cell(5,0.5,"Pengawas Ujian",0,0,"C");
//$this->fpdf->setXY(5,8);
if($dta->foto!=''){
   $this->fpdf->Image(base_url()."upload/foto_pendaftar/".$dta->foto,9,10,3);
}
else {
  $this->fpdf->setXY(9,10);
  $this->fpdf->Cell(3.5,4,"Foto 3x4",1,1,"C");
}

$this->fpdf->Line(1,14.7,20,14.7);
$this->fpdf->Line(1,15.2,20,15.2);

/* generate hasil query disini */

/* setting posisi footer 3 cm dari bawah */
$this->fpdf->SetXY(1,14.7);

/* setting font untuk footer */
$this->fpdf->SetFont('Times','',10);

/* setting cell untuk waktu pencetakan */ 
$this->fpdf->Cell(9.5, 0.5, 'Panitia PCMB UIN SGD Bandung ',0,'LR','L');
$this->fpdf->SetXY(19,14.7);
$this->fpdf->Cell(9.5, 0.5, '2013',0,'LR','L');

$this->fpdf->SetXY(1,16);
$this->fpdf->Cell(19, 0.5, '.............................................................................................potong di sini..................................................................................................',0,'LR','L');

/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
$this->fpdf->Output("kartu_peserta_".$dta->nama.".pdf","I");
?>