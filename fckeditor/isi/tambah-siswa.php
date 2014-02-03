<div class="right_content">   
  <h2>Input Siswa</h2>
     
        <div class="form">
         <form action="isi/aksi-siswa.php" method="post" id="uploadForm" class="uploadForm">
         <script language="javascript" type="text/javascript" src="js/jquery.form.js"></script>
		 <script language="javascript" type="text/javascript" src="js/siswa.js"></script>
                <fieldset>
                    <dl>
                        <dt><label for="nis">nis</label></dt>
                        <dd><input type="text" name="nis" id="nis" size="68" />
						    <input type="hidden" name="id" id="id" size="68" value="1" />
							<input type="hidden" name="aksi" id="aksi" size="68" value="simpan" />
							</dd>
						<dd><div id="nis_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="nama_lengkap">nama lengkap</label></dt>
                        <dd><input type="text" name="nama_lengkap" id="nama_lengkap" size="68" /></dd>
						<dd><div id="nama_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="alamat">alamat</label></dt>
                        <dd><input type="text" name="alamat" id="alamat" size="68" /></dd>
						<dd><div id="alamat_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="tempat_lahir">tempat lahir</label></dt>
                        <dd><input type="text" name="tempat_lahir" id="tempat" size="68" /></dd>
						<dd><div id="tempat_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="tgl_lahir">Tanggal Lahir</label></dt>
                        <dd>: 
						<select name="tgl" id="tgl">
						<?
						    echo "<option value='0' selected>tgl</option>";
							for ($i=1; $i<=31; $i++) {
							$tg = ($i<10) ? "0$i" : $i;
							echo "<option value='$tg'>$tg</option>";	
							}
						?>
						</select> - 
						<select name="bln" id="bln">
						<?
						    echo "<option value='0' selected>bln</option>";
							for ($i=1; $i<=12; $i++) {
							$bl = ($i<10) ? "0$i" : $i;
							echo "<option value='$bl'>$bl</option>";	
							}
						?>
						</select> - 
						<select name="thn" id="thn">
						<?
						    echo "<option value='0' selected>thn</option>";
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
                        <dt><label for="jenis_kelamin">jenis kelamin</label></dt>
                        <dd><input type="radio" name="jk" id="jk" value="L" checked><label class="check_label">Laki-laki</label> 
							<input type="radio" name="jk" id="jk" value="P" ><label class="check_label">Perempuan</label></dd>
                       <dd><div id="jk_error" style="display:none; color : red;"><em>* anda belum jenis kelamin</em></div></dd>
				   </dl>
					<dl>
                        <dt><label for="kategori">kategori</label></dt>
                        <dd><select name='kategori' id="kategori">
					<option value=0 selected>-pilih kategori-</option>
					<option value="PAUD">PAUD</option>
					<option value="Diniah">Diniah</option> 		 
					</select></dd>
					<dd><div id="kategori_error" style="display:none; color : red;"><em>* anda belum memilih kategori</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="kelas">kelas</label></dt>
                        <dd><select name='kelas' id="kelas">
						<option value=0 selected>-pilih kelas-</option>
						<?php
						$q=mysql_query("select * from kelas");
						while($r=mysql_fetch_array($q))
						{
						  echo "<option value='$r[id_kelas]'>$r[nama]</option>";
						}
						?>
							 
					</select></dd>
					<dd><div id="kelas_error" style="display:none; color : red;"><em>* anda belum memilih kelas</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="agama">agama</label></dt>
                        <dd><input type="text" name="agama" id="agama" size="68" /></dd>
						<dd><div id="agama_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="nama_ayah">nama ayah</label></dt>
                        <dd><input type="text" name="nama_ayah" id="ayah" size="68" /></dd>
						<dd><div id="ayah_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="nama_ibu">nama ibu</label></dt>
                        <dd><input type="text" name="nama_ibu" id="ibu" size="68" /></dd>
						<dd><div id="ibu_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="th_masuk">tahun masuk</label></dt>
                        <dd>
						</select> 
						<select name="th_masuk" id="th_masuk">
						<?
						    echo "<option value='0' selected>-pilih tahun-</option>";
							for ($i=2000; $i<=2020; $i++) {
							echo "<option value='$i'>$i</option>";	
							}
						?>
						</select>
						</dd>
						<dd><div id="th_masuk_error" style="display:none; color : red;"><em>* anda belum memilih tahun masuk</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="no_telp">no telepon</label></dt>
                        <dd><input type="text" name="no_telp" id="no_telp" size="68" /></dd>
						<dd><div id="no_telp_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
                    <dl>
                        <dt><label for="upload">foto</label></dt>
                        <dd><input type="file" name="upload" id="upload" /></dd>
						kosongkan jika tidak ada gambar yang di upload
                    </dl>
                    
                    
                     <dl class="submit2">
                    <input type="submit"  value="Simpan" />
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