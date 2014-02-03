
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.validate.min.js"></script>

  <div class="pagetitle">
            <h1>Data berita</h1> 
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
                          document.location="./berita/hapus/"+id;
                            
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
                                // document.location="./berita/edit/"+id;
                                 $.get('./../berita/edit/'+id+'', function(data) {
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
                <h4 class="widgettitle nomargin shadowed">tambah berita</h4>  
                <div class="widgetcontent bordered shadowed nopadding" >
                 <form class="stdform stdform2" method="post" action="./tambah" enctype="multipart/form-data" >
                      <div class="control-group">
                         <p>
                                <label>judul berita</label>
                                <span class="field"><input required="" type="text" name="judul" id="judul" class="input-large" style="width:600px" /></span>
                          </p>
                          <p>
                                <label>foto berita</label>
                                <span class="field"><input type="file" name="userfile" id="userfile" class="input-large" /></span>
                          </p>
                          <p>
                                <label>isi</label>
                                <span class="field">
                                <?php
                                    $oFCKeditor = new FCKeditor('FCKeditor1','600','500') ;
                                    $oFCKeditor->BasePath = '/odessy/fckeditor/' ;
                                    $oFCKeditor->Value    = '' ;
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
    
    
