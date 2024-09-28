<!--LaporanKelas.php-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");
include("KepastianJenisPengguna.php");
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
				<td colspan=4>
					<table class="table1">
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
											if($Kelas==$row2['Kelas']){
												echo"<option value='LaporanKelas.php?Kelas=$row2[Kelas]' selected>$row2[Kelas]</option>";
											}else{
												echo"<option value='LaporanKelas.php?Kelas=$row2[Kelas]'>$row2[Kelas]</option>";
											}
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td style="height:20px" colspan="3"></td>
						</tr>
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
						<td style="text-align:center; font-size:30px; background-color:#fcccfb">Laporan Prestasi Murid Berdasarkan Kelas</td>
					</tr>
					<tr>
						<td style="height:50px"></td>
					</tr>
				</table>
					<!--Jadual ulangan berdasarkan kelas-->
				<table style="width:90%" class="table1">
					<?php
						if($Kelas=='Semua'){
							$sql1="SELECT * FROM pengguna WHERE JenisPengguna='Murid' GROUP BY Kelas";
						}else{
							$sql1="SELECT * FROM pengguna WHERE Kelas='$Kelas' GROUP BY Kelas";
						}
						$result1=mysqli_query($sambung,$sql1);
						if(mysqli_num_rows($result1)==0){
							//Tiada Kelas dalam pangkalan data
							echo"<tr><td>Tiada rekod dijumpai</td></tr>";
						}
							while($row1=mysqli_fetch_array($result1)){
					?>
							<tr>
								<td>
									<table style="width:90%" class="table1">
										<!--Papar Kelas-->
										<tr>
											<td width="10%">Kelas</td>
											<td width="1%">:</td>
											<td><?php echo $row1['Kelas']?></td>
										</tr>
										<?php
											$sql2="SELECT * FROM topik";
											$result2=mysqli_query($sambung,$sql2);
											while($row2=mysqli_fetch_array($result2)){
										?>
										<!--Papar ButiranTopik-->
										<tr>
											<td width="20%">Butiran Topik</td>
											<td width="1%">:</td>
											<td><?php echo $row2['IDTopik']."-".$row2['ButiranTopik'];?></td>
										</tr>
										<tr>
											<td colspan="3">
												<!--Jadual ulangan rekod pengambilan kuiz-->
												<table style="width:100%" class="table2">
												<?php
													$sql3="SELECT * FROM kuiz WHERE IDTopik='$row2[IDTopik]'";
													$result3=mysqli_query($sambung,$sql3);
														
													if(mysqli_num_rows($result3)==0){?>
														<tr>
															<td rowspan="2">ID Pengguna</td>
															<td rowspan="2">Nama Pengguna</td>
															<td colspan="2">Kuiz</td>
														</tr>
															<td>Markah Purata</td>
															<td>Gred Purata</td>
														</tr>
															<td colspan="4">Tiada kuiz bagi topik ini</td>
														</tr>
														<?php
															}else{
														?>
															<tr>
																<td rowspan="2">ID Pengguna</td>
																<td rowspan="2">Nama Pengguna</td>
																<?php
																	$no=0;
																	$no1=1;
																	while($row3=mysqli_fetch_array($result3)){
																?>
																	<td colspan="2">Kuiz <?php echo $no+1; ?></td>
																<?php
																	$no=$no+1;
																	$no1=$no1+1;
																}
																?>
															</tr>
														<tr>
															<?php
																$i=1;
																while($no1>$i){
															?>
																<td>Purata</td>
																<td>Gred</td>
															<?php
																$i=$i+1;
																}
															?>
														</tr>
						
						<!--data murid dalam setiap kelas-->
						<?php
							$sql4="SELECT * FROM pengguna WHERE Kelas='$row1[Kelas]' ORDER BY pengguna.NamaPengguna";
							$result4=mysqli_query($sambung,$sql4);
							while($row4=mysqli_fetch_array($result4)){
						?>
						<tr>
							<td><?php echo $row4['IDPengguna']?></td>
							<td><?php echo $row4['NamaPengguna']?></td>
							
							<!--Data pengambilan kuiz-->
							<?php
								$sql5="SELECT * FROM kuiz WHERE IDTopik='$row2[IDTopik]'";
								$result5=mysqli_query($sambung,$sql5);
								while($row5=mysqli_fetch_array($result5)){
									//menentukan markah purata
									$sql6="SELECT FORMAT(AVG(JumlahMarkah),1) AS MarkahPurata FROM pengambilankuiz
										WHERE IDKuiz='$row5[IDKuiz]' AND IDPengguna='$row4[IDPengguna]'";
									$result6=mysqli_query($sambung,$sql6);
									while($row6=mysqli_fetch_array($result6)){
										if($row6['MarkahPurata']==''){
											//Tiada pengambilan kuiz dalam pangkalan data
											echo"<td></td><td></td>";
										}else{
											//penentuan gred purata
											$sql7="SELECT IDGred, MAX(MinMarkah) FROM gred WHERE MinMarkah<='$row6[MarkahPurata]'";
											$result7=mysqli_query($sambung,$sql7);
											$row7=mysqli_fetch_array($result7);
							?>
							<td><?php echo $row6['MarkahPurata'];?></td>
							<td><?php echo $row7['IDGred'];?></td>
							<?php
									}
								}
							}
							?>
							</tr>
						
						<?php
								}
						}
						?>
						
						</table>
					</td>
				</tr>
				<tr><td height="10px" colspan='3'></td></tr>
				<?php
						}
						?>
				</table>
				</td>
			</tr>
			<tr><td height="50px"></td></tr>
			
			<?php
				}
			?>
			</table>
		</div>
		<!--Butang cetak-->
		<table style="width:80%">
			<tr>
				<td style="height:30"></td>
			</tr>
			<tr>
				<td style="text-align:right;"><input type="submit" value="Cetak" class="button1" name="submit" onclick="printContent('kandungan')"></td>
			</tr>
		</table>
	</body>
</html>