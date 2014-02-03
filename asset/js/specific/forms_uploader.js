/* 
   - forms_uploader.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - File uploader - html5 version
	2 - Wysiwyg Editor		
   -->> --------------------------- */
   
jQuery(function($) { 

	// --->> 1 - File uploader - html5 version --------------		
	$("#html5_uploader").pluploadQueue({
		// General settings
		runtimes : 'html5',
		url : 'php/upload.php',
		max_file_size : '10mb',
		chunk_size : '1mb',
		unique_names : true,
		filters : [
			{title : "Image files", extensions : "jpg,gif,png"},
			{title : "Zip files", extensions : "zip"}
		],
		
		// Resize images on clientside if we can
		//resize : {width : 320, height : 240, quality : 90},
	})

	/* --->> 2 - Wysiwyg Editor --------------*/	
	$("#cleeditor").cleditor({width:"100%", height:"100%"})[0].focus();
});
