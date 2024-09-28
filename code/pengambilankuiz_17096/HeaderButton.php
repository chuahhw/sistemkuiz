<!--HeaderButton.php-->
<!--Munubar-->
<?php
//menentukan jenis pengguna
$JenisPengguna=$_SESSION['JenisPengguna'];

//memastikan pengguna log masuk sebelum menggunakan aplikasi
$IDPengguna=$_SESSION['IDPengguna'];
if($IDPengguna==''){
	header('location: Index.php');
}
?>

<html>
<head>
</head>

<body>
	<?php
	if($JenisPengguna=='Guru'){
	?>
		<ul>
			<!--Pendaftaran-->
			<li><a>Pendaftaran<i class="fa fa-caret-down"></i></a>
				<!--Dropdown pendaftaran-->
				<ul>
					<li><a href="PendaftaranTopik.php">Topik</a></li>
					<li><a href="PendaftaranGred.php">Gred</a></li>
					<li><a href="PendaftaranKuiz.php">Kuiz</a></li>
				</ul>
			</li>
			<!--Kemaskini-->
			<li><a>Kemaskini<i class="fa fa-caret-down"></i></a>
				<!--Dropdown kemaskini-->
				<ul>
					<li><a href="KemaskiniTopik.php">Topik</a></li>
					<li><a href="KemaskiniGred.php">Gred</a></li>
					<li><a href="KemaskiniKuiz.php">Kuiz</a></li>
				</ul>
			</li>
			<!--PengambilanKuiz-->
			<li><a>Kuiz<i class="fa fa-caret-down"></i></a>
				<!--Dropdown pengambilan kuiz-->
				<ul>
				<?php
					$sql="SELECT * FROM topik ORDER BY IDTopik";
					$result=mysqli_query($sambung,$sql);
					if(mysqli_num_rows($result)>0){
						while($row=mysqli_fetch_array($result)){
							$ButiranTopik1=$row['ButiranTopik'];
							$IDTopik1=$row['IDTopik'];
							echo"<li><a>".$IDTopik1," - ".$ButiranTopik1;
							//ButiranKuiz
							$sql1="SELECT * FROM kuiz WHERE IDTopik='".$IDTopik1."'";
							$result1=mysqli_query($sambung,$sql1);
							if(mysqli_num_rows($result1)>0){
								echo"</a>";
								echo"<ul>";
									while($row1=mysqli_fetch_array($result1)){
										$IDKuiz1=$row1['IDKuiz'];
										echo"<li><a href='PengambilanKuiz.php?IDKuiz1=".$IDKuiz1."'>".$IDKuiz1."</a></li>";
									}
								echo"</ul>";
							}
							echo"</li>";
						}
					}
				?>
				</ul>
			</li>
			<!--Import-->
			<li><a href="Import.php">Import</a></li>
			<!--Eksport-->
			<li><a href="Eksport.php">Eksport</a></li>
			<!--Cetakan-->
			<li><a href="Cetakan.php">Cetakan</a></li>
			<!--Log Keluar-->
			<li><a href="PengesahanLogKeluar.php">Log Keluar</a></li>
		</ul>
	<?php
	}else{
	?>
	
		<ul>
			<!--Pendaftaran-->
			<li><a href="PenafianAkses.php">Pendaftaran<i class="fa fa-caret-down"></i></a>
			</li>
			<!--Kemaskini-->
			<li><a href="PenafianAkses.php">Kemaskini<i class="fa fa-caret-down"></i></a>
			</li>
			<!--PengambilanKuiz-->
			<li><a>Kuiz<i class="fa fa-caret-down"></i></a>
				<!--Dropdown pengambilan kuiz-->
				<ul>
				<?php
					$sql="SELECT * FROM topik ORDER BY IDTopik";
					$result=mysqli_query($sambung,$sql);
					if(mysqli_num_rows($result)>0){
						while($row=mysqli_fetch_array($result)){
							$ButiranTopik1=$row['ButiranTopik'];
							$IDTopik1=$row['IDTopik'];
							echo"<li><a>".$IDTopik1," - ".$ButiranTopik1;
							//ButiranKuiz
							$sql1="SELECT * FROM kuiz WHERE IDTopik='".$IDTopik1."'";
							$result1=mysqli_query($sambung,$sql1);
							if(mysqli_num_rows($result1)>0){
								echo"</a>";
								echo"<ul>";
									while($row1=mysqli_fetch_array($result1)){
										$IDKuiz1=$row1['IDKuiz'];
										echo"<li><a href='PengambilanKuiz.php?IDKuiz1=".$IDKuiz1."'>".$IDKuiz1."</a></li>";
									}
								echo"</ul>";
								echo"</div>";
							}
							echo"</li>";
						}
					}
				?>
				</ul>
			</li>
			<!--Import-->
			<li><a href="PenafianAkses.php">Import</a></li>
			<!--Eksport-->
			<li><a href="PenafianAkses.php">Eksport</a></li>
			<!--Cetakan-->
			<li><a href="CetakanMurid.php">Cetakan</a></li>
			<!--Log Keluar-->
			<li><a href="PengesahanLogKeluar.php">Log Keluar</a></li>
		</ul>
	<?php
	}
	?>
</body>
</html>