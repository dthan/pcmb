
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.validate.min.js"></script>

  <div class="pagetitle">
            <h1>Edit Gedung</h1> 
        </div><!--pagetitle-->

        <div class="maincontent">
          <div class="contentinner animate1 fadeInRightBig">
                   <?php
                        foreach ($gedung->result() as $r) {
                          # code...
                        }
                        ?>
                <div id="tambah">
                <h4 class="widgettitle nomargin shadowed">Edit Gedung</h4>  
                <div class="widgetcontent bordered shadowed nopadding" >
                 <form class="stdform stdform2" method="post" action="<?php echo base_url();?>gedung/edit_data/<?php echo $r->id_gedung; ?>">
                      <div class="control-group">
                      
                         <p>
                                <label>Nama Gedung</label>
                                <span class="field"><input value="<?php echo $r->nama_gedung; ?>" required="" type="text" name="nama_gedung" id="nama_gedung" class="input-large" /></span>
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
    
    
