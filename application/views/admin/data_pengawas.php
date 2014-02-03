
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>asset/admin/js/gedung.js"></script>
  <div class="pagetitle">
            <h1>Data pengawas</h1>
            <?php

            echo "
                 <h4>jumlah ruang tes : ".$jml_ruang_tes."</h4>
                 <h4>jumlah ruang tes terisi : ".$terisi."</h4>
                 ";

            ?> 
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
                          document.location="./pengawas/hapus/"+id;
                            
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
                      
                               $.get('./data_pengawas/edit/'+id+'', function(data) {
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
                              <strong>MAAF</strong> Semua ruang tes sudah terisi.
                  </div><!--alert-->
                <input value="<?php echo base_url(); ?>" type="hidden" name="root" id="root" class="input-large" />
                <h4 class="widgettitle nomargin shadowed">tambah pengawas</h4>  
                <div class="widgetcontent bordered shadowed nopadding" >
                 <form class="stdform stdform2" id="pengawas" method="post" action="./pengawas/tambah">
                      <div class="control-group">
                         <p>
                                <label>Nama pengawas</label>
                                <span class="field">
                                
                                <input required="" type="text" name="nama_pengawas" id="nama_pengawas" class="input-large" />
                                <input type="hidden" id="password" name="password" />
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
    
    
