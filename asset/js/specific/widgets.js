/* 
   - widgets.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - Prettify setup		
  2 - Typeahead setup
  3 - Typeahead setup
  4 - Tags setup
  5 - Datepicker setup 
  6 - Colorpicker setup
  7 - Custom content scroller setup
  8 - Contact list setup
  9 - Modals
  10 - Widgets
   -->> --------------------------- */
   
jQuery(function($) { 

	/* --->> 1 - Prettify setup --------------*/	
	prettyPrint();

	/* --->> 2 - Typeahead setup --------------*/	
	$('#th_setup').typeahead({
    source:["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]
  });

	/* --->> 3 - Typeahead setup --------------*/	
	$('.typeahead_style').toggle(function() {
	  $('.typeahead_style').removeClass("btn-inverse").html("Light");
	  $("body").addClass("light_styled");	  
	}, function() {
	  $('.typeahead_style').addClass("btn-inverse").html("Dark");
	  $("body").removeClass("light_styled");
	});

  var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
  ];
  $( "#th_setup_ui" ).autocomplete({
      source: availableTags
  });

  /* --->> 4 - Tags setup --------------*/  
  $('#tag_setup' ).find('input.tag').tagedit({
    autocompleteURL: 'php/tagEditAutocomplete.php',
    autocompleteOptions: {minLength: 0}
  }); 


	/* --->> 5 - Datepicker setup --------------*/	
	$("#date_light").glDatePicker();
  $("#date_dark").glDatePicker({cssName: "dark"});

  $( "#datepicker_ui" ).datepicker();

  $('#timepicker').datetimepicker();  

  /* --->> 6 - Colorpicker setup --------------*/ 
  $('.color-picker-opacity').miniColors({
    opacity: true,
    change: function(hex, rgba) {
      $('#console').prepend('change: ' + hex + ', rgba(' + rgba.r + ', ' + rgba.g + ', ' + rgba.b + ', ' + rgba.a + ')<br>');
    },
    open: function(hex, rgba) {
      $('#console').prepend('open: ' + hex + ', rgba(' + rgba.r + ', ' + rgba.g + ', ' + rgba.b + ', ' + rgba.a + ')<br>');
    },
    close: function(hex, rgba) {
      $('#console').prepend('close: ' + hex + ', rgba(' + rgba.r + ', ' + rgba.g + ', ' + rgba.b + ', ' + rgba.a + ')<br>');
    }
  });

  $('#colorpickerField1').ColorPicker({
    onSubmit: function(hsb, hex, rgb, el) {
      $(el).val(hex);
      $(el).ColorPickerHide();
    },
    onBeforeShow: function () {
      $(this).ColorPickerSetColor(this.value);
    }
  })
  .bind('keyup', function(){
    $(this).ColorPickerSetColor(this.value);
  });

	/* --->> 7 - Custom content scroller setup --------------*/	
	$(".custom_scroller_container").mCustomScrollbar();

	/* --->> 8 - Contact list setup --------------*/	
	$('#slider').sliderNav();

	/* --->> 9 - Modals --------------*/	
	$( "#light_modal" ).click(function() {
      $( "#myModal").removeClass("modal_styled_dark").addClass("modal_styled_light");      
  });
  $( "#dark_modal" ).click(function() {
      $( "#myModal").removeClass("modal_styled_light").addClass("modal_styled_dark");     
  });	
	$( ".ui_dialog_l" ).dialog({
      autoOpen: false,
      show: "fade",
      hide: "fade",
      height: 400,
      width:500,
      dialogClass:"modal_styled_light_ui",
      modal: true
  });
  $( ".ui_dialog_d" ).dialog({
      autoOpen: false,
      show: "fade",
      hide: "fade",
      height: 400,
      width:500,
      dialogClass:"modal_styled_dark_ui",
      modal: true
  });
	$( "#light_modal_ui" ).click(function() {
			$( ".ui_dialog_l" ).dialog( "open" );
      return false;
  });

  $( "#dark_modal_ui" ).click(function() {
      $( ".ui_dialog_d" ).dialog( "open" );
      return false;
  });

  $( "#notification_1" ).click(function() {			
			$.jGrowl("Lorem ipsum dolor sit amet, consectetur adipisicing elit", { header: 'Notification - deafult style'});			
      return false;
  });
  
  $( "#notification_2" ).click(function() {			
			$.jGrowl("Lorem ipsum dolor sit amet, consectetur adipisicing elit", { header: 'Notification - light style', theme:"notification_styled_light" });			
      return false;
  });
  
  $( "#notification_3" ).click(function() {			
			$.jGrowl("Lorem ipsum dolor sit amet, consectetur adipisicing elit", { header: 'Notification - dark style', theme:"notification_styled_dark" });			
      return false;
  });  

  $( "#notification_4" ).click(function() {			
			$.jGrowl("Lorem ipsum dolor sit amet, consectetur adipisicing elit", { header: 'Warning', theme:"notification_styled_warning" });			
      return false;
  }); 

  $( "#notification_5" ).click(function() {			
			$.jGrowl("Lorem ipsum dolor sit amet, consectetur adipisicing elit", { header: 'Error', theme:"notification_styled_error" });			
      return false;
  }); 
  $( "#notification_6" ).click(function() {			
			$.jGrowl("Lorem ipsum dolor sit amet, consectetur adipisicing elit", { header: 'Success', theme:"notification_styled_success" });			
      return false;
  }); 
  $( "#notification_7" ).click(function() {			
			$.jGrowl("Lorem ipsum dolor sit amet, consectetur adipisicing elit", { header: 'Info', theme:"notification_styled_info" });			
      return false;
  });  
  
  /* --->> 10 - Widgets --------------*/  
  $(".knob").knob();

  $(".spark_widget").sparkline([4,8,6,5,6,7,9,9,5,7,9,3,2,8,2,4,6,7 ], 
  {
    type: 'line',
    width: '150px',
    height: '20px',
    lineColor: '#f2a29d',
    fillColor: '#f9bcb8',
    spotColor: '#ef271c',
    minSpotColor: '#ef271c',
    maxSpotColor: '#ef271c'
  });

  $( "#slider_1" ).slider({
        value: 30,
        orientation: "horizontal",
        range: "min",
        animate: true
  });



});
