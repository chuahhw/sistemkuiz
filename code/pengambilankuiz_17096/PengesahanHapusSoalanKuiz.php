<!--PengesahanHapusSoalanKuiz.php-->
<!--mengesahkan penghapusan maklumat kuiz-->

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

$IDSoalan=$_GET['IDSoalan'];

//Dapatkan semua butiran rekod sedia ada berdasarkan IDSoalan
$sql="SELECT * FROM soalan INNER JOIN kuiz ON Kuiz.IDKuiz=Soalan.IDKuiz
		WHERE soalan.IDSoalan='$IDSoalan'";
$result=mysqli_query($sambung,$sql);
$row=mysqli_fetch_array($result);
$IDTopik=$row['IDTopik'];
$IDKuiz=$row['IDKuiz'];
?>

<html>
	<head>
		<script>
			var hapus=confirm("Pastikah anda ingin menghapuskan rekod ini?");
			
			if(hapus){
				location.href="HapusSoalanKuiz.php?IDSoalan=<?php echo $IDSoalan; ?>";
			}
			else{
				location.href="KemaskiniSoalanKuiz.php?IDKuiz=<?php echo $IDKuiz; ?>&IDTopik=<?php echo $IDTopik;?>";
			}
		</script>
	<head>
</html>