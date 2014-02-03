/* 
   - mail.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - Form element styling	
	2 - Datatable setup
	3 - Tabs setup
	4 - Tagedit setup
	5 - Tab specific actions
   -->> --------------------------- */
   
jQuery(function($) { 
	
    /* --->> 1 - Form element styling --------------*/
	$(".chbox input").uniform();

	/* --->> 2 - Datatable setup --------------*/
	jQuery.extend( jQuery.fn.dataTableExt.oSort, {
	    "date-uk-pre": function ( a ) {
	        var ukDatea = a.split('/');
	        return (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
	    },
	 
	    "date-uk-asc": function ( a, b ) {
	        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
	    },
	 
	    "date-uk-desc": function ( a, b ) {
	        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
	    }
	} );

	oTable = $('.example').dataTable( {
		"sPaginationType": "full_numbers",		
    "aoColumns": [
      { "bSortable": false },
      { "bSortable": false },
      null,
      null,
      { "sType": "date-uk" },
      { "bSortable": false }
    ],
    "aoColumnDefs": [
      { "sWidth": "20%", "aTargets": [ 0 ] }
    ] 
  } );



	/* --->> 3 - Tabs setup --------------*/
	$('#mailTab a').click(function (e) {
	    e.preventDefault();
	    $(this).tab('show');
	     $('#mailTab a i').each(function(){
	     	$(this).removeClass("sweet-theme-on");
	     });
	    $(this).find("i").addClass("sweet-theme-on");
    })
    
	$('#mailTab li:nth-child(2) a').tab('show').find("i").addClass("sweet-theme-on");
	$('#inbox').addClass("active");

	$("#mailTab a").hover(
	  function () {
	    $(this).find("i").removeClass("sweet-gray").addClass("sweet-theme");
	  }, 
	  function () {
	    $(this).find("i").removeClass("sweet-theme").addClass("sweet-gray");
	  }
	);
     
	/* --->> 4 - Tagedit setup --------------*/
  $('.new_msg input.tag' ).tagedit({
		autocompleteURL: 'php/tagEditAutocomplete.php',
		autocompleteOptions: {minLength: 0}
	}); 

	$('.new_msg input.cc' ).tagedit({
		autocompleteURL: 'php/tagEditAutocomplete.php',
		autocompleteOptions: {minLength: 0}
	}); 

	$('.new_msg input.bcc' ).tagedit({
		autocompleteURL: 'php/tagEditAutocomplete.php',
		autocompleteOptions: {minLength: 0}
	}); 	

	$('#attach_file').click(function(){
		$(this).fadeOut(function(){
			$('.file_upload').fadeIn();	
		});
	});

	$('.file_upload .bezar').click(function(){
		$('.file_upload').fadeOut(function(){
			$('#attach_file').fadeIn();	
		});
	});
	
	$("#cleeditor").cleditor({width:"100%", height:"100%"})[0].focus();

	$('.cc_btn').toggle(function() {
		$(this).addClass('active');
	  $('.cc_cont').fadeIn();
	}, function() {
		$(this).removeClass('active');
	  $('.cc_cont').fadeOut();
	});

	$('.bcc_btn').toggle(function() {
		$(this).addClass('active');
	  $('.bcc_cont').fadeIn();
	}, function() {
		$(this).removeClass('active');
	  $('.bcc_cont').fadeOut();
	});

	$(".dataTables_length select").uniform();


	/* --->> 5 - Tab specific actions --------------*/

	/* --->> 1 - Toggle checkboxes --------------*/
	$("#inbox thead input, #inbox tfoot input").toggle(
	  function (e) {		  	
	  	e.preventDefault();
		$("#inbox input").each(function(){
			$(this).attr("checked","checked");
			$.uniform.update(); 
		});
	  }, 
	  function (e){
		e.preventDefault();
		$("#inbox input").removeAttr("checked");
		$.uniform.update(); 
	  }
	);

	/* --->> 2 - Show mail details --------------*/
	$("#inbox tbody a, #inbox tbody a").click(
	  function (e) {		  	
	  	e.preventDefault();
			$("#inbox .dataTables_wrapper").slideUp(function(){
				$("#inbox .message_details").slideDown();
			})
	  }	 
	);
	
	$("#inbox .message_details .first .back").click(
	  function (e) {		  	
	  	e.preventDefault();
			$("#inbox .message_details").slideUp(function(){
				$("#inbox .dataTables_wrapper").slideDown();
			})
	  }	 
	);

	/* --->> 1 - Toggle checkboxes --------------*/
	$("#outbox thead input, #outbox tfoot input").toggle(
	  function (e) {		  	
	  	e.preventDefault();
		$("#outbox input").each(function(){
			$(this).attr("checked","checked");
			$.uniform.update(); 
		});
	  }, 
	  function (e){
		e.preventDefault();
		$("#outbox input").removeAttr("checked");
		$.uniform.update(); 
	  }
	);

	/* --->> 2 - Show mail details --------------*/
	$("#outbox tbody a, #outbox tbody a").click(
	  function (e) {		  	
	  	e.preventDefault();
			$("#outbox .dataTables_wrapper").slideUp(function(){
				$("#outbox .message_details").slideDown();
			})
	  }	 
	);
	
	$("#outbox .message_details .first .back").click(
	  function (e) {		  	
	  	e.preventDefault();
			$("#outbox .message_details").slideUp(function(){
				$("#outbox .dataTables_wrapper").slideDown();
			})
	  }	 
	);

	/* --->> 1 - Toggle checkboxes --------------*/
	$("#spam thead input, #spam tfoot input").toggle(
	  function (e) {		  	
	  	e.preventDefault();
		$("#spam input").each(function(){
			$(this).attr("checked","checked");
			$.uniform.update(); 
		});
	  }, 
	  function (e){
		e.preventDefault();
		$("#spam input").removeAttr("checked");
		$.uniform.update(); 
	  }
	);

	/* --->> 2 - Show mail details --------------*/
	$("#spam tbody a, #spam tbody a").click(
	  function (e) {		  	
	  	e.preventDefault();
			$("#spam .dataTables_wrapper").slideUp(function(){
				$("#spam .message_details").slideDown();
			})
	  }	 
	);
	
	$("#spam .message_details .first .back").click(
	  function (e) {		  	
	  	e.preventDefault();
			$("#spam .message_details").slideUp(function(){
				$("#spam .dataTables_wrapper").slideDown();
			})
	  }	 
	);

	/* --->> 1 - Toggle checkboxes --------------*/
	$("#trash thead input, #trash tfoot input").toggle(
	  function (e) {		  	
	  	e.preventDefault();
		$("#trash input").each(function(){
			$(this).attr("checked","checked");
			$.uniform.update(); 
		});
	  }, 
	  function (e){
		e.preventDefault();
		$("#trash input").removeAttr("checked");
		$.uniform.update(); 
	  }
	);

	/* --->> 2 - Show mail details --------------*/
	$("#trash tbody a, #trash tbody a").click(
	  function (e) {		  	
	  	e.preventDefault();
			$("#trash .dataTables_wrapper").slideUp(function(){
				$("#trash .message_details").slideDown();
			})
	  }	 
	);
	
	$("#trash .message_details .first .back").click(
	  function (e) {		  	
	  	e.preventDefault();
			$("#trash .message_details").slideUp(function(){
				$("#trash .dataTables_wrapper").slideDown();
			})
	  }	 
	);

});
