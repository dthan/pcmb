
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>asset/admin/js/fakultas.js"></script>
  <div class="pagetitle">
            <h1>Edit fakultas</h1> 
        </div><!--pagetitle-->

        <div class="maincontent">
          <div class="contentinner animate1 fadeInRightBig">
                   <?php
                        foreach ($fakultas->result() as $r) {
                          # code...
                        }
                        ?>
                <div id="tambah">
                  <div class="alert alert-success" id="sukses" style="display:none">
                              <button data-dismiss="alert" class="close" type="button">×</button>
                              <strong>Edit sukses</strong> 
                  </div><!--alert-->
                  <div id="gagal" class="alert alert-error" style="display:none">
                              <button data-dismiss="alert" class="close" type="button">×</button>
                              <strong>GAGAL</strong> .
                  </div><!--alert-->
                <h4 class="widgettitle nomargin shadowed">Edit fakultas</h4>  
                <div class="widgetcontent bordered shadowed nopadding" >
                 <form class="stdform stdform2" method="post" id="fakultas" action="<?php echo base_url();?>fakultas/edit_data/<?php echo $r->kode_fak; ?>">
                      <div class="control-group">
                      
                         <p>
                                <label>Nama fakultas</label>
                                <span class="field">
                                    <input value="<?php echo $r->fakultas; ?>" required="" type="text" name="nama_fakultas" id="nama_fakultas" class="input-large" />
                                    
                                    <input type="hidden" name="id_fak" id="id_fak" value="<?= $r->kode_fak; ?>">
                                    <input type="hidden" id="root" value="<?= base_url(); ?>" name="root">
                                    <input type="hidden" id="aksi" name="aksi" value="edit">
                                </span>
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
    
    
