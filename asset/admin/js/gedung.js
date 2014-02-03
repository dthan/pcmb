function random(min, max) {
    return min + parseInt(Math.random() * (max - min + 1), 10);
}
function generatePassword(length, charset) {
    var password = "";
    while (length--) {
        password += charset[random(0, charset.length - 1)];
    }
    return password;
}
function getNewPassword() {
    $('#password').text(generatePassword(parseInt($('#len').val(), 10), "AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789!?#@*&.,;:+-=()[]_"));
}
$(document).ready(function(){
	$("#gedung").change(function() {
		//alert("prov");
		 var root = $("#root").val();
		 var gedung = $("#gedung").val();
		
		  $.ajax({
	     type: "POST",
	     url : ""+root+"data_pengawas/get_ruang",    
		 //enctype: 'multipart/form-data',
	     data: "id="+gedung+"",
		     success: function(data){ 
			// alert(data);
			 //menysipkan data ke list kota
		     document.getElementById("ruang_tes").innerHTML = data;
		  
	       }	 
	    });
	 });
	$("#edit_pengawas").submit(function() {
		//alert("hjhj");
		 var root = $("#root").val();
		 var id_pengawas = $("#id_pengawas").val();
		 $.ajax({
		 	  
	     type: "POST",
	     url : ""+root+"data_pengawas/edit_data/"+id_pengawas,    
		 //enctype: 'multipart/form-data',
	     data: $("#edit_pengawas").serialize() ,
		     success: function(data){ 

			 $("#sukses").show();
		      $.get(''+root+'data_pengawas/edit/'+id+'', function(data) {
                                  $('body').html(data);    
                              });
		  
	       }	 
	    });
		return false;
	});

	$("#pengawas").submit(function() {
		//alert("hjhj");
		 var root = $("#root").val();
		 //var id_pengawas = $("#id_pengawas").val();
		 var pass=generatePassword(7,'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789!?');
		$('#password').val(pass);
		 //alert(pass);
		 $.ajax({		 	  
		     type: "POST",
		     url : ""+root+"data_pengawas/tambah",    
			 //enctype: 'multipart/form-data',
		     data: $("#pengawas").serialize() ,
			     success: function(data){ 
		          if(data=='sukses'){
		 				$("#sukses").fadeIn(100);
			     		document.location=root+"data_pengawas";			  
		          }
		          else {
	 					$("#gagal").show();
		          }					
		       }	 
	    });
		return false;
	});

	$("#ruang_tes").submit(function() {
		//alert("hjhj");
		 var root = $("#root").val();
		 var aksi = $("#aksi").val();
		// alert(root);
		if(aksi=="tambah"){
              $.ajax({		 	  
			     type: "POST",
			     url : ""+root+"ruang_tes/tambah",    
				 //enctype: 'multipart/form-data',
			     data: $("#ruang_tes").serialize() ,
				     success: function(data){ 
			          if(data=='sukses'){
			 				$("#sukses").fadeIn(100);
				     		document.location=root+"ruang_tes";		  
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
			     url : ""+root+"ruang_tes/edit_data",    
				 //enctype: 'multipart/form-data',
			     data: $("#ruang_tes").serialize() ,
				     success: function(data){ 
			          if(data=='sukses'){
			 				$("#sukses").fadeIn(100);
				     		document.location=root+"ruang_tes";		  
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