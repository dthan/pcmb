<div class="right_content">  
<script type="text/javascript" src="js/agenda.js"></script>
<h2>Agenda</h2>
<a href="tambah-agenda" class="bt_green"><span class="bt_green_lft"></span><strong>+Tambah agenda</strong><span class="bt_green_r"></span></a>

<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company">no</th>
			
            <th scope="col" class="rounded" align=center width=150>judul</th>
			<th scope="col" class="rounded" align=center width=100>deskripsi</th>
			<th scope="col" class="rounded" align=center width=100>waktu</th>
			<th scope="col" class="rounded" align=center width=100>tempat</th>
			
            <th scope="col" class="rounded-q4" align=center width=100>Aksi</th>
            
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="5" class="rounded-foot-left"><em>manajeman agenda mukhisina lahudiin</em></td>
        	<td class="rounded-foot-right">&nbsp;</td>

        </tr>
    </tfoot>
    <tbody>

    	<tr>
        	
			<?php
			    
							
				
				
				
					$p      = new PagingAgenda;
            $batas  = 3;
          $posisi = $p->cariPosisi($batas);
		  $no=1;
		  $bts=1;
		  if ($_GET['hal']=='1'){
		  $no=1;
		  }
		  else{
		   $no=$posisi+1;
		  }
		      
		  $x=mysql_query("select * from agenda order by id_agenda desc LIMIT $posisi,$batas");
		    
				while($data = mysql_fetch_array($x))
				{
					echo "<tr><td>".$no."</td><td>".$data['judul_agenda']."</td><td>".$data['deskripsi']."</td><td>".$data['waktu']."</td><td>".$data['tempat']."</td><td> &nbsp &nbsp <a href='edit-agenda-$data[id_agenda]-$_GET[hal]'><img src='images/user_edit.png' alt='' title='' border='0' /></a> &nbsp <a href='hapus.php?id=1' class='ask'><img src='images/trash.png' alt='' title='' border='0' /></a></td></tr>";
				  $no++;
				}
					
			?>
            
        </tr>
            
        
    </tbody>
</table>

	 
     
     
     
        <div class="pagination">
       <?php
		 $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM agenda"));
         $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
         $linkHalaman = $p->navHalaman($_GET['hal'], $jmlhalaman);

        echo " $linkHalaman <br /><br />";
       
        ?>
        </div> 
</div>