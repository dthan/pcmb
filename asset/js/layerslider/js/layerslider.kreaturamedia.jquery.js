
/*
	* LayerSlider
	*
	* (c) 2011-2013 George Krupa, John Gera & Kreatura Media
	*
	* Plugin web:			http://kreaturamedia.com/
	* Licenses: 			http://codecanyon.net/licenses/
*/



function lsShowNotice(e, t, n) {
	if (typeof e == "string") {
		var r = jQuery("#" + e)
	} else if (typeof e == "object") {
		var r = e
	}
	var i, s;
	switch (t) {
	case "jquery":
		i = "multiple jQuery issue";
		s = "It looks like that one of your other plugins or your theme itself loads an extra copy of the jQuery library which causes a Javascript conflict and LayerSlider WP can't load your slider. <strong>Please navigate on your WordPress admin area to edit this slider and enable the \"Put JS includes to body\" option in the Global Settings under the Troubleshooting section.</strong><br><br>If this doesn't solve your problem, please try to disable every other plugin one-by-one to find out which one causes this issue. If you have found the corresponding plugin, please contact with the plugin author to solve this case. If none of your plugins causes this problem, it must be your theme and you should contact with the author of the theme. Ask help from them to remove any duplicates of the jQuery library.<br><br>If there is no one to help you, please write a comment in the comments section of the item on CodeCanyon.";
		break;
	case "oldjquery":
		i = "old jQuery issue";
		s = "It looks like you are using an old version (" + n + ') of the jQuery library. LayerSlider requires at least version 1.7.0 or newer. If you are using the WordPress version of LayerSlider, you can try out the "jQuery Updater" plugin from the WP plugin depository. If you don\'t know what to do, you can write us a private message from our CodeCanyon profile page. We need a temporary WP admin account (or a temporary FTP account in some cases) to solve this issue.';
		break;
	case "transit":
		i = "jQuery Transit issue";
		s = 'It looks like one of your other plugins also uses jQuery Transit and loads an extra copy of this library which can cause issues. Please navigate on your WordPress admin area to edit this slider and enable the "Put JS includes to body" option in your Global Settings under the Troubleshooting section.';
		break
	}
	r.addClass("ls-error");
	r.append('<p class="ls-exclam">!</p>');
	r.append('<p class="ls-error-title">LayerSlider: ' + i + "</p>");
	r.append('<p class="ls-error-text">' + s + "</p>")
} (function (e) {
	e.fn.layerSlider = function (n) {
		var r = "1.7.0";
		var i = e.fn.jquery;
		var s = e(this);
		var o = function (e, t) {
			var n = e.split(".");
			var r = t.split(".");
			for (var i = 0; i < n.length; ++i) {
				if (r.length == i) {
					return false
				}
				if (n[i] == r[i]) {
					continue
				} else if (n[i] > r[i]) {
					return false
				} else {
					return true
				}
			}
			if (n.length != r.length) {
				return true
			}
			return true
		};
		if (!o("1.8.0", i)) {
			s.addClass("ls-norotate")
		}
		if (!o(r, i)) {
			lsShowNotice(s, "oldjquery", i)
		} else {
			if ((typeof n).match("object|undefined")) {
				return this.each(function (e) {
					new t(this, n)
				})
			} else {
				if (n == "data") {
					var u = e(this).data("LayerSlider").g;
					if (u) {
						return u
					}
				} else {
					return this.each(function (t) {
						var r = e(this).data("LayerSlider");
						if (r) {
							if (!r.g.isAnimating && !r.g.isLoading) {
								if (typeof n == "number") {
									if (n > 0 && n < r.g.layersNum + 1 && n != r.g.curLayerIndex) {
										r.change(n)
									}
								} else {
									switch (n) {
									case "prev":
										r.o.cbPrev(r.g);
										r.prev("clicked");
										break;
									case "next":
										r.o.cbNext(r.g);
										r.next("clicked");
										break;
									case "start":
										if (!r.g.autoSlideshow) {
											r.o.cbStart(r.g);
											r.g.originalAutoSlideshow = true;
											r.start()
										}
										break
									}
								}
							}
							if (n == "debug") {
								r.d.show()
							}
							if ((r.g.autoSlideshow || !r.g.autoSlideshow && r.g.originalAutoSlideshow) && n == "stop") {
								r.o.cbStop(r.g);
								r.g.originalAutoSlideshow = false;
								r.g.curLayer.find('iframe[src*="www.youtu"], iframe[src*="player.vimeo"]').each(function () {
									clearTimeout(e(this).data("videoTimer"))
								});
								r.stop()
							}
						}
					})
				}
			}
		}
	};
	var t = function (s, o) {
		var u = this;
		u.$el = e(s).addClass("ls-container");
		u.$el.data("LayerSlider", u);
		u.load = function () {
			u.o = e.extend({},
			t.options, o);
			u.g = e.extend({},
			t.global);
			u.g.enableCSS3 = e(s).hasClass("ls-norotate") ? false: true;
			if (typeof layerSliderTransitions != "undefined") {
				u.t = e.extend({},
				layerSliderTransitions)
			}
			if (typeof layerSliderCustomTransitions != "undefined") {
				u.ct = e.extend({},
				layerSliderCustomTransitions)
			}
			if (!u.g.initialized) {
				u.g.initialized = true;
				if (u.o.allowDebugMode == true) {
					u.debug()
				}
				if (e("html").find('meta[content*="WordPress"]').length) {
					u.g.wpVersion = e("html").find('meta[content*="WordPress"]').attr("content").split("WordPress")[1]
				}
				if (e("html").find('script[src*="layerslider"]').length) {
					if (e("html").find('script[src*="layerslider"]').attr("src").indexOf("?") != -1) {
						u.g.lswpVersion = e("html").find('script[src*="layerslider"]').attr("src").split("?")[1].split("=")[1]
					}
				}
				if (u.o.allowDebugMode == true) {
					u.d.aT("LayerSlider controls");
					u.d.aU('<a href="#">prev</a> | <a href="#">next</a> | <a href="#">start</a> | <a href="#">stop</a> | <a href="#">force stop</a>');
					u.d.history.find("a").each(function () {
						e(this).click(function (t) {
							t.preventDefault();
							if (e(this).text() == "force stop") {
								e(s).find("*").stop(true, false);
								e(s).layerSlider("stop")
							} else {
								e(s).layerSlider(e(this).text())
							}
						})
					});
					u.d.aT("LayerSlider version information");
					u.d.aU("JS version: <strong>" + u.g.version + "</strong>");
					if (u.g.lswpVersion) {
						u.d.aL("WP version: <strong>" + u.g.lswpVersion + "</strong>")
					}
					if (u.g.wpVersion) {
						u.d.aL("WordPress version: <strong>" + u.g.wpVersion + "</strong>")
					}
					u.d.aL("jQuery version: <strong>" + e().jquery + "</strong>");
					if (e(s).attr("id")) {
						u.d.aT("LayerSlider container");
						u.d.aU("#" + e(s).attr("id"))
					}
					u.d.aT("Init code");
					u.d.aeU();
					for (var n in u.o) {
						u.d.aL(n + ": <strong>" + u.o[n] + "</strong>")
					}
				}
				if (!u.o.skin || u.o.skin == "" || !u.o.skinsPath || u.o.skinsPath == "") {
					if (u.o.allowDebugMode == true) {
						u.d.aT("Loading without skin. Possibilities: mistyped skin and / or skinsPath.")
					}
					u.init()
				} else {
					if (u.o.allowDebugMode == true) {
						u.d.aT("Trying to load with skin: " + u.o.skin, true)
					}
					e(s).addClass("ls-" + u.o.skin);
					var r = u.o.skinsPath + u.o.skin + "/skin.css";
					cssContainer = e("head");
					if (!e("head").length) {
						cssContainer = e("body")
					}
					if (e('link[href="' + r + '"]').length) {
						if (u.o.allowDebugMode == true) {
							u.d.aU('Skin "' + u.o.skin + '" is already loaded.')
						}
						i = e('link[href="' + r + '"]');
						if (!u.g.loaded) {
							u.g.loaded = true;
							setTimeout(function () {
								u.init()
							},
							150)
						}
					} else {
						if (document.createStyleSheet) {
							document.createStyleSheet(r);
							var i = e('link[href="' + r + '"]')
						} else {
							var i = e('<link rel="stylesheet" href="' + r + '" type="text/css" />').appendTo(cssContainer)
						}
					}
					i.load(function () {
						if (!u.g.loaded) {
							if (u.o.allowDebugMode == true) {
								u.d.aU("curSkin.load(); fired")
							}
							u.g.loaded = true;
							setTimeout(function () {
								u.init()
							},
							150)
						}
					});
					e(window).load(function () {
						if (!u.g.loaded) {
							if (u.o.allowDebugMode == true) {
								u.d.aU("$(window).load(); fired")
							}
							u.g.loaded = true;
							setTimeout(function () {
								u.init()
							},
							150)
						}
					});
					setTimeout(function () {
						if (!u.g.loaded) {
							if (u.o.allowDebugMode == true) {
								u.d.aT("Fallback mode: Neither curSkin.load(); or $(window).load(); were fired")
							}
							u.g.loaded = true;
							u.init()
						}
					},
					1e3)
				}
			}
		};
		u.init = function () {
			if (u.o.allowDebugMode == true) {
				u.d.aT("FUNCTION ls.init();");
				u.d.aeU()
			}
			if (!e("html").attr("id")) {
				e("html").attr("id", "ls-global")
			} else if (!e("body").attr("id")) {
				e("body").attr("id", "ls-global")
			}
			u.g.sliderWidth = function () {
				if (u.g.normalWidth && u.g.goingNormal) {
					return u.g.normalWidth
				} else {
					return e(s).width()
				}
			};
			u.g.sliderHeight = function () {
				if (u.g.normalHeight && u.g.goingNormal) {
					return u.g.normalHeight
				} else {
					return e(s).height()
				}
			};
			if (e(s).find(".ls-layer").length == 1) {
				u.o.autoStart = false;
				u.o.navPrevNext = false;
				u.o.navStartStop = false;
				u.o.navButtons = false;
				u.o.loops = 0;
				u.o.forceLoopNum = false;
				u.o.autoPauseSlideshow = true;
				u.o.firstLayer = 1;
				u.o.thumbnailNavigation = "disabled"
			}
			if (u.o.allowDebugMode == true) {
				u.d.aL("Number of slides found: <strong>" + e(s).find(".ls-layer").length + "</strong>")
			}
			if (u.o.width) {
				u.g.sliderOriginalWidthRU = u.g.sliderOriginalWidth = "" + u.o.width
			} else {
				u.g.sliderOriginalWidthRU = u.g.sliderOriginalWidth = e(s)[0].style.width
			}
			if (u.o.allowDebugMode == true) {
				u.d.aL("sliderOriginalWidth: <strong>" + u.g.sliderOriginalWidth + "</strong>")
			}
			if (u.o.height) {
				u.g.sliderOriginalHeight = "" + u.o.height
			} else {
				u.g.sliderOriginalHeight = e(s)[0].style.height
			}
			if (u.o.allowDebugMode == true) {
				u.d.aL("sliderOriginalHeight: <strong>" + u.g.sliderOriginalHeight + "</strong>")
			}
			if (u.g.sliderOriginalWidth.indexOf("%") == -1 && u.g.sliderOriginalWidth.indexOf("px") == -1) {
				u.g.sliderOriginalWidth += "px"
			}
			if (u.g.sliderOriginalHeight.indexOf("%") == -1 && u.g.sliderOriginalHeight.indexOf("px") == -1) {
				u.g.sliderOriginalHeight += "px"
			}
			if (u.o.responsive && u.g.sliderOriginalWidth.indexOf("px") != -1 && u.g.sliderOriginalHeight.indexOf("px") != -1) {
				u.g.responsiveMode = true
			} else {
				u.g.responsiveMode = false
			}
			e(s).find('*[class*="ls-s"], *[class*="ls-bg"]').each(function () {
				if (!e(this).parent().hasClass("ls-layer")) {
					e(this).insertBefore(e(this).parent())
				}
			});
			e(s).find(".ls-layer").each(function () {
				e(this).children(':not([class*="ls-"])').each(function () {
					e(this).remove()
				})
			});
			if (u.o.allowDebugMode == true) {
				u.d.aT("LayerSlider Content")
			}
			var t = 0;
			e(s).find('.ls-layer, *[class*="ls-s"]').each(function () {
				if (u.o.allowDebugMode == true) {
					if (e(this).hasClass("ls-layer")) {
						u.d.aU("<strong>SLIDE " + (e(this).index() + 1) + "</strong>");
						u.d.aUU();
						u.d.aL("<strong>SLIDE " + (e(this).index() + 1) + " properties:</strong><br><br>")
					} else {
						u.d.aU("    Layer ( " + e(this).prop("tagName") + " )");
						u.d.aF(e(this));
						u.d.aUU();
						u.d.aL("<strong>" + e(this).prop("tagName") + " layer properties:</strong><br><br>");
						u.d.aL("distance / class: <strong>" + e(this).attr("class") + "</strong>")
					}
				}
				if (e(this).attr("rel") || e(this).attr("style")) {
					if (e(this).attr("rel")) {
						var t = e(this).attr("rel").toLowerCase().split(";")
					} else {
						var t = e(this).attr("style").toLowerCase().split(";")
					}
					for (x = 0; x < t.length; x++) {
						param = t[x].split(":");
						if (param[0].indexOf("easing") != -1) {
							param[1] = u.ieEasing(param[1])
						}
						var n = "";
						if (param[2]) {
							n = ":" + e.trim(param[2])
						}
						if (param[0] != " " && param[0] != "") {
							e(this).data(e.trim(param[0]), e.trim(param[1]) + n);
							if (u.o.allowDebugMode == true) {
								u.d.aL(e.trim(param[0]) + ": <strong>" + e.trim(param[1]) + n + "</strong>")
							}
						}
					}
				}
				var r = e(this);
				r.data("originalLeft", r[0].style.left);
				r.data("originalTop", r[0].style.top);
				if (e(this).is("a") && e(this).children().length > 0) {
					r = e(this).children()
				}
				var i = r.width();
				var s = r.height();
				if (r[0].style.width && r[0].style.width.indexOf("%") != -1) {
					i = r[0].style.width
				}
				if (r[0].style.height && r[0].style.height.indexOf("%") != -1) {
					s = r[0].style.height
				}
				r.data("originalWidth", i);
				r.data("originalHeight", s);
				r.data("originalPaddingLeft", r.css("padding-left"));
				r.data("originalPaddingRight", r.css("padding-right"));
				r.data("originalPaddingTop", r.css("padding-top"));
				r.data("originalPaddingBottom", r.css("padding-bottom"));
				if (!u.g.ie78) {
					var o = typeof parseFloat(r.css("opacity")) == "number" ? Math.round(parseFloat(r.css("opacity")) * 100) / 100 : 1;
					e(this).data("originalOpacity", o)
				}
				if (r.css("border-left-width").indexOf("px") == -1) {
					r.data("originalBorderLeft", r[0].style.borderLeftWidth)
				} else {
					r.data("originalBorderLeft", r.css("border-left-width"))
				}
				if (r.css("border-right-width").indexOf("px") == -1) {
					r.data("originalBorderRight", r[0].style.borderRightWidth)
				} else {
					r.data("originalBorderRight", r.css("border-right-width"))
				}
				if (r.css("border-top-width").indexOf("px") == -1) {
					r.data("originalBorderTop", r[0].style.borderTopWidth)
				} else {
					r.data("originalBorderTop", r.css("border-top-width"))
				}
				if (r.css("border-bottom-width").indexOf("px") == -1) {
					r.data("originalBorderBottom", r[0].style.borderBottomWidth)
				} else {
					r.data("originalBorderBottom", r.css("border-bottom-width"))
				}
				r.data("originalFontSize", r.css("font-size"));
				r.data("originalLineHeight", r.css("line-height"))
			});
			if (document.location.hash) {
				for (var n = 0; n < e(s).find(".ls-layer").length; n++) {
					if (e(s).find(".ls-layer").eq(n).data("deeplink") == document.location.hash.split("#")[1]) {
						u.o.firstLayer = n + 1
					}
				}
			}
			e(s).find('*[class*="ls-linkto-"]').each(function () {
				var t = e(this).attr("class").split(" ");
				for (var n = 0; n < t.length; n++) {
					if (t[n].indexOf("ls-linkto-") != -1) {
						var r = parseInt(t[n].split("ls-linkto-")[1]);
						e(this).css({
							cursor: "pointer"
						}).click(function (t) {
							t.preventDefault();
							e(s).layerSlider(r)
						})
					}
				}
			});
			u.g.layersNum = e(s).find(".ls-layer").length;
			if (u.o.randomSlideshow && u.g.layersNum > 2) {
				u.o.firstLayer == "random";
				u.o.twoWaySlideshow = false
			} else {
				u.o.randomSlideshow = false
			}
			if (u.o.firstLayer == "random") {
				u.o.firstLayer = Math.floor(Math.random() * u.g.layersNum + 1)
			}
			u.o.firstLayer = u.o.firstLayer < u.g.layersNum + 1 ? u.o.firstLayer: 1;
			u.o.firstLayer = u.o.firstLayer < 1 ? 1 : u.o.firstLayer;
			u.g.nextLoop = 1;
			if (u.o.animateFirstLayer) {
				u.g.nextLoop = 0
			}
			e(s).find('iframe[src*="www.youtu"]').each(function () {
				e(this).parent().addClass("ls-video-layer");
				if (e(this).parent('[class*="ls-s"]')) {
					var t = e(this);
					e.getJSON("http://gdata.youtube.com/feeds/api/videos/" + e(this).attr("src").split("embed/")[1].split("?")[0] + "?v=2&alt=json&callback=?", function (e) {
						t.data("videoDuration", parseInt(e["entry"]["media$group"]["yt$duration"]["seconds"]) * 1e3)
					});
					var n = e("<div>").addClass("ls-vpcontainer").appendTo(e(this).parent());
					e("<img>").appendTo(n).addClass("ls-videopreview").attr("src", "http://img.youtube.com/vi/" + e(this).attr("src").split("embed/")[1].split("?")[0] + "/" + u.o.youtubePreview);
					e("<div>").appendTo(n).addClass("ls-playvideo");
					e(this).parent().css({
						width: e(this).width(),
						height: e(this).height()
					}).click(function () {
						u.g.isAnimating = true;
						if (u.g.paused) {
							if (u.o.autoPauseSlideshow != false) {
								u.g.paused = false
							}
							u.g.originalAutoSlideshow = true
						} else {
							u.g.originalAutoSlideshow = u.g.autoSlideshow
						}
						if (u.o.autoPauseSlideshow != false) {
							u.stop()
						}
						u.g.pausedByVideo = true;
						e(this).find("iframe").attr("src", e(this).find("iframe").data("videoSrc"));
						e(this).find(".ls-vpcontainer").delay(u.g.v.d).fadeOut(u.g.v.fo, function () {
							if (u.o.autoPauseSlideshow == "auto" && u.g.originalAutoSlideshow == true) {
								var e = setTimeout(function () {
									u.start()
								},
								t.data("videoDuration") - u.g.v.d);
								t.data("videoTimer", e)
							}
							u.g.isAnimating = false
						})
					});
					var r = "&";
					if (e(this).attr("src").indexOf("?") == -1) {
						r = "?"
					}
					e(this).data("videoSrc", e(this).attr("src") + r + "autoplay=1");
					e(this).data("originalWidth", e(this).attr("width"));
					e(this).data("originalHeight", e(this).attr("height"));
					e(this).attr("src", "")
				}
			});
			e(s).find('iframe[src*="player.vimeo"]').each(function () {
				e(this).parent().addClass("ls-video-layer");
				if (e(this).parent('[class*="ls-s"]')) {
					var t = e(this);
					var n = e("<div>").addClass("ls-vpcontainer").appendTo(e(this).parent());
					e.getJSON("http://vimeo.com/api/v2/video/" + e(this).attr("src").split("video/")[1].split("?")[0] + ".json?callback=?", function (r) {
						e("<img>").appendTo(n).addClass("ls-videopreview").attr("src", r[0]["thumbnail_large"]);
						t.data("videoDuration", parseInt(r[0]["duration"]) * 1e3);
						e("<div>").appendTo(n).addClass("ls-playvideo")
					});
					e(this).parent().css({
						width: e(this).width(),
						height: e(this).height()
					}).click(function () {
						u.g.isAnimating = true;
						if (u.g.paused) {
							if (u.o.autoPauseSlideshow != false) {
								u.g.paused = false
							}
							u.g.originalAutoSlideshow = true
						} else {
							u.g.originalAutoSlideshow = u.g.autoSlideshow
						}
						if (u.o.autoPauseSlideshow != false) {
							u.stop()
						}
						u.g.pausedByVideo = true;
						e(this).find("iframe").attr("src", e(this).find("iframe").data("videoSrc"));
						e(this).find(".ls-vpcontainer").delay(u.g.v.d).fadeOut(u.g.v.fo, function () {
							if (u.o.autoPauseSlideshow == "auto" && u.g.originalAutoSlideshow == true) {
								var e = setTimeout(function () {
									u.start()
								},
								t.data("videoDuration") - u.g.v.d);
								t.data("videoTimer", e)
							}
							u.g.isAnimating = false
						})
					});
					var r = "&";
					if (e(this).attr("src").indexOf("?") == -1) {
						r = "?"
					}
					e(this).data("videoSrc", e(this).attr("src") + r + "autoplay=1");
					e(this).data("originalWidth", e(this).attr("width"));
					e(this).data("originalHeight", e(this).attr("height"));
					e(this).attr("src", "")
				}
			});
			if (u.o.animateFirstLayer) {
				u.o.firstLayer = u.o.firstLayer - 1 == 0 ? u.g.layersNum: u.o.firstLayer - 1
			}
			u.g.curLayerIndex = u.o.firstLayer;
			u.g.curLayer = e(s).find(".ls-layer:eq(" + (u.g.curLayerIndex - 1) + ")");
			e(s).find(".ls-layer").wrapAll('<div class="ls-inner"></div>');
			e("<div>").addClass("ls-webkit-hack").prependTo(e(s));
			if (u.o.showBarTimer) {
				u.g.barTimer = e("<div>").addClass("ls-bar-timer").appendTo(e(s).find(".ls-inner"))
			}
			if (u.o.showCircleTimer && !u.g.ie78) {
				u.g.circleTimer = e("<div>").addClass("ls-circle-timer").appendTo(e(s).find(".ls-inner"));
				u.g.circleTimer.append(e('<div class="ls-ct-left"><div class="ls-ct-rotate"><div class="ls-ct-hider"><div class="ls-ct-half"></div></div></div></div><div class="ls-ct-right"><div class="ls-ct-rotate"><div class="ls-ct-hider"><div class="ls-ct-half"></div></div></div></div><div class="ls-ct-center"></div>'))
			}
			u.g.li = e("<div>").css({
				zIndex: -1,
				display: "none"
			}).addClass("ls-loading-container").appendTo(e(s));
			e("<div>").addClass("ls-loading-indicator").appendTo(u.g.li);
			if (e(s).css("position") == "static") {
				e(s).css("position", "relative")
			}
			e(s).find(".ls-inner").css({
				backgroundColor: u.o.globalBGColor
			});
			if (u.o.globalBGImage) {
				e(s).find(".ls-inner").css({
					backgroundImage: "url(" + u.o.globalBGImage + ")"
				})
			}
			if (u.g.responsiveMode && u.g.isMobile() != true && u.o.allowFullScreenMode && (lsPrefixes(document, "FullScreen") != undefined || lsPrefixes(document, "IsFullScreen") != undefined)) {
				var r = e("<a>").css("display", "none").addClass("ls-fullscreen").click(function () {
					u.goFullScreen()
				}).appendTo(e(s).find(".ls-inner"));
				e(s).hover(function () {
					if (u.g.ie78) {
						r.css({
							display: "block"
						})
					} else {
						r.stop(true, true).fadeIn(300)
					}
				},
				function () {
					if (u.g.ie78) {
						r.css({
							display: "none"
						})
					} else {
						r.stop(true, true).fadeOut(300)
					}
				})
			}
			if (u.o.navPrevNext) {
				e('<a class="ls-nav-prev" href="#" />').click(function (t) {
					t.preventDefault();
					e(s).layerSlider("prev")
				}).appendTo(e(s));
				e('<a class="ls-nav-next" href="#" />').click(function (t) {
					t.preventDefault();
					e(s).layerSlider("next")
				}).appendTo(e(s));
				if (u.o.hoverPrevNext) {
					e(s).find(".ls-nav-prev, .ls-nav-next").css({
						display: "none"
					});
					e(s).hover(function () {
						if (!u.g.forceHideControls) {
							if (u.g.ie78) {
								e(s).find(".ls-nav-prev, .ls-nav-next").css("display", "block")
							} else {
								e(s).find(".ls-nav-prev, .ls-nav-next").stop(true, true).fadeIn(300)
							}
						}
					},
					function () {
						if (u.g.ie78) {
							e(s).find(".ls-nav-prev, .ls-nav-next").css("display", "none")
						} else {
							e(s).find(".ls-nav-prev, .ls-nav-next").stop(true, true).fadeOut(300)
						}
					})
				}
			}
			if (u.o.navStartStop || u.o.navButtons) {
				var i = e('<div class="ls-bottom-nav-wrapper" />').appendTo(e(s));
				u.g.bottomWrapper = i;
				if (u.o.thumbnailNavigation == "always") {
					i.addClass("ls-above-thumbnails")
				}
				if (u.o.navButtons && u.o.thumbnailNavigation != "always") {
					e('<span class="ls-bottom-slidebuttons" />').appendTo(e(s).find(".ls-bottom-nav-wrapper"));
					if (u.o.thumbnailNavigation == "hover") {
						var o = e('<div class="ls-thumbnail-hover"><div class="ls-thumbnail-hover-inner"><div class="ls-thumbnail-hover-bg"></div><div class="ls-thumbnail-hover-img"><img></div><span></span></div></div>').appendTo(e(s).find(".ls-bottom-slidebuttons"))
					}
					for (x = 1; x < u.g.layersNum + 1; x++) {
						var a = e('<a href="#" />').appendTo(e(s).find(".ls-bottom-slidebuttons")).click(function (t) {
							t.preventDefault();
							e(s).layerSlider(e(this).index() + 1)
						});
						if (u.o.thumbnailNavigation == "hover") {
							e(s).find(".ls-thumbnail-hover, .ls-thumbnail-hover-img").css({
								width: u.o.tnWidth,
								height: u.o.tnHeight
							});
							var f = e(s).find(".ls-thumbnail-hover");
							var l = f.find("img").css({
								height: u.o.tnHeight
							});
							var c = e(s).find(".ls-thumbnail-hover-inner").css({
								visibility: "hidden",
								display: "block"
							});
							a.hover(function () {
								var t = e(s).find(".ls-layer").eq(e(this).index());
								if (t.find(".ls-tn").length) {
									var n = t.find(".ls-tn").attr("src")
								} else if (t.find(".ls-videopreview").length) {
									var n = t.find(".ls-videopreview").attr("src")
								} else if (t.find(".ls-bg").length) {
									var n = t.find(".ls-bg").attr("src")
								} else {
									var n = u.o.skinsPath + u.o.skin + "/nothumb.png"
								}
								e(s).find(".ls-thumbnail-hover-img").css({
									left: parseInt(f.css("padding-left")),
									top: parseInt(f.css("padding-top"))
								});
								l.load(function () {
									if (e(this).width() == 0) {
										l.css({
											position: "relative",
											margin: "0 auto",
											left: "auto"
										})
									} else {
										l.css({
											position: "absolute",
											marginLeft: -e(this).width() / 2,
											left: "50%"
										})
									}
								}).attr("src", n);
								f.css({
									display: "block"
								}).stop().animate({
									left: e(this).position().left + (e(this).width() - f.outerWidth()) / 2
								},
								250, "easeInOutQuad");
								c.css({
									display: "none",
									visibility: "visible"
								}).stop().fadeIn(250)
							},
							function () {
								c.stop().fadeOut(250, function () {
									f.css({
										visibility: "hidden",
										display: "block"
									})
								})
							})
						}
					}
					if (u.o.thumbnailNavigation == "hover") {
						o.appendTo(e(s).find(".ls-bottom-slidebuttons"))
					}
					e(s).find(".ls-bottom-slidebuttons a:eq(" + (u.o.firstLayer - 1) + ")").addClass("ls-nav-active")
				}
				if (u.o.navStartStop) {
					var h = e('<a class="ls-nav-start" href="#" />').click(function (t) {
						t.preventDefault();
						e(s).layerSlider("start")
					}).prependTo(e(s).find(".ls-bottom-nav-wrapper"));
					var p = e('<a class="ls-nav-stop" href="#" />').click(function (t) {
						t.preventDefault();
						e(s).layerSlider("stop")
					}).appendTo(e(s).find(".ls-bottom-nav-wrapper"))
				} else if (u.o.thumbnailNavigation != "always") {
					e('<span class="ls-nav-sides ls-nav-sideleft" />').prependTo(e(s).find(".ls-bottom-nav-wrapper"));
					e('<span class="ls-nav-sides ls-nav-sideright" />').appendTo(e(s).find(".ls-bottom-nav-wrapper"))
				}
				if (u.o.hoverBottomNav && u.o.thumbnailNavigation != "always") {
					i.css({
						display: "none"
					});
					e(s).hover(function () {
						if (!u.g.forceHideControls) {
							if (u.g.ie78) {
								i.css("display", "block")
							} else {
								i.stop(true, true).fadeIn(300)
							}
						}
					},
					function () {
						if (u.g.ie78) {
							i.css("display", "none")
						} else {
							i.stop(true, true).fadeOut(300)
						}
					})
				}
			}
			if (u.o.thumbnailNavigation == "always") {
				u.g.thumbsWrapper = e('<div class="ls-thumbnail-wrapper"></div>').appendTo(e(s));
				var o = e('<div class="ls-thumbnail"><div class="ls-thumbnail-inner"><div class="ls-thumbnail-slide-container"><div class="ls-thumbnail-slide"></div></div></div></div>').appendTo(u.g.thumbsWrapper);
				u.g.thumbnails = e(s).find(".ls-thumbnail-slide-container");
				if (! ("ontouchstart" in window)) {
					u.g.thumbnails.hover(function () {
						e(this).addClass("ls-thumbnail-slide-hover")
					},
					function () {
						e(this).removeClass("ls-thumbnail-slide-hover");
						u.scrollThumb()
					}).mousemove(function (t) {
						var n = parseInt(t.pageX - e(this).offset().left) / e(this).width() * (e(this).width() - e(this).find(".ls-thumbnail-slide").width());
						e(this).find(".ls-thumbnail-slide").stop().css({
							marginLeft: n
						})
					})
				} else {
					u.g.thumbnails.addClass("ls-touchscroll")
				}
				e(s).find(".ls-layer").each(function () {
					var t = e(this).index() + 1;
					if (e(this).find(".ls-tn").length) {
						var n = e(this).find(".ls-tn").attr("src")
					} else if (e(this).find(".ls-videopreview").length) {
						var n = e(this).find(".ls-videopreview").attr("src")
					} else if (e(this).find(".ls-bg").length) {
						var n = e(this).find(".ls-bg").attr("src")
					}
					if (n) {
						var r = e('<a href="#" class="ls-thumb-' + t + '"><img src="' + n + '"></a>')
					} else {
						var r = e('<a href="#" class="ls-nothumb ls-thumb-' + t + '"><img src="' + u.o.skinsPath + u.o.skin + '/nothumb.png"></a>')
					}
					r.appendTo(e(s).find(".ls-thumbnail-slide"));
					if (! ("ontouchstart" in window)) {
						r.hover(function () {
							e(this).children().stop().fadeTo(300, u.o.tnActiveOpacity / 100)
						},
						function () {
							if (!e(this).children().hasClass("ls-thumb-active")) {
								e(this).children().stop().fadeTo(300, u.o.tnInactiveOpacity / 100)
							}
						})
					}
					r.click(function (n) {
						n.preventDefault();
						e(s).layerSlider(t)
					})
				});
				if (h && p) {
					var d = u.g.bottomWrapper = e('<div class="ls-bottom-nav-wrapper ls-below-thumbnails"></div>').appendTo(e(s));
					h.clone().click(function (t) {
						t.preventDefault();
						e(s).layerSlider("start")
					}).appendTo(d);
					p.clone().click(function (t) {
						t.preventDefault();
						e(s).layerSlider("stop")
					}).appendTo(d)
				}
				if (u.o.hoverBottomNav) {
					u.g.thumbsWrapper.css("display", "none");
					if (d) {
						u.g.bottomWrapper = d.css("display") == "block" ? d: e(s).find(".ls-above-thumbnails");
						u.g.bottomWrapper.css("display", "none")
					}
					e(s).hover(function () {
						e(s).addClass("ls-hover");
						if (!u.g.forceHideControls) {
							if (u.g.ie78) {
								u.g.thumbsWrapper.css("display", "block");
								if (u.g.bottomWrapper) {
									u.g.bottomWrapper.css("display", "block")
								}
							} else {
								u.g.thumbsWrapper.stop(true, true).fadeIn(300);
								if (u.g.bottomWrapper) {
									u.g.bottomWrapper.stop(true, true).fadeIn(300)
								}
							}
						}
					},
					function () {
						e(s).removeClass("ls-hover");
						if (u.g.ie78) {
							u.g.thumbsWrapper.css("display", "none");
							if (u.g.bottomWrapper) {
								u.g.bottomWrapper.css("display", "none")
							}
						} else {
							u.g.thumbsWrapper.stop(true, true).fadeOut(300);
							if (u.g.bottomWrapper) {
								u.g.bottomWrapper.stop(true, true).fadeOut(300)
							}
						}
					})
				}
			}
			u.g.shadow = e('<div class="ls-shadow"></div>').appendTo(e(s));
			u.resizeShadow();
			if (u.o.keybNav && e(s).find(".ls-layer").length > 1) {
				e("body").bind("keydown", function (e) {
					if (!u.g.isAnimating && !u.g.isLoading) {
						if (e.which == 37) {
							u.o.cbPrev(u.g);
							u.prev("clicked")
						} else if (e.which == 39) {
							u.o.cbNext(u.g);
							u.next("clicked")
						}
					}
				})
			}
			if ("ontouchstart" in window && e(s).find(".ls-layer").length > 1 && u.o.touchNav) {
				e(s).find(".ls-inner").bind("touchstart", function (e) {
					var t = e.touches ? e.touches: e.originalEvent.touches;
					if (t.length == 1) {
						u.g.touchStartX = u.g.touchEndX = t[0].clientX
					}
				});
				e(s).find(".ls-inner").bind("touchmove", function (e) {
					var t = e.touches ? e.touches: e.originalEvent.touches;
					if (t.length == 1) {
						u.g.touchEndX = t[0].clientX
					}
					if (Math.abs(u.g.touchStartX - u.g.touchEndX) > 45) {
						e.preventDefault()
					}
				});
				e(s).find(".ls-inner").bind("touchend", function (t) {
					if (Math.abs(u.g.touchStartX - u.g.touchEndX) > 45) {
						if (u.g.touchStartX - u.g.touchEndX > 0) {
							u.o.cbNext(u.g);
							e(s).layerSlider("next")
						} else {
							u.o.cbPrev(u.g);
							e(s).layerSlider("prev")
						}
					}
				})
			}
			if (u.o.pauseOnHover == true && e(s).find(".ls-layer").length > 1) {
				e(s).find(".ls-inner").hover(function () {
					u.o.cbPause(u.g);
					if (u.g.autoSlideshow) {
						u.g.paused = true;
						u.stop();
						if (u.g.barTimer) {
							u.g.barTimer.stop()
						}
						if (u.g.circleTimer) {
							u.g.circleTimer.find(".ls-ct-rotate").stop()
						}
						u.g.pausedSlideTime = (new Date).getTime()
					}
				},
				function () {
					if (u.g.paused == true) {
						u.start();
						u.g.paused = false
					}
				})
			}
			u.resizeSlider();
			if (u.o.yourLogo) {
				u.g.yourLogo = e("<img>").addClass("ls-yourlogo").appendTo(e(s)).attr("style", u.o.yourLogoStyle).css({
					visibility: "hidden",
					display: "bock"
				}).load(function () {
					var t = 0;
					if (!u.g.yourLogo) {
						t = 1e3
					}
					setTimeout(function () {
						u.g.yourLogo.data("originalWidth", u.g.yourLogo.width());
						u.g.yourLogo.data("originalHeight", u.g.yourLogo.height());
						if (u.g.yourLogo.css("left") != "auto") {
							u.g.yourLogo.data("originalLeft", u.g.yourLogo[0].style.left)
						}
						if (u.g.yourLogo.css("right") != "auto") {
							u.g.yourLogo.data("originalRight", u.g.yourLogo[0].style.right)
						}
						if (u.g.yourLogo.css("top") != "auto") {
							u.g.yourLogo.data("originalTop", u.g.yourLogo[0].style.top)
						}
						if (u.g.yourLogo.css("bottom") != "auto") {
							u.g.yourLogo.data("originalBottom", u.g.yourLogo[0].style.bottom)
						}
						if (u.o.yourLogoLink != false) {
							e("<a>").appendTo(e(s)).attr("href", u.o.yourLogoLink).attr("target", u.o.yourLogoTarget).css({
								textDecoration: "none",
								outline: "none"
							}).append(u.g.yourLogo)
						}
						u.g.yourLogo.css({
							display: "none",
							visibility: "visible"
						});
						u.resizeYourLogo()
					},
					t)
				}).attr("src", u.o.yourLogo)
			}
			e(window).resize(function () {
				var e = 0;
				if (u.g.normalWidth != false && u.g.goingNormal) {
					e = 400
				}
				if (u.g.resizeTimeout) {
					clearTimeout(u.g.resizeTimeout)
				}
				u.g.resizeTimeout = setTimeout(function () {
					u.makeResponsive(u.g.curLayer, function () {
						return
					});
					if (u.g.yourLogo) {
						u.resizeYourLogo()
					}
				},
				e)
			});
			u.g.showSlider = true;
			if (u.o.animateFirstLayer == true) {
				if (u.o.autoStart) {
					u.g.autoSlideshow = true;
					e(s).find(".ls-nav-start").addClass("ls-nav-start-active")
				} else {
					e(s).find(".ls-nav-stop").addClass("ls-nav-stop-active")
				}
				u.next()
			} else {
				u.imgPreload(u.g.curLayer, function () {
					u.g.curLayer.fadeIn(1e3, function () {
						u.g.isLoading = false;
						e(this).addClass("ls-active");
						if (u.o.autoPlayVideos) {
							e(this).delay(e(this).data("delayin") + 25).queue(function () {
								e(this).find(".ls-videopreview").click();
								e(this).dequeue()
							})
						}
						u.g.curLayer.find(' > *[class*="ls-s"]').each(function () {
							if (e(this).data("showuntil") > 0) {
								var t = e(this);
								t.data("showUntilTimer", setTimeout(function () {
									u.sublayerShowUntil(t)
								},
								t.data("showuntil")))
							}
						})
					});
					u.changeThumb(u.g.curLayerIndex);
					if (u.o.autoStart) {
						u.g.isLoading = false;
						u.start()
					} else {
						e(s).find(".ls-nav-stop").addClass("ls-nav-stop-active")
					}
				})
			}
			u.o.cbInit(e(s))
		};
		u.goFullScreen = function () {
			if (!u.g.isAnimating && !u.g.isLoading) {
				if (lsPrefixes(document, "FullScreen") || lsPrefixes(document, "IsFullScreen")) {
					u.g.goingNormal = true;
					lsPrefixes(document, "CancelFullScreen");
					e(s).removeClass("ls-container-fullscreen")
				} else {
					u.g.normalWidth = u.g.sliderWidth();
					u.g.normalHeight = u.g.sliderHeight();
					u.g.normalRatio = u.g.ratio;
					lsPrefixes(e(s)[0], "RequestFullScreen");
					e(s).addClass("ls-container-fullscreen")
				}
			}
		};
		u.start = function () {
			if (u.g.autoSlideshow) {
				if (u.g.prevNext == "prev" && u.o.twoWaySlideshow) {
					u.prev()
				} else {
					u.next()
				}
			} else {
				u.g.autoSlideshow = true;
				if (!u.g.isAnimating && !u.g.isLoading) {
					u.timer()
				}
			}
			e(s).find(".ls-nav-start").addClass("ls-nav-start-active");
			e(s).find(".ls-nav-stop").removeClass("ls-nav-stop-active")
		};
		u.timer = function () {
			var t = e(s).find(".ls-active").data("slidedelay") ? parseInt(e(s).find(".ls-active").data("slidedelay")) : u.o.slideDelay;
			if (!u.o.animateFirstLayer && !e(s).find(".ls-active").data("slidedelay")) {
				var n = e(s).find(".ls-layer:eq(" + (u.o.firstLayer - 1) + ")").data("slidedelay");
				t = n ? n: u.o.slideDelay
			}
			clearTimeout(u.g.slideTimer);
			if (u.g.pausedSlideTime) {
				if (!u.g.startSlideTime) {
					u.g.startSlideTime = (new Date).getTime()
				}
				if (u.g.startSlideTime > u.g.pausedSlideTime) {
					u.g.pausedSlideTime = (new Date).getTime()
				}
				if (!u.g.curSlideTime) {
					u.g.curSlideTime = t
				}
				u.g.curSlideTime -= u.g.pausedSlideTime - u.g.startSlideTime;
				u.g.pausedSlideTime = false;
				u.g.startSlideTime = (new Date).getTime()
			} else {
				u.g.curSlideTime = t;
				u.g.startSlideTime = (new Date).getTime()
			}
			u.g.slideTimer = window.setTimeout(function () {
				u.g.startSlideTime = u.g.pausedSlideTime = u.g.curSlideTime = false;
				u.start()
			},
			u.g.curSlideTime);
			if (u.g.barTimer) {
				u.g.barTimer.animate({
					width: u.g.sliderWidth()
				},
				u.g.curSlideTime, "linear", function () {
					e(this).css({
						width: 0
					})
				})
			}
			if (u.g.circleTimer) {
				u.g.circleTimer.fadeIn(500);
				var r = u.g.circleTimer.find(".ls-ct-right .ls-ct-rotate");
				var i = u.g.circleTimer.find(".ls-ct-left .ls-ct-rotate");
				var o = function () {
					i.animate({
						rotate: 180
					},
					t / 2, "linear")
				};
				var a = r;
				var f = u.g.curSlideTime - t / 2;
				if (u.g.curSlideTime < t / 2) {
					a = i;
					f = u.g.curSlideTime;
					o = function () {}
				}
				a.animate({
					rotate: 180
				},
				f, "linear", function () {
					o()
				})
			}
		};
		u.stop = function () {
			u.g.pausedSlideTime = (new Date).getTime();
			if (u.g.barTimer) {
				u.g.barTimer.stop()
			}
			if (u.g.circleTimer) {
				u.g.circleTimer.find(".ls-ct-rotate").stop()
			}
			if (!u.g.paused && !u.g.originalAutoSlideshow) {
				e(s).find(".ls-nav-stop").addClass("ls-nav-stop-active");
				e(s).find(".ls-nav-start").removeClass("ls-nav-start-active")
			}
			clearTimeout(u.g.slideTimer);
			u.g.autoSlideshow = false
		};
		u.ieEasing = function (t) {
			if (e.trim(t.toLowerCase()) == "swing" || e.trim(t.toLowerCase()) == "linear") {
				return t.toLowerCase()
			} else {
				return t.replace("easeinout", "easeInOut").replace("easein", "easeIn").replace("easeout", "easeOut").replace("quad", "Quad").replace("quart", "Quart").replace("cubic", "Cubic").replace("quint", "Quint").replace("sine", "Sine").replace("expo", "Expo").replace("circ", "Circ").replace("elastic", "Elastic").replace("back", "Back").replace("bounce", "Bounce")
			}
		};
		u.prev = function (e) {
			if (u.g.curLayerIndex < 2) {
				u.g.nextLoop += 1
			}
			if (u.g.nextLoop > u.o.loops && u.o.loops > 0 && !e) {
				u.g.nextLoop = 0;
				u.stop();
				if (u.o.forceLoopNum == false) {
					u.o.loops = 0
				}
			} else {
				var t = u.g.curLayerIndex < 2 ? u.g.layersNum: u.g.curLayerIndex - 1;
				u.g.prevNext = "prev";
				u.change(t, u.g.prevNext)
			}
		};
		u.next = function (e) {
			if (!u.o.randomSlideshow) {
				if (! (u.g.curLayerIndex < u.g.layersNum)) {
					u.g.nextLoop += 1
				}
				if (u.g.nextLoop > u.o.loops && u.o.loops > 0 && !e) {
					u.g.nextLoop = 0;
					u.stop();
					if (u.o.forceLoopNum == false) {
						u.o.loops = 0
					}
				} else {
					var t = u.g.curLayerIndex < u.g.layersNum ? u.g.curLayerIndex + 1 : 1;
					u.g.prevNext = "next";
					u.change(t, u.g.prevNext)
				}
			} else if (!e) {
				var t = u.g.curLayerIndex;
				var n = function () {
					t = Math.floor(Math.random() * u.g.layersNum) + 1;
					if (t == u.g.curLayerIndex) {
						n()
					} else {
						u.g.prevNext = "next";
						u.change(t, u.g.prevNext)
					}
				};
				n()
			} else if (e) {
				var t = u.g.curLayerIndex < u.g.layersNum ? u.g.curLayerIndex + 1 : 1;
				u.g.prevNext = "next";
				u.change(t, u.g.prevNext)
			}
		};
		u.change = function (t, n) {
			u.g.startSlideTime = u.g.pausedSlideTime = u.g.curSlideTime = false;
			if (u.g.barTimer) {
				u.g.barTimer.stop(true, true).css({
					width: 0
				})
			}
			if (u.g.circleTimer) {
				u.g.circleTimer.fadeOut(500).find(".ls-ct-rotate").stop().css({
					rotate: 0
				})
			}
			if (u.g.pausedByVideo == true) {
				u.g.pausedByVideo = false;
				u.g.autoSlideshow = u.g.originalAutoSlideshow;
				u.g.curLayer.find('iframe[src*="www.youtu"], iframe[src*="player.vimeo"]').each(function () {
					e(this).parent().find(".ls-vpcontainer").fadeIn(u.g.v.fi, function () {
						e(this).parent().find("iframe").attr("src", "")
					})
				})
			}
			e(s).find('iframe[src*="www.youtu"], iframe[src*="player.vimeo"]').each(function () {
				clearTimeout(e(this).data("videoTimer"))
			});
			clearTimeout(u.g.slideTimer);
			u.g.nextLayerIndex = t;
			u.g.nextLayer = e(s).find(".ls-layer:eq(" + (u.g.nextLayerIndex - 1) + ")");
			if (!n) {
				if (u.g.curLayerIndex < u.g.nextLayerIndex) {
					u.g.prevNext = "next"
				} else {
					u.g.prevNext = "prev"
				}
			}
			var r = 0;
			if (e(s).find('iframe[src*="www.youtu"], iframe[src*="player.vimeo"]').length > 0) {
				r = u.g.v.fi
			}
			clearTimeout(u.g.changeTimer);
			u.g.changeTimer = setTimeout(function () {
				var e = function () {
					if (u.g.goingNormal) {
						setTimeout(function () {
							e()
						},
						500)
					} else {
						u.imgPreload(u.g.nextLayer, function () {
							u.animate()
						})
					}
				};
				e()
			},
			r)
		};
		u.imgPreload = function (t, n) {
			u.g.isLoading = true;
			if (u.g.showSlider) {
				e(s).css({
					visibility: "visible"
				})
			}
			if (u.o.imgPreload) {
				var r = [];
				var i = 0;
				if (t.css("background-image") != "none" && t.css("background-image").indexOf("url") != -1) {
					var o = t.css("background-image");
					o = o.match(/url\((.*)\)/)[1].replace(/"/gi, "");
					r.push(o)
				}
				t.find("img").each(function () {
					r.push(e(this).attr("src"))
				});
				t.find("*").each(function () {
					if (e(this).css("background-image") != "none" && e(this).css("background-image").indexOf("url") != -1) {
						var t = e(this).css("background-image");
						t = t.match(/url\((.*)\)/)[1].replace(/"/gi, "");
						r.push(t)
					}
				});
				if (r.length == 0) {
					e(".ls-thumbnail-wrapper, .ls-nav-next, .ls-nav-prev, .ls-bottom-nav-wrapper").css({
						visibility: "visible"
					});
					u.makeResponsive(t, n)
				} else {
					if (u.g.ie78) {
						u.g.li.css("display", "block")
					} else {
						u.g.li.delay(400).fadeIn(300)
					}
					for (x = 0; x < r.length; x++) {
						e("<img>").load(function () {
							if (++i == r.length) {
								u.g.li.stop(true, true).css({
									display: "none"
								});
								e(".ls-thumbnail-wrapper, .ls-nav-next, .ls-nav-prev, .ls-bottom-nav-wrapper").css({
									visibility: "visible"
								});
								u.makeResponsive(t, n)
							}
						}).attr("src", r[x])
					}
				}
			} else {
				e(".ls-thumbnail-wrapper, .ls-nav-next, .ls-nav-prev, .ls-bottom-nav-wrapper").css({
					visibility: "visible"
				});
				u.makeResponsive(t, n)
			}
		};
		u.makeResponsive = function (t, n) {
			t.css({
				visibility: "hidden",
				display: "block"
			});
			u.resizeSlider();
			if (u.o.thumbnailNavigation == "always") {
				u.resizeThumb()
			}
			t.children().each(function () {
				var t = e(this);
				var n = t.data("originalLeft") ? t.data("originalLeft") : "0";
				var r = t.data("originalTop") ? t.data("originalTop") : "0";
				if (t.is("a") && t.children().length > 0) {
					t.css({
						display: "block"
					});
					t = t.children()
				}
				var i = "auto";
				var s = "auto";
				if (t.data("originalWidth")) {
					if (typeof t.data("originalWidth") == "number") {
						i = parseInt(t.data("originalWidth")) * u.g.ratio
					} else if (t.data("originalWidth").indexOf("%") != -1) {
						i = t.data("originalWidth")
					}
				}
				if (t.data("originalHeight")) {
					if (typeof t.data("originalHeight") == "number") {
						s = parseInt(t.data("originalHeight")) * u.g.ratio
					} else if (t.data("originalHeight").indexOf("%") != -1) {
						s = t.data("originalHeight")
					}
				}
				var o = t.data("originalPaddingLeft") ? parseInt(t.data("originalPaddingLeft")) * u.g.ratio: 0;
				var a = t.data("originalPaddingRight") ? parseInt(t.data("originalPaddingRight")) * u.g.ratio: 0;
				var f = t.data("originalPaddingTop") ? parseInt(t.data("originalPaddingTop")) * u.g.ratio: 0;
				var l = t.data("originalPaddingBottom") ? parseInt(t.data("originalPaddingBottom")) * u.g.ratio: 0;
				var c = t.data("originalBorderLeft") ? parseInt(t.data("originalBorderLeft")) * u.g.ratio: 0;
				var h = t.data("originalBorderRight") ? parseInt(t.data("originalBorderRight")) * u.g.ratio: 0;
				var p = t.data("originalBorderTop") ? parseInt(t.data("originalBorderTop")) * u.g.ratio: 0;
				var d = t.data("originalBorderBottom") ? parseInt(t.data("originalBorderBottom")) * u.g.ratio: 0;
				var v = t.data("originalFontSize");
				var m = t.data("originalLineHeight");
				if (u.g.responsiveMode || u.o.responsiveUnder > 0) {
					if (t.is("img") && !t.hasClass("ls-bg")) {
						t.css({
							width: "auto",
							height: "auto"
						});
						if ((i == 0 || i == "auto") && typeof s == "number" && s != 0) {
							i = s / t.height() * t.width()
						}
						if ((s == 0 || s == "auto") && typeof i == "number" && i != 0) {
							s = i / t.width() * t.height()
						}
						if (i == "auto") {
							i = t.width() * u.g.ratio
						}
						if (s == "auto") {
							s = t.height() * u.g.ratio
						}
						t.css({
							width: i,
							height: s
						})
					}
					if (!t.is("img")) {
						t.css({
							width: i,
							height: s,
							"font-size": parseInt(v) * u.g.ratio + "px",
							"line-height": parseInt(m) * u.g.ratio + "px"
						})
					}
					if (t.is("div") && t.find("iframe").data("videoSrc")) {
						var g = t.find("iframe");
						g.attr("width", parseInt(g.data("originalWidth")) * u.g.ratio).attr("height", parseInt(g.data("originalHeight")) * u.g.ratio);
						t.css({
							width: parseInt(g.data("originalWidth")) * u.g.ratio,
							height: parseInt(g.data("originalHeight")) * u.g.ratio
						})
					}
					t.css({
						padding: f + "px " + a + "px " + l + "px " + o + "px ",
						borderLeftWidth: c + "px",
						borderRightWidth: h + "px",
						borderTopWidth: p + "px",
						borderBottomWidth: d + "px"
					})
				}
				if (!t.hasClass("ls-bg")) {
					var y = t;
					if (t.parent().is("a")) {
						t = t.parent()
					}
					var b = u.o.sublayerContainer > 0 ? (u.g.sliderWidth() - u.o.sublayerContainer) / 2 : 0;
					b = b < 0 ? 0 : b;
					if (n.indexOf("%") != -1) {
						t.css({
							left: u.g.sliderWidth() / 100 * parseInt(n) - y.width() / 2 - o - c
						})
					} else if (b > 0 || u.g.responsiveMode || u.o.responsiveUnder > 0) {
						t.css({
							left: b + parseInt(n) * u.g.ratio
						})
					}
					if (r.indexOf("%") != -1) {
						t.css({
							top: u.g.sliderHeight() / 100 * parseInt(r) - y.height() / 2 - f - p
						})
					} else if (u.g.responsiveMode || u.o.responsiveUnder > 0) {
						t.css({
							top: parseInt(r) * u.g.ratio
						})
					}
				} else {
					t.css({
						width: "auto",
						height: "auto"
					});
					i = t.width();
					s = t.height();
					var w = u.g.ratio;
					if (u.g.sliderOriginalWidth.indexOf("%") != -1) {
						if (u.g.sliderWidth() > i) {
							w = u.g.sliderWidth() / i;
							if (u.g.sliderHeight() > s * w) {
								w = u.g.sliderHeight() / s
							}
						} else if (u.g.sliderHeight() > s) {
							w = u.g.sliderHeight() / s;
							if (u.g.sliderWidth() > i * w) {
								w = u.g.sliderWidth() / i
							}
						}
					}
					t.css({
						width: Math.round(i * w),
						height: Math.round(s * w),
						marginLeft: -Math.round(i * w) / 2 + "px",
						marginTop: -Math.round(s * w) / 2 + "px"
					})
				}
			});
			t.css({
				display: "none",
				visibility: "visible"
			});
			u.resizeShadow();
			n();
			e(this).dequeue();
			if (u.g.normalWidth && u.g.goingNormal) {
				u.g.normalWidth = false;
				u.g.normalHeight = false;
				u.g.normalRatio = false;
				u.g.goingNormal = false
			}
		};
		u.resizeShadow = function () {
			if (u.g.shadow.css("display") == "block" && !u.g.shadow.find("img").length) {
				u.g.shadow.append(e("<img />").attr("src", u.o.skinsPath + u.o.skin + "/shadow.png"));
				u.g.shadow.data("originalHeight", u.g.shadow.height());
				u.g.shadow.data("originalMarginTop", parseInt(u.g.shadow.css("margin-top")))
			}
			if (u.g.shadow.find("img").length) {
				u.g.shadow.css({
					height: Math.round(u.g.shadow.data("originalHeight") * u.g.ratio),
					marginTop: Math.round(u.g.shadow.data("originalMarginTop") * u.g.ratio)
				})
			}
		};
		u.resizeSlider = function () {
			if (u.o.responsiveUnder > 0) {
				if (e(window).width() < u.o.responsiveUnder) {
					u.g.responsiveMode = true;
					u.g.sliderOriginalWidth = u.o.responsiveUnder + "px"
				} else {
					u.g.responsiveMode = false;
					u.g.sliderOriginalWidth = u.g.sliderOriginalWidthRU;
					u.g.ratio = 1
				}
			}
			if (u.g.responsiveMode) {
				var t = e(s).parent();
				if (u.g.normalRatio && u.g.goingNormal) {
					e(s).css({
						width: u.g.normalWidth
					});
					u.g.ratio = u.g.normalRatio;
					e(s).css({
						height: u.g.normalHeight
					})
				} else {
					e(s).css({
						width: t.width() - parseInt(e(s).css("padding-left")) - parseInt(e(s).css("padding-right"))
					});
					u.g.ratio = e(s).width() / parseInt(u.g.sliderOriginalWidth);
					e(s).css({
						height: u.g.ratio * parseInt(u.g.sliderOriginalHeight)
					})
				}
			} else {
				u.g.ratio = 1;
				e(s).css({
					width: u.g.sliderOriginalWidth,
					height: u.g.sliderOriginalHeight
				})
			}
			if (e(s).closest(".ls-wp-fullwidth-container").length) {
				e(s).closest(".ls-wp-fullwidth-helper").css({
					height: e(s).outerHeight(true)
				});
				e(s).closest(".ls-wp-fullwidth-container").css({
					height: e(s).outerHeight(true)
				});
				e(s).closest(".ls-wp-fullwidth-helper").css({
					width: e(window).width(),
					left: -e(s).closest(".ls-wp-fullwidth-container").offset().left
				});
				if (u.g.sliderOriginalWidth.indexOf("%") != -1) {
					var n = parseInt(u.g.sliderOriginalWidth);
					var r = e("body").width() / 100 * n - (e(s).outerWidth() - e(s).width());
					e(s).width(r)
				}
			}
			e(s).find(".ls-inner, .ls-lt-container").css({
				width: u.g.sliderWidth(),
				height: u.g.sliderHeight()
			});
			if (u.g.curLayer && u.g.nextLayer) {
				u.g.curLayer.css({
					width: u.g.sliderWidth(),
					height: u.g.sliderHeight()
				});
				u.g.nextLayer.css({
					width: u.g.sliderWidth(),
					height: u.g.sliderHeight()
				})
			} else {
				e(s).find(".ls-layer").css({
					width: u.g.sliderWidth(),
					height: u.g.sliderHeight()
				})
			}
		};
		u.resizeYourLogo = function () {
			u.g.yourLogo.css({
				width: u.g.yourLogo.data("originalWidth") * u.g.ratio,
				height: u.g.yourLogo.data("originalHeight") * u.g.ratio
			});
			if (u.g.ie78) {
				u.g.yourLogo.css("display", "block")
			} else {
				u.g.yourLogo.fadeIn(300)
			}
			var t = oR = oT = oB = "auto";
			if (u.g.yourLogo.data("originalLeft") && u.g.yourLogo.data("originalLeft").indexOf("%") != -1) {
				t = u.g.sliderWidth() / 100 * parseInt(u.g.yourLogo.data("originalLeft")) - u.g.yourLogo.width() / 2 + parseInt(e(s).css("padding-left"))
			} else {
				t = parseInt(u.g.yourLogo.data("originalLeft")) * u.g.ratio
			}
			if (u.g.yourLogo.data("originalRight") && u.g.yourLogo.data("originalRight").indexOf("%") != -1) {
				oR = u.g.sliderWidth() / 100 * parseInt(u.g.yourLogo.data("originalRight")) - u.g.yourLogo.width() / 2 + parseInt(e(s).css("padding-right"))
			} else {
				oR = parseInt(u.g.yourLogo.data("originalRight")) * u.g.ratio
			}
			if (u.g.yourLogo.data("originalTop") && u.g.yourLogo.data("originalTop").indexOf("%") != -1) {
				oT = u.g.sliderHeight() / 100 * parseInt(u.g.yourLogo.data("originalTop")) - u.g.yourLogo.height() / 2 + parseInt(e(s).css("padding-top"))
			} else {
				oT = parseInt(u.g.yourLogo.data("originalTop")) * u.g.ratio
			}
			if (u.g.yourLogo.data("originalBottom") && u.g.yourLogo.data("originalBottom").indexOf("%") != -1) {
				oB = u.g.sliderHeight() / 100 * parseInt(u.g.yourLogo.data("originalBottom")) - u.g.yourLogo.height() / 2 + parseInt(e(s).css("padding-bottom"))
			} else {
				oB = parseInt(u.g.yourLogo.data("originalBottom")) * u.g.ratio
			}
			u.g.yourLogo.css({
				left: t,
				right: oR,
				top: oT,
				bottom: oB
			})
		};
		u.resizeThumb = function () {
			u.bottomNavSizeHelper("on");
			var t = u.g.sliderOriginalWidth.indexOf("%") == -1 ? parseInt(u.g.sliderOriginalWidth) : u.g.sliderWidth();
			e(s).find(".ls-thumbnail-slide a").css({
				width: parseInt(u.o.tnWidth * u.g.ratio),
				height: parseInt(u.o.tnHeight * u.g.ratio)
			});
			e(s).find(".ls-thumbnail-slide a:last").css({
				margin: 0
			});
			e(s).find(".ls-thumbnail-slide").css({
				height: parseInt(u.o.tnHeight * u.g.ratio)
			});
			var n = e(s).find(".ls-thumbnail");
			var r = u.o.tnContainerWidth.indexOf("%") == -1 ? parseInt(u.o.tnContainerWidth) : parseInt(t / 100 * parseInt(u.o.tnContainerWidth));
			n.css({
				width: r * Math.floor(u.g.ratio * 100) / 100
			});
			if (n.width() > e(s).find(".ls-thumbnail-slide").width()) {
				n.css({
					width: e(s).find(".ls-thumbnail-slide").width()
				})
			}
			u.bottomNavSizeHelper("off")
		};
		u.changeThumb = function (t) {
			var n = t ? t: u.g.nextLayerIndex;
			e(s).find(".ls-thumbnail-slide a:not(.ls-thumb-" + n + ")").children().each(function () {
				e(this).removeClass("ls-thumb-active").stop().fadeTo(750, u.o.tnInactiveOpacity / 100)
			});
			e(s).find(".ls-thumbnail-slide a.ls-thumb-" + n).children().addClass("ls-thumb-active").stop().fadeTo(750, u.o.tnActiveOpacity / 100)
		};
		u.scrollThumb = function () {
			if (!e(s).find(".ls-thumbnail-slide-container").hasClass("ls-thumbnail-slide-hover")) {
				var t = e(s).find(".ls-thumb-active").length ? e(s).find(".ls-thumb-active").parent() : false;
				if (t) {
					var n = t.position().left + t.width() / 2;
					var r = e(s).find(".ls-thumbnail-slide-container").width() / 2 - n;
					r = r < e(s).find(".ls-thumbnail-slide-container").width() - e(s).find(".ls-thumbnail-slide").width() ? e(s).find(".ls-thumbnail-slide-container").width() - e(s).find(".ls-thumbnail-slide").width() : r;
					r = r > 0 ? 0 : r;
					e(s).find(".ls-thumbnail-slide").animate({
						marginLeft: r
					},
					600, "easeInOutQuad")
				}
			}
		};
		u.bottomNavSizeHelper = function (t) {
			if (u.o.hoverBottomNav && !e(s).hasClass("ls-hover")) {
				switch (t) {
				case "on":
					u.g.thumbsWrapper.css({
						visibility:
						"hidden",
						display: "block"
					});
					break;
				case "off":
					u.g.thumbsWrapper.css({
						visibility:
						"visible",
						display: "none"
					});
					break
				}
			}
		};
		u.animate = function () {
			u.g.isAnimating = true;
			u.g.isLoading = false;
			clearTimeout(u.g.slideTimer);
			clearTimeout(u.g.changeTimer);
			u.g.stopLayer = u.g.curLayer;
			u.o.cbAnimStart(u.g);
			if (u.o.thumbnailNavigation == "always") {
				u.changeThumb();
				if (! ("ontouchstart" in window)) {
					u.scrollThumb()
				}
			}
			u.g.nextLayer.addClass("ls-animating");
			var t = curLayerRight = curLayerTop = curLayerBottom = nextLayerLeft = nextLayerRight = nextLayerTop = nextLayerBottom = layerMarginLeft = layerMarginRight = layerMarginTop = layerMarginBottom = "auto";
			var o = nextLayerWidth = u.g.sliderWidth();
			var a = nextLayerHeight = u.g.sliderHeight();
			var f = u.g.prevNext == "prev" ? u.g.curLayer: u.g.nextLayer;
			var l = f.data("slidedirection") ? f.data("slidedirection") : u.o.slideDirection;
			var c = u.g.slideDirections[u.g.prevNext][l];
			if (c == "left" || c == "right") {
				o = curLayerTop = nextLayerWidth = nextLayerTop = 0;
				layerMarginTop = 0
			}
			if (c == "top" || c == "bottom") {
				a = t = nextLayerHeight = nextLayerLeft = 0;
				layerMarginLeft = 0
			}
			switch (c) {
			case "left":
				curLayerRight = nextLayerLeft = 0;
				layerMarginLeft = -u.g.sliderWidth();
				break;
			case "right":
				t = nextLayerRight = 0;
				layerMarginLeft = u.g.sliderWidth();
				break;
			case "top":
				curLayerBottom = nextLayerTop = 0;
				layerMarginTop = -u.g.sliderHeight();
				break;
			case "bottom":
				curLayerTop = nextLayerBottom = 0;
				layerMarginTop = u.g.sliderHeight();
				break
			}
			u.g.curLayer.css({
				left: t,
				right: curLayerRight,
				top: curLayerTop,
				bottom: curLayerBottom
			});
			u.g.nextLayer.css({
				width: nextLayerWidth,
				height: nextLayerHeight,
				left: nextLayerLeft,
				right: nextLayerRight,
				top: nextLayerTop,
				bottom: nextLayerBottom
			});
			var h = u.g.curLayer.data("delayout") ? parseInt(u.g.curLayer.data("delayout")) : u.o.delayOut;
			var p = u.g.curLayer.data("durationout") ? parseInt(u.g.curLayer.data("durationout")) : u.o.durationOut;
			var d = u.g.curLayer.data("easingout") ? u.g.curLayer.data("easingout") : u.o.easingOut;
			var v = u.g.nextLayer.data("delayin") ? parseInt(u.g.nextLayer.data("delayin")) : u.o.delayIn;
			var m = u.g.nextLayer.data("durationin") ? parseInt(u.g.nextLayer.data("durationin")) : u.o.durationIn;
			var g = u.g.nextLayer.data("easingin") ? u.g.nextLayer.data("easingin") : u.o.easingIn;
			var y = function () {
				u.g.curLayer.delay(h + p / 15).animate({
					width: o,
					height: a
				},
				p, d, function () {
					b()
				})
			};
			var b = function () {
				u.g.stopLayer.find(' > *[class*="ls-s"]').stop(true, true);
				u.o.cbAnimStop(u.g);
				u.g.curLayer = u.g.nextLayer;
				u.g.curLayerIndex = u.g.nextLayerIndex;
				e(s).find(".ls-layer").removeClass("ls-active");
				e(s).find(".ls-layer:eq(" + (u.g.curLayerIndex - 1) + ")").addClass("ls-active").removeClass("ls-animating");
				e(s).find(".ls-bottom-slidebuttons a").removeClass("ls-nav-active");
				e(s).find(".ls-bottom-slidebuttons a:eq(" + (u.g.curLayerIndex - 1) + ")").addClass("ls-nav-active");
				if (u.g.autoSlideshow) {
					u.timer()
				}
				u.g.isAnimating = false
			};
			var w = function (t) {
				u.g.curLayer.find(' > *[class*="ls-s"]').each(function () {
					var n = e(this).data("slidedirection") ? e(this).data("slidedirection") : c;
					var r, i;
					switch (n) {
					case "left":
						r = -u.g.sliderWidth();
						i = 0;
						break;
					case "right":
						r = u.g.sliderWidth();
						i = 0;
						break;
					case "top":
						i = -u.g.sliderHeight();
						r = 0;
						break;
					case "bottom":
						i = u.g.sliderHeight();
						r = 0;
						break
					}
					var s = e(this).data("slideoutdirection") ? e(this).data("slideoutdirection") : false;
					switch (s) {
					case "left":
						r = u.g.sliderWidth();
						i = 0;
						break;
					case "right":
						r = -u.g.sliderWidth();
						i = 0;
						break;
					case "top":
						i = u.g.sliderHeight();
						r = 0;
						break;
					case "bottom":
						i = -u.g.sliderHeight();
						r = 0;
						break
					}
					var o = parseInt(e(this).attr("class").split("ls-s")[1]);
					if (o == -1) {
						var a = parseInt(e(this).css("left"));
						var f = parseInt(e(this).css("top"));
						if (i < 0) {
							i = -(u.g.sliderHeight() - f + 1)
						} else if (i > 0) {
							i = f + e(this).outerHeight() + 1
						}
						if (r < 0) {
							r = -(u.g.sliderWidth() - a + 1)
						} else if (r > 0) {
							r = a + e(this).outerWidth() + 1
						}
						var l = 1
					} else {
						var h = u.g.curLayer.data("parallaxout") ? parseInt(u.g.curLayer.data("parallaxout")) : u.o.parallaxOut;
						var l = o * h
					}
					var p = e(this).data("delayout") ? parseInt(e(this).data("delayout")) : u.o.delayOut;
					var d = e(this).data("durationout") ? parseInt(e(this).data("durationout")) : u.o.durationOut;
					var v = e(this).data("easingout") ? e(this).data("easingout") : u.o.easingOut;
					if (t) {
						p = 0;
						d = t
					}
					var m = 0;
					if (!u.g.ie78 && u.g.enableCSS3) {
						m = e(this).data("rotateout") ? e(this).data("rotateout") : 0
					}
					var g = 1;
					if (!u.g.ie78 && u.g.enableCSS3) {
						g = e(this).data("scaleout") ? e(this).data("scaleout") : 1
					}
					if (e(this).data("showUntilTimer")) {
						clearTimeout(e(this).data("showUntilTimer"))
					}
					if (s == "fade" || !s && n == "fade") {
						if (t && u.g.ie78) {
							e(this).dequeue().css({
								visibility: "hidden"
							})
						} else {
							if (!u.g.ie78) {
								e(this).stop(true, false).delay(p).animate({
									opacity: 0,
									rotate: m,
									scale: g
								},
								d, v, function () {
									e(this).css({
										visibility: "hidden",
										opacity: e(this).data("originalOpacity")
									})
								})
							} else {
								e(this).stop(true, true).delay(p).fadeOut(d, v, function () {
									e(this).css({
										visibility: "hidden",
										display: "block"
									})
								})
							}
						}
					} else {
						e(this).stop(true, false).delay(p).animate({
							rotate: m,
							scale: g,
							marginLeft: -r * l,
							marginTop: -i * l
						},
						d, v)
					}
				})
			};
			var E = function () {
				u.g.nextLayer.delay(h + v).animate({
					width: u.g.sliderWidth(),
					height: u.g.sliderHeight()
				},
				m, g)
			};
			var S = function () {
				if (u.g.totalDuration) {
					h = 0
				}
				u.g.nextLayer.find(' > *[class*="ls-s"]').each(function () {
					var t = e(this).data("slidedirection") ? e(this).data("slidedirection") : c;
					var n, r;
					switch (t) {
					case "left":
						n = -u.g.sliderWidth();
						r = 0;
						break;
					case "right":
						n = u.g.sliderWidth();
						r = 0;
						break;
					case "top":
						r = -u.g.sliderHeight();
						n = 0;
						break;
					case "bottom":
						r = u.g.sliderHeight();
						n = 0;
						break;
					case "fade":
						r = 0;
						n = 0;
						break
					}
					var i = parseInt(e(this).attr("class").split("ls-s")[1]);
					if (i == -1) {
						var s = parseInt(e(this).css("left"));
						var o = parseInt(e(this).css("top"));
						if (r < 0) {
							r = -(o + e(this).outerHeight() + 1)
						} else if (r > 0) {
							r = u.g.sliderHeight() - o + 1
						}
						if (n < 0) {
							n = -(s + e(this).outerWidth() + 1)
						} else if (n > 0) {
							n = u.g.sliderWidth() - s + 1
						}
						var a = 1
					} else {
						var f = u.g.nextLayer.data("parallaxin") ? parseInt(u.g.nextLayer.data("parallaxin")) : u.o.parallaxIn;
						var a = i * f
					}
					var l = e(this).data("delayin") ? parseInt(e(this).data("delayin")) : u.o.delayIn;
					var p = e(this).data("durationin") ? parseInt(e(this).data("durationin")) : u.o.durationIn;
					var d = e(this).data("easingin") ? e(this).data("easingin") : u.o.easingIn;
					var m = e(this);
					var g = function () {
						if (u.o.autoPlayVideos == true) {
							m.find(".ls-videopreview").click()
						}
						if (m.data("showuntil") > 0) {
							m.data("showUntilTimer", setTimeout(function () {
								u.sublayerShowUntil(m)
							},
							m.data("showuntil")))
						}
					};
					var y = 0;
					if (!u.g.ie78 && u.g.enableCSS3) {
						y = e(this).data("rotatein") ? e(this).data("rotatein") : 0
					}
					var b = 1;
					if (!u.g.ie78 && u.g.enableCSS3) {
						b = e(this).data("scalein") ? e(this).data("scalein") : 1
					}
					if (t == "fade") {
						if (!u.g.ie78) {
							e(this).css({
								transform: "rotate(" + y + "deg) scale(" + b + ")",
								"-ms-transform": "rotate(" + y + "deg) scale(" + b + ")",
								"-webkit-transform": "rotate(" + y + "deg) scale(" + b + ")",
								"-o-transform": "rotate(" + y + "deg) scale(" + b + ")",
								"-moz-transform": "rotate(" + y + "deg) scale(" + b + ")",
								opacity: 0,
								visibility: "visible",
								marginLeft: 0,
								marginTop: 0
							}).stop().delay(h + v + l).animate({
								scale: 1,
								rotate: 0,
								opacity: e(this).data("originalOpacity")
							},
							p, d, function () {
								g()
							})
						} else {
							e(this).css({
								display: "none",
								visibility: "visible",
								marginLeft: 0,
								marginTop: 0
							}).stop(true, true).delay(h + v + l).fadeIn(p, d, function () {
								g()
							})
						}
					} else {
						if (!u.g.ie78) {
							e(this).css({
								opacity: e(this).data("originalOpacity")
							})
						}
						e(this).css({
							transform: "rotate(" + y + "deg) scale(" + b + ")",
							"-ms-transform": "rotate(" + y + "deg) scale(" + b + ")",
							"-webkit-transform": "rotate(" + y + "deg) scale(" + b + ")",
							"-o-transform": "rotate(" + y + "deg) scale(" + b + ")",
							"-moz-transform": "rotate(" + y + "deg) scale(" + b + ")",
							marginLeft: n * a,
							marginTop: r * a,
							display: "block",
							visibility: "visible"
						});
						e(this).stop().delay(h + v + l).animate({
							marginLeft: 0,
							marginTop: 0,
							scale: 1,
							rotate: 0
						},
						p, d, function () {
							g()
						})
					}
				})
			};
			var x = function () {
				if (n(e(s)) && e.transit != undefined && (u.g.nextLayer.data("transition3d") || u.g.nextLayer.data("customtransition3d"))) {
					if (u.g.nextLayer.data("transition3d") && u.g.nextLayer.data("customtransition3d")) {
						var t = Math.floor(Math.random() * 2);
						var r = [["3d", u.g.nextLayer.data("transition3d")], ["custom3d", u.g.nextLayer.data("customtransition3d")]];
						N(r[t][0], r[t][1])
					} else if (u.g.nextLayer.data("transition3d")) {
						N("3d", u.g.nextLayer.data("transition3d"))
					} else {
						N("custom3d", u.g.nextLayer.data("customtransition3d"))
					}
				} else {
					if (u.g.nextLayer.data("transition2d") && u.g.nextLayer.data("customtransition2d")) {
						var t = Math.floor(Math.random() * 2);
						var r = [["2d", u.g.nextLayer.data("transition2d")], ["custom2d", u.g.nextLayer.data("customtransition2d")]];
						N(r[t][0], r[t][1])
					} else if (u.g.nextLayer.data("transition2d")) {
						N("2d", u.g.nextLayer.data("transition2d"))
					} else if (u.g.nextLayer.data("customtransition2d")) {
						N("custom2d", u.g.nextLayer.data("customtransition2d"))
					} else {
						N("2d", "all")
					}
				}
			};
			var T = function () {
				if (n(e(s)) && LSCustomTransition.indexOf("3d") != -1) {
					N("3d", LSCustomTransition.split(":")[1])
				} else {
					if (LSCustomTransition.indexOf("3d") != -1) {
						N("2d", "all")
					} else {
						N("2d", LSCustomTransition.split(":")[1])
					}
				}
			};
			var N = function (e, t) {
				var n = e.indexOf("custom") == -1 ? u.t: u.ct;
				var r = "3d",
				s, o;
				if (e.indexOf("2d") != -1) {
					r = "2d"
				}
				if (t.indexOf("last") != -1) {
					o = n["t" + r].length - 1;
					s = "last"
				} else if (t.indexOf("all") != -1) {
					o = Math.floor(Math.random() * i(n["t" + r]));
					s = "random from all"
				} else {
					var a = t.split(",");
					var f = a.length;
					o = parseInt(a[Math.floor(Math.random() * f)]) - 1;
					s = "random from specified"
				}
				C(r, n["t" + r][o])
			};
			var C = function (t, n) {
				var i = e(s).find(".ls-inner");
				var o = u.g.curLayer.find('*[class*="ls-s"]').length > 0 ? 1e3: 0;
				var a = n.name.toLowerCase().indexOf("carousel") == -1 ? false: true;
				var f = typeof n.cols == "number" ? n.cols: Math.floor(Math.random() * (n.cols[1] - n.cols[0] + 1)) + n.cols[0];
				var l = typeof n.rows == "number" ? n.rows: Math.floor(Math.random() * (n.rows[1] - n.rows[0] + 1)) + n.rows[0];
				if (u.g.isMobile() == true && u.o.optimizeForMobile == true || u.g.ie78 && u.o.optimizeForIE78 == true) {
					if (f >= 15) {
						f = 7
					} else if (f >= 5) {
						f = 4
					} else if (f >= 4) {
						f = 3
					} else if (f > 2) {
						f = 2
					}
					if (l >= 15) {
						l = 7
					} else if (l >= 5) {
						l = 4
					} else if (l >= 4) {
						l = 3
					} else if (l > 2) {
						l = 2
					}
					if (l > 2 && f > 2) {
						l = 2;
						if (f > 4) {
							f = 4
						}
					}
				}
				var c = e(s).find(".ls-inner").width() / f;
				var h = e(s).find(".ls-inner").height() / l;
				if (!u.g.ltContainer) {
					u.g.ltContainer = e("<div>").addClass("ls-lt-container").addClass("ls-overflow-hidden").css({
						width: i.width(),
						height: i.height()
					}).prependTo(i)
				} else {
					u.g.ltContainer.empty().css({
						width: i.width(),
						height: i.height()
					})
				}
				var p = i.width() - Math.floor(c) * f;
				var d = i.height() - Math.floor(h) * l;
				var v = [];
				v.randomize = function () {
					var e = this.length,
					t, n, r;
					if (e == 0) return false;
					while (--e) {
						t = Math.floor(Math.random() * (e + 1));
						n = this[e];
						r = this[t];
						this[e] = r;
						this[t] = n
					}
					return this
				};
				for (var m = 0; m < f * l; m++) {
					v.push(m)
				}
				switch (n.tile.sequence) {
				case "reverse":
					v.reverse();
					break;
				case "col-forward":
					v = r(l, f, "forward");
					break;
				case "col-reverse":
					v = r(l, f, "reverse");
					break;
				case "random":
					v.randomize();
					break
				}
				if (t == "3d") {
					u.g.totalDuration = o + (f * l - 1) * n.tile.delay;
					var g = 0;
					if (n.before && n.before.duration) {
						g += n.before.duration
					}
					if (n.animation && n.animation.duration) {
						g += n.animation.duration
					}
					if (n.after && n.after.duration) {
						g += n.after.duration
					}
					u.g.totalDuration += g;
					var y = 0;
					if (n.before && n.before.delay) {
						y += n.before.delay
					}
					if (n.animation && n.animation.delay) {
						y += n.animation.delay
					}
					if (n.after && n.after.delay) {
						y += n.after.delay
					}
					u.g.totalDuration += y
				} else {
					u.g.totalDuration = o + (f * l - 1) * n.tile.delay + n.transition.duration;
					u.g.curTiles = e("<div>").addClass("ls-curtiles").appendTo(u.g.ltContainer);
					u.g.nextTiles = e("<div>").addClass("ls-nexttiles").appendTo(u.g.ltContainer)
				}
				var E = u.g.prevNext;
				for (var x = 0; x < f * l; x++) {
					var T = x % f == 0 ? p: 0;
					var N = x > (l - 1) * f - 1 ? d: 0;
					var C = e("<div>").addClass("ls-lt-tile").css({
						width: Math.floor(c) + T,
						height: Math.floor(h) + N
					}).appendTo(u.g.ltContainer);
					var k, L;
					if (t == "3d") {
						C.addClass("ls-3d-container");
						var A = Math.floor(c) + T;
						var O = Math.floor(h) + N;
						var M;
						if (n.animation.direction == "horizontal") {
							if (Math.abs(n.animation.transition.rotateY) > 90 && n.tile.depth != "large") {
								M = Math.floor(A / 7) + T
							} else {
								M = A
							}
						} else {
							if (Math.abs(n.animation.transition.rotateX) > 90 && n.tile.depth != "large") {
								M = Math.floor(O / 7) + N
							} else {
								M = O
							}
						}
						var _ = A / 2;
						var D = O / 2;
						var P = M / 2;
						var H = function (t, n, r, i, s, o, u, a, f) {
							e("<div>").addClass(t).css({
								width: r,
								height: i,
								transform: "translate3d(" + s + "px, " + o + "px, " + u + "px) rotateX(" + a + "deg) rotateY(" + f + "deg) rotateZ(0deg) scale3d(1, 1, 1)",
								"-o-transform": "translate3d(" + s + "px, " + o + "px, " + u + "px) rotateX(" + a + "deg) rotateY(" + f + "deg) rotateZ(0deg) scale3d(1, 1, 1)",
								"-ms-transform": "translate3d(" + s + "px, " + o + "px, " + u + "px) rotateX(" + a + "deg) rotateY(" + f + "deg) rotateZ(0deg) scale3d(1, 1, 1)",
								"-moz-transform": "translate3d(" + s + "px, " + o + "px, " + u + "px) rotateX(" + a + "deg) rotateY(" + f + "deg) rotateZ(0deg) scale3d(1, 1, 1)",
								"-webkit-transform": "translate3d(" + s + "px, " + o + "px, " + u + "px) rotateX(" + a + "deg) rotateY(" + f + "deg) rotateZ(0deg) scale3d(1, 1, 1)"
							}).appendTo(n)
						};
						H("ls-3d-box", C, 0, 0, 0, 0, -P, 0, 0);
						var B = 0;
						var j = 0;
						var F = 0;
						if (n.animation.direction == "vertical" && Math.abs(n.animation.transition.rotateX) > 90) {
							H("ls-3d-back", C.find(".ls-3d-box"), A, O, -_, -D, -P, 180, 0)
						} else {
							H("ls-3d-back", C.find(".ls-3d-box"), A, O, -_, -D, -P, 0, 180)
						}
						H("ls-3d-bottom", C.find(".ls-3d-box"), A, M, -_, D - P, 0, -90, 0);
						H("ls-3d-top", C.find(".ls-3d-box"), A, M, -_, -D - P, 0, 90, 0);
						H("ls-3d-front", C.find(".ls-3d-box"), A, O, -_, -D, P, 0, 0);
						H("ls-3d-left", C.find(".ls-3d-box"), M, O, -_ - P, -D, 0, 0, -90);
						H("ls-3d-right", C.find(".ls-3d-box"), M, O, _ - P, -D, 0, 0, 90);
						k = C.find(".ls-3d-front");
						if (n.animation.direction == "horizontal") {
							if (Math.abs(n.animation.transition.rotateY) > 90) {
								L = C.find(".ls-3d-back")
							} else {
								L = C.find(".ls-3d-left, .ls-3d-right")
							}
						} else {
							if (Math.abs(n.animation.transition.rotateX) > 90) {
								L = C.find(".ls-3d-back")
							} else {
								L = C.find(".ls-3d-top, .ls-3d-bottom")
							}
						}
						var I = o + v[x] * n.tile.delay;
						var q = u.g.ltContainer.find(".ls-3d-container:eq(" + x + ") .ls-3d-box");
						if (n.before && n.before.transition) {
							n.before.transition.delay = n.before.transition.delay ? n.before.transition.delay + I: I;
							q.transition(n.before.transition, n.before.duration, n.before.easing)
						} else {
							n.animation.transition.delay = n.animation.transition.delay ? n.animation.transition.delay + I: I
						}
						q.transition(n.animation.transition, n.animation.duration, n.animation.easing);
						if (n.after) {
							q.transition(e.extend({},
							{
								scale3d: 1
							},
							n.after.transition), n.after.duration, n.after.easing)
						}
					} else {
						var R = L1 = T2 = L2 = "auto";
						var U = O2 = 1;
						if (n.transition.direction == "random") {
							var z = ["top", "bottom", "right", "left"];
							var W = z[Math.floor(Math.random() * z.length)]
						} else {
							var W = n.transition.direction
						}
						if (n.name.toLowerCase().indexOf("mirror") != -1 && x % 2 == 0) {
							if (E == "prev") {
								E = "next"
							} else {
								E = "prev"
							}
						}
						if (E == "prev") {
							switch (W) {
							case "top":
								W = "bottom";
								break;
							case "bottom":
								W = "top";
								break;
							case "left":
								W = "right";
								break;
							case "right":
								W = "left";
								break;
							case "topleft":
								W = "bottomright";
								break;
							case "topright":
								W = "bottomleft";
								break;
							case "bottomleft":
								W = "topright";
								break;
							case "bottomright":
								W = "topleft";
								break
							}
						}
						switch (W) {
						case "top":
							R = T2 = -C.height();
							L1 = L2 = 0;
							break;
						case "bottom":
							R = T2 = C.height();
							L1 = L2 = 0;
							break;
						case "left":
							R = T2 = 0;
							L1 = L2 = -C.width();
							break;
						case "right":
							R = T2 = 0;
							L1 = L2 = C.width();
							break;
						case "topleft":
							R = C.height();
							T2 = 0;
							L1 = C.width();
							L2 = 0;
							break;
						case "topright":
							R = C.height();
							T2 = 0;
							L1 = -C.width();
							L2 = 0;
							break;
						case "bottomleft":
							R = -C.height();
							T2 = 0;
							L1 = C.width();
							L2 = 0;
							break;
						case "bottomright":
							R = -C.height();
							T2 = 0;
							L1 = -C.width();
							L2 = 0;
							break
						}
						u.g.scale2D = n.transition.scale ? n.transition.scale: 1;
						if (a == true && u.g.scale2D != 1) {
							R = R / 2;
							T2 = T2 / 2;
							L1 = L1 / 2;
							L2 = L2 / 2
						}
						switch (n.transition.type) {
						case "fade":
							R = T2 = L1 = L2 = 0;
							U = 0;
							O2 = 1;
							break;
						case "mixed":
							U = 0;
							O2 = 1;
							if (u.g.scale2D == 1) {
								T2 = L2 = 0
							}
							break
						}
						if ((n.transition.rotate || n.transition.rotateX || n.transition.rotateY || u.g.scale2D != 1) && !u.g.ie78 && n.transition.type != "slide") {
							C.css({
								overflow: "visible"
							})
						} else {
							C.css({
								overflow: "hidden"
							})
						}
						if (a == true) {
							u.g.curTiles.css({
								overflow: "visible"
							})
						} else {
							u.g.curTiles.css({
								overflow: "hidden"
							})
						}
						if (n.transition.type == "slide" || a == true) {
							var X = C.appendTo(u.g.curTiles);
							k = e("<div>").addClass("ls-curtile").appendTo(X);
							var V = C.clone().appendTo(u.g.nextTiles)
						} else {
							var V = C.appendTo(u.g.nextTiles)
						}
						L = e("<div>").addClass("ls-nexttile").appendTo(V).css({
							top: -R,
							left: -L1,
							dispay: "block",
							opacity: U
						});
						var J = o + v[x] * n.tile.delay;
						if (u.g.cssTransitions && e.transit != undefined) {
							var K = n.transition.rotate ? n.transition.rotate: 0;
							var Q = n.transition.rotateX ? n.transition.rotateX: 0;
							var G = n.transition.rotateY ? n.transition.rotateY: 0;
							if (E == "prev") {
								K = -K;
								Q = -Q;
								G = -G
							}
							if (Q != 0 || G != 0 || K != 0 || u.g.scale2D != 1) {
								L.css({
									transform: "rotate(" + K + "deg) rotateX(" + Q + "deg) rotateY(" + G + "deg) scale(" + u.g.scale2D + "," + u.g.scale2D + ")",
									"-o-transform": "rotate(" + K + "deg) rotateX(" + Q + "deg) rotateY(" + G + "deg) scale(" + u.g.scale2D + "," + u.g.scale2D + ")",
									"-ms-transform": "rotate(" + K + "deg) rotateX(" + Q + "deg) rotateY(" + G + "deg) scale(" + u.g.scale2D + "," + u.g.scale2D + ")",
									"-moz-transform": "rotate(" + K + "deg) rotateX(" + Q + "deg) rotateY(" + G + "deg) scale(" + u.g.scale2D + "," + u.g.scale2D + ")",
									"-webkit-transform": "rotate(" + K + "deg) rotateX(" + Q + "deg) rotateY(" + G + "deg) scale(" + u.g.scale2D + "," + u.g.scale2D + ")"
								})
							}
							L.transition({
								delay: J,
								top: 0,
								left: 0,
								opacity: O2,
								rotate: 0,
								rotateX: 0,
								rotateY: 0,
								scale: 1
							},
							n.transition.duration, n.transition.easing);
							if ((n.transition.type == "slide" || a == true) && n.name.toLowerCase().indexOf("mirror") == -1) {
								var Y = 0;
								if (K != 0) {
									Y = -K
								}
								k.transition({
									delay: J,
									top: T2,
									left: L2,
									rotate: Y,
									scale: u.g.scale2D,
									opacity: U
								},
								n.transition.duration, n.transition.easing)
							}
						} else {
							L.delay(J).animate({
								top: 0,
								left: 0,
								opacity: O2
							},
							n.transition.duration, n.transition.easing);
							if (n.transition.type == "slide") {
								k.delay(J).animate({
									top: T2,
									left: L2
								},
								n.transition.duration, n.transition.easing)
							}
						}
					}
					var Z = u.g.curLayer.find(".ls-bg");
					if (Z.length) {
						if (t == "3d" || t == "2d" && (n.transition.type == "slide" || a == true)) {
							k.append(e("<img>").attr("src", Z.attr("src")).css({
								width: Z[0].style.width,
								height: Z[0].style.height,
								marginLeft: i.width() / 2 + parseFloat(Z.css("margin-left")) - parseInt(C.position().left),
								marginTop: i.height() / 2 + parseFloat(Z.css("margin-top")) - parseInt(C.position().top)
							}))
						} else if (u.g.curTiles.children().length == 0) {
							u.g.curTiles.append(e("<img>").attr("src", Z.attr("src")).css({
								width: Z[0].style.width,
								height: Z[0].style.height,
								marginLeft: i.width() / 2 + parseFloat(Z.css("margin-left")),
								marginTop: i.height() / 2 + parseFloat(Z.css("margin-top"))
							}))
						}
					}
					var et = u.g.nextLayer.find(".ls-bg");
					if (et.length) {
						L.append(e("<img>").attr("src", et.attr("src")).css({
							width: et[0].style.width,
							height: et[0].style.height,
							marginLeft: i.width() / 2 + parseFloat(et.css("margin-left")) - parseInt(C.position().left),
							marginTop: i.height() / 2 + parseFloat(et.css("margin-top")) - parseInt(C.position().top)
						}))
					}
				}
				var tt = u.g.curLayer;
				var nt = u.g.nextLayer;
				nt.find(".ls-bg").css({
					visibility: "hidden"
				});
				if (t == "3d" && u.g.isHideOn3D(e(s))) {
					if (!u.o.hoverPrevNext) {
						e(s).find(".ls-nav-prev, .ls-nav-next").stop(true, true).fadeOut(500)
					}
					if (!u.o.hoverBottomNav) {
						if (u.g.bottomWrapper) {
							u.g.bottomWrapper.stop(true, true).fadeOut(500)
						}
						if (u.g.thumbsWrapper) {
							u.g.thumbsWrapper.stop(true, true).fadeOut(500)
						}
					}
					if (u.g.yourLogo && u.o.hideYourLogo) {
						u.g.yourLogo.stop(true, true).fadeOut(500)
					}
				}
				if (t == "3d") {
					e(s).find(".ls-fullscreen").stop(true, true).fadeOut(300)
				}
				w(o);
				setTimeout(function () {
					tt.css({
						width: 0
					});
					u.g.ltContainer.removeClass("ls-overflow-hidden")
				},
				o);
				var rt = parseInt(nt.data("timeshift")) ? parseInt(nt.data("timeshift")) : 0;
				var it = u.g.totalDuration + rt > 0 ? u.g.totalDuration + rt: 0;
				setTimeout(function () {
					S();
					nt.css({
						width: u.g.sliderWidth(),
						height: u.g.sliderHeight()
					})
				},
				it);
				setTimeout(function () {
					u.g.ltContainer.addClass("ls-overflow-hidden");
					nt.addClass("ls-active");
					if (nt.find(".ls-bg").length) {
						nt.find(".ls-bg").css({
							display: "none",
							visibility: "visible"
						});
						if (u.g.ie78) {
							nt.find(".ls-bg").css("display", "block");
							setTimeout(function () {
								b()
							},
							500)
						} else {
							nt.find(".ls-bg").fadeIn(500, function () {
								b()
							})
						}
					} else {
						b()
					}
					if (t == "3d" && u.g.isHideOn3D(e(s))) {
						if (!u.o.hoverPrevNext) {
							e(s).find(".ls-nav-prev, .ls-nav-next").stop(true, true).fadeIn(500)
						}
						if (!u.o.hoverBottomNav) {
							if (u.g.bottomWrapper) {
								u.g.bottomWrapper.stop(true, true).fadeIn(500)
							}
							if (u.g.thumbsWrapper) {
								u.g.thumbsWrapper.stop(true, true).fadeIn(500)
							}
						}
						if (u.g.yourLogo && u.o.hideYourLogo) {
							u.g.yourLogo.stop(true, true).fadeIn(500)
						}
					}
				},
				u.g.totalDuration)
			};
			transitionType = (u.g.nextLayer.data("transition3d") || u.g.nextLayer.data("transition2d")) && u.t || (u.g.nextLayer.data("customtransition3d") || u.g.nextLayer.data("customtransition2d")) && u.ct ? "new": "old";
			if (u.o.animateFirstLayer && !u.g.firstLayerAnimated) {
				if (u.g.layersNum == 1) {
					var h = 0;
					u.o.cbAnimStop(u.g)
				} else {
					var k = parseInt(u.g.nextLayer.data("timeshift")) ? parseInt(u.g.nextLayer.data("timeshift")) : 0;
					var L = transitionType == "new" ? 0 : p;
					setTimeout(function () {
						b()
					},
					L + Math.abs(k))
				}
				u.g.totalDuration = true;
				S();
				u.g.nextLayer.css({
					width: u.g.sliderWidth(),
					height: u.g.sliderHeight()
				});
				if (!u.g.ie78) {
					u.g.nextLayer.find(".ls-bg").css({
						display: "none"
					}).fadeIn(500)
				}
				u.g.firstLayerAnimated = true;
				u.g.isLoading = false
			} else {
				switch (transitionType) {
				case "old":
					u.g.totalDuration = false;
					if (u.g.ltContainer) {
						u.g.ltContainer.empty()
					}
					y();
					w();
					E();
					S();
					break;
				case "new":
					if (typeof LSCustomTransition != "undefined") {
						T()
					} else {
						x()
					}
					break
				}
			}
		};
		u.sublayerShowUntil = function (e) {
			var t = u.g.curLayer;
			if (u.g.prevNext != "prev" && u.g.nextLayer) {
				t = u.g.nextLayer
			}
			var n = t.data("slidedirection") ? t.data("slidedirection") : u.o.slideDirection;
			var r = u.g.slideDirections[u.g.prevNext][n];
			var i = e.data("slidedirection") ? e.data("slidedirection") : r;
			var s, o;
			switch (i) {
			case "left":
				s = -u.g.sliderWidth();
				o = 0;
				break;
			case "right":
				s = u.g.sliderWidth();
				o = 0;
				break;
			case "top":
				o = -u.g.sliderHeight();
				s = 0;
				break;
			case "bottom":
				o = u.g.sliderHeight();
				s = 0;
				break
			}
			var a = e.data("slideoutdirection") ? e.data("slideoutdirection") : false;
			switch (a) {
			case "left":
				s = u.g.sliderWidth();
				o = 0;
				break;
			case "right":
				s = -u.g.sliderWidth();
				o = 0;
				break;
			case "top":
				o = u.g.sliderHeight();
				s = 0;
				break;
			case "bottom":
				o = -u.g.sliderHeight();
				s = 0;
				break
			}
			var f = parseInt(e.attr("class").split("ls-s")[1]);
			if (f == -1) {
				var l = parseInt(e.css("left"));
				var c = parseInt(e.css("top"));
				if (o < 0) {
					o = -(u.g.sliderHeight() - c + 1)
				} else if (o > 0) {
					o = c + e.outerHeight() + 1
				}
				if (s < 0) {
					s = -(u.g.sliderWidth() - l + 1)
				} else if (s > 0) {
					s = l + e.outerWidth() + 1
				}
				var h = 1
			} else {
				var p = u.g.curLayer.data("parallaxout") ? parseInt(u.g.curLayer.data("parallaxout")) : u.o.parallaxOut;
				var h = f * p
			}
			var d = e.data("durationout") ? parseInt(e.data("durationout")) : u.o.durationOut;
			var v = e.data("easingout") ? e.data("easingout") : u.o.easingOut;
			var m = 0;
			if (!u.g.ie78 && u.g.enableCSS3) {
				m = e.data("rotateout") ? e.data("rotateout") : 0
			}
			var g = 1;
			if (!u.g.ie78 && u.g.enableCSS3) {
				g = e.data("scaleout") ? e.data("scaleout") : 1
			}
			if (a == "fade" || !a && i == "fade") {
				if (!u.g.ie78) {
					e.animate({
						opacity: 0,
						rotate: m,
						scale: g
					},
					d, v)
				} else {
					e.fadeOut(d, v)
				}
			} else {
				e.animate({
					rotate: m,
					scale: g,
					marginLeft: -s * h,
					marginTop: -o * h
				},
				d, v)
			}
		};
		u.debug = function () {
			u.d = {
				history: e("<div>"),
				aT: function (t) {
					e("<h1>" + t + "</h1>").appendTo(u.d.history)
				},
				aeU: function () {
					e("<ul>").appendTo(u.d.history)
				},
				aU: function (t) {
					e("<ul><li>" + t + "</li></ul>").appendTo(u.d.history)
				},
				aL: function (t) {
					e("<li>" + t + "</li>").appendTo(u.d.history.find("ul:last"))
				},
				aUU: function (t) {
					e("<ul>").appendTo(u.d.history.find("ul:last li:last"))
				},
				aF: function (e) {
					u.d.history.find("ul:last li:last").hover(function () {
						e.css({
							border: "2px solid red",
							marginTop: parseInt(e.css("margin-top")) - 2,
							marginLeft: parseInt(e.css("margin-left")) - 2
						})
					},
					function () {
						e.css({
							border: "0px",
							marginTop: parseInt(e.css("margin-top")) + 2,
							marginLeft: parseInt(e.css("margin-left")) + 2
						})
					})
				},
				show: function () {
					if (!e("body").find(".ls-debug-console").length) {
						var t = e("<div>").addClass("ls-debug-console").css({
							position: "fixed",
							zIndex: "10000000000",
							top: "10px",
							right: "10px",
							width: "300px",
							padding: "20px",
							background: "black",
							"border-radius": "10px",
							height: e(window).height() - 60,
							opacity: 0,
							marginRight: 150
						}).appendTo(e("body")).animate({
							marginRight: 0,
							opacity: .9
						},
						600, "easeInOutQuad").click(function (t) {
							if (t.shiftKey && t.altKey) {
								e(this).animate({
									marginRight: 150,
									opacity: 0
								},
								600, "easeInOutQuad", function () {
									e(this).remove()
								})
							}
						});
						var n = e("<div>").css({
							width: "100%",
							height: "100%",
							overflow: "auto"
						}).appendTo(t);
						var r = e("<div>").css({
							width: "100%"
						}).appendTo(n).append(u.d.history)
					}
				},
				hide: function () {
					e("body").find(".ls-debug-console").remove()
				}
			};
			e(s).click(function (e) {
				if (e.shiftKey && e.altKey) {
					u.d.show()
				}
			})
		};
		u.load()
	};
	var n = function (t) {
		var n = e("<div>"),
		r = false,
		i = false,
		s = ["perspective", "OPerspective", "msPerspective", "MozPerspective", "WebkitPerspective"];
		transform = ["transformStyle", "OTransformStyle", "msTransformStyle", "MozTransformStyle", "WebkitTransformStyle"];
		for (var o = s.length - 1; o >= 0; o--) {
			r = r ? r: n[0].style[s[o]] != undefined
		}
		for (var o = transform.length - 1; o >= 0; o--) {
			n.css("transform-style", "preserve-3d");
			i = i ? i: n[0].style[transform[o]] == "preserve-3d"
		}
		if (r && n[0].style[s[4]] != undefined) {
			n.attr("id", "ls-test3d").appendTo(t);
			r = n[0].offsetHeight === 3 && n[0].offsetLeft === 9;
			n.remove()
		}
		return r && i
	};
	var r = function (e, t, n) {
		var r = [];
		if (n == "forward") {
			for (var i = 0; i < e; i++) {
				for (var s = 0; s < t; s++) {
					r.push(i + s * e)
				}
			}
		} else {
			for (var i = e - 1; i > -1; i--) {
				for (var s = t - 1; s > -1; s--) {
					r.push(i + s * e)
				}
			}
		}
		return r
	};
	var i = function (e) {
		var t = 0;
		for (var n in e) {
			if (e.hasOwnProperty(n)) {++t
			}
		}
		return t
	};
	var s = function () {
		uaMatch = function (e) {
			e = e.toLowerCase();
			var t = /(chrome)[ \/]([\w.]+)/.exec(e) || /(webkit)[ \/]([\w.]+)/.exec(e) || /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(e) || /(msie) ([\w.]+)/.exec(e) || e.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(e) || [];
			return {
				browser: t[1] || "",
				version: t[2] || "0"
			}
		};
		var e = uaMatch(navigator.userAgent),
		t = {};
		if (e.browser) {
			t[e.browser] = true;
			t.version = e.version
		}
		if (t.chrome) {
			t.webkit = true
		} else if (t.webkit) {
			t.safari = true
		}
		return t
	};
	lsPrefixes = function (e, t) {
		var n = ["webkit", "khtml", "moz", "ms", "o", ""];
		var r = 0,
		i, s;
		while (r < n.length && !e[i]) {
			i = t;
			if (n[r] == "") {
				i = i.substr(0, 1).toLowerCase() + i.substr(1)
			}
			i = n[r] + i;
			s = typeof e[i];
			if (s != "undefined") {
				n = [n[r]];
				return s == "function" ? e[i]() : e[i]
			}
			r++
		}
	};
	t.global = {
		version: "4.5.0",
		isMobile: function () {
			if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
				return true
			} else {
				return false
			}
		},
		isHideOn3D: function (e) {
			if (e.css("padding-bottom") == "auto" || e.css("padding-bottom") == "none" || e.css("padding-bottom") == 0 || e.css("padding-bottom") == "0px") {
				return true
			} else {
				return false
			}
		},
		cssTransitions: !s().msie || s().msie && s().version > 9 ? true: false,
		ie78: s().msie && s().version < 9 ? true: false,
		normalWidth: false,
		normalHeight: false,
		normalRatio: false,
		goingNormal: false,
		paused: false,
		pausedByVideo: false,
		autoSlideshow: false,
		isAnimating: false,
		layersNum: null,
		prevNext: "next",
		slideTimer: null,
		sliderWidth: null,
		sliderHeight: null,
		slideDirections: {
			prev: {
				left: "right",
				right: "left",
				top: "bottom",
				bottom: "top"
			},
			next: {
				left: "left",
				right: "right",
				top: "top",
				bottom: "bottom"
			}
		},
		v: {
			d: 500,
			fo: 750,
			fi: 500
		}
	};
	t.options = {
		autoStart: true,
		firstLayer: 1,
		twoWaySlideshow: true,
		keybNav: true,
		imgPreload: true,
		navPrevNext: true,
		navStartStop: true,
		navButtons: true,
		skin: "glass",
		skinsPath: "/layerslider/skins/",
		pauseOnHover: true,
		globalBGColor: "transparent",
		globalBGImage: false,
		animateFirstLayer: true,
		yourLogo: false,
		yourLogoStyle: "left: -10px; top: -10px;",
		yourLogoLink: false,
		yourLogoTarget: "_blank",
		touchNav: true,
		loops: 0,
		forceLoopNum: true,
		autoPlayVideos: true,
		autoPauseSlideshow: "auto",
		youtubePreview: "maxresdefault.jpg",
		responsive: true,
		randomSlideshow: false,
		responsiveUnder: 0,
		sublayerContainer: 0,
		thumbnailNavigation: "hover",
		tnWidth: 100,
		tnHeight: 60,
		tnContainerWidth: "60%",
		tnActiveOpacity: 35,
		tnInactiveOpacity: 100,
		hoverPrevNext: true,
		hoverBottomNav: false,
		showBarTimer: false,
		showCircleTimer: true,
		optimizeForMobile: true,
		optimizeForIE78: true,
		hideYourLogo: false,
		allowFullScreenMode: false,
		cbInit: function (e) {},
		cbStart: function (e) {},
		cbStop: function (e) {},
		cbPause: function (e) {},
		cbAnimStart: function (e) {},
		cbAnimStop: function (e) {},
		cbPrev: function (e) {},
		cbNext: function (e) {},
		slideDirection: "right",
		slideDelay: 4e3,
		parallaxIn: .45,
		parallaxOut: .45,
		durationIn: 1e3,
		durationOut: 1e3,
		easingIn: "easeInOutQuint",
		easingOut: "easeInOutQuint",
		delayIn: 0,
		delayOut: 0
	}
})(jQuery)