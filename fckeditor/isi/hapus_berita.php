<?php
/* 
 * Copyright 2012
 * by M.Deden Firdaus
 * web : http://dthan.com
 * email : dthan@dthan.com
 */
include "../conection.php";

session_start();

        $hari = date("Y-m-d");
		
		   
		    $r=mysql_fetch_array(mysql_query("select  * from berita where id_berita='$_GET[id]'"));
	    unlink("../../gambar_berita/$r[gambar]");
		$query = mysql_query ("delete from berita where id_berita='$_GET[id]'");
        echo "
		    <script>
			 document.location = '/mukhlisin/admin/berita';
			</script>
		     ";

?>