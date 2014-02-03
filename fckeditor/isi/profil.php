<div class="right_content">  
<div><h2>Profil Yayasan Mukhisiina lahudiin</h2></div>
<?php 
			include("../fckeditor.php") ;
						
			
// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
$sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath	= 'http://localhost/mukhlisin/admin/fckeditor/';
$oFCKeditor->Value		= '<p>This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.</p>' ;
$oFCKeditor->Create() ;
?>

         <form method="post" action="isi/upload.php" id="uploadForm" class="uploadForm">
          	<fieldset>	

                     		
		           <dl>
                        <dt><label for="comments"></label></dt>
                        <dd><textarea id="isi"  name="isi_berita" rows="25" cols="60" style="width: 130px;"></textarea>
                        <div id="isi_error" style="display:none; color : red;"><em>* isi berita belum di isi</em></div></dd>
					</dl>
					 <dl class="submit2">
                    <input type="submit" id="simpan" value="edit"/>
                     </dl>
			</fieldset>
                
         </form>
 </div>
</div>