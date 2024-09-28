<!--KemaskiniGred.php-->
<!--mengemaskini gred ke dalam sistem-->
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
			<tr><td>Kemaskini Maklumat Gred</td></tr>
		</table>
		<br>
		<form name="CariButiranGred" method="POST">
			<table class="table1">
				<tr>
					<td align="right">ID Gred</td>
					<td width="10">:</td>
					<td><input type="text" name="IDGred"  required placeholder="Contoh: A"
						pattern="[0-9a-zA-Z ]{0,30}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan huruf A-F sahaja!')"></td>				
					<td><input type="submit" value="Cari" class="button1" name="submit"></td>
				</tr>
			</table>
		</form>
		<!--Kandungan jadual-->
		<table style="width:90%" class="table2">
			<tr>
				<td>ID Gred</td>
				<td>Min Markah</td>
				<td>Kenyataan</td>
				<td colspan=2>Tindakan</td>
			</tr>
							
			<?php
				if(isset($_POST['submit'])){
					//Dapatkan semua data dari hasil carian
					$IDGred=$_POST['IDGred'];
					$sql="SELECT * FROM gred WHERE IDGred LIKE '%$IDGred%'";
				}
				else{
					//Dapatkan semua data dari pangkalan data
					$sql="SELECT * FROM gred";
				}
						
				$result=mysqli_query($sambung,$sql);
						
				if(mysqli_num_rows($result)==0){
					//IDGred yang dicari tidak wujud dalam sistem
					$IDGred='';
			?>
				<tr><td colspan=4>Tiada rekod dijumpai</td></tr>
				<?php
					}else{
					while ($row= mysqli_fetch_array($result)){
				?>
					<!--paparan data dari pangkalan data-->
					<tr>
						<td><?php echo $row['IDGred'];?></td>
						<td><?php echo $row['MinMarkah'];?></td>
						<td><?php echo $row['Kenyataan'];?></td>
						<td>
							<a href="BorangKemaskiniGred.php?IDGred=
								<?php echo $row['IDGred'];?>"> Kemaskini </a>
						</td>
						<td>
							<a href="PengesahanHapusGred.php?IDGred=
								<?php echo $row['IDGred'];?>"> Hapus </a>
						</td>
					</tr>
			<?php
					}
				}
			?>
		</table>
	</body>
</html>
