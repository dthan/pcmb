
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
                foreach ($sekolah->result() as $sek) {
                  # code...
                }
                ?>
                <div id="tambah">
                 <div class="alert alert-success" id="sukses" style="display:none">
                              <button data-dismiss="alert" class="close" type="button">×</button>
                              <strong>edit sukses</strong> 
                  </div><!--alert-->
                  <div id="gagal" class="alert alert-error" style="display:none">
                              <button data-dismiss="alert" class="close" type="button">×</button>
                              <strong>GAGAL</strong> .
                  </div><!--alert-->
                <h4 class="widgettitle nomargin shadowed">tambah sekolah</h4>  
                <div class="widgetcontent bordered shadowed nopadding" >
                 <form class="stdform stdform2" id="edit_sekolah" method="post" action="<?php echo base_url(); ?>sekolah/tambah">
                      <div class="control-group">
                            <p>
                                <label>Kode sekolah</label>
                                <span class="field"><input required="" type="text" name="kode_sekolah" id="kode_sekolah" class="input-large" value="<?php echo $sek->kode_sekolah; ?>" />
                                <i id="kode_error" style="color:red;display:none">kode sudah ada,silahkan input yang kode yangl</i>
                                </span>
                                <input type="hidden" name="root" id="root" value="<?php echo base_url(); ?>" />
                          </p>
                         <p>
                                <label>Nama sekolah</label>
                                <span class="field"><input required="" type="text" name="nama_sekolah" id="nama_sekolah" class="input-large" value="<?php echo $sek->nama_smta; ?>" /></span>
                          </p>
                            <p>
                                <label>Propinsi</label>
                                <span class="field">
                                <select required="" name="propinsi" id="propinsi">
                                <option value="">pilih propinsi</option>
                                 <?php
                                    foreach ($propinsi->result() as $pro) {
                                      if($sek->id_propinsi==$pro->id_propinsi){
                                        echo "<option value=".$pro->id_propinsi." selected>".$pro->nama_propinsi."</option>";
                                      }
                                      else {
                                        echo "<option value=".$pro->id_propinsi.">".$pro->nama_propinsi."</option>";
                                      }
                                      
                                    }
                                 ?>
                                 </select>
                                </span>
                          </p>
                           <p>
                                <label>Kota/Kabupaten</label>
                                <span class="field">
                                <select required="" name="kota" id="kota">
                                <?php
                                    foreach ($kota->result() as $kot) {
                                      if($kot->id_kota==$sek->id_kota){
                                        echo "<option value=".$kot->id_kota." selected>".$kot->nama_kota."</option>";
                                      }
                                      else {
                                        echo "<option value=".$kot->id_kota.">".$kot->nama_kota."</option>";
                                      }
                                      
                                    }
                                 ?>
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
    
    
