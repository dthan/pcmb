/* 
   - tabs.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - Prettify setup	
	2 - Tooltip
	3 - Tabs Style switcher
	4 - Tabs	
   -->> --------------------------- */
   
jQuery(function($) { 

	/* --->> 1 - Prettify setup --------------*/	
	prettyPrint();

	/* --->> 2 - Tooltip --------------*/	
	$('.btn-group-cont .btn-group').tooltip();

	/* --->> 3 - Tabs Style switcher --------------*/		
	$("#posRight").click(function(){
		$("#tabStyles").removeClass("tabs-left").addClass("tabs-right");
		return false;
	});
	$("#posLeft").click(function(){
		$("#tabStyles").removeClass("tabs-right").addClass("tabs-left");
		return false;
	});

	$("#colorLight_1").click(function(){		
		changeStyleClass("#tabStyles .nav-tabs","tab_styled_dark","tab_styled_light", "#tabStyles .tab-content", "tab_content_dark", "tab_content_dark_2", "tab_content_light");
		return false;
	});

	$("#colorDark_1").click(function(){	
		changeStyleClass("#tabStyles .nav-tabs","tab_styled_light","tab_styled_dark", "#tabStyles .tab-content", "tab_content_light", "tab_content_dark_2", "tab_content_dark");
		return false;
	});

	$("#colorDark2_1").click(function(){	
		changeStyleClass("#tabStyles .nav-tabs","tab_styled_light","tab_styled_dark", "#tabStyles .tab-content", "tab_content_light", "tab_content_dark", "tab_content_dark_2");
		return false;
	});

	/* ----- */
	$("#colorLight_2").click(function(){		
		changeStyleClass("#tabStyles_2 .nav-tabs","tab_styled_dark","tab_styled_light", "#tabStyles_2 .tab-content", "tab_content_dark", "tab_content_dark_2", "tab_content_light");
		return false;
	});

	$("#colorDark_2").click(function(){	
		changeStyleClass("#tabStyles_2 .nav-tabs","tab_styled_light","tab_styled_dark", "#tabStyles_2 .tab-content", "tab_content_light", "tab_content_dark_2", "tab_content_dark");
		return false;
	});

	$("#colorDark2_2").click(function(){	
		changeStyleClass("#tabStyles_2 .nav-tabs","tab_styled_light","tab_styled_dark", "#tabStyles_2 .tab-content", "tab_content_light", "tab_content_dark", "tab_content_dark_2");
		return false;
	});

	/* --->> 4 - Tabs --------------*/			
	$( "#tabs, #tabs_2, #tabs_3" ).tabs();

});

function changeStyleClass(element_1,class1_1,class1_2, element_2, class2_1, class2_2, class2_3){
	$(element_1).removeClass(class1_1).addClass(class1_2);
	$(element_2).removeClass(class2_1).removeClass(class2_2).addClass(class2_3);
}