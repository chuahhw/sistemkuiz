<!--EdaranSoalan.php-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");
include("KepastianJenisPengguna.php");

//Dapatkan IDKuiz dari paparan halaman cetakan.php
$IDKuiz=$_GET['IDKuiz'];

//Dapatkan semua butiran rekod sedia ada berdasarkan IDKuiz
$sql="SELECT * FROM kuiz INNER JOIN topik ON kuiz.IDTopik=topik.IDTopik
		WHERE kuiz.IDKuiz='$IDKuiz'";
$result=mysqli_query($sambung,$sql);
$row=mysqli_fetch_array($result);
$IDTopik=$row['IDTopik'];
$ButiranTopik=$row['ButiranTopik'];
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
				<td>
					<table class="table1">
						<tr>
							<td>ID Kuiz</td>
							<td>:</td>
							<td>
								<select name="IDKuiz" onchange="window.location.href=this.value">
								<option value="">--Pilih ID Kuiz--</option>
								<option value="LaporanKelas.php?Kelas=Semua">Semua</option>
								<?php	
									$sql1="SELECT * FROM kuiz";
									$result1=mysqli_query($sambung,$sql1);
									while($row1=mysqli_fetch_array($result1)){
										if($IDKuiz==$row1['IDKuiz']){
											echo"<option value='EdaranSoalan.php?IDKuiz=$row1[IDKuiz]' selected>$row1[IDKuiz]</option>";
										}else{
											echo"<option value='EdaranSoalan.php?IDKuiz=$row1[IDKuiz]'>$row1[IDKuiz]</option>";
										}
									}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td style="height:50px"></td>
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
					<td style="text-align:center; font-size:30px; background-color:#fcccfb">Edaran Soalan</td>
				</tr>
				<tr>
					<td style="height:20px"></td>
				</tr>
			</table>
			<table class="table1" width="60%">
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td>___________________</td>
				</tr>
				<tr>
					<td>Kelas</td>
					<td>:</td>
					<td>___________________</td>
				</tr>
				<tr>
					<td>Butiran Topik</td>
					<td>:</td>
					<td><?php echo $IDTopik;?>-<?php echo $ButiranTopik;?></td>
				</tr>
				<tr>
					<td>ID Kuiz</td>
					<td>:</td>
					<td><?php echo $IDKuiz;?></td>
				</tr>
				<tr>
					<td style="height:30" colspan="3"></td>
				</tr>
			</table>
			<table class="table1" width="60%">
				<!--Dapatkan semua data soalan daripada pangkalan data-->
				<?php
				$sql1="SELECT * FROM soalan WHERE IDKuiz='$IDKuiz'";
				$result1=mysqli_query($sambung,$sql1);
				$no=0;
				if(mysqli_num_rows($result1)==0){
					echo"<tr><td colspan=2>Tiada soalan bagi kuiz ini</td></tr>";
				}
				
				while($row1=mysqli_fetch_array($result1)){
					$IDSoalan=$row1['IDSoalan'];
				?>
				<tr>
					<td colspan="2">Soalan <?php echo $no+1;?></td>
				</tr>
				<tr>
					<td colspan="2"><?php echo $row1['ButiranSoalan'];?></td>
				</tr>
				<!--Dapatkan semua data pilihan daripada pangkalan data-->
				<?php
				$sql2="SELECT * FROM pilihan WHERE IDSoalan='$IDSoalan'";
				$result2=mysqli_query($sambung,$sql2);
				while($row2=mysqli_fetch_array($result2)){
				?>
				<tr>
					<td style="text-align:center" width="2%">
						<input type="radio" name="Pilihan" disabled>
					</td>
					<td><?php echo $row2['ButiranPilihan'];?></td>
				</tr>
				<?php
				}
				?>
				<tr>
					<td style="height:30" colspan="2"></td>
				</tr>
				<?php
				$no=$no+1;
				}
				?>
			</table>
		</div>
		<!--Butang cetak-->
		<table align="right">
			<tr>
				<td style="height:30"></td>
			</tr>
			<tr>
				<td style="text-align:right;"></td>
				<td><input type="submit" value="Cetak" class="button1" name="submit" onclick="printContent('kandungan')"></td>
			</tr>
			<tr>
				<td style="height:30"></td>
			</tr>
		</table>				
	</body>
</html>							