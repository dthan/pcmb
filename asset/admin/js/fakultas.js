
$(document).ready(function(){


	$("#fakultas").submit(function() {
		//alert("hjhj");
		 var root = $("#root").val();
		 var aksi = $("#aksi").val();
		//alert(aksi);
		if(aksi=="tambah"){
              $.ajax({		 	  
			     type: "POST",
			     url : ""+root+"fakultas/tambah",    
				 //enctype: 'multipart/form-data',
			     data: $("#fakultas").serialize() ,
				     success: function(data){ 
			          if(data=='sukses'){
			 				$("#sukses").fadeIn(100);
				     		document.location=root+"fakultas";		  
			          }
			          else {
		 					$("#gagal").fadeIn(100);
			          }				
		       }	 
		    }); 
		}
		else {
            $.ajax({		 	  
			     type: "POST",
			     url : ""+root+"fakultas/edit_data",    
				 //enctype: 'multipart/form-data',
			     data: $("#fakultas").serialize() ,
				     success: function(data){ 
			          if(data=='sukses'){
			 				$("#sukses").fadeIn(100);
				     		document.location=root+"fakultas";		  
			          }
			          else {
			          	   alert(data);
		 					//$("#gagal").fadeIn(100);
			          }				
		       }	 
		    }); 
		}			 
		return false;
	});
});