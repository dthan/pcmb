/* 
   - table_basic.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - Button styling setup
	2 - Toggle checkboxes		
   -->> --------------------------- */
   
jQuery(function($) { 

	/* --->> 1 - Button styling setup --------------*/
	$(".chbox input").uniform();

	/* --->> 2 - Toggle checkboxes --------------*/
	$("#check_1 thead input, #check_1 tfoot input").toggle(
	  function (e) {		  	
	  	e.preventDefault();
		$("#check_1 input").each(function(){
			$(this).attr("checked","checked");
			$.uniform.update(); 
		});
	  }, 
	  function (e){
		e.preventDefault();
		$("#check_1 input").removeAttr("checked");
		$.uniform.update(); 
	  }
	);
		
	$("#check_2 thead input, #check_2 tfoot input").toggle(
	  function (e) {		  	
	  	e.preventDefault();
		$("#check_2 input").each(function(){
			$(this).attr("checked","checked");
			$.uniform.update(); 
		});
	  }, 
	  function (e){
		e.preventDefault();
		$("#check_2 input").removeAttr("checked");
		$.uniform.update(); 
	  }
	);
		
	$(".sortable thead a").click(function(e){
		e.preventDefault();
	});
	
	
});
