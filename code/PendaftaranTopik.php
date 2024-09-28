<!--PendaftaranTopik.php-->
<!--pengguna guru mendaftar topik-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");
include("KepastianJenisPengguna.php");

if(isset($_POST["submit"])){
	$IDTopik=$_POST['IDTopik'];
	$ButiranTopik=$_POST['ButiranTopik'];
	
	$sql="SELECT * FROM topik WHERE IDTopik='$IDTopik' OR ButiranTopik='$ButiranTopik'";
	$result= mysqli_query($sambung,$sql);

	if(mysqli_num_rows($result)>0){
		echo "<script>alert('Maaf. Rekod anda gagal ditambah ke dalam sistem. Data yang dimasukkan telah ulang. Sila cuba lagi.');
		window.location='PendaftaranTopik.php';</script>";
	}
	else{
		$sql1="INSERT INTO topik (IDTopik,ButiranTopik) VALUES('$IDTopik', '$ButiranTopik')";
		$rs= mysqli_query($sambung,$sql1);

		if($rs){
				echo "<script>alert('Tahniah! Rekod anda telah berjaya tambah ke dalam sistem.');
					window.location='HalamanUtama.php';</script>";
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
			<tr><td>Pendaftaran Maklumat Topik</td></tr>
		</table>
		<br>
		<form name="pendaftaranpengguna" method="POST">
			<table class="table1">
				<!--Insert IDTopik-->
				<tr>
					<td>ID Topik</td>
					<td width="10">:</td>
					<td>
						<input type="text" name="IDTopik" required placeholder="Contoh: T01"
						pattern="[0-9a-zA-Z]{0,3}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan maksimum 3 aksara yang terdiri daripada huruf atau nombor sahaja!')">
					</td>
					<td></td>
				</tr>
				<tr><td height="20px" colspan=4></td></tr>
				<!--Insert ButiranTopik-->
				<tr>
					<td>Butiran Topik</td>
					<td>:</td>
					<td>
						<input type="text" name="ButiranTopik" required placeholder="Contoh: Imbuhan"
						pattern="[0-9a-zA-Z ]{0,30}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan 30 aksara yang terdiri daripada huruf, nombor atau ruang sahaja!')">
					</td>
					<td></td>
				</tr>
				<tr>
					<td height="20px" colspan=3></td>
					<td colspan=3 style="text-align:right"><input type="submit" value="Daftar" class="button1" name="submit"></td>
				</tr>
			</table>
		</form>
	</body>
</html>

