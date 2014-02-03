
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.validate.min.js"></script>

  <div class="pagetitle">
            <h1>Edit berita</h1> 
        </div><!--pagetitle-->

        <div class="maincontent">
          <div class="contentinner animate1 fadeInRightBig">
                   <?php
                        foreach ($berita->result() as $r) {
                          # code...
                        }
                        ?>
                <div id="tambah">
                <h4 class="widgettitle nomargin shadowed">Edit berita</h4>  
                <div class="widgetcontent bordered shadowed nopadding" >
                 <form class="stdform stdform2" method="post" action="./../edit_data" enctype="multipart/form-data" >
                      <div class="control-group">
                         <p>
                                <label>judul berita</label>
                                <span class="field"><input value="<?php echo $r->judul; ?>" required="" type="text" name="judul" id="judul" class="input-large" /></span>
                          </p>
                          <p>
                                <label>foto berita</label>
                                <span class="field">
                                <?php
                                if($r->gambar!=''){
                                  echo "<img src='../../foto_berita/".$r->gambar."' width='80' />";
                                }
                                ?>
                                <input type="hidden" name="id" value="<?php echo $r->id_berita; ?>">
                                <input type="file" name="userfile" id="userfile" class="input-large" /></span>
                          </p>
                          <p>
                                <label>isi</label>
                                <span class="field">
                                <?php
                                    $oFCKeditor = new FCKeditor('FCKeditor1','600','500') ;
                                    $oFCKeditor->BasePath = '/pcmb/fckeditor/' ;
                                    $oFCKeditor->Value    = $r->isi ;
                                    $data['editor']=$oFCKeditor->Create() ;
                                ?>
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
    
    
