<section id="content">
	
		<div class="container clearfix">
			
			<div class="page-header clearfix">

				<h1>Formulir</h1>
                step 1 -> step 2 -> step 3 -> <b>step 4</b>
			</div><!--/ .page-header-->
           
            
            <script src="<?php echo base_url(); ?>asset/js/peserta.js"></script>

			<div class="nine columns" >
             <?php if($sessi!='') {?>
				<h4 class="content-title">PILIHAN JURUSAN</h4>

				<form method="post" action="<?php echo base_url(); ?>daftar/input_4" id="daftar">
					<p>
						<H5>Pilihan Pertama </H5>
						<input required="" type="hidden" name="username" id="username" value="<?php echo "$sessi"; ?>" style="width:300px"/>						
						<input required="" type="hidden" name="aksi" id="aksi" value="input"/>
						<label for="name">Fakultas : <span class="required">(required)</span></label>
						<select required=""  id="fak1" name="fak1" style="width:300px">
						<option value='' selected>-pilih fakultas-</option>
						  <?php
						  foreach ($fakultas->result() as $fak ) {
						  	echo "<option value='".$fak->kode_fak."'>".$fak->fakultas."</option>";
						  }
						  ?>
						</select><br><br>
						<label for="name">Jurusan : <span class="required">(required)</span></label>
						<select required="" id="pil_1" name="pil_1" style="width:300px">
						<option value='' selected>-pilih jurusan-</option>
						 
						</select>						
					</p>
					 
					<p>
						<H5>Pilihan Ke dua </H5>
						
						<label for="name">Fakultas : <span class="required">(required)</span></label>
						<select required="" id="fak2" name="fak2" style="width:300px">
						<option value='' selected>-pilih fakultas-</option>
						  <?php
						  foreach ($fakultas->result() as $fak ) {
						  	echo "<option value='".$fak->kode_fak."'>".$fak->fakultas."</option>";
						  }
						  ?>
						</select><br><br>
						<label for="name">Jurusan : <span class="required">(required)</span></label>
						<select required="" id="pil_2" name="pil_2" style="width:300px">
						<option value='' selected>-pilih jurusan-</option>
						  
						</select>						
					</p>
					
				   
					
				    <input type="hidden" id="root" value="<?php echo base_url(); ?>"/>
				    <p class="form-submit">
						<button class="button default" type="submit" id="submit">Submit</button>
					</p>

				</form><!--/ .contact-form-->	
				<?php }
				else {
					?>
					<h4 class="content-title">anda belum login</h4>

				<form method="post">
					

				</form><!--/ .contact-form-->	
					<?php
				}
				?>
                    <p class="error" style="display:none">
		            Login Gagal
				    <a class="alert-close" href="#"></a></p>
				    <p class="success" style="display:none;position:relative;top:-10px">
				        Login Sukses
				    <a class="alert-close" href="#"></a></p>
			</div><!--/ .columns-->
			
			<div class="three columns">&nbsp;</div>

			<div class="four columns">

				<h4 class="content-title">Main Office</h4>

				<p>
					<b>Address:</b> Jl. AH Nasution No. 105, Bandung<br>
					<b>Phone:</b> 022-7800525<br>
					<b>FAX:</b> 022-7803936<br>
					<b>Email:</b> contact.uin@uinsgd.ac.id<br>
					
				</p>

			</div><!--/ .columns-->

		</div><!--/ .container-->
	 
	 </section><!--/ #content-->
    
	