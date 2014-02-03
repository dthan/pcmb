
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jurusan.js"></script>

  <div class="pagetitle">
            <h1>Data jurusan</h1> 
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
                          document.location="./jurusan/hapus/"+id;
                            
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
                                // document.location="./jurusan/edit/"+id;
                                 $.get('./jurusan/edit/'+id+'', function(data) {
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
                <h4 class="widgettitle nomargin shadowed">tambah jurusan</h4>  
                <div class="widgetcontent bordered shadowed nopadding" >
                 <form class="stdform stdform2" id="input_jurusan" method="post" action="<?php echo base_url(); ?>jurusan/tambah">
                      <div class="control-group">
                            <p>
                                <label>Kode jurusan</label>
                                <span class="field"><input required="" type="text" name="kode_jurusan" id="kode_jurusan" class="input-large" />
                                <i id="kode_error" style="color:red;display:none">kode sudah ada,silahkan input yang kode yangl</i>
                                </span>
                                <input type="hidden" name="root" id="root" value="<?php echo base_url(); ?>" />
                          </p>
                         <p>
                                <label>Nama jurusan</label>
                                <span class="field"><input required="" type="text" name="nama_jurusan" id="nama_jurusan" class="input-large" /></span>
                          </p>
                            <p>
                                <label>Fakultas</label>
                                <span class="field">
                                <select required="" name="fakultas" id="fakultas">
                                <option value="">pilih fakultas</option>
                                 <?php
                                    foreach ($fakultas->result() as $fak) {
                                      echo "<option value=".$fak->kode_fak.">".$fak->fakultas."</option>";
                                    }
                                 ?>
                                 </select>
                                </span>
                          </p>

                           <p>
                                <label>Kuota</label>
                                <span class="field"><input required="number" type="text" name="kuota" id="kuota" class="input-large" /></span>
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
    
    
