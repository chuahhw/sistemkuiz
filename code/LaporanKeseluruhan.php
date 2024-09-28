<!--LaporanKeseluruhan.php-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");
include("KepastianJenisPengguna.php");
$IDTopik=$_GET['IDTopik'];
$Kelas=$_GET['Kelas'];
?>

<html>
	<head>
		<title>Kuizzard Oz</title>
			<?php
				include('Header.php');
				include('HeaderColorButton.php');
				include('HeaderButton.php');
			?>
		<script src="FunctionJS.js"></script>
	</head>

	<!--Kandungan-->
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
						<form action="LaporanKeseluruhan.php?" method="GET">
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
													if($IDTopik==$row['IDTopik']){
														echo"<option value='$row[IDTopik]' selected>$row[IDTopik]-$row[ButiranTopik]</option>";
													}else{
														echo"<option value='$row[IDTopik]'>$row[IDTopik]-$row[ButiranTopik]</option>";
													}
												}
											?>
									</select>
								</td>
								<td rowspan="2" style="text-align:center">
									<input type="submit" class="button1" value="Cari">	
								</td>
							</tr>
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
												if($Kelas==$row1['Kelas']){
													echo"<option value='$row1[Kelas]' selected>$row1[Kelas]</option>";
												}else{
													echo"<option value='$row1[Kelas]'>$row1[Kelas]</option>";
												}
											}
											?>
									</select>
								</td>
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
			<table class="table1" style="width:100%">
				<tr>
					<td><?php include("Header.php");?></td>
				</tr>
				<tr>
					<td style="text-align:center; font-size:30px; background-color:#fcccfb">Laporan Prestasi Keseluruhan Murid</td>
				</tr>
				<tr>
					<td style="height:50px"></td>
				</tr>
			</table>
			<!--Jadual ulangan kuiz-->
			<table style="width:90%" class="table1">
				<?php
					$sql4="SELECT * FROM pengguna WHERE Kelas='$Kelas' GROUP BY Kelas";
					$result4=mysqli_query($sambung,$sql4);
					while($row4=mysqli_fetch_array($result4)){
				?>
					<!--Papar kelas-->
					<tr>
						<td width="20%">Kelas</td>
						<td width="1%">:</td>
						<td><?php echo $row4['Kelas'];?></td>
					</tr>
				<?php
					$sql2="SELECT * FROM topik WHERE IDTopik='$IDTopik'";
					$result2=mysqli_query($sambung,$sql2);
					while($row2=mysqli_fetch_array($result2)){
				?>
					<!--Papar ButiranTopik-->
					<tr>
						<td width="20%">Butiran Topik</td>
						<td width="1%">:</td>
						<td><?php echo $row2['IDTopik'];?>-<?php echo $row2['ButiranTopik'];?></td>
					</tr>
				<tr>
					<td colspan="3" style="height:20px"></td>
				</tr>
				<tr>
					<td colspan='3'>
						<!--Jadual ulangan rekod pengambilan kuiz-->
						<table class="table2" style="width:90%">
							<tr>
								<td>ID Kuiz</td>
								<td>ID Pengguna</td>
								<td>Nama Pengguna</td>
								<td>Tarikh Pengambilan</td>
								<td>Masa</td>
								<td>Jumlah Markah</td>
								<td>Gred</td>
							</tr>
							<?php
							$sql5="SELECT * FROM kuiz INNER JOIN pengambilankuiz ON pengambilankuiz.IDKuiz=kuiz.IDKuiz
									INNER JOIN pengguna ON pengguna.IDPengguna=pengambilankuiz.IDPengguna
									WHERE IDTopik='$row2[IDTopik]' AND Kelas='$row4[Kelas]'
									ORDER BY pengguna.NamaPengguna, pengambilankuiz.TarikhPengambilan";
							$result5=mysqli_query($sambung,$sql5);
							if(mysqli_num_rows($result5)==0){
								echo"<tr><tr><td colspan='7'>Tiada rekod dijumpai</td></tr></tr>";
							}else{
								while($row5=mysqli_fetch_array($result5)){
							?>
							<tr>
								<td><?php echo $row5['IDKuiz']?></td>
								<td><?php echo $row5['IDPengguna']?></td>								
								<td><?php echo $row5['NamaPengguna']?></td>
								<td><?php echo $Date=date("j/n/Y",strtotime($row5['TarikhPengambilan']))?></td>
								<td><?php echo $Time=date("H:i",strtotime($row5['Masa']))?></td>
								<td><?php echo $row5['JumlahMarkah']?></td>
								<td><?php echo $row5['IDGred']?></td>
							</tr>
							
							<?php
								}
							}
							?>
						</table>
						<table>
							<tr>
								<td style="height:20px"></td>
							</tr>
						</table>
						<?php
							}
							}
						?>
					</td>
				</tr>
			</table>
		</div>
		<table align="right" class="table1">
			<tr>
				<td style="height:30" ></td>
			</tr>
			<!--Butang Cetak-->
			<tr>
				<td style="text-align:right">
					<input type="submit" value="Cetak" class="button1" name="submit" onclick="printContent('kandungan')">
				</td>
			</tr>
			<tr>
				<td style="height:30" ></td>
			</tr>
		</table>
	</body>
</html>