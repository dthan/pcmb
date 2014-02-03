 <?php
	include "../conection.php";
   $tmp_file = $_FILES['upload']['tmp_name'];
   $filetype = $_FILES['upload']['type'];
   $filesize = $_FILES['upload']['size'];
   $filename = $_FILES['upload']['name'];
   //$path = pathinfo($_SERVER['PHP_SELF']);
   $destination = 'mukhlisin/foto_user/' . $filename;
   move_uploaded_file($tmp_file, $_SERVER['DOCUMENT_ROOT'] . $destination);
?>
 