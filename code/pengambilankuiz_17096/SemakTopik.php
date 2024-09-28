<!--SemakTopik.php-->
<!--menyemak topik semasa kemaskini topik-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");
include("KepastianJenisPengguna.php");

//memastikan pengguna log masuk sebelum menggunakan aplikasi
$IDPengguna=$_SESSION['IDPengguna'];
if($IDPengguna==''){
	header('location:Index.php');
}

//Dapatkan maklumat dari paparan kemaskini topik
$IDTopik=$_GET['IDTopik'];
$ButiranTopik=$_GET['ButiranTopik'];

//Semak data dengan rekod sedia ada
$sql="SELECT * FROM topik WHERE ButiranTopik='$ButiranTopik'";
$result=mysqli_query($sambung,$sql);

if(mysqli_num_rows($result)==1){
	//Paparan jika kemaskini gagal
	echo"<script>alert
		('Maaf. Rekod anda gagal dikemaskini ke dalam sistem. Data yang dimasukkan telah ulang. Sila cuba lagi.');
		window.location='KemaskiniTopik.php'</script>";
}else{
	//mengemaskini maklumat ke pangkalan data
	$sql1="UPDATE topik SET ButiranTopik='$ButiranTopik'
			WHERE IDTopik='$IDTopik'";
			
	$result1=mysqli_query($sambung,$sql1);
	if($result1){
		echo"<script>alert
		('Tahniah! Rekod anda telah berjaya dikemaskini ke dalam sistem.');
		window.location='KemaskiniTopik.php'</script>";
	}
}
?>
