<?php
	//KepastianJenisPengguna.php
	$IDPengguna=$_SESSION['IDPengguna'];
	$JenisPengguna=$_SESSION['JenisPengguna'];
	
	//memastikan jenis pengguna Murid tidak boleh mengakses halaman tersebut
	if($JenisPengguna=='Murid'){ 
		header('location: PenafianAkses.php');
	}else if($IDPengguna==''){
		//Memastikan pengguna log masuk sebelum menggunakan aplikasi
		header('location: Index.php');
	}
?>