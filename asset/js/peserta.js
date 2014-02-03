


$(document).ready(function(){
	$("#provinsi").change(function() {
		//alert("prov");
		 var root = $("#root").val();
		 var prov = $("#provinsi").val();
		
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

		$("#provinsi_ortu").change(function() {
		//alert("prov");
		 var root = $("#root").val();
		 var prov = $("#provinsi_ortu").val();
		
		  $.ajax({
	     type: "POST",
	     url : ""+root+"daftar/get_kota",    
		 //enctype: 'multipart/form-data',
	     data: "id="+prov+"",
		     success: function(data){ 
			 //menysipkan data ke list kota
		     document.getElementById("kota_ortu").innerHTML = data;
		 
	     }	 
	 });
	 });

			$("#provinsi_sekolah").change(function() {
		//alert("prov");
		 var root = $("#root").val();
		 var prov = $("#provinsi_sekolah").val();
		
		  $.ajax({
	     type: "POST",
	     url : ""+root+"daftar/get_kota",    
		 //enctype: 'multipart/form-data',
	     data: "id="+prov+"",
		     success: function(data){ 
			 //menysipkan data ke list kota
		     document.getElementById("kota_sekolah").innerHTML = data;
		    //alert(data);
		 
	     }	 
	 });
	 });

		$("#kota_sekolah").change(function() {
		//alert("prov");
		 var root = $("#root").val();
		 var sekolah = $("#kota_sekolah").val();
		
		  $.ajax({
	     type: "POST",
	     url : ""+root+"daftar/get_sekolah",    
		 //enctype: 'multipart/form-data',
	     data: "id="+sekolah+"",
		     success: function(data){ 
			 //menysipkan data ke list kota
		     document.getElementById("nama_sekolah").innerHTML = data;
		     //alert(sekolah);
	     }	 
	 });
	 });

	$("#fak1").change(function() {
		
		 var root = $("#root").val();
		 var fak = $("#fak1").val();
		//alert("prov");
		  $.ajax({
	     type: "POST",
	     url : ""+root+"daftar/get_jur",    
		 //enctype: 'multipart/form-data',
	     data: "id="+fak+"",
		     success: function(data){ 
			 //menysipkan data ke list jurusan
		     document.getElementById("pil_1").innerHTML = data;
		    
	     }	 
	 });
	 });

		$("#fak2").change(function() {
		
		 var root = $("#root").val();
		 var fak = $("#fak2").val();
		//alert("prov");
		  $.ajax({
	     type: "POST",
	     url : ""+root+"daftar/get_jur",    
		 //enctype: 'multipart/form-data',
	     data: "id="+fak+"",
		     success: function(data){ 
			 //menysipkan data ke list jurusan
		     document.getElementById("pil_2").innerHTML = data;
		    
	     }	 
	 });
	 });
	 

 
});







 
 