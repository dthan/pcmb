/* 
   - tooltips_popovers.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - Prettify setup	
	2 - Tooltip and Popovers - Bootstrap	
	3 - Tooltip - clueTip
   -->> --------------------------- */
   
jQuery(function($) { 

	/* --->> 1 - Prettify setup --------------*/	
	prettyPrint();

	/* --->> 2 -  Tooltip and Popovers - Bootstrap --------------*/	
	$('#tt_cont button').tooltip();
	$('#po_cont a').popover({ trigger:'hover'});

	/* --->> 3 -  Tooltip - clueTip --------------*/	
	$('#tt_clue_1').cluetip({splitTitle: '|'});
	$('#tt_clue_2').cluetip();
	$('#tt_clue_3').cluetip({width: '200px', showTitle: false});	
	$('#tt_clue_4').cluetip({sticky: true, closePosition: 'title', arrows: true});
	$('.tt_clue_5').cluetip({attribute: 'id', hoverClass: 'highlight'});

});
