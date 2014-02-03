jQuery.noConflict();

jQuery(document).ready(function(){
	
	prettyPrint();			//syntax highlighter
	mainwrapperHeight();
	responsive();
	
	
	// animation
	if(jQuery('.contentinner').hasClass('content-dashboard')) {
		var anicount = 4;	
		jQuery('.leftmenu .nav-tabs > li').each(function(){										   
			jQuery(this).addClass('animate'+anicount+' fadeInUp');
			anicount++;
		});
		
		jQuery('.leftmenu .nav-tabs > li a').hover(function(){
			jQuery(this).find('span').addClass('animate0 swing');
		},function(){
			jQuery(this).find('span').removeClass('animate0 swing');
		});
		
		jQuery('.logopanel').addClass('animate0 fadeInUp');
		jQuery('.datewidget, .headerpanel').addClass('animate1 fadeInUp');
		jQuery('.searchwidget, .breadcrumbwidget').addClass('animate2 fadeInUp'); 
		jQuery('.plainwidget, .pagetitle').addClass('animate3 fadeInUp');
		jQuery('.maincontent').addClass('animate4 fadeInUp');
	}
	
	// widget icons dashboard
	if(jQuery('.widgeticons').length > 0) {
		jQuery('.widgeticons a').hover(function(){
			jQuery(this).find('img').addClass('animate0 bounceIn');
		},function(){
			jQuery(this).find('img').removeClass('animate0 bounceIn');
		});	
	}


	// adjust height of mainwrapper when 
	// it's below the document height
	function mainwrapperHeight() {
		var windowHeight = jQuery(window).height();
		var mainWrapperHeight = jQuery('.mainwrapper').height();
		var leftPanelHeight = jQuery('.leftpanel').height();
		if(leftPanelHeight > mainWrapperHeight)
			jQuery('.mainwrapper').css({minHeight: leftPanelHeight});	
		if(jQuery('.mainwrapper').height() < windowHeight)
			jQuery('.mainwrapper').css({minHeight: windowHeight});
	}
	
	function responsive() {
		
		var windowWidth = jQuery(window).width();
		
		// hiding and showing left menu
		if(!jQuery('.showmenu').hasClass('clicked')) {
			
			if(windowWidth < 960)
				hideLeftPanel();
			else
				showLeftPanel();
		}
		
		// rearranging widget icons in dashboard
		if(windowWidth < 768) {
			if(jQuery('.widgeticons .one_third').length == 0) {
				var count = 0;
				jQuery('.widgeticons li').each(function(){
					jQuery(this).removeClass('one_fifth last').addClass('one_third');
					if(count == 2) {
						jQuery(this).addClass('last');
						count = 0;
					} else { count++; }
				});	
			}
		} else {
			if(jQuery('.widgeticons .one_firth').length == 0) {
				var count = 0;
				jQuery('.widgeticons li').each(function(){
					jQuery(this).removeClass('one_third last').addClass('one_fifth');
					if(count == 4) {
						jQuery(this).addClass('last');
						count = 0;
					} else { count++; }
				});	
			}
		}
	}
	
	// when resize window event fired
	jQuery(window).resize(function(){
		mainwrapperHeight();
		responsive();
	});
	
	// dropdown in leftmenu
	jQuery('.leftmenu .dropdown > a').click(function(){
		if(!jQuery(this).next().is(':visible'))
			jQuery(this).next().slideDown('fast');
		else
			jQuery(this).next().slideUp('fast');	
		return false;
	});
	
	// hide left panel
	function hideLeftPanel() {
		jQuery('.leftpanel').css({marginLeft: '-260px'}).addClass('hide');
		jQuery('.rightpanel').css({marginLeft: 0});
		jQuery('.mainwrapper').css({backgroundPosition: '-260px 0'});
		jQuery('.footerleft').hide();
		jQuery('.footerright').css({marginLeft: 0});
	}
	
	// show left panel
	function showLeftPanel() {
		jQuery('.leftpanel').css({marginLeft: '0px'}).removeClass('hide');
		jQuery('.rightpanel').css({marginLeft: '260px'});
		jQuery('.mainwrapper').css({backgroundPosition: '0 0'});
		jQuery('.footerleft').show();
		jQuery('.footerright').css({marginLeft: '260px'});
	}
	
	// show and hide left panel
	jQuery('.showmenu').click(function() {
		jQuery(this).addClass('clicked');
		if(jQuery('.leftpanel').hasClass('hide'))
			showLeftPanel();
		else
			hideLeftPanel();
		return false;
	});
	
	// transform checkbox and radio box using uniform plugin
	if(jQuery().uniform)
		jQuery('input:checkbox, input:radio, select.uniformselect').uniform();
	
	
	// show/hide widget content or widget content's child	
	if(jQuery('.showhide').length > 0 ) {
		jQuery('.showhide').click(function(){
			var t = jQuery(this);
			var p = t.parent();
			var target = t.attr('href');
			target = (!target)? p.next() :	p.next().find('.'+target);
			t.text((target.is(':visible'))? 'View Source' : 'Hide Source');
			(target.is(':visible'))? target.hide() : target.show(100);
			return false;
		});
	}
	
	
	/*// check all checkboxes in table
	if(jQuery('.checkall').length > 0) {
		jQuery('.checkall').click(function(){
			var parentTable = jQuery(this).parents('table');										   
			var ch = parentTable.find('tbody input[type=checkbox]');										 
			if(jQuery(this).is(':checked')) {
			
				//check all rows in table
				ch.each(function(){ 
					jQuery(this).attr('checked',true);
					jQuery(this).parent().addClass('checked');	//used for the custom checkbox style
					jQuery(this).parents('tr').addClass('selected'); // to highlight row as selected
				});
				var root = jQuery("#root").val();
                var ruang_tes = jQuery("#ruang_tes").val();

			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama_all",    
					 data: "ruang_tes="+ruang_tes+"",
					     success: function(data){ 
						 
					  
				       }	 
				    });
				var i=1;
				for ( i ; i <=40; i++) {
					var data="hadir";
			       document.getElementById("hadir_agama-"+i).innerHTML = data;
				};
							
			
			} else {
				
				//uncheck all rows in table
				ch.each(function(){ 
					jQuery(this).attr('checked',false); 
					jQuery(this).parent().removeClass('checked');	//used for the custom checkbox style
					jQuery(this).parents('tr').removeClass('selected');
				});	
                var root = jQuery("#root").val();
                var ruang_tes = jQuery("#ruang_tes").val();

				jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama_all_no",    
					 data: "ruang_tes="+ruang_tes+"",
					     success: function(data){ 
						 
					  
				       }	 
				    });
				var i=1;
				for ( i ; i <=40; i++) {
					var data="tidak hadir";
			       document.getElementById("hadir_agama-"+i).innerHTML = data;
				};
				
			}
		});
	}


	// check all checkboxes in table
	if(jQuery('.checkall2').length > 0) {
		jQuery('.checkall2').click(function(){
			var parentTable = jQuery(this).parents('table');										   
			var ch = parentTable.find('tbody input[type=checkbox]');										 
			if(jQuery(this).is(':checked')) {
			
				//check all rows in table
				ch.each(function(){ 
					jQuery(this).attr('checked',true);
					jQuery(this).parent().addClass('checked');	//used for the custom checkbox style
					jQuery(this).parents('tr').addClass('selected'); // to highlight row as selected
				});
				var root = jQuery("#root").val();
                var ruang_tes = jQuery("#ruang_tes").val();

			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum_all",    
					 data: "ruang_tes="+ruang_tes+"",
					     success: function(data){ 
						 
					  
				       }	 
				    });
				var i=1;
				for ( i ; i <=40; i++) {
					var data="hadir";
			       document.getElementById("hadir_umum-"+i).innerHTML = data;
				};
							
			
			} else {
				
				//uncheck all rows in table
				ch.each(function(){ 
					jQuery(this).attr('checked',false); 
					jQuery(this).parent().removeClass('checked');	//used for the custom checkbox style
					jQuery(this).parents('tr').removeClass('selected');
				});	
                var root = jQuery("#root").val();
                var ruang_tes = jQuery("#ruang_tes").val();

				jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum_all_no",    
					 data: "ruang_tes="+ruang_tes+"",
					     success: function(data){ 
						 
					  
				       }	 
				    });
				var i=1;
				for ( i ; i <=40; i++) {
					var data="tidak hadir";
			       document.getElementById("hadir_umum-"+i).innerHTML = data;
				};
				
			}
		});
	}

	if(jQuery('.checkall3').length > 0) {
		jQuery('.checkall3').click(function(){
			var parentTable = jQuery(this).parents('table');										   
			var ch = parentTable.find('tbody input[type=checkbox]');										 
			if(jQuery(this).is(':checked')) {
			
				//check all rows in table
				ch.each(function(){ 
					jQuery(this).attr('checked',true);
					jQuery(this).parent().addClass('checked');	//used for the custom checkbox style
					jQuery(this).parents('tr').addClass('selected'); // to highlight row as selected
				});
				var root = jQuery("#root").val();
                var ruang_tes = jQuery("#ruang_tes").val();

			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa_all",    
					 data: "ruang_tes="+ruang_tes+"",
					     success: function(data){ 
						 
					  
				       }	 
				    });
				var i=1;
				for ( i ; i <=40; i++) {
					var data="hadir";
			       document.getElementById("hadir_bahasa-"+i).innerHTML = data;
				};
							
			
			} else {
				
				//uncheck all rows in table
				ch.each(function(){ 
					jQuery(this).attr('checked',false); 
					jQuery(this).parent().removeClass('checked');	//used for the custom checkbox style
					jQuery(this).parents('tr').removeClass('selected');
				});	
                var root = jQuery("#root").val();
                var ruang_tes = jQuery("#ruang_tes").val();

				jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa_all_no",    
					 data: "ruang_tes="+ruang_tes+"",
					     success: function(data){ 
						 
					  
				       }	 
				    });
				var i=1;
				for ( i ; i <=40; i++) {
					var data="tidak hadir";
			       document.getElementById("hadir_bahasa-"+i).innerHTML = data;
				};
				
			}
		});
	}
	*/
	
	// delete row in a table
	if(jQuery('.deleterow').length > 0) {
		jQuery('.deleterow').click(function(){
			var conf = confirm('Continue delete?');
			if(conf)
				jQuery(this).parents('tr').fadeOut(function(){
					jQuery(this).remove();
					// do some other stuff here
				});
			return false;
		});	
	}
	
	
	// dynamic table
	if(jQuery('#dyntable').length > 0) {
		jQuery('#dyntable').dataTable({
			"sPaginationType": "full_numbers",
			"aaSortingFixed": [[0,'asc']],
			"fnDrawCallback": function(oSettings) {
				jQuery.uniform.update();
			}
		});
	}

		if(jQuery('#dyntable2').length > 0) {
		jQuery('#dyntable2').dataTable({
			"sPaginationType": "full_numbers",
			"aaSortingFixed": [[0,'asc']],
			"fnDrawCallback": function(oSettings) {
				jQuery.uniform.update();
			}
		});
	}

		if(jQuery('#dyntable3').length > 0) {
		jQuery('#dyntable3').dataTable({
			"sPaginationType": "full_numbers",
			"aaSortingFixed": [[0,'asc']],
			"fnDrawCallback": function(oSettings) {
				jQuery.uniform.update();
			}
		});
	}


		if(jQuery('#dyntable4').length > 0) {
		jQuery('#dyntable4').dataTable({
			"sPaginationType": "full_numbers",
			"aaSortingFixed": [[0,'asc']],
			"fnDrawCallback": function(oSettings) {
				jQuery.uniform.update();
			}
		});
	}
	
	
	/////////////////////////////// ELEMENTS.HTML //////////////////////////////
	
	
	// tabbed widget
	jQuery('#tabs, #tabs2').tabs();
	
	// accordion widget
	jQuery('#accordion, #accordion2').accordion({heightStyle: "content"});
	
	
	// color picker
	if(jQuery('#colorpicker').length > 0) {
		jQuery('#colorSelector').ColorPicker({
			onShow: function (colpkr) {
				jQuery(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				jQuery(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				jQuery('#colorSelector span').css('backgroundColor', '#' + hex);
				jQuery('#colorpicker').val('#'+hex);
			}
		});
	}

	
	// date picker
	if(jQuery('#datepicker').length > 0)
		jQuery( "#datepicker" ).datepicker();
		
	
	// growl notification
	if(jQuery('#growl').length > 0) {
		jQuery('#growl').click(function(){
			jQuery.jGrowl("Hello world!");
		});
	}
	
	// another growl notification
	if(jQuery('#growl2').length > 0) {
		jQuery('#growl2').click(function(){
			var msg = "This notification will live a little longer.";
			jQuery.jGrowl(msg, { life: 5000});
		});
	}

	// basic alert box
	if(jQuery('.alertboxbutton').length > 0) {
		jQuery('.alertboxbutton').click(function(){
			jAlert('This is a custom alert box', 'Alert Dialog');
		});
	}
	
	// confirm box
	if(jQuery('.confirmbutton').length > 0) {
		jQuery('.confirmbutton').click(function(){
			jConfirm('Can you confirm this?', 'Confirmation Dialog', function(r) {
				jAlert('Confirmed: ' + r, 'Confirmation Results');
			});
		});
	}
	
	// promptbox
	if(jQuery('.promptbutton').length > 0) {
		jQuery('.promptbutton').click
		(function(){
			jPrompt('Type something:', 'Prefilled value', 'Prompt Dialog', function(r) {
				if( r ) alert('You entered ' + r);
			});
		});
	}
	
	// alert with html
	if(jQuery('.alerthtmlbutton').length > 0) {
		jQuery('.alerthtmlbutton').click(function(){
			jAlert('You can use HTML, such as <strong>bold</strong>, <em>italics</em>, and <u>underline</u>!');
		});
	}
	
	// sortable list
	if(jQuery('#sortable').length > 0)
		jQuery("#sortable").sortable();
	
	// sortable list with content-->
	if(jQuery('#sortable2').length > 0) {
		jQuery("#sortable2").sortable();
		jQuery('.showcnt').click(function(){
			var t = jQuery(this);
			var det = t.parents('li').find('.details');
			if(!det.is(':visible')) {
				det.slideDown();
				t.removeClass('icon-arrow-down').addClass('icon-arrow-up');
			} else {
				det.slideUp();
				t.removeClass('icon-arrow-up').addClass('icon-arrow-down');
			}
		});
	}
	
	// tooltip sample
	if(jQuery('.tooltipsample').length > 0)
		jQuery('.tooltipsample').tooltip({selector: "a[rel=tooltip]"});
		
	jQuery('.popoversample').popover({selector: 'a[rel=popover]', trigger: 'hover'});
	
	
	
	///// MESSAGES /////	
	
	if(jQuery('.mailinbox').length > 0) {
		
		// star
		jQuery('.msgstar').click(function(){
			if(jQuery(this).hasClass('starred'))
				jQuery(this).removeClass('starred');
			else
				jQuery(this).addClass('starred');
		});
		
		//add class selected to table row when checked
		jQuery('.mailinbox tbody input:checkbox').click(function(){
			if(jQuery(this).is(':checked'))
				jQuery(this).parents('tr').addClass('selected');
			else
				jQuery(this).parents('tr').removeClass('selected');
		});
		
		// trash
		if(jQuery('.msgtrash').length > 0) {
			jQuery('.msgtrash').click(function(){
				var c = false;
				var cn = 0;
				var o = new Array();
				jQuery('.mailinbox input:checkbox').each(function(){
					if(jQuery(this).is(':checked')) {
						c = true;
						o[cn] = jQuery(this);
						cn++;
					}
				});
				if(!c) {
					alert('No selected message');	
				} else {
					var msg = (o.length > 1)? 'messages' : 'message';
					if(confirm('Delete '+o.length+' '+msg+'?')) {
						for(var a=0;a<cn;a++) {
							jQuery(o[a]).parents('tr').remove();	
						}
					}
				}
			});
		}
	}

	
	// change layout
	jQuery('.skin-layout').click(function(){
		jQuery('.skin-layout').each(function(){ jQuery(this).parent().removeClass('selected'); });
		if(jQuery(this).hasClass('fixed')) {
			jQuery('.mainwrapper').removeClass('fullwrapper');
			if(jQuery('.stickyheaderinner').length > 0) jQuery('.stickyheaderinner').removeClass('wideheader');
			jQuery.cookie("skin-layout", 'fixed', { path: '/' });
		} else {
			jQuery('.mainwrapper').addClass('fullwrapper');
			if(jQuery('.stickyheaderinner').length > 0) jQuery('.stickyheaderinner').addClass('wideheader');
			jQuery.cookie("skin-layout", 'wide', { path: '/' });
		}
		return false;
	});
	
	// load selected layout from cookie
	if(jQuery.cookie('skin-layout')) {
		var layout = jQuery.cookie('skin-layout');
		if(layout == 'fixed') {
			jQuery('.mainwrapper').removeClass('fullwrapper');
			if(jQuery('.stickyheaderinner').length > 0) jQuery('.stickyheaderinner').removeClass('wideheader');
		} else {
			jQuery('.mainwrapper').addClass('fullwrapper');
			if(jQuery('.stickyheaderinner').length > 0) jQuery('.stickyheaderinner').addClass('wideheader');
		}	
	}
	
	
	// change skin color
	jQuery('.skin-color').click(function(){
		var s = jQuery(this).attr('href');
		if(jQuery('#skinstyle').length > 0) {
			if(s!='default') {
				jQuery('#skinstyle').attr('href','css/style.'+s+'.css');	
				jQuery.cookie('skin-color', s, { path: '/' });
			} else {
				jQuery('#skinstyle').remove();
				jQuery.cookie("skin-color", '', { path: '/' });
			}
		} else {
			if(s!='default') {
				jQuery('head').append('<link id="skinstyle" rel="stylesheet" href="css/style.'+s+'.css" type="text/css" />');
				jQuery.cookie("skin-color", s, { path: '/' });
			}
		}
		return false;
	});
	
	// load selected skin color from cookie
	if(jQuery.cookie('skin-color')) {
		var c = jQuery.cookie('skin-color');
		if(c) {
			jQuery('head').append('<link id="skinstyle" rel="stylesheet" href="css/style.'+c+'.css" type="text/css" />');
			jQuery.cookie("skin-color", c, { path: '/' });
		}
	}
/*
		jQuery('#agama-1').click(function(){
			    if (jQuery('#agama-1').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-1").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-1").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-1").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-1").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

		jQuery('#agama-2').click(function(){
			    if (jQuery('#agama-2').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-2").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-2").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-2").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-2").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
       
       jQuery('#agama-3').click(function(){
			    if (jQuery('#agama-3').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-3").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-3").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-3").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-3").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

       jQuery('#agama-4').click(function(){
			    if (jQuery('#agama-4').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-4").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-4").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-4").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-4").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

       jQuery('#agama-5').click(function(){
			    if (jQuery('#agama-5').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-5").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-5").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-5").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-5").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

       jQuery('#agama-6').click(function(){
			    if (jQuery('#agama-6').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-6").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-6").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-6").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-6").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

        jQuery('#agama-7').click(function(){
			    if (jQuery('#agama-7').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-7").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-7").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-7").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-7").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

         jQuery('#agama-8').click(function(){
			    if (jQuery('#agama-8').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-8").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-8").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-8").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-8").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

         jQuery('#agama-9').click(function(){
			    if (jQuery('#agama-9').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-9").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-9").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-9").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-9").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

       jQuery('#agama-10').click(function(){
			    if (jQuery('#agama-10').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-10").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-10").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-10").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-10").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

        jQuery('#agama-11').click(function(){
			    if (jQuery('#agama-11').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-11").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-11").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-11").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-11").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
     
     jQuery('#agama-12').click(function(){
			    if (jQuery('#agama-12').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-12").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-12").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-12").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-12").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

      jQuery('#agama-13').click(function(){
			    if (jQuery('#agama-13').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-13").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-13").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-13").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-13").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

	  jQuery('#agama-14').click(function(){
			    if (jQuery('#agama-14').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-14").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-14").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-14").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-14").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });


	   jQuery('#agama-15').click(function(){
			    if (jQuery('#agama-15').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-15").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-15").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-15").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-15").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

	   jQuery('#agama-16').click(function(){
			    if (jQuery('#agama-16').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-16").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-16").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-16").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-16").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
      
       jQuery('#agama-17').click(function(){
			    if (jQuery('#agama-17').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-17").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-17").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-17").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-17").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

        jQuery('#agama-18').click(function(){
			    if (jQuery('#agama-18').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-18").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-18").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-18").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-18").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

         jQuery('#agama-19').click(function(){
			    if (jQuery('#agama-19').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-19").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-19").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-19").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-19").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
      jQuery('#agama-20').click(function(){
			    if (jQuery('#agama-20').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-20").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-20").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-20").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-20").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#agama-21').click(function(){
			    if (jQuery('#agama-21').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-21").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-21").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-21").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-21").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#agama-22').click(function(){
			    if (jQuery('#agama-22').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-22").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-22").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-22").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-22").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#agama-23').click(function(){
			    if (jQuery('#agama-23').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-23").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-23").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-23").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-23").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#agama-24').click(function(){
			    if (jQuery('#agama-24').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-24").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-24").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-24").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-24").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#agama-25').click(function(){
			    if (jQuery('#agama-25').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-25").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-25").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-25").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-25").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#agama-26').click(function(){
			    if (jQuery('#agama-26').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-26").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-26").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-26").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-26").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#agama-27').click(function(){
			    if (jQuery('#agama-27').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-27").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-27").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-27").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-27").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
      jQuery('#agama-28').click(function(){
			    if (jQuery('#agama-28').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-28").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-28").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-28").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-28").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
      jQuery('#agama-29').click(function(){
			    if (jQuery('#agama-29').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-29").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-29").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-29").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-29").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
      jQuery('#agama-30').click(function(){
			    if (jQuery('#agama-30').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-30").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-30").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-30").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-30").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#agama-31').click(function(){
			    if (jQuery('#agama-31').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-31").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-31").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-31").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-31").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#agama-32').click(function(){
			    if (jQuery('#agama-32').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-32").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-32").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-32").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-32").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#agama-33').click(function(){
			    if (jQuery('#agama-33').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-33").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-33").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-33").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-33").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#agama-34').click(function(){
			    if (jQuery('#agama-34').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-34").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-34").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-34").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-34").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
      
       jQuery('#agama-35').click(function(){
			    if (jQuery('#agama-35').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-35").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-35").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-35").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-35").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#agama-36').click(function(){
			    if (jQuery('#agama-36').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-36").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-36").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-36").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-36").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#agama-37').click(function(){
			    if (jQuery('#agama-37').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-37").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-37").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-37").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-37").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
      
       jQuery('#agama-38').click(function(){
			    if (jQuery('#agama-38').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-38").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-38").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-38").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-38").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#agama-39').click(function(){
			    if (jQuery('#agama-39').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-39").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-39").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-39").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-39").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
      jQuery('#agama-40').click(function(){
			    if (jQuery('#agama-40').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-40").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-40").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-40").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-40").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#agama-41').click(function(){
			    if (jQuery('#agama-41').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-41").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-41").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-41").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-41").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#agama-42').click(function(){
			    if (jQuery('#agama-42').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-42").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-42").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-42").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-42").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#agama-43').click(function(){
			    if (jQuery('#agama-43').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-43").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-43").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-43").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-43").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#agama-44').click(function(){
			    if (jQuery('#agama-44').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-44").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-44").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-44").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-44").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#agama-45').click(function(){
			    if (jQuery('#agama-45').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#agama-45").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-45").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#agama-45").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_agama",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_agama-45").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });




      jQuery('#umum-1').click(function(){
			    if (jQuery('#umum-1').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-1").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-1").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-1").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-1").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

		jQuery('#umum-2').click(function(){
			    if (jQuery('#umum-2').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-2").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-2").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-2").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-2").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
       
       jQuery('#umum-3').click(function(){
			    if (jQuery('#umum-3').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-3").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-3").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-3").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-3").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

       jQuery('#umum-4').click(function(){
			    if (jQuery('#umum-4').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-4").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-4").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-4").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-4").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

       jQuery('#umum-5').click(function(){
			    if (jQuery('#umum-5').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-5").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-5").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-5").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-5").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

       jQuery('#umum-6').click(function(){
			    if (jQuery('#umum-6').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-6").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-6").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-6").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-6").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

        jQuery('#umum-7').click(function(){
			    if (jQuery('#umum-7').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-7").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-7").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-7").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-7").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

         jQuery('#umum-8').click(function(){
			    if (jQuery('#umum-8').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-8").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-8").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-8").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-8").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

         jQuery('#umum-9').click(function(){
			    if (jQuery('#umum-9').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-9").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-9").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-9").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-9").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

       jQuery('#umum-10').click(function(){
			    if (jQuery('#umum-10').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-10").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-10").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-10").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-10").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

        jQuery('#umum-11').click(function(){
			    if (jQuery('#umum-11').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-11").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-11").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-11").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-11").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
     
     jQuery('#umum-12').click(function(){
			    if (jQuery('#umum-12').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-12").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-12").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-12").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-12").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

      jQuery('#umum-13').click(function(){
			    if (jQuery('#umum-13').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-13").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-13").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-13").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-13").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

	  jQuery('#umum-14').click(function(){
			    if (jQuery('#umum-14').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-14").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-14").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-14").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-14").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });


	   jQuery('#umum-15').click(function(){
			    if (jQuery('#umum-15').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-15").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-15").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-15").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-15").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

	   jQuery('#umum-16').click(function(){
			    if (jQuery('#umum-16').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-16").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-16").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-16").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-16").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
      
       jQuery('#umum-17').click(function(){
			    if (jQuery('#umum-17').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-17").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-17").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-17").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-17").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

        jQuery('#umum-18').click(function(){
			    if (jQuery('#umum-18').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-18").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-18").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-18").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-18").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

         jQuery('#umum-19').click(function(){
			    if (jQuery('#umum-19').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-19").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-19").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-19").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-19").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
      jQuery('#umum-20').click(function(){
			    if (jQuery('#umum-20').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-20").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-20").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-20").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-20").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#umum-21').click(function(){
			    if (jQuery('#umum-21').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-21").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-21").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-21").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-21").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#umum-22').click(function(){
			    if (jQuery('#umum-22').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-22").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-22").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-22").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-22").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#umum-23').click(function(){
			    if (jQuery('#umum-23').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-23").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-23").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-23").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-23").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#umum-24').click(function(){
			    if (jQuery('#umum-24').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-24").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-24").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-24").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-24").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#umum-25').click(function(){
			    if (jQuery('#umum-25').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-25").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-25").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-25").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-25").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#umum-26').click(function(){
			    if (jQuery('#umum-26').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-26").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-26").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-26").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-26").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#umum-27').click(function(){
			    if (jQuery('#umum-27').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-27").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-27").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-27").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-27").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
      jQuery('#umum-28').click(function(){
			    if (jQuery('#umum-28').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-28").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-28").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-28").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-28").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
      jQuery('#umum-29').click(function(){
			    if (jQuery('#umum-29').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-29").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-29").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-29").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-29").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
      jQuery('#umum-30').click(function(){
			    if (jQuery('#umum-30').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-30").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-30").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-30").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-30").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#umum-31').click(function(){
			    if (jQuery('#umum-31').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-31").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-31").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-31").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-31").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#umum-32').click(function(){
			    if (jQuery('#umum-32').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-32").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-32").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-32").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-32").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#umum-33').click(function(){
			    if (jQuery('#umum-33').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-33").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-33").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-33").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-33").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#umum-34').click(function(){
			    if (jQuery('#umum-34').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-34").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-34").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-34").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-34").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
      
       jQuery('#umum-35').click(function(){
			    if (jQuery('#umum-35').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-35").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-35").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-35").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-35").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#umum-36').click(function(){
			    if (jQuery('#umum-36').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-36").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-36").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-36").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-36").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#umum-37').click(function(){
			    if (jQuery('#umum-37').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-37").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-37").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-37").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-37").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
      
       jQuery('#umum-38').click(function(){
			    if (jQuery('#umum-38').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-38").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-38").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-38").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-38").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#umum-39').click(function(){
			    if (jQuery('#umum-39').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-39").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-39").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-39").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-39").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
      jQuery('#umum-40').click(function(){
			    if (jQuery('#umum-40').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-40").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-40").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-40").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-40").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#umum-41').click(function(){
			    if (jQuery('#umum-41').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-41").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-41").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-41").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-41").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#umum-42').click(function(){
			    if (jQuery('#umum-42').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-42").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-42").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-42").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-42").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#umum-43').click(function(){
			    if (jQuery('#umum-43').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-43").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-43").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-43").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-43").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#umum-44').click(function(){
			    if (jQuery('#umum-44').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-44").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-44").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-44").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-44").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#umum-45').click(function(){
			    if (jQuery('#umum-45').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#umum-45").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-45").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#umum-45").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_umum",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_umum-45").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  

      jQuery('#bahasa-1').click(function(){
			    if (jQuery('#bahasa-1').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-1").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-1").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-1").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-1").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

		jQuery('#bahasa-2').click(function(){
			    if (jQuery('#bahasa-2').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-2").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-2").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-2").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-2").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
       
       jQuery('#bahasa-3').click(function(){
			    if (jQuery('#bahasa-3').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-3").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-3").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-3").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-3").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

       jQuery('#bahasa-4').click(function(){
			    if (jQuery('#bahasa-4').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-4").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-4").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-4").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-4").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

       jQuery('#bahasa-5').click(function(){
			    if (jQuery('#bahasa-5').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-5").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-5").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-5").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-5").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

       jQuery('#bahasa-6').click(function(){
			    if (jQuery('#bahasa-6').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-6").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-6").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-6").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-6").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

        jQuery('#bahasa-7').click(function(){
			    if (jQuery('#bahasa-7').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-7").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-7").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-7").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-7").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

         jQuery('#bahasa-8').click(function(){
			    if (jQuery('#bahasa-8').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-8").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-8").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-8").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-8").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

         jQuery('#bahasa-9').click(function(){
			    if (jQuery('#bahasa-9').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-9").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-9").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-9").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-9").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

       jQuery('#bahasa-10').click(function(){
			    if (jQuery('#bahasa-10').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-10").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-10").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-10").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-10").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

        jQuery('#bahasa-11').click(function(){
			    if (jQuery('#bahasa-11').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-11").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-11").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-11").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-11").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
     
     jQuery('#bahasa-12').click(function(){
			    if (jQuery('#bahasa-12').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-12").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-12").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-12").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-12").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

      jQuery('#bahasa-13').click(function(){
			    if (jQuery('#bahasa-13').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-13").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-13").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-13").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-13").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

	  jQuery('#bahasa-14').click(function(){
			    if (jQuery('#bahasa-14').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-14").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-14").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-14").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-14").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });


	   jQuery('#bahasa-15').click(function(){
			    if (jQuery('#bahasa-15').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-15").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-15").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-15").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-15").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

	   jQuery('#bahasa-16').click(function(){
			    if (jQuery('#bahasa-16').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-16").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-16").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-16").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-16").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
      
       jQuery('#bahasa-17').click(function(){
			    if (jQuery('#bahasa-17').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-17").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-17").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-17").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-17").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

        jQuery('#bahasa-18').click(function(){
			    if (jQuery('#bahasa-18').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-18").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-18").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-18").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-18").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });

         jQuery('#bahasa-19').click(function(){
			    if (jQuery('#bahasa-19').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-19").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-19").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-19").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-19").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
      jQuery('#bahasa-20').click(function(){
			    if (jQuery('#bahasa-20').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-20").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-20").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-20").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-20").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#bahasa-21').click(function(){
			    if (jQuery('#bahasa-21').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-21").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-21").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-21").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-21").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#bahasa-22').click(function(){
			    if (jQuery('#bahasa-22').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-22").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-22").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-22").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-22").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#bahasa-23').click(function(){
			    if (jQuery('#bahasa-23').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-23").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-23").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-23").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-23").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#bahasa-24').click(function(){
			    if (jQuery('#bahasa-24').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-24").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-24").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-24").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-24").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#bahasa-25').click(function(){
			    if (jQuery('#bahasa-25').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-25").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-25").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-25").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-25").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#bahasa-26').click(function(){
			    if (jQuery('#bahasa-26').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-26").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-26").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-26").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-26").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#bahasa-27').click(function(){
			    if (jQuery('#bahasa-27').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-27").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-27").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-27").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-27").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
      jQuery('#bahasa-28').click(function(){
			    if (jQuery('#bahasa-28').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-28").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-28").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-28").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-28").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
      jQuery('#bahasa-29').click(function(){
			    if (jQuery('#bahasa-29').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-29").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-29").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-29").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-29").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
      jQuery('#bahasa-30').click(function(){
			    if (jQuery('#bahasa-30').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-30").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-30").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-30").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-30").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#bahasa-31').click(function(){
			    if (jQuery('#bahasa-31').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-31").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-31").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-31").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-31").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#bahasa-32').click(function(){
			    if (jQuery('#bahasa-32').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-32").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-32").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-32").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-32").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#bahasa-33').click(function(){
			    if (jQuery('#bahasa-33').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-33").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-33").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-33").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-33").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#bahasa-34').click(function(){
			    if (jQuery('#bahasa-34').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-34").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-34").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-34").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-34").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
      
       jQuery('#bahasa-35').click(function(){
			    if (jQuery('#bahasa-35').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-35").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-35").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-35").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-35").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#bahasa-36').click(function(){
			    if (jQuery('#bahasa-36').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-36").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-36").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-36").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-36").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#bahasa-37').click(function(){
			    if (jQuery('#bahasa-37').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-37").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-37").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-37").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-37").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
      
       jQuery('#bahasa-38').click(function(){
			    if (jQuery('#bahasa-38').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-38").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-38").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-38").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-38").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#bahasa-39').click(function(){
			    if (jQuery('#bahasa-39').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-39").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-39").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-39").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-39").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
      jQuery('#bahasa-40').click(function(){
			    if (jQuery('#bahasa-40').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-40").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-40").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-40").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-40").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#bahasa-41').click(function(){
			    if (jQuery('#bahasa-41').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-41").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-41").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-41").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-41").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#bahasa-42').click(function(){
			    if (jQuery('#bahasa-42').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-42").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-42").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-42").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-42").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#bahasa-43').click(function(){
			    if (jQuery('#bahasa-43').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-43").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-43").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-43").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-43").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#bahasa-44').click(function(){
			    if (jQuery('#bahasa-44').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-44").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-44").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-44").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-44").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
       jQuery('#bahasa-45').click(function(){
			    if (jQuery('#bahasa-45').is(':checked')) {
			     var root = jQuery("#root").val();
                 var no_pes = jQuery("#bahasa-45").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_absen_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-45").innerHTML = "Hadir";
					  
				       }	 
				    });
			    }
			    else {
			    	 var root = jQuery("#root").val();
                    var no_pes = jQuery("#bahasa-45").val();
			       jQuery.ajax({
				     type: "POST",
				     url : ""+root+"pengawas/set_tidak_hadir_bahasa",    
					 data: "no_pes="+no_pes+"",
					     success: function(data){ 
						 //alert(data);
						 //menysipkan data ke list kota
					     document.getElementById("hadir_bahasa-45").innerHTML = "Tidak Hadir";
					  
				       }	 
				    });			   	    
			   }
	  });
  
  
   
  
   
  
  
*/
	
});