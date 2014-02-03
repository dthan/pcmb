<?php
/* 
 * Copyright 2012
 * by M.Deden Firdaus
 * web : http://dthan.com
 * email : dthan@dthan.com
 */
include "../conection.php";
session_start();
if ($_POST['aksi']=='input'){
        //$hari = date("Y-m-d");
		//$title = $_POST['title'];
   $tmp_file = $_FILES['upload']['tmp_name'];
   $filetype = $_FILES['upload']['type'];
   $filesize = $_FILES['upload']['size'];
   $filename = $_FILES['upload']['name'];
   //$path = pathinfo($_SERVER['PHP_SELF']);
   $destination = 'mukhlisin/foto_pengajar/' . $filename;
   move_uploaded_file($tmp_file, $_SERVER['DOCUMENT_ROOT'] . $destination);
		$tgl=$_POST['thn']."-".$_POST['bln']."-".$_POST['tgl'];
}
else{
   $tmp_file = $_FILES['upload']['tmp_name'];
   $filetype = $_FILES['upload']['type'];
   $filesize = $_FILES['upload']['size'];
   $filename = $_FILES['upload']['name'];
   //$path = pathinfo($_SERVER['PHP_SELF']);
   $destination = 'mukhlisin/foto_pengajar/' . $filename;
   $r=mysql_fetch_array(mysql_query("select * from pengajar where id_pengajar='$_POST[id]'"));
   if (empty($filename)){
   
   }
   else{
   unlink("mukhlisin/foto_pengajar/$r[foto]");
   move_uploaded_file($tmp_file, $_SERVER['DOCUMENT_ROOT'] . $destination);
		$tgl=$_POST['thn']."-".$_POST['bln']."-".$_POST['tgl'];
  }
}		
		
?>