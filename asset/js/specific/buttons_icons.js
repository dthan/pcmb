/* 
   - buttons_icons.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - Tabs setup
	2 - Prettify setup		
   -->> --------------------------- */
   
jQuery(function($) { 

	/* --->> 1 - Tabs setup --------------*/
	$('#myTab a').click(function (e) {
	    e.preventDefault();
	    $(this).tab('show');
    })
	
	/* --->> 2 - Prettify setup --------------*/	
	prettyPrint();
});
