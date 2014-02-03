
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jurusan.js"></script>

  <div class="pagetitle">
            <h1>Edit jurusan</h1> 
        </div><!--pagetitle-->

        <div class="maincontent">
          <div class="contentinner animate1 fadeInRightBig">
                   <?php
                        foreach ($jurusan->result() as $r) {
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
                <h4 class="widgettitle nomargin shadowed">Edit jurusan</h4>  
                <div class="widgetcontent bordered shadowed nopadding" >
                 <form id="edit_jurusan" class="stdform stdform2" method="post" action="">
                      <div class="control-group">
                      <div class="control-group">
                            <p>
                                <label>Kode jurusan</label>
                                <span class="field"><input required="" type="text" name="kode_jurusan" id="kode_jurusan" class="input-large" value="<?php echo $r->kode_jurusan; ?>" />
                                <i id="kode_error" style="color:red;display:none">kode sudah ada,silahkan input yang kode yangl</i>
                                </span>
                                <input type="hidden" name="root" id="root" value="<?php echo base_url(); ?>" />
                                <input type="hidden" name="kode_sekarang" id="kode_sekarang" value="<?php echo $r->kode_jurusan; ?>" />
                          </p>
                         <p>
                                <label>Nama jurusan</label>
                                <span class="field"><input required="" type="text" name="nama_jurusan" id="nama_jurusan" class="input-large" value="<?php echo $r->nama_jurusan; ?>"/></span>
                          </p>
                            <p>
                                <label>Fakultas</label>
                                <span class="field">
                                <select required="" name="fakultas" id="fakultas">
                                <option value="">pilih fakultas</option>
                                 <?php
                                    foreach ($fakultas->result() as $fak) {
                                      if($fak->kode_fak==$r->kode_fak){
                                        echo "<option value=".$fak->kode_fak." selected>".$fak->fakultas."</option>";
                                      }
                                      else{
                                        echo "<option value=".$fak->kode_fak.">".$fak->fakultas."</option>";
                                      }
                                      
                                    }
                                 ?>
                                 </select>
                                </span>
                          </p>
                          <p>
                                <label>Kuota</label>
                                <span class="field"><input required="number" type="text" name="kuota" id="kuota" class="input-large" value="<?php echo $r->kuota; ?>" /></span>
                          </p>
                       
                        </div>
                           
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
    
    
