<!--Import.php-->
<!--Pengguna import data ke dalam sistem-->
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

	<!--kandungan-->
	<body>
		<table class="table3">
			<tr><td>Import</td></tr>
		</table>
		<br>
		<!--Pilih lokasi fail csv-->
		<form action="Importcsv.php" method="POST" name="upload_excel"
		enctype="multipart/form-data">
			<table class="table1" width="70%">
				<tr>
					<td>Pilih lokasi File CSV: </td>
				</tr>
				<tr>
					<td style="height:30px"></td>
				</tr>
				<tr>
					<td>
						<input type="file" name="file" id="file" required>
					</td>
				</tr>
				<tr>
					<td style="height:30px"></td>
				</tr>
				<!--Butang Import-->
				<tr>
					<td style="text-align:right">
						<input type="submit" class="button1" value="Muat Naik"
							name="Import" id="Import"/>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>