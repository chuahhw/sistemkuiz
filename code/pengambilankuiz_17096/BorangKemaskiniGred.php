<!--BorangKemaskiniGred.php-->
<!--mengemaskini gred ke dalam sistem-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");
include("KepastianJenisPengguna.php");

//Dapatkan IDTopik dari paparan kemaskini topik
$IDGred=$_GET['IDGred'];

//Dapatkan semua butiran rekod sedia ada berdasarkan IDTopik
$sql="SELECT * FROM gred WHERE IDGred='$IDGred'";
$result=mysqli_query($sambung,$sql);
$row=mysqli_fetch_array($result);

$MinMarkah=$row['MinMarkah'];
$Kenyataan=$row['Kenyataan'];
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
			<tr><td>Borang Kemaskini Maklumat Gred</td></tr>
		</table>
		<br>
		<!--Borang Untuk Paparan data-->
		<form action="SemakGred.php" method="GET">
			<table class="table1">
				<!--Paparan ID Gred-->
				<tr>
					<td>ID Gred</td>
					<td width="10">:</td>
					<td>
						<input style="text-align:center" type="text" name="IDGred" READONLY value="<?php echo $IDGred;?>"></input>
					</td>
					<td></td>
				</tr>
				<tr><td height="20px" colspan=4></td></tr>
				<!--Paparan Min Markah-->
				<tr>
					<td>Min Markah</td>
					<td>:</td>
					<td>
						<input style="text-align:center" type="text" name="MinMarkah" required value="<?php echo $MinMarkah;?>" pattern="[0-99 ]{0,2}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan nombor 0 hingga 99 sahaja!')"></input>
					</td>
					<td></td>
				</tr>
				<tr><td height="20px" colspan=4></td></tr>
				<!--Paparan Kenyataan-->
				<tr>
					<td>Kenyataan</td>
					<td>:</td>
					<td>
						<input style="text-align:center" type="text" name="Kenyataan" required value="<?php echo $Kenyataan;?>" pattern="[a-zA-Z ]{0,10}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan 10 aksara yang terdiri daripada huruf dan ruang sahaja!')"></input>
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
