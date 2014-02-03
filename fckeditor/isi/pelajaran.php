<div class="right_content">  
<h2>Pelajaran</h2>
 <script language="javascript" type="text/javascript" src="http://localhost/mukhlisin/admin/js/jquery.form.js"></script>
 <script language="javascript" type="text/javascript" src="http://localhost/mukhlisin/admin/js/berita.js"></script>

 <a href="tambah-pelajaran" id="tambah_berita" class="bt_green"><span class="bt_green_lft"></span><strong>+Tambah Pelajaran</strong><span class="bt_green_r"></span></a>

<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company">no</th>
            <th scope="col" class="rounded" align=center width=150>Mata Pelajaran</th>
			<th scope="col" class="rounded" align=center width=100>kelas</th>
            <th scope="col" class="rounded" align=center>Pengajar</th>			
            <th scope="col" class="rounded-q4" align=center>Aksi</th>
           
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="4" class="rounded-foot-left"><em>mata pelajaran mukhisina lahudiin</em></td>
        	<td class="rounded-foot-right">&nbsp;</td>

        </tr>
    </tfoot>
    <tbody>
	    <?php
		$p      = new PagingPelajaran;
        $batas  = 2;
        $posisi = $p->cariPosisi($batas);
		  $x=mysql_query("SELECT m.id_matapelajaran,m.nama as `pelajaran`, k.nama as kelas, p.nama_lengkap as pengajar
						  FROM mata_pelajaran m, kelas k, pengajar p
						  WHERE m.id_kelas = k.id_kelas
						  AND m.id_pengajar = p.id_pengajar order by m.id_matapelajaran desc LIMIT $posisi,$batas");
		  $no=1;
		    if ($_GET['hal']=='1'){
		  $no=1;
		  }
		  else{
		   $no=$posisi+1;
		  }
		  
		  while ($r=mysql_fetch_array($x)){
		echo "
    	<tr>
        	<td>$no</td>
            <td>$r[pelajaran]</td>
			<td align=center>$r[kelas]</td>
            <td align=center>$r[pengajar]</td>
			<td align=center><a href='edit_pelajaran-$r[id_matapelajaran]' class='edit_form'>
			<img src='images/user_edit.png' alt='' title='' border='0'/></a> &nbsp;&nbsp;
            <a href='isi/hapus_berita.php?id=$r[id_matapelajaran]' class='ask' value='$r[id_matapelajaran]'><img src='images/trash.png' alt='' title='' border='0' /></a></td>
        </tr> ";
            
         $no++;
		 }
		?>
    </tbody>
</table>

	 
  
     
        <div class="pagination">
       <?php
		 $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM mata_pelajaran"));
         $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
         $linkHalaman = $p->navHalaman($_GET['hal'], $jmlhalaman);

        echo " $linkHalaman <br /><br />";
       
        ?>
        </div> 


</div>