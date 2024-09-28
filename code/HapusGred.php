<!--HapusGred.php-->
<!--menghapuskan maklumat gred-->

<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");

//memastikan pengguna log masuk sebelum menggunakan aplikasi
$IDPengguna=$_SESSION['IDPengguna'];
if($IDPengguna==''){
	header('location: Index.php');
}

//Dapatkan IDGred dari paparan kemaskini
$IDGred=$_GET['IDGred'];

//menghapuskan data dari pangkalan data
$sql ="DELETE FROM gred WHERE IDGred='$IDGred'";
$result=mysqli_query($sambung,$sql);
if($result){
	echo"<script>alert
		('Rekod telah berjaya dihapuskan.');
		window.location='KemaskiniGred.php'</script>";
}else{
	echo"<script>alert
		('Maaf! Rekod gagal dihapuskan! Sila pastikan data yang dipilih tidak digunakan. Sila cuba lagi.');
		window.location='KemaskiniGred.php'</script>";
}

?>
		