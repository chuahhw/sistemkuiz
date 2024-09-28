<!--SemakGred.php-->
<!--menyemak gred-->

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

//dapatkan maklumat dari paparan borang kemaskini gred
	$IDGred=$_GET['IDGred'];
	$Kenyataan=$_GET['Kenyataan'];
	$MinMarkah=$_GET['MinMarkah'];
	
	//semak data dengan rekod sedia ada
	$sql="SELECT * FROM gred WHERE (IDGred<>'$IDGred' AND (MinMarkah='$MinMarkah' OR Kenyataan='$Kenyataan'))
			OR (IDGred='$IDGred' AND MinMarkah=$MinMarkah AND Kenyataan='$Kenyataan')";
	$result=mysqli_query($sambung,$sql);
	
	if(mysqli_num_rows($result)>0){
		//Papar jika kemaskini gagal
		echo"<script>alert('Maaf. Rekod anda gagal dikemaskini ke dalam sistem. Data yang dimasukkan telah ulang. Sila cuba lagi.');
				window.location='KemaskiniGred.php'</script>";	
	}
	else {
		//mengemaskini maklumat ke pangkalan data
		$sql2="UPDATE gred SET MinMarkah = '$MinMarkah' ,Kenyataan='$Kenyataan'
			WHERE IDGred='$IDGred'";
		$result2= mysqli_query($sambung, $sql2);
		if($result2){
			echo"<script>alert
			('Tahniah! Rekod anda telah berjaya dikemaskini ke dalam sistem.');
			window.location='KemaskiniGred.php'</script>";
		}
	}
?>