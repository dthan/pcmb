<script src="<?php echo base_url(); ?>asset/admin/js/seleksi.js"></script>
 <div class="pagetitle">
            <h1>Hasil Seleksi</h1> <span>data peserta hasil seleksi</span>
        </div><!--pagetitle-->
        <div class="maincontent">
            <div class="contentinner">
              <center id="loading" style="display:none"><img src="<?php echo base_url()."asset/img/loaders/ajax-loader.gif"; ?>"/>loading</center>   
           
                        <input type="hidden" id="root" value="<?php echo base_url();?>">
                        <div class="widgetcontent">
                         <h4 class="widgettitle">Daftar Jurusan dan jumlah pendaftar
                           <?php echo "<div style='float:right'><a href='".base_url()."seleksi/reset'>reset</a> || <a href='".base_url()."seleksi/do_seleksi' style='text-decoration:none'><img src='".base_url()."asset/images/seleksi.png' width='25' style='float:left' />seleksi semua</a></div>"; ?>
                         </h4>
                         
                             <div id="tabs">
                                <ul>
                                    <li><a href="#tabs-1">Seleksi</a></li>
                                    <li><a href="#tabs-2">Peserta lulus</a></li>
                                    <li><a href="#tabs-3">Peserta tidak Lulus</a></li>

                                    
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
                                            <th class="head0">No</th>
                                            <th class="head1" style='text-align:center' >Jurusan</th>
                                            <th class="head1" style='text-align:center'>Jumlah pendaftar pilihan 1</th>
                                            <th class="head1" style='text-align:center'>Jumlah pendaftar pilihan 2</th>
                                            <th class="head1" style='text-align:center'>Kuota</th>
                                            <th class="head1" style='text-align:center'>Terisi</th>
                                            <th class="head1" style='text-align:center'>Status</th>
                                            <th class="head1" style='text-align:center'>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no=1;
                                    foreach ($jurusan->result() as $j) {
                                      if(($no%2)!=0){
                                      echo "<tr class='gradeX' style='background:#bde0e6'>
                                        <td>$no</td>
                                        <td>".$j->nama_jurusan."</td>
                                        <td style='text-align:center'><b>".$j->pil_1."</b></td>
                                        <td style='text-align:center'><b>".$j->pil_2."</b></td>
                                        <td style='text-align:center'><b>".$j->kuota."</b></td>
                                        <td style='text-align:center'><b>".$j->terisi."</b></td>
                                        <td style='text-align:center'>";
                                        if($j->seleksi=='sudah') echo "sudah";
                                        else echo "<b style='color:red'>belum seleksi</b>";
                                        echo"</td>
                                         <td><a href='".base_url()."seleksi/jurusan/".$j->kode_jurusan."' style='text-decoration:none' onclick='do_seleksi(".$j->kode_jurusan.")'><img src='".base_url()."asset/images/seleksi.png' width='25' style='float:left'/>seleksi</a></td>
                                     </tr>";
                                      }
                                      else{
                                         echo "<tr class='gradeX'>
                                        <td>$no</td>
                                        <td>".$j->nama_jurusan."</td>
                                        <td style='text-align:center'><b>".$j->pil_1."</b></td>
                                        <td style='text-align:center'><b>".$j->pil_2."</b></td>
                                        <td style='text-align:center'><b>".$j->kuota."</b></td>
                                        <td style='text-align:center'><b>".$j->terisi."</b></td>
                                        <td style='text-align:center'>";
                                        if($j->seleksi=='sudah') echo "sudah";
                                        else echo "<b style='color:red'>belum seleksi</b>";
                                        echo"</td>
                                         <td><a href='".base_url()."seleksi/jurusan/".$j->kode_jurusan."' style='text-decoration:none' onclick='do_seleksi(".$j->kode_jurusan.")'><img src='".base_url()."asset/images/seleksi.png' width='25' style='float:left'/>seleksi</a></td>
                                        </tr>";
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
                                        <tr>                                      
                                            <th class="head0">No</th>
                                            <th class="head1" style='text-align:center' >no peserta</th>
                                            <th class="head1" style='text-align:center' >Nama</th>
                                            <th class="head1" style='text-align:center'>Jurusan</th>
                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no=1;
                                    foreach ($lulus->result() as $j) {
                                       if(($no%2)!=0){
                                        echo "<tr class='gradeX' style='background:#bde0e6'>
                                        <td>$no</td>
                                        <td>".$j->no_pes."</td>
                                        <td>".$j->nama."</td>
                                        <td >".$j->jurusan."</td>                                       
                                        </tr>";
                                        }
                                        else{
                                              echo "<tr class='gradeX' >
                                        <td>$no</td>
                                        <td>".$j->no_pes."</td>
                                        <td>".$j->nama."</td>
                                        <td >".$j->jurusan."</td>                                       
                                        </tr>"; 
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
                                            <th class="head0">No</th>
                                            <th class="head1" style='text-align:center' >No Peserta</th>
                                            <th class="head1" style='text-align:center' >Nama</th>
                                            <th class="head1" style='text-align:center'>pilihan 1</th>
                                            <th class="head1" style='text-align:center'>pilihan 2</th>
                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no=1;
                                    foreach ($tidak->result() as $j) {
                                     if(($no%2)!=0){
                                        echo "<tr class='gradeX' style='background:#bde0e6'>
                                        <td>$no</td>
                                        <td>".$j->no_pes."</td>
                                        <td>".$j->nama."</td>
                                        <td>".$j->pilihan1."</td>
                                        <td>".$j->pilihan2."</td>
                                        
                                        </tr>";
                                    }
                                    else {
                                        echo "<tr class='gradeX' style='background:#bde0e6'>
                                        <td>$no</td>
                                        <td>".$j->no_pes."</td>
                                        <td>".$j->nama."</td>
                                        <td>".$j->pilihan1."</td>
                                        <td>".$j->pilihan2."</td>                                        
                                        </tr>";
                                     
                                    }
                                     $no++;
                                    }
                                    ?>
                                     
                                                   
                                        </tbody>
                                    </table>
                                    </div>
                               
                               
                                
                           
                        </div><!--widgetcontent-->
          </div><!--contentinner-->
        </div><!--maincontent-->
     </div><!--mainright-->
    <!-- END OF RIGHT PANEL -->
    <div class="clearfix"></div>