
<body class="boxed normal pattern-6 color-1">
	
<div id="wrapper">

  <header id="header">
        
        <div class="container">
			
			<div class="eight columns">
				
				<div id="logo" style="width:500px">
					<img style="float:left;position:relative;top:-7px" src="<?php echo base_url(); ?>asset/images/logo_uin.png" width="30" /><h5>UIN SUNAN GUNUNG DJATI BANDUNG</h5>
				</div><!--/ #logo-->
				
			</div><!--/ .columns-->
			
			<div class="eight columns">
				
				<div class="widget widget_contacts">

					<div class="vcard clearfix">

						<p class="top-phone">Call Us : <span>022-7800525</span></p>

					</div><!--/ .vcard-->
		
					<div class="clear"></div>
					
					<ul class="social-icons">
						<li class="twitter"><a href="#">Twitter</a></li>
						<li class="facebook"><a href="#">Facebook</a></li>
						<li class="dribble"><a href="#">Dribble</a></li>
						<li class="vimeo"><a href="#">Vimeo</a></li>
						<li class="youtube"><a href="#">Youtube</a></li>
						<li class="rss"><a href="#">Rss</a></li>
					</ul><!--/ .social-icons -->	
		
				</div>
					
			</div><!--/ .columns-->
			
			<div class="clear"></div>
			
			<div class="sixteen columns">
				
				<div class="menu-container clearfix">

					<nav id="navigation" class="navigation">

						<div class="menu">
							<ul>
								<li <?php if($aktif=="home") echo "class='current-menu-item'"; ?> ><a href="<?php echo base_url(); ?>">Home</a></li>								
								<li <?php if($aktif=="berita") echo "class='current-menu-item'"; ?> ><a href="<?php echo base_url(); ?>berita">Berita</a></li>								
								<li <?php if($aktif=="kelulusan") echo "class='current-menu-item'"; ?> ><a href="<?php echo base_url(); ?>kelulusan">Cek Kelulusan</a></li>								
								<li <?php if($aktif=="pendaftaran") echo "class='current-menu-item'"; ?>><a href="
								<?php 
   								if($cek_daftar==true){
                                	echo base_url()."daftar/formulir/".$sessi; 
   								}
                                else {
                                	echo base_url()."daftar";
                                }
								
								?>">
                                <?php
                                if($sessi!=''){
 									if($cek_daftar==true)
                                	echo "Profil";
                                else 
                                	echo "formulir";
                                }
                                else{
                                    echo "login";
                                }
                                
                                ?>
								</a></li>
                                <?php if((isset($sessi)) && ($sessi!=''))
 									echo "<li><a href='".base_url()."daftar/logout/".$sessi."'>logout</a></li>";
                                ?>
								
							</ul>
						</div>

					</nav><!--/ .navigation-->
					
					<div class="search-wrapper">

						<form method="post" action="#">

							<p>
								<input name="s" id="s" type="text">
								<button type="submit" class="submit-search">Search</button>
							</p>

						</form>

					</div><!--/ .search-wrapper--> 		

				</div><!--/ .menu-container-->	
				
			</div><!--/ .columns-->
			
		</div><!--/ .container--> 
	  
    </header><!--/ #header-->
