<?php
header('Content-type: text/html');
include "../conection.php";
session_start();
if ($_FILES)
{
	//$title = $_POST['title'];
   $tmp_file = $_FILES['upload']['tmp_name'];
   $filetype = $_FILES['upload']['type'];
   $filesize = $_FILES['upload']['size'];
   $filename = $_FILES['upload']['name'];
   //$path = pathinfo($_SERVER['PHP_SELF']);
   $destination = 'mukhlisin/gambar_berita/' . $filename;
   move_uploaded_file($tmp_file, $_SERVER['DOCUMENT_ROOT'] . $destination);
   
   $hari = date("Y-m-d");
	    $query = mysql_query ("update berita set judul_berita='$_POST[judul]',
		                                          id_kategori='$_POST[kategori]',
												  isi_berita='$_POST[isi_berita]',
												  penulis='$_SESSION[username]',
												  tanggal='$hari',
												  gambar='$filename'
												  where id_berita='$_POST[id_berita]'");
	

	  echo 'sukses';

}	
else
{

   $hari = date("Y-m-d");
	    $query = mysql_query ("update berita set judul_berita='$_POST[judul]',
		                                          id_kategori='$_POST[kategori]',
												  isi_berita='$_POST[isi_berita]',
												  penulis='$_SESSION[username]',
												  tanggal='$hari'												  
												  where id_berita='$_POST[id_berita]'");
	

	  echo 'sukses';

}
   


?>