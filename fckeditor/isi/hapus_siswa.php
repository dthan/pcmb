<?php
include "../conection.php";

if (isset($_GET['id'])) {
	$id_siswa = $_GET['id'];
} else {
	die ("Error. No id Selected! ");	
}
?>
<div id="content">
	<?
	//proses delete berita
	if (!empty($id_siswa) && $id_siswa != "") {
		$x=mysql_query("select * from siswa where id_siswa='$id_siswa'");
		$r=mysql_fetch_array($x);
		unlink("../../foto_siswa/$r[foto]");
		$query = "DELETE FROM siswa WHERE id_siswa='$id_siswa'";
		$sql = mysql_query ($query);
		
	} else {
		die ("Access Denied");	
	}
	echo "
	<script>
	  document.location='/mukhlisin/admin/siswa';
	</script>";
?>
</div>