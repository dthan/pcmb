/* 
   - forms_elements.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - Prettify setup
	2 - Uniform form styling
  3 - Tooltips	
  4 - Popovers	
  5 - Masked inputs
  6 - Selects
  7 - Textareas
  8 - Spinners
  9 - OS Styling 
  Functions
   -->> --------------------------- */
   
jQuery(function($) { 

	/* --->> 1 - Prettify setup --------------*/	
	prettyPrint();

	/* --->> 2 - Uniform form styling --------------*/	
	$(".uniform_styled input,.uniform_styled textarea,.uniform_styled select,.uniform_styled button").uniform();

	/* --->> 3 - Tooltips --------------*/	
	$('.tooltip_cont input').tooltip();

	/* --->> 4 - Popovers --------------*/	
	$('.popover_cont input').popover({
			trigger:'hover'
	});

	/* --->> 5 - Masked inputs --------------*/	
  $.mask.definitions['~']='[+-]';
  $('#date').mask('99/99/9999');
  $('#phone').mask('(999) 999-9999');
  $('#phoneext').mask("(999) 999-9999? x99999");
  $("#tin").mask("99-9999999");
  $("#ssn").mask("999-99-9999");
  $("#product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
  $("#eyescript").mask("~9.99 ~9.99 999");

  /* --->> 6 - Selects --------------*/
  $(".chzn-select").chosen({allow_single_deselect:true}); 
  $('.dropkick').dropkick();

  $('#searchable').multiSelect({
    selectableHeader: "<div class='multi_header'><h2>Selectable items</h2> <a id='select-all' class='btn-sel btn btn-small' href='#' >select all</a> <a class='btn_delete btn btn-small' href='#'><span class='icon-gray icon-remove'>&nbsp;</span></a> </div><input type='text' id='search_selectable' autocomplete='off' placeholder='search selectable items'>",
    selectedHeader: "<div class='multi_header'><h2>Selected items</h2> <a id='deselect-all' class='btn-sel btn btn-small' href='#' >deselect all</a><a class='btn_delete btn btn-small' href='#'><span class='icon-gray icon-remove'>&nbsp;</span></a></div><input type='text' id='search_selected' autocomplete='off' placeholder='search selected items'>",
    afterSelect: function(value, text){ $('#search_selected').quicksearch('.ms-selection li'); }
  });

  $('#search_selectable').quicksearch('.ms-selectable li').on('keydown', function(e){
    if (e.keyCode == 40){
      $(this).trigger('focusout');
      $('#searchable').focus();
      return false;
    }
  });

  $('#search_selected').quicksearch('.ms-selection li').on('keydown', function(e){
    if (e.keyCode == 40){
      $(this).trigger('focusout');
      $('#searchable').focus();
      return false;
    }
  });

  $('#select-all').click(function(e){
    e.preventDefault();
    $('#searchable').multiSelect('select_all');
    $('#search_selected').quicksearch('.ms-selection li');
    return false;
  });
  $('#deselect-all').click(function(e){
    e.preventDefault();
    $('#searchable').multiSelect('deselect_all');
    return false;
  });
  
  $(".ms-selectable input").focus(function(){ toggleDeleteBtn($(this),true); });
  $(".ms-selectable input").blur(function(){ toggleDeleteBtn($(this),false); });

  $(".ms-selection input").focus(function(){ toggleDeleteBtn($(this),true); });
  $(".ms-selection input").blur(function(){ toggleDeleteBtn($(this),false); });

  $(".ms-selectable .btn_delete").click(function(e){ emptyInput($(this),e,".ms-selectable",'#search_selectable'); });
  $(".ms-selection  .btn_delete").click(function(e){ emptyInput($(this),e,".ms-selection",'#search_selected'); });

  /* --->> 7 - Textareas --------------*/
  $(".autogrow").autoGrow();

  var options2 = {
      'maxCharacterSize': 200,
      'originalStyle': 'originalTextareaInfo',
      'warningStyle' : 'warningTextareaInfo',
      'warningNumber': 40,
      'displayFormat' : '#input/#max | #words words'
  };
  $('.counter_textarea').textareaCount(options2);


  /* --->> 8 - Spinners --------------*/
  $('#spinner_1').spinner({ min: -100, max: 100 });
  $('#spinner_2').spinner({ min: -1000, max: 1000, increment: 'fast' });
  $('#spinner_3').spinner({ min: 0, max: 100, showOn: 'both' });  
  $('#spinner_4').spinner({prefix: '$', group: ',', largeStep: 1, min: -1000000, max: 1000000});
  $('#spinner_5').spinner({ step: 0.001, min: -100, max: 100});
  $('#spinner_6').spinner({ min: -100, max: 100 });

  /* --->> 9 - OS Styling --------------*/
  $(".os_chbox").iButton();
  $(".os_chbox_effect").iButton({
     labelOn: "On"
   , labelOff: "Off"   
   , easing: 'easeOutBounce'
   , duration: 500
  });
  $(".os_radio").iButton({allowRadioUncheck: true});



});

/* --->> Functions --------------*/
function toggleDeleteBtn(element,t_value){
  if(t_value){
    $(element).parent().find(".btn_delete").fadeIn(); 
  }else{
    if($(element).val() == ""){
      $(element).parent().find(".btn_delete").fadeOut();
    }
  }
}

function emptyInput(element,e,parentElement,parentId){
  e.preventDefault();
  $(element).parents(parentElement).find("input").val('');
  $(element).fadeOut();
  $(parentId).quicksearch(parentElement+' li');
}