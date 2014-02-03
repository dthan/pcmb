
$(document).ready(function(){
	
	$("#upload_xlsc").submit(function() {
		
		 var root = $("#root").val();
		 //alert(root);
		/*  $.ajax({		 	  
		     type: "POST",
		     url : ""+root+"hasil_tes/do_upload",    
			 enctype: 'multipart/form-data',
		     data: $("#upload_xls").serialize() ,
			 success: function(data){ 
			     	alert(data);
			     	//document.location=""+root+"hasil_tes";
		            /* $("#sukses").fadeIn(100);
					 $("#kode_sekolah").val('');
					 $("#nama_sekolah").val('');
					 $("#sukses").fadeOut(3000);
		  		  
	         }	 
	       });*/


		  var data = new FormData();

		data.append('image',document.getElementById('file_upload').files[0]);
		data.append('tag','upload_xls');
		data.append('data',$('#upload_xls').serializeArray());

		$.ajax({
		    url : ""+root+"hasil_tes/do_upload", 
		    type: 'post',
		    data: data,
		    cache: false,
		    contentType:false,
		    dataType: 'json',
		    processData: false,
		    success: function (data) {
		        alert(data);
		    
		    }
		});
	       return false;
	    });
		
	/* });
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
		      $.get(''+root+'data_pengawas/edit/'+id+'', function(data) {
                                  $('body').html(data);    
                              });
		  
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
		    $.get(''+root+'data_pengawas/edit/'+id+'', function(data) {
                                  $('body').html(data);    
                              });
		  
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
*/
	
});