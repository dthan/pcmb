

      <div class="pagetitle">
        	<h1>Dashboard</h1> <span>Halaman utama admin.</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
        	<div class="contentinner content-dashboard">
            	<div class="alert alert-info">
                	<button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Selamat datang !</strong> silahkan klik icon di bawah atau menu di sebelah kiri.
                </div><!--alert-->
                
                <div class="row-fluid">
                	<div class="span8">
                    	<ul class="widgeticons row-fluid">
                        <?php
                        if($level=='admin'){
                        ?>
                            
                            <li class="one_fifth"><a href="<?php echo base_url(); ?>peserta"><img src="<?php echo base_url(); ?>asset/images/peserta.png" alt="" style="width:100px;height:100px" /><span>Manage Peserta</span></a></li>
                            <li class="one_fifth"><a href="<?php echo base_url(); ?>sekolah"><img src="<?php echo base_url(); ?>asset/images/sekolah.png" alt="" style="width:100px;height:100px"/><span>Manage Sekolah</span></a></li>
                            <li class="one_fifth"><a href="<?php echo base_url(); ?>jurusan"><img src="<?php echo base_url(); ?>asset/images/jurusan.png" alt="" style="width:100px;height:100px"/><span>Manage Jurusan</span></a></li>
                            <li class="one_fifth"><a href="<?php echo base_url(); ?>fakultas"><img src="<?php echo base_url(); ?>asset/images/fakultas.png" alt="" style="width:100px;height:100px"/><span>Manage Fakultas</span></a></li>
                            <li class="one_fifth"><a href="<?php echo base_url(); ?>gedung"><img src="<?php echo base_url(); ?>asset/images/gedung.png" alt="" style="width:100px;height:100px"/><span>Manage Gedung</span></a></li>
                            <li class="one_fifth"><a href="<?php echo base_url(); ?>ruang_tes"><img src="<?php echo base_url(); ?>asset/images/ruang_tes.png" alt="" style="width:100px;height:100px" /><span>Manage Ruang Tes</span></a></li>
                            <li class="one_fifth"><a href="<?php echo base_url(); ?>data_pengawas"><img src="<?php echo base_url(); ?>asset/images/pengawas.png" alt="" style="width:100px;height:100px" /><span>Manage Pengawas</span></a></li>
                            <li class="one_fifth"><a href="<?php echo base_url(); ?>hasil_tes"><img src="<?php echo base_url(); ?>asset/images/hasil_tes.png" alt="" style="width:100px;height:100px"/><span>Manage hasil tes</span></a></li>
                            <li class="one_fifth"><a href="<?php echo base_url(); ?>seleksi"><img src="<?php echo base_url(); ?>asset/images/seleksi2.png" alt="" style="width:100px;height:100px"/><span>Manage Seleksi</span></a></li>
                            <li class="one_fifth"><a href="<?php echo base_url(); ?>report"><img src="<?php echo base_url(); ?>asset/images/report.png" alt="" style="width:100px;height:100px"/><span>Manage report</span></a></li>
                            <li class="one_fifth"><a href="<?php echo base_url(); ?>berita"><img src="<?php echo base_url(); ?>asset/images/berita.png" alt="" style="width:100px;height:100px" /><span>Manage Berita</span></a></li>
                            

                            
                        
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
