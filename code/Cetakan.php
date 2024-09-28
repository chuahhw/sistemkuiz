<!--Cetakan.php-->
<!--Guru mencetak laporan-->
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

	<body>
		<table class="table3">
			<tr><td>Cetakan</td></tr>
		</table>
		<br>
		<table class="table1">
		<!--Borang untuk mendapat Laporan Prestasi Individu Murid-->
		<form action="LaporanPrestasiIndividu.php" method="GET">
			<tr>
				<td colspan=4>Laporan Prestasi Individu Murid</td>
			</tr>
			<tr>
				<td style="height:20px" colspan=4></td>
			</tr>
			<!--Cari mengguna IDPengguna-->
			<tr>
				<td>ID Pengguna</td>
				<td>:</td>
				<td>
					<input type="text" name="IDPengguna"required placeholder="Contoh: 17001"
					pattern="[0-9a-zA-Z ]{0,10}" oninput="this.setCustomValidity('')"
					oninvalid="this.setCustomValidity('Sila masukkan 10 aksara sahaja!')"></input>
				</td>
				<td><input type="submit" value="Cari" class="button1" name="submit"></input></td>
			</tr>
			<tr>
				<td style="height:50px" colspan=4></td>
			</tr>
		</form>
		<!--Borang untuk mendapat Laporan Prestasi Keseluruhan Murid-->
		<form action="LaporanKeseluruhan.php?" method="GET">
			<tr>
				<td colspan=4>Laporan Prestasi Keseluruhan Murid</td>
			</tr>
			<tr>
				<td style="height:20px" colspan=4></td>
			</tr>
			<!--Pilih Topik-->
			<tr>								
				<td>Topik</td>
				<td>:</td>
				<td>
					<select name="IDTopik" required>
						<option value="">--Pilih Topik--</option>
							<?php	
								$sql="SELECT * FROM topik";
								$result=mysqli_query($sambung,$sql);
								while($row=mysqli_fetch_array($result)){
									echo"<option value='$row[IDTopik]'>$row[IDTopik]-$row[ButiranTopik]</option>";
								}
							?>
					</select>
				</td>
				<td rowspan="2" style="text-align:center">
					<input type="submit" class="button1" value="Cari"></input>
				</td>
			</tr>
			<!--Pilih Kelas-->
			<tr>
				<td>Kelas</td>
				<td>:</td>
				<td>
					<select name="Kelas" required>
						<option value="">--Pilih Kelas--</option>
							<?php	
								$sql1="SELECT * FROM pengguna WHERE JenisPengguna='Murid' GROUP BY Kelas";
								$result1=mysqli_query($sambung,$sql1);
								while($row1=mysqli_fetch_array($result1)){
									echo"<option value='$row1[Kelas]'>$row1[Kelas]</option>";
								}
							?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="height:50px" colspan=4></td>
			</tr>
		</form>
			<!--Laporan Prestasi Murid Berdasarkan Kelas-->
			<tr>
				<td colspan=4>Laporan Prestasi Murid Berdasarkan Kelas</td>
			</tr>
			<tr>
				<td style="height:20px" colspan=4></td>
			</tr>
			<!--Pilih Kelas-->
			<tr>
				<td>Kelas</td>
				<td>:</td>
				<td>
					<select name="Kelas" onchange="window.location.href=this.value">
						<option value="">--Pilih Kelas--</option>
						<option value="LaporanKelas.php?Kelas=Semua">Semua</option>
							<?php
								$sql2="SELECT * FROM pengguna WHERE JenisPengguna='Murid' GROUP BY Kelas";
								$result2=mysqli_query($sambung,$sql2);
								while($row2=mysqli_fetch_array($result2)){
								echo"<option value='LaporanKelas.php?Kelas=$row2[Kelas]'>$row2[Kelas]</option>";
								}
							?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="height:50px" colspan=4></td>
			</tr>
			<!--Edaran Soalan-->
			<tr>
				<td colspan=4>Edaran Soalan</td>
			</tr>
			<tr>
				<td style="height:20px" colspan=4></td>
			</tr>
			<!--Pilih IDKuiz-->
			<tr>
				<td>ID Kuiz</td>
				<td>:</td>
				<td>
					<select name="IDKuiz" onchange="window.location.href=this.value">
						<option value="">--Pilih Kuiz--</option>
						<?php
							$sql3="SELECT * FROM kuiz";
							$result3=mysqli_query($sambung,$sql3);
							while($row3=mysqli_fetch_array($result3)){
							echo"<option value='EdaranSoalan.php?IDKuiz=$row3[IDKuiz]'>$row3[IDKuiz]</option>";
							}
						?>
					</select>
				</td>
			<tr>
				<td style="height:20px" colspan=4></td>
			</tr>
			</tr>
		</table>
	</body>
</html>