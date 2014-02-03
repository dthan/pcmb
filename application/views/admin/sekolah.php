
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/sekolah.js"></script>

  <div class="pagetitle">
            <h1>Data sekolah</h1> 
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
                          document.location="./sekolah/hapus/"+id;
                            
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
                      
                               // alert(id);
                                // document.location="./sekolah/edit/"+id;
                                 $.get('./sekolah/edit/'+id+'', function(data) {
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
                <h4 class="widgettitle nomargin shadowed">tambah sekolah</h4>  
                <div class="widgetcontent bordered shadowed nopadding" >
                 <form class="stdform stdform2" id="input_sekolah" method="post" action="<?php echo base_url(); ?>sekolah/tambah">
                      <div class="control-group">
                            <p>
                                <label>Kode sekolah</label>
                                <span class="field"><input required="" type="text" name="kode_sekolah" id="kode_sekolah" class="input-large" />
                                <i id="kode_error" style="color:red;display:none">kode sudah ada,silahkan input yang kode yangl</i>
                                </span>
                                <input type="hidden" name="root" id="root" value="<?php echo base_url(); ?>" />
                          </p>
                         <p>
                                <label>Nama sekolah</label>
                                <span class="field"><input required="" type="text" name="nama_sekolah" id="nama_sekolah" class="input-large" /></span>
                          </p>
                            <p>
                                <label>Propinsi</label>
                                <span class="field">
                                <select required="" name="propinsi" id="propinsi">
                                <option value="">pilih propinsi</option>
                                 <?php
                                    foreach ($propinsi->result() as $pro) {
                                      echo "<option value=".$pro->id_propinsi.">".$pro->nama_propinsi."</option>";
                                    }
                                 ?>
                                 </select>
                                </span>
                          </p>
                           <p>
                                <label>Kota/Kabupaten</label>
                                <span class="field">
                                <select required="" name="kota" id="kota">
                                <option value="">pilih kota</option>
                                 
                                 </select>
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
    
    
