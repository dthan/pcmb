<script src="<?php echo base_url(); ?>asset/admin/js/seleksi.js"></script>
 <div class="pagetitle">
            <h1>Hasil Seleksi</h1> <span>data peserta hasil seleksi</span>
        </div><!--pagetitle-->
        <div class="maincontent">
            <div class="contentinner">
     
           <center id="loading" style="display:none"><img src="<?php echo base_url()."asset/img/loaders/ajax-loader.gif"; ?>"/>loading</center>   
                        <?php
                         foreach ($jur->result() as $j) {
                            # code...
                        }
                        ?>
                        <input type="hidden" id="root" value="<?php echo base_url();?>">
                        <input type="hidden" id="kode_jurusan" value="<?php echo $j->kode_jurusan; ?>">
                        <div class="widgetcontent">
                         <h4 class="widgettitle"><center>Seleksi Jurusan <?php echo $j->nama_jurusan."</center>
                         Kuota : <b>".$j->kuota."</b><br/>
                         Terisi : <b id='terisi'>".$j->terisi."</b>
                         ";
                         ?>
                         </h4>
                             <div id="tabs">
                                <ul>
                                    <li><a href="#tabs-1">Peserta Pilihan 1</a></li>
                                    <li><a href="#tabs-2">Peserta Pilihan 2</a></li>
                                    <li><a href="#tabs-3">Peserta Lulus</a></li>

                                    
                                </ul>
                                <div id="tabs-1">
                                    
                                  <table class="table table-bordered" id="dyntable" >
                                    <colgroup>
                                        <col class="con0" style="align: center; width: 4%" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                    </colgroup>
                                     <thead>
                                        <tr style="text-align:center">                                      
                                            <th class="head0 nosort" style='text-align:center' rowspan="2"><?php echo "<a href='".base_url()."seleksi/do_seleksi1/".$j->kode_jurusan."' style='text-decoration:none' onclick='do_seleksi(".$j->kode_jurusan.")'>
                                            <img src='".base_url()."asset/images/seleksi.png' width='25'/>seleksi</a>"; ?></th>
                                            <th class="head1" rowspan="2" style="text-align:center">No Pes</th>
                                            <th class="head1" rowspan="2" style="text-align:center">Nama</th>
                                            <th class="head1" colspan="4" style="text-align:center">nilai ujian</th>
                                            <th class="head1" colspan="3" style="text-align:center">kehadiran ujian</th>
                                            <th class="head1" rowspan="2" style="text-align:center">Pilihan ke <?php echo $j->nama_jurusan;?></th>
                                            <th class="head1" rowspan="2" style="text-align:center">Status</th>
                                        </tr>
                                        <tr>
                                             <th class="head1"  style="text-align:center">ujian umum</th>
                                             <th class="head1"  style="text-align:center">ujian agama</th>
                                             <th class="head1"  style="text-align:center">ujian bahasa</th>
                                             <th class="head1"  style="text-align:center">kumulatif</th>
                                             <th class="head1" style="text-align:center">umum</th>
                                             <th class="head1" style="text-align:center">agama</th>
                                             <th class="head1" style="text-align:center">bahasa</th>
                                        </tr>
                                    
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no=1;
                                    foreach ($pendaftar->result() as $p) {
                                     if(($no%2)!=0){
                                         echo "                                     
                                        <tr class='gradeX' style='background:#bde0e6'>
                                        <td class='aligncenter' style='text-align:center' ><span class='center'>
                                            <input type='checkbox' id='pilihan1-$no' name='pilihan1-$no' value='".$p->no_pes."'";
                                            if($p->status=='lulus_pil_1'){
                                                echo "checked";
                                            }
                                            echo " onclick='set_lulus(".$p->no_pes.",$no,1)'/>
                                          </span></td>
                                        <td>".$p->no_pes."</td>
                                        <td>".$p->nama."</td>
                                        <td style='text-align:center'>".$p->nilai_umum."</td>
                                        <td style='text-align:center'>".$p->nilai_agama."</td>
                                        <td style='text-align:center'>".$p->nilai_bahasa."</td>
                                        <td style='text-align:center'>".$p->kumulatif."</td>
                                        <td style='text-align:center'>".$p->ujian_agama."</td>
                                        <td style='text-align:center'>".$p->ujian_umum."</td>
                                        <td style='text-align:center'>".$p->ujian_bahasa."</td>
                                        <td style='text-align:center'>";
                                        if($p->pil_1==$j->kode_jurusan){
                                            echo "pilihan 1";
                                        }
                                        else{
                                            echo "pilihan 2";
                                        }
                                        echo "</td>
                                        <td style='text-align:center'><div id='lulus_1-$no'> ";
                                        if($p->status=='lulus_pil_1'){
                                            echo "lulus";
                                        }
                                        else{
                                            echo "Tidak lulus";
                                        }
                                        echo "</div></td>
                                        </tr>
                                         ";
                                    }
                                    else{
                                         echo "                                     
                                        <tr class='gradeX'>
                                        <td class='aligncenter' style='text-align:center' ><span class='center'>
                                            <input type='checkbox' id='pilihan1-$no' name='pilihan1-$no' value='".$p->no_pes."'";
                                            if($p->status=='lulus_pil_1'){
                                                echo "checked";
                                            }
                                            echo " onclick='set_lulus(".$p->no_pes.",$no,1)'/>
                                          </span></td>
                                        <td>".$p->no_pes."</td>
                                        <td>".$p->nama."</td>
                                        <td style='text-align:center'>".$p->nilai_umum."</td>
                                        <td style='text-align:center'>".$p->nilai_agama."</td>
                                        <td style='text-align:center'>".$p->nilai_bahasa."</td>
                                        <td style='text-align:center'>".$p->kumulatif."</td>
                                        <td style='text-align:center'>".$p->ujian_agama."</td>
                                        <td style='text-align:center'>".$p->ujian_umum."</td>
                                        <td style='text-align:center'>".$p->ujian_bahasa."</td>
                                        <td style='text-align:center'>";
                                        if($p->pil_1==$j->kode_jurusan){
                                            echo "pilihan 1";
                                        }
                                        else{
                                            echo "pilihan 2";
                                        }
                                        echo "</td>
                                        <td style='text-align:center'><div id='lulus_1-$no'> ";
                                        if($p->status=='lulus_pil_1'){
                                            echo "lulus";
                                        }
                                        else{
                                            echo "Tidak lulus";
                                        }
                                        echo "</div></td>
                                        </tr>
                                         ";
                                    }
                                         $no++;
                                    }
                                    
                                    ?>
                                   
                                                   
                                        </tbody>
                                    </table>
                               
                                  
                                </div>
                                <div id="tabs-2">
                                    
                                  <table class="table table-bordered" id="dyntable2" >
                                    <colgroup>
                                        <col class="con0" style="align: center; width: 4%" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                    </colgroup>
                                     <thead>
                                        <tr style="text-align:center">                                      
                                            <th class="head0 nosort" style='text-align:center' rowspan="2"><?php echo "<a href='".base_url()."seleksi2/do_seleksi/".$j->kode_jurusan."' style='text-decoration:none' onclick='do_seleksi(".$j->kode_jurusan.")'>
                                            <img src='".base_url()."asset/images/seleksi.png' width='25'/>seleksi</a>"; ?></th>
                                            <th class="head1" rowspan="2" style="text-align:center">No Pes</th>
                                            <th class="head1" rowspan="2" style="text-align:center">Nama</th>
                                            <th class="head1" colspan="4" style="text-align:center">nilai ujian</th>
                                            <th class="head1" colspan="3" style="text-align:center">kehadiran ujian</th>
                                            <th class="head1" rowspan="2" style="text-align:center">Pilihan ke <?php echo $j->nama_jurusan;?></th>
                                            <th class="head1" rowspan="2" style="text-align:center">Status</th>
                                        </tr>
                                        <tr>
                                             <th class="head1"  style="text-align:center">ujian umum</th>
                                             <th class="head1"  style="text-align:center">ujian agama</th>
                                             <th class="head1"  style="text-align:center">ujian bahasa</th>
                                             <th class="head1"  style="text-align:center">kumulatif</th>
                                             <th class="head1" style="text-align:center">umum</th>
                                             <th class="head1" style="text-align:center">agama</th>
                                             <th class="head1" style="text-align:center">bahasa</th>
                                        </tr>
                                    
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no=1;
                                    foreach ($pendaftar2->result() as $p) {
                                       if(($no%2)!=0){
                                             echo "                                     
                                            <tr class='gradeX' style='background:#bde0e6'>
                                            <td class='aligncenter' style='text-align:center' ><span class='center'>
                                                <input type='checkbox' id='pilihan2-$no' name='pilihan2-$no' value='".$p->no_pes."'";
                                                 if(($p->status=='lulus_pil_1') || ($p->status=='lulus_pil_2') || ($p->status=='lulus_pil_3')) {
                                                    echo "checked";
                                                }
                                                echo " onclick='set_lulus(".$p->no_pes.",$no,2)'/>
                                              </span></td>
                                            <td>".$p->no_pes."</td>
                                            <td>".$p->nama."</td>
                                            <td style='text-align:center'>".$p->nilai_umum."</td>
                                            <td style='text-align:center'>".$p->nilai_agama."</td>
                                            <td style='text-align:center'>".$p->nilai_bahasa."</td>
                                            <td style='text-align:center'>".$p->kumulatif."</td>
                                            <td style='text-align:center'>".$p->ujian_agama."</td>
                                            <td style='text-align:center'>".$p->ujian_umum."</td>
                                            <td style='text-align:center'>".$p->ujian_bahasa."</td>
                                            <td style='text-align:center'>";
                                            if($p->pil_1==$j->kode_jurusan){
                                                echo "pilihan 1";
                                            }
                                            else{
                                                echo "pilihan 2";
                                            }
                                            echo "</td>
                                            <td style='text-align:center'><div id='lulus_2-$no'> ";
                                            if(($p->status=='lulus_pil_1') || ($p->status=='lulus_pil_2') || ($p->status=='lulus_pil_3')) {
                                                echo "lulus";
                                            }
                                            else{
                                                echo "Tidak lulus";
                                            }
                                            echo "</div></td>
                                            </tr>
                                             ";
                                        }
                                        else {
                                            echo "                                     
                                            <tr class='gradeX' >
                                            <td class='aligncenter' style='text-align:center' ><span class='center'>
                                                <input type='checkbox' id='pilihan2-$no' name='pilihan2-$no' value='".$p->no_pes."'";
                                                 if(($p->status=='lulus_pil_1') || ($p->status=='lulus_pil_2') || ($p->status=='lulus_pil_3')) {
                                                    echo "checked";
                                                }
                                                echo " onclick='set_lulus(".$p->no_pes.",$no,2)'/>
                                              </span></td>
                                            <td>".$p->no_pes."</td>
                                            <td>".$p->nama."</td>
                                            <td style='text-align:center'>".$p->nilai_umum."</td>
                                            <td style='text-align:center'>".$p->nilai_agama."</td>
                                            <td style='text-align:center'>".$p->nilai_bahasa."</td>
                                            <td style='text-align:center'>".$p->kumulatif."</td>
                                            <td style='text-align:center'>".$p->ujian_agama."</td>
                                            <td style='text-align:center'>".$p->ujian_umum."</td>
                                            <td style='text-align:center'>".$p->ujian_bahasa."</td>
                                            <td style='text-align:center'>";
                                            if($p->pil_1==$j->kode_jurusan){
                                                echo "pilihan 1";
                                            }
                                            else{
                                                echo "pilihan 2";
                                            }
                                            echo "</td>
                                            <td style='text-align:center'><div id='lulus_2-$no'> ";
                                            if(($p->status=='lulus_pil_1') || ($p->status=='lulus_pil_2') || ($p->status=='lulus_pil_3')) {
                                                echo "lulus";
                                            }
                                            else{
                                                echo "Tidak lulus";
                                            }
                                            echo "</div></td>
                                            </tr>
                                             ";
                                           
                                        }
                                        $no++;
                                    }
                                  
                                    ?>
                                   
                                                   
                                        </tbody>
                                    </table>
                               
                                 
                                </div>

                                   <div id="tabs-3">
                                    
                                  <table class="table table-bordered" id="dyntable3" >
                                    <colgroup>
                                        <col class="con0" style="align: center; width: 4%" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                    </colgroup>
                                     <thead>
                                        <tr style="text-align:center">                                      
                                            <th class="head1"  style="text-align:center">No</th>
                                            <th class="head1"  style="text-align:center">No Pes</th>
                                            <th class="head1"  style="text-align:center">Nama</th>
                                
                                        </tr>
                                        
                                    
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no=1;
                                    foreach ($pendaftar3->result() as $p) {
                                    if(($no%2)!=0){
                                             echo "                                     
                                            <tr class='gradeX' style='background:#bde0e6'>
                                        <td>$no</td>
                                        <td>".$p->no_pes."</td>
                                        <td>".$p->nama."</td>                                        
                                        </tr>";
                                      }
                                      else {
                                         echo "                                     
                                            <tr class='gradeX' >
                                        <td>$no</td>
                                        <td>".$p->no_pes."</td>
                                        <td>".$p->nama."</td>                                        
                                        </tr>";
                                        
                                      }
                                         $no++;
                                    }
                                  
                                    ?>
                                   
                                                   
                                        </tbody>
                                    </table>
                               
                                 
                                </div>
                            </div>
                                      
                                
                                
                           
                        </div><!--widgetcontent-->
          </div><!--contentinner-->
        </div><!--maincontent-->
     </div><!--mainright-->
    <!-- END OF RIGHT PANEL -->
    <div class="clearfix"></div>