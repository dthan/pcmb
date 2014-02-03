<div class="right_content">  
<h2>Berita</h2>
 <script language="javascript" type="text/javascript" src="http://localhost/mukhlisin/admin/js/jquery.form.js"></script>
 <script language="javascript" type="text/javascript" src="http://localhost/mukhlisin/admin/js/berita.js"></script>

 <a href="tambah-berita" id="tambah_berita" class="bt_green"><span class="bt_green_lft"></span><strong>+Tambah Berita</strong><span class="bt_green_r"></span></a>

<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company">no</th>
            <th scope="col" class="rounded" align=center width=150>Judul</th>
			<th scope="col" class="rounded" align=center width=100>penulis</th>
            <th scope="col" class="rounded" align=center>tanggal</th>			
            <th scope="col" class="rounded-q4" align=center>Aksi</th>
           
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="4" class="rounded-foot-left"><em>berita mukhisina lahudiin</em></td>
        	<td class="rounded-foot-right">&nbsp;</td>

        </tr>
    </tfoot>
    <tbody>
	    <?php
		$p      = new PagingBerita;
        $batas  = 3;
        $posisi = $p->cariPosisi($batas);
		  $x=mysql_query("select * from berita order by tanggal desc LIMIT $posisi,$batas");
		  $no=1;
		  $bts=1;
		  if ($_GET['hal']=='1'){
		  $no=1;
		  }
		  else{
		   $no=$posisi+1;
		  }
		  
		  while ($r=mysql_fetch_array($x)){
		  $tgl=tgl_indo($r['tanggal']);
		echo "
    	<tr>
        	<td>$no</td>
            <td>$r[judul_berita]</td>
			<td align=center>$r[penulis]</td>
            <td align=center>$tgl</td>
			<td align=center><a href='edit_berita-$r[id_berita]-$_GET[hal]' class='edit_form'>
			<img src='images/user_edit.png' alt='' title='' border='0'/></a> &nbsp;&nbsp;
            <a href='isi/hapus_berita.php?id=$r[id_berita]' class='ask' value='$r[id_berita]'><img src='images/trash.png' alt='' title='' border='0' /></a></td>
        </tr> ";
            
         $no++;
		 
		
		 }
		?>
    </tbody>
</table>

        <div class="pagination">
		<?php
		 $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM berita"));
         $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
         $linkHalaman = $p->navHalaman($_GET['hal'], $jmlhalaman);

        echo " $linkHalaman <br /><br />";
       
        ?>
		</div> 


</div>