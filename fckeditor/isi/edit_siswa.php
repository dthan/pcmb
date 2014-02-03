 <?php
include "conection.php";

if (isset($_GET['id'])) {
	$id_siswa = $_GET['id'];
} else {
	die ("Error. No id Selected! ");	
}

$x=mysql_query("select * from siswa where id_siswa='$id_siswa'");
$r=mysql_fetch_array($x);
list($thn,$bln,$tgl) = explode ("-",$r['tgl_lahir']);
if($r['jenis_kelamin']=='L'){
$jenis_kelamin =0;
}
else{
$jenis_kelamin =1;
}
?>
 
 <div class="right_content">   
  <h2>edit Siswa</h2>
     
        <div class="form">
         <form action="isi/aksi-siswa.php" method="post" id="uploadForm" class="uploadForm">
         <script language="javascript" type="text/javascript" src="js/jquery.form.js"></script>
		 <script language="javascript" type="text/javascript" src="js/siswa.js"></script>
                <fieldset>
                    <dl>
                        <dt><label for="nis">nis</label></dt>
                        <dd><input type="text" name="nis" id="nis" size="68" value="<?php echo "$r[nis]"; ?>"/>
						    <input type="hidden" name="id" id="id" size="68" value="<?php echo "$r[id_siswa]"; ?>" />
							<input type="hidden" name="posisi" id="posisi" size="68" value="<?php echo "$_GET[posisi]"; ?>" />
							<input type="hidden" name="aksi" id="aksi" size="68" value="edit" />
							</dd>
						<dd><div id="nis_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="nama_lengkap">nama lengkap</label></dt>
                        <dd><input type="text" name="nama_lengkap" id="nama_lengkap" size="68" value="<?php echo "$r[nama_lengkap]"; ?>"/></dd>
						<dd><div id="nama_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="alamat">alamat</label></dt>
                        <dd><input type="text" name="alamat" id="alamat" size="68" value="<?php echo "$r[alamat]"; ?>"/></dd>
						<dd><div id="alamat_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="tempat_lahir">tempat lahir</label></dt>
                        <dd><input type="text" name="tempat_lahir" id="tempat" size="68" value="<?php echo "$r[tempat_lahir]"; ?>"/></dd>
						<dd><div id="tempat_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="tgl_lahir">Tanggal Lahir</label></dt>
                        <dd>: 
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
                        <dt><label for="jenis_kelamin">jenis kelamin</label></dt>
                        <dd><input type="radio" name="jk" id="jk" value="L" <? echo ($jenis_kelamin==0)?"checked":""; ?>><label class="check_label">Laki-laki</label> 
							<input type="radio" name="jk" id="jk" value="P" <? echo ($jenis_kelamin==1)?"checked":""; ?>><label class="check_label">Perempuan</label></dd>
                       <dd><div id="jk_error" style="display:none; color : red;"><em>* anda belum jenis kelamin</em></div></dd>
				   </dl>
					<dl>
                        <dt><label for="kategori">kategori</label></dt>
                        <dd><select name='kategori' id="kategori">
					<option value=0 selected>-pilih kategori-</option>
					<?php
					if($r['kategori']=='PAUD'){
					echo "<option value='PAUD' selected>PAUD</option>
					<option value='Diniah'>Diniah</option>"; 
					}
					else{
					echo "<option value='PAUD'>PAUD</option>
					<option value='Diniah' selected>Diniah</option>"; 
					}
					?>
					 
					</select></dd>
					<dd><div id="kategori_error" style="display:none; color : red;"><em>* anda belum memilih kategori</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="kelas">kelas</label></dt>
                        <dd><select name='kelas' id="kelas">
						<option value=0 selected>-pilih kelas-</option>
						<?php
						$q=mysql_query("select * from kelas");
						while($kls=mysql_fetch_array($q))
						{
						  if($r['id_kelas']==$kls['id_kelas']){
						   echo "<option value='$kls[id_kelas]' selected>$kls[nama]</option>";
						  }
						  
						  echo "<option value='$kls[id_kelas]'>$kls[nama]</option>";
						}
						?>
							 
					</select></dd>
					<dd><div id="kelas_error" style="display:none; color : red;"><em>* anda belum memilih kelas</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="agama">agama</label></dt>
                        <dd><input type="text" name="agama" id="agama" size="68" value="<?php echo "$r[agama]"; ?>"/></dd>
						<dd><div id="agama_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="nama_ayah">nama ayah</label></dt>
                        <dd><input type="text" name="nama_ayah" id="ayah" size="68" value="<?php echo "$r[nama_ayah]"; ?>"/></dd>
						<dd><div id="ayah_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="nama_ibu">nama ibu</label></dt>
                        <dd><input type="text" name="nama_ibu" id="ibu" size="68" value="<?php echo "$r[nama_ibu]"; ?>"/></dd>
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
							if($r['th_masuk']==$i){
							echo "<option value='$i' selected>$i</option>";	
							}
							echo "<option value='$i'>$i</option>";	
							}
						?>
						</select>
						</dd>
						<dd><div id="th_masuk_error" style="display:none; color : red;"><em>* anda belum memilih tahun masuk</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="no_telp">no telepon</label></dt>
                        <dd><input type="text" name="no_telp" id="no_telp" size="68" value="<?php echo "$r[no_telp]"; ?>"/></dd>
						<dd><div id="no_telp_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
                    <dl>
                        <dt><label for="upload">foto</label></dt>
                        <dd><input type="file" name="upload" id="upload" /><img src="../foto_siswa/<?php echo "$r[foto]"; ?>" width="100">
						<br>kosongkan jika tidak ada gambar yang di upload</dd>
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