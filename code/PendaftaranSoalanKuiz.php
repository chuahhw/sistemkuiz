<!--PendaftaranSoalanKuiz.php-->
<!--mendaftar soalan kuiz ke dalam sistem-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");
include("KepastianJenisPengguna.php");
$IDPengguna=$_SESSION['IDPengguna'];

//menerima pembolehubah dari halaman PendaftaranKuiz
$IDKuiz=$_GET['IDKuiz'];
$IDTopik=$_GET['IDTopik'];
$BilSoalan=$_GET['BilSoalan'];
//Jika borang dihantar, masuk data ke pangkalan data
if(isset($_POST["submit"])){
	
	//mengambil tarikh semasa dari komputer
	$TarikhKemaskini= date('y/m/d');
	
	//menerima nilai pembolehubah
	$ArrayButiranSoalan=$_POST['ButiranSoalan'];
	$ArrayButiranPilihan=$_POST['ButiranPilihan'];
	$ArrayMarkah=$_POST['Markah'];
	
	//simpan rekod baru pada jadual kuiz
	$sql1="INSERT INTO kuiz (IDKuiz, IDPengguna, IDTopik, TarikhKemaskini)
			VALUES('$IDKuiz','$IDPengguna','$IDTopik','$TarikhKemaskini')";
	$result1= mysqli_query($sambung,$sql1);

	if($result1){
		
		//ulangan soalan berdasarkan BilSoalan yang dimasukkan oleh pengguna
		for($i=0;$i<$BilSoalan;$i++){
			$ButiranSoalan=$ArrayButiranSoalan[$i];
			
			//simpan rekod baru pada jadual soalan
			$sql2="INSERT INTO soalan (IDSoalan, IDKuiz, ButiranSoalan)
				VALUES (NULL, '$IDKuiz', '$ButiranSoalan')";
			$result2=mysqli_query($sambung,$sql2);
			$IDSoalan=mysqli_insert_id($sambung);
			
			//ulangan 4 pilihan bagi satu soalan
			for($j=0;$j<4;$j++){
				
				//tentukan nilai
				$ButiranPilihan=$ArrayButiranPilihan[$i][$j];
				$Markah=$ArrayMarkah[$i][$j];
				
				//simpan rekod baru dalam jadual pilihan 
				$sql3="INSERT INTO pilihan (IDPilihan, IDSoalan, ButiranPilihan, Markah)
					VALUES (NULL, '$IDSoalan', '$ButiranPilihan','$Markah')";
				$result3=mysqli_query($sambung,$sql3);
			}
		}
		//mesej berjaya mendaftar
		echo"<script>alert('Tahniah! Rekod anda telah berjaya tambah ke dalam sistem.');
				window.location='PendaftaranKuiz.php'</script>";
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
	</head>

	<body>
		<table class="table3">
			<tr><td>Pendaftaran Maklumat Soalan Kuiz</td></tr>
		</table>
		<br>
		<!--Borang untuk masuk data ke dalam sistem-->
		<form name="pendaftaransoalankuiz" method="POST">
			<table class="table1" style="width:70%">
				<!--Papar Butiran Topik-->
				<tr>
					<td width="150">Butiran Topik</td>
					<td width="10">:</td>
					<td colspan="3">
						<?php
							$sql="SELECT * FROM topik WHERE IDTopik='$IDTopik'";
							$result=mysqli_query($sambung,$sql);
							$row=mysqli_fetch_array($result);
							$ButiranTopik=$row['ButiranTopik'];
						?>
						<input style="text-align:left" type="text" name="IDTopik" READONLY value="<?php echo $IDTopik ?>">
					</td>
				</tr>
				<!--Papar IDKuiz -->
				<tr height=20px colspan="4"></tr>
				<tr>
					<td>ID Kuiz</td>
					<td>:</td>
					<td colspan="3">
						<input style="text-align:left" type="text" name="IDKuiz" READONLY value="<?php echo $IDKuiz ?>">
					</td>
				</tr>
				<tr height=20px colspan="4"></tr>
							
				<!--Ulangan paparan soalan berdasarkan BilSoalan yang dimasukkan oleh pengguna-->
				<?php
					for($i=0;$i<$BilSoalan;$i++){
				?>
			
					<!--Masukkan butiran soalan ke sistem-->
					<tr>
						<td>Soalan <?php echo ($i+1);?></td>
						<td>:</td>
						<td colspan="3">
							<textarea name="ButiranSoalan[]" class="soalan" maxlength="255"
							required placeholder="taip soalan di sini" pattern="[a-zA-Z ]{0,200}" oninput="this.setCustomValidity('')"
							oninvalid="this.setCustomValidity('Sila masukkan maksimum 200 aksara yang terdiri daripada huruf atau ruang sahaja!')"></textarea>
						</td>
					<tr>
						<td style="height:20px" colspan="4"></td>
					</tr>
								
					<tr>
						<td>Pilihan</td>
						<td colspan=2>:</td>
						<td width="150">Markah:</td>
					</tr>
					<tr>
						<td style="height:20px" colspan="4"></td>
					</tr>
					
					<!--Ulangan Butiran Pilihan-->
					<?php
						for($j=0;$j<4;$j++){
					?>
					<!--Masukkan butiran pilihan ke sistem-->
					<tr>
						<td colspan="3">
							<textarea name="ButiranPilihan[<?php echo $i;?>][<?php echo $j;?>]" class="pilihan" maxlength="255"
							required placeholder="taip pilihan di sini" pattern="[a-zA-Z ]{0,50}" oninput="this.setCustomValidity('')"
							oninvalid="this.setCustomValidity('Sila masukkan maksimum 50 aksara yang terdiri daripada huruf atau ruang sahaja!')"></textarea>
						<td>
							<input type="Markah" name="Markah[<?php echo $i;?>][<?php echo $j;?>]" 
							required placeholder="e.g:0" pattern="[0-9]{0,1}" oninput="this.setCustomValidity('')"
							oninvalid="this.setCustomValidity('Sila masukkan nombor 0-9 sahaja!')"></input>
						</td>
					</tr>
					<?php
						}
					?>
					</tr>
					<tr><td colspan=4 height=20px></td></tr>
			<?php
				}
			?>
						
				<tr>
					<td colspan=4 style="text-align:right"><input type="submit" value="Daftar" class="button1" name="submit"></td>
				</tr>
			</table>
		</form>
	</body>
</html>