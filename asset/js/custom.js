/*global jQuery, window, Modernizr, navigator, lang_home, objFlexSlider, objLayerSlider, objFlickr, jCarousel, objPostSlider, objGallerySlider, objTestimonials, objBlackAndWhite, google, objGoogleMap*/

(function ($, win, Modernizr, nav, doc) {

	"use strict";

	$(function () {

		/* ---------------------------------------------------- */
		/*	Main Navigation										*/
		/* ---------------------------------------------------- */

		(function () {

			var	arrowimages = {
				down: 'downarrowclass',
				right: 'rightarrowclass'
			}, $mainNav = $('#navigation'), $mainList  = $mainNav.find('ul').eq(0), optionsList = '<option value="" selected>Navigate...</option>', $submenu = $mainList.find("ul").parent();

			$submenu.each(function (i) {
				var $curobj = $(this);
					this.istopheader = ($curobj.parents("ul").length === 1 ? true : false);
				$curobj.children("a").append('<span class="' + (this.istopheader ? arrowimages.down : arrowimages.right) + '"></span>');
			});

			$mainList.on('mouseenter', 'li', function () {
				var $this    = $(this),
					$subMenu = $this.children('ul');
				if ($subMenu.length) {
					$this.addClass('hover');
				}
				$subMenu.hide().stop(true, true).fadeIn(200);
			}).on('mouseleave', 'li', function () {
				$(this).removeClass('hover').children('ul').stop(true, true).fadeOut(50);
			});

			// Responsive
			$mainList.find('li').each(function () {
				var $this   = $(this), $anchor = $this.children('a'), depth   = $this.parents('ul').length - 1, indent  = '';
				if (depth) {
					while (depth > 0) {
						indent += '-';
						depth = depth - 1;
					}
				}
				optionsList += '<option value="' + $anchor.attr('href') + '">' + indent + ' ' + $anchor.text() + '</option>';

			});

			$mainNav.after('<select class="responsive-nav">' + optionsList + '</select>');

			$('.responsive-nav').on('change', function () {
				win.location = $(this).val();
			});

			$.fn.headerToFixed = function (options) {

				var defaults = {
					speed : 300,
					windowWidth : $(win).width(),
					scrollTop : $(win).scrollTop()
				}, o = $.extend({}, defaults, options), $this = $(this), $clone = $('#logo').clone(), heightHeader = $this.height();

				if (o.windowWidth > 767) {
					if (o.scrollTop > heightHeader) {
						if (!$this.hasClass('fixed')) {
							$this.find('.sixteen').prepend($clone);
							$this.slideUp(o.speed).addClass('fixed').stop(true, true).slideDown(o.speed);
						}
					} else {
						if ($this.hasClass('fixed')) {
							$this.stop(true, true).slideUp(o.speed).stop(true, true).removeClass('fixed').slideDown(o.speed);
							$this.find('.sixteen #logo').fadeOut(o.speed).remove();
						}
					}
				}
			};

			if (!Modernizr.touch) {
				$(win).scroll(function () {
					$('#header').headerToFixed();
				});
			}

		}());

		/* end Main Navigation */

		/* ---------------------------------------------------- */
		/*	Media Element										*/
		/* ---------------------------------------------------- */

		(function () {

			var $player = $('audio, video');

			if ($player.length) {

				$player.mediaelementplayer({
					audioWidth: '100%',
					audioHeight: '30px',
					videoWidth: '100%',
					videoHeight: '100%'
				});

			}
		}());

		/* ---------------------------------------------------------------------- */
		/*	Detect Touch Device													  */
		/* ---------------------------------------------------------------------- */

		(function () {

			if (Modernizr.touch) {
				$('body').addClass('touch-device');
			}

			if ($.browser.safari === true) {
				$('body').addClass('safari');
			}

		}());

		/* end Detect Touch Device */

		/*--------------------------------------------------------------------*/
		/* Flex Slider														  */
		/*--------------------------------------------------------------------*/

		(function () {

			var $flex = $('.flexslider');

			if ($flex.length) {
				$(win).load(function () {
					$flex.flexslider(objFlexSlider);
				});
			}

		}());

		/* end Flex Slider */

		/*--------------------------------------------------------------------*/
		/* Layer Slider														  */
		/*--------------------------------------------------------------------*/

		(function () {

			var $layer = $('#layerslider');

			if ($layer.length) {
				$layer.layerSlider(objLayerSlider);
			}

		}());

		/* end Layer Slider */

		/* ---------------------------------------------------- */
		/* Flickr												*/
		/* ---------------------------------------------------- */

		(function () {

			if ($('.flickr-badge').length) {

				var $flickr = $('.flickr-badge');
				$flickr.jflickrfeed(objFlickr, function () {

					var $bwWrapper = jQuery('.badge');

					jQuery(win).load(function () {

						$bwWrapper.BlackAndWhite({
							hoverEffect: true, // default true
							// set the path to BnWWorker.js for a superfast implementation
							webworkerPath: '',
							// for the images with a fluid width and height 
							responsive: true,
							invertHoverEffect: false,
							speed: {//this property could also be just speed: value for both fadeIn and fadeOut
								fadeIn: 400, // 400ms for fadeIn animations
								fadeOut: 800 // 800ms for fadeOut animations
							}
						});
					});
				});
			}

		}());

		/* end Flickr */

		/* ---------------------------------------------------- */
		/*	Tabs												*/
		/* ---------------------------------------------------- */

		(function () {

			var $contentTabs = $('.content-tabs');

			if ($contentTabs.length) {

				$contentTabs.each(function (i, val) {

					var $tabsNav = $('.tabs-nav', val), tabsNavLis = $tabsNav.children('li'), $tabsContainer = $('.tabs-container', val);

					$tabsNav.each(function () {
						$(this).next().children('.tab-content').first().stop(true, true).show();
						$(this).children('li').first().addClass('active').stop(true, true).show();
					});

					$(val).on('click', 'a', function (e) {

						var $this = $(this).parent('li'), $index = $this.index();
						$this.siblings().removeClass('active').end().addClass('active');
						$this.parent().next().children('.tab-content').stop(true, true).hide().eq($index).stop(true, true).fadeIn(250, function () {

							var self = $(this);

							self.parent('.tabs-container').animate({
								height : self.outerHeight(true)
							}, 200);

						});
						e.preventDefault();
					});

					function adjustTabs() {
						$tabsContainer.each(function () {
							var $this = $(this);
							$this.height($this.children('.tab-content:visible').outerHeight());
						});
					}

					// Init
					adjustTabs();

					// Window resize
					$(win).on('resize', function () {

						var timer = win.setTimeout(function () {
							win.clearTimeout(timer);
							adjustTabs();
						}, 30);
					});

				});
			}

		}());

		/* end Tabs */

		/*----------------------------------------------------*/
		/*	Accordion and Toggle							  */
		/*----------------------------------------------------*/

		(function () {

			if ($('.acc-box').length) {

				var $box = $('.acc-box');

				$box.each(function () {

					var $trigger = $('.acc-trigger', this);

					$trigger.first().addClass('active').next().show();

					$trigger.on('click', function (e) {

						var $this = $(this);

						if ($this.attr('data-mode') === 'toggle') {
							$this.toggleClass('active').next().stop(true, true).slideToggle(300);
						} else if ($this.next().is(':hidden')) {
							$trigger.removeClass('active').next().slideUp(300);
							$this.toggleClass('active').next().slideDown(300);
						}
						e.preventDefault();
					});

				});

			}

		}());

		/* end Accordion and Toggle */

		/*----------------------------------------------------*/
		/*	Alert Boxes										  */
		/*----------------------------------------------------*/

		(function () {

			var $notifications = $('.error, .success, .info, .notice');

			if ($notifications.length) {
				$notifications.notifications({
					speed: 300
				});
			}

		}());

		/* ---------------------------------------------------- */
		/* Back to Top											*/
		/* ---------------------------------------------------- */

		(function () {

			var extend = {
				button: '#back-top',
				text: 'Back to Top',
				min: 200,
				fadeIn: 400,
				fadeOut: 400,
				speed: 800
			}, oldiOS = false, oldAndroid = false;

			// Detect if older iOS device, which doesn't support fixed position
			if (/(iPhone|iPod|iPad)\sOS\s[0-4][_\d]+/i.test(nav.userAgent)) {
				oldiOS = true;
			}

			// Detect if older Android device, which doesn't support fixed position
			if (/Android\s+([0-2][\.\d]+)/i.test(nav.userAgent)) {
				oldAndroid = true;
			}

			$('body').append('<a href="#" id="' + extend.button.substring(1) + '" title="' + extend.text + '">' + extend.text + '</a>');

			$(win).scroll(function () {
				var pos = $(win).scrollTop();

				if (oldiOS || oldAndroid) {
					$(extend.button).css({
						'position': 'absolute',
						'top': pos + $(win).height()
					});
				}

				if (pos > extend.min) {
					$(extend.button).fadeIn(extend.fadeIn);
				} else {
					$(extend.button).fadeOut(extend.fadeOut);
				}

			});

			$(extend.button).on('click', function (e) {
				$('html, body').animate({
					scrollTop: 0
				}, extend.speed);
				e.preventDefault();
			});

		}());

		/* end Back to Top */

		/* ---------------------------------------------------- */
		/*	Projects Carousel									*/
		/* ---------------------------------------------------- */

		(function () {

			var $carousel = $('.projects-carousel'), scrollCount;

			function getWindowWidth() {

				var windowWidth = $(win).width();

				if (windowWidth < 960) {
					scrollCount = 1;
				} else {
					scrollCount = 4;
				}
			}

			function resetPosition(elem, resizeEvent) {
				if (elem.data('resize')) {
					elem.css('left', '0');
				}
			}

			function initCarousel($carousels) {

				$carousels.each(function () {

					var $this = $(this), windowWidth = $(win).width();

					$this.jcarousel({
						animation: jCarousel.animation,
						easing: jCarousel.easing,
						scroll: $this.data('scroll-count') ? (windowWidth < 960 ? 1 : parseInt($this.data('scroll-count'))) : scrollCount,
						itemVisibleInCallback : function() {
							onBeforeAnimation : resetPosition($this);
							onAfterAnimation  : resetPosition($this);
						},
						auto: ($this.data('auto') ? parseInt($this.data('auto')) : 0),
						wrap: ($this.data('auto') ? 'both' : null)
					});
				});

			}

			function adjustCarousel() {

				$carousel.each(function () {

					var $this = $(this), $lis = $this.children('li'), newWidth = $lis.length * $lis.first().outerWidth(true), timer;

					getWindowWidth();

					if ($this.width() !== newWidth) {

						$this.css('width', newWidth).data('resize', 'true');
						initCarousel($this);
						$this.jcarousel('scroll', 1);

						timer = win.setTimeout(function () {
							win.clearTimeout(timer);
							$this.data('resize', null);
						}, 600);

					}

				});

			}

			function swipeFunc(e, dir) {

				var $carousel = $(e.currentTarget);

				if (dir === 'left') {
					$carousel.parent('.jcarousel-clip').siblings('.jcarousel-next').trigger('click');
				}

				if (dir === 'right') {
					$carousel.parent('.jcarousel-clip').siblings('.jcarousel-prev').trigger('click');
				}

			}

			if ($carousel.length) {

				getWindowWidth();
				initCarousel($carousel);

				// Detect Swipe
				if (Modernizr.touch) {

					$carousel.swipe({
						swipeLeft: swipeFunc,
						swipeRight: swipeFunc,
						allowPageScroll: 'auto'
					});

				}

				// Resize Window
				$(win).on('resize', function () {

					var timer = win.setTimeout(function () {
						win.clearTimeout(timer);
						adjustCarousel();
					}, 30);

				});
			}

		}());

		/* end Projects Carousel */

		/*----------------------------------------------------*/
		/*	Search Form										  */
		/*----------------------------------------------------*/

		(function () {

			var $search = $('.search-wrapper'), $text = $('input[type="text"]', $search), $submit = $('.submit-search', $search);

			function closeSearch(el, text) {
				$submit.removeClass("active");
				el.stop(true, false).animate({
					width: 0,
					paddingRight: '35px'
				}, 250, function () {
					text.val("").click(function () {
						return false;
					});
					el.removeClass("active").find("input[type='text']").blur();
				});
			}

			function searchAnimate(wrapper, text) {
				wrapper.stop(true, false).animate({
					width: '185px',
					paddingRight: '41px'
				}, 250, function () {
					wrapper.addClass("active").find("input[type='text']").focus();
					text.click(function () {
						return false;
					});
				});
				return false;
			}

			$submit.on('click', function (e) {
				var target = $(e.target);

				if ($(target).hasClass('active')) {
					return true;
				} else {
					target.addClass("active");
					searchAnimate($search, $text);
				}
				return false;
			});


			$('body').on('click', function (e) {
				var current = $(e.target);
				if ($search.hasClass('active')) {
					if (current !== $submit) {
						closeSearch($search, $text);
					}

				}
			});

		}());

		/* end Search Form */

		/* ---------------------------------------------------------------------- */
		/*	Custom Functions													  */
		/* ---------------------------------------------------------------------- */

		// Fixed scrollHorz effect
		$.fn.cycle.transitions.fixedScrollHorz = function ($cont, $slides, opts) {

			$('.post-slider-nav a').on('click', function (e) {
				$cont.data('dir', '');
				if (e.target.className.indexOf('prev') > -1) {
					$cont.data('dir', 'prev');
				}
			});

			$cont.css('overflow', 'hidden');
			opts.before.push($.fn.cycle.commonReset);
			var w = $cont.width();
			opts.animIn.left = 0;
			opts.animOut.left = 0-w;
			opts.cssFirst.left = 0;
			opts.cssBefore.left = w;
			opts.cssBefore.top = 0;

			if ($cont.data('dir') === 'prev') {
				opts.cssBefore.left = -w;
				opts.animOut.left = w;
			}

		};

		/* ---------------------------------------------------- */
		/*	Image Post Slider									*/
		/* ---------------------------------------------------- */

		(function () {

			function swipeFunc(e, dir) {

				var $postslider = $(e.currentTarget);

				// Enable swipes if more than one slide
				if ($postslider.data('slideCount') > 1) {

					$postslider.data('dir', '');

					if (dir === 'left') {
						$postslider.cycle('next');
					}

					if (dir === 'right') {
						$postslider.data('dir', 'prev');
						$postslider.cycle('prev');
					}
				}
			}

			var $postslider = $('.image-post-slider > ul');

			if ($postslider.length) {

				$postslider.each(function (i) {

					var $this = $(this);

					$this.css('height', $this.children('li:first').height()).after('<div class="post-slider-nav"><a class="prevBtn post-nav-prev-' + i + '">Prev</a><a class="nextBtn post-nav-next-' + i + '">Next</a></div>').cycle({
						before: function (curr, next, opts) {
							var $this = $(this);
							$this.parent().stop().animate({
								height: $this.height()
							}, opts.speed);
						},
						containerResize: false,
						easing: objPostSlider.easing,
						fx: 'fixedScrollHorz',
						fit: true,
						next: '.post-nav-next-' + i,
						pause: true,
						prev: '.post-nav-prev-' + i,
						slideResize: true,
						speed: objPostSlider.speed,
						timeout: objPostSlider.timeout,
						width: '100%'
					}).data('slideCount', $postslider.children('li').length);
				});

				// Pause on Nav Hover
				$('.post-slider-nav a').on('mouseenter', function () {
					$(this).parent().prev().cycle('pause');
				}).on('mouseleave', function () {
					$(this).parent().prev().cycle('resume');
				});

				// Hide navigation if only a single slide
				if ($postslider.data('slideCount') <= 1) {
					$postslider.next('.post-slider-nav').hide();
				}

				// Resize
				$(win).on('resize', function () {
					$postslider.css('height', $postslider.find('li:visible').height());
				});

				// Include Swipe
				if (Modernizr.touch) {

					$postslider.swipe({
						swipeLeft: swipeFunc,
						swipeRight: swipeFunc,
						allowPageScroll: 'auto'
					});

				}
			}

		}());

		/* ---------------------------------------------------- */
		/*	Image Gallery Slider								*/
		/* ---------------------------------------------------- */

		(function () {

			function swipeFunc(e, dir) {

				var $projects = $(e.currentTarget);

				// Enable swipes if more than one slide
				if ($projects.data('slideCount') > 1) {

					$projects.data('dir', '');

					if (dir === 'left') {
						$projects.cycle('next');
					}

					if (dir === 'right') {
						$projects.data('dir', 'prev');
						$projects.cycle('prev');
					}

				}

			}

			var $projects = $('.image-gallery-slider > ul');

			if ($projects.length) {

				$(win).load(function () {

					$projects.each(function (i) {

						var $this = $(this);

						$this.css('height', $this.children('li:first').height()).after('<div class="gallery-slider-nav"><a class="prevBtn gallery-nav-prev-' + i + '">Prev</a> <a class="nextBtn gallery-nav-next-' + i + '">Next</a> </div>').cycle({
							before: function (curr, next, opts) {
								var $this = $(this);
								$this.parent().stop().animate({
									height: $this.height()
								}, opts.speed);
							},
							containerResize: false,
							easing: objGallerySlider.easing,
							fit: true,
							next: '.gallery-nav-next-' + i,
							pause: true,
							prev: '.gallery-nav-prev-' + i,
							slideResize: true,
							speed: objGallerySlider.speed,
							timeout: objGallerySlider.timeout,
							width: '100%'
						}).data('slideCount', $projects.children('li').length);
					});

					// Pause on Nav Hover
					$('.gallery-nav a').on('mouseenter', function () {
						$(this).parent().prev().cycle('pause');
					}).on('mouseleave', function () {
						$(this).parent().prev().cycle('resume');
					});

					// Hide navigation if only a single slide
					if ($projects.data('slideCount') <= 1) {
						$projects.next('.projects-nav').hide();
					}

				});

				// Resize
				$(win).on('resize', function () {
					$projects.css('height', $projects.find('li:visible').height());
				});

				// Include Swipe
				if (Modernizr.touch) {

					$projects.swipe({
						swipeLeft: swipeFunc,
						swipeRight: swipeFunc,
						allowPageScroll: 'auto'
					});

				}
			}

		}());

		/* ---------------------------------------------------- */
		/*	Testimonials										*/
		/* ---------------------------------------------------- */

		(function () {

			function swipeFunc(e, dir) {

				var $quotes = $(e.currentTarget);

				// Enable swipes if more than one slide
				if ($quotes.data('slideCount') > 1) {

					$quotes.data('dir', '');

					if (dir === 'left') {
						$quotes.cycle('next');
					}

					if (dir === 'right') {
						$quotes.data('dir', 'prev');
						$quotes.cycle('prev');
					}

				}

			}

			var $quotes = $('.testimonials');

			if ($quotes.length) {

				$quotes.each(function (i) {

					var $this = $(this);

					$this.css('height', $this.children('li:first').height()).cycle({
						before: function (curr, next, opts) {
							var $this = $(this);
							$this.parent().stop().animate({
								height: $this.height()
							}, opts.speed);
						},
						containerResize: false,
						easing: objTestimonials.easing,
						fit: true,
						next: '',
						pause: true,
						prev: '',
						slideResize: true,
						speed: objTestimonials.speed,
						timeout: objTestimonials.timeout,
						width: '100%'
					}).data('slideCount', $this.children('li').length);

				});

				// Resize
				$(win).on('resize', function () {
					$quotes.css('height', $quotes.find('li:visible').height());
				});

				// Include Swipe
				if (Modernizr.touch) {

					$quotes.swipe({
						swipeLeft: swipeFunc,
						swipeRight: swipeFunc,
						allowPageScroll: 'auto'
					});

				}
			}

		}());

		/* ---------------------------------------------------- */
		/*	Fancybox											*/
		/* ---------------------------------------------------- */

		(function () {

			if ($('.single-image.link-icon').length || $('.single-image.plus-icon').length || $('.single-image.video-icon').length) {

				// Link Icon
				$('.single-image.link-icon, .single-image.plus-icon').fancybox({
					'titleShow': true,
					'transitionIn': 'fade',
					'transitionOut': 'fade',
					'easingIn': 'easeOutBack',
					'easingOut': 'easeInBack',
					helpers: {
						title: {
							type: 'over'
						}
					}
				}).each(function () {
					$(this).append('<span class="curtain"></span>');
				});

				// Video Icon
				$('.single-image.video-icon').fancybox({
					type: 'iframe',
					openEffect: 'fade',
					closeEffect: 'fade',
					nextEffect: 'fade',
					prevEffect: 'fade',
					helpers: {
						title: {
							type: 'over'
						}
					},
					width: '70%',
					height: '70%',
					maxWidth: 800,
					maxHeight: 600,
					fitToView: false,
					autoSize: false
				}).each(function () {
					$(this).append('<span class="curtain"></span>');
				});

			}

		}());

		/* end Fancybox --> End */

		/* ---------------------------------------------------- */
		/*	Blackandwhite										*/
		/* ---------------------------------------------------- */

		(function () {

			if ($('.bwWrapper').length) {

				var	obj = {
					'.flexslider' : '.flex-direction-nav',
					'.image-post-slider' : '.post-slider-nav',
					'.image-gallery-slider' : '.gallery-slider-nav'
				}, $bw = $('.bwWrapper:not(.badge)');

				$.fn.extendBW = function (object) {
					$.each(object, function (cont, nav) {
						$(cont).on('mouseenter', ' ' + nav + ' ' + 'a', function () {
							$(cont).find('canvas, .BWfade').hide();
							$(nav).on('mouseleave', function () {
								$(cont).find('canvas, .BWfade').show(0);
							});
						});
					});
				};

				$.fn.extendBW(obj);

				$(win).load(function () {
					$bw.BlackAndWhite(objBlackAndWhite);
				});
			}

		}());

		/* end BlackAndWhite --> End */

		/* ---------------------------------------------------- */
		/*	Portfolio											*/
		/* ---------------------------------------------------- */

		(function () {

			var $cont = $('#portfolio-items'), $itemsFilter, mouseOver;

			if ($cont.length) {

				$itemsFilter = $('#portfolio-filter');

				// Copy categories to item classes
				$('article', $cont).each(function (i) {
					var $this = $(this);
					$this.addClass($this.attr('data-categories'));
				});

				// Run Isotope when all images are fully loaded
				$(doc).ready(function () {

					$cont.isotope({
						itemSelector: 'article',
						layoutMode: 'fitRows'
					}, $(this).preloader({
						speed: 280
					}));

				});

				// Filter projects
				$itemsFilter.on('click', 'a', function (e) {
					var $this = $(this), currentOption = $this.attr('data-categories');

					$itemsFilter.find('a').removeClass('active');
					$this.addClass('active');

					if (currentOption) {
						if (currentOption !== '*') {
							currentOption = currentOption.replace(currentOption, '.' + currentOption);
						}

						$cont.isotope({
							filter: currentOption
						});
					}

					e.preventDefault();
				});

				$itemsFilter.find('a').first().addClass('active');
			}

		}());

		/* end Portfolio  */

		/* ---------------------------------------------------- */
		/*	FitVids												*/
		/* ---------------------------------------------------- */

		(function () {

			function adjustVideos() {

				var $videos = $('.video-container');

				$videos.each(function () {

					var $this = $(this), playerWidth  = $this.parent().actual('width'), playerHeight = playerWidth / $this.data('aspectRatio');

					$this.css({
						'height' : playerHeight,
						'width'  : playerWidth
					});
				});
			}

			$('.container').each(function () {

				var selectors = [
					"iframe[src^='http://player.vimeo.com']",
					"iframe[src^='http://www.youtube.com']",
					"object",
					"embed"
				], $allVideos = $(this).find(selectors.join(','));

				$allVideos.each(function () {

					var $this = $(this),
						videoHeight = $this.attr('height') || $this.actual('width'),
						videoWidth  = $this.attr('width') || $this.actual('width');

					if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.video-container').length) {
						return;
					}

					$this.css({
						'height' : '100%',
						'width'  : '100%'
					}).removeAttr('height').removeAttr('width').wrap('<div class="video-container"></div>').parent('.video-container').css({
						'height' : videoHeight,
						'width'  : videoWidth
					}).data('aspectRatio', videoWidth / videoHeight);
					adjustVideos();
				});

			});

			$(win).on('resize', function () {
				var timer = win.setTimeout(function () {
					win.clearTimeout(timer);
					adjustVideos();
				}, 30);
			});

		}());

		/* end FitVids */

		/* ---------------------------------------------------- */
		/*	Preloader											*/
		/* ---------------------------------------------------- */

		(function () {

			$.preloader = function (el, options) {
				var elem = $(el), methods = {},
					elements = elem.find('.preloader'),
					o = $.extend({}, $.preloader.defaults, options);

				methods = {
					init: function () {
						this.loader();
					},
					loader: function () {
						elements.each(function (i, val) {
							win.setTimeout(function () {
								$(val).addClass('loader');
							}, i * o.speed);
						});
					}
				};
				methods.init();

				$(win).load(function () {
					elements.filter('.loader').removeClass('loader');
				});

			};

			$.preloader.defaults = {speed : 250};

			$.fn.preloader = function (options) {
				if (typeof options === 'object') {
					return this.each(function () {
						new $.preloader(this, options);
					});
				};
			};

			if (!$('.portfolio-items').length) {
				$('.container').preloader({
					speed: 300
				});
			}
		}());

		/* end Preloader */

		/* ---------------------------------------------------- */
		/*	Detail Detect touch									*/
		/* ---------------------------------------------------- */

		(function () {

			if (Modernizr.touch) {

				var detailBox = $('.detail-box');

				detailBox.on('click', function (e) {
					var target = $(e.target);
					target.addClass('touched');
				});
			}

		}());

		/* end Detail Detect touch */

		/* ---------------------------------------------------- */
		/*	Min Height											*/
		/* ---------------------------------------------------- */

		(function () {

			function setMinHeight() {

				$('#content').css('min-height',
					$(win).outerHeight(true)
					- $('#header').outerHeight(true)
					- $('#footer').outerHeight(true) - 125
					);

			}

			setMinHeight();

			$(win).on('resize', function () {
				var timer = win.setTimeout(function () {
					win.clearTimeout(timer);
					setMinHeight();
				}, 50);
			});

		}());

		/* end Min-height */

		/* ---------------------------------------------------- */
		/*	Google Maps											*/
		/* ---------------------------------------------------- */

		(function () {

			if ($('.google_map').length) {
				var $gmap = $('.google_map'), mapType;

				/* Maptype:
				 google.maps.MapTypeId.ROADMAP 
				 google.maps.MapTypeId.SATELLITE
				google.maps.MapTypeId.HYBRID
				 google.maps.MapTypeId.TERRAIN */

				if (win.google) {
					mapType = google.maps.MapTypeId.TERRAIN;
				}

				objGoogleMap.maptype = mapType;
				$gmap.gMap(objGoogleMap);
			}

		}());

		/* end Google Maps */

		/* ---------------------------------------------------- */
		/*	Contact Form										*/
		/* ---------------------------------------------------- */

		(function () {

			if ($('.contact-form').length) {

				var $form = $('.contact-form'),
					$loader = '<span>Loader...</span>';
				$form.append('<div class="hide contact-form-responce" />');

				$form.each(function () {

					var $this = $(this), $response = $('.contact-form-responce', $this).append('<p></p>');

					$this.submit(function () {

						$response.find('p').html($loader);

						var data = {
							action: "contact_form_request",
							values: $this.serialize()
						};

						//send data to server
						$.post("php/contact-send.php", data, function (response) {

							response = $.parseJSON(response);

							$(".wrong-data", $this).removeClass("wrong-data");
							$response.find('span').remove();

							if (response.is_errors) {

								$response.find('p').removeClass().addClass("error");
								$.each(response.info, function (input_name, input_label) {
									$("[name=" + input_name + "]", $this).addClass("wrong-data");
									$response.find('p').append('Please enter correctly "' + input_label + '"!' + '</br>');
								});

								$response.show(300);

							} else {

								$response.find('p').removeClass().addClass('success');

								if (response.info === 'success') {
									$response.find('p').append('Your email has been sent!');
									$this.find('input:not(input[type="submit"], button), textarea, select').val('').attr('checked', false);
									$response.show(300).delay(2500).hide(400);
								}

								if (response.info === 'server_fail') {
									$response.find('p').append('Server failed. Send later!');
									$response.show(300);
								}
							}

							// Scroll to bottom of the form to show respond message
							var bottomPosition = $response.offset().top;

							if ($(doc).scrollTop() < bottomPosition) {
								$('html, body').animate({ scrollTop : bottomPosition });
							}

						});

						return false;

					});
				});

			}

		}());

		/* end Contact Form */

	});

	/* ---------------------------------------------------- */
	/*	Notifications										*/
	/* ---------------------------------------------------- */

	$.fn.notifications = function (options) {

		var defaults = {speed: 200}, o = $.extend({}, defaults, options);

		return this.each(function () {

			var closeBtn = $('<a class="alert-close" href="#"></a>'),
				closeButton = $(this).append(closeBtn).find('> .alert-close');

			function fadeItSlideIt(object) {
				object.fadeTo(o.speed, 0, function () {
					object.slideUp(o.speed);
				});
			}

			closeButton.click(function () {
				fadeItSlideIt($(this).parent());
				return false;
			});
		});
	};

	/* end jQuery Notifications */

	/* ---------------------------------------------------- */
	/*	Actual Plugin										*/
	/* ---------------------------------------------------- */

	// jQuery Actual Plugin - Version: 1.0.13 (http://dreamerslab.com/)
		;(function(a){a.fn.extend({actual:function(b,l){if(!this[b]){throw'$.actual => The jQuery method "'+b+'" you called does not exist';}var f={absolute:false,clone:false,includeMargin:false};var i=a.extend(f,l);var e=this.eq(0);var h,j;if(i.clone===true){h=function(){var m="position: absolute !important; top: -1000 !important; ";e=e.clone().attr("style",m).appendTo("body");};j=function(){e.remove();};}else{var g=[];var d="";var c;h=function(){c=e.parents().andSelf().filter(":hidden");d+="visibility: hidden !important; display: block !important; ";if(i.absolute===true){d+="position: absolute !important; ";}c.each(function(){var m=a(this);g.push(m.attr("style"));m.attr("style",d);});};j=function(){c.each(function(m){var o=a(this);var n=g[m];if(n===undefined){o.removeAttr("style");}else{o.attr("style",n);}});};}h();var k=/(outer)/g.test(b)?e[b](i.includeMargin):e[b]();j();return k;}});})(jQuery);

	/* end jQuery Actual Plugin */

}(jQuery, window, Modernizr, navigator, document));