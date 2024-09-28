<!--Index.php-->
<!--pengguna log masuk ke dalam sistem-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");

//jika butang submit ditekan dan nilai submit dimasuk
if(isset($_POST["submit"])){
	//mengumpukkan nilai input IDPengguna dan KataLaluan dalam borang ke dalam pembolehubah
	$IDPengguna=$_POST['IDPengguna'];
	$KataLaluan=$_POST['KataLaluan'];
	
	//membuat pernyataan terhadap pangkalan data untuk memperoleh data dari jadual pengguna
	$sql="SELECT * FROM pengguna WHERE IDPengguna='$IDPengguna' AND KataLaluan=BINARY '$KataLaluan'";
	$result= mysqli_query($sambung,$sql);
	$row= mysqli_fetch_array($result);
	
	if(mysqli_num_rows($result)==1){
		$_SESSION['IDPengguna']=$IDPengguna;
		$_SESSION['JenisPengguna']=$row['JenisPengguna'];
		//balik ke halaman utama
		header("Location: HalamanUtama.php");
	}
	else{
		//papar mesej gagal
		echo "<script>alert('Maaf. Anda gagal log masuk. Sila pastikan IDPengguna dan Kata Laluan yang anda masuki adalah betul.');
			window.location='Index.php'</script>";
		}
	}
?>
<html>
	<head>
		<title>Kuizzard Oz</title>
			<?php
			include("Header.php");
			include("HeaderColorButton.php");
			?>
	</head>

	<body>
		<table class="table3">
			<tr><td>Log Masuk</td></tr>
		</table>
		<br>
		<form name="logmasuk" method="POST">
			<table class="table1">
				<!--Isi IDPengguna-->
				<tr>
					<td>ID Pengguna</td>
					<td width="10">:</td>
					<td>
						<input type="text" name="IDPengguna" required placeholder="Contoh: 17001"></input>
					</td>
				</tr>
				<tr>
					<td style="height:5px" colspan="3"></td>
				</tr>
				<!--Isi KataLaluan-->
				<tr>
					<td>Kata Laluan</td>
					<td>:</td>
					<td>
						<input type="password" name="KataLaluan"></input>
					</td>
				</tr>
				<tr>
					<td style="height:5px" colspan="3"></td>
				</tr>
				<!--Pendaftaran Untuk Pengguna Baharu-->
				<tr>
					<td colspan="3" width="20">Pengguna baru? Klik <a href="PendaftaranPengguna.php">sini.</a></td>
				</tr>
				<tr>
					<!--Butang Log Masuk-->
					<td colspan="3" style="text-align:right"><input type="submit" value="Log Masuk" 
						class="button1" name="submit"></input></td>
				</tr>
			</table>
		</form>
	</body>
</html>