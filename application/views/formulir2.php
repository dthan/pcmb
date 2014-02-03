<section id="content">
	
		<div class="container clearfix">
			
			<div class="page-header clearfix">

				<h1>Formulir</h1>
                step 1 -> <b>step 2</b> -> step 3 -> step 4
			</div><!--/ .page-header-->
           
            
            <script src="<?php echo base_url(); ?>asset/js/peserta.js"></script>

			<div class="nine columns" >
             <?php if($sessi!='') {?>
				<h4 class="content-title">DATA SEKOLAH</h4>

				<form method="post" action="<?php echo base_url(); ?>daftar/input_2" id="daftar">
					<p>
						<label for="name">nama sekolah : <span class="required">(required)</span></label><br>
						<input required="" type="hidden" name="username" id="username" value="<?php echo "$sessi"; ?>"/>						
						<input required="" type="hidden" name="aksi" id="aksi" value="input"/>
						<input required="" type="text" name="nama_sekolah" id="nama_sekolah" style="width:300px"/>						
					</p>
					 <p>
						<label for="name">Jenis sekolah : <span class="required">(required)</span></label><br>
						<select required="" id="jenis_sekolah" name="jenis_sekolah" style="width:300px">
						<option value="">-pilih jenis sekolah-</option>
						  <?php
						  foreach ($sekolah->result() as $skl) {
						  	echo "<option value='".$skl->id_jenis_sekolah."'>".$skl->jenis_sekolah."</option>";
						  }
						  ?>
						</select>							
					</p>
					<p>
						<label for="name">Alamat Sekolah : <span class="required">(required)</span></label><br>
						<textarea name="alamat_sekolah" id="alamat_sekolah" style="width:300px"></textarea> 					
					</p>
					<p>
						<label for="program">Program : <span class="required">(required)</span></label><br>
						<select name="program" style="width:300px">
						  <?php
						  foreach ($program->result() as $pro) {
						  	echo "<option value='".$pro->id_program."'>".$pro->nama_program."</option>";
						  }
						  ?>
						</select>					
				    </p>
				    <p>
						<label for="wn">Tahun Lulus: <span class="required">(required)</span></label><br>
						<select name="tahun_lulus" style="width:300px">
						  <?php
						  for ($th=2013; $th>2005; $th--){
                              echo "<option value='$th'>$th<option>";
						  }
						  ?>
						</select>					
				    </p>
				       <p>
						<label for="agama">nilai_ijazah: <span class="required">(required)</span></label><br>
						<input required="" type="text" name="nilai_ijazah" id="nilai_ijazah" style="width:300px"/>									
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
    
	