/* 
   - progressbars.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - Prettify setup	
	2 - Progressbar	
   -->> --------------------------- */
   
jQuery(function($) { 

	/* --->> 1 - Prettify setup --------------*/	
	prettyPrint();

	/* --->> 2 - Progressbar --------------*/			
	$( "#progressbar" ).progressbar({ value: 20 });
	$( "#progressbar_1" ).progressbar({ value: 30 });
	$( "#progressbar_2" ).progressbar({ value: 10 });
	$( "#progressbar_3" ).progressbar({ value: 20 });
	$( "#progressbar_4" ).progressbar({ value: 30 });
	$( "#progressbar_5" ).progressbar({ value: 40 });
	$( "#progressbar_6" ).progressbar({ value: 50 });
	$( "#progressbar_7" ).progressbar({ value: 60 });
	$( "#progressbar_8" ).progressbar({ value: 70 });
	$( "#progressbar_9" ).progressbar({ value: 80 });
	$( "#progressbar_10" ).progressbar({ value: 90 });

});
