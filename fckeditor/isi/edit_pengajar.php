 
 <div class="right_content">   
 
 <h2>Edit Pengajar</h2>
     
         <div class="form">
         <form method="post" action="isi/aksi_pengajar.php" id="uploadForm" class="uploadForm">
		 <script language="javascript" type="text/javascript" src="js/jquery.form.js"></script>
		 <script language="javascript" type="text/javascript" src="js/pengajar.js"></script>				 
                <fieldset>
				<?php
				 $r=mysql_fetch_array(mysql_query("select * from pengajar where id_pengajar='$_GET[id]'"));
				 list($thn,$bln,$tgl) = explode ("-",$r['tgl_lahir']);
				 if($r['jenis_kelamin']=='L'){
				   $jenis_kelamin=0;
				 }
				 else{
				   $jenis_kelamin=1;
				 }
                 //$jenis_kelamin = $r['jenis_kelamin'];
				?>
                    <dl>
                        <dt><label for="email">NIP</label></dt>
                        <dd><input type="text" name="nip" id="nip" size="79" <?php echo "value='$r[nip]'"; ?> />
						    <input type="hidden" name="isi_alamat" id="isi_alamat" size="68"  />
							<input type="hidden" name="aksi" id="aksi" value="edit" size="68"  />
							<input type="hidden" name="id" id="id" <?php echo "value='$r[id_pengajar]'"; ?> size="68"  />
						  </dd>
						 <dd><div id="nip_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					  <dl>
                        <dt><label for="email">Nama</label></dt>
                        <dd><input type="text" name="nama" id="nama" size="79" <?php echo "value='$r[nama_lengkap]'"; ?>/></dd>
						 <dd><div id="nama_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					
					  <dl>
                        <dt><label for="email">Tempat Lahir</label></dt>
                        <dd><input type="text" name="tempat" id="tempat" size="79" <?php echo "value='$r[tempat_lahir]'"; ?>/></dd>
						 <dd><div id="tempat_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					  <dl>
                        <dt><label for="email">Tanggal lahir</label></dt>
                        <dd>
							<select name="tgl" id="tgl">
						<?
					for ($i=1; $i<=31; $i++) {
						$tg = ($i<10) ? "0$i" : $i;
						$sele = ($tg==$tgl)? "selected" : "";
						echo "<option value='$tg' $sele>$tg</option>";	
					}
						?>
						</select> - 
						<select name="bln" id="bln">
						<?
							for ($i=1; $i<=12; $i++) {
						$bl = ($i<10) ? "0$i" : $i;
						$sele = ($bl==$bln)?"selected" : "";
						echo "<option value='$bl' $sele>$bl</option>";	
					}
						?>
						</select> - 
						<select name="thn" id="thn">
						<?
							for ($i=1990; $i<=2020; $i++) {
						$sele = ($i==$thn)?"selected" : "";
						echo "<option value='$i' $sele>$i</option>";	
					}
						?>
						</select>

						</dd>
						 <dd><div id="tgl_error" style="display:none; color : red;"><em>* anda belum memilih tanggal,</em></div>
						 <div id="bln_error" style="display:none; color : red;"><em>* anda belum memilih bulan,</em></div>
						 <div id="thn_error" style="display:none; color : red;"><em>* anda belum memilih tahun</em></div></dd>
                    </dl>
					  <dl>
                        <dt><label for="email">Jenis Kelamin</label></dt>
                        <dd>
						<input type="radio" name="jk" id="jk" value="L" <? echo ($jenis_kelamin==0)?"checked":""; ?>><label class="check_label">Laki-laki</label> 
							<input type="radio" name="jk" id="jk" value="P" <? echo ($jenis_kelamin==1)?"checked":""; ?>><label class="check_label">Perempuan</label>
						</dd>
						 <dd><div id="jk_error" style="display:none; color : red;"><em>* anda belum memilih jenis kelamin</em></div></dd>
                    </dl>
					  <dl>
                        <dt><label for="email">Agama</label></dt>
                        <dd><input type="text" name="agama" id="agama" size="79" <?php echo "value='$r[agama]'"; ?>/></dd>
						 <dd><div id="agama_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					  <dl>
                        <dt><label for="email">Telp</label></dt>
                        <dd><input type="text" name="telp" id="telp" size="79" <?php echo "value='$r[no_telp]'"; ?>/></dd>
						 <dd><div id="telp_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					  <dl>
                        <dt><label for="email">Email</label></dt>
                        <dd><input type="text" name="email" id="email" size="79" <?php echo "value='$r[email]'"; ?> /></dd>
						 <dd><div id="email_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div>
						 <div id="email_tidakvalid_error" style="display:none; color : red;"><em>* Email tidak valid</em></div>
						 </dd>
                    </dl>
					<dl>
                        <dt><label for="upload">Foto</label></dt>
                        <dd><input type="file" name="upload" id="upload"><img src="../foto_pengajar/<?php echo "$r[foto]"; ?>" width="100">
						<br>* kosongkan jika tidak ada gambar yang di upload</dd>
						
                    </dl>
                      <dl>
                        <dt><label for="website">website</label></dt>
                        <dd><input type="text" name="website" id="website" size="79" <?php echo "value='$r[website]'"; ?> /></dd>
						 <dd>
						 <div id="website_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div>
						 <div id="web" style=" color : blue;"><em>* kosongkan jika tidak perlu</em></div>
						 <div id="website_tidakvalid_error" style="display : none; color : red;"><em>* website tidak valid</em></div>
						 </dd>
                    </dl>
					  <dl>
                        <dt><label for="jabatan">jabatan</label></dt>
                        <dd><input type="text" name="jabatan" id="jabatan" size="79" <?php echo "value='$r[jabatan]'"; ?> /></dd>
						 <dd><div id="jabatan_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="comments">Alamat</label></dt>
                        <dd><textarea id="alamat"  name="isi_alamat" rows="10" cols="40" style="width: 100px;"><?php echo "$r[alamat]"; ?></textarea>
                        <div id="alamat_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
					</dl>
                     <dl class="submit2">
                    <input type="submit" id="simpan" value="simpan"/>
                     </dl>
                     
                     
                    
                </fieldset>
                
         </form>
         </div>
		  <div class="loading"><img src='images/loading.GIF'></div>	
          <div class="warning_box">
            Data Gagal di input
         </div>
         <div class="valid_box">
          Data Berhasil di input
          </div>	 
    </div>