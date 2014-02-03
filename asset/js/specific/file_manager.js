/* 
   - file_manager.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - File manager setup 	
   -->> --------------------------- */
   
jQuery(function($) { 

	// --->> 1 - File manager setup --------------	
	var elf = $('#elfinder').elfinder({
		url : 'php/connector.php',  // connector URL (REQUIRED)
		//lang: 'hu',             // language (OPTIONAL)
		uiOptions : {			
			toolbar : [
				['back', 'forward'],
				['open', 'getfile'],
				['info'],
				['quicklook'],
				['search'],
				['view']
			]
		},
		contextmenu : {
			navbar : ['open', '|', 'info'],			
			cwd : ['reload', 'delim', 'info'],			
			files : ['select', 'open']
		} 
	}).elfinder('instance');
	
});

