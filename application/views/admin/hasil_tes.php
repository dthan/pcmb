
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>asset/admin/js/hasil_tes.js"></script>
  <div class="pagetitle">
            <h1>Hasil Tes</h1> 
        </div><!--pagetitle-->

        <div class="maincontent">
          <div class="contentinner">
            <div class="widgetcontent bordered shadowed nopadding" >
              <center>
                 <form id="upload_xls" class="stdform stdform2" method="post" action="<?php echo base_url(); ?>hasil_tes/do_upload" enctype= "multipart/form-data">
                      <div class="control-group">
                         <p>
                                <label>Import data nilai</label>
                                <input type="hidden" name="root" id="root" value="<?php echo base_url(); ?>" />
                                <span class="field"> <a href="<?php echo base_url(); ?>upload/contoh_format_upload_nilai.xls">download contoh format xls upload</a><br/><input required="" type="file" name="userfile" id="file_upload" class="input-large" /> <button class="btn btn-primary">upload</button></span>
                                
                          </p>
                          <p>
                           
                          </p>
                       
                        </div>
                       
                    </form>
             </center>  
             <?php
             if((isset($hasil)) && ($hasil=="sukses")){
             ?>
            <div class="alert alert-success" id="sukses">
                              <button data-dismiss="alert" class="close" type="button">×</button>
                              <strong>IMPORT DATA SUKSES</strong> 
                  </div><!--alert-->
              <?php
               }
               if((isset($hasil)) && ($hasil=="gagal")){
               ?>
                  <div id="gagal" class="alert alert-error" >
                              <button data-dismiss="alert" class="close" type="button">×</button>
                              <strong>IMPORT DATA GAGAL</strong> .
                  </div><!--alert-->
                  <?php
                }
                  ?>
            <div id="tabel" class="animate1 bounceInUp">
                    <?php
                    echo $js_grid;
                    ?>
                    <script type="text/javascript">
               
                    function test(com,grid) {
                        if (com=='Tambah') {
                           jQuery("#tabel").fadeOut(100);
                           jQuery("#tambah").show();
                           
                            
                        }

                        if (com=='Hapus') {
                           var items= jQuery('.trSelected',grid);
                           
                               var id  = items[0].id.substr(3);
                          document.location="./hasil_tes/hapus/"+id;
                            
                        }
                        
                        if (com=='Unselect') {
                            $('.bDiv tbody tr',grid).removeClass('trSelected');
                        }
                        if (com=='Refresh'){
                            window.location = "<?php echo base_url()."hasil_tes"  ;?>";
                        }
                        
                        if (com=='Edit') {
                             var items= jQuery('.trSelected',grid);
                           
                               var id  = items[0].id.substr(3);
                      
                               // alert(id);
                                // document.location="./hasil_tes/edit/"+id;
                                 $.get('./hasil_tes/edit/'+id+'', function(data) {
                                  $('body').html(data);    
                              });
                                  
                       }          
                    }
                    jQuery(document).ready(function(){
                       // With Form Validation
                       // Dual Box Select
                   
                     
                    });
                    </script>
                    
                    <table id="flex1" style="display:none;font-size:11px"></table>
                    </div>
                </div><!--widgetcontent-->
            </div><!--contentinner-->
        </div><!--maincontent-->        
    </div><!--mainright-->
  <!-- END OF RIGHT PANEL -->
  <div class="clearfix"></div>
    
    
