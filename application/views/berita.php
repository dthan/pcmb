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
						".$isi."<br/>
						<a class='button default small' href='blog-single.html'>Learn More</a>
					</div><!--/ .entry-body-->
				</article><!--/ .entry-->
				";
			}
			?>		
				
				
				<div class="wp-pagenavi clearfix">
				   <?php
				    echo $halaman;
				    ?>
			<!-- 		<a href="blog-single.html" class="prev page-numbers"></a>
					<span class="page-numbers current">1</span>
					<a href="blog-single.html" class="page-numbers">2</a>
					<a href="blog-single.html" class="page-numbers">3</a>
					<a href="blog-single.html" class="next page-numbers"></a> -->
				</div><!--/ .wp-pagenavi-->
				 
			</section><!--/ #main-->
			
				 

			</section><!--/ #main-->

			<aside id="sidebar" class="four columns">
			
			<br/><br/><br/>

				<div class="widget widget_popular_posts">

					<h3 class="widget-title">Popular Posts</h3>
					
					<ul class="clearfix">
	
						<li> 		
							<div class="preloader">
								<a href="blog-single.html" class="bwWrapper single-image">
									<img alt="" src="images/temp/popular-1.jpg">
								</a>	
							</div>
							<div class="post-holder">
								<a href="blog-single.html"><h6>Kuota jurusan IF dikurangi</h6></a>
								<p>
									karena banyaknya pendaftar ke IF, pihak jurusan mengurang kuota								
								</p>
								<span>June 3, 2013</span>
							</div><!--/ .post-holder-->
						</li>
						<li> 		
							<div class="preloader">
								<a href="blog-single.html" class="bwWrapper single-image">
									<img alt="" src="images/temp/popular-2.jpg">
								</a>	
							</div>
							<div class="post-holder">
								<a href="blog-single.html"><h6>IF jurusan terfavorit</h6></a>
								<p>
									Jurusan teknik informatika menjadi jurusan terfavorit						
								</p>
								<span>June 3, 2013</span>
							</div><!--/ .post-holder-->
						</li>
						
					
					</ul>

				</div><!--/ .widget-->

			
			
			</aside><!--/ #sidebar-->

		 </div><!--/ .container-->
	 
	</section><!--/ #content-->