<div class="right_content">  
<h2>Siswa</h2>
<a href="tambah-siswa" class="bt_green"><span class="bt_green_lft"></span><strong>+Tambah Siswa</strong><span class="bt_green_r"></span></a>

<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company"></th>
            <th scope="col" class="rounded" align=left width=100>NIS</th>
			<th scope="col" class="rounded" align=left width=150>Nama Lengkap</th>
            <th scope="col" class="rounded" align=left width=100>Alamat</th>			
            <th scope="col" class="rounded-q4" align=left width=50>Aksi</th>
           
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="4" class="rounded-foot-left"><em>Siswa web mukhlisina lahudiin</em></td>
        	<td class="rounded-foot-right">&nbsp;</td>

        </tr>
    </tfoot>
    <tbody>
    	<tr>
        	<?php
				$p      = new PagingSiswa;
                $batas  = 2;
                $posisi = $p->cariPosisi($batas);
							
				$query = "select * from siswa order by id_siswa desc limit $posisi,$batas";
				$query_jalan = mysql_query($query);
				 $no=1;
		         $bts=1;
		         if ($_GET['hal']=='1'){
		         $no=1;
		          }
		        else{
		        $no=$posisi+1;
		        }
				while($data = mysql_fetch_array($query_jalan))
				{
					echo "<tr><td>$no</td><td>".$data['nis']."</td><td>".$data['nama_lengkap'].
						 "</td><td>".$data['alamat']."</td><td><a href='edit_siswa-$data[id_siswa]-$posisi''><img src='images/user_edit.png' 
						 alt='' title='' border='0' align='center' /></a><a href='isi/hapus_siswa.php?id=$data[id_siswa]&posisi=$posisi' class='ask'><img src='images/trash.png' alt='' title='' border='0' align='center' /></a></td></tr>";
				   $no++;
				}
					
			?>
        </tr>
            
        
    </tbody>
</table>

	 
     
     
     
        <div class="pagination">
        <?php
		 $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM siswa"));
         $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
         $linkHalaman = $p->navHalaman($_GET['hal'], $jmlhalaman);

        echo " $linkHalaman <br /><br />";
       
        ?>
        </div> 
</div>