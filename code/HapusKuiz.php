<!--HapusKuiz.php-->
<!--menghapuskan maklumat kuiz-->

<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");

//memastikan pengguna log masuk sebelum menggunakan aplikasi
$IDPengguna=$_SESSION['IDPengguna'];
if($IDPengguna==''){
	header('location: Index.php');
}

//Dapatkan IDTopik dari paparan kemaskini
$IDKuiz=$_GET['IDKuiz'];

//menghapuskan data dari pangkalan data
$sql ="DELETE FROM kuiz WHERE IDKuiz='$IDKuiz'";
$result=mysqli_query($sambung,$sql);
if($result){
	echo"<script>alert
		('Rekod telah berjaya dihapuskan.');
		window.location='KemaskiniKuiz.php'</script>";
}else{
	echo"<script>alert
		('Maaf! Rekod gagal dihapuskan! Sila pastikan data yang dipilih tidak digunakan. Sila cuba lagi.');
		window.location='KemaskiniKuiz.php'</script>";
}

?>
		