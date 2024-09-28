<!--PengesahanLogKeluar.php-->
<!--pengguna log keluar dari sistem-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");

//memastikan pengguna log masuk sebelum menggunakan aplikasi
$IDPengguna=$_SESSION['IDPengguna'];
if($IDPengguna==''){
	header('location: Index.php');
}

$IDPengguna=$_SESSION['IDPengguna'];
if($IDPengguna==''){
	header('location:Index.php');
}
?>
<html>
	<head>
		<script>
			var hapus=confirm("Anda hendak log keluar dari sistem ini?");
			
			if(hapus){
				location.href="LogKeluar.php";
			}
			else{
				location.href="HalamanUtama.php";
			}
		</script>
	</head>
</html>