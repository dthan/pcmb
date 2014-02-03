
$(document).ready(function(){
	
    //alert('seta');
	$("#kelulusan").submit(function() {
		//alert("hjhj");
		 $("#loading").fadeIn(100);
		 var root = $("#root").val();
		 var no_pes = $("#no_pes").val();
		// alert(root);
		 $.ajax({
		 	  
	     type: "POST",
	     url : ""+root+"kelulusan/cek_kelulusan",   
	     data: "no_pes="+no_pes,
		 //enctype: 'multipart/form-data',
	     success: function(data){ 
	     	$("#loading").fadeOut(100);
	     	 $("#info_kelulusan").fadeIn(100);
	         document.getElementById("info_kelulusan").innerHTML = data;
	       }	 
	    }); 
		return false;
	});
});