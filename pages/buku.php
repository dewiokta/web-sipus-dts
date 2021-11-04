<div id="label-page"><h3>Tampil Data Buku</h3></div>
<div id="content">
	
	
	<table id="tabel-tampil">
		<tr>
			<th id="label-tampil-no">No</td>
			<th>ID Buku</th>
			<th>Judul</th>
			<th>Kategori</th>
			<th>Pengarang</th>
			<th>Penerbit</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		

		
		<?php
		$batas = 5;
		extract($_GET);
		if(empty($hal)){
			$posisi = 0;
			$hal = 1;
			$nomor = 1;
		}
		else {
			$posisi = ($hal - 1) * $batas;
			$nomor = $posisi+1;
		}	
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$pencarian = trim(mysqli_real_escape_string($db, $_POST['pencarian']));
			if($pencarian != ""){
				$sql = "SELECT * FROM tbbuku WHERE judulbuku LIKE '%$pencarian%'
						OR idbuku LIKE '%$pencarian%'
						OR pengarang LIKE '%$pencarian%'
						OR kategori LIKE '%$pencarian%'
                        OR penerbit LIKE '%$pencarian%'";
				
				$query = $sql;
				$queryJml = $sql;	
						
			}
			else {
				$query = "SELECT * FROM tbbuku LIMIT $posisi, $batas";
				$queryJml = "SELECT * FROM tbbuku";
				$no = $posisi * 1;
			}			
		}
		else {
			$query = "SELECT * FROM tbbuku LIMIT $posisi, $batas";
			$queryJml = "SELECT * FROM tbbuku";
			$no = $posisi * 1;
		}
		
		//$sql="SELECT * FROM tbanggota ORDER BY idanggota DESC";
		$q_tampil_anggota = mysqli_query($db, $query);
		if(mysqli_num_rows($q_tampil_anggota)>0)
		{
            while($r_tampil_anggota=mysqli_fetch_array($q_tampil_anggota)){
		?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $r_tampil_anggota['idbuku']; ?></td>
			<td><?php echo $r_tampil_anggota['judulbuku']; ?></td>
			<td><?php echo $r_tampil_anggota['kategori']; ?></td>
			<td><?php echo $r_tampil_anggota['pengarang']; ?></td>
			<td><?php echo $r_tampil_anggota['penerbit']; ?></td>
			<td><?php echo $r_tampil_anggota['status']; ?></td>
			<td>
				<div class="tombol-opsi-container"><a href="index.php?p=anggota-edit&id=<?php echo $r_tampil_anggota['idbuku'];?>" class="tombol">Edit</a></div>
				<div class="tombol-opsi-container"><a href="proses/anggota-hapus.php?id=<?php echo $r_tampil_anggota['idbuku']; ?>" onclick = "return confirm ('Apakah Anda Yakin Akan Menghapus Data Ini?')" class="tombol">Hapus</a></div>
			</td>			
		</tr>		
		<?php  $nomor++; }
        } 
		else {
			echo "<tr><td colspan=6>Data Tidak Ditemukan</td></tr>";
		}?>		
	</table>
	<?php
	if(isset($_POST['pencarian'])){
	if($_POST['pencarian']!=''){
		echo "<div style=\"float:left;\">";
		$jml = mysqli_num_rows(mysqli_query($db, $queryJml));
		echo "Data Hasil Pencarian: <b>$jml</b>";
		echo "</div>";
	}
	}
	else{ ?>
		<div style="float: left;">		
		<?php
			$jml = mysqli_num_rows(mysqli_query($db, $queryJml));
			echo "Jumlah Data : <b>$jml</b>";
		?>			
		</div>		
		<div class="pagination">		
				<?php
				$jml_hal = ceil($jml/$batas);
				for($i=1; $i<=$jml_hal; $i++){
					if($i != $hal){
						echo "<a href=\"?p=buku&hal=$i\">$i</a>";
					}
					else {
						echo "<a class=\"active\">$i</a>";
					}
				}
				?>
		</div>
	<?php
	}
	?>
</div>