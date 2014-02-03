<?php
/* 
 * Copyright 2012
 * by M.Deden Firdaus
 * web : http://dthan.com
 * email : dthan@dthan.com
 */
 error_reporting(0);
include "../conection.php";
   $r=mysql_fetch_array(mysql_query("select * from pengajar where id_pengajar='$_GET[id]'"));
   unlink("mukhlisin/foto_pengajar/$r[foto]");
   mysql_query("delete from pengajar where id_pengajar='$_GET[id]'");
   echo "
     <script>
	 window.location='/mukhlisin/admin/pengajar-1';
	 </script>
	 ";

?>