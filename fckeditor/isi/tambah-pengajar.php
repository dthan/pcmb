 
 <div class="right_content">   
 
 <h2>Input Pengajar</h2>
     
         <div class="form">
         <form method="post" action="isi/aksi_pengajar.php" id="uploadForm" class="uploadForm">
		 <script language="javascript" type="text/javascript" src="js/jquery.form.js"></script>
		 <script language="javascript" type="text/javascript" src="js/pengajar.js"></script>				 
                <fieldset>
                    <dl>
                        <dt><label for="email">NIP</label></dt>
                        <dd><input type="text" name="nip" id="nip" size="79" />
						    <input type="hidden" name="isi_alamat" id="isi_alamat" size="68"  />
							<input type="hidden" name="aksi" id="aksi" value="input" size="68"  />
							
							<input type="hidden" name="id" id="id" value="id" size="68"  />
						  </dd>
						 <dd><div id="nip_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					  <dl>
                        <dt><label for="email">Nama</label></dt>
                        <dd><input type="text" name="nama" id="nama" size="79" /></dd>
						 <dd><div id="nama_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					
					  <dl>
                        <dt><label for="email">Tempat Lahir</label></dt>
                        <dd><input type="text" name="tempat" id="tempat" size="79" /></dd>
						 <dd><div id="tempat_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					  <dl>
                        <dt><label for="email">Tanggal lahir</label></dt>
                        <dd>
						<select name="tgl" id="tgl">
						<?
						    echo "<option value='0'>tgl</option>";
							for ($i=1; $i<=31; $i++) {
							
							$tg = ($i<10) ? "0$i" : $i;
							echo "<option value='$tg'>$tg</option>";	
							}
						?>
						</select> - 
						<select name="bln" id="bln">
						<?
						    echo "<option value='0'>bln</option>";
							for ($i=1; $i<=12; $i++) {
							$bl = ($i<10) ? "0$i" : $i;
							echo "<option value='$bl'>$bl</option>";	
							}
						?>
						</select> - 
						<select name="thn" id="thn">
						<?
						    echo "<option value='0'>thn</option>";
							for ($i=1990; $i<=2020; $i++) {
							echo "<option value='$i'>$i</option>";	
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
						<input type="radio" name="jk" id="jk" value="L" checked><label class="check_label">Laki-laki</label> 
							<input type="radio" name="jk" id="jk" value="P" ><label class="check_label">Perempuan</label>
						</dd>
						 <dd><div id="jk_error" style="display:none; color : red;"><em>* anda belum memilih jenis kelamin</em></div></dd>
                    </dl>
					  <dl>
                        <dt><label for="email">Agama</label></dt>
                        <dd><input type="text" name="agama" id="agama" size="79" /></dd>
						 <dd><div id="agama_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					  <dl>
                        <dt><label for="email">Telp</label></dt>
                        <dd><input type="text" name="telp" id="telp" size="79" /></dd>
						 <dd><div id="telp_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					  <dl>
                        <dt><label for="email">Email</label></dt>
                        <dd><input type="text" name="email" id="email" size="79" /></dd>
						 <dd><div id="email_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div>
						 <div id="email_tidakvalid_error" style="display:none; color : red;"><em>* Email tidak valid</em></div>
						 </dd>
                    </dl>
					<dl>
                        <dt><label for="upload">Foto</label></dt>
                        <dd><input type="file" name="upload" id="upload"></dd>
						<dd>* kosongkan jika tidak ada gambar yang di upload</dd>
						
                    </dl>
                      <dl>
                        <dt><label for="website">website</label></dt>
                        <dd><input type="text" name="website" id="website" size="79" value="http://" /></dd>
						 <dd>
						 <div id="website_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div>
						 <div id="web" style=" color : blue;"><em>* kosongkan jika tidak perlu</em></div>
						 <div id="website_tidakvalid_error" style="display : none; color : red;"><em>* website tidak valid</em></div>
						 </dd>
                    </dl>
					  <dl>
                        <dt><label for="jabatan">jabatan</label></dt>
                        <dd><input type="text" name="jabatan" id="jabatan" size="79" /></dd>
						 <dd><div id="jabatan_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="comments">Alamat</label></dt>
                        <dd><textarea id="alamat"  name="isi_alamat" rows="10" cols="40" style="width: 100px;"></textarea>
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