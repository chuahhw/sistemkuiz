<!--BorangKemaskiniTopik.php-->
<!--mengemaskini topik ke dalam sistem-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");
include("KepastianJenisPengguna.php");

//Dapatkan IDTopik dari paparan kemaskini topik
$IDTopik=$_GET['IDTopik'];

//Dapatkan semua butiran rekod sedia ada berdasarkan IDTopik
$sql="SELECT * FROM topik WHERE IDTopik='$IDTopik'";
$result=mysqli_query($sambung,$sql);
$row=mysqli_fetch_array($result);

$ButiranTopik=$row['ButiranTopik'];
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
			<tr><td>Borang Kemaskini Maklumat Topik</td></tr>
		</table>
		<br>
		<!--Borang Untuk Paparan data-->
		<form action="SemakTopik.php" method="GET">
			<table class="table1">
				<!--Paparan ID Topik-->
				<tr>
					<td>ID Topik</td>
					<td width="10">:</td>
					<td>
						<input style="text-align:center" type="text" name="IDTopik" READONLY value="<?php echo $IDTopik;?>"></input>
					</td>
					<td></td>
				</tr>
				<tr><td height="20px" colspan=4></td></tr>
				<!--Paparan Butiran Topik-->
				<tr>
					<td>Butiran Topik</td>
					<td>:</td>
					<td>
						<input style="text-align:center" type="text" name="ButiranTopik" required value="<?php echo $ButiranTopik;?>" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan 30 aksara yang terdiri daripada huruf, nombor atau ruang sahaja!')"></input>
					</td>
					<td></td>
				</tr>
				<tr>
					<td height="20px" colspan=3></td>
					<!--Butang Kemaskini-->
					<td style="text-align:right"><input type="submit" value="Kemaskini" class="button1" name="submit"></td>
				</tr>
			</table>
		</form>
	</body>
</html>

