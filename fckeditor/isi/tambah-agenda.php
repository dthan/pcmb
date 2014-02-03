 <div class="right_content">   
  <h2>Input Agenda</h2>
     
         <div class="form">
         <form action="" method="post" id="uploadForm" class="uploadForm">
         	<script language="javascript" type="text/javascript" src="js/agenda.js"></script>
		<link type="text/css" href="jquery-ui-1.7.2.custom.css" rel="stylesheet" />	
		
		<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
		<link rel="stylesheet" href="jquery.ui.all.css">
		<script src="js/jquery-1.7.2.js"></script>
		
		<link rel="stylesheet" href="demos.css">
		<script type="text/javascript">
			$(function(){
	
                               
                                $('#waktu').datepicker({dateFormat:'yy-mm-dd'});
				
			});
		</script>
                <fieldset>
                    <dl>
                        <dt><label for="email">judul</label></dt>
                        <dd><input type="text" name="judul" id="judul" size="68" />
						<input type="hidden" name="aksi" id="aksi" value="input" size="68"  />
						<input type="hidden" name="posisi" id="posisi" value="1" size="68"  />
							<input type="hidden" name="id" id="id" value="id" size="68"  />
						  </dd>
						 <dd><div id="judul_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="email">deskripsi</label></dt>
                        <dd><input type="text" name="deskripsi" id="deskripsi" size="68" /></dd>
						<dd><div id="deskripsi_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="email">waktu</label></dt>
                        <dd><input type="text" name="waktu" id="waktu" size="68" /></dd>
						<dd><div id="waktu_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					<dl>
                        <dt><label for="email">tempat</label></dt>
                        <dd><input type="text" name="tempat" id="tempat" size="68" /></dd>
						<dd><div id="tempat_error" style="display:none; color : red;"><em>* form ini belum di isi</em></div></dd>
                    </dl>
					
                    
                    
                     <dl class="submit2">
                    <input type="submit" name="submit" id="submit" value="Simpan" />
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