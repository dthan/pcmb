
$(document).ready(function(){
	$("#kode_jurusan").change(function() {
		//alert("prov");
		 var root = $("#root").val();
		 var kode_jurusan = $("#kode_jurusan").val();
		 var kode_sekarang = $("#kode_sekarang").val();
		if(kode_jurusan==kode_sekarang){
			$("#kode_error").hide();
		}
		else{

		
		  $.ajax({
	     type: "POST",
	     url : ""+root+"jurusan/cek_kode_jurusan",    
		 //enctype: 'multipart/form-data',
	     data: "kode="+kode_jurusan+"",
		     success: function(data){ 
			//alert(data);
			if(data=='sudah'){
                $("#kode_jurusan").val('');
                $("#kode_error").show();
			}
			else{
				$("#kode_error").hide();
			}
			
			 //menysipkan data ke list kota
		     //document.getElementById("ruang_tes").innerHTML = data;
		  
	       }	 
	    });
		}
	 });
	$("#input_jurusan").submit(function() {
		//alert("hjhj");
		 var root = $("#root").val();
		// var id_pengawas = $("#id_pengawas").val();
		 $.ajax({
		 	  
	     type: "POST",
	     url : ""+root+"jurusan/tambah",    
		 //enctype: 'multipart/form-data',
	     data: $("#input_jurusan").serialize() ,
		     success: function(data){ 
             $("#sukses").fadeIn(100);
			 $("#kode_jurusan").val('');
			 $("#nama_jurusan").val('');
			 $("#sukses").fadeOut(3000);
		    /*  $.get(''+root+'data_pengawas/edit/'+id+'', function(data) {
                                  $('body').html(data);    
                              });*/
		  
	       }	 
	    });
		return false;
	});

		$("#edit_jurusan").submit(function() {
		
		var kode_jurusan = $("#kode_jurusan").val();
		 var root = $("#root").val();
		//var id_pengawas = $("#id_pengawas").val();
		 $.ajax({
		 	  
	     type: "POST",
	     url : ""+root+"jurusan/edit_data/"+kode_jurusan,    
		 //enctype: 'multipart/form-data',
	     data: $("#edit_jurusan").serialize() ,
		     success: function(data){ 
             $("#sukses").fadeIn(100);
			 $("#sukses").fadeOut(3000);
		    /* $.get(''+root+'data_pengawas/edit/'+id+'', function(data) {
                                  $('body').html(data);    
                              });*/
		  
	       }	 
	    });
		return false;
	});

	
});