/* 
   - forms_wizard.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - Prettify setup	
   -->> --------------------------- */
   
jQuery(function($) { 

  

	/* --->> 1 - Prettify setup --------------*/	
	// Smart Wizard  
  var posisi=$("#posisi").val();  
   if(posisi=='admin'){
      $('#wizard').smartWizard({transitionEffect:'slideleft',onLeaveStep:leaveAStepCallback,onFinish:onFinishCallback,enableFinishButton:true});
   }
   else{
      $('#wizard').smartWizard({transitionEffect:'slideleft',onLeaveStep:leaveAStepCallback,onFinish:onFinishCallback,enableFinishButton:false});
   }	
	

  function leaveAStepCallback(obj){
    var step_num= obj.attr('rel');
    return validateSteps(step_num);
  }
  
  function onFinishCallback(){
   if(validateAllSteps()){
    //$('#form_daftar').submit();
    //alert("test");
    var  root=$("#root").val();
    var posisi=$("#posisi").val();
    var no_pes=$("#no_pes").val();
    if(posisi=='admin'){
      $('#form_daftar').attr('action',root+'peserta/update_data_peserta/'+no_pes).submit();
    }
    else {
      $('#form_daftar').attr('action',root+'daftar/input_data').submit();  
    }
    
    //alert(root);
   }
  }

});

function validateAllSteps(){
   var isStepValid = true;
   
   if(validateStep1() == false){
     isStepValid = false;
     $('#wizard').smartWizard('setError',{stepnum:1,iserror:true});         
   }else{
     $('#wizard').smartWizard('setError',{stepnum:1,iserror:false});
   }

     if(validateStep2() == false){
     isStepValid = false;
     $('#wizard').smartWizard('setError',{stepnum:2,iserror:true});         
   }else{
     $('#wizard').smartWizard('setError',{stepnum:2,iserror:false});
   }
   
   if(validateStep3() == false){
     isStepValid = false;
     $('#wizard').smartWizard('setError',{stepnum:3,iserror:true});         
   }else{
     $('#wizard').smartWizard('setError',{stepnum:3,iserror:false});
   }
   
   if(!isStepValid){
      $('#wizard').smartWizard('showMessage','Silahkan Lengkapi form yang harus di isi');
   }
          
   return isStepValid;
} 	


function validateSteps(step){
  var isStepValid = true;
  // validate step 1
  if(step == 1){
    if(validateStep1() == false ){
      isStepValid = false; 
      $('#wizard').smartWizard('showMessage','Silahkan Lengkapi form yang harus di isi di step '+step+ ' ini');
      $('#wizard').smartWizard('setError',{stepnum:step,iserror:true});         
    }else{
      $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
    }
  }
  // validate step 2
    if(step == 2){
    if(validateStep2() == false ){
      isStepValid = false; 
      $('#wizard').smartWizard('showMessage','Silahkan Lengkapi form yang harus di isi di step '+step+ ' ini');
      $('#wizard').smartWizard('setError',{stepnum:step,iserror:true});         
    }else{
      $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
    }
  }
  
  // validate step3
  if(step == 3){
    if(validateStep3() == false ){
      isStepValid = false; 
      $('#wizard').smartWizard('showMessage','Silahkan Lengkapi form yang harus di isi di step '+step+ ' ini');
      $('#wizard').smartWizard('setError',{stepnum:step,iserror:true});         
    }else{
      $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
    }
  }
  
  return isStepValid;
}

