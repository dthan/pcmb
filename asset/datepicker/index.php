<?php
session_start();

//error_reporting(0);
include "../lib/koneksi.php";
include "../lib/class_paging.php";
if (empty($_SESSION['user'])){
  include "login.php";
}
else {

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/screen.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
		<link rel="shortcut icon" type="image/x-icon" href="../css/images/logo2.png" />
	     <script src="js/jquery.js"></script>
		<script src="js/jconfirmaction.jquery.js"></script>
    	<script type="text/javascript">
	
	$(document).ready(function() {
		$('.ask').jConfirmAction();


	$("#isi").focus();
	$("#isi_agenda").hide();
	$(".accordion #isi_agenda:not(:first)").hide();
	$("#isi_agenda2").hide();
	$(".accordion #isi_agenda2:not(:first)").hide();
	$("#daerah").show();
	$(".accordion #daerah:not(:first)").show();
    var n=1;

	$(".accordion h3").click(function(){
	    if(n==1){		
		$("#daftar_gallery").fadeOut(500);
		n=2;
		}
		else{
		$("#daftar_gallery").fadeIn(500);
		n=1;
		}
	    $(this).next("#isi_agenda").slideToggle("slow")
		.siblings("#isi_agenda").slideUp("slow");
		$(this).toggleClass("active");
		$(this).siblings("h3").removeClass("active");
	});
    
	

	

});
</script>
	<title>Monitor Admin</title>
	</head>
	<body>
    
	   <div class="fixed">
   
       <a href="logout.php"> <img src="images/5.png"title="keluar" width="30"/> </a>
       </div>     
<!----------------------------------------------------->
			<div id="header">
               <div id="wrapper">
				<div id="logo">
					<h1><a href="#">MONITOR ADMIN</a></h1>
				</div>
               </div>
			</div>
            <div class="clr"></div>
<!----------------------------------------------------->   
	<div id="wrapper">
        <div class="content">
           <div class="span4">
        	<div class="tabbable tabs-left">
                <ul class="nav nav-tabs">
				<?php
				if ($_SESSION['leveluser']=='admin'){
				?>
				  <li <?php if (!isset($_GET['kanan'])){ echo "class='active'";}?>><a href="./" data-toggle="tab">Home</a></li>
				  <li  <?php if ($_GET['kanan']=='berita'){ echo "class='active'";}?>><a href="?kanan=berita" data-toggle="tab">Berita</a></li>
				  <li  <?php if ($_GET['kanan']=='profil'){ echo "class='active'";}?>><a href="?kanan=profil" data-toggle="tab">Profil</a></li>
                  <li <?php if ($_GET['kanan']=='gallery'){ echo "class='active'";}?>><a href="index.php?kanan=gallery" data-toggle="tab">gallery</a></li>
                  <li  <?php if ($_GET['kanan']=='slider'){ echo "class='active'";}?>><a href="?kanan=slider" data-toggle="tab">Slider</a></li>
                  <li  <?php if ($_GET['kanan']=='album'){ echo "class='active'";}?>><a href="?kanan=album" data-toggle="tab">Album</a></li>
				  <li  <?php if ($_GET['kanan']=='user'){ echo "class='active'";}?>><a href="?kanan=user" data-toggle="tab">User</a></li>
				<?php }
				else {
				?>
				   <li <?php if (!isset($_GET['kanan'])){ echo "class='active'";}?>><a href="./" data-toggle="tab">Home</a></li>
				  <li  <?php if ($_GET['kanan']=='berita'){ echo "class='active'";}?>><a href="?kanan=berita" data-toggle="tab">Berita</a></li>
				   <li  <?php if ($_GET['kanan']=='edit_profil'){ echo "class='active'";}?>><a href="?kanan=edit_profil" data-toggle="tab">edit profil</a></li>
				   <li  <?php if ($_GET['kanan']=='pembayaran'){ echo "class='active'";}?>><a href="?kanan=pembayaran" data-toggle="tab">Pembayaran</a></li>
				<?php
				}
				?>
				</ul>
			<!------------------------------------------------------------------->
			  <div class="tab-content">
                  <div class="tab-pane active" id="home">
				<?php 
				include "kanan.php";
				?>
			  </div>
			
           
                </div>
              </div>
          </div>

     <!-----------------------------end-------------------------------------->       
			</div>
<!----------------------------------------------------->
			<div id="main">
			  <div class="clr"></div>
			</div>
			<div id="footer">
			
				<p>Copyright &copy; 2012 &minus; Makalula Brand &not; <a href=".././" title="Nuansa Baru Abadi Consultant" target="blank">Website</a></p>
			</div>
	</body>
</html>
<?php
}
?>