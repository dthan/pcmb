<?php
header('Content-type: text/html');
include "../conection.php";
session_start();
if ($_FILES)
{
	   
   $hari = date("Y-m-d");
	    $query = mysql_query ("update agenda set judul_agenda='$_POST[judul]',
		                                          id_agenda='$_POST[id_agenda]',
												  id_lembaga='$_POST[id_lembaga]',
												  no='$_POST[no]',
												  deskripsi='$_POST[deskripsi]',
												  waktu='$_POST[waktu]',
												  tempat='$_POST[tempat]',
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