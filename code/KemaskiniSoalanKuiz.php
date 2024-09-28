<!--KemaskiniSoalanKuiz.php-->
<!--mengemaskini soalan kuiz ke dalam sistem-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");
include("KepastianJenisPengguna.php");

//mengambil tarikh semasa dari komputer dan IDPengguna
$TarikhKemaskini=date('y/m/d');
$IDPengguna=$_SESSION['IDPengguna'];

//Dapatkan IDKuiz dan IDTopik dari paparan kemaskini kuiz
$IDKuiz=$_GET['IDKuiz'];
$IDTopik=$_GET['IDTopik'];

if(isset($_POST["submit"])){
	$IDTopik=$_POST['IDTopik'];
	$sql="UPDATE kuiz SET IDTopik='$IDTopik',IDPengguna='$IDPengguna',
			TarikhKemaskini='$TarikhKemaskini' WHERE IDKuiz='$IDKuiz'";
	$result=mysqli_query($sambung,$sql);
	if($result){
		echo"<script>alert
			('Tahniah! Rekod anda telah berjaya dikemaskini ke dalam sistem.');
			window.location='KemaskiniSoalanKuiz.php?IDKuiz=$IDKuiz&IDTopik=$IDTopik'</script>";
	}
}
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
			<tr><td>Kemaskini Maklumat Soalan Kuiz</td></tr>
		</table>
		<br>
		<!--Borang Untuk Paparan data-->
		<form name="KemaskiniSoalanKuiz" method="POST">
			<table class="table1">
				<!--Paparan ID Kuiz-->
				<tr>
					<td>ID Kuiz</td>
					<td width="10">:</td>
					<td>
						<input type="text" name="IDKuiz" READONLY value="<?php echo $IDKuiz;?>">
					</td>
					<td></td>
				</tr>
				<!--Paparan Butiran Topik-->
				<tr>
					<td>Butiran Topik</td>
					<td width="10">:</td>
					<td>
						<select name="IDTopik" required>
							<?php
								$sql1="SELECT * FROM topik";
								$result1=mysqli_query($sambung,$sql1);
								while($row1=mysqli_fetch_array($result1)){
									if($row1[IDTopik]==$IDTopik){
										echo"<option value='$row1[IDTopik]' selected> $row1[IDTopik] - $row1[ButiranTopik]</option>";
									}else{
										echo"<option value='$row1[IDTopik]'> $row1[IDTopik] - $row1[ButiranTopik]</option>";
										}
									}
							?>
						</select>
					</td>
					<td style="text-align:center">
						<input type="submit" value="Kemaskini" class="button1" name="submit">
					</td>
				</tr>
				<tr height="20px" colspan=3></tr>
			</table>
			<table class="table2" style="width:90%">
				<tr>
					<td>ID Soalan</td>
					<td>Butiran Soalan</td>
					<td colspan=2>Tindakan</td>
				</tr>
				<?php
					//Dapatkan semua data dari hasil carian
					$sql="SELECT * FROM soalan WHERE IDKuiz='$IDKuiz'";
					$result=mysqli_query($sambung,$sql);
					$no=0;
					if(mysqli_num_rows($result)==0){
						//ButiranTopik yang dicari tidak wujud
						echo"<tr><td colspan='4'>Tiada rekod dijumpai</td></tr>";
					}else{
						while ($row=mysqli_fetch_array($result)){
					?>
					<!--paparan data dari pangkalan data-->
				<tr>
					<td><?php echo $row['IDSoalan'];?></td>
					<td style="text-align:left"><?php echo $row['ButiranSoalan'];?></td>
					<td>
						<a href="BorangKemaskiniSoalanKuiz.php?IDSoalan=<?php echo $row['IDSoalan'];?>">Kemaskini </a>
					</td>
					<td>
						<a href="PengesahanHapusSoalanKuiz.php?IDSoalan=<?php echo $row['IDSoalan'];?>"> Hapus </a>
					</td>
				</tr>
				<?php
					$no++;
						}
					}
				?>
			</table>
			<table style="width:90%" class="table1">
				<tr>
					<td colspan="4">Tambah soalan? Klik
						<a href="BorangTambahSoalanKuiz.php?IDKuiz=<?php echo $IDKuiz;?>
							&IDTopik=<?php echo $IDTopik;?>">sini</a>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>