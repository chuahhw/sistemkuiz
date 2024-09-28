<!--KemaskniKuiz.php-->
<!--kemaskini maklumat kuiz ke dalam sistem-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");
include("KepastianJenisPengguna.php");
?>
<html>
	<head>
		<title>Kuizzard Oz</title>
			<?php
			include("Header.php");
			include("HeaderColorButton.php");
			include("HeaderButton.php");
			?>
	</head>

	<body>
		<table class="table3">
			<tr><td>Kemaskini Maklumat Kuiz</td></tr>
		</table>
		<br>
		<form name="CariIDKuiz" method="POST">
			<table class="table1">
				<tr>
					<td align="right">ID Kuiz</td>
					<td width="10">:</td>
					<td><input type="text" name="IDKuiz"  required placeholder="Contoh: A01"
						pattern="[0-9a-zA-Z ]{0,30}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan maksimum 30 aksara yang terdiri daripada huruf, nombor atau ruang sahaja!')"></td>		
					<td><input type="submit" value="Cari" class="button1" name="submit"></td>
				</tr>
			</table>
		</form>
		<!--Kandungan jadual-->
		<table style="width:90%" class="table2">
			<tr>
				<td>ID Kuiz</td>
				<td>Butiran Topik</td>
				<td>Tarikh Kemaskini</td>
				<td>Nama Pengguna</td>
				<td colspan="2">Tindakan</td>
			</tr>
							
			<?php
				if(isset($_POST['submit'])){
					//Dapatkan semua data dari hasil carian
					$IDKuiz=$_POST['IDKuiz'];
					$sql="SELECT * FROM kuiz INNER JOIN topik ON topik.IDTopik=kuiz.IDTopik 
							INNER JOIN pengguna ON pengguna.IDPengguna=kuiz.IDPengguna
							WHERE kuiz.IDKuiz LIKE '%$IDKuiz%'";
				}
				else{
					//Dapatkan semua data dari pangkalan data
					$sql="SELECT * FROM kuiz INNER JOIN topik ON topik.IDTopik=kuiz.IDTopik
							INNER JOIN pengguna ON pengguna.IDPengguna=kuiz.IDPengguna";
				}
						
				$result=mysqli_query($sambung,$sql);
				$no=1;
						
				if(mysqli_num_rows($result)==0){
					//ButiranTopik yang dicari tidak wujud dalam sistem
					$ButiranTopik='';
					echo "<tr><td colspan='6'>Tiada rekod dijumpai</td></tr>";
				}else{
					while ($row= mysqli_fetch_array($result)){
			?>
					<!--paparan data dari pangkalan data-->
				<tr>
					<td><?php echo $row['IDKuiz'];?></td>
					<td><?php echo $row['ButiranTopik'];?></td>
					<td><?php echo $Date=date("j/n/Y",strtotime($row['TarikhKemaskini']));?></td>
					<td><?php echo $row['NamaPengguna'];?></td>
					<td>
						<a href="KemaskiniSoalanKuiz.php?IDKuiz=<?php echo $row['IDKuiz'];?>
						&IDTopik=<?php echo $row['IDTopik'];?>"> Kemaskini </a>
					</td>
					<td>
						<a href="PengesahanHapusKuiz.php?IDKuiz=<?php echo $row['IDKuiz'];?>
						&IDTopik=<?php echo $row['IDTopik'];?>"> Hapus </a>
					</td>
				</tr>
			<?php
					}
				}
			?>
		</table>
	</body>
</html>