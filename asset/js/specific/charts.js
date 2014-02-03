/* 
   - charts.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - Line chart 
	2 - Stacked chart (2 types)	
	3 - Basic chart with real time updates 
	4 - Donut
	5 - Basic chart	
	6 - Sidebar Chart		
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
	   [ { data: sin, label: "sin(x)",color: "#CC2738"}, { data: cos, label: "cos(x)", color: "#FFD10F" } ], {
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
	
    /* --->> 2 - Stacked chart (2 types) --------------*/	
		var d1 = [];
    for (var i = 0; i <= 10; i += 1)
        d1.push([i, parseInt(Math.random() * 30)]);

    var d2 = [];
    for (var i = 0; i <= 10; i += 1)
        d2.push([i, parseInt(Math.random() * 30)]);

    var d3 = [];
    for (var i = 0; i <= 10; i += 1)
        d3.push([i, parseInt(Math.random() * 30)]);

    var bars = true, lines = false;
    var chart5 = $("#chart2");
	var plot5 = "";
    function plotWithOptions() {
       plot5 =  $.plot(chart5, [ d1, d2, d3 ], {
            series: {
                stack: true,
                lines: { show: lines, fill: true },
                bars: { show: bars, barWidth: 0.6 ,lineWidth: 1}
            },
			colors: ["rgba(47,219,168,0.9)","rgba(37,117,148,0.9)", "rgba(14,34,61,0.9)"],
			grid: { hoverable: true, clickable: true,  backgroundColor: '#f8f8f8', borderWidth: 1, borderColor: '#d5d5d5' }		   
        });
    }

	chart5.bind("plotclick", function (event, pos, item) {
        if (item) {			
            plot5.highlight(item.series, item.datapoint);
			showNotification("You clicked point " + item.dataIndex, "Stacked chart info");            
        }
    });

    plotWithOptions();
	    
	/* ------- Switch graph style ------- */
	$('#change_graph').toggle(function() {
	  $(this).addClass("off");		
	  bars = false;
      lines = true;
      plotWithOptions();
	}, function() {
  	  $(this).removeClass("off"); 
	  bars = true
      lines = false;
      plotWithOptions();
	});

	/* --->> 3 - Basic chart with real time updates --------------*/
	var data = [], totalPoints = 300;
    function getRandomData() {
        if (data.length > 0)
            data = data.slice(1);

        // do a random walk
        while (data.length < totalPoints) {
            var prev = data.length > 0 ? data[data.length - 1] : 50;
            var y = prev + Math.random() * 10 - 5;
            if (y < 0)
                y = 0;
            if (y > 100)
                y = 100;
            data.push(y);
        }

        // zip the generated y values with the x values
        var res = [];
        for (var i = 0; i < data.length; ++i)
            res.push([i, data[i]])
        return res;
    }

    // setup control widget
    var updateInterval = 50;
	
    // setup plot
    var options = {
		colors: ["#A072DE"],
        series: { 
			shadowSize: 0,
			lines: { show: true , fill: true, fillColor: { colors: [ { opacity: 0.12 }, { opacity: 0.6 } ] }}
		}, 
        yaxis: { min: 0, max: 100 },
        xaxis: { show: false },
		grid: { backgroundColor: '#f8f8f8', borderWidth: 1, borderColor: '#d5d5d5' }		
    };

    var plot4 = $.plot($("#chart3"), [ getRandomData() ], options);

    function update() {
        plot4.setData([ getRandomData() ]);
        // since the axes don't change, we don't need to call plot.setupGrid()
        plot4.draw();        
        setTimeout(update, updateInterval);
    }
    update();

	/* --->> 4.1 - Donut --------------*/
	var dataPie = [];
	var series = 5;
	var pieContainer = $("#chart4_1");
	for( var i = 0; i<series; i++)
	{
		dataPie[i] = { label: "Series"+(i+1), data: Math.floor(Math.random()*100)+1 }
	}
	
	function redrawPieChart(){
		$.plot(pieContainer, dataPie, 
		{
			series: {
				pie: { 
					show: true,
					radius: 1,					
					innerRadius: 0.4,				
					label: {
						show: true,
						radius: 1,
						formatter: function(label, series){
							return '<div class="flot_pie">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
						},					
						background: { opacity: 0.6 }
					},
					stroke:{
						color:'#E6966D',
						width:1
					}			
				}
			},
			legend: {
				show: false	
			},		
			colors: [ 'rgba(64,45,51,0.6)', 'rgba(153,87,83,0.6)', 'rgba(230,150,109,0.6)', 'rgba(242,201,138,0.6)', 'rgba(255,239,170,0.6)'],		
			grid: {			
				hoverable: true,
				clickable: true
			}		
		});
	}
	
	redrawPieChart();
	
	pieContainer.resize(function () { $(this).empty(); redrawPieChart(); });	
	pieContainer.bind("plothover", pieHover);
	pieContainer.bind("plotclick", pieClick);	
	
	/* --->> 4.2 - Donut --------------*/
	var dataPie = [];
	var series = 5;
	var pieContainer_2 = $("#chart4_2");
	for( var i = 0; i<series; i++)
	{
		dataPie[i] = { label: "Series"+(i+1), data: Math.floor(Math.random()*100)+1 }
	}
	
	function redrawPieChart_2(){
		$.plot(pieContainer_2, dataPie, 
		{
			series: {
				pie: { 
					show: true,
					radius: 3000,													
					label: {
						show: true,
						radius: 1,
						formatter: function(label, series){
							return '<div class="flot_pie_1">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
						},					
						background: { opacity: 0.6 }
					},
					stroke:{
						color:'#2969A1',
						width:1
					}			
				}
			},
			legend: {
				show: false	
			},		
			colors: [ 'rgba(127,189,201,0.8)', 'rgba(40,166,199,0.8)', 'rgba(0,156,200,0.8)', 'rgba(0,129,190,0.8)', 'rgba(41,105,161,0.8)'],		
			grid: {			
				hoverable: true,
				clickable: true
			}		
		});
	}
	
	redrawPieChart_2();
	
	pieContainer_2.resize(function () { $(this).empty(); redrawPieChart_2(); });	
	pieContainer_2.bind("plothover", pieHover);
	pieContainer_2.bind("plotclick", pieClick);
	
	/* --->> 4.3 - Donut --------------*/
	var dataPie = [];
	var series = 5;
	var pieContainer_3 = $("#chart_w_1");
	for( var i = 0; i<series; i++)
	{
		dataPie[i] = { label: "Series"+(i+1), data: Math.floor(Math.random()*100)+1 }
	}
	
	function redrawPieChart_3(){
		$.plot(pieContainer_3, dataPie, 
		{
			series: {
				pie: { 
					show: true,
					radius: 1,										
					label: {
						show: false					
					},
					stroke:{
						color:'#AEC49E',
						width:1
					}			
				}
			},
			legend: {
				show: false	
			},		
			colors: [ '#CCDDB9', '#BCD0AB', '#AEC49E', '#98B692', '#84A56A'],		
			grid: {			
				hoverable: true,
				clickable: true
			}		
		});
	}
	
	redrawPieChart_3();
	
	pieContainer_3.resize(function () { $(this).empty(); 	redrawPieChart_3(); });	
	pieContainer_3.bind("plothover", pieHover);
	pieContainer_3.bind("plotclick", pieClick);	

	function pieHover(event, pos, obj) 
	{
		if (!obj) return;
		percent = parseFloat(obj.series.percent).toFixed(2);		
	}
	
	function pieClick(event, pos, obj) 
	{
		if (!obj) return;
		percent = parseFloat(obj.series.percent).toFixed(2);
		showNotification(''+obj.series.label+' has '+percent+'%', "Pie chart Info");       
	}


	/* --->> 5 - Basic chart --------------*/
	var d1 = [[0, 8], [2, 1], [4, 8], [6, 2], [8, 6], [10, 3]]; 
	var d2 = [[0, 2], [2, 7], [4, 2], [6, 4], [8, 1], [10, 9] ]; 
	
	var chart3 = $("#chart5");
	
	var plot3 = $.plot(chart3, [{ data: d1, label: "CSS2.1"}, { data: d2, label: "CSS3"}], 
	{
		colors: ["#8CEB54", "#5E9E38"],
        series: { 
			shadowSize: 0,
			lines: { show: true , lineWidth: 1, fill: true, fillColor: { colors: [ { opacity: 0.12 }, { opacity: 0.6 } ] }}
		},
        points: { show: true, symbol: "diamond" },
		grid: { hoverable: true, clickable: true, backgroundColor: '#f8f8f8', borderWidth: 1, borderColor: '#d5d5d5' }
	});
	
	chart3.bind("plotclick", function (event, pos, item) {
      if (item) {			
        plot3.highlight(item.series, item.datapoint);
				showNotification("You clicked point " + item.dataIndex + " in " + item.series.label + ".", "Basic chart info");            
      }
  });
	
	/* --->> 6 - Sidebar Chart --------------*/	
		var d1 = [];
    for (var i = 0; i <= 10; i += 1)
        d1.push([i, parseInt(Math.random() * 30)]);

    var d2 = [];
    for (var i = 0; i <= 10; i += 1)
        d2.push([i, parseInt(Math.random() * 30)]);
    
    var bars = true, lines = false;
    var chart6 = $("#chart_w_2");
		var plot6 = "";

    function plotWithOptions_1() {
       plot6 =  $.plot(chart6, [ d1, d2], {
            series: {
                stack: true,               
                bars: { show: bars, barWidth: 0.6 ,lineWidth: 1}
            },
			colors: ["rgba(247,179,179,1)","rgba(238,112,95,1)"],
			grid: { hoverable: true, clickable: true, color:"#b0b0b0",  borderWidth: 0, borderColor: '#d5d5d5' }		   
        });
    }

		chart6.bind("plotclick", function (event, pos, item) {
        if (item) {			
            plot6.highlight(item.series, item.datapoint);
			showNotification("You clicked point " + item.dataIndex, "Stacked chart info");            
        }
    });

    plotWithOptions_1();

});
