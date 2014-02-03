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
   $id=$_POST["id_berita"];
   $r=mysql_fetch_array(mysql_query("select  * from berita where id_berita='$id'"));
   if ($r['gambar']=='' && !empty ($filename)){
        move_uploaded_file($tmp_file, $_SERVER['DOCUMENT_ROOT'] . $destination);  
		  $query = mysql_query ("update berita set judul_berita='$_POST[judul]',id_lembaga='$_POST[kategori]',
		                       isi_berita='$_POST[isi_berita]',penulis='$_SESSION[username]',gambar='".$filename."'
							   where id_berita='$_POST[id_berita]'");
   }
   else if ($r['gambar']!='' && empty ($filename)){
      $query = mysql_query ("update berita set judul_berita='$_POST[judul]',id_lembaga='$_POST[kategori]',
		                       isi_berita='$_POST[isi_berita]',penulis='$_SESSION[username]'
							   where id_berita='$_POST[id_berita]'");
   }
   else {
       unlink("../../gambar_berita/$r[gambar]");
       move_uploaded_file($tmp_file, $_SERVER['DOCUMENT_ROOT'] . $destination); 
	   	    $query = mysql_query ("update berita set judul_berita='$_POST[judul]',id_lembaga='$_POST[kategori]',
		                       isi_berita='$_POST[isi_berita]',penulis='$_SESSION[username]',gambar='".$filename."'
							   where id_berita='$_POST[id_berita]'");
   }
   
   


	


?>