<section id="content">
	
		<div class="container clearfix">
			
			<div class="page-header clearfix">

				<h1>Pendaftaran</h1>

			</div><!--/ .page-header-->
           
            <script src="<?php echo base_url(); ?>asset/js/login.js"></script>
    
			<div class="nine columns" >

          
				<h4 class="content-title">Silahkan masukan username dan password anda</h4>

				<form method="post" action="<?php echo base_url(); ?>daftar/login" id="daftar">
					<p>
						<label for="name">Username : <span class="required">(required)</span></label><br>
						<input required="" type="text" name="username" id="username" style="width:300px"/>						
					</p>
					<p>
						<label for="email">Password: <span class="required">(required)</span></label><br>
						<input required="" type="password" name="password" id="password" style="width:300px" />						
				    </p>
				    <p class="form-submit">
						<button class="button default" type="submit" id="submit">Submit</button>
					</p>

				</form><!--/ .contact-form-->	
                    <p class="error2" style="display:none;position:fixed;bottom:10px;right:11px;z-index:10000;padding-right:30px">
		            Login Gagal/username dan password tidak cocok
				    <a class="alert-close" href="#"></a></p>
				    <p class="success" style="display:none;position:fixed;bottom:10px;right:11px;z-index:10000;padding-right:30px">
				        Login Sukses
				    <a class="alert-close" href="#"></a></p>
			</div><!--/ .columns-->
			
			<div class="three columns">&nbsp;</div>

			<div class="four columns">

							<aside id="sidebar" class="four columns">
			
			<br/><br/><br/>

					<div class="widget widget_popular_posts">

					<h3 class="widget-title">Headline post</h3>
					
					<ul class="clearfix">
					    <?php
					    foreach ($headline->result() as $h) {
					    	 $deskripsi = strip_tags($h->isi); // membuat paragraf pada isi berita dan mengabaikan tag html
			                 $isi = substr($deskripsi,0,80); // ambil sebanyak 200 karakter
			                 $isi = substr($deskripsi,0,strrpos($isi," ")); // potong per spasi kalimat
					    	echo "
							    	<li> 		
								
									<div class='post-holder'>
										<a href='".base_url()."berita/detail/".$h->judul_seo."'><h6>".$h->judul."</h6></a>
										".$isi."
										<span>June 3, 2013</span>
									</div><!--/ .post-holder-->
								    </li>
					    	     ";
					    }
					    ?>
	
						
						
					
					</ul>

				</div><!--/ .widget-->

			
			
			</aside><!--/ #sidebar-->

			</div><!--/ .columns-->

		</div><!--/ .container-->
	 
	 </section><!--/ #content-->
    
	