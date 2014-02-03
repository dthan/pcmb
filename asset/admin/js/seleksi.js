
function set_lulus(id,no,uj){
/*  jQuery.get('http://localhost/pcmb/seleksi/jurusan/'+id+'', function(data) {
                                  $('body').html(data);    
                              });*/
   var kode = jQuery('#kode_jurusan').val();
   if(uj==1){
     var ujian="pilihan1";
     var pilihan="pil_1";
   }
   else if(uj==2){
     var ujian="pilihan2";
     var pilihan="pil_2";
   }
  
    if (jQuery('#'+ujian+'-'+no).is(':checked')) {
             var root = jQuery("#root").val();
             var no_pes = jQuery("#"+ujian+"-"+no).val();
             
            jQuery.ajax({
                 type: "POST",
                 url : ""+root+"seleksi/set_lulus",    
                 data: "no_pes="+id+"&jur="+kode+"&pilihan="+pilihan,
                   success: function(data){ 
                   //alert(data);
                 //menysipkan data ke list kota
                 //alert(data);
                   if(data=="sukses"){
                      document.getElementById("lulus_"+uj+"-"+no).innerHTML = "Lulus";
                   }
                   else{
                      alert(data);
                   }
                   
                     jQuery.ajax({
                     type: "POST",
                     url : ""+root+"seleksi/get_terisi",    
                     data: "no_pes="+id+"&jur="+kode+"&pilihan="+pilihan,
                       success: function(data){                 
                           //alert(data);
                          document.getElementById("terisi").innerHTML = data;                             
                       }   
             });
                
                   }   
             });


          
            //alert("ter ceklist");
          }
          else {
             var root = jQuery("#root").val();
             var no_pes = jQuery("#"+ujian+"-"+no).val();
             jQuery.ajax({
             type: "POST",
             url : ""+root+"seleksi/set_tidak_lulus",  
             data: "no_pes="+id+"&jur="+kode+"&pilihan="+pilihan,
               success: function(data){ 
             //alert(data);
             //menysipkan data ke list kota
               document.getElementById("lulus_"+uj+"-"+no).innerHTML = "Tidak Lulus";
               jQuery.ajax({
                 type: "POST",
                 url : ""+root+"seleksi/get_terisi",    
                 data: "no_pes="+id+"&jur="+kode+"&pilihan="+pilihan,
                   success: function(data){   
                      //alert(data);              
                      document.getElementById("terisi").innerHTML = data;                             
                   }   
                });        
            
               }   
             });  


              
            //alert("hente ter ceklist");   
         }
 //alert(kode);
 }

jQuery(document).ready(function(){
   jQuery("#seleksi").click(function(){
         /*alert("seleksi");*/
  	     jQuery("#loading").fadeIn(100);
  	     var root = jQuery("#root").val();
  	     //alert(root);
         jQuery.ajax({
			   type: "POST",
			   url : ""+root+"seleksi/do_seleksi",    
			   data: "id=seleksi",
			   success: function(data){ 						 
					  alert(data);
					  jQuery("#loading").fadeOut(100);
               }	 
		 });
   });	


      
                                  
});