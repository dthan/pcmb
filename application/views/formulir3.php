<section id="content">
	
		<div class="container clearfix">
			
			<div class="page-header clearfix">

				<h1>Formulir</h1>
                step 1 -> step 2 -> <b>step 3</b> -> step 4
			</div><!--/ .page-header-->
           
            
            <script src="<?php echo base_url(); ?>asset/js/peserta.js"></script>

			<div class="nine columns" >
             <?php if($sessi!='') {?>
				<h4 class="content-title">DATA ORANG TUA</h4>

				<form method="post" action="<?php echo base_url(); ?>daftar/input_3" id="daftar">
					<p>
						<label for="name">nama ayah : <span class="required">(required)</span></label><br>
						<input required="" type="hidden" name="username" id="username" value="<?php echo "$sessi"; ?>" style="width:300px"/>						
						<input required="" type="hidden" name="aksi" id="aksi" value="input"/>
						<input required="" type="text" name="ayah" id="ayah" style="width:300px"/>						
					</p>
					 <p>
						<label for="name">nama ibu : <span class="required">(required)</span></label><br>
						<input required="" type="text" name="ibu" id="ibu" style="width:300px"/>											
					</p>
					 <p>
						<label for="prov">Provinsi: <span class="required">(required)</span></label><br>
						<select id="provinsi_ortu" name="provinsi_ortu" style="width:300px">
						<option value='0' selected>-pilih provinsi-</option>
						  <?php
						  foreach ($prov->result() as $pr ) {
						  	echo "<option value='".$pr->id_propinsi."'>".$pr->nama_propinsi."</option>";
						  }
						  ?>
						</select>					
				    </p>
				     <p>
						<label for="kota">Kota/Kabupaten: <span class="required">(required)</span></label><br>
						<select id="kota_ortu" name="kota_ortu" style="width:300px">
						    <option value="0"></option>
						 </select>					
				    </p>
					<p>
						<label for="name">Alamat Orang tua : <span class="required">(required)</span></label><br>
						<textarea name="alamat_ortu" id="alamat_ortu" style="width:300px"></textarea> 					
					</p>
					<p>
						<label for="program">Pendidikan ayah : <span class="required">(required)</span></label><br>
						<select name="pend_ayah" style="width:300px">
						  <?php
						  foreach ($pendidikan->result() as $pend) {
						  	echo "<option value='".$pend->idpendidikan."'>".$pend->pendidikan."</option>";
						  }
						  ?>
						</select>					
				    </p>
				    <p>
						<label for="program">Pendidikan ibu : <span class="required">(required)</span></label><br>
						<select name="pend_ibu" style="width:300px">
						  <?php
						  foreach ($pendidikan->result() as $pend) {
						  	echo "<option value='".$pend->idpendidikan."'>".$pend->pendidikan."</option>";
						  }
						  ?>
						</select>					
				    </p>
				    <p>
						<label for="program">Pekerjaan ayah : <span class="required">(required)</span></label><br>
						<select name="pekerjaan_ayah" style="width:300px">
						  <?php
						  foreach ($pekerjaan->result() as $p) {
						  	echo "<option value='".$p->idpekerjaan."'>".$p->pekerjaan."</option>";
						  }
						  ?>
						</select>					
				    </p>
				      <p>
						<label for="program">Pekerjaan ibu : <span class="required">(required)</span></label><br>
						<select name="pekerjaan_ibu" style="width:300px">
						  <?php
						  foreach ($pekerjaan->result() as $p) {
						  	echo "<option value='".$p->idpekerjaan."'>".$p->pekerjaan."</option>";
						  }
						  ?>
						</select>					
				    </p>
				      <p>
						<label for="program">Penghasilan Orang tua : <span class="required">(required)</span></label><br>
						<select name="penghasilan_ortu" style="width:300px">
						  <?php
						  foreach ($penghasilan->result() as $p) {
						  	echo "<option value='".$p->idpenghasilan."'>".$p->penghasilan."</option>";
						  }
						  ?>
						</select>					
				    </p>
				   
				      <p>
						<label for="telp-ayah">No Telp Ayah: <span class="required">(required)</span></label><br>
						<input required="" type="text" name="telp_ayah" id="telp_ayah" style="width:300px"/>									
				    </p>
				    <p>
						<label for="telp-ibu">No Telp Ibu: <span class="required">(required)</span></label><br>
						<input required="" type="text" name="telp_ibu" id="telp_ibu" style="width:300px"/>									
				    </p>
				       <p>
						<label for="kode_pos">Kode Pos Orang tua: </label><br>
						<input  type="text" name="kode_post_ortu" id="kode_post_ortu" style="width:300px"/>									
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
    
	