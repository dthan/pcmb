
 <script src="<?php echo base_url(); ?>asset/js/peserta.js"></script>
 <script src="<?php echo base_url(); ?>asset/admin/js/ajax_peserta.js"></script>

  <div class="pagetitle">
            <h1>Peserta</h1> <span>data peserta yang telah daftar pcmb</span>
        </div><!--pagetitle-->
         <?php 
          foreach ($data_diri->result() as $dt) {
                  
                }
                ?>
        <div class="maincontent">
          <div class="contentinner">
            <center id="loading" style="display:none"><img src="<?php echo base_url()."asset/img/loaders/ajax-loader.gif"; ?>"/>loading</center>   
                 
                 <div class="widget animate1 fadeInRightBig" style="display:none">
                
                    <header >
                      <h3 style="color:#fff">Edit Data Peserta</h3>
                      
                      <ul class="toggle_content">                         
                          <li class="arrow"><a href="#">Toggle Content</a></li>
                      </ul>
                    </header>
                     
                    <section class="welly group" >                         
                     
                        <form  action="<?php echo base_url()."peserta/update_data_peserta/".$dt->no_pes; ?>" method="POST" id="form_daftar" enctype="multipart/form-data">
                          <input type='hidden' name="issubmit" value="1">
                              <!-- Tabs -->
                              <div id="wizard" class="swMain" style="diplay:none">
                                <ul>
                                  <li><a class="done" href="#step-1" rel="1" isdone="1">
                                        <label class="stepNumber">1</label>
                                        <span class="stepDesc">
                                           Data Diri<br />
                                          
                                        </span>
                                    </a></li>
                                  <li><a class="done" href="#step-2" rel="2" isdone="1">
                                        <label class="stepNumber">2</label>
                                        <span class="stepDesc">
                                           Data Sekolah<br />
                                           
                                        </span>
                                    </a></li>
                                  <li><a class="done" href="#step-3" rel="3" isdone="1">
                                        <label class="stepNumber">3</label>
                                        <span class="stepDesc">
                                           Data Orang tua<br />
                                          
                                        </span>
                                     </a></li>
                                  <li><a class="done" href="#step-4" rel="4" isdone="1">
                                        <label class="stepNumber">4</label>
                                        <span class="stepDesc">
                                           Data Pilihan Jurusan<br />
                                          
                                        </span>
                                    </a></li>
                                </ul>
                                <div id="step-1"> 
                                    <h2 class="StepTitle">Step 1: Data Diri</h2>
                                    <table cellspacing="3" cellpadding="3" align="center">

                                        <tr>
                                              <td align="center" colspan="3">&nbsp;</td>
                                        </tr>        
                                        <tr>
                                              <td align="right">Nama Lengkap :</td>
                                              <td align="left">
                                                <input required="" type="hidden" name="posisi" id="posisi" value="admin"/>
                                                <input required="" type="hidden" name="no_pes" id="no_pes" value="<?php echo $dt->no_pes; ?>" style="width:300px"/>
                                                <input required="" type="hidden" name="aksi" id="aksi" value="input" style="width:300px"/>
                                                <input required="" type="text" name="nama" id="nama" value="<?php echo $dt->nama; ?>" style="width:300px"/>           
                                              </td>
                                              <td align="left"><span id="msg_nama"></span>&nbsp;</td>
                                        </tr>
                                        <tr>
                                              <td align="right">Tempat Lahir :</td>
                                              <td align="left">
                                                <input required="" type="text" name="tempat" id="tempat" value="<?php echo $dt->tempat_lahir; ?>" style="width:300px"/>           
                                              </td>
                                              <td align="left"><span id="msg_tempat"></span>&nbsp;</td>
                                        </tr> 
                                           <tr>
                                              <td align="right">Tanggal lahir :</td>
                                              <td align="left">
                                                <input required="" type="text" class="datepicker" name="ttl" id="tanggal" value="<?php echo $dt->tgl_lahir; ?>" style="width:300px"/>            
                                              </td>
                                              <td align="left"><span id="msg_tanggal"></span>&nbsp;</td>
                                        </tr>
                                        <tr>
                                              <td align="right">Jenis Kelamin :</td>
                                              <td align="left">
                                                <select required="" name="jk" style="width:300px">
                                                  <option value="L" <?php if($dt->jk=='L') echo "selected" ?>>laki-laki</option>
                                                  <option value="P" <?php if($dt->jk=='P') echo "selected" ?>>Perempuan</option>
                                                </select>
                                              </td>
                                              <td align="left"><span id="msg_jk"></span>&nbsp;</td>
                                        </tr>  
                                        <tr>
                                              <td align="right">Warga Negara :</td>
                                              <td align="left">
                                                    <select required="" name="warga" style="width:300px">
                                                    <option value="WNI" <?php if($dt->warga=='WNI') echo "selected" ?>>WNI</option>
                                                    <option value="WNA" <?php if($dt->warga=='WNA') echo "selected" ?>>WNA</option>
                                                  </select>   
                                              </td>
                                              <td align="left"><span id="msg_warga"></span>&nbsp;</td>
                                        </tr>    
                                         <tr>
                                              <td align="right">Agama :</td>
                                              <td align="left">
                                               <select required="" id="agama" name="agama" style="width:300px">
                                                  <?php
                                                  foreach ($agama->result() as $agm ) {
                                                    if($dt->id_agama==$agm->id_agama){
                                                      echo "<option value='".$agm->id_agama." ' selected>".$agm->nm_agama."</option>";
                                                    }
                                                    else {
                                                                  echo "<option value='".$agm->id_agama." '>".$agm->nm_agama."</option>";
                                                    } 
                                                  }
                                                  ?>
                                                </select>   
                                                                                  </td>
                                              <td align="left"><span id="msg_agama"></span>&nbsp;</td>
                                        </tr>
                                         <tr>
                                              <td align="right">Provinsi :</td>
                                              <td align="left">
                                                <select required="" id="provinsi" name="provinsi" style="width:300px">
                                                    <?php
                                                    foreach ($prov->result() as $pr1 ) {
                                                      if($dt->id_propinsi==$pr1->id_propinsi){
                                                      echo "<option value='".$pr1->id_propinsi."' selected>".$pr1->nama_propinsi."</option>";
                                                      }
                                                      else {
                                                        echo "<option value='".$pr1->id_propinsi."'>".$pr1->nama_propinsi."</option>";
                                                      }
                                                    }
                                                    ?>
                                                  </select>   
                                              </td>
                                              <td align="left"><span id="msg_provinsi"></span>&nbsp;</td>
                                        </tr>
                                         <tr>
                                              <td align="right">kabupaten/kota :</td>
                                              <td align="left">
                                               <select required="" id="kota" name="kota" style="width:300px">
                                                     <?php
                                                    foreach ($kab->result() as $kb ) {
                                                      if($dt->id_kota==$kb->id_kota){
                                                      echo "<option value='".$kb->id_kota."' selected>".$kb->nama_kota."</option>";
                                                      }
                                                      else {
                                                        echo "<option value='".$kb->id_kota."'>".$kb->nama_kota."</option>";
                                                      }
                                                    }
                                                    ?>
                                                   </select>        
                                              </td>
                                              <td align="left"><span id="msg_kota"></span>&nbsp;</td>
                                        </tr>
                                         <tr>
                                              <td align="right">Alamat :</td>
                                              <td align="left">
                                                <textarea required="" name="alamat" id="alamat"  style="width:300px"><?php echo $dt->alamat; ?></textarea>        
                                              </td>
                                              <td align="left"><span id="msg_alamat"></span>&nbsp;</td>
                                        </tr>
                                         <tr>
                                              <td align="right">no hp :</td>
                                              <td align="left">
                                                <input required="" type="text" name="no_hp" id="no_hp" value="<?php echo $dt->no_hp; ?>" style="width:300px"/>            
                                              </td>
                                              
                                        </tr>
                                         <tr>
                                              <td align="right">Photo :</td>
                                              <td align="left">
                                                <input type="file" name="photo" size="20" /><br> 
                                                <i style="color:red">max ukuran foto 500 kb</i><br>             
                                                <i style="color:red">gambar harus tipe jpeg atau png</i>  
                                              </td>
                                              <td align="left"><span id="msg_photo"></span>&nbsp;</td>
                                        </tr>  
                                          <?php
                                    echo "<img src='".base_url()."upload/foto_pendaftar/".$dt->foto."' width='150' style='float:right;padding:10px' />  ";
                                    ?>                                 
                                   </table>               
                                </div>
                                <div id="step-2">
                                    <h2 class="StepTitle">Step 2: Data Sekolah</h2>  
                                    <table cellspacing="3" cellpadding="3" align="center">
                                     <?php
                                    echo "<img src='".base_url()."upload/foto_pendaftar/".$dt->foto."' width='150' style='float:right;padding:10px' />  ";
                                    ?>        
                                        <tr>
                                              <td align="center" colspan="3">&nbsp;</td>
                                        </tr>        
                                         <tr>
                                              <td align="right">provinsi sekolah :</td>
                                              <td align="left">
                                               <select required="" id="provinsi_sekolah" name="provinsi_sekolah" style="width:300px">
                                                  <?php

                                                  foreach ($prov->result() as $pr2 ) {
                                                    if($pr2->id_propinsi==$prov_sekolah){
                                                    echo "<option value='".$pr2->id_propinsi."' selected>".$pr2->nama_propinsi."</option>";
                                                    }
                                                    else {
                                                      echo "<option value='".$pr2->id_propinsi."'>".$pr2->nama_propinsi."</option>";
                                                    }
                                                  }
                                                  ?>
                                                </select>   
                                              </td>
                                              <td align="left"><span id="msg_jenis_sekolah"></span>&nbsp;</td>
                                        </tr> 
                                           <tr>
                                              <td align="right">kota sekolah :</td>
                                              <td align="left">
                                                <select required="" id="kota_sekolah" name="kota_sekolah" style="width:300px">
                                                  <option value="0">-pilih kota-</option>
                                                  <?php

                                                  foreach ($kota_sek->result() as $kota2 ) {
                                                    if($kota2->id_kota==$kota_sekolah){
                                                    echo "<option value='".$kota2->id_kota."' selected>".$kota2->nama_kota."</option>";
                                                    }
                                                    else {
                                                      echo "<option value='".$kota2->id_kota."'>".$kota2->nama_kota."</option>";
                                                    }
                                                  }
                                                  ?>
                                                </select>    
                                              </td>
                                              </td>
                                              <td align="left"><span id="msg_jenis_sekolah"></span>&nbsp;</td>
                                        </tr> 
                                        <tr>
                                              <td align="right">nama sekolah :</td>
                                              <td align="left">
                                               <select required="" id="nama_sekolah" name="nama_sekolah" style="width:300px">
                                                  <option value="0">-pilih kota-</option>
                                                  <?php
                                                  foreach ($sekolah2->result() as $skl2) {
                                                    if($skl2->kode_sekolah==$dt->kode_sekolah){
                                                    echo "<option value='".$skl2->kode_sekolah."' selected>".$skl2->nama_smta."</option>";
                                                    }
                                                    else {
                                                      echo "<option value='".$skl2->kode_sekolah."'>".$skl2->nama_smta."</option>"; 
                                                    }
                                                    
                                                  }
                                                  ?>
                                                </select>     
                                              </td>
                                              </td>
                                              <td align="left"><span id="msg_jenis_sekolah"></span>&nbsp;</td>
                                        </tr> 
                                        <tr>
                                              <td align="right">Jenis Sekolah :</td>
                                              <td align="left">
                                              <select id="jenis_sekolah" name="jenis_sekolah" style="width:300px">
                                                      <?php
                                                      foreach ($sekolah->result() as $skl) {
                                                        if($skl->id_jenis_sekolah==$dt->jenis_sekolah){
                                                        echo "<option value='".$skl->id_jenis_sekolah."' selected>".$skl->jenis_sekolah."</option>";
                                                        }
                                                        else {
                                                          echo "<option value='".$skl->id_jenis_sekolah."'>".$skl->jenis_sekolah."</option>"; 
                                                        }
                                                        
                                                      }
                                                      ?>
                                                    </select>   
                                              </td>
                                              <td align="left"><span id="msg_jenis_sekolah"></span>&nbsp;</td>
                                        </tr> 
                                        <tr>
                                              <td align="right">Alamat Sekolah :</td>
                                              <td align="left">
                                                 <textarea name="alamat_sekolah" id="alamat_sekolah" style="width:300px"><?php echo $dt->alamat_sekolah; ?></textarea>          
                                              </td>
                                              <td align="left"><span id="msg_alamat_sekolah"></span>&nbsp;</td>
                                        </tr>  
                                         <tr>
                                              <td align="right">Program :</td>
                                              <td align="left">
                                                 <select name="program" style="width:300px">
                                                  <?php
                                                  foreach ($program->result() as $pro) {
                                                  if($dt->nama_program==$pro->id_program){
                                                    echo "<option value='".$pro->id_program."' selected>".$pro->nama_program."</option>";
                                                  }
                                                  else {
                                                    echo "<option value='".$pro->id_program."'>".$pro->nama_program."</option>";
                                                  }
                                                    
                                                  }
                                                  ?>
                                                </select>   
                                              </td>
                                              <td align="left"><span id="msg_program"></span>&nbsp;</td>
                                        </tr>
                                          <tr>
                                              <td align="right">Tahun lulus :</td>
                                              <td align="left">
                                               <select name="tahun_lulus" style="width:300px">
                                                  <?php
                                                  for ($th=2013; $th>2005; $th--){
                                                    if($dt->tahun_lulus==$th){
                                                      echo "<option value='$th' selected>$th<option>";
                                                    }
                                                    else {
                                                                  echo "<option value='$th'>$th<option>";
                                                                    }
                                                  }
                                                  ?>
                                                </select>       
                                              </td>
                                              <td align="left"><span id="msg_tahun_lulus"></span>&nbsp;</td>
                                        </tr> 
                                          <tr>
                                              <td align="right">Nilai Ijazah :</td>
                                              <td align="left">
                                                 <input required="" type="text" name="nilai_ijazah" id="nilai_ijazah" value="<?php echo $dt->nilai_ijazah; ?>" style="width:300px"/>                  
                                              </td>
                                              <td align="left"><span id="msg_ijazah"></span>&nbsp;</td>
                                        </tr> 
                                      

                                   </table>        
                                </div>                      
                                <div id="step-3">
                                    <h2 class="StepTitle">Step 3: Data Orang tua</h2>  
                                    <table cellspacing="3" cellpadding="3" align="center">
                                     <?php
                                    echo "<img src='".base_url()."upload/foto_pendaftar/".$dt->foto."' width='150' style='float:right;padding:10px' />  ";
                                    ?>        
                                        <tr>
                                              <td align="center" colspan="3">&nbsp;</td>
                                        </tr>        
                                        <tr>
                                              <td align="right">Nama Ayah :</td>
                                              <td align="left">
                                                 <input type="hidden" id="root" value="<?php echo base_url(); ?>"/>
                                                 <input required="" type="text" name="ayah" id="ayah" value="<?php echo $dt->ayah; ?>" style="width:300px"/>           
                                              </td>
                                          </tr>
                                           <tr>
                                              <td align="right">Nama Ibu :</td>
                                              <td align="left">
                                                <input required="" type="text" name="ibu" id="ibu" value="<?php echo $dt->ibu; ?>" style="width:300px"/>                      
                                              </td>
                                          </tr>
                                           <tr>
                                              <td align="right">Provinsi :</td>
                                              <td align="left">
                                             <select id="provinsi_ortu" name="provinsi_ortu" style="width:300px">
                                              <option value='0' selected>-pilih provinsi-</option>
                                                <?php
                                                foreach ($prov->result() as $pr2 ) {
                                                if($dt->provinsi_ortu==$pr2->id_propinsi){
                                                  echo "<option value='".$pr2->id_propinsi."' selected>".$pr2->nama_propinsi."</option>";
                                                }
                                                else {
                                                  echo "<option value='".$pr2->id_propinsi."'>".$pr2->nama_propinsi."</option>";
                                                }
                                                  
                                                }
                                                ?>
                                              </select>   
                                              </td>
                                          </tr>
                                        <tr>
                                              <td align="right">Kabupaten/kota :</td>
                                              <td align="left">
                                               <select id="kota_ortu" name="kota_ortu" style="width:300px">
                                                  <?php
                                                foreach ($kab->result() as $kb ) {
                                                  if($dt->id_kota==$kb->id_kota){
                                                  echo "<option value='".$kb->id_kota."' selected>".$kb->nama_kota."</option>";
                                                  }
                                                  else {
                                                    echo "<option value='".$kb->id_kota."'>".$kb->nama_kota."</option>";
                                                  }
                                                }
                                                ?>
                                               </select>
                                              </td>
                                              
                                        </tr>               
                                        <tr>
                                              <td align="right">Alamat Orang tua :</td>
                                              <td align="left">
                                                <input type="checkbox" id="samakan" name="samakan" value="sama">&nbsp;samakan dengan alamat anda<br>
                                                <textarea name="alamat_ortu" id="alamat_ortu" style="width:300px"><?php echo $dt->alamat_ortu; ?></textarea>           
                                              </td>
                                              
                                        </tr>     
                                         <tr>
                                              <td align="right">Pendidikan ayah :</td>
                                              <td align="left">
                                                   <select name="pend_ayah" style="width:300px">
                                                    <?php
                                                    foreach ($pendidikan->result() as $pend) {
                                                    if($dt->pend_ayah==$pend->idpendidikan){
                                                    echo "<option value='".$pend->idpendidikan."' selected>".$pend->pendidikan."</option>";
                                                    }
                                                    else {
                                                      echo "<option value='".$pend->idpendidikan."'>".$pend->pendidikan."</option>";
                                                    }
                                                      
                                                    }
                                                    ?>
                                                  </select>   
                                              </td>
                                              
                                        </tr>            
                                        <tr>
                                              <td align="right">Pendidikan Ibu :</td>
                                              <td align="left">
                                                <select name="pend_ibu" style="width:300px">
                                                    <?php
                                                    foreach ($pendidikan->result() as $pend) {
                                                    if($dt->pend_ibu==$pend->idpendidikan){
                                                    echo "<option value='".$pend->idpendidikan."' selected>".$pend->pendidikan."</option>";
                                                    }
                                                    else {
                                                      echo "<option value='".$pend->idpendidikan."'>".$pend->pendidikan."</option>";
                                                    }
                                                      
                                                    }
                                                    ?>
                                                  </select>    
                                              </td>
                                              
                                        </tr>          
                                           
                                        <tr>
                                              <td align="right">Pekerjaan Ayah :</td>
                                              <td align="left">
                                                <select name="pekerjaan_ayah" style="width:300px">
                                                    <?php
                                                    foreach ($pekerjaan->result() as $p) {
                                                    if($dt->pekerjaan_ayah==$p->idpekerjaan){
                                                      echo "<option value='".$p->idpekerjaan."' selected>".$p->pekerjaan."</option>";
                                                    }
                                                    else {
                                                      echo "<option value='".$p->idpekerjaan."'>".$p->pekerjaan."</option>";
                                                    }
                                                      
                                                    }
                                                    ?>
                                                  </select>     
                                              </td>
                                              
                                        </tr>          
                                        <tr>
                                              <td align="right">Pekerjaan Ibu :</td>
                                              <td align="left">
                                              <select name="pekerjaan_ibu" style="width:300px">
                                                    <?php
                                                    foreach ($pekerjaan->result() as $p) {
                                                    if($dt->pekerjaan_ayah==$p->idpekerjaan){
                                                      echo "<option value='".$p->idpekerjaan."' selected>".$p->pekerjaan."</option>";
                                                    }
                                                    else {
                                                      echo "<option value='".$p->idpekerjaan."'>".$p->pekerjaan."</option>";
                                                    }
                                                      
                                                    }
                                                    ?>
                                                  </select>   
                                              </td>
                                              
                                        </tr>    
                                        <tr>
                                              <td align="right">Penghasilan Orang tua :</td>
                                              <td align="left">
                                           <select name="penghasilan_ortu" style="width:300px">
                                              <?php
                                              foreach ($penghasilan->result() as $p) {
                                                if($dt->penghasilan_ortu==$p->idpenghasilan){
                                                  echo "<option value='".$p->idpenghasilan."'selected>".$p->penghasilan."</option>";
                                                }
                                                else {
                                                  echo "<option value='".$p->idpenghasilan."'>".$p->penghasilan."</option>";  
                                                }
                                                
                                              }
                                              ?>
                                            </select>   
                                              </td>
                                              
                                        </tr>         
                                        <tr>
                                              <td align="right">Telp Ayah :</td>
                                              <td align="left">
                                                 <input required="" type="text" name="telp_ayah" id="telp_ayah" value="<?php echo $dt->telp_ayah; ?>" style="width:300px"/>                 
                                              </td>
                                              
                                        </tr>    
                                         <tr>
                                              <td align="right">Telp Ibu :</td>
                                              <td align="left">
                                                <input required="" type="text" name="telp_ibu" id="telp_ibu" value="<?php echo $dt->telp_ibu; ?>" style="width:300px"/>                 
                                              </td>
                                              
                                        </tr> 
                                         <tr>
                                              <td align="right">Kode Pos Orang tua :</td>
                                              <td align="left">
                                                 <input  type="text" name="kode_post_ortu" id="kode_post_ortu" value="<?php echo $dt->kode_post_ortu; ?>" style="width:300px"/>                 
                                              </td>
                                              
                                        </tr>       
                                                                        
                                   </table>                                 
                                </div>
                                <div id="step-4">
                                    <h2 class="StepTitle">Step 4: Data Pilihan Jurusan</h2>  
                                    <table cellspacing="3" cellpadding="3" align="center">
                                      <?php
                                    echo "<img src='".base_url()."upload/foto_pendaftar/".$dt->foto."' width='150' style='float:right;padding:10px' />  ";
                                    ?>   
                                        <tr>
                                              <td align="center" colspan="3"><b>PILIHAN PERTAMA</b></td>
                                        </tr>        
                                        <tr>
                                              <td align="right">Fakultas :</td>
                                              <td align="left">
                                               <select required=""  id="fak1" name="fak1" style="width:300px">
                                                <option value='' selected>-pilih fakultas-</option>
                                                  <?php
                                                  foreach ($fakultas->result() as $fak ) {
                                                    if($fak2==$fak->kode_fak){
                                                    echo "<option value='".$fak->kode_fak."' selected>".$fak->fakultas."</option>";
                                                    }
                                                    else {
                                                      echo "<option value='".$fak->kode_fak."'>".$fak->fakultas."</option>";  
                                                    }
                                                    
                                                  }
                                                  ?>
                                                </select>
                                              </td>
                                              
                                        </tr>     
                                            <tr>
                                              <td align="right">Jurusan :</td>
                                              <td align="left">
                                               <select required="" id="pil_1" name="pil_1" style="width:300px">
                                               <?php
                                                 foreach ($jur->result() as $j) {
                                                  if($dt->pil_1==$j->kode_jurusan){
                                                    echo "<option value='".$j->kode_jurusan."' selected>".$j->nama_jurusan."</option>";
                                                  }
                                                  else {
                                                    echo "<option value='".$j->kode_jurusan."'>".$j->nama_jurusan."</option>";  
                                                  }
                                                  
                                                 }
                                               ?>
                                             
                                            </select>   
                                              </td>
                                              
                                        </tr>      
                                         <tr>
                                         &nbsp;
                                         </tr> 
                                         <tr>
                                         &nbsp;
                                         </tr>   
                                          <tr>
                                              <td align="center" colspan="3"><b>PILIHAN KEDUA</b></td>
                                        </tr>        
                                        <tr>
                                              <td align="right">Fakultas :</td>
                                              <td align="left">
                                               <select required="" id="fak2" name="fak2" style="width:300px">
                                                <option value='' selected>-pilih fakultas-</option>
                                                   <?php
                                                  foreach ($fakultas->result() as $fak ) {
                                                    if($fak3==$fak->kode_fak){
                                                    echo "<option value='".$fak->kode_fak."' selected>".$fak->fakultas."</option>";
                                                    }
                                                    else {
                                                      echo "<option value='".$fak->kode_fak."'>".$fak->fakultas."</option>";  
                                                    }
                                                    
                                                  }
                                                  ?>
                                                </select>
                                              </td>
                                              
                                        </tr>     
                                            <tr>
                                              <td align="right">Jurusan :</td>
                                              <td align="left">
                                               <select required="" id="pil_2" name="pil_2" style="width:300px">
                                                  <?php
                                                     foreach ($jur2->result() as $j2) {
                                                      if($dt->pil_2==$j2->kode_jurusan){
                                                        echo "<option value='".$j2->kode_jurusan."' selected>".$j2->nama_jurusan."</option>";
                                                      }
                                                      else {
                                                        echo "<option value='".$j2->kode_jurusan."'>".$j2->nama_jurusan."</option>";  
                                                      }
                                                      
                                                     }
                                                   ?>
                                                  
                                                </select> 
                                              </td>
                                              
                                        </tr>                                     
                                   </table>                       
                                </div>
                              </div>
                        <!-- End SmartWizard Content -->      
                        </form> 
                        
                    </section>
               
                  </div>   
                
                                       
            </div><!--contentinner-->
        </div><!--maincontent-->
        
    </div><!--mainright-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
    
   
