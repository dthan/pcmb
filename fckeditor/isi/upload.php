<?php
header('Content-type: text/html');
include "../conection.php";
session_start();

	//$title = $_POST['title'];
   $tmp_file = $_FILES['upload']['tmp_name'];
   $filetype = $_FILES['upload']['type'];
   $filesize = $_FILES['upload']['size'];
   $filename = $_FILES['upload']['name'];
   //$path = pathinfo($_SERVER['PHP_SELF']);
   $destination = 'mukhlisin/gambar_berita/' . $filename;
   move_uploaded_file($tmp_file, $_SERVER['DOCUMENT_ROOT'] . $destination);
   
   $hari = date("Y-m-d");
	    $query = mysql_query ("insert into berita (judul_berita,id_lembaga,isi_berita,penulis,tanggal,gambar) values 
		('$_POST[judul]','$_POST[kategori]','$_POST[isi_berita]','$_SESSION[username]','$hari','$filename')");
		

	

	
   


?>