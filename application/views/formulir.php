
<section id="content">
	
		<div class="container clearfix">
			
			<div class="page-header clearfix">
              <script src="<?php echo base_url(); ?>asset/js/peserta.js"></script>
            <div class="widget">
             <?php if($sessi!='') {?>
                    <header >
                      <h3 style="color:#fff">Form Pendaftaran</h3>
                      <ul class="toggle_content">                         
                          <li class="arrow"><a href="#">Toggle Content</a></li>
                      </ul>
                    </header>
                    <section class="welly group">                         
                        <form action="<?php echo base_url(); ?>daftar/input_data" method="POST" id="form_daftar" enctype="multipart/form-data">
                          <input type='hidden' name="issubmit" value="1">
                              <!-- Tabs -->
                              <div id="wizard" class="swMain">
                                <ul>
                                  <li><a href="#step-1">
                                        <label class="stepNumber">1</label>
                                        <span class="stepDesc">
                                           Data Diri<br />
                                          
                                        </span>
                                    </a></li>
                                  <li><a href="#step-2">
                                        <label class="stepNumber">2</label>
                                        <span class="stepDesc">
                                           Data Sekolah<br />
                                           
                                        </span>
                                    </a></li>
                                  <li><a href="#step-3">
                                        <label class="stepNumber">3</label>
                                        <span class="stepDesc">
                                           Data Orang tua<br />
                                          
                                        </span>
                                     </a></li>
                                  <li><a href="#step-4">
                                        <label class="stepNumber">4</label>
                                        <span class="stepDesc">
                                           Data Pilihan Jurusan<br />
                                          
                                        </span>
                                    </a></li>
                                </ul>
                                <div id="step-1"> 
                                    <h2 class="StepTitle">Step 1: Data Diri</h2>
                                    <table cellspacing="3" cellpadding="3" align="center">
                                        <tr>
                                              <td align="center" colspan="3">&nbsp;</td>
                                        </tr>        
                                        <tr>
                                              <td align="right">Nama Lengkap :</td>
                                              <td align="left">
                                              <input required="" type="hidden" name="posisi" id="posisi" value="depan"/>
                                                <input required="" type="hidden" name="no_pes" id="no_pes" value="<?php echo "$sessi"; ?>" style="width:300px"/>
                        												<input required="" type="hidden" name="aksi" id="aksi" value="input" style="width:300px"/>
                        												<input required="" type="text"  name="nama" id="nama" style="width:300px"/>		
                                              </td>
                                              <td align="left"><span id="msg_nama"></span>&nbsp;</td>
                                        </tr>
                                   
                                        <tr>
                                              <td align="right">Tempat Lahir :</td>
                                              <td align="left">
                                                <input required="" type="text" name="tempat" id="tempat" style="width:300px"/>	
                                              </td>
                                              <td align="left"><span id="msg_tempat"></span>&nbsp;</td>
                                        </tr> 
                                           <tr>
                                              <td align="right">Tanggal lahir :</td>
                                              <td align="left">
                                                <input required="" type="text" class="datepicker" name="ttl" id="tanggal" style="width:300px"/>	
                                              </td>
                                              <td align="left"><span id="msg_tanggal"></span>&nbsp;</td>
                                        </tr>
                                        <tr>
                                              <td align="right">Jenis Kelamin :</td>
                                              <td align="left">
                                                <select name="jk" style="width:300px">
                        												  <option value="L">laki-laki</option>
                        												  <option value="P">Perempuan</option>
                        												</select>	
                                              </td>
                                              <td align="left"><span id="msg_jk"></span>&nbsp;</td>
                                        </tr>  
                                        <tr>
                                              <td align="right">Warga Negara :</td>
                                              <td align="left">
                                                	<select name="warga" style="width:300px">
                      													  <option value="WNI">WNI</option>
                      													  <option value="WNA">WNA</option>
                      													</select>	
                                              </td>
                                              <td align="left"><span id="msg_warga"></span>&nbsp;</td>
                                        </tr>    
                                         <tr>
                                              <td align="right">Agama :</td>
                                              <td align="left">
                                                <select id="agama" name="agama" style="width:300px">
                        												  <?php
                        												  foreach ($agama->result() as $agm ) {
                        												  	echo "<option value='".$agm->id_agama."'>".$agm->nm_agama."</option>";
                        												  }
                        												  ?>
                        												</select>	
                                              </td>
                                              <td align="left"><span id="msg_agama"></span>&nbsp;</td>
                                        </tr>
                                         <tr>
                                              <td align="right">Provinsi :</td>
                                              <td align="left">
                                                <select required="required" id="provinsi" class="provinsi" name="provinsi" style="width:300px">
                                                <option value="0">-pilih provinsi-</option>
                        												  <?php
                        												  foreach ($prov->result() as $pr ) {
                        												  	echo "<option value='".$pr->id_propinsi."'>".$pr->nama_propinsi."</option>";
                        												  }
                        												  ?>
                        												</select>	
                                                <div id="prov_error" style="display:none;color:red"><i>provinsi belum di pilih</i></div>
                                              </td>
                                              <td align="left"><span id="msg_provinsi"></span>&nbsp;</td>
                                        </tr>
                                         <tr>
                                              <td align="right">kabupaten/kota :</td>
                                              <td align="left">
                                                <select required="required" id="kota" name="kota" style="width:300px">
                        											    <option value="0">-pilih kota-</option>
                        											 </select>	
                                               <div id="kota_error" style="display:none;color:red"><i>kota belum di pilih</i></div>
                                              </td>
                                              <td align="left"><span id="msg_kota"></span>&nbsp;</td>
                                        </tr>
                                        <tr>
                                              <td align="right">no hp :</td>
                                              <td align="left">
                                                <input type="text" name="no_hp" id="no_hp" style="width:300px"/>        
                                              </td>
                                              
                                        </tr>
                                         <tr>
                                              <td align="right">Alamat :</td>
                                              <td align="left">
                                                <textarea name="alamat" id="alamat" style="width:300px"></textarea> 				
                                              </td>
                                              <td align="left"><span id="msg_alamat"></span>&nbsp;</td>
                                        </tr>
                                         <tr>
                                              <td align="right">Jenis Kelamin :</td>
                                              <td align="left">
                                                <input type="file" name="photo" size="20" />	<br> 
                                                <i style="color:red">max ukuran foto 500 kb</i><br>             
                                                <i style="color:red">gambar harus tipe jpeg atau png</i>  			
                                              </td>
                                              <td align="left"><span id="msg_photo"></span>&nbsp;</td>
                                        </tr>                                    
                                   </table>               
                                </div>
                                <div id="step-2">
                                    <h2 class="StepTitle">Step 2: Data Sekolah</h2>  
                                    <table cellspacing="3" cellpadding="3" align="center">
                                        <tr>
                                              <td align="center" colspan="3">&nbsp;</td>
                                        </tr>        
                                        
                                        <tr>
                                              <td align="right">provinsi sekolah :</td>
                                              <td align="left">
                                               <select id="provinsi_sekolah" name="provinsi_sekolah" style="width:300px">
                                                  <option required="" value="">-pilih provinsi-</option>
                                                  <?php
                                                  foreach ($prov->result() as $pr ) {
                                                    echo "<option value='".$pr->id_propinsi."'>".$pr->nama_propinsi."</option>";
                                                  }
                                                  ?>
                                                </select> 
                                              </td>
                                              <td align="left"><span id="msg_jenis_sekolah"></span>&nbsp;</td>
                                        </tr> 
                                           <tr>
                                              <td align="right">kota sekolah :</td>
                                              <td align="left">
                                                <select id="kota_sekolah" name="kota_sekolah" style="width:300px">
                                                  <option required="" value="">-pilih kota-</option>
                                               </select>  
                                              </td>
                                              </td>
                                              <td align="left"><span id="msg_jenis_sekolah"></span>&nbsp;</td>
                                        </tr> 
                                         <tr>
                                              <td align="right">Jenis Sekolah :</td>
                                              <td align="left">
                                               <select id="jenis_sekolah" name="jenis_sekolah" style="width:300px">
                                                <?php
                                                foreach ($sekolah->result() as $skl) {
                                                  echo "<option value='".$skl->id_jenis_sekolah."'>".$skl->jenis_sekolah."</option>";
                                                }
                                                ?>
                                              </select> 
                                              </td>
                                              <td align="left"><span id="msg_jenis_sekolah"></span>&nbsp;</td>
                                        </tr> 
                                        <tr>
                                              <td align="right">nama sekolah :</td>
                                              <td align="left">
                                                <select id="nama_sekolah" name="nama_sekolah" style="width:300px">
                                                  <option required="" value="">-pilih sekolah-</option>
                                               </select>  
                                              </td>
                                              </td>
                                              <td align="left"><span id="msg_jenis_sekolah"></span>&nbsp;</td>
                                        </tr> 
                                       
                                        <tr>
                                              <td align="right">Alamat Sekolah :</td>
                                              <td align="left">
                                                 <textarea name="alamat_sekolah" id="alamat_sekolah" style="width:300px"></textarea> 	
                                              </td>
                                              <td align="left"><span id="msg_alamat_sekolah"></span>&nbsp;</td>
                                        </tr>  
                                         <tr>
                                              <td align="right">Program :</td>
                                              <td align="left">
                                                 <select name="program" id="program" style="width:300px">
													  <?php
													  foreach ($program->result() as $pro) {
													  	echo "<option value='".$pro->id_program."'>".$pro->nama_program."</option>";
													  }
													  ?>
													</select>	
                                              </td>
                                              <td align="left"><span id="msg_program"></span>&nbsp;</td>
                                        </tr>
                                          <tr>
                                              <td align="right">Tahun lulus :</td>
                                              <td align="left">
                                                <select name="tahun_lulus" id="tahun_lulus" style="width:300px">
													  <?php
													  for ($th=2013; $th>2005; $th--){
							                              echo "<option value='$th'>$th<option>";
													  }
													  ?>
													</select>	
                                              </td>
                                              <td align="left"><span id="msg_tahun_lulus"></span>&nbsp;</td>
                                        </tr> 
                                          <tr>
                                              <td align="right">Nilai Ijazah :</td>
                                              <td align="left">
                                                 <input required="" type="text" name="nilai_ijazah" id="nilai_ijazah" style="width:300px"/>	
                                              </td>
                                              <td align="left"><span id="msg_ijazah"></span>&nbsp;</td>
                                        </tr> 
                                      

                                   </table>        
                                </div>                      
                                <div id="step-3">
                                    <h2 class="StepTitle">Step 3: Data Orang tua</h2>  
                                    <table cellspacing="3" cellpadding="3" align="center">
                                        <tr>
                                              <td align="center" colspan="3">&nbsp;</td>
                                        </tr>        
                                        <tr>
                                              <td align="right">Nama Ayah :</td>
                                              <td align="left">
                                                 <input type="hidden" id="root" value="<?php echo base_url(); ?>"/>
                                                <input required="" type="text" name="ayah" id="ayah" style="width:300px"/>
                                              </td>
                                          </tr>
                                           <tr>
                                              <td align="right">Nama Ibu :</td>
                                              <td align="left">
                                                <input required="" type="text" name="ibu" id="ibu" style="width:300px"/>	
                                              </td>
                                          </tr>
                                           <tr>
                                              <td align="right">Provinsi :</td>
                                              <td align="left">
                                              <select id="provinsi_ortu" name="provinsi_ortu" style="width:300px">
                                                <option value='0' selected>-pilih provinsi-</option>
												  <?php
												  foreach ($prov->result() as $pr ) {
												  	echo "<option value='".$pr->id_propinsi."'>".$pr->nama_propinsi."</option>";
												  }
												  ?>
												</select>	
                                              </td>
                                          </tr>
                                        <tr>
                                              <td align="right">Kabupaten/kota :</td>
                                              <td align="left">
                                               <select id="kota_ortu" name="kota_ortu" style="width:300px">
												    <option value="0"></option>
												 </select>	
                                              </td>
                                              
                                        </tr>               
                                        <tr>
                                              <td align="right">Alamat Orang tua :</td>
                                              <td align="left">
                                                     <input type="checkbox" id="samakan" name="samakan" value="sama">&nbsp;samakan dengan alamat anda<br>
                                                    <textarea name="alamat_ortu" id="alamat_ortu" style="width:300px"></textarea> 
                                              </td>
                                              
                                        </tr>     
                                         <tr>
                                              <td align="right">Pendidikan ayah :</td>
                                              <td align="left">
                                                   <select name="pend_ayah" style="width:300px">
													  <?php
													  foreach ($pendidikan->result() as $pend) {
													  	echo "<option value='".$pend->idpendidikan."'>".$pend->pendidikan."</option>";
													  }
													  ?>
													</select>	
                                              </td>
                                              
                                        </tr>            
                                        <tr>
                                              <td align="right">Pendidikan Ibu :</td>
                                              <td align="left">
						                               <select name="pend_ibu" style="width:300px">
												  <?php
												  foreach ($pendidikan->result() as $pend) {
												  	echo "<option value='".$pend->idpendidikan."'>".$pend->pendidikan."</option>";
												  }
												  ?>
												</select>	
                                              </td>
                                              
                                        </tr>          
                                           
                                        <tr>
                                              <td align="right">Pekerjaan Ayah :</td>
                                              <td align="left">
						                        <select name="pekerjaan_ayah" style="width:300px">
													  <?php
													  foreach ($pekerjaan->result() as $p) {
													  	echo "<option value='".$p->idpekerjaan."'>".$p->pekerjaan."</option>";
													  }
													  ?>
													</select>	
                                              </td>
                                              
                                        </tr>          
                                        <tr>
                                              <td align="right">Pekerjaan Ibu :</td>
                                              <td align="left">
						                         <select name="pekerjaan_ibu" style="width:300px">
												  <?php
												  foreach ($pekerjaan->result() as $p) {
												  	echo "<option value='".$p->idpekerjaan."'>".$p->pekerjaan."</option>";
												  }
												  ?>
												</select>	
                                              </td>
                                              
                                        </tr>    
                                        <tr>
                                              <td align="right">Penghasilan Orang tua :</td>
                                              <td align="left">
						                          <select name="penghasilan_ortu" style="width:300px">
											  <?php
											  foreach ($penghasilan->result() as $p) {
											  	echo "<option value='".$p->idpenghasilan."'>".$p->penghasilan."</option>";
											  }
											  ?>
											</select>	
                                              </td>
                                              
                                        </tr>         
                                        <tr>
                                              <td align="right">Telp Ayah :</td>
                                              <td align="left">
						                         <input required="" type="text" name="telp_ayah" id="telp_ayah" style="width:300px"/>
                                              </td>
                                              
                                        </tr>    
                                         <tr>
                                              <td align="right">Telp Ibu :</td>
                                              <td align="left">
						                         <input required="" type="text" name="telp_ibu" id="telp_ibu" style="width:300px"/>
                                              </td>
                                              
                                        </tr> 
                                         <tr>
                                              <td align="right">Kode Pos Orang tua :</td>
                                              <td align="left">
						                         <input  type="text" name="kode_post_ortu" id="kode_post_ortu" style="width:300px"/>	
                                              </td>
                                              
                                        </tr>       
                                                                        
                                   </table>                                 
                                </div>
                                <div id="step-4">
                                    <h2 class="StepTitle">Step 4: Data Pilihan Jurusan</h2>  
                                    <table cellspacing="3" cellpadding="3" align="center">
                                        <tr>
                                              <td align="center" colspan="3"><b>PILIHAN PERTAMA</b></td>
                                        </tr>        
                                        <tr>
                                              <td align="right">Fakultas :</td>
                                              <td align="left">
                                                <select required=""  id="fak1" name="fak1" style="width:300px">
												<option value='' selected>-pilih fakultas-</option>
												  <?php
												  foreach ($fakultas->result() as $fak ) {
												  	echo "<option value='".$fak->kode_fak."'>".$fak->fakultas."</option>";
												  }
												  ?>
												</select>
                                              </td>
                                              
                                        </tr>     
                                            <tr>
                                              <td align="right">Jurusan :</td>
                                              <td align="left">
                                                <select required="" id="pil_1" name="pil_1" style="width:300px">
												<option value='' selected>-pilih jurusan-</option>
												 
												</select>	
                                              </td>
                                              
                                        </tr>      
                                         <tr>
                                         &nbsp;
                                         </tr> 
                                         <tr>
                                         &nbsp;
                                         </tr>   
                                          <tr>
                                              <td align="center" colspan="3"><b>PILIHAN KEDUA</b></td>
                                        </tr>        
                                        <tr>
                                              <td align="right">Fakultas :</td>
                                              <td align="left">
                                                <select required=""  id="fak2" name="fak2" style="width:300px">
												<option value='' selected>-pilih fakultas-</option>
												  <?php
												  foreach ($fakultas->result() as $fak ) {
												  	echo "<option value='".$fak->kode_fak."'>".$fak->fakultas."</option>";
												  }
												  ?>
												</select>
                                              </td>
                                              
                                        </tr>     
                                            <tr>
                                              <td align="right">Jurusan :</td>
                                              <td align="left">
                                                <select required="" id="pil_2" name="pil_2" style="width:300px">
												<option value='' selected>-pilih jurusan-</option>
												 
												</select>	
                                              </td>
                                              
                                        </tr>                                     
                                   </table>                       
                                </div>
                              </div>
                        <!-- End SmartWizard Content -->      
                        </form> 
                        
                    </section>
                    <?php }
                    else {
                    	echo "<h1>ANDA BELUM LOGIN</h1>";
                    }
                    ?>
                  </div>   
				
			</div><!--/ .page-header-->
       
			</div><!--/ .columns-->
		

		</div><!--/ .container-->
	 
	 </section><!--/ #content-->
    
	