function validateStep1(){
   var isValid = true; 
   // Validate nama
   var un = $('#nama').val();
   if(!un && un.length <= 0){
     isValid = false;
     $('#nama').css('border','1px solid red');
   }else{
     $('#nama').css('border','transparent');
   }
    // Validate tempat
   var un = $('#tempat').val();
   if(!un && un.length <= 0){
     isValid = false;
    $('#tempat').css('border','1px solid red');
   }else{
    $('#tempat').css('border','transparent');
   }
     // Validate tanggal
   var un = $('#tanggal').val();
   if(!un && un.length <= 0){
     isValid = false;
    $('#tanggal').css('border','1px solid red');
   }else{
    $('#tanggal').css('border','transparent');
   }
      // Validate alamat
   var un = $('textarea#alamat').val();
   if(!un && un.length <= 0){
     isValid = false;
    $('#alamat').css('border','1px solid red');
   }else{
    $('#alamat').css('border','transparent');
   }

    var un = $('#no_hp').val();
   if(!un && un.length <= 0){
     isValid = false;
    $('#no_hp').css('border','1px solid red');
   }else{
    $('#no_hp').css('border','transparent');
   }

       var un = $('#provinsi').val();
   if(!un && un.length <= 0){
     isValid = false;
   
   }else{
    //alert('provinsi belum dipilih');
     $('#prov_error').fadeIn(100);
     $('#prov_error').fadeOut(20000);
   }

     var un = $('#kota').val();
   if(!un && un.length <= 0){
     isValid = false;
   
   }else{
    //alert('provinsi belum dipilih');
     $('#kota_error').fadeIn(100);
     $('#kota_error').fadeOut(20000);
   }
   //var message = $('textarea#message').val();
   

   return isValid;
}

function validateStep2(){
  var isValid = true;    
  //validate email  email
   var un = $('#nama_sekolah').val();
   if(!un && un.length <= 0){
     isValid = false;
    $('#nama_sekolah').css('border','1px solid red');
   }else{
    $('#nama_sekolah').css('border','transparent');
   }

     var un = $('#jenis_sekolah').val();
   if(!un && un.length <= 0){
     isValid = false;
    $('#jenis_sekolah').css('border','1px solid red');
   }else{
    $('#jenis_sekolah').css('border','transparent');
   }

    var un = $('textarea#alamat_sekolah').val();
   if(!un && un.length <= 0){
     isValid = false;
    $('#alamat_sekolah').css('border','1px solid red');
   }else{
    $('#alamat_sekolah').css('border','transparent');
   }

    var un = $('#nilai_ijazah').val();
   if(!un && un.length <= 0){
     isValid = false;
    $('#nilai_ijazah').css('border','1px solid red');
   }else{
    $('#nilai_ijazah').css('border','transparent');
   }
  return isValid;
}

function validateStep3(){
  var isValid = true;    
  //validate email  email
  var un = $('#ayah').val();
   if(!un && un.length <= 0){
     isValid = false;
    $('#ayah').css('border','1px solid red');
   }else{
    $('#ayah').css('border','transparent');
   } 

  var un = $('#kota_ortu').val();
   if(!un && un.length <= 0){
     isValid = false;
    $('#kota_ortu').css('border','1px solid red');
   }else{
    $('#kota_ortu').css('border','transparent');
   }

    var un = $('#ibu').val();
   if(!un && un.length <= 0){
     isValid = false;
    $('#ibu').css('border','1px solid red');
   }else{
    $('#ibu').css('border','transparent');
   } 

   var un = $('textarea#alamat_ortu').val();
   if(!un && un.length <= 0){
     isValid = false;
    $('#alamat_ortu').css('border','1px solid red');
   }else{
    $('#alamat_ortu').css('border','transparent');
   }

    var un = $('#telp_ayah').val();
   if(!un && un.length <= 0){
     isValid = false;
    $('#telp_ayah').css('border','1px solid red');
   }else{
    $('#telp_ayah').css('border','transparent');
   } 

   var un = $('#telp_ibu').val();
   if(!un && un.length <= 0){
     isValid = false;
    $('#telp_ibu').css('border','1px solid red');
   }else{
    $('#telp_ibu').css('border','transparent');
   } 

   var un = $('#kode_post_ortu').val();
   if(!un && un.length <= 0){
     isValid = false;
    $('#kode_post_ortu').css('border','1px solid red');
   }else{
    $('#kode_post_ortu').css('border','transparent');
   } 


  return isValid;
}



// Email Validation
function isValidEmailAddress(emailAddress) {
  var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
  return pattern.test(emailAddress);
} 

$(document).ready(function () {
    $('input[type="checkbox"][name="samakan"]').change(function() {
       if ($('#samakan').is(':checked')) {
          var alamat = $('textarea#alamat').val();
          $("textarea#alamat_ortu").val(alamat);
        }
        else {
          $("textarea#alamat_ortu").val('');
        }
        
    });
  });

