<form method="post" action="<?php echo base_url(); ?>daftar/input_1" id="daftar" enctype= "multipart/form-data">
					<p>
						<label for="name">nama lengkap : <span class="required">(required)</span></label><br>
						<input required="" type="hidden" name="no_pes" id="no_pes" value="<?php echo "$sessi"; ?>" style="width:300px"/>
						<input required="" type="text" name="nama" id="nama" style="width:300px"/>						
					</p>
					 <p>
						<label for="name">Tempat Lahir : <span class="required">(required)</span></label><br>
						<input required="" type="text" name="tempat" id="tempat" style="width:300px"/>						
					</p>
					<p>
						<label for="name">Tanggal lahir : <span class="required">(required)</span></label><br>
						<input required="" type="text" name="ttl" id="ttl" style="width:300px"/>						
					</p>
					<p>
						<label for="jk">jenis kelamin: <span class="required">(required)</span></label><br>
						<select name="jk" style="width:300px">
						  <option value="L">laki-laki</option>
						  <option value="P">Perempuan</option>
						</select>					
				    </p>
				    <p>
						<label for="wn">warga Negara: <span class="required">(required)</span></label><br>
						<select name="warga" style="width:300px">
						  <option value="WNI">WNI</option>
						  <option value="WNA">WNA</option>
						</select>					
				    </p>
				       <p>
						<label for="agama">Agama: <span class="required">(required)</span></label><br>
						<select id="agama" name="agama" style="width:300px">
						  <?php
						  foreach ($agama->result() as $agm ) {
						  	echo "<option value='".$agm->id_agama."'>".$agm->nm_agama."</option>";
						  }
						  ?>
						</select>					
				    </p>
				   
					 <p>
						<label for="prov">Provinsi: <span class="required">(required)</span></label><br>
						<select id="provinsi" name="provinsi" style="width:300px">
						  <?php
						  foreach ($prov->result() as $pr ) {
						  	echo "<option value='".$pr->id_propinsi."'>".$pr->nama_propinsi."</option>";
						  }
						  ?>
						</select>					
				    </p>
				     <p>
						<label for="kota">Kota/Kabupaten: <span class="required">(required)</span></label><br>
						<select id="kota" name="kota" style="width:300px">
						    <option value="0"></option>
						 </select>					
				    </p>
				     <p>
						<label for="alamat">Alamat : <span class="required">(required)</span></label><br>
						<textarea name="alamat" id="alamat" style="width:300px"></textarea> 				
					</p>
					<p>
						<label for="foto">Photo : <span class="required">(required)</span></label><br>
						<input type="file" name="photo" size="20" />				
					</p>
				    <input type="hidden" id="root" value="<?php echo base_url(); ?>"/>
				    <p class="form-submit">
						<button class="button default" type="submit" id="submit">Submit</button>
					</p>

				</form><!--/ .contact-form-->	