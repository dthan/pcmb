/* 
   - search.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - Select styling	
	2 - Toggle checkboxes
   -->> --------------------------- */
   
jQuery(function($) { 

	// --->> 1 - Select styling --------------		
	$(".search_info select,.chbox input ").uniform();	
	
	$('.sort_by a').toggle(function() {
	  $(this).removeClass("icon-arrow-up").addClass("icon-arrow-down");
	}, function() {
	  $(this).removeClass("icon-arrow-down").addClass("icon-arrow-up");
	});

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

	$('.view_as a, .sort_by a').tooltip();

	$('.list_view').click(function(e) {
	  e.preventDefault();	
	  $('.list_view').removeClass("inaktiv");
	  $('.grid_view').addClass("inaktiv");

	  $('.grid_container').fadeOut(function(){
	  	$('.list_container').fadeIn();
	  });
	});

	$('.grid_view').click(function(e) {
	  e.preventDefault();
	  $('.grid_view').removeClass("inaktiv");
	  $('.list_view').addClass("inaktiv");

	  $('.list_container').fadeOut(function(){
	  	$('.grid_container').fadeIn();
	  });
	});
});
