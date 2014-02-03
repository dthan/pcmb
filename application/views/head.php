<!DOCTYPE html>
<!--[if IE 7]>					<html class="ie7 no-js" lang="en">     <![endif]-->
<!--[if lte IE 8]>              <html class="ie8 no-js" lang="en">     <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="not-ie no-js" lang="en">  <!--<![endif]-->
<head>
	<!-- Google Web Fonts
  ================================================== -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,600italic|Handlee' rel='stylesheet' type='text/css'>
	
	<!-- Basic Page Needs
  ================================================== -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--[if ie]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
	
	<title><?php echo $title; ?></title>	
	
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>asset/images/uin.ico" />

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- CSS
  ================================================== -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/style.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/skeleton.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/layout.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/font-awesome.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/theme_light.css" />
	
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/js/layerslider/css/layerslider.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/js/fancybox/jquery.fancybox.css" />
	<script src="<?php echo base_url(); ?>asset/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/js/jquery.easing.1.3.min.js"></script>
	
	<!-- HTML5 Shiv
	================================================== -->
	
	<script src="<?php echo base_url(); ?>asset/js/jquery.modernizr.js"></script>
    
    <script type="text/javascript">
		$(document).ready(function() {
			
			$(".various2").fancybox();

			
		});
	</script>
		<script type="text/javascript" src="<?php echo base_url(); ?>asset/datepicker/ui.core.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/datepicker/ui.datepicker.js"></script>
	<link type="text/css" href="<?php echo base_url(); ?>asset/datepicker/ui.core.css" rel="stylesheet" />
	<link type="text/css" href="<?php echo base_url(); ?>asset/datepicker/ui.resizable.css" rel="stylesheet" />
	<link type="text/css" href="<?php echo base_url(); ?>asset/datepicker/ui.accordion.css" rel="stylesheet" />
	<link type="text/css" href="<?php echo base_url(); ?>asset/datepicker/ui.dialog.css" rel="stylesheet" />
	<link type="text/css" href="<?php echo base_url(); ?>asset/datepicker/ui.slider.css" rel="stylesheet" />
	<link type="text/css" href="<?php echo base_url(); ?>asset/datepicker/ui.tabs.css" rel="stylesheet" />
	<link type="text/css" href="<?php echo base_url(); ?>asset/datepicker/ui.datepicker.css" rel="stylesheet" />
	<link type="text/css" href="<?php echo base_url(); ?>asset/datepicker/ui.progressbar.css" rel="stylesheet" />
	<link type="text/css" href="<?php echo base_url(); ?>asset/datepicker/ui.theme.css" rel="stylesheet" />

	<script type="text/javascript">
	
	$(function() {
		$('.datepicker').datepicker({
		      changeMonth: true,
		      changeYear: true
	        });
	});
	</script>
</head>
