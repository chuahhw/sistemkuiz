<!--HalamanUtama.php-->
<!--halaman utama selepas pengguna berjaya log masuk ke dalam sistem-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");
?>

<html>
	<head>
		<title>Kuizzard Oz</title>
			<?php
			include("Header.php");
			include("HeaderColorButton.php");
			include("HeaderButton.php");
			?>
			<!--Kod untuk pembesaran dan pengecilan perkataan di halaman utama-->
			<script>
				function resizeText(multiplier){
					var intro = document.getElementById("intro");
						if(intro.style.fontSize == "") {
							intro.style.fontSize= "25px";
						}
					intro.style.fontSize = parseFloat(intro.style.fontSize) + (multiplier*2) + "px";
				}
			</script>
	</head>

	<!--Kandungan-->
	<body>
		<table class="table3">
			<tr><td>Menu Utama</td></tr>
		</table>
		<br>
		<!--Kata-kata pengenalan tentang kuiz-->
		<table style="width:100%" class="table1">
			<tr>
				<td style="width:15%" rowspan="3"></td>
				<td style="text-align:left;width:50%;font-size:35px">
					<p id="intro">Selamat datang! Inilah Kuizzard Oz.
					<br><br>Di sini anda boleh:
					<br> •	Membuat kuiz Bahasa Melayu
					<br> •	Menyemak jawapan, mengira markah dan menentukan gred
					<br> •	Menjana laporan markah pencapaian
					</p>
				</td>
				<td style="width:30%" rowspan=5><img src="Menupic.jpg" alt="Menupic" width="200" height="140"></td>
			</tr>
		</table>
		<table class="table1" align="right" style="padding-right:30px">
			<!--Butang tukar saiz tulisan-->
			<tr>
				<td><input type="submit" style="font-size:20px" class="button1" value="A" onclick="resizeText(1)"/></input></td>
				<td><input type="submit" style="font-size:20px" class="button1" value="a" onclick="resizeText(-1)"/></input></td>
			</tr>
		</table>
	</body>
</html>
