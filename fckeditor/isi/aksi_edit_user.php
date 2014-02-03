 <?php
	include "../koneksi.php";
	$username = $_POST['username'];
	$nama_lengkap = $_POST['nama_lengkap'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$level = $_POST['level'];
	$web = $_POST['web'];
	$blokir = $_POST['blokir'];
	$photo = $_FILES['upload']['name'];
	$vdir_upload = "../photo_user/";
	$vfile_upload = $vdir_upload . $photo;
	move_uploaded_file($_FILES["upload"]["tmp_name"], $vfile_upload);
	$query = "update user set username='$username', nama_lengkap='$nama_lengkap', password='$password', 
	          email='$email', level='$level', web='$web', blokir='$blokir', photo='$photo' where id_user='$_POST[id]'";
	$query_jalan = mysql_query($query);
	
	header('location:../user');
	
?>
 