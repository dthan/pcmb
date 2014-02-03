<div class="right_content">  
<h2>Pengajar</h2>
 <script language="javascript" type="text/javascript" src="http://localhost/mukhlisin/admin/js/jquery.form.js"></script>
 <script language="javascript" type="text/javascript" src="http://localhost/mukhlisin/admin/js/pengajar.js"></script>

 <a href="tambah-pengajar" id="tambah_berita" class="bt_green"><span class="bt_green_lft"></span><strong>+Tambah Pengajar</strong><span class="bt_green_r"></span></a>

<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company">no</th>
            <th scope="col" class="rounded" align=center width=150>Nama Pengajar</th>
			<th scope="col" class="rounded" align=center width=100>Alamat</th>
            <th scope="col" class="rounded" align=center>TTL</th>			
            <th scope="col" class="rounded-q4" align=center>Aksi</th>
           
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="4" class="rounded-foot-left"><em>pengajar mukhisina lahudiin</em></td>
        	<td class="rounded-foot-right">&nbsp;</td>

        </tr>
    </tfoot>
    <tbody>
	    <?php
		$p      = new PagingPengajar;
        $batas  = 5;
        $posisi = $p->cariPosisi($batas);
		  $x=mysql_query("SELECT * from pengajar order by id_pengajar desc LIMIT $posisi,$batas");
		  $no=1;
		    if ($_GET['hal']=='1'){
		  $no=1;
		  }
		  else{
		   $no=$posisi+1;
		  }
		  while ($r=mysql_fetch_array($x)){
		  $tgl=tgl_indo($r['tgl_lahir']);
		echo "
    	<tr>
        	<td>$no</td>
            <td>$r[nama_lengkap]</td>
			<td align=center>$r[alamat]</td>
            <td align=center>$r[tempat_lahir],$tgl</td>
			<td align=center><a href='edit_pengajar-$r[id_pengajar]' class='edit_form'>
			<img src='images/user_edit.png' alt='' title='' border='0'/></a> &nbsp;&nbsp;
            <a href='isi/hapus_pengajar.php?id=$r[id_pengajar]' class='ask' value='$r[id_pengajar]'><img src='images/trash.png' alt='' title='' border='0' /></a></td>
        </tr> ";
            
         $no++;
		 }
		?>
    </tbody>
</table>

	 
  
     
        <div class="pagination">
       <?php
		 $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM pengajar"));
         $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
         $linkHalaman = $p->navHalaman($_GET['hal'], $jmlhalaman);

        echo " $linkHalaman <br /><br />";
       
        ?>
        </div> 


</div>