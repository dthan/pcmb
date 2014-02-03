/* Page config --> Begin */

var config = {
	skin : {
		colors: {
			name : 'Warna tema',
			id : 'theme-color',
			desc : 'Lihatlah contoh ini.<br>Sekarang di bawah kendali Anda untuk membuat dan menambahkan banyak warna yang berbeda yang Anda inginkan.',
			list : {
				1 : {
					name : 'color 1',
					className : 'color-1',
					color : '#79BE0B'
				},
				2 : {
					name : 'color 2',
					className : 'color-2',
					color : '#22bbd6'
				},
				3 : {
					name : 'color 3',
					className : 'color-3',
					color : '#795cb0'
				},
				4 : {
					name : 'color 4',
					className : 'color-4',
					color : '#038ca9'
				},
				5 : {
					name : 'color 5',
					className : 'color-5',
					color : '#3b930a'
				},
				6 : {
					name : 'color 6',
					className : 'color-6',
					color : '#01ad93'
				},
				7 : {
					name : 'color 7',
					className : 'color-7',
					color : '#ffba00'
				},
				8 : {
					name : 'color 8',
					className : 'color-8',
					color : '#f99200'
				},
				9 : {
					name : 'color 9',
					className : 'color-9',
					color : '#da4c0e'
				},
				10 : {
					name : 'color 10',
					className : 'color-10',
					color : '#e85d98'
				},
				11 : {
					name : 'color 11',
					className : 'color-11',
					color : '#8e376b'
				},
				12 : {
					name : 'color 12',
					className : 'color-12',
					color : '#564544'
				},
				13 : {
					name : 'color 13',
					className : 'color-13',
					color : '#887171'
				},
				14 : {
					name : 'color 14',
					className : 'color-14',
					color : '#718193'
				},
				15 : {
					name : 'color 15',
					className : 'color-15',
					color : '#b11c1c'
				},
				16 : {
					name : 'color 16',
					className : 'color-16',
					color : '#2d5c88'
				},
				17 : {
					name : 'mixed 1',
					className : 'mixed-1'
				},
				18 : {
					name : 'mixed 2',
					className : 'mixed-2'
				},
				19 : {
					name : 'mixed 3',
					className : 'mixed-3'
				},
				20 : {
					name : 'mixed 4',
					className : 'mixed-4'
				}
			}
		}
	},
	type : {
		style: {
			name : 'tipe tampilan',
			id : 'theme-type',
			list : {
				1 : {
					name : 'Normal',
					className : 'normal'
				},
				2 : {
					name : 'Scribble',
					className : 'scribble'
				}
			}
		}
	},
	background : {
		pattern: {
			name : 'Theme Pattern',
			id : 'theme-pattern',
			desc : 'Patterns for Boxed Layout',
			list : {
				1 : {
					name : 'pattern 1',
					className : 'pattern-1'
				},
				2 : {
					name : 'pattern 2',
					className : 'pattern-2'
				},
				3 : {
					name : 'pattern 3',
					className : 'pattern-3'
				},
				4 : {
					name : 'pattern 4',
					className : 'pattern-4'
				},
				5 : {
					name : 'pattern 5',
					className : 'pattern-5'
				},
				6 : {
					name : 'pattern 6',
					className : 'pattern-6'
				},
				7 : {
					name : 'pattern 7',
					className : 'pattern-7'
				},
				8 : {
					name : 'pattern 8',
					className : 'pattern-8'
				},
				9 : {
					name : 'pattern 9',
					className : 'pattern-9'
				},
				10 : {
					name : 'pattern 10',
					className : 'pattern-10'
				},
				11 : {
					name : 'pattern 11',
					className : 'pattern-11'
				},
				12 : {
					name : 'pattern 12',
					className : 'pattern-12'
				},
				13 : {
					name : 'pattern 13',
					className : 'pattern-13'
				},
				14 : {
					name : 'pattern 14',
					className : 'pattern-14'
				},
				15 : {
					name : 'pattern 15',
					className : 'pattern-15'
				}
			}
		}	
	},
	layout : {
		style: {
			name : 'Pilih Layout Style',
			id	 : 'theme-layout',
			list : {
				
				1 : {
					name : 'Wide',
					className : 'wide'
				},	
				2 : {
					name : 'Boxed',
					className : 'boxed'
				}
			}		
		}
	}
}

/* Config --> End */

