 /*
   - general script calls
   
   -->> --------------------------
  Table of Contents:
  1 - 
  2 - 
  3 - 
  4 -  
  5 - 
  6 - 
  7 - 
  8 -     
   -->> --------------------------- */

jQuery(function($) {

  /* --->> Options radio button styling setup --------------*/
  $(".options input").uniform();

  /* ------- Top Menu - Search Box ------- */

    $('.main_nav > li').mouseenter(function(){
      if($('body').hasClass('main_nav_hover')) {
        $(this).addClass('main_nav_open');
      }      
    }).mouseleave(function() {
      if($('body').hasClass('main_nav_hover')){
        $(this).removeClass('main_nav_open');
      }      
    }); 

    function showSearcBox(){
      var $this = $(this);        
      $this.find("a").fadeOut("fast",function(){
        $this.find("div").fadeIn("fast");  
        $this.find("input").animate({          
          width: '145px'
        });
      });       
    }

    function hideSearcBox(){
      var $this = $(this);                      
      $this.find("input").animate({          
        width: '5px'
      }, 500, function() {
        $this.find("div").fadeOut("fast",function(){
          $this.find("a").fadeIn("fast");
        });           
      });      
    }

    var searchConfig = {    
     over: showSearcBox, 
     timeout: 1000, 
     out: hideSearcBox
    };

    $("#search").hoverIntent( searchConfig );

    /* --->> Sidebar widgets and menu setup --------------*/ 
    $('.nav-collapse').on('shown', function () {
      $(this).height("auto");
    })

    /* ------- Sidebar ------- */
    $(".side_nav").mCustomScrollbar();

    $(".sub > a").toggle(
      function () {

        var parent = $(this).parent("li");
        $(parent).addClass("active").find("ul:first").slideDown("easeOutQuart",function(){
          sidebarHeightCheck();          
        });

      }, 
      function () {
        var parent = $(this).parent("li");      
        $(parent).removeClass("active").find("ul:first").slideUp("easeInQuart",function(){
          sidebarHeightCheck();          
        });
        
      }
    );  

    window.onscroll = scroll;
    function scroll() {
      sidebarHeightCheck(); 

      var navbarHeight = $('.btn-navbar').parents(".navbar").delay(500).height();
      var side_nav = $(".side_nav");
      var sidebar_width = side_nav.css("width");
      var yOffset = window.pageYOffset;
      if(sidebar_width == "145px"){ 
        if(yOffset < navbarHeight+50){
          side_nav.css("z-index","-1");
        }else{
          side_nav.removeAttr("style");
        }          
      }else{      
        side_nav.removeAttr("style");
      }
    }

    /* --->> Sidebar widgets and menu setup --------------*/ 
    $('#nav_list_btn').click(function() {
      $('.nav-list').slideToggle(1000,"easeOutBounce");
    });

    $('#toggle_widget_statistic').click(function() {
      $('.widget_statistic').slideToggle(1000,"easeOutBounce");
    });

    $('#toggle_widget_info').click(function() {
      $('.widget_info').slideToggle(1000,"easeOutBounce");
    });

  /* ------- Chat modalbox ------- */      
    if (navigator.appName == "Opera")
    {
        $('#chatModal').removeClass('fade');
    }

    $(".status").hoverIntent(
      function () {
        var parent = $(this).parent("li");
        $(this).addClass("active").find("ul:first").slideDown("easeOutQuart");
      }, 
      function () {
        var $this = $(this);        
        $this.find("ul:first").slideUp("easeInQuart",function(){
          $this.removeClass("active");
        });
      }
    );

    $(".status li a").click(function (e) {
        e.preventDefault();
        var statusClass = $(this).attr("class");
        $(this).parents(".status").find("a:first").removeClass().addClass(statusClass);        
    });

  /* ------- Widget Toggle ------- */
    $("header .arrow" ).click(function(e){
      e.preventDefault();
      $(this).parents(".widget").find("section").slideToggle("fast",function(){ });   
    });

    var config = {    
     over: showHandler,   
     timeout: 100,
     sensitivity: 3,    
     out: hideHandler 
    };
      
    $(".widget header").hoverIntent( config );  
          
    function showHandler(){ $(this).find(".toggle_content").fadeIn("fast"); }      
    function hideHandler(){ $(this).find(".toggle_content").fadeOut("fast"); }

    /* ------- UI Scroll To Top Call ------- */
    $().UItoTop({ easingType: 'easeOutQuart' });    

    /* ------- Site Options ------- */
    // --> Click Event
    /* 
    $(".options_btn").toggle(
      function () {
        $(".options_btn,.options").animate({          
          left: '+=160px'
        });
      }, 
      function () {
        $(".options_btn,.options").animate({          
          left: '-=160px'
        });
      }
    ); 
    */

    // --> Hover Event
    $(".options_cont").hoverIntent(
      function (e) {
        e.preventDefault();
        $(this).animate({ left: '+=160px' });
      }, 
      function (e) {
        e.preventDefault();
        $(this).animate({ left: '-=160px' });
      }
    ); 

    /* ------- Background styling ------- */

    bg = $.jStorage.get("site_bg");
    if(bg){
      $('body').addClass(bg);
    }

    $(".background_list a").click(function(e){
      e.preventDefault();
      var current_bg_link = $(this); 

      $(".background_list a").each(function(index) {
          var links = $(this);
          links.removeClass();
          if($('body').hasClass(links.text())) {            
            $('body').removeClass(links.text());
          }           
      });
      
      link_bg_text = current_bg_link.text();
      $.jStorage.set("site_bg", link_bg_text);

      $('body').addClass(link_bg_text);
      current_bg_link.addClass("current");
    });     
    
    /* ------- Color styling ------- */
    color = $.jStorage.get("site_color");
    if(color){
      $('.style_set').attr('href',"css/theme_light_"+color+".css");      
    }
    
    $(".color_list a").click(function(e){
      e.preventDefault();
      var current_color_link = $(this);

      $(".color_list a").each(function(index) {
          var links = $(this);
          links.removeClass();         
      });

      link_color_text = current_color_link.text();
      $.jStorage.set("site_color", link_color_text);
     
      $('.style_set').attr('href',"css/theme_light_"+link_color_text+".css");
      current_color_link.addClass("current");
    }); 

    /* ------- Pattern styling ------- */
    pattern = $.jStorage.get("site_pattern");
    if(pattern){
      $('body').addClass(pattern);
    }

    $(".pattern_list a").click(function(e){
      e.preventDefault();
      var current_pattern_link = $(this); 

      $(".pattern_list a").each(function(index) {
          var links = $(this);
          links.removeClass();
          if($('body').hasClass(links.text())) {            
            $('body').removeClass(links.text());
          }           
      });
      
      link_pattern_text = current_pattern_link.text();
      $.jStorage.set("site_pattern", link_pattern_text);

      $('body').addClass(link_pattern_text);
      current_pattern_link.addClass("current");
    });

    
    /* ------- Top Menu styling ------- */
    $("#top_menu_click").click(function(e){      
      if($('body').hasClass('main_nav_hover')) {            
        $('body').removeClass('main_nav_hover');
      } 
    }); 
    
    $("#top_menu_hover").click(function(e){     
      $('body').addClass('main_nav_hover');
    }); 

    $(".clear_cache_cont .btn").click(function(e){      
        $.jStorage.flush();
        location.reload();
    }); 


    /* ------- "Titlee" span animation ------- */
    //$(".titlee span").hover
    $(".titlee span").hover(
      function () {
        $(this).fadeTo("fast","1");
      }, 
      function () {
        $(this).fadeTo("fast","0.5");
      }
    );

    /* --->> Search setup --------------*/  
    $('.search-query').typeahead({
      source:["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]
    });    
    
});

/* ------- Notification ------- */  
function showNotification(message,title){
  $.jGrowl(message, { header: title, life: 3000 });
}

/* ------- Sidebar height check ------- */ 
function sidebarHeightCheck(){

  //input.removeAttr("title")
  

  var main_content = $(".main_content > .span9");
  var main_content_height = main_content.height();

  var side_nav = $(".side_nav");
  var side_nav_height = side_nav.height();

  if(main_content_height < side_nav_height){
    $(".side_nav").addClass("affix");
  }

  var window_height = $(window).height();
  var minus_pocent = (window_height*20)/100; 
  var window_height_minus_pocent = window_height - minus_pocent;
  
  if(side_nav_height > window_height_minus_pocent){
    side_nav.addClass("side_nav_fix");
  }else{
    side_nav.removeClass("side_nav_fix");
  }

  $(".side_nav").mCustomScrollbar("update");
}

$(window).load(function() {  
  $("#loader_cont").fadeOut();
});