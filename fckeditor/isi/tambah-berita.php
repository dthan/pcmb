 
 <div class="right_content">   
 
 <h2>Input Berita</h2>
     
         <div class="form">
         <form method="post" action="isi/upload.php" id="uploadForm" class="uploadForm">
		 <script language="javascript" type="text/javascript" src="js/jquery.form.js"></script>
		 <script language="javascript" type="text/javascript" src="js/berita.js"></script>				 
                <fieldset>
                    <dl>
                        <dt><label for="email">judul</label></dt>
                        <dd><input type="text" name="judul" id="judul" size="79" />
						    <input type="hidden" name="isi_berita" id="isi_berita" size="68"  />
						  </dd>
						 <dd><div id="judul_error" style="display:none; color : red;"><em>* judul harus di isi</em></div></dd>
                    </dl>
                    <dl>
                        <dt><label for="gender">kategori</label></dt>
                        <dd>
                            <select size="" name="kategori" id="kategori" >
                                <option value="0">-pilih kategori-</option>
                                <?php
								  $q=mysql_query("select * from lembaga");
								  while($h=mysql_fetch_array($q)){
								     echo "<option value='$h[id_lembaga]'>$h[nama_lembaga]</option>";
								  }
								?>
                               
                            </select>
                        			
						<div id="kategori_error" style="display:none; color : red;"><em>* anda belum memilih kategori</em></div>
						</dd>
                    </dl>
                    <dl>
                        <dt><label for="upload">gambar</label></dt>
                        <dd><input type="file" name="upload" id="upload"></dd>
						<dd>* kosongkan jika tidak ada gambar yang di upload</dd>
						
                    </dl>
                    
                    <dl>
                        <dt><label for="comments">isi berita</label></dt>
                        <dd><textarea id="isi"  name="isi_berita" rows="25" cols="40" style="width: 100px;"></textarea>
                        <div id="isi_error" style="display:none; color : red;"><em>* isi berita belum di isi</em></div></dd>
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