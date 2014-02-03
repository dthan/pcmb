/* 
   - index.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - Line chart
	2 - Button styling setup
	3 - Checkbox styling 
	4 - Datatable setup
	5 - Calendar setup
	6 - Prettify setup
	7 - Other
   -->> --------------------------- */
   
jQuery(function($) { 
	
	/* --->> 1 - Line chart --------------*/

	var sin = [], cos = [];
    for (var i = 0; i < 14; i += 0.5) {
        sin.push([i, Math.sin(i)]);
        cos.push([i, Math.cos(i)]);
    }

	var chart = $("#chart");

    var plot1 = $.plot(chart,
	   [ { data: sin, label: "sin(x)",color: "#f26c4f"}, { data: cos, label: "cos(x)", color: "#8dc63f" } ], {
		   series: {			  
			   lines: { show: true },
			   points: { show: true }
		   },
		   grid: { hoverable: true, clickable: true,  backgroundColor: '#f8f8f8', borderWidth: 1, borderColor: '#d5d5d5' },		   
		   yaxis: { min: -1.3, max: 1.3 },
		   legend: {
			labelBoxBorderColor: '#d5d5d5',
			noColumns: 2			
		  }
	});

	function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 5,
            left: x + 5,
			color: '#545454',
            border: '1px solid #d5d5d5',
            padding: '4px 6px',
			'font-size': '11px',
			'border-radius': '2px',
            'background-color': '#f3f3f3',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }

    var previousPoint = null;
    chart.bind("plothover", function (event, pos, item) {
        $("#x").text(pos.x.toFixed(2));
        $("#y").text(pos.y.toFixed(2));
				
            if (item) {                
				if (previousPoint != item.dataIndex) {
					previousPoint = item.dataIndex;
					
					$("#tooltip").remove();
					var x = item.datapoint[0].toFixed(2),
						y = item.datapoint[1].toFixed(2);
					
					showTooltip(item.pageX, item.pageY,
								item.series.label + " of " + x + " = " + y);
				}
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;            
            }
    });	
	
    chart.bind("plotclick", function (event, pos, item) {
        if (item) {			
            plot1.highlight(item.series, item.datapoint);
			showNotification("You clicked point " + item.dataIndex + " in " + item.series.label + ".", "Line chart info");            
        }
    });

    /* --->> 2 - Button styling setup --------------*/
	$(".chbox input").uniform();

    /* --->> 3 - Checkbox styling --------------*/
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

	/* --->> 4 - Datatable setup --------------*/
	oTable = $('#example').dataTable({		
		"sPaginationType": "full_numbers"
	});
	$(".dataTables_length select").uniform();


	
	/* --->> 5 - Calendar setup ------- */ 
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();

	$('#calendar').fullCalendar({		
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		editable: true,
		droppable: true, // this allows things to be dropped onto the calendar !!!
		drop: function(date, allDay) { // this function is called when something is dropped
			
			// retrieve the dropped element's stored Event Object
			var originalEventObject = $(this).data('eventObject');
			
			// we need to copy it, so that multiple events don't have a reference to the same object
			var copiedEventObject = $.extend({}, originalEventObject);
			
			// assign it the date that was reported
			copiedEventObject.start = date;
			copiedEventObject.allDay = allDay;
			
			// render the event on the calendar
			// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
			$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			
			// is the "remove after drop" checkbox checked?
			if ($('#drop-remove').is(':checked')) {
				// if so, remove the element from the "Draggable Events" list
				$(this).remove();
			}
			
		},
		events: [
			{
				title: 'All Day Event',
				start: new Date(y, m, 1)
			},
			{
				title: 'Long Event',
				start: new Date(y, m, d-5),
				end: new Date(y, m, d-2)
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: new Date(y, m, d-3, 16, 0),
				allDay: false
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: new Date(y, m, d+4, 16, 0),
				allDay: false
			},
			{
				title: 'Meeting',
				start: new Date(y, m, d, 10, 30),
				allDay: false
			},
			{
				title: 'Lunch',
				start: new Date(y, m, d, 12, 0),
				end: new Date(y, m, d, 14, 0),
				allDay: false
			},
			{
				title: 'Birthday Party',
				start: new Date(y, m, d+1, 19, 0),
				end: new Date(y, m, d+1, 22, 30),
				allDay: false
			},
			{
				title: 'Click for Google',
				start: new Date(y, m, 28),
				end: new Date(y, m, 29),
				url: 'http://google.com/'
			}
		]
	});

	/* --->> 6 - Prettify setup --------------*/	
	prettyPrint();

	/* --->> 7 - Other --------------*/    
	$(".chzn-select").chosen({allow_single_deselect:true}); 
	$('.dropkick').dropkick();

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

  $( "#notification_1" ).click(function() {			
			$.jGrowl("Lorem ipsum dolor sit amet, consectetur adipisicing elit", { header: 'Notification - deafult style'});			
      return false;
  });

  $( "#notification_2" ).click(function() {			
			$.jGrowl("Lorem ipsum dolor sit amet, consectetur adipisicing elit", { header: 'Error', theme:"notification_styled_error" });			
      return false;
  }); 
  $( "#notification_3" ).click(function() {			
			$.jGrowl("Lorem ipsum dolor sit amet, consectetur adipisicing elit", { header: 'Success', theme:"notification_styled_success" });			
      return false;
  }); 

  $(".custom_scroller_container").mCustomScrollbar();

});
