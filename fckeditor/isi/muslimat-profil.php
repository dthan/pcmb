 <div class="right_content">   
  <h2>Input Profil Muslimat</h2>
     
         <div class="form">
         <form action="" method="post" class="niceform">
         
                <fieldset>
                    <dl>
                        <dt><label for="upload">gambar</label></dt>
                        <dd><input type="file" name="upload" id="upload" /></dd>
						kosongkan jika tidak ada gambar yang di upload
                    </dl>
                    
                    <dl>
                        <dt><label for="comments">isi Profil</label></dt>
                        <dd><textarea id="elm1" name="elm1" name="isi_muslimat"  rows="25" cols="40" style="width: 100px;"></textarea></dd>
                    </dl>
                     <dl class="submit2">
                        <button type="button" onclick="javascript:validasiMuslimat();">simpan</button>
                     </dl>
                     
                     
                    
                </fieldset>
                
         </form>
         </div> 
		<div id="berhasil">input data gagal</div>		 
    </div>