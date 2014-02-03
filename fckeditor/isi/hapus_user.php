<?php
include "../conection.php";

if (isset($_GET['id'])) {
	$id_user = $_GET['id'];
} else {
	die ("Error. No id Selected! ");	
}
?>
<div id="content">
	<?
	//proses delete berita
	if (!empty($id_user) && $id_user != "") {
		$x=mysql_query("select * from user where id_user='$id_user'");
		$r=mysql_fetch_array($x);
		$query = "DELETE FROM user WHERE id_user='$id_user'";
		$sql = mysql_query ($query);
		
	} else {
		die ("Access Denied");	
	}
	echo "
	<script>
	  document.location='/mukhlisin/admin/user-$_GET[hal]';
	</script>";
?>
</div>