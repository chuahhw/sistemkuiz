<!--PendaftaranPengguna.php-->
<!--pengguna baru mendaftar diri-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");

if(isset($_POST["submit"])){
	$IDPengguna=$_POST['IDPengguna'];
	$NamaPengguna=$_POST['NamaPengguna'];
	$KataLaluan=$_POST['KataLaluan'];
	$JenisPengguna=$_POST['JenisPengguna'];
	$Kelas=$_POST['Kelas'];

	//Pengguna guru tidak boleh daftar jika mengisi data kelas
	if($JenisPengguna=='Guru' && $Kelas!=''){
		echo "<script>alert('Maaf, pendaftaran gagal. Guru tidak boleh mempunyai kelas.');
		</script>";
	}
	//Pengguna murid tidak boleh daftar jika tidak mengisi data kelas
	else if($JenisPengguna=='Murid' && $Kelas==""){
		echo "<script>alert('Maaf, pendaftaran gagal. Murid perlu mempunyai kelas.');
		</script>";
	}
	else{
		$sql="SELECT * FROM pengguna WHERE IDPengguna='$IDPengguna'";
		$result= mysqli_query($sambung,$sql);
	
		if(mysqli_num_rows($result)==1){
			echo "<script>alert('Maaf, pendaftaran gagal. IDPengguna yang anda masuki mungkin telah guna. Sila tukar IDPengguna dan cuba lagi.');
			window.location='PendaftaranPengguna.php'</script>";
		}
		else{
			$sql1="INSERT INTO PENGGUNA (IDPengguna, NamaPengguna, KataLaluan, JenisPengguna, Kelas)
					VALUES ('$IDPengguna', '$NamaPengguna', '$KataLaluan', '$JenisPengguna', '$Kelas')";
			$result1= mysqli_query($sambung,$sql1);
			if($result1){
					echo "<script>alert('Tahniah! Anda telah berjaya mendaftar. ');
						window.location='Index.php'</script>";
			}
		}
	}
}
?>
<html>
	<head>
	<title>Kuiz</title>
		<?php
		include("Header.php");
		include("HeaderColorButton.php");
		?>
	</head>

	<body>
		<table class="table3">
			<tr><td>Pendaftaran Pengguna Baharu</td></tr>
		</table>
		<br>
		<form name="pendaftaranpengguna" method="POST">
			<table class="table1">
				<!--Masuk data IDPengguna-->
				<tr>
					<td>ID Pengguna</td>
					<td width="10">:</td>
					<td>
						<input type="text" name="IDPengguna" required placeholder="Contoh: 17001"
						pattern="[0-9a-zA-Z]{0,5}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan 5 aksara yang terdiri daripada nombor dan huruf sahaja!')">
					</td>
				</tr>
				<!--Masuk data NamaPengguna-->
				<tr>
					<td>Nama Pengguna</td>
					<td>:</td>
					<td>
						<input type="text" name="NamaPengguna" required placeholder="Contoh: May"
						pattern="[0-9a-zA-Z ]{0,30}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan 30 aksara yang terdiri daripada nombor dan huruf sahaja!')">
					</td>
				</tr>
				<!--Masuk Kata Laluan-->
				<tr>
					<td>Kata Laluan</td>
					<td>:</td>
					<td>
						<input type="password" name="KataLaluan" required
						pattern=".{0,15}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan 15 aksara sahaja!')">
					</td>
				</tr>
				<!--Pilih JenisPengguna-->
				<tr>
					<td>Jenis Pengguna</td>
					<td>:</td>
					<td>
						<select name="JenisPengguna" required>
							<option value="">--Pilih Jenis Pengguna--</option>
							<option value="Guru">Guru</option>
							<option value="Murid">Murid</option>
					</td>
				</tr>
				<!--Masuk Kelas-->
				<tr>
					<td>Kelas</td>
					<td>:</td>
					<td>
						<input type="text" name="Kelas" placeholder="Contoh: S5A"
						pattern="[0-9a-zA-Z]{0,3}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan 3 aksara yang terdiri daripada nombor dan huruf sahaja!')">
					</td>
				</tr>
				<tr><td height="20px" colspan="3"></td></tr>
				<tr>
					<td colspan=3 style="text-align:right">
						<!--Butang Kembali-->
						<input type="button" class="button1" value="Kembali" onclick="window.location.href='Index.php'">
						<!--Butang Daftar-->
						<input type="submit" class="button1" value="Daftar" name="submit">
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>