<div class="right_content"> 
 <script language="javascript" type="text/javascript" src="js/jquery.form.js"></script>
 <script language="javascript" type="text/javascript" src="js/edit_berita.js"></script>
 <div class="form">
         <form id="uploadForm" class="uploadForm" action="isi/aksi_edit_berita.php">
		      <?php
			    $x=mysql_query("select * from berita where id_berita='$_GET[id]'");
				$r=mysql_fetch_array($x);
			   
		        echo "
                <fieldset>
                    <dl>
                        <dt><label for='email'>judul</label></dt>
                        <dd><input type='text' name='judul' id='judul' size='68' value='$r[judul_berita]' />
						    <input type='hidden' name='posisi' id='posisi' value='$_GET[posisi]'/>
							<input type='hidden' name='id_berita' id='id' value='$r[id_berita]'/>
							<input type='hidden' name='isi_berita' id='isi_berita'/>
						  </dd>
						 <dd><div id='judul_error' style='display:none; color : red;'><em>* judul harus di isi</em></div></dd>
                    </dl>
                    <dl>
                        <dt><label for='gender'>kategori</label></dt>
                        <dd>
                            <select size='' name='kategori' id='kategori'>
                                <option value='0'>-pilih kategori-</option>";
                                 $q=mysql_query("select * from lembaga");
								  while($h=mysql_fetch_array($q)){
								     if ($r['id_lembaga']==$h['id_lembaga']){
									  echo "<option value='$h[id_lembaga]' selected>$h[nama_lembaga]</option>";
									 }
									 else {
								     echo "<option value='$h[id_lembaga]'>$h[nama_lembaga]</option>";
								     }
								  }
                               
                       echo "</select>
							<div id='kategori_error' style='display:none; color : red;'><em>* anda belum memilih kategori</em></div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for='upload'>gambar</label></dt>
                        <dd><input type='file' name='upload' id='upload' />
						<img src='../gambar_berita/$r[gambar]' width='70' height='70'><br>    
						kosongkan jika tidak ada gambar yang di upload
						</dd>
						
						
                    </dl>
                    
                    <dl>
                        <dt><label for='comments'>isi berita</label></dt>
                        <dd><textarea id='isi'  name='isi_berita' rows='25' cols='40' style='width: 100px;'>$r[isi_berita]</textarea>
						<div id='isi_error' style='display:none; color : red;'><em>* isi berita belum di isi</em></div></dd>
                    </dl>
                     <dl class='submit2'>
                    <input type='submit' id='simpan' value='simpan'/>
                     </dl>
                     
                     
                    
                </fieldset>";
                ?>
         </form>
         </div>
		  <div class="loading"><img src='images/loading.GIF'></div>	
             <div class="warning_box">
        data gagal di update
     </div>
     <div class="valid_box">
       Data Berhasil di update
     </div>	
</div>