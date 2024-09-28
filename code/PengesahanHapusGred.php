<!--PengesahanHapusGred.php-->
<!--mengesahkan penghapusan maklumat gred-->

<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");

//memastikan pengguna log masuk sebelum menggunakan aplikasi
$IDPengguna=$_SESSION['IDPengguna'];
if($IDPengguna==''){
	header('location:Index.php');
}

$IDGred=$_GET['IDGred'];
?>

<html>
	<head>
		<script>
			var hapus=confirm("Pastikah anda ingin menghapuskan rekod ini?");
			
			if(hapus){
				location.href="HapusGred.php?IDGred=<?php echo $IDGred;?>";
			}
			else{
				location.href="KemaskiniGred.php";
			}
		</script>
	<head>
</html>