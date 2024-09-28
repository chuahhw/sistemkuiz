<!--PengesahanHapusTopik.php-->
<!--mengesahkan penghapusan maklumat topik-->

<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");

//memastikan pengguna log masuk sebelum menggunakan aplikasi
$IDPengguna=$_SESSION['IDPengguna'];
if($IDPengguna==''){
	header('location: Index.php');
}

$IDTopik=$_GET['IDTopik'];
?>

<html>
	<head>
		<script>
			var hapus=confirm("Pastikah anda ingin menghapuskan rekod ini?");
			
			if(hapus){
				location.href="HapusTopik.php?IDTopik=<?php echo $IDTopik;?>";
			}
			else{
				location.href="KemaskiniTopik.php";
			}
		</script>
	<head>
</html>