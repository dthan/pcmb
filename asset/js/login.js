$(document).ready(function(){
  $("#username").focus();
 
  $('#daftar').submit(function() {
     var username = $("#username").val();
    //alert(username);
      $.ajax({         

         type: $(this).attr("method"),
         url : $(this).attr("action"),    
    	   data: $(this).serialize(),               
         success: function(data){      	    
         $(".loading").fadeOut(500);
        if(data == 'sukses'){
          //alert("login sukses");
          $(".error").fadeOut(100);
          $(".success").fadeIn(100);
          document.location="daftar/formulir/"+username;
    	    //alert("sukses");
    		
         }
        else{
           $(".error2").fadeIn(1000);
           //$(".error").fadeOut(20000);
           }     
         }  
       }); 
     
     
    return false;                      

    });



});
