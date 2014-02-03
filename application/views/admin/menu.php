<body id="isi">

<div class="mainwrapper">
    
    <!-- START OF LEFT PANEL -->
    <div class="leftpanel">
        
        <div class="logopanel">
            <h1><a href="dashboard.html">PCMB admin </a></h1>
        </div><!--logopanel-->
        
        <div class="datewidget"><b><?php echo $this->tanggal->tgl_indo(date("Y-m-d")); ?></b></div>
    
       <!--  <div class="searchwidget">
            <form action="results.html" method="post">
                <div class="input-append">
                    <input type="text" class="span2 search-query" placeholder="Search here...">
                    <button type="submit" class="btn"><span class="icon-search"></span></button>
                </div>
            </form>
        </div><!--searchwidget--> 
        

        
        <div class="leftmenu">        
            <ul class="nav nav-tabs nav-stacked">
                <li class="nav-header">Menu</li>
                <?php 
                if($level=='admin'){
                ?>
                <li <?php if($posisi=='home') echo "class='active'"; ?>><a href="<?php echo base_url()."admin/"; ?>"><span class="icon-align-justify"></span>Dashboard</a></li>
                <li <?php if(($posisi=='peserta') || ($posisi=='edit_peserta')) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>peserta"><span class="icon-th-list"></span>Manage Peserta</a></li>
                <li <?php if($posisi=='berita')  echo "class='active'"; ?>><a href="<?php echo base_url(); ?>berita/list_berita"><span class="icon-th-list"></span>Manage Berita</a></li>
                <li <?php if($posisi=='ruang_tes') echo "class='active'"; ?>><a href="<?php echo base_url(); ?>./ruang_tes"><span class="icon-th-list"></span>Manage Ruang Tes</a></li>
                <li <?php if($posisi=='gedung') echo "class='active'"; ?>><a href="<?php echo base_url(); ?>./gedung"><span class="icon-th-list"></span>Manage Gedung</a></li>
                <li <?php if($posisi=='pengawas') echo "class='active'"; ?>><a href="<?php echo base_url(); ?>./data_pengawas"><span class="icon-th-list"></span>Manage Pengawas</a></li>
                <li <?php if($posisi=='fakultas') echo "class='active'"; ?>><a href="<?php echo base_url(); ?>./fakultas"><span class="icon-th-list"></span>Manage Fakultas </a></li>
                <li <?php if($posisi=='jurusan') echo "class='active'"; ?>><a href="<?php echo base_url(); ?>./jurusan"><span class="icon-th-list"></span>Manage Jurusan</a></li>
                <li <?php if($posisi=='sekolah') echo "class='active'"; ?>><a href="<?php echo base_url(); ?>./sekolah"><span class="icon-th-list"></span>Manage Sekolah</a></li>
                <li <?php if($posisi=='hasil_tes') echo "class='active'"; ?>><a href="<?php echo base_url(); ?>./hasil_tes"><span class="icon-th-list"></span>Manage Hasil Tes</a></li>
                <li <?php if($posisi=='seleksi') echo "class='active'"; ?>><a href="<?php echo base_url(); ?>./seleksi"><span class="icon-th-list"></span>Manage Seleksi</a></li>
                <li <?php if($posisi=='report') echo "class='active'"; ?>><a href="<?php echo base_url(); ?>./report"><span class="icon-th-list"></span>Manage Report</a></li>
                <?php
                }
                else {
                ?>
                <li <?php if($posisi=='absen') echo "class='active'"; ?>><a href="<?php echo base_url(); ?>pengawas/absen"><span class="icon-th-list"></span>Absen Peserta</a></li>
                <?php 
                }
                ?>
            </ul>
        </div><!--leftmenu-->
        
    </div><!--mainleft-->

   <div class="rightpanel">
        <div class="headerpanel">
            <a href="" class="showmenu"></a>
            
            <div class="headerright">
              <!--   <div class="dropdown notification">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="/page.html">
                        <span class="iconsweets-globe iconsweets-white"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-header">Notifications</li>
                        <li>
                            <a href="">
                            <strong>3 people viewed your profile</strong><br />
                            <img src="img/thumbs/thumb1.png" alt="" />
                            <img src="img/thumbs/thumb2.png" alt="" />
                            <img src="img/thumbs/thumb3.png" alt="" />
                            </a>
                        </li>
                        <li><a href=""><span class="icon-envelope"></span> New message from <strong>Jack</strong> <small class="muted"> - 19 hours ago</small></a></li>
                        <li><a href=""><span class="icon-envelope"></span> New message from <strong>Daniel</strong> <small class="muted"> - 2 days ago</small></a></li>
                        <li><a href=""><span class="icon-user"></span> <strong>Bruce</strong> is now following you <small class="muted"> - 2 days ago</small></a></li>
                        <li class="viewmore"><a href="">View More Notifications</a></li>
                    </ul>
                </div><!--dropdown-->
                
                <div class="dropdown userinfo">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="/page.html">Hi, <?php
                     echo $username; 
                     ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                     
                        <li><a href="<?php 
                        if($level=='admin'){
                        echo base_url()."admin/logout"; 
                        }
                        else {
                            echo base_url()."pengawas/logout"; 
                        }
                         ?>"><span class="icon-off"></span> Sign Out</a></li>
                        
                    </ul>
                </div><!--dropdown-->
            
            </div><!--headerright-->
            
        </div><!--headerpanel-->
        <div class="breadcrumbwidget">
            <ul class="skins">
              
                <li>&nbsp;</li>
                <li class="fixed"><a href="" class="skin-layout fixed"></a></li>
                <li class="wide"><a href="" class="skin-layout wide"></a></li>
            </ul><!--skins-->
            <ul class="breadcrumb">
                 <?php
                     echo $bread;
                 ?>
                
            </ul>
        </div><!--breadcrumbs-->
      

    <!-- END OF LEFT PANEL -->
    
