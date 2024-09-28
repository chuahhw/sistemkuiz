<!--KemaskiniTopik.php-->
<!--mengemaskini topik ke dalam sistem-->
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
			<tr><td>Kemaskini Maklumat Topik</td></tr>
		</table>
		<br>
		<form name="CariButiranTopik" method="POST">
			<table class="table1">
				<!--Carian dengan mengguna Butiran Topik-->
				<tr>
					<td align="right">Butiran Topik</td>
					<td width="10">:</td>
					<td><input type="text" name="ButiranTopik"  required placeholder="Contoh: Imbuhan"
						pattern="[0-9a-zA-Z ]{0,30}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan maksimum 30 aksara yang terdiri daripada huruf, nombor atau ruang sahaja!')"></td>
					<td><input type="submit" value="Cari" class="button1" name="submit"></td>
				</tr>
			</table>
		</form>
			<!--Kandungan jadual-->
			<table style="width:90%" class="table2">
				<tr>
					<td>ID Topik</td>
					<td>Butiran Topik</td>
					<td colspan=2>Tindakan</td>
				</tr>
							
				<?php
					if(isset($_POST['submit'])){
						//Dapatkan semua data dari hasil carian
						$ButiranTopik=$_POST['ButiranTopik'];
						$sql="SELECT * FROM topik WHERE ButiranTopik LIKE '%$ButiranTopik%'";
					}
					else{
						//Dapatkan semua data dari pangkalan data
						$sql="SELECT * FROM topik";
					}
					
					$result=mysqli_query($sambung,$sql);
						
					if(mysqli_num_rows($result)==0){
						//ButiranTopik yang dicari tidak wujud dalam sistem
						$ButiranTopik='';
				?>
					<tr>
						<td colspan=4>Tiada rekod dijumpai</td>
					</tr>
					<?php
						}else{
						while ($row= mysqli_fetch_array($result)){
					?>
					<!--paparan data dari pangkalan data-->
						<tr>
							<td><?php echo $row['IDTopik'];?></td>
							<td><?php echo $row['ButiranTopik'];?></td>
							<td>
								<a href="BorangKemaskiniTopik.php?IDTopik=
									<?php echo $row['IDTopik'];?>"> Kemaskini </a>
							</td>
							<td>
								<a href="PengesahanHapusTopik.php?IDTopik=
									<?php echo $row['IDTopik'];?>"> Hapus </a>
							</td>
						</tr>
				<?php
						}
					}
				?>
			</table>
	</body>
</html>
