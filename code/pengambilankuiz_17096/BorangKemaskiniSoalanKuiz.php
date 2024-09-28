<!--BorangKemaskiniSoalanKuiz.php-->
<!--kemaskini maklumat soalan kuiz ke dalam sistem-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");
include("KepastianJenisPengguna.php");

//Dapatkan IDSoalan dari paparan kemaskini soalan kuiz
$IDSoalan=$_GET['IDSoalan'];

//Dapatkan emua butiran rekod sedia ada berdasarkan IDSoalan
$sql="SELECT * FROM soalan INNER JOIN kuiz on kuiz.IDKuiz=soalan.IDKuiz
		INNER JOIN topik on topik.IDTopik=kuiz.IDTopik
		WHERE soalan.IDSoalan='$IDSoalan'";
$result=mysqli_query($sambung,$sql);
$row=mysqli_fetch_array($result);
$ButiranSoalan=$row['ButiranSoalan'];
$IDKuiz=$row['IDKuiz'];
$ButiranTopik=$row['ButiranTopik'];
$IDTopik=$row['IDTopik'];
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
			<tr><td>Borang Kemaskini Maklumat Soalan Kuiz</td></tr>
		</table>
		<br>
		<!--Borang untuk masuk data ke dalam sistem-->
		<form action="SemakSoalanKuiz.php" method="GET">
			<table class="table1" style="width:80%">
				<!--Papar Butiran Topik-->
				<tr>
					<td width="150">Butiran Topik</td>
					<td width="10">:</td>
					<td colspan="3">
						<input style="text-align:left;border-style:none" type="text" name="ButiranTopik" READONLY value="<?php echo $IDTopik." - ".$ButiranTopik;?>"></input>
					</td>
				</tr>
							
				<!--Papar IDKuiz-->
				<tr colspan="4" height="20px"></tr>
				<tr>
					<td>ID Kuiz</td>
					<td>:</td>
					<td colspan="3">
						<input style="text-align:left;border-style:none" type="text" name="IDKuiz" READONLY value="<?php echo $IDKuiz;?>"></input>
					</td>
				</tr>
				<tr colspan="4" height="20px"></tr>
						
				<!--Papar butiran soalan-->
				<tr>
					<td>Soalan</td>
					<td>:</td>
					<td colspan="3">
						<input type="text" name="IDSoalan" value="<?php echo $IDSoalan;?>" hidden></input>
						<textarea name="ButiranSoalan" class="soalan" maxlength="255" pattern="[a-zA-Z ]{0,200}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan maksimum 200 aksara yang terdiri daripada huruf atau ruang sahaja!')"
						required><?php echo $ButiranSoalan ?></textarea>
					</td>
				</tr>
				<tr>
					<td style="height:20px" colspan="4">
				</tr>
								
				<tr>
					<td>Pilihan:</td>
					<td colspan=2>:</td>
					<td width="150">Markah:</td>
				</tr>
								
				<?php
					$sql1="SELECT * FROM pilihan WHERE IDSoalan='$IDSoalan'";
					$result1=mysqli_query($sambung,$sql1);
					$i=0;
					while($row1=mysqli_fetch_array($result1)){
				?>
								
				<!--Pilihan-->
				<tr>
					<td colspan="3">
						<input type="text" name="IDPilihan[<?php echo $i;?>]" value="<?php echo $row1['IDPilihan'];?>" hidden></input>
						<textarea name="ButiranPilihan[<?php echo $i;?>]" class="pilihan"
							maxlength="255" pattern="[a-zA-Z ]{0,50}" oninput="this.setCustomValidity('')"
							oninvalid="this.setCustomValidity('Sila masukkan maksimum 50 aksara yang terdiri daripada huruf atau ruang sahaja!')"required><?php echo $row1['ButiranPilihan']?> </textarea>
					</td>
					<td>
						<input style="width:100%;height:40px;float:right;text-align:center;" type="Markah" name="Markah[<?php echo $i;?>]"value="<?php echo $row1['Markah'];?>" 
						required pattern="[0-9]{0,1}" oninput="this.setCustomValidity('')"
						oninvalid="this.setCustomValidity('Sila masukkan nombor 0-9 sahaja!')"></input>
					</td>
				</tr>
								
				<?php
				$i=$i+1;
				}
				?>	

				<tr><td style="height:20px" colspan=4></td></tr>
				<tr>
					<td colspan=5 style="text-align:right"><input type="submit" value="Kemaskini" class="button1" name="submit"></td>
				</tr>
			</table>
		</form>
	</body>
</html>