<script src="<?php echo base_url(); ?>asset/admin/js/absen.js"></script>
 <div class="pagetitle">
            <h1>Peserta</h1> <span>data peserta yang telah daftar pcmb</span>
        </div><!--pagetitle-->
        <div class="maincontent">
            <div class="contentinner">
           <center id="loading" style="display:none"><img src="<?php echo base_url()."asset/img/loaders/ajax-loader.gif"; ?>"/>loading</center>   
            
                     <input type="hidden" id="ruang_tes" value="<?php echo $id_ruang_tes; ?>">
                       <div id="tabs">
                                <ul>
                                    <li><a href="#tabs-1">Tes Agama</a></li>
                                    <li><a href="#tabs-2">Tes Umum</a></li>
                                    <li><a href="#tabs-3">Tes Bahasa</a></li>
                                    <li><a href="#tabs-4">Tes Wawancara</a></li>
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
                                        <tr>                                            
                                            <th class="head0 nosort"><input type="checkbox" class="checkall" id="cek" /></th>
                                            <th class="head0">Nama</th>
                                            <th class="head1">Pilihan 1</th>
                                            <th class="head1">Pilihan 2</th>
                                            <th class="head1">Hadir</th>
                                        </tr>
                                    </thead>
                                    <input type="hidden" id="root" value="<?php echo base_url();?>">
                                    <tbody>
                                    <?php
                                    $no=1;

                                    foreach ($peserta->result() as $p) {
                                      echo "
                                        <tr class='gradeX'>                                          
                                          <td class='aligncenter'  ><span class='center'>
                                            <input type='checkbox' id='agama-$no' name='agama-$no' value='".$p->no_pes."'";
                                            if($p->ujian_agama=='Y'){
                                                echo "checked";
                                            }
                                            echo " onclick='absen(".$p->no_pes.",$no,1)'/>
                                          </span></td>
                                            <td>".$p->nama."</td>
                                            <td>".$p->pilihan1."</td>
                                            <td>".$p->pilihan2."</td>";
                                            if($p->ujian_agama=='Y'){
                                             echo "<td><div id='hadir_agama-$no'>hadir</div></td>";
                                            }
                                            else{
                                              echo "<td><div id='hadir_agama-$no'>Tidak hadir</div></td>";
                                            }
                                            echo "
                                         </tr>";
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
                                        <tr>
                                            
                                            <th class="head0 nosort"><input type="checkbox" class="checkall2" id="cek" /></th>
                                            <th class="head0">Nama</th>
                                            <th class="head1">Pilihan 1</th>
                                            <th class="head1">Pilihan 2</th>
                                            <th class="head1">Hadir</th>
                                        </tr>
                                    </thead>
                                    <input type="hidden" id="root" value="<?php echo base_url();?>">
                                    <tbody>
                                    <?php
                                    $no=1;
                                    foreach ($peserta->result() as $p) {
                                      echo "
                                        <tr class='gradeX'>
                                          
                                          <td class='aligncenter'  ><span class='center'>
                                            <input type='checkbox' id='umum-$no' name='umum-$no' value='".$p->no_pes."'";
                                           if($p->ujian_umum=='Y'){
                                                echo "checked";
                                            }
                                             echo " onclick='absen(".$p->no_pes.",$no,2)'/>
                                          </span></td>
                                            <td>".$p->nama."</td>
                                            <td>".$p->pilihan1."</td>
                                            <td>".$p->pilihan2."</td>";

                                            if($p->ujian_umum=='Y'){
                                             echo "<td><div id='hadir_umum-$no'>hadir</div></td>";
                                            }
                                            else{
                                              echo "<td><div id='hadir_umum-$no'>Tidak hadir</div></td>";
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
                                        <tr>
                                            
                                            <th class="head0 nosort"><input type="checkbox" class="checkall3" id="cek" /></th>
                                            <th class="head0">Nama</th>
                                            <th class="head1">Pilihan 1</th>
                                            <th class="head1">Pilihan 2</th>
                                            <th class="head1">Hadir</th>
                                        </tr>
                                    </thead>
                                    <input type="hidden" id="root" value="<?php echo base_url();?>">
                                    <tbody>
                                    <?php
                                    $no=1;
                                    foreach ($peserta->result() as $p) {
                                      echo "
                                        <tr class='gradeX'>
                                          
                                          <td class='aligncenter'  ><span class='center'>
                                            <input type='checkbox' id='bahasa-$no' name='umum-$no' value='".$p->no_pes."'";
                                             if($p->ujian_bahasa=='Y'){
                                                echo "checked";
                                            }
                                             echo " onclick='absen(".$p->no_pes.",$no,3)'/>
                                          </span></td>
                                            <td>".$p->nama."</td>
                                            <td>".$p->pilihan1."</td>
                                            <td>".$p->pilihan2."</td>";
                                           if($p->ujian_bahasa=='Y'){
                                             echo "<td><div id='hadir_bahasa-$no'>hadir</div></td>";
                                            }
                                            else{
                                              echo "<td><div id='hadir_bahasa-$no'>Tidak hadir</div></td>";
                                            }
                                            echo "
                                         </tr>";
                                         $no++;
                                    }
                                    ?>                    
                                    </tbody>
                                </table>
                                </div>

                                <div id="tabs-4">
                                     <table class="table table-bordered" id="dyntable4" >
                                    <colgroup>
                                        <col class="con0" style="align: center; width: 4%" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            
                                            <th class="head0 nosort"><input type="checkbox" class="checkall4" id="cek" /></th>
                                            <th class="head0">Nama</th>
                                            <th class="head1">Pilihan 1</th>
                                            <th class="head1">Pilihan 2</th>
                                            <th class="head1">Hadir</th>
                                        </tr>
                                    </thead>
                                    <input type="hidden" id="root" value="<?php echo base_url();?>">
                                    <tbody>
                                    <?php
                                    $no=1;
                                    foreach ($peserta->result() as $p) {
                                      echo "
                                        <tr class='gradeX'>
                                          
                                          <td class='aligncenter'  ><span class='center'>
                                            <input type='checkbox' id='wawancara-$no' name='umum-$no' value='".$p->no_pes."'";
                                             if($p->wawancara=='Y'){
                                                echo "checked";
                                            }
                                             echo " onclick='absen(".$p->no_pes.",$no,4)'/>
                                          </span></td>
                                            <td>".$p->nama."</td>
                                            <td>".$p->pilihan1."</td>
                                            <td>".$p->pilihan2."</td>";
                                           if($p->wawancara=='Y'){
                                             echo "<td><div id='hadir_wawancara-$no'>hadir</div></td>";
                                            }
                                            else{
                                              echo "<td><div id='hadir_wawancara-$no'>Tidak hadir</div></td>";
                                            }
                                            echo "
                                         </tr>";
                                         $no++;
                                    }
                                    ?>                    
                                    </tbody>
                                </table>
                                </div>
                                
                            </div><!--#tabs-->
          </div><!--contentinner-->
        </div><!--maincontent-->
     </div><!--mainright-->
    <!-- END OF RIGHT PANEL -->
    <div class="clearfix"></div>