 <div class="right_content">   
  <h2>Edit Agenda</h2>
     
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

         <form action="update-agenda" method="post" class="niceform" onSubmit="javascript:validasiAgenda();">
         
              
					 <?php
					$data = $_REQUEST['id_agenda'];
					$query = "select judul_agenda, no, id_lembaga, deskripsi, waktu, tempat from agenda where id_agenda = '$id_agenda';";
					$query_jalan = mysql_query($query);
					while($data = mysql_fetch_array($query_jalan))
						{
							echo "<dl><dt><label for='email'>judul</label></dt><dd><input type='text' name='judul_agenda' id='judul' size='68' /></dd></dl>".$data['judul_agenda']."'></td></tr>";
							echo "<dl><dt><label for='email'>deskripsi</label></dt><dd><input type='text' name='deskripsi' id='deskripsi' size='68' /></dd></dl>".$data['deskripsi']."'></td></tr>";
							echo "<dl><dt><label for='email'>waktu</label></dt><dd><input type='text' name='waktu' id='waktu' size='68' /></dd></dl>".$data['waktu']."'></td></tr>";
							echo "<dl><dt><label for='email'>tempat</label></dt><dd><input type='text' name='tempat' id='tempat' size='68' /></dd></dl>".$data['tempat']."'></td></tr>";
							echo "<input type='hidden' name='id_agenda' value='$id_agenda'>";
							echo "<tr><td><input type='submit' value='simpan'></td></tr>";
						}
				?>
                         
                </fieldset>
                
         </form>
		 
         </div>  
    </div>
	