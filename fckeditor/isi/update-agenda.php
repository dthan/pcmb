 <div class="right_content">   
  <h2>Update Agenda</h2>
     
         <div class="form">
		 <link type="text/css" href="jquery-ui-1.7.2.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
		<script type="text/javascript">
			$(function(){
	
                               // bufferdie love m...
                                $('#waktu').datepicker();
				
			});
		</script>

         <form action="input-agenda" method="post" class="niceform" onSubmit="javascript:validasiAgenda();">
         
                <fieldset>
                    <dl>
                        <dt><label for="email">judul</label></dt>
                        <dd><input type="text" name="judul_agenda" id="judul" size="68" /></dd>
                    </dl>
					<dl>
                        <dt><label for="email">deskripsi</label></dt>
                        <dd><input type="text" name="deskripsi" id="deskripsi" size="68" /></dd>
                    </dl>
					<dl>
                        <dt><label for="email">waktu</label></dt>
                        <dd><input type="text" name="waktu" id="waktu" size="68" /></dd>
                    </dl>
					<dl>
                        <dt><label for="email">tempat</label></dt>
                        <dd><input type="text" name="tempat" id="tempat" size="68" /></dd>
                    </dl>
                    
                    
                     <dl class="submit2">
                    <input type="submit" name="submit" id="submit" value="Simpan" />
                     </dl>
                         
                </fieldset>
                
         </form>
		 
         </div>  
    </div>
	