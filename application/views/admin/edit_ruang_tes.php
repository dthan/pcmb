
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>asset/admin/js/gedung.js"></script>
  <div class="pagetitle">
            <h1>Edit Ruang Tes</h1> 
        </div><!--pagetitle-->

        <div class="maincontent">
          <div class="contentinner">
                   <?php
                        foreach ($ruang_tes->result() as $r) {
                          # code...
                        }
                        ?>
             
                <div id="tambah" class="animate1 fadeInRightBig">
                 <div class="alert alert-success" id="sukses" style="display:none">
                              <button data-dismiss="alert" class="close" type="button">×</button>
                              <strong>Edit sukses</strong> 
                  </div><!--alert-->
                  <div id="gagal" class="alert alert-error" style="display:none">
                              <button data-dismiss="alert" class="close" type="button">×</button>
                              <strong>GAGAL</strong> .
                  </div><!--alert-->
                <h4 class="widgettitle nomargin shadowed">Edit Ruang Tes</h4>  
                <div class="widgetcontent bordered shadowed nopadding" >
                 <form class="stdform stdform2" method="post" id="ruang_tes" action="<?php echo base_url();?>ruang_tes/edit_data/<?php echo $r->id_ruang_tes; ?>">
                      <div class="control-group">
                      
                         <p>
                                <label>Nama Ruang Tes</label>
                                <span class="field"><input value="<?php echo $r->nama_ruang_tes; ?>" required="" type="text" name="ruang" id="ruang" class="input-large" /></span>
                          </p>
                         <p>
                                <label>Gedung</label>
                                <span class="field">
                                <select required="" name="gedung" id="selection2" class="uniformselect" width="200">
                                    <option value="">Choose One</option>
                                   <?php
                                    foreach ($gedung->result() as $gd) {
                                      if($gd->id_gedung==$r->id_gedung){
                                        echo "<option value='".$gd->id_gedung."' selected>".$gd->nama_gedung."</option>";
                                      }
                                      else {
                                         echo "<option value='".$gd->id_gedung."'>".$gd->nama_gedung."</option>";
                                      }
                                      
                                    }
                                    ?>
                                </select></span>
                          </p>
                          <p>
                                <label>Kapasitas</label>
                                <span class="field">
                                <input type="hidden" value="edit" id="aksi">
                                <input type="hidden" value="<?php echo $r->id_ruang_tes; ?>" id="id" name="id">
                                <input type="hidden" value="<?php echo base_url(); ?>" id="root" name="root">
                                <input value="<?php echo $r->kapasitas; ?>" required="" type="text" name="kapasitas" id="kapasitas" class="input-large" /></span>
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
    
    
