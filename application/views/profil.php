<section id="content">
	
		<div class="container clearfix">
			
			<div class="page-header clearfix">
			
				<h1>
				 <?php 
				  foreach ($data_diri->result() as $dt) {
                	echo "<img src='".base_url()."upload/foto_pendaftar/".$dt->foto."' width='150'/>  ".strtoupper($dt->nama)."(".$dt->no_pes.")";
                }
                ?></h1>

                <a style="float:right" href="<?php echo base_url()."daftar/cetak_kartu/$sessi"; ?>" target="blank"><img style="position:relative;top:10px" width="30" src="<?php echo base_url()."asset/images/printer.png"; ?>"/><b>Download Kartu Ujian</b></a>
           	</div><!--/ .page-header-->
           
            
            <script src="<?php echo base_url(); ?>asset/js/peserta.js"></script>
              
			<div class="nine columns" style="position:relative;top:-76px;left:-10px" >

             <?php if($sessi!='') {
             	
             	?>
				
              <div class="two-thirds column">
				<div id="data"  style="display:none">
				 <form method="post" action="<?php echo base_url(); ?>daftar/input_1" id="daftar" enctype= "multipart/form-data">
					<p>
						<label for="name">nama lengkap : <span class="required">(required)</span></label><br>
						<input required="" type="hidden" name="no_pes" id="no_pes" value="<?php echo "$sessi"; ?>" style="width:300px"/>
						<input required="" type="text" name="nama" id="nama" value="<?php echo $dt->nama; ?>" style="width:300px"/>						
					</p>
					 <p>
						<label for="name">Tempat Lahir : <span class="required">(required)</span></label><br>
						<input required="" type="text" name="tempat" id="tempat" value="<?php echo $dt->tempat_lahir; ?>" style="width:300px"/>						
					</p>
					<p>
						<label for="name">Tanggal lahir : <span class="required">(required)</span></label><br>
						<input required="" type="text" name="ttl" id="ttl" value="<?php echo $dt->tgl_lahir; ?>" style="width:300px"/>						
					</p>
					<p>
						<label for="jk">jenis kelamin: <span class="required">(required)</span></label><br>
						<select required="" name="jk" style="width:300px">
						  <option value="L" <?php if($dt->jk=='L') echo "selected" ?>>laki-laki</option>
						  <option value="P" <?php if($dt->jk=='P') echo "selected" ?>>Perempuan</option>
						</select>					
				    </p>
				    <p>
						<label for="name">No hp : <span class="required">(required)</span></label><br>
						<input required="" type="text" name="no_hp" id="no_hp" value="<?php echo $dt->no_hp; ?>" style="width:300px"/>						
					</p>
				    <p>
						<label for="wn">warga Negara: <span class="required">(required)</span></label><br>
						<select required="" name="warga" style="width:300px">
						  <option value="WNI" <?php if($dt->warga=='WNI') echo "selected" ?>>WNI</option>
						  <option value="WNA" <?php if($dt->warga=='WNA') echo "selected" ?>>WNA</option>
						</select>					
				    </p>
				       <p>
						<label for="agama">Agama: <span class="required">(required)</span></label><br>
						<select required="" id="agama" name="agama" style="width:300px">
						  <?php
						  foreach ($agama->result() as $agm ) {
						  	if($dt->id_agama==$agm->id_agama){
						  	  echo "<option value='".$agm->id_agama." ' selected>".$agm->nm_agama."</option>";
						    }
						    else {
                              echo "<option value='".$agm->id_agama." '>".$agm->nm_agama."</option>";
						    } 
						  }
						  ?>
						</select>					
				    </p>
				   
					 <p>
						<label for="prov">Provinsi: <span class="required">(required)</span></label><br>
						<select required="" id="provinsi" name="provinsi" style="width:300px">
						  <?php
						  foreach ($prov->result() as $pr1 ) {
						  	if($dt->id_propinsi==$pr1->id_propinsi){
 							  echo "<option value='".$pr1->id_propinsi."' selected>".$pr1->nama_propinsi."</option>";
						  	}
						  	else {
						  	  echo "<option value='".$pr1->id_propinsi."'>".$pr1->nama_propinsi."</option>";
						    }
						  }
						  ?>
						</select>					
				    </p>
				     <p>
						<label for="kota">Kota/Kabupaten: <span class="required">(required)</span></label><br>
						<select required="" id="kota" name="kota" style="width:300px">
						   <?php
						  foreach ($kab->result() as $kb ) {
						  	if($dt->id_kota==$kb->id_kota){
 							  echo "<option value='".$kb->id_kota."' selected>".$kb->nama_kota."</option>";
						  	}
						  	else {
						  	  echo "<option value='".$kb->id_kota."'>".$kb->nama_kota."</option>";
						    }
						  }
						  ?>
						 </select>					
				    </p>
				     <p>
						<label for="alamat">Alamat : <span class="required">(required)</span></label><br>
						<textarea required="" name="alamat" id="alamat"  style="width:300px"><?php echo $dt->alamat; ?></textarea> 				
					</p>
					<p>
						<label for="foto">Photo : <span class="required">(required)</span></label><br>
						<input  type="file" name="photo" size="20" />	 
						<img src="<?php echo base_url()."upload/foto_pendaftar/".$dt->foto; ?> " width="80"/>
						<br> 
                         <i style="color:red">max ukuran foto 500 kb</i><br>             
                           <i style="color:red">gambar harus tipe jpeg atau png</i> 			
					</p>
				    <input type="hidden" id="root" value="<?php echo base_url(); ?>"/>
				    <p class="form-submit">
						<button class="button default" type="submit" id="submit">Submit</button>
					</p>

				</form><!--/ .contact-form-->	
				</div>
                <div id="data2"  style="display:none">
				 <form method="post" action="<?php echo base_url(); ?>daftar/input_2" id="daftar">
					<p>
						<label for="name">Provinsi sekolah : <span class="required">(required)</span></label><br>
						<input required="" type="hidden" name="username" id="username" value="<?php echo "$sessi"; ?>"/>						
						<input required="" type="hidden" name="aksi" id="aksi" value="edit"/>
						
						<select required="" id="provinsi_sekolah" name="provinsi_sekolah" style="width:300px">
						  <?php

						  foreach ($prov->result() as $pr2 ) {
						  	if($pr2->id_propinsi==$prov_sekolah){
 							  echo "<option value='".$pr2->id_propinsi."' selected>".$pr2->nama_propinsi."</option>";
						  	}
						  	else {
						  	  echo "<option value='".$pr2->id_propinsi."'>".$pr2->nama_propinsi."</option>";
						    }
						  }
						  ?>
						</select>			
					</p>
					 <p>
						<label for="name">kota sekolah : <span class="required">(required)</span></label><br>
						
						<select required="" id="kota_sekolah" name="kota_sekolah" style="width:300px">
						  <option value="0">-pilih kota-</option>
						  <?php

						  foreach ($kota_sek->result() as $kota2 ) {
						  	if($kota2->id_kota==$kota_sekolah){
 							  echo "<option value='".$kota2->id_kota."' selected>".$kota2->nama_kota."</option>";
						  	}
						  	else {
						  	  echo "<option value='".$kota2->id_kota."'>".$kota2->nama_kota."</option>";
						    }
						  }
						  ?>
						</select>						
					</p>
					<p>
						<label for="name">nama sekolah : <span class="required">(required)</span></label><br>
						
						<select required="" id="nama_sekolah" name="nama_sekolah" style="width:300px">
						  <option value="0">-pilih kota-</option>
						  <?php
						  foreach ($sekolah2->result() as $skl2) {
						  	if($skl2->kode_sekolah==$dt->kode_sekolah){
 								echo "<option value='".$skl2->kode_sekolah."' selected>".$skl2->nama_smta."</option>";
						  	}
						  	else {
						  	  echo "<option value='".$skl2->kode_sekolah."'>".$skl2->nama_smta."</option>";	
						  	}
						  	
						  }
						  ?>
						</select>						
					</p>
					 <p>
						<label for="name">Jenis sekolah : <span class="required">(required)</span></label><br>
						<select id="jenis_sekolah" name="jenis_sekolah" style="width:300px">
						  <?php
						  foreach ($sekolah->result() as $skl) {
						  	if($skl->id_jenis_sekolah==$dt->jenis_sekolah){
 								echo "<option value='".$skl->id_jenis_sekolah."' selected>".$skl->jenis_sekolah."</option>";
						  	}
						  	else {
						  	  echo "<option value='".$skl->id_jenis_sekolah."'>".$skl->jenis_sekolah."</option>";	
						  	}
						  	
						  }
						  ?>
						</select>							
					</p>
					<p>
						<label for="name">Alamat Sekolah : <span class="required">(required)</span></label><br>
						<textarea name="alamat_sekolah" id="alamat_sekolah" style="width:300px"><?php echo $dt->alamat_sekolah; ?></textarea> 					
					</p>
					<p>
						<label for="program">Program : <span class="required">(required)</span></label><br>
						<select name="program" style="width:300px">
						  <?php
						  foreach ($program->result() as $pro) {
						  if($dt->nama_program==$pro->id_program){
						  	echo "<option value='".$pro->id_program."' selected>".$pro->nama_program."</option>";
						  }
						  else {
						  	echo "<option value='".$pro->id_program."'>".$pro->nama_program."</option>";
						  }
						  	
						  }
						  ?>
						</select>					
				    </p>
				    <p>
						<label for="wn">Tahun Lulus: <span class="required">(required)</span></label><br>
						<select name="tahun_lulus" style="width:300px">
						  <?php
						  for ($th=2013; $th>2005; $th--){
						  	if($dt->tahun_lulus==$th){
						  		echo "<option value='$th' selected>$th<option>";
						  	}
						  	else {
                              echo "<option value='$th'>$th<option>";
						  							  	}
						  }
						  ?>
						</select>					
				    </p>
				       <p>
						<label for="agama">nilai_ijazah: <span class="required">(required)</span></label><br>
						<input required="" type="text" name="nilai_ijazah" id="nilai_ijazah" value="<?php echo $dt->nilai_ijazah; ?>" style="width:300px"/>									
				    </p>
				   
					
				    <input type="hidden" id="root" value="<?php echo base_url(); ?>"/>
				    <p class="form-submit">
						<button class="button default" type="submit" id="submit">Submit</button>
					</p>

				</form><!--/ .contact-form-->	
				</div>

				<div id="data3"  style="display:none">
				<form method="post" action="<?php echo base_url(); ?>daftar/input_3" id="daftar">
					<p>
						<label for="name">nama ayah : <span class="required">(required)</span></label><br>
						<input required="" type="hidden" name="username" id="username" value="<?php echo "$sessi"; ?>" style="width:300px"/>						
						<input required="" type="hidden" name="aksi" id="aksi" value="edit"/>
						<input required="" type="text" name="ayah" id="ayah" value="<?php echo $dt->ayah; ?>" style="width:300px"/>						
					</p>
					 <p>
						<label for="name">nama ibu : <span class="required">(required)</span></label><br>
						<input required="" type="text" name="ibu" id="ibu" value="<?php echo $dt->ibu; ?>" style="width:300px"/>											
					</p>
					 <p>
						<label for="prov">Provinsi: <?php echo $dt->provinsi_ortu; ?> <span class="required">(required)</span></label><br>
						<select id="provinsi_ortu" name="provinsi_ortu" style="width:300px">
						<option value='0' selected>-pilih provinsi-</option>
						  <?php
						  foreach ($prov->result() as $pr2 ) {
						  if($dt->provinsi_ortu==$pr2->id_propinsi){
						  	echo "<option value='".$pr2->id_propinsi."' selected>".$pr2->nama_propinsi."</option>";
						  }
						  else {
						  	echo "<option value='".$pr2->id_propinsi."'>".$pr2->nama_propinsi."</option>";
						  }
						  	
						  }
						  ?>
						</select>					
				    </p>
				     <p>
						<label for="kota">Kota/Kabupaten: <span class="required">(required)</span></label><br>
						<select id="kota_ortu" name="kota_ortu" style="width:300px">
						    <?php
						  foreach ($kab->result() as $kb ) {
						  	if($dt->id_kota==$kb->id_kota){
 							  echo "<option value='".$kb->id_kota."' selected>".$kb->nama_kota."</option>";
						  	}
						  	else {
						  	  echo "<option value='".$kb->id_kota."'>".$kb->nama_kota."</option>";
						    }
						  }
						  ?>
						 </select>					
				    </p>
					<p>
						<label for="name">Alamat Orang tua : <span class="required">(required)</span></label><br>
						<textarea name="alamat_ortu" id="alamat_ortu" style="width:300px"><?php echo $dt->alamat_ortu; ?></textarea> 					
					</p>
					<p>
						<label for="program">Pendidikan ayah : <span class="required">(required)</span></label><br>
						<select name="pend_ayah" style="width:300px">
						  <?php
						  foreach ($pendidikan->result() as $pend) {
						  if($dt->pend_ayah==$pend->idpendidikan){
							echo "<option value='".$pend->idpendidikan."' selected>".$pend->pendidikan."</option>";
						  }
						  else {
						  	echo "<option value='".$pend->idpendidikan."'>".$pend->pendidikan."</option>";
						  }
						  	
						  }
						  ?>
						</select>					
				    </p>
				    <p>
						<label for="program">Pendidikan ibu : <span class="required">(required)</span></label><br>
						<select name="pend_ibu" style="width:300px">
						  <?php
						  foreach ($pendidikan->result() as $pend) {
						  if($dt->pend_ibu==$pend->idpendidikan){
							echo "<option value='".$pend->idpendidikan."' selected>".$pend->pendidikan."</option>";
						  }
						  else {
						  	echo "<option value='".$pend->idpendidikan."'>".$pend->pendidikan."</option>";
						  }
						  	
						  }
						  ?>
						</select>					
				    </p>
				    <p>
						<label for="program">Pekerjaan ayah : <span class="required">(required)</span></label><br>
						<select name="pekerjaan_ayah" style="width:300px">
						  <?php
						  foreach ($pekerjaan->result() as $p) {
						  if($dt->pekerjaan_ayah==$p->idpekerjaan){
						  	echo "<option value='".$p->idpekerjaan."' selected>".$p->pekerjaan."</option>";
						  }
						  else {
						  	echo "<option value='".$p->idpekerjaan."'>".$p->pekerjaan."</option>";
						  }
						  	
						  }
						  ?>
						</select>					
				    </p>
				      <p>
						<label for="program">Pekerjaan ibu : <span class="required">(required)</span></label><br>
						<select name="pekerjaan_ibu" style="width:300px">
					    <?php
					 	  foreach ($pekerjaan->result() as $p) {
						  if($dt->pekerjaan_ayah==$p->idpekerjaan){
						  	echo "<option value='".$p->idpekerjaan."' selected>".$p->pekerjaan."</option>";
						  }
						  else {
						  	echo "<option value='".$p->idpekerjaan."'>".$p->pekerjaan."</option>";
						  }
						  	
						  }
						  ?>
						</select>					
				    </p>
				      <p>
						<label for="program">Penghasilan Orang tua : <span class="required">(required)</span></label><br>
						<select name="penghasilan_ortu" style="width:300px">
						  <?php
						  foreach ($penghasilan->result() as $p) {
						  	if($dt->penghasilan_ortu==$p->idpenghasilan){
						  	  echo "<option value='".$p->idpenghasilan."'selected>".$p->penghasilan."</option>";
						  	}
						  	else {
						  	  echo "<option value='".$p->idpenghasilan."'>".$p->penghasilan."</option>";	
						  	}
						  	
						  }
						  ?>
						</select>					
				    </p>
				   
				      <p>
						<label for="telp-ayah">No Telp Ayah: <span class="required">(required)</span></label><br>
						<input required="" type="text" name="telp_ayah" id="telp_ayah" value="<?php echo $dt->telp_ayah; ?>" style="width:300px"/>									
				    </p>
				    <p>
						<label for="telp-ibu">No Telp Ibu: <span class="required">(required)</span></label><br>
						<input required="" type="text" name="telp_ibu" id="telp_ibu" value="<?php echo $dt->telp_ibu; ?>" style="width:300px"/>									
				    </p>
				       <p>
						<label for="kode_pos">Kode Pos Orang tua: </label><br>
						<input  type="text" name="kode_post_ortu" id="kode_post_ortu" value="<?php echo $dt->kode_post_ortu; ?>" style="width:300px"/>									
				    </p>

				   
					
				    <input type="hidden" id="root" value="<?php echo base_url(); ?>"/>
				    <p class="form-submit">
						<button class="button default" type="submit" id="submit">Submit</button>
					</p>

				</form><!--/ .contact-form-->	
				</div>
                 
                 <div id="data4"  style="display:none">
                   <form method="post" action="<?php echo base_url(); ?>daftar/input_4" id="daftar">
					<p>
						<H5>Pilihan Pertama </H5>
						<input required="" type="hidden" name="username" id="username" value="<?php echo "$sessi"; ?>" style="width:300px"/>						
						<input required="" type="hidden" name="aksi" id="aksi" value="edit"/>
						<label for="name">Fakultas : <span class="required">(required)</span></label>
						<select required=""  id="fak1" name="fak1" style="width:300px">
						<option value='' selected>-pilih fakultas-</option>
						  <?php
						  foreach ($fakultas->result() as $fak ) {
						  	if($fak2==$fak->kode_fak){
 							  echo "<option value='".$fak->kode_fak."' selected>".$fak->fakultas."</option>";
						  	}
						  	else {
						  	  echo "<option value='".$fak->kode_fak."'>".$fak->fakultas."</option>";	
						  	}
						  	
						  }
						  ?>
						</select><br><br>
						<label for="name">Jurusan : <span class="required">(required)</span></label>
						<select required="" id="pil_1" name="pil_1" style="width:300px">
						   <?php
						     foreach ($jur->result() as $j) {
						     	if($dt->pil_1==$j->kode_jurusan){
						     		echo "<option value='".$j->kode_jurusan."' selected>".$j->nama_jurusan."</option>";
						     	}
						     	else {
						     	  echo "<option value='".$j->kode_jurusan."'>".$j->nama_jurusan."</option>";	
						     	}
						     	
						     }
						   ?>
						 
						</select>						
					</p>
					 
					<p>
						<H5>Pilihan Ke dua </H5>
						
						<label for="name">Fakultas : <span class="required">(required)</span></label>
						<select required="" id="fak2" name="fak2" style="width:300px">
						<option value='' selected>-pilih fakultas-</option>
						   <?php
						  foreach ($fakultas->result() as $fak ) {
						  	if($fak3==$fak->kode_fak){
 							  echo "<option value='".$fak->kode_fak."' selected>".$fak->fakultas."</option>";
						  	}
						  	else {
						  	  echo "<option value='".$fak->kode_fak."'>".$fak->fakultas."</option>";	
						  	}
						  	
						  }
						  ?>
						</select><br><br>
						<label for="name">Jurusan : <span class="required">(required)</span></label>
						<select required="" id="pil_2" name="pil_2" style="width:300px">
						  <?php
						     foreach ($jur2->result() as $j2) {
						     	if($dt->pil_2==$j2->kode_jurusan){
						     		echo "<option value='".$j2->kode_jurusan."' selected>".$j2->nama_jurusan."</option>";
						     	}
						     	else {
						     	  echo "<option value='".$j2->kode_jurusan."'>".$j2->nama_jurusan."</option>";	
						     	}
						     	
						     }
						   ?>
						  
						</select>						
					</p>
					
				   
					
				    <input type="hidden" id="root" value="<?php echo base_url(); ?>"/>
				    <p class="form-submit">
						<button class="button default" type="submit" id="submit">Submit</button>
					</p>

				</form><!--/ .contact-form-->
                 </div>
				
				<div class="content-tabs">

					<ul class="tabs-nav clearfix">
						<li><a href="#tab1">Data Diri</a></li>
						<li><a href="#tab2">Data Sekolah</a></li>
						<li><a href="#tab3">Data Orang Tua</a></li>
						<li><a href="#tab4">Data Pilihan Jurusan</a></li>
					</ul><!--/ .tabs-nav-->

					<div class="tabs-container">

						<div class="tab-content" id="tab1">
						   <div style="float:right">
						      <a href="#data"  class="various2"><img width="18" src="<?php echo base_url(); ?>asset/images/edit.png"/>edit</a>
						   </div>
						   
							<table>
							<tr>
							  <td>nama lengkap  </td><td>: <?php echo $dt->nama; ?></td>
							</tr>
							<tr>
							  <td>Tempat Lahir  </td><td>: <?php echo $dt->tempat_lahir; ?></td>
							</tr>
							<tr>
							  <td>Tanggal Lahir  </td><td>: <?php echo $tanggal; ?></td>
							</tr>
							<tr>
							  <td>Jenis Kelamin  </td><td>: <?php echo $dt->jk; ?></td>
							</tr>
							<tr>
							  <td>Warga Negara  </td><td>: <?php echo $dt->warga; ?></td>
							</tr>
							<tr>
							  <td>Agama  </td><td>: <?php echo $dt->nm_agama; ?></td>
							</tr>
							<tr>
							  <td>Provinsi  </td><td>: <?php echo $dt->prov; ?></td>
							</tr>
							<tr>
							  <td> Kabupaten/Kota </td><td>: <?php echo $dt->kota; ?></td>
							</tr>
							<tr>
							  <td>No hp </td><td>: <?php echo $dt->no_hp; ?></td>
							</tr>
							<tr>
							  <td>Alamat  </td><td>: <?php echo $dt->alamat; ?></td>
							</tr>
							</table>
							
												
					</div><!--/ .tab-content -->

						<div class="tab-content" id="tab2">
						<div style="float:right">
						      <a href="#data2"  class="various2"><img width="18" src="<?php echo base_url(); ?>asset/images/edit.png"/>edit</a>

						   </div>
						<table>
							<tr>
							  <td>Nama Sekolah  </td><td>: <?php echo $dt->nama_smta; ?></td>
							</tr>
							<tr>
							  <td>Jenis Sekolah  </td><td>: <?php echo $dt->jenis_sekolah; ?></td>
							</tr>
							<tr>
							  <td>Alamat Sekolah  </td><td>: <?php echo $dt->alamat_sekolah; ?></td>
							</tr>
							<tr>
							  <td>Program  </td><td>: <?php echo $dt->nama_program; ?></td>
							</tr>
							<tr>
							  <td>Tahun Lulus  </td><td>: <?php echo $dt->tahun_lulus; ?></td>
							</tr>
							<tr>
							  <td>Nilai Ijazah  </td><td>: <?php echo $dt->nilai_ijazah; ?></td>
							</tr>
							</table>

						</div><!--/ .tab-content -->

						<div class="tab-content" id="tab3">
						<div style="float:right">
						      <a href="#data3"  class="various2"><img width="18" src="<?php echo base_url(); ?>asset/images/edit.png"/>edit</a>
						   </div>
						<table>
							<tr>
							  <td>Nama Ayah  </td><td>: <?php echo $dt->ayah; ?></td>
							</tr>
							<tr>
							  <td>Nama Ibu  </td><td>: <?php echo $dt->ibu; ?></td>
							</tr>
							<tr>
							  <td>Provinsi   </td><td>: <?php echo $dt->prov_ortu; ?></td>
							</tr>
							<tr>
							  <td>Kabupaten/Kota </td><td>: <?php echo $dt->kota_ortua; ?></td>
							</tr>
							<tr>
							  <td>Alamat </td><td>: <?php echo $dt->alamat_ortu; ?></td>
							</tr>
							<tr>
							  <td>Pendidikan Ayah  </td><td>: <?php echo $dt->pendidikan_ayah; ?></td>
							</tr>
							<tr>
							  <td>Pendidikan Ibu  </td><td>: <?php echo $dt->pendidikan_ibu; ?></td>
							</tr>
							<tr>
								<td>telp ayah  </td><td>: <?php echo $dt->telp_ayah; ?></td>
							</tr>
							<tr>
								<td>telp ibu  </td><td>: <?php echo $dt->telp_ibu; ?></td>
							</tr>
							<tr>
							  <td>Pekerjaan Ayah  </td><td>: <?php echo $dt->pek_ayah; ?></td>
							</tr>
							<tr>
							  <td>Pekerjaan Ibu  </td><td>: <?php echo $dt->pek_ibu; ?></td>
							</tr>
							<tr>
							  <td>Penghasilan Orang tua  </td><td>: <?php echo $dt->penghasilan_orangtua; ?></td>
							</tr>
							</table>

						</div><!--/ .tab-content -->

						<div class="tab-content" id="tab4">
						<div style="float:right">
						      <a href="#data4"  class="various2"><img width="18" src="<?php echo base_url(); ?>asset/images/edit.png"/>edit</a>
						   </div>

							<table>
							<tr>
							  <td>Pilihan 1  </td><td>: <?php echo $dt->pilihan1; ?></td>
							</tr>
							<tr>
							  <td>Pilihan 2  </td><td>: <?php echo $dt->pilihan2; ?></td>
							</tr>
							
							</table>

						</div><!--/ .tab-content -->

					</div><!-- .tabs-container -->	

				</div><!--/ .content tabs -->
				
			</div><!--/ .columns-->
				
				<?php }
				else {
					?>
					<h4 class="content-title">anda belum login</h4>

				<form method="post">
					

				</form><!--/ .contact-form-->	
					<?php
				}
				?>
                   
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
    
	