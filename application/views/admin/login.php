<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Admin PCMB</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/css/style.default.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery-migrate-1.1.1.min.js"></script>
</head>

<body class="loginbody">

<div class="loginwrapper">
	<div class="loginwrap zindex100 animate2 bounceInDown">
	<h1 class="logintitle"><span class="iconfa-lock"></span> Login<span class="subtitle">Silahkan Login</span></h1>
        <div class="loginwrapperinner">
            <form id="loginform" action="<?php echo base_url()."admin"; ?>" method="post">
                <p class="animate4 bounceIn"><input type="text" id="username" name="username" placeholder="Username" />
                <input type="hidden" id="root" name="root" value="<?php echo base_url();?>" /></p>
                <p class="animate5 bounceIn"><input type="password" id="password" name="password" placeholder="Password" /></p>
                <p class="animate6 bounceIn"><button class="btn btn-default btn-block">Submit</button></p>
                
            </form>
        </div><!--loginwrapperinner-->
    </div>
    <div class="loginshadow animate3 fadeInUp"></div>
</div><!--loginwrapper-->

<script type="text/javascript">
jQuery.noConflict();

jQuery(document).ready(function(){
	
	var anievent = (jQuery.browser.webkit)? 'webkitAnimationEnd' : 'animationend';
	jQuery('.loginwrap').bind(anievent,function(){
		jQuery(this).removeClass('animate2 bounceInDown');
	});
	
	jQuery('#username,#password').focus(function(){
		if(jQuery(this).hasClass('error')) jQuery(this).removeClass('error');
	});
	
	jQuery('#loginform button').click(function(){
		if(!jQuery.browser.msie) {
			if(jQuery('#username').val() == '' || jQuery('#password').val() == '') {
				if(jQuery('#username').val() == '') jQuery('#username').addClass('error'); else jQuery('#username').removeClass('error');
				if(jQuery('#password').val() == '') jQuery('#password').addClass('error'); else jQuery('#password').removeClass('error');
				jQuery('.loginwrap').addClass('animate0 wobble').bind(anievent,function(){
					jQuery(this).removeClass('animate0 wobble');
				});
			} else {
                      var root =jQuery("#root").val();
					   jQuery.ajax({        

					         type: jQuery('#loginform').attr("method"),
					         url : ""+root+'admin/cek_login',    
					    	 data: jQuery('#loginform').serialize(),               
					         success: function(data){      	    
					         //jQuery(".loading").fadeOut(500);
					        if(data == 'sukses'){
					           jQuery('.loginwrapper').addClass('animate0 fadeOutUp').bind(anievent,function(){
									jQuery('#loginform').submit();
								});	
					    		
					         }
					        else{
					              jQuery('.loginwrap').addClass('animate0 wobble').bind(anievent,function(){
										//jQuery(this).removeClass('animate0 wobble');
									});
					       	  }     
					         }  
					       }); 
         	}
			return false;
		}
	});
});
</script>
</body>
</html>
