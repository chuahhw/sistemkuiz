<!--SemakSoalanKuiz.php-->
<!--menyemak maklumat soalan semasa kemaskini kuiz-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");
include("KepastianJenisPengguna.php");

//memastikan pengguna log masuk sebelum menggunakan aplikasi
$IDPengguna=$_SESSION['IDPengguna'];
if($IDPengguna==''){
	header('location: Index.php');
}

//mengambil tarikh semasa dari komputer dan IDPengguna
$TarikhKemaskini=date('y/m/d');
$IDPengguna=$_SESSION['IDPengguna'];

//menerima nilai pembolehubah
$IDKuiz=$_GET['IDKuiz'];
$IDSoalan=$_GET['IDSoalan'];
$ButiranSoalan=$_GET['ButiranSoalan'];
$ArrayIDPilihan=$_GET['IDPilihan'];
$ArrayButiranPilihan=$_GET['ButiranPilihan'];
$ArrayMarkah=$_GET['Markah'];

//mengemaskini maklumat ke jadual kuiz
$sql="UPDATE kuiz SET IDPengguna='$IDPengguna',TarikhKemaskini='$TarikhKemaskini'
		WHERE IDKuiz='$IDKuiz'";
$result=mysqli_query($sambung,$sql);

if($result){
	//mengemaskini maklumat ke jadual soalan
	$sql1="UPDATE soalan SET ButiranSoalan='$ButiranSoalan' WHERE IDSoalan='$IDSoalan'";
	$result1=mysqli_query($sambung,$sql1);
	
	//ulangan 4 pilihan bagi satu soalan
	for($i=0;$i<4;$i++){
		
		//tentukan nilai
		$IDPilihan=$ArrayIDPilihan[$i];
		$ButiranPilihan=$ArrayButiranPilihan[$i];
		$Markah=$ArrayMarkah[$i];
		
		//mengemaskini maklumat ke jadual pilihan
			$sql2="UPDATE pilihan SET ButiranPilihan='$ButiranPilihan', Markah='$Markah' WHERE IDPilihan='$IDPilihan'";
			$result2=mysqli_query($sambung,$sql2);
	}
	
	//mesej berjaya mendaftar
	echo"<script>alert('Tahniah! Rekod anda telah berjaya dikemaskini ke dalam sistem.');
		window.location='KemaskiniKuiz.php?IDSoalan=$IDSoalan'</script>";
		
}

?>
	
	
		