<!--LaporanPrestasiIndividu.php-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");
include("KepastianJenisPengguna.php");

$IDPengguna1=$_GET['IDPengguna'];
$sql="SELECT * FROM pengguna WHERE pengguna.IDPengguna='$IDPengguna1'";
$result=mysqli_query($sambung,$sql);

//Semak jika IDPengguna tidak wujud
if(mysqli_num_rows($result)==0){
	echo"<script>alert('Maaf, IDPengguna tidak wujud.')
		window.history.back();</script>";
}else{
	$row=mysqli_fetch_array($result);
	$NamaPengguna=$row['NamaPengguna'];
	$JenisPengguna=$row['JenisPengguna'];
	$Kelas=$row['Kelas'];

//Semak sama ada JenisPengguna ialah guru
if($JenisPengguna=='Guru'){
	echo"<script>alert('Maaf, IDPengguna yang dimasukkan tidak mempunyai laporan individu.')
		window.history.back();</script>";
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
		<script src="FunctionJS.js"></script>
	</head>

	<body>
		<table class="table1" style="width:100%">
			<table class="table3">
				<tr><td>Cetakan</td></tr>
			</table>
			<br>
			<tr>
				<td style="height:50px"></td>
			</tr>
			<tr>
				<td>
					<table class="table1">
						<form action="LaporanPrestasiIndividu.php" method="GET">
							<!--Carian mengguna IDPengguna-->
							<tr>
								<td>ID Pengguna</td>
								<td>:</td>
								<td><input onfocus="this.value=''" type="text" name="IDPengguna"></td>
								<td><input type="submit" value="Cari" class="button1"></td>
							</tr>
							<tr>
								<td style="height:20px" colspan=4></td>
							</tr>
						</form>
					</table>
				</td>
			</tr>
		</table>
		<hr>
		<div id="kandungan">
			<table style="width:100%">
				<tr>
					<td><?php include("Header.php");?></td>
				</tr>
				<tr>
					<td style="text-align:center; font-size:30px; background-color:#fcccfb">Laporan Prestasi Individu Murid</td>
				</tr>
				<tr>
					<td style="height:50px"></td>
				</tr>
			</table>
			<table class="table1" width="80%" border=1>
				<!--Papar IDPengguna-->
				<tr>
					<td width="150">ID Pengguna</td>
					<td width="10">:</td>
					<td><?php echo $IDPengguna1?></td>
				</tr>
				<!--Papar NamaPengguna-->
				<tr>
					<td>Nama Pengguna</td>
					<td>:</td>
					<td><?php echo $NamaPengguna?></td>
				</tr>
				<!--Papar Kelas-->
				<tr>
					<td>Kelas</td>
					<td>:</td>
					<td><?php echo $Kelas?></td>
				</tr>
				<tr><td colspan="3" height="10px"></td></tr>
					<?php
					$sql1="SELECT * FROM topik";
					$result1=mysqli_query($sambung,$sql1);
					if(mysqli_num_rows($result1)==0){
						//Tiada butiran topik dalam pangkalan data
						echo"<tr><td colspan='3'>Tiada rekod dijumpai</td></tr>";
					}else{
						while($row1=mysqli_fetch_array($result1)){
					?>
					<!--Papar ButiranTopik-->
					<tr>
						<td>Butiran Topik</td>
						<td>:</td>
						<td><?php echo $row1['ButiranTopik'];?></td>
					</tr>
					<!--Papar Mesej jika topik itu tiada kuiz-->
					<?php
					$sql2="SELECT * FROM kuiz WHERE IDTopik='$row1[IDTopik]'";
					$result2=mysqli_query($sambung,$sql2);
					if(mysqli_num_rows($result2)==0){
						?>
						<tr>
							<td colspan="3">Tiada kuiz bagi topik ini</td>
						</tr>
					<?php
					}
					while($row2=mysqli_fetch_array($result2)){
					?>
						
					<td style="height:30px" colspan="3"></td>
					<!--Papar IDKuiz-->
					<tr>
						<td>ID Kuiz</td>
						<td>:</td>
						<td><?php echo $row2['IDKuiz'];?></td>
					</tr>
					<tr>
						<td colspan="3">
							<!--Jadual ulangan rekod pengambilan kuiz-->
							<table class="table2" width="100%">
								<tr>
									<td width="15%">Tarikh Pengambilan</td>
									<td width="10%">Masa</td>
									<td width="25%">Jumlah Markah</td>
									<td width="15%">Gred</td>
									<td width="25%">Kenyataan</td>
								</tr>
								<?php
								$sql3="SELECT * FROM pengambilankuiz INNER JOIN gred ON gred.IDGred=pengambilankuiz.IDGred
										INNER JOIN kuiz ON kuiz.IDKuiz=pengambilankuiz.IDKuiz
										WHERE kuiz.IDKuiz='$row2[IDKuiz]' AND pengambilankuiz.IDPengguna='$IDPengguna1'
										ORDER BY TarikhPengambilan,Masa";
								$result3=mysqli_query($sambung,$sql3);
								if(mysqli_num_rows($result3)==0){
									echo"<tr><td colspan='5'>Tiada rekod dijumpai</td></tr>";
								}else{
									while($row3=mysqli_fetch_array($result3)){
										?>
								<tr>
									<td><?php echo $Date=date("j/n/Y",strtotime($row3['TarikhPengambilan']))?></td>
									<td><?php echo $Time=date("H:i",strtotime($row3['Masa']))?></td>
									<td><?php echo $row3['JumlahMarkah']?></td>
									<td><?php echo $row3['IDGred']?></td>
									<td><?php echo $row3['Kenyataan']?></td>
								</tr>
								
								<?php
									}
								}
								?>
							</table>
						</td>
					</tr>
				
				<?php
						}
						echo "<tr><td height='50px' colspan='3'></td></tr>";
						}
					}
			?>
			</table>
		</div>
		<table align="right">
			<tr>
				<td style="height:30" colspan="3"></td>
			</tr>
			<!--Cetak button-->
			<tr>
				<td style="text-align:right;" colspan="3"></td>
				<td><input type="submit" value="Cetak" class="button1" name="submit" onclick="printContent('kandungan')"></td>
			</tr>
			<tr>
				<td style="height:30" colspan="3"></td>
			</tr>
		</table>
	</body>
</html>