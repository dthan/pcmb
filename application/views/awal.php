<section id="content">
    
		<div class="container">
					
			<h2 class="slogan">
				JADIKAN PROSES PENERIMAAN CALON MAHASISWA UIN SUNAN GUNUNG DJATI BANDUNG YANG BERSIH
			</h2>
                           
			<div class="detail-holder clearfix">
				
				<img src="">
			</div><!--/ .detail-holder-->

			<div class="divider-solid"></div>
			
			<div class="jcarousel-container">
				
				<h4 class="content-title">Berita Headline</h4>
				
				<ul data-scroll-count="1" data-auto="7" class="projects-carousel clearfix">
				<?php
				foreach ($headline->result() as $h) {
					echo "
                          <li class='four columns'>
						   <div class='preloader'>
						 	<a href='".base_url()."foto_berita/";
						 	if($h->gambar!=''){
						 		echo $h->gambar;
						 	}
						 	else{
						 		echo "iconberita.png";
						 	}
						    echo "' class='bwWrapper single-image plus-icon' rel='jcarousel'>
						        <img src='".base_url()."foto_berita/";
                               if($h->gambar!=''){
						 		echo $h->gambar;
						 	}
						 	else{
						 		echo "iconberita.png";
						 	}
							echo "' alt='' width='180' />
							</a>				
							</div><!--/ .preloader-->
							<a href='./berita/detail/".$h->judul_seo."' class='project-meta'>
								<h6 class='title'>".$h->judul."</h6>
								
							</a>
					       </li>
					     ";
				}
				?>
					
					
				</ul><!--/ .projects-carousel-->
				
			</div><!--/ .jcarousel-container-->
			
			<div class="two-thirds column">
				
				<h4 class="content-title">Kenapa Harus UIN Bandung</h4>
				
				<div class="content-tabs">

					<ul class="tabs-nav clearfix">
						<li><a href="#tab1">Islam</a></li>
						<li><a href="#tab2">Negeri</a></li>
						<li><a href="#tab3">Murah</a></li>
					</ul><!--/ .tabs-nav-->

					<div class="tabs-container">

						<div class="tab-content" id="tab1">
							
							<h3>Univrsitas Islam</h3>

							<p>
								Sebagai Universitas islam tentunya UIN Bandung mempunyai asas yang menjunjung tinggi
								nilai keislaman, dengan kata lain berasaskan pada alquran dan hadist, serta menjunjung
								tinggi nilai akademik
							</p>

						</div><!--/ .tab-content -->

						<div class="tab-content" id="tab2">
							
							<h3>Universitas Negeri</h3>

							<p>
								Sebagai salah satu Universitas negeri, khususnya di bawah Departemen Agama RI
								pastinya UIN Bandung mempunyai keseteraan dengan UIN lainya se Indonesia
							</p>

						</div><!--/ .tab-content -->

						<div class="tab-content" id="tab3">

							<h3>Murah tapi tidak murahan</h3>
							
							<p>
								Karena UIN Bandung adalah Universitas Negeri pastinya disubsidi oleh pemerintah
								sehingga biaya kuliah sangat terjangkau
							</p>

						</div><!--/ .tab-content -->

					</div><!-- .tabs-container -->	

				</div><!--/ .content tabs -->
				
			</div><!--/ .columns-->
			
		
			
			<div class="clear"></div>
			<div class="divider-solid"></div>
			
			
					
		</div><!--/ .container-->
	 
	</section><!--/ #content-->
    