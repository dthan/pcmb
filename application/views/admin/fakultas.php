
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>asset/admin/js/fakultas.js"></script>
  <div class="pagetitle">
            <h1>Data fakultas</h1> 
        </div><!--pagetitle-->

        <div class="maincontent">
        	<div class="contentinner">
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
                          document.location="./fakultas/hapus/"+id;
                            
                        }
                        
                        if (com=='Unselect') {
                            $('.bDiv tbody tr',grid).removeClass('trSelected');
                        }
                        if (com=='Refresh'){
                            window.location = "<?php echo base_url()."admin/peserta"  ;?>";
                        }
                        
                        if (com=='Edit') {
                             var items= jQuery('.trSelected',grid);
                           
                               var id  = items[0].id.substr(3);
                      
                               // alert(id);
                                // document.location="./fakultas/edit/"+id;
                                 $.get('./fakultas/edit/'+id+'', function(data) {
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
                <div id="tambah" style="display:none">
                 <div class="alert alert-success" id="sukses" style="display:none">
                              <button data-dismiss="alert" class="close" type="button">×</button>
                              <strong>Tambah sukses</strong> 
                  </div><!--alert-->
                  <div id="gagal" class="alert alert-error" style="display:none">
                              <button data-dismiss="alert" class="close" type="button">×</button>
                              <strong>GAGAL</strong> .
                  </div><!--alert-->
                <h4 class="widgettitle nomargin shadowed">tambah fakultas</h4>  
                <div class="widgetcontent bordered shadowed nopadding" >
                 <form class="stdform stdform2" method="post" id="fakultas" action="<?php echo base_url(); ?>fakultas/tambah">
                      <div class="control-group">
                         <p>
                                <label>Nama fakultas</label>
                                <span class="field">
                                    <input required="" type="text" name="nama_fakultas" id="nama_fakultas" class="input-large" />
                                    <input type="hidden" id="root" value="<?= base_url(); ?>" name="root">
                                    <input type="hidden" id="aksi" name="aksi" value="tambah">
                                </span>
                          </p>
                       
                        </div>
                              
                        <p class="stdformbutton">
                          <button class="btn btn-primary">simpan</button>
                        </p>
                    </form>
                </div><!--widgetcontent-->
              </div>
                
                 
                
                                       
            </div><!--contentinner-->
        </div><!--maincontent-->
        
    </div><!--mainright-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
    
    
