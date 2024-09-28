<!--HapusSoalanKuiz.php-->
<!--menghapuskan maklumat soalan kuiz-->

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
$IDSoalan=$_GET['IDSoalan'];

//menghapuskan data dari pangkalan data
$sql ="DELETE FROM pilihan WHERE IDSoalan='$IDSoalan'";
$result=mysqli_query($sambung,$sql);
$sql1="DELETE FROM soalan WHERE IDSoalan='$IDSoalan'";
$result1=mysqli_query($sambung,$sql1);

if($result AND $result1){
	echo"<script>alert
		('Rekod telah berjaya dihapuskan.');
		window.location='KemaskiniKuiz.php'</script>";
}else{
	echo"<script>alert
		('Maaf! Rekod gagal dihapuskan! Sila pastikan data yang dipilih tidak digunakan. Sila cuba lagi.');
		window.location='KemaskiniKuiz.php'</script>";
}

?>
		