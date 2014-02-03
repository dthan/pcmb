 <div class="right_content">   
  <h2>Input User</h2>
     
        <div class="form">
         <form method="post" action="isi/aksi_user.php" id="uploadForm" class="uploadForm">
		 <script language="javascript" type="text/javascript" src="js/jquery.form.js"></script>
		 <script language="javascript" type="text/javascript" src="js/user.js"></script>	
         
                <fieldset>
                    <dl>
                        <dt><label for="username">username</label></dt>
                        <dd><input type="text" name="username" id="username" size="68" />
						    <input type="hidden" name="aksi" id="aksi" size="68" value="simpan" />
						  </dd>
						<dd><div id="username_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="nama_lengkap">nama lengkap</label></dt>
                        <dd><input type="text" name="nama_lengkap" id="nama_lengkap" size="68" /></dd>
						<dd><div id="nama_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="password">password</label></dt>
                        <dd><input type="password" name="password" id="password" size="68" /></dd>
						<dd><div id="password_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="email">email</label></dt>
                        <dd><input type="text" name="email" id="email" size="68" /></dd>
						<dd><div id="email_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div>
						<div id="email_tidakvalid_error" style="display:none; color : red;"><em>* email tidak valid</em></div>
						</dd>
                    </dl>
					
					<dl>
                        <dt><label for="web">web</label></dt>
                        <dd><input type="text" name="website" id="website" size="68" value="http://"/></dd>
						<dd>
						<div id="web" style=" color : blue;"><em>* kosongkan jika tidak perlu</em></div>
						<div id="website_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div>
						<div id="website_tidakvalid_error" style="display:none; color : red;"><em>* web tidak valid</em></div>
						</dd>
                    </dl>
					<dl>
                        <dt><label for="blokir">blokir</label></dt>
                        <dd><input type="radio" name="blokir" id="blokir" value="Y" checked/><label class="check_label">Y</label>
                            <input type="radio" name="blokir" id="blokir" value="N" /><label class="check_label">N</label></dd>
                    </dl>
                   
                    <dl>
                        <dt><label for="upload">Foto</label></dt>
                        <dd><input type="file" name="upload" id="upload" /></dd>
						<dd><div id="web" style=" color : blue;"><em>* kosongkan jika tidak ada foto yang di upload</em></div></dd>
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