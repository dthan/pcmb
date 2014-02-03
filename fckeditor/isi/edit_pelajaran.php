 
 <div class="right_content">   
 
 <h2>Input Pelajaran</h2>
     
         <div class="form">
         <form method="post" action="isi/tambah_pelajaran.php" id="uploadForm" class="uploadForm">
		 <script language="javascript" type="text/javascript" src="js/jquery.form.js"></script>
		 <script language="javascript" type="text/javascript" src="js/edit_pelajaran.js"></script>				 
                <fieldset>
				<?php
				$q=mysql_query("select * from mata_pelajaran where id_matapelajaran='$_GET[id]'");
				$r=mysql_fetch_array($q);
				echo "
                    <dl>
                        <dt><label for='email'>Nama Pelajaran</label></dt>
                        <dd><input type='text' name='pelajaran' id='pelajaran' size='79' value='$r[nama]'/>
						    <input type='hidden' name='id_pelajaran' id='id_pelajaran' value='$r[id_matapelajaran]' size='68' />
						    <input type='hidden' name='isi_deskripsi' id='isi_deskripsi' size='68'  />
						  </dd>
						 <dd><div id='pelajaran_error' style='display:none; color : red;'><em>* anda belum mengisi form ini</em></div></dd>
                    </dl>
                    <dl>
                        <dt><label for='gender'>kelas</label></dt>
                        <dd>
                            <select size='' name='kelas' id='kelas' >
                                <option value='0'>-pilih kelas-</option>";
                                 
								  $q=mysql_query('select * from kelas');
								  while($h=mysql_fetch_array($q)){
								     if($h['id_kelas']==$r['id_kelas']){
									 echo "<option value='$h[id_kelas]' selected>$h[nama]</option>";
									 }
									 else {
								     echo "<option value='$h[id_kelas]'>$h[nama]</option>";
								     }
								   }
								
                            echo "   
                            </select>
                        			
						<div id='kelas_error' style='display:none; color : red;'><em>* anda belum memilih kelas</em></div>
						</dd>
                    </dl>
					<dl>
                        <dt><label for='gender'>Pengajar</label></dt>
                        <dd>
                            <select size='' name='pengajar' id='pengajar' >
                                <option value='0'>-pilih pengajar-</option>";
                                
								  $q=mysql_query('select * from pengajar');
								  while($h=mysql_fetch_array($q)){
								  if($h['id_pengajar']==$r['id_pengajar']){
								    echo "<option value='$h[id_pengajar]' selected>$h[nama_lengkap]</option>";
								  }
								  else{
								     echo "<option value='$h[id_pengajar]'>$h[nama_lengkap]</option>";
								    }
								  }
								
                           echo "    
                            </select>
                        			
						<div id='pengajar_error' style='display:none; color : red;'><em>* anda belum memilih pengajar</em></div>
						</dd>
                    </dl>
                    <dl>
                        <dt><label for='comments'>Deskripsi</label></dt>
                        <dd><textarea id='deskripsi'  name='deskripsi' rows='15' cols='30' style='width: 100px;'>$r[deskripsi]</textarea>
                        <div id='deskripsi_error' style='display:none; color : red;'><em>* Deskripsi belum di isi</em></div></dd>
					</dl>
                     <dl class='submit2'>
                    <input type='submit' id='simpan' value='simpan'/>
                     </dl>
                     
                     
                    
                </fieldset>
                
         </form>
         </div>";
		 ?>
		  <div class="loading"><img src='images/loading.GIF'></div>	
          <div class="warning_box">
            Data Gagal di input
         </div>
         <div class="valid_box">
          Data Berhasil di input
          </div>	 
    </div>