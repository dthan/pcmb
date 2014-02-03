<section id="content" class="sbr">
    
		<div class="container clearfix">
			
		

			<section id="main" class="twelve columns">
				
							<div class="page-header clearfix">

				<h1>BERITA</h1>

			</div><!--/ .page-header-->

			<section id="main" class="twelve columns">	
			<?php
			foreach ($berita->result() as $b) {
				 $deskripsi = strip_tags($b->isi); // membuat paragraf pada isi berita dan mengabaikan tag html
                 $isi = substr($deskripsi,0,235); // ambil sebanyak 200 karakter
                 $isi = substr($deskripsi,0,strrpos($isi," ")); // potong per spasi kalimat
				echo "
				<article class='entry clearfix'>					
					<div class='entry-title'>
						<h2 class='title'><a href='./berita/detail/".$b->judul_seo."'>".$b->judul."</a></h2>
					</div><!--/ .entry-title-->
					<div class='entry-meta'>
						<span class='date'><a href='#'>".$this->tanggal->tgl_indo($b->tanggal_posting)."</a></span>
						<span class='author'><a href='#'>By ".$b->penulis."</a></span>
					</div><!--/ .entry-meta-->
					<div class='entry-body'>
						".$b->isi."<br/>
					
					</div><!--/ .entry-body-->
				</article><!--/ .entry-->
				";
			}
			?>		
				
				
		
				 
			</section><!--/ #main-->
			
				 

			</section><!--/ #main-->

			<aside id="sidebar" class="four columns">
			
			<br/><br/><br/>

				<div class="widget widget_popular_posts">

					<h3 class="widget-title">Headline post</h3>
					
					<ul class="clearfix">
					    <?php
					    foreach ($headline->result() as $h) {
					    	 $deskripsi = strip_tags($h->isi); // membuat paragraf pada isi berita dan mengabaikan tag html
			                 $isi = substr($deskripsi,0,135); // ambil sebanyak 200 karakter
			                 $isi = substr($deskripsi,0,strrpos($isi," ")); // potong per spasi kalimat
					    	echo "
							    	<li> 		
								
									<div class='post-holder'>
										<a href='".$h->judul_seo."'><h6>".$h->judul."</h6></a>
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