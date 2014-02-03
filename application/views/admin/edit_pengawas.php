
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.validate.min.js"></script>

  <div class="pagetitle">
            <h1>Edit pengawas</h1> 
        </div><!--pagetitle-->
       <script src="<?php echo base_url(); ?>asset/admin/js/gedung.js"></script>
        <div class="maincontent">
          <div class="contentinner animate1 fadeInRightBig">
                   <?php
                        foreach ($pengawas->result() as $r) {
                          # code...
                        }
                        ?>
                <div id="tambah">
                 <div class="alert alert-success" id="sukses" style="display:none">
                              <button data-dismiss="alert" class="close" type="button">×</button>
                              <strong>Tambah sukses</strong> 
                  </div><!--alert-->
                  <div id="gagal" class="alert alert-error" style="display:none">
                              <button d<input value="<?php echo base_url(); ?>" type="hidden" name="root" id="root" class="input-large" />ata-dismiss="alert" class="close" type="button">×</button>
                              <strong>MAAF</strong> Semua ruang tes sudah terisi.
                  </div><!--alert-->
                <h4 class="widgettitle nomargin shadowed">Edit pengawas</h4>  
                <div class="widgetcontent bordered shadowed nopadding" >

                 <form id="edit_pengawas" class="stdform stdform2" method="post" action="<?php echo base_url();?>pengawas/edit_data/<?php echo $r->id_pengawas; ?>">
                      <div class="control-group">
                      
                         <p>
                                <label>Nama pengawas</label>
                                <span class="field">
                                <input value="<?php echo $r->nama_pengawas; ?>" required="" type="text" name="nama_pengawas" id="nama_pengawas" class="input-large" />
                                <input value="<?php echo base_url(); ?>" type="hidden" name="root" id="root" class="input-large" />
                                <input value="<?php echo $r->id_pengawas; ?>" type="hidden" name="id_pengawas" id="id_pengawas" class="input-large" />
                                </span>
                          </p>
                          <p>
                                <label>Gedung</label>
                                <span class="field">
                                <select name="pengawas" id="gedung" class="uniformselect" width="200">
                                    <option value="">pilih gedung</option>
                                   <?php
                                    foreach ($gedung->result() as $gd) {
                                      
                                         echo "<option value='".$gd->id_gedung."'>".$gd->nama_gedung."</option>";
                                      
                                      
                                    }
                                    ?>
                                </select></span>
                          </p>
                         <p>
                                <label>ruang tes</label>
                                <span class="field">
                                <select required="" name="ruang_tes" id="ruang_tes"  width="200">
                                    
                                   <?php
                                    foreach ($ruang_tes_all->result() as $gd) {
                                      if($gd->id_ruang_tes==$ruang_tes){
                                        echo "<option value='".$gd->id_ruang_tes."' selected>".$gd->nama_ruang_tes."</option>";
                                      }
                                     
                                      
                                    }
                                    ?>
                                </select></span>
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
    
    
