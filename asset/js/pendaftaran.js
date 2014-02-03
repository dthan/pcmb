


$(document).ready(function(){
    
   

$("#username").focus();	

/*-----------------------------------------
SCRIPT UNTUK SIMPAN DATA
------------------------------------------- */
$('#pendaftaran').submit(function() {
//$("#simpan").click(function(){

var id = $("#id").val();
var aksi = $("#aksi").val();
var username  = $("#username").val();
var password  = $("#password").val();
var nama  = $("#nama").val();
var nim  = $("#nim").val();
var tempat  = $("#tempat").val();
var ttl = $(".datepicker").val();
var kelas = $("#kelas").val();
var angkatan = $("#angkatan").val();
var jk  = $("input[name='jk']:checked").val();
var kaos = $("input[name='kaos']:checked").val();
var alamat  = $("#alamat").val();
var hp  = $("#hp").val();
var email  = $("#email").val();
var facebook  = $("#fb").val();
var twitter  = $("#twitter").val();
var ortu  = $("#ortu").val();
var hp_ortu  = $("#hp_ortu").val();
var penyakit  = $("#penyakit").val();
var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

var error = false;
//alert(jk);
//alert(nama_ayah+nama_ibu+th_masuk+no_telp+foto);


if(!emailReg.test(email)) {
    var error = true;
	$("#email_error").fadeOut(500);
   $("#email_tidakvalid_error").fadeIn(500);
   $("#email").focus();
 }
 
else if(email.length == ''){
   var error = true;
   $("#email_tidakvalid_error").fadeOut(500);
   $("#email_error").fadeIn(500);
   $("#email").focus();
}
else {
   $("#email_error").fadeOut(500);
    $("#email_tidakvalid_error").fadeOut(500);
}

if (username.length == ''){
   var error = true;
   $("#username_duplikasi").fadeOut(50);
   $("#username_error").fadeIn(500);
   $("#username").focus();
}
else {
   $("#username_error").fadeOut(500);
}

if(aksi=='input'){
if (password.length == ''){
   var error = true;
   $("#password_error").fadeIn(500);
   $("#password").focus();
}
else {
   $("#password_error").fadeOut(500);
}
}
if (nama.length == ''){
   var error = true;
   $("#nama_error").fadeIn(500);
   $("#nama").focus();
}
else {
   $("#nama_error").fadeOut(500);
}
if (nim.length == ''){
   var error = true;
   $("#nim_duplikasi").fadeOut(50);
   $("#nim_error").fadeIn(500);
   $("#nim").focus();
}
else {
    $("#nim").change(function() {
	  var user = $("#nim").val();
	  $.ajax({
     type: "POST",
     url : "model/check_nim.php",    
	 //enctype: 'multipart/form-data',
     data: "user="+user,
	     success: function(data){ 
	$(".loading").fadeOut(50);
     
	 // setelah ajax request sukses, 
     // cek data/teks yang dikirimkan dari file kirim_kontak.php
    if(data == 'duplikasi'){
	    var error = true;
	    $("#nim_error").fadeOut(50);
       $("#nim_duplikasi").fadeIn(50);
	}
	else {
	    $("#nim_error").fadeOut(500);
	}
}	 
 });
	});
  
}
if (tempat.length == ''){
   var error = true;
   $("#tempat_error").fadeIn(500);
   $("#tempat").focus();
}
else {
   $("#tempat_error").fadeOut(500);
}
if (ttl.length == ''){
   var error = true;
   $("#tanggal_error").fadeIn(500);
   $("#datepicker").focus();
}
else {
   $("#tanggal_error").fadeOut(500);
}
if (kelas == 0){
   var error = true;
   $("#kelas_error").fadeIn(500);
   $("#kelas").focus();
}
else {
   $("#kelas_error").fadeOut(500);
}
if (angkatan == 0){
   var error = true;
   $("#angkatan_error").fadeIn(500);
   $("#angkatan").focus();
}
else {
   $("#angkatan_error").fadeOut(500);
}
if (alamat.length == ''){
   var error = true;
   $("#alamat_error").fadeIn(500);
   $("#alamat").focus();
}
else {
   $("#alamat_error").fadeOut(500);
}
if (hp.length == ''){
   var error = true;
   $("#hp_error").fadeIn(500);
   $("#hp").focus();
}
else {
   $("#hp_error").fadeOut(500);
}

if (ortu.length == ''){
   var error = true;
   $("#ortu_error").fadeIn(500);
   $("#ortu").focus();
}
else {
   $("#ortu_error").fadeOut(500);
}
if (hp_ortu.length == ''){
   var error = true;
   $("#hp_ortu_error").fadeIn(500);
   $("#hp_ortu").focus();
}
else {
   $("#hp_ortu_error").fadeOut(500);
}

// kalau sudah tidak ada yang error (false),


if (error == false ) {
  $(".loading").fadeIn(500);
  $.ajax({
     type: "POST",
     url : "model/input_data.php",    
	 //enctype: 'multipart/form-data',
     data: "username="+username+"&password="+password+"&nama="+nama+"&nim="+nim+
	       "&tempat="+tempat+"&ttl="+ttl+"&kelas="+kelas+"&angkatan="+angkatan+"&jk="+jk+
		   "&kaos="+kaos+"&alamat="+alamat+"&hp="+hp+"&email="+email+
		    "&facebook="+facebook+"&twitter="+twitter+"&ortu="+ortu+"&hp_ortu="+hp_ortu+"&penyakit="+penyakit+
			"&id="+id+"&aksi="+aksi,
	     success: function(data){ 
	 

	 
	  $(".loading").fadeOut(50);
     
	 // setelah ajax request sukses, 
     // cek data/teks yang dikirimkan dari file kirim_kontak.php
    if(data == 'berhasil'){
       $(".valid_box").fadeIn(50);
		
    }else{
	  if(aksi=='edit'){
	    $(".valid_box2").fadeIn(50);
		document.location="./profil";
	  }
	  else {
	  $("#form_daftar").fadeOut(50);
	  $("#judul_form").fadeOut(50);
	   $(".valid_box").fadeIn(50);
	 
     }
	 }
	  $("#pendaftaran").reset();
  }	 
     
   }); 
 
 }
return false;                      

});
 

 $("#nim").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
              
				event.preventDefault(); 
				
            }   
        }
    });
	
	 $("#hp").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
              
				event.preventDefault(); 
				
            }   
        }
    });
	
		
	 $("#hp_ortu").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
              
				event.preventDefault(); 
				
            }   
        }
    });
	$("#username").change(function() {
	  var user = $("#username").val();
	  $.ajax({
     type: "POST",
     url : "model/check_data.php",    
	 //enctype: 'multipart/form-data',
     data: "user="+user,
	     success: function(data){ 
	$(".loading").fadeOut(50);

    if(data == 'duplikasi'){
	    $("#username").val('');
		
	    $("#username_error").fadeOut(50);
       $("#username_duplikasi").fadeIn(50);
	}
	else {
	    $("#username_error").fadeOut(50);
       $("#username_duplikasi").fadeOut(50);
	}
}	 
 });
	});
	
		$("#nim").change(function() {
	  var user = $("#nim").val();
	  $.ajax({
     type: "POST",
     url : "model/check_nim.php",    
	 //enctype: 'multipart/form-data',
     data: "user="+user,
	     success: function(data){ 
	$(".loading").fadeOut(50);
     
	 // setelah ajax request sukses, 
     // cek data/teks yang dikirimkan dari file kirim_kontak.php
    if(data == 'duplikasi'){
	    $("#nim").val('');
	    $("#nim_error").fadeOut(50);
       $("#nim_duplikasi").fadeIn(50);
	}
	else {
	   $("#nim_error").fadeOut(50);
       $("#nim_duplikasi").fadeOut(50);
	   
	}
}	 
 });
	});

		
});







 
 