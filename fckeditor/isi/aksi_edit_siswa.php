<?php
	include "../koneksi.php";
	$nis = $_POST['nis'];
	$nama_lengkap = $_POST['nama_lengkap'];
	$alamat = $_POST['alamat'];
	$tempat_lahir = $_POST['tempat_lahir'];
	$tgl_lahir = $_POST['thn']."-".$_POST['bln']."-".$_POST['tgl'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$kategori = $_POST['kategori'];
	$nama_ayah = $_POST['nama_ayah'];
	$nama_ibu = $_POST['nama_ibu'];
	$th_masuk = $_POST['th_masuk'];
	$no_telp = $_POST['no_telp'];
	$foto = $_FILES['upload']['name'];
	$vdir_upload = "../foto_siswa/";
	$vfile_upload = $vdir_upload . $foto;
	move_uploaded_file($_FILES["upload"]["tmp_name"], $vfile_upload);
	$query = "update siswa set nis='$nis', nama_lengkap='$nama_lengkap', alamat='$alamat', tempat_lahir='$tempat_lahir', 
	          tgl_lahir='$tgl_lahir', jenis_kelamin='$jenis_kelamin', kategori='$kategori', nama_ayah='$nama_ayah', nama_ibu='$nama_ibu', th_masuk='$th_masuk',
			  no_telp='$no_telp', foto='$foto' where id_siswa='$_POST[id]'";
	$query_jalan = mysql_query($query);
	header('location:../siswa');
?>
 