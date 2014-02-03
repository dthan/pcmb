$(document).ready(function () {
	$("#edit1").click(function(){
      //alert("test");
      
      $("#tab_1").hide();
      
      $("#data").slideToggle("slow").siblings("#data").slideUp("slow");
	});
});