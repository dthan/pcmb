/* 
   - profile.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - Uniform Setup	
	2 - Tooltip setup
	3 - Select setup
   -->> --------------------------- */
   
jQuery(function($) { 

	/* --->> 1 - Fileupload setup --------------*/	
	$(".profile_picture input, .status select, .notification_cont input").uniform();

	/* --->> 2 - Tooltip setup --------------*/	
	$('.profile_picture .btn').tooltip();
	
	/* --->> 3 - Select setup --------------*/	
	$('.sex').dropkick();

});
