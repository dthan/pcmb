/* ---------------------------------------------------------------------- */
/*	Theme Settings														  */
/* ---------------------------------------------------------------------- */

	/* ---------------------------------------------------- */
	/*	Flickr											    */
	/* ---------------------------------------------------- */

	var objFlickr = {
		limit: 6, // Max 9
		qstrings: {id : '54958895@N06'}, // ID
		itemTemplate: '<li><a class="badge" target="_blank" href="{{image_b}}" href="#"><img src="{{image_s}}" alt="{{title}}" /></a></li>'
	};

	/* ---------------------------------------------------- */
	/*	Google Map											*/
	/* ---------------------------------------------------- */

	var objGoogleMap = {
		address: 'New York, USA', // City, County
		markers: [
			{'address' : 'Grand St, New York'} // Street
		],
		zoom: 14 // 0 - 21
	};

	/* ---------------------------------------------------- */
	/*	Layer Slider										*/
	/* ---------------------------------------------------- */

	var objLayerSlider = {
		width : '100%',						
		height : '400px',
		responsive : true,					//Boolean:  (true/false)
		responsiveUnder : 940,
		sublayerContainer : 940,
		autoStart : true,					//Boolean:  If true, slideshow will automatically start after loading the page. (true/false)
		pauseOnHover : true,				//Boolean: If ture, SlideShow will pause when you move the mouse pointer over the LayerSlider container. (true/false)
		firstLayer : 1,						//Integer:  LayerSlider will begin with this layer. (Positive Integer)
		animateFirstLayer : true,			//Boolean:  (true/false)
		randomSlideshow : false,			//Boolean:  (true/false)
		twoWaySlideshow : true,				//Boolean: If true, slideshow will go backwards if you click the prev button. (true/false)
		loops : 0,
		forceLoopNum : true,				//Boolean:  (true/false)
		autoPlayVideos : false,				//Boolean:  (true/false)
		autoPauseSlideshow : 'auto',
		keybNav : true,						 //Boolean: Keyboard navigation. You can navigate with the left and right arrow keys. (true/false)
		touchNav : true,					 //Boolean:  (true/false)
		skin : 'goodnex',					 //String: You can change the skin of the Slider. (name_of_the_skin) 
		skinsPath : 'js/layerslider/skins/', //String: You can change the default path of the skins folder. Note, that you must use the slash at the end of the path. (path_of_the_skins_folder/)
		showBarTimer : false,				 //Boolean:  (true/false)
		showCircleTimer : false,			 //Boolean:  (true/false)
		globalBGColor : '#f6f6f6',			 //CSS Color Methods. Background color of LayerSlider. You can use all CSS methods, like hexa colors, rgb(r,g,b) method, color names, etc. Note, that background sublayers are covering the background. 
		navPrevNext : true,					 //Boolean: If false, Prev and Next buttons will be invisible. (true/false)
		navStartStop : false,				 //Boolean: If false, Start and Stop buttons will be invisible. (true/false)
		navButtons : false,					 //Boolean: If false, slide buttons will be invisible. (true/false)
		hoverPrevNext : true,				//Boolean:  (true/false)
		hoverBottomNav : false,				//Boolean:  (true/false)
		thumbnailNavigation : 'disabled',
		tnWidth : 100,
		tnHeight : 60,
		tnContainerWidth : '60%',
		tnActiveOpacity : 35,
		tnInactiveOpacity : 100
	};

	/* ---------------------------------------------------- */
	/*	Flex Slider											*/
	/* ---------------------------------------------------- */

	var objFlexSlider = {
		animation: "slide",			//String: Select your animation type, "fade" or "slide"
		easing: "swing",			// Refer to the link below  http://easings.net/
		direction: "horizontal",    //String: Select the sliding direction, "horizontal" or "vertical"
		controlNav: false,			//Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
		directionNav: true,			//Boolean: Create navigation for previous/next navigation? (true/false)
		slideshowSpeed: 6000,		//Integer: Set the speed of the slideshow cycling, in milliseconds
		animationSpeed: 600,        //Integer: Set the speed of animations, in milliseconds
		randomize: false            //Boolean: Randomize slide order
	};

	/* ---------------------------------------------------- */
	/*	Carousel											*/
	/* ---------------------------------------------------- */

	var jCarousel = {
		animation: 600,
		easing: 'easeOutCubic' // Refer to the link below  http://easings.net/
	};

	/* ---------------------------------------------------- */
	/*	Image Post Slider									*/
	/* ---------------------------------------------------- */

	var objPostSlider = {
		easing: 'easeInOutExpo', // Refer to the link below  http://easings.net/
		speed: 600,
		timeout: 5000
	};

	/* ---------------------------------------------------- */
	/*	Image Gallery Slider								*/
	/* ---------------------------------------------------- */

	var objGallerySlider = {
		easing: 'easeInOutExpo', // Refer to the link below  http://easings.net/
		speed: 600,
		timeout: 5000
	};

	/* ---------------------------------------------------- */
	/*	Testimonials										*/
	/* ---------------------------------------------------- */

	var objTestimonials  = {
		easing: 'easeInOutExpo', // Refer to the link below  http://easings.net/
		speed: 600,
		timeout: 5000
	};

	/* ---------------------------------------------------- */
	/*	Black And White										*/
	/* ---------------------------------------------------- */

	var objBlackAndWhite  = {
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
	};
	
/* ---------------------------------------------------------------------- */
/*	end Theme Settings													  */
/* ---------------------------------------------------------------------- */			
		