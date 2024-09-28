<!--PengesahanHapusKuiz.php-->
<!--mengesahkan penghapusan maklumat kuiz-->

<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");

//memastikan pengguna log masuk sebelum menggunakan aplikasi
$IDPengguna=$_SESSION['IDPengguna'];
if($IDPengguna==''){
	header('location:Index.php');
}

$IDKuiz=$_GET['IDKuiz'];
?>

<html>
	<head>
		<script>
			var hapus=confirm("Pastikah anda ingin menghapuskan rekod ini?");
			
			if(hapus){
				location.href="HapusKuiz.php?IDKuiz=<?php echo $IDKuiz;?>";
			}
			else{
				location.href="KemaskiniKuiz.php";
			}
		</script>
	<head>
</html>