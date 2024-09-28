<!--PendaftaranGred.php-->
<!--pengguna guru mendaftar gred ke dalam sistem-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");
include("KepastianJenisPengguna.php");

if(isset($_POST["submit"])){
	$IDGred=$_POST['IDGred'];
	$MinMarkah=$_POST['MinMarkah'];
	$Kenyataan=$_POST['Kenyataan'];
	
	$sql2="SELECT * FROM gred WHERE IDGred='$IDGred' OR MinMarkah=$MinMarkah OR Kenyataan='$Kenyataan'";
	$result2=mysqli_query($sambung,$sql2);
	
	if(mysqli_num_rows($result2)>0){
		//Papar jika kemaskini gagal
		echo "<script>alert('Maaf. Rekod anda gagal ditambah ke dalam sistem. Data yang dimasukkan telah ulang. Sila cuba lagi.');
		window.location='PendaftaranGred.php'</script>";
	}
	else{
		$sql1="INSERT INTO GRED (IDGred,MinMarkah,Kenyataan)
				VALUES ('$IDGred', '$MinMarkah','$Kenyataan')";
		$result1= mysqli_query($sambung,$sql1);
		if($result1){
				echo "<script>alert('Tahniah! Rekod anda telah berjaya tambah ke dalam sistem.');
					window.location='HalamanUtama.php'</script>";
		}
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
			<tr><td>Pendaftaran Maklumat Gred</td></tr>
		</table>
		<br>
		<form name="pendaftarangred" method="POST">
			<table class="table1">
				<tr>
					<!--Daftar IDGred-->
					<td>ID Gred</td>
					<td>:</td>
					<td>
						<input type="text" name="IDGred" required placeholder="Contoh: A"
						pattern="[A-F ]{1}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan huruf A-F sahaja!')">
					</td>
					<td></td>
				</tr>
				<tr><td height="20px" colspan=4></td></tr>
				<tr>
					<!--Daftar MinMarkah-->
					<td>Min Markah</td>
					<td>:</td>
					<td>
						<input type="text" name="MinMarkah" required placeholder="Contoh: 80"
						pattern="[0-99 ]{0,2}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan nombor 0 hingga 99 sahaja!')">
					</td>
					<td></td>
				</tr>
				<tr><td height="20px" colspan=4></td></tr>
				<tr>
					<!--Daftar Kenyataan-->
					<td>Kenyataan</td>
					<td>:</td>
					<td>
						<input type="text" name="Kenyataan" required placeholder="Contoh: Cemerlang"
						pattern="[a-zA-Z ]{0,10}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan 10 aksara yang terdiri daripada huruf dan ruang sahaja!')">
					</td>
					<td></td>
				</tr>
				<tr>
					<td height=20px colspan=3></td>
					<td style="text-align:right"><input type="submit" value="Daftar" class="button1" name="submit"></td>
				</tr>
			</table>
		</form>
	</body>
</html>
