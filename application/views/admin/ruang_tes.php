
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>asset/admin/js/gedung.js"></script>
  <div class="pagetitle">
            <h1>Ruang Tes</h1> 
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
                          document.location="./ruang_tes/hapus/"+id;
                            
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
                                //document.location="./ruang_tes/edit/"+id;
                                $.get('./ruang_tes/edit/'+id+'', function(data) {
                                  $('body').html(data);    
                              });

                                  
                       }          
                    }
                    
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
                <h4 class="widgettitle nomargin shadowed">tambah Ruang Tes</h4>  
                <div class="widgetcontent bordered shadowed nopadding" >
                 <form class="stdform stdform2" id="ruang_tes" method="post" action="">
                      <div class="control-group">
                         <p>
                                <label>Nama Ruang Tes</label>
                                <span class="field">
                                <input required="" type="text" name="ruang" id="ruang" class="input-large" />
                                <input value="<?php echo base_url(); ?>" type="hidden" name="root" id="root" class="input-large" />
                                </span>
                          </p>
                         <p>
                                <label>Gedung</label>
                                <span class="field">
                                <select required="" name="gedung" id="selection2" class="uniformselect" width="200">
                                    <option value="">Choose One</option>
                                   <?php
                                    foreach ($gedung->result() as $gd) {
                                      echo "<option value='".$gd->id_gedung."'>".$gd->nama_gedung."</option>";
                                    }
                                    ?>
                                </select></span>
                          </p>
                          <p>
                                <label>Kapasitas</label>
                                <span class="field">
                                <input type="hidden" value="tambah" id="aksi">
                                <input required="" type="text" name="kapasitas" id="kapasitas" class="input-large" /></span>
                          </p>
                           
                        </div>
                              
                        <p class="stdformbutton">
                          <button class="btn btn-primary">Submit Button</button>
                        </p>
                    </form>
                </div><!--widgetcontent-->
              </div>
                
                 
                
                                       
            </div><!--contentinner-->
        </div><!--maincontent-->
        
    </div><!--mainright-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
    
    
