/* 
   - gallery.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - Basic gallery options show/hide
	2 - Basic gallery setup
	3 - Delete images		
   -->> --------------------------- */
   
jQuery(function($) { 

	/* --->> 1 - Basic gallery options show/hide --------------*/	
	$("#basicGallery > li").hoverIntent(
	  function () {		
		$(this).find("div").fadeIn("fast");
	  }, 
	  function () {
		$(this).find("div").fadeOut("fast");
	  }
	);
	
	/* --->> 2 - Basic gallery setup --------------*/  
	$("#basicGallery .view a").colorbox({rel:'gal'});  
	
	/* --->> 3 - Delete images --------------*/  
	$(".delete").click(function(){
		$(this).parents("li").fadeOut().remove();
	});
	
});
