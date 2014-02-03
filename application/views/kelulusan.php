<script src="<?php echo base_url(); ?>asset/js/kelulusan.js"></script>
<section id="content" class="sbr">
    
		<div class="container clearfix">
			
		

			<section id="main" class="twelve columns">
				
				<article class="entry clearfix">

					<div class="page-header clearfix">

				      <h1>CEK KELULUSAN</h1>

			         </div><!--/ .page-header-->

					
				 <section id="respond">
					<form method="post" action="http://html.webtemplatemasters.com/" class="comments-form" id="kelulusan">
							<h4>masukan no peserta</h4>	
						<p class="message-form-name">
							<input type="hidden" value="<?php echo base_url(); ?>" id="root">
						    <input id="no_pes" type="text" name="no_pes" required=""></input>
					  	</p>		
						<p class="form-submit">
							<button class="button default" type="submit" id="submit">cek kelulusan</button>
							<img id="loading" src="<?php echo base_url(); ?>asset/images/loading.gif" style="display:none;position:relative;top:10px" />
						</p>
									
					</form><!--/ .comments-form-->
					<div id="info_kelulusan" style="display:none">
					
				    </div>

				 </section><!--/ #respond-->

			</section><!--/ #main-->

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

		 </div><!--/ .container-->
	 
	</section><!--/ #content-->