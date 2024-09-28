<html>
	<head>
		<title>Daftar Ahli Bahru</title>
	</head>
	<body>
		<form action="ProsesDaftar.php" method="POST">
			<table border="0">
				<tr>
					<td style="background-color:#00FF00" align="center">Selamat Datang</td>
					<td style="background-color:#00FF00" align="center">Daftar Ahli Bahru</td>
				</tr>
				<tr>
					<td><img src="LogoKelab.png"></td>
					<td width="60%">
				</tr>
					<table>
						<tr>
							<td>Nama Pengguna</td>
							<td><input name="namapengguna" size="10" type="text"></td>
						</tr>
						<tr>
							<td>Kata Laluan</td>
							<td><input name="katalaluan" size="15" type="password"></td>
						</tr>
						<tr>
							<td>Jenis Keahlian</td>
							<select name="jenis">
								<option value="Ahli Biasa">Ahli Biasa</option>
								<option value="Pengerusi">Pengerusi</option>
								<option value="Pentadbir">Pentadbir</option>
							</select>
						</tr>
					</table>
				<tr>
					<td><input name="submit" type="submit" value="Daftar"></td>
				</tr>
			</table>
		</form>
	</body>
</html>
	