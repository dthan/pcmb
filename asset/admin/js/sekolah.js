
$(document).ready(function(){
	$("#kode_sekolah").change(function() {
		//alert("prov");
		 var root = $("#root").val();
		 var kode_sekolah = $("#kode_sekolah").val();
	
		  $.ajax({
	     type: "POST",
	     url : ""+root+"sekolah/cek_kode_sekolah",    
		 //enctype: 'multipart/form-data',
	     data: "kode="+kode_sekolah+"",
		     success: function(data){ 
			//alert(data);
			if(data=='sudah'){
                $("#kode_sekolah").val('');
                $("#kode_error").show();
			}
			else{
				$("#kode_error").hide();
			}
			
			 //menysipkan data ke list kota
		     //document.getElementById("ruang_tes").innerHTML = data;
		  
	       }	 
	    });
		
	 });
	$("#input_sekolah").submit(function() {
		//alert("hjhj");
		 var root = $("#root").val();
		// var id_pengawas = $("#id_pengawas").val();
		 $.ajax({
		 	  
	     type: "POST",
	     url : ""+root+"sekolah/tambah",    
		 //enctype: 'multipart/form-data',
	     data: $("#input_sekolah").serialize() ,
		     success: function(data){ 
             $("#sukses").fadeIn(100);
			 $("#kode_sekolah").val('');
			 $("#nama_sekolah").val('');
			 $("#sukses").fadeOut(3000);
		    /*  $.get(''+root+'data_pengawas/edit/'+id+'', function(data) {
                                  $('body').html(data);    
                              });*/
		  
	       }	 
	    });
		return false;
	});

		$("#edit_sekolah").submit(function() {
		
		var kode_sekolah = $("#kode_sekolah").val();
		 var root = $("#root").val();
		//var id_pengawas = $("#id_pengawas").val();
		 $.ajax({
		 	  
	     type: "POST",
	     url : ""+root+"sekolah/edit_data/"+kode_sekolah,    
		 //enctype: 'multipart/form-data',
	     data: $("#edit_sekolah").serialize() ,
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


	$("#propinsi").change(function() {
		//alert("prov");
		 var root = $("#root").val();
		 var prov = $("#propinsi").val();
		 //alert('prov');
		  $.ajax({
	     type: "POST",
	     url : ""+root+"daftar/get_kota2",    
		 //enctype: 'multipart/form-data',
	     data: "id="+prov+"",
		     success: function(data){ 
		     	
			 //menysipkan data ke list kota
		     document.getElementById("kota").innerHTML = data;
		 
	       }	 
	    });

	 });

	
});