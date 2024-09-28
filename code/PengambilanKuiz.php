<!--PengambilanKuiz.php-->
<!--pengguna membuat kuiz ke dalam sistem-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");

//Dapatkan IDPengguna
$IDPengguna=$_SESSION['IDPengguna'];

//Dapatkan IDKuiz dari paparan halaman utama
$IDKuiz=$_GET['IDKuiz1'];

//Dapatkan semua butiran rekod sedia ada berdasarkan IDKuiz
$sql="SELECT * FROM kuiz INNER JOIN topik ON kuiz.IDTopik=topik.IDTopik WHERE kuiz.IDKuiz='$IDKuiz'";
$result=mysqli_query($sambung,$sql);
$row=mysqli_fetch_array($result);
$IDTopik=$row['IDTopik'];
$ButiranTopik=$row['ButiranTopik'];

//Jika borang dihantar, masuk data ke pangkalan data
if(isset($_POST["submit"])){
	$Markah=0;
	$BilSoalan=$_POST['BilSoalan'];
	
	//mengambil tarikh dan masa semasa dari komputer
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$TarikhPengambilan=date('y/m/d');
	$Masa=date('H:i');
	
	//menerima nilai pembolehubah
	$ArrayPilihan=$_POST['Pilihan'];
	
	//pengiraan markah
	for($i=0;$i<$BilSoalan;$i++){
		$Pilihan=$ArrayPilihan[$i];
		$Markah=$Markah+$Pilihan;
	}
	$JumlahMarkah=$Markah/$BilSoalan*100;
	
	//penentuan gred 
	$sql3="SELECT IDGred, MAX(MinMarkah) FROM gred WHERE MinMarkah<='$JumlahMarkah'";
	$result3=mysqli_query($sambung,$sql3);
	$row3=mysqli_fetch_array($result3);
	$IDGred=$row3['IDGred'];
	
	//simpan rekod baru pada jadual pengambilan kuiz
	$sql4="INSERT INTO pengambilankuiz (IDPengambilan, IDPengguna, IDKuiz, IDGred, TarikhPengambilan, Masa, JumlahMarkah)
		VALUES (NULL, '$IDPengguna', '$IDKuiz', '$IDGred','$TarikhPengambilan','$Masa','$JumlahMarkah')";
	$result4=mysqli_query($sambung,$sql4);
	
	//mesej berjaya hantar markah kuiz 
	echo"<script>alert
	('Taniah!Rekod anda telah berjaya dihantar.');
	window.location='HalamanUtama.php'</script>";
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
			<tr><td>Penilaian Kuiz</td></tr>
		</table>
		<br>
		<form method="POST">
			<table class="table1" width="60%">
				<!--Papar Butiran Topik-->
				<tr>
					<td>Butiran Topik</td>
					<td width="10">:</td>
					<td colspan=2>
						<input style="text-align:left;border-style:none" type="text" name="ButiranTopik" READONLY value="<?php echo $IDTopik."-".$ButiranTopik;?>"></td>
					</td>
				</tr>
				<!--Papar IDKuiz-->
				<tr>
					<td>ID Kuiz</td>
					<td>:</td>
					<td colspan=2>
						<input style="border-style:none" type="text" name="IDKuiz" READONLY value="<?php echo $IDKuiz;?>"></td>
					</td>
				</tr>
				<tr><td height=30 colspan=3></td></tr>
			</table>
			<table class="table1" width="60%">
					<!--Dapatkan semua data soalan daripada pangkalan data-->
					<?php
						$sql1="SELECT * FROM soalan WHERE IDKuiz='$IDKuiz'";
						$result1=mysqli_query($sambung,$sql1);
						$no=0;
						while($row1=mysqli_fetch_array($result1)){
							$IDSoalan=$row1['IDSoalan'];
					?>
					<tr>
						<td colspan="3">Soalan <?php echo $no+1;?></td>
					</tr>
					<tr>
						<td colspan="3">
							<?php echo $row1['ButiranSoalan'];?></textarea>
						</td>
					</tr>
					<tr>
						<td style="height:30" colspan="3"></td>
					</tr>
					<!--Dapatkan-->
					<?php
						$sql2="SELECT * FROM pilihan WHERE IDSoalan='$IDSoalan'";
						$result2=mysqli_query($sambung,$sql2);
						$i=0;
						while($row2=mysqli_fetch_array($result2)){
					?>
					<tr>
						<td style="text-align:center;width:50px">
							<input type="radio" name="Pilihan[<?php echo $no;?>]" value="<?php echo $row2['Markah'];?>"required>
						</td>
						<td colspan=2>
							<?php echo $row2['ButiranPilihan'];?></textarea>
						</td>
					</tr>
						<?php
						$i=$i+1;
						}
						?>
					<tr>
						<td style="height:50" colspan=3></td>
					</tr>
						<?php
						$no=$no+1;
						}
						?>
					<tr>
						<td style="text-align:right;" colspan="3">
							<input type="text" name="BilSoalan" value="<?php echo $no;?>" hidden>
							<input type="submit" value="Hantar" class="button1" name="submit">
						</td>
					</tr>
			</table>
		</form>
	</body>
</html>