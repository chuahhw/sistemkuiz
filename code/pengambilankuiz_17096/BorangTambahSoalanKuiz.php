<!--BorangTambahSoalanKuiz.php-->
<!--tambah soalan kuiz ke dalam sistem-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");
$IDPengguna=$_SESSION['IDPengguna'];

//menerima pembolehubah dari halaman PendaftaranKuiz
$IDKuiz=$_GET['IDKuiz'];
$IDTopik=$_GET['IDTopik'];

//Jika borang dihantar, masuk data ke pangkalan data
if(isset($_POST["submit"])){
	
	//mengambil tarikh semasa dari komputer
	$TarikhKemaskini= date('y/m/d');
	
	//menerima nilai pembolehubah
	$ButiranSoalan=$_POST['ButiranSoalan'];
	$ArrayButiranPilihan=$_POST['ButiranPilihan'];
	$ArrayMarkah=$_POST['Markah'];
	
	//simpan rekod baru pada jadual kuiz
	$sql1="UPDATE kuiz SET IDPengguna='$IDPengguna', TarikhKemaskini='$TarikhKemaskini' 
			WHERE IDKuiz='$IDKuiz'";
	$result1= mysqli_query($sambung,$sql1);

	if($result1){
	
			//simpan rekod baru pada jadual soalan
			$sql2="INSERT INTO soalan (IDSoalan, IDKuiz, ButiranSoalan)
				VALUES (NULL, '$IDKuiz', '$ButiranSoalan')";
			$result2=mysqli_query($sambung,$sql2);
			$IDSoalan=mysqli_insert_id($sambung);
			
			//ulangan 4 pilihan bagi satu soalan
			for($i=0;$i<4;$i++){
				
				//tentukan nilai
				$ButiranPilihan=$ArrayButiranPilihan[$i];
				$Markah=$ArrayMarkah[$i];
				
				//simpan rekod baru dalam jadual pilihan 
				$sql3="INSERT INTO pilihan (IDPilihan, IDSoalan, ButiranPilihan, Markah)
					VALUES (NULL, '$IDSoalan', '$ButiranPilihan','$Markah')";
				$result3=mysqli_query($sambung,$sql3);
			}
		}
		//mesej berjaya mendaftar
		echo"<script>alert('Tahniah! Rekod anda telah berjaya tambah ke dalam sistem.');
				window.location='KemaskiniSoalanKuiz.php?IDKuiz=$IDKuiz&IDTopik=$IDTopik';</script>";
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
		<form name="tambahsoalankuiz" method="POST">
			<table class="table1">
				<!--Papar Butiran Topik-->
				<tr>
					<td width="150">Butiran Topik</td>
					<td width="10">:</td>
					<td colspan=3>
						<?php
							$sql="SELECT * FROM topik WHERE IDTopik='$IDTopik'";
							$result=mysqli_query($sambung,$sql);
							$row=mysqli_fetch_array($result);
							$ButiranTopik=$row['ButiranTopik'];
						?>
						<input type="text" name="IDTopik" READONLY value="<?php echo $IDTopik ?>"></input>
					</td>
				</tr>
							
				<!--Papar IDKuiz-->
				<tr><td colspan=4 style="height:20px"></td></tr>
				<tr>
					<td>ID Kuiz</td>
					<td>:</td>
					<td colspan=3>
						<input type="text" name="IDKuiz" READONLY value="<?php echo $IDKuiz ?>"></input>
					</td>
				</tr>
				<tr><td colspan=4 style="height:20px"></td></tr>
						
				<!--Masukkan butiran soalan ke sistem-->
				<tr>
					<td>Soalan</td>
					<td>:</td>
					<td colspan=3>
						<textarea name="ButiranSoalan" class="soalan" maxlength="255"
						required placeholder="tiap soalan di sini" pattern="[a-zA-Z ]{0,200}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan maksimum 200 aksara yang terdiri daripada huruf atau ruang sahaja!')"></textarea>
					</td>
				</tr>
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
					for($i=0;$i<4;$i++){
				?>
				<!--Masukkan butiran pilihan ke sistem-->
				<tr>
					<td colspan="3">
						<textarea name="ButiranPilihan[<?php echo $i;?>]" class="pilihan" maxlength="255"
						required placeholder="tiap pilihan di sini" pattern="[a-zA-Z ]{0,50}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan maksimum 50 aksara yang terdiri daripada huruf atau ruang sahaja!')"></textarea>
					</td>
					<td>
						<input type="Markah" name="Markah[<?php echo $i;?>]" 
						required placeholder="e.g:0" pattern="[0-9]{0,1}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan nombor 0-9 sahaja!')"></input>
					</td>
				</tr>
				<tr height=5px></tr>
					<?php
						}
					?>
				</tr>
				<tr height=20px></tr>
				<tr>
					<td colspan=5 style="text-align:right"><input type="submit" value="Daftar" class="button1" name="submit"></input></td>
				</tr>
			</table>
		</form>
	</body>
</html>