 <script src="<?php echo base_url(); ?>asset/js/peserta.js"></script>
  <div class="pagetitle">
      <h1>Peserta</h1> <span>data peserta yang telah daftar pcmb</span>
        </div><!--pagetitle-->
        <div class="maincontent">
        	<div class="contentinner">
           <center id="loading" style="display:none"><img src="<?php echo base_url()."asset/img/loaders/ajax-loader.gif"; ?>"/>loading</center>   
            <div id="tabel" class="animate1 bounceInUp">
                    <?php
                    echo $js_grid;
                    ?>
                    <script type="text/javascript">
               
                    function test(com,grid) {                        
                        if (com=='Hapus') {
                           var items= jQuery('.trSelected',grid);
                           
                               var id  = items[0].id.substr(3);
                           document.location="./edit_pesertaxx/"+id;                            
                        }                        
                        if (com=='Unselect') {
                            $('.bDiv tbody tr',grid).removeClass('trSelected');
                        }
                        if (com=='Refresh'){
                            window.location = "<?php echo base_url()."peserta"  ;?>";
                        }                        
                        if (com=='Edit') {
                             var items= jQuery('.trSelected',grid);                           
                               var id  = items[0].id.substr(3);
                                 /* $.ajax({
                                     type: "POST",
                                     url : "data_peserta/"+id, 
                                     dataType: "json",   
                                   //enctype: 'multipart/form-data',
                                     data: "id="+id,
                                      success: function(data) {
                                          $.each(data.peserta, function(i, item) {
                                               var nama=item.nama;
                                               var tempat=item.tempat_lahir;
                                               $("#nama").val(nama);
                                               $("#tempat").val(tempat);
                                           });
                                        }                                       
                                   });*/                               
                               // jQuery(".widget").fadeIn(2000);
                               /* jQuery('#tabel').each(function(){
                                    jQuery(this).addClass('animate1 fadeOutDownBig');
                                    jQuery(this).on('animationend', function(e) {
                                        jQuery(this).removeAttr('class');
                                    });
                                 });*/
                                // document.location="./edit_peserta/"+id;                               
                             // $('#loading').show('slow');
                               $.get('./peserta/edit_peserta/'+id+'', function(data) {
                                  $('body').html(data);    
                              });             
                       }          
                    }
                    </script>                    
                    <table id="flex1" style="display:none;font-size:11px"></table>
                    </div>                 
              </div><!--contentinner-->
        </div><!--maincontent-->
      </div><!--mainright-->    
      <!-- END OF RIGHT PANEL -->    
    <div class="clearfix"></div>
    
    
