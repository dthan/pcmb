
function report(id){
     // alert(id);
      var root=jQuery('#root').val();
      //alert(root);
      jQuery('#report-'+id).fadeOut(100);
      jQuery('#span-'+id).fadeOut(100);
      jQuery('#loading-'+id).fadeIn(100);
      jQuery('#sedang-'+id).fadeIn(100);
      
      if(id=='1'){
        var report="gedung";
      }
            jQuery.ajax({
             type: "POST",
             url : ""+root+"report/"+report,    
             data: "no_pes=1",
               success: function(data){ 
               /* jQuery('#loading-'+id).fadeOut(100);
                jQuery('#sedang-'+id).fadeOut(100);
                jQuery('#span-'+id).fadeIn(100);
                jQuery('#report-'+id).fadeIn(100);*/
                alert(data);
              }
             });
            //alert("ter ceklist");
       // return false;
          
 }

jQuery(document).ready(function(){
/*   jQuery("#seleksi").click(function(){
         alert("seleksi");
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
   });	*/
  //alert("type");

      
                                  
});