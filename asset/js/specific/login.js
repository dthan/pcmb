/* 
   - login.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - Remember button styling	
	2 - Login content switcher	
   -->> --------------------------- */
   
jQuery(function($) { 

	// --->> 1 - Remember button styling --------------		
	$(".remember").uniform();

	$("input").focus(function(){ $(this).parents("fieldset").find("label").addClass("hover"); });
	$("input").blur(function(){ $(this).parents("fieldset").find("label").removeClass("hover"); });
	
	// --->> 2 - Login content switcher	--------------
    if($.browser.msie && $.browser.version == '8.0')
    {   
    	$(".login_switcher").hover(
		    function (e) {
		      e.preventDefault();
		      $(this).animate({ height: '+=60px' });
		    }, 
		    function (e) {
		      e.preventDefault();
		      $(this).animate({ height: '-=60px' });
		    }
		  ); 

			$(".login_social .left, .login_social .right").hover(
		    function (e) {
		      e.preventDefault();
		      $(this).find(".info").fadeIn("fast");
		    }, 
		    function (e) {
		      e.preventDefault();
		      $(this).find(".info").fadeOut("fast");
		    }
		  ); 
    }    
	else{

		$(".login_switcher").hoverIntent(
	    function (e) {
	      e.preventDefault();
	      $(this).animate({ height: '+=60px' });
	    }, 
	    function (e) {
	      e.preventDefault();
	      $(this).animate({ height: '-=60px' });
	    }
	  ); 

		$(".login_social .left, .login_social .right").hoverIntent(
	    function (e) {
	      e.preventDefault();
	      $(this).find(".info").fadeIn("fast");
	    }, 
	    function (e) {
	      e.preventDefault();
	      $(this).find(".info").fadeOut("fast");
	    }
	  ); 
	}
	
	var akt = ".login";

	$(".login_l").click(function(){
		$(akt).hide("clip",function(){
			  $(".login").show("clip"); 	
			  akt = ".login";
  	});
	});

	$(".login_s").click(function(){
		$(akt).hide("clip",function(){
			  $(".sign_up").show("clip"); 	
			  akt = ".sign_up";
  	});
	});

	$(".login_f").click(function(){
		$(akt).hide("clip",function(){
			  $(".forgot").show("clip"); 	
			  akt = ".forgot";
  	});
	});

	jQuery(".formClass").validationEngine({promptPosition : "centerRight", scroll: false, showOneMessage:true, autoPositionUpdate:true});


});
