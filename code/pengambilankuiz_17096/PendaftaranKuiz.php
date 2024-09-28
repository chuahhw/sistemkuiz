<!--PendaftaranKuiz.php-->
<!--mendaftar kuiz ke dalam sistem-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");
include("KepastianJenisPengguna.php");

//Jika borang dihantar, masuk data ke pangkalan data
if(isset($_POST["submit"])){
	$IDKuiz=$_POST['IDKuiz'];
	$IDTopik=$_POST['IDTopik'];
	$BilSoalan=$_POST['BilSoalan'];
	
	//semak IDKuiz dengan rekod sedia ada
	$sql="SELECT IDKuiz FROM kuiz WHERE IDKuiz='$IDKuiz'";
	$result= mysqli_query($sambung,$sql);

	if(mysqli_num_rows($result)==1){
		//papar jika maklumat IDKuiz sudah terdaftar
		echo "<script>alert('Maaf. Rekod anda gagal ditambah ke dalam sistem. Data yang dimasukkan telah ulang. Sila cuba lagi.');
		window.location='PendaftaranKuiz.php';</script>";
	}
	else{
		//pergi ke halaman pendaftaran soalan kuiz
		header("location: PendaftaranSoalanKuiz.php?IDKuiz=$IDKuiz&IDTopik=$IDTopik&BilSoalan=$BilSoalan");
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
		<script>
			function PengesahanBilSoalan(){
				var BilSoalan=document.getElementsByName("BilSoalan")[0].value;
				if(BilSoalan==0 && BilSoalan!=''){
					alert('Harap maaf! Sila pastikan BilSoalan mempunyai minimum 1 soalan.');
					document.getElementsByName("BilSoalan")[0].value='';
				}
			}
		</script>
	</head>

	<body>
		<table class="table3">
			<tr><td>Pendaftaran Maklumat Kuiz</td></tr>
		</table>
		<br>
		<form name="pendaftarankuiz" method="POST">
			<table class="table1">
				<tr>
				<!--Masukkan IDKuiz-->
					<td>ID Kuiz</td>
					<td width="10">:</td>
					<td>
						<input type="text" name="IDKuiz" required placeholder="Contoh: A01"
						pattern="[0-9a-zA-Z ]{0,10}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan 10 aksara yang terdiri daripada huruf, ruang atau nombor sahaja!')">
					</td>
					<td></td>
				</tr>
				<tr><td height="20px" colspan=4></td></tr>
				<!--Pilih ID Topik-->
				<tr>
					<td>ID Topik</td>
					<td>:</td>
					<td>
						<select name="IDTopik" required>
							<option value="">--Pilih Topik--</option>
							<?php
								$sql="SELECT * FROM topik";
								$result=mysqli_query($sambung,$sql);
								while($row=mysqli_fetch_array($result)){
									echo "<option value='$row[IDTopik]'>$row[IDTopik] $row[ButiranTopik]</option>";
								}
							?>
						</select>
					</td>
					<td></td>
				</tr>
				<tr><td height="20px" colspan=4></td></tr>
				<!--Masukkan Bilangan Soalan yang perlu-->
				<tr>
					<td>Bilangan Soalan Aneka Pilihan</td>
					<td>:</td>
					<td>
						<input onkeyup="PengesahanBilSoalan()" type="text" name="BilSoalan" required placeholder="Contoh: 1"
						pattern="[0-9]{0,10}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan nombor 0-9 sahaja!')">
					</td>
					<td></td>
				</tr>
				<tr>
					<td height=20px colspan=3></td>
					<td style="text-align:right"><input type="submit" value="Hantar" class="button1" name="submit"></td>
				</tr>
			</table>
		</form>
	</body>
</html>