jQuery(document).ready(function($) {

	/* Theme controller --> Begin */

	var $body = $('body'),
		$themePanel = $('<div id="control-panel" />').addClass('control-panel'),
		$panel_label = $('<a href="#" id="control-label"><i class="icon-wrench"></i></a>');
		$themePanel.append($panel_label);
		
	var layout = $.cookie('layout'),
		type = $.cookie('type'),
		pattern = $.cookie('pattern'),
		color = $.cookie('color');
		
	function changeBodyClass(className, classesArray) {
		$.each(classesArray,function(idx, val) {
			$body.removeClass(val);
		});
		$body.addClass(className);
	}
	
	function objToString(obj) {
		var string = obj.join(" ");
		return string;
	}
	
	function animUpDown(el) {
		if ( el == null) {
			$block_bg.animate({ left: '-50px' }, 250, function() { $(this).css('display','none') });
		} else if ( el == 'wide') {
			$block_bg.animate({ left: '-50px' }, 250, function() { $(this).css('display','none') });
		} else {
			$block_bg.fadeIn(200, function() {
				$(this).animate({ left: '180px'}, 250);
			});	
		}
	}
	
	if (typeof config != 'undefined' && $themePanel) {
		
		var defaultSettings = {};
		
		if ( config.layout ) {
			
			var $layout_block, $label_layout, $select_layout, html_layout, layout_classes = [];
			
			$.each(config.layout, function(index, value) {
				
				$layout_block = $('<div/>').addClass('style-block').attr({ id : value.id });;
				$label_layout = $('<h6>' + value.name + '</h6>');
				$select_layout = $('<select/>');
				
				html_layout = '';
				
				$.each(value.list, function(index_list, value_list) {
					
					var selected = '';
					
					if ( layout ) {
						if ( layout == value_list.className ) {
							selected = 'selected="selected"';
						}
					}
					
					html_layout += '<option ' + selected +'  class="' + value_list.className + '" value="' + value_list.className + '">' + value_list.name + '</option>';
					
					layout_classes.push(value_list.className);
				});
				
				$select_layout.html(html_layout);
				$layout_block.append($label_layout, $select_layout);
				$themePanel.append($layout_block);
			}); 
			
			$layout_block.find("select").on("change", function() {
				var $this = $(this),
				nextClassName = $this.val();
				$.cookie('layout', nextClassName);
				
				if ( $('#layerslider').length ) {
					location.reload();
				}
				
				if (!$body.hasClass(nextClassName)) {
					changeBodyClass(nextClassName, layout_classes);
				}
				
				animUpDown(nextClassName);
				
			})
			
		}
		
		if ( config.type ) {
			
			var $type_block, $label_type, $select_type, html_type, type_classes = [];
			
			$.each(config.type, function(index, value) {
				
				$type_block = $('<div/>').addClass('style-block').attr({ id : value.id });;
				$label_type = $('<h6>' + value.name + '</h6>');
				$select_type = $('<select/>');
				
				html_type = '';
				
				$.each(value.list, function(index_list, value_list) {
					
					var selected = '';
					
					if ( type ) {
						if ( type == value_list.className ) {
							selected = 'selected="selected"';
						}
					}
					
					html_type += '<option ' + selected +'  class="' + value_list.className + '" value="' + value_list.className + '">' + value_list.name + '</option>';
					
					type_classes.push(value_list.className);
				});
				
				$select_type.html(html_type);
				$type_block.append($label_type, $select_type);
				$themePanel.append($type_block);
			}); 
			
			$type_block.find("select").on("change", function() {
				var $this = $(this),
				nextClassName = $this.val();
				$.cookie('type', nextClassName);
				
				if (!$body.hasClass(nextClassName)) {
					changeBodyClass(nextClassName, type_classes);
				}
				
			})
			
		}
		
		if ( config.skin ) {
			
			var $block_skin, $label_skin, $desc_skin, $ul = $("<ul/>"), html_skin = '', theme_classes = [];
			
			$.each(config.skin, function(index, value) {
				
				$block_skin = $('<div/>').addClass('style-block').attr({ id : value.id });
				
				$label_skin = $('<h6>' + value.name + '</h6>');
				$desc_skin = $('<span>' + value.desc +'</span>');
				
				$.each(value.list, function(index_list, value_list) {
					html_skin += '<li class="'+ value_list.className +'" value="' + value_list.className + '"><a  href="' + value_list.className + '" style="background-color: ' + value_list.color  + '">' + value_list.name + '</a></li>';
					defaultSettings[index] = index_list;
					theme_classes.push(value_list.className);
				});
				
				$ul.html(html_skin);
				$block_skin.append($label_skin, $desc_skin, $ul);
				$themePanel.append($block_skin);
							
			});
			
			$block_skin.find('a').click(function() {

				var nextClassName = $(this).attr('href');

				$.cookie('color', nextClassName);

				if (!$body.hasClass(nextClassName)) {
					changeBodyClass(nextClassName, theme_classes);
					$block_skin.find('.active').removeClass('active');
					$(this).parent().addClass('active');			
				}
				return false;
			});	

		}
		
		if ( config.background ) {
			
			var $block_bg, $label_bg, $desc_bg, $ul_bg = $("<ul/>"), html_bg = '', bg_classes = [];
			
			$.each(config.background, function(index, value) {
				
				$block_bg = $('<div/>').addClass('style-block').attr({ id : value.id });
				
				$label_bg = $('<h6>' + value.name + '</h6>');
				$desc_bg = $('<span>' + value.desc +'</span>');
				
				$.each(value.list, function(index_list, value_list) {
					html_bg += '<li class="'+ value_list.className +'" value="' + value_list.className + '"><a  href="' + value_list.className + '" >' + value_list.name + '</a></li>';
					defaultSettings[index] = index_list;
					bg_classes.push(value_list.className);
				});
				
				$ul_bg.html(html_bg);
				$block_bg.append($label_bg, $desc_bg, $ul_bg);
				
				$themePanel.after($block_bg);
							
			});
			
			$block_bg.css("display","none");
			
			$block_bg.find('a').click(function() {

				var nextClassName = $(this).attr('href');

				$.cookie('pattern', nextClassName);

				if (!$body.hasClass(nextClassName)) {
					changeBodyClass(nextClassName, bg_classes);
					$block_bg.find('.active').removeClass('active');
					$(this).parent().addClass('active');			
				}
				return false;
			});	
			
		}
		
		/* Reset Settings  --> Begin */
		
		var setDefaultsSettings = function() {
			$.cookie('layout', null);
			$.cookie('type', null);
			$.cookie('pattern', null);
			$.cookie('color', null);
			$block_bg.animate({ left : '-50px'},250);
			$themePanel.find("select").val("");
			$themePanel.find('.active').removeClass("active");
			changeBodyClass(config.layout.style.list[1].className, layout_classes);
			changeBodyClass(config.type.style.list[1].className, type_classes);
			changeBodyClass(config.background.pattern.list[1].className, bg_classes);
			changeBodyClass(config.skin.colors.list[1].className, theme_classes);
			
			if ( $('#layerslider').length ) {
				location.reload();
			}	
			
			return false;
		};

		var $restore_button_wrapper = $('<div/>').addClass('restore-button-wrapper');
		var $restore_button = $('<a/>').text('Reset').attr('id','restore-button').addClass('button default medium').click(setDefaultsSettings);
			$restore_button_wrapper.append($restore_button);
			
			$themePanel.append($restore_button_wrapper);

		/* Reset Settings  --> Begin */

		
		/* Control Panel Label --> Begin */		

		$panel_label.click(function() {
			if ($themePanel.hasClass('visible')) {
				$themePanel.animate({
					left: '-190px'
				}, 400, function() {
					$themePanel.removeClass('visible');
				});
				$block_bg.animate({
					left: '-200px'
				}, 200);
				
			} else {
				$themePanel.animate({
					left: 0
				}, 400, function() {
					$themePanel.addClass('visible');
				});
				animUpDown(layout);
			}
			return false;
		});
		
		/* Control Panel Label --> End */
		
		$body.append($themePanel);
		
		if( layout ) {

			if ( !$body.hasClass(layout) ) {
				$body.removeClass(objToString(layout_classes)).addClass(layout);
			}
			
		}
		
		if( type ) {

			if ( !$body.hasClass(type) ) {
				$body.removeClass(objToString(type_classes)).addClass(type);
			}
			
		}
		
		if( pattern ) {
			
			if ( !$body.hasClass(pattern) ) {
				$body.removeClass(objToString(bg_classes)).addClass(pattern);
			}
			
			var activepattern = $block_bg.find("li").filter(function() { 
				return $(this).attr('class') == pattern; 
			});
			activepattern.addClass('active');

		}

		if( color ) {

			if ( !$body.hasClass(color) ) {
				$body.removeClass(objToString(theme_classes)).addClass(color);
			}

			if ( !$body.hasClass(color) ) {
				$body.removeClass(objToString(theme_classes)).addClass(color);
			}

			var activecolor = $block_skin.find("li").filter(function() { 
				return $(this).attr('class') == color; 
			});
			activecolor.addClass("active");

		}
	
	}

});

/* ---------------------------------------------------- */
/*	jQuery Cookie
/* ---------------------------------------------------- */

jQuery.cookie = function (name, value, options) {
	if (typeof value != 'undefined') {
		options = options || {};
		if (value === null) {
			value = '';
			options.expires = -1
		}
		var expires = '';
		if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
			var date;
			if (typeof options.expires == 'number') {
				date = new Date();
				date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000))
			} else {
				date = options.expires
			}
			expires = '; expires=' + date.toUTCString()
		}
		var path = options.path ? '; path=' + (options.path) : '';
		var domain = options.domain ? '; domain=' + (options.domain) : '';
		var secure = options.secure ? '; secure' : '';
		document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('')
	} else {
		var cookieValue = null;
		if (document.cookie && document.cookie != '') {
			var cookies = document.cookie.split(';');
			for (var i = 0; i < cookies.length; i++) {
				var cookie = jQuery.trim(cookies[i]);
				if (cookie.substring(0, name.length + 1) == (name + '=')) {
					cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
					break
				}
			}
		}
		return cookieValue
	}
};

/* end jQuery Cookie */
