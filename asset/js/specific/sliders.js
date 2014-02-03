/* 
   - sliders.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - Prettify setup
    2 - Uniform form styling
    3 - Sliders setup		
   -->> --------------------------- */
   
jQuery(function($) { 

	/* --->> 1 - Prettify setup --------------*/	
	prettyPrint();

	/* --->> 2 - Uniform form styling --------------*/	
	$("#minbeds").uniform();

	/* --->> 3 - Sliders setup --------------*/
		/* ------- Horizontal ------- */
	 	$( "#slider_1" ).slider({
	      value: 30,
	      orientation: "horizontal",
	      range: "min",
	      animate: true
	 	});

	 	/* ------- Vertical ------- */
	 	$( "#slider_2" ).slider({
		    orientation: "vertical",
		    range: "min",
		    min: 0,
		    max: 100,
		    value: 60,		    
		});

	 	/* ------- Range with fixed minimum ------- */
	 	var select = $( "#minbeds" );
    var slider = $( "<div id='slider' class='slider_styled'></div>" ).insertAfter("#slider_txt_1").slider({
        min: 1,
        max: 6,
        range: "min",
        value: select[ 0 ].selectedIndex + 1,
        slide: function( event, ui ) {
            select[ 0 ].selectedIndex = ui.value - 1;
        }
    });
    $( "#minbeds" ).change(function() {
        slider.slider( "value", this.selectedIndex + 1 );
    });

    /* ------- Range horizontal ------- */
    $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 500,
        values: [ 75, 300 ],
        slide: function( event, ui ) {
            $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
        " - $" + $( "#slider-range" ).slider( "values", 1 ) );

    /* ------- Range vertical ------- */
    $( "#slider-range-v" ).slider({
        orientation: "vertical",
        range: true,
        values: [ 17, 67 ],
        slide: function( event, ui ) {
            $( "#amount_v" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        }
    });
    $( "#amount_v" ).val( "$" + $( "#slider-range-v" ).slider( "values", 0 ) +
        " - $" + $( "#slider-range-v" ).slider( "values", 1 ) );

    /* ------- Snap to increments ------- */
    $( "#slider-inc" ).slider({
        value:100,
        min: 0,
        max: 500,
        step: 50,
        slide: function( event, ui ) {
            $( "#amount_inc" ).val( "$" + ui.value );
        }
    });
    $( "#amount_inc" ).val( "$" + $( "#slider-inc" ).slider( "value" ) );

		/* ------- Styled ------- */

		var colors=[20,30,40,50,60,70,80,90]; 

		for (x in colors)
	  {	  	
	  	console.log(x+"-"+colors[x]);
	  	$( "#slider_colored_"+x ).slider({
		      value: colors[x],	      
		      range: "min",
		      animate: true
		 	});
	  }

   
});
