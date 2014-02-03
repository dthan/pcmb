<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>PCMB Admin</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/css/style.default.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/prettify/prettify.css" type="text/css" />
<link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>asset/images/uin.ico" />
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/prettify/prettify.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/custom.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/prettify/prettify.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.flot.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.flot.resize.min.js"></script>
<?php
if($posisi!='seleksi'){
	?>
	<link href="<?php echo base_url();?>asset/flexigrid/css/flexigrid.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/theme_light.css" />
	<script type="text/javascript" src="<?php echo base_url();?>asset/flexigrid/js/jquery1.5.0.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>asset/flexigrid/js/flexigrid.pack.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/plugins/formswizard/jquery.smartWizard-admin.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/specific/forms_wizard.js"></script>
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
	<?php
}
?>
	<script type="text/javascript">	
	$(function() {
		$('.datepicker').datepicker({
		      changeMonth: true,
		      changeYear: true
	        });
	});
	</script>
</head>