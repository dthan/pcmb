

      <div class="pagetitle">
        	<h1>Report</h1> <span>Halaman utama admin.</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
        	<div class="contentinner content-dashboard">
            	
                
                <div class="row-fluid">
                	<div class="span8">
                    	<ul class="widgeticons">
                        <?php
                        if($level=='admin'){
                        ?>
                            
                            <li class="one_fifth"><a href="<?php echo base_url(); ?>report/pendaftar"><img src="<?php echo base_url(); ?>asset/images/report.gif" alt="" /><span>Report Data Pendaftar</span></a></li>
                            <li class="one_fifth"><a href="<?php echo base_url(); ?>report/gedung"><img src="<?php echo base_url(); ?>asset/images/report.gif" alt="" /><span>Report Data Gedung</span></a></li>
                            <li class="one_fifth"><a href="<?php echo base_url(); ?>report/ruang_tes"><img src="<?php echo base_url(); ?>asset/images/report.gif" alt="" /><span>Report Data Ruang Tes</span></a></li>
                            <li class="one_fifth"><a href="<?php echo base_url(); ?>report/pengawas"><img src="<?php echo base_url(); ?>asset/images/report.gif" alt="" /><span>Report Data Gedung</span></a></li>
                            <li class="one_fifth"><a href="<?php echo base_url(); ?>report/fakultas"><img src="<?php echo base_url(); ?>asset/images/report.gif" alt="" /><span>Report Data Fakultas</span></a></li>
                            <li class="one_fifth"><a href="<?php echo base_url(); ?>report/jurusan"><img src="<?php echo base_url(); ?>asset/images/report.gif" alt="" /><span>Report Data Jurusan</span></a></li>
                            <li class="one_fifth"><a href="<?php echo base_url(); ?>report/sekolah"><img src="<?php echo base_url(); ?>asset/images/report.gif" alt="" /><span>Report Data Sekolah</span></a></li>
                            <li class="one_fifth"><a href="<?php echo base_url(); ?>report/hasil_seleksi"><img src="<?php echo base_url(); ?>asset/images/report.gif" alt="" /><span>Report Data Hasil Seleksi</span></a></li>
                           
                        <?php
                        }
                        else {
                         
                        ?> 

                            <li class="one_fifth last"><a href="<?php echo base_url(); ?>pengawas/absen"><img src="<?php echo base_url(); ?>asset/admin/img/gemicon/notify.png" alt="" /><span>absensi peserta</span></a></li>
                        <?php
                        }
                        ?>
                        </ul>                       
                        <br />
                        
                                                
                    </div><!--span8-->
                    
                </div><!--row-fluid-->
            </div><!--contentinner-->
        </div><!--maincontent-->
        
    </div><!--mainright-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
    
    <div class="footer">
    	<div class="footerleft">PCMB Admin</div>
        <div class="footerright">&copy; UIN Sunan Gunung Djati Bandung </div>
    </div><!--footer-->

    
</div><!--mainwrapper-->
<script type="text/javascript">
jQuery(document).ready(function(){
								
		// basic chart
		var flash = [[0, 2], [1, 6], [2,3], [3, 8], [4, 5], [5, 13], [6, 8]];
		var html5 = [[0, 5], [1, 4], [2,4], [3, 1], [4, 9], [5, 10], [6, 13]];
			
		function showTooltip(x, y, contents) {
			jQuery('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css( {
				position: 'absolute',
				display: 'none',
				top: y + 5,
				left: x + 5
			}).appendTo("body").fadeIn(200);
		}
	
			
		var plot = jQuery.plot(jQuery("#chartplace2"),
			   [ { data: flash, label: "Flash(x)", color: "#fb6409"}, { data: html5, label: "HTML5(x)", color: "#096afb"} ], {
				   series: {
					   lines: { show: true, fill: true, fillColor: { colors: [ { opacity: 0.05 }, { opacity: 0.15 } ] } },
					   points: { show: true }
				   },
				   legend: { position: 'nw'},
				   grid: { hoverable: true, clickable: true, borderColor: '#ccc', borderWidth: 1, labelMargin: 10 },
				   yaxis: { min: 0, max: 15 }
				 });
		
		var previousPoint = null;
		jQuery("#chartplace2").bind("plothover", function (event, pos, item) {
			jQuery("#x").text(pos.x.toFixed(2));
			jQuery("#y").text(pos.y.toFixed(2));
			
			if(item) {
				if (previousPoint != item.dataIndex) {
					previousPoint = item.dataIndex;
						
					jQuery("#tooltip").remove();
					var x = item.datapoint[0].toFixed(2),
					y = item.datapoint[1].toFixed(2);
						
					showTooltip(item.pageX, item.pageY,
									item.series.label + " of " + x + " = " + y);
				}
			
			} else {
			   jQuery("#tooltip").remove();
			   previousPoint = null;            
			}
		
		});
		
		jQuery("#chartplace2").bind("plotclick", function (event, pos, item) {
			if (item) {
				jQuery("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
				plot.highlight(item.series, item.datapoint);
			}
		});


		// bar graph
		var d2 = [];
		for (var i = 0; i <= 10; i += 1)
			d2.push([i, parseInt(Math.random() * 30)]);
			
		var stack = 0, bars = true, lines = false, steps = false;
		jQuery.plot(jQuery("#bargraph2"), [ d2 ], {
			series: {
				stack: stack,
				lines: { show: lines, fill: true, steps: steps },
				bars: { show: bars, barWidth: 0.6 }
			},
			grid: { hoverable: true, clickable: true, borderColor: '#bbb', borderWidth: 1, labelMargin: 10 },
			colors: ["#06c"]
		});
		
		// calendar
		jQuery('#calendar').datepicker();


});
</script>
</body>
</html>
