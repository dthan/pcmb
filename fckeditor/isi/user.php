<div class="right_content">  
<h2>User</h2>
<a href="tambah-user" class="bt_green"><span class="bt_green_lft"></span><strong>+Tambah User</strong><span class="bt_green_r"></span></a>

<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company"></th>
            <th scope="col" class="rounded" align=left width=100>username</th>
			<th scope="col" class="rounded" align=left width=150>nama lengkap</th>
            <th scope="col" class="rounded" align=left width=100>email</th>			
            <th scope="col" class="rounded-q4" align=left width=50>Aksi</th>
           
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="4" class="rounded-foot-left"><em>manajemen user web mukhlisina lahudiin</em></td>
        	<td class="rounded-foot-right">&nbsp;</td>

        </tr>
    </tfoot>
    <tbody>
    	<tr>
        	<?php
				$p      = new PagingUser;
                $batas  = 5;
                $posisi = $p->cariPosisi($batas);
				$query = "select * from user order by id_user desc limit $posisi,$batas";
				$query_jalan = mysql_query($query);
				$no=1;
				 if ($_GET['hal']=='1'){
		         $no=1;
		         }
		         else{
		         $no=$posisi+1;
		         }
				while($data = mysql_fetch_array($query_jalan))
				{
				  
					echo "<tr><td>$no</td><td>".$data['username']."</td><td>".$data['nama_lengkap'].
						 "</td><td>".$data['email']."</td><td><a href='edit_user-$data[id_user]'><img src='images/user_edit.png' 
						 alt='' title='' border='0' align='center' /></a><a href='isi/hapus_user.php?id=$data[id_user]&hal=$_GET[hal]' class='ask'><img src='images/trash.png' alt='' title='' border='0' align='center' /></a></td></tr>";
				  $no++;
				}
					
			?>
        </tr>
            
        
    </tbody>
</table>

	 
     
     
     
        <div class="pagination">
        <?php
		 $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM user"));
         $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
         $linkHalaman = $p->navHalaman($_GET['hal'], $jmlhalaman);

        echo " $linkHalaman <br /><br />";
       
        ?>
        </div> 
</div>