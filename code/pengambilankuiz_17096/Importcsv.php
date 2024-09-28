<!--Importcsv.php-->
<!--proses mengimport fail-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");
$IDPengguna=$_SESSION['IDPengguna'];

//memastikan pengguna log masuk sebelum menggunakan aplikasi
$IDPengguna=$_SESSION['IDPengguna'];
if($IDPengguna==''){
	header('location:Index.php');
}

//mengambil tarikh semasa dari komputer
$TarikhKemaskini= date('y/m/d');

//proses mengimport data
if(isset($_POST["Import"])){
	if($_FILES['file']['name']){
		//pisah file menggunakan ','
		$arrFileName=explode('.',$_FILES['file']['name']);
		//if name=csv
		if($arrFileName[1]=="csv"){
			//open temporary file as read only
			$handle=fopen($_FILES['file']['tmp_name'],"r");
			//1000 is maximum length of line 
			//use ',' as deliminator
			while (($data= fgetcsv($handle,1000, ","))!== FALSE){
				//mysqli_real_escape_string to escape special characters if any cth:/n,'s
				$IDKuiz=mysqli_real_escape_string($sambung,$data[0]);
				$IDTopik=mysqli_real_escape_string($sambung,$data[1]);
				$IDSoalan=mysqli_real_escape_string($sambung,$data[2]);
				$ButiranSoalan=mysqli_real_escape_string($sambung,$data[3]);
				$IDPilihan=mysqli_real_escape_string($sambung,$data[4]);
				$ButiranPilihan=mysqli_real_escape_string($sambung,$data[5]);
				$Markah=mysqli_real_escape_string($sambung,$data[6]);
				
				$sql="INSERT into kuiz(IDKuiz, IDTopik, IDPengguna, TarikhKemaskini)
					VALUES('$IDKuiz','$IDTopik', '$IDPengguna', '$TarikhKemaskini')";
				$sql1="INSERT into soalan(IDSoalan, IDKuiz, ButiranSoalan)
					VALUES('$IDSoalan','$IDKuiz', '$ButiranSoalan')";
				$sql2="INSERT into pilihan(IDPilihan, IDSoalan, ButiranPilihan, Markah)
					VALUES('$IDPilihan','$IDSoalan', '$ButiranPilihan', '$Markah')";
				mysqli_query($sambung,$sql);
				mysqli_query($sambung,$sql1);
				mysqli_query($sambung,$sql2);
			}
			fclose($handle);
			echo"<script>alert
				('Tahniah! Data anda telah berjaya import ke dalam sistem.');
				window.location='Import.php'</script>";
		}else{
			echo"<script>alert
				('Maaf! Data anda gagal import ke dalam sistem! Sila pastikan format fail adalah betul.');
				window.location='Import.php'</script>";
		}
	}
}