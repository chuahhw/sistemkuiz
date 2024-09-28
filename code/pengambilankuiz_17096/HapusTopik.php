<!--HapusTopik.php-->
<!--menghapuskan maklumat topik-->

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
$IDTopik=$_GET['IDTopik'];

//menghapuskan data dari pangkalan data
$sql ="DELETE FROM topik WHERE IDTopik='$IDTopik'";
$result=mysqli_query($sambung,$sql);
if($result){
	echo"<script>alert
		('Rekod telah berjaya dihapuskan.');
		window.location='KemaskiniTopik.php'</script>";
}else{
	echo"<script>alert
		('Maaf! Rekod gagal dihapuskan! Sila pastikan data yang dipilih tidak digunakan. Sila cuba lagi.');
		window.location='KemaskiniTopik.php'</script>";
}

?>
		