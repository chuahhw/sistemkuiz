<?php
$namahos="localhost";

$pengguna_mysql="root";

$katalaluan_mysql="";

$pdata_mysql="pengambilankuiz_17096";

//membuat sambungan kepada pangkalan data pelayan
//jika pangkalan data tidak wujud, berhenti pelaksanaan dan papar mesej ralat
$sambung=mysqli_connect($namahos, $pengguna_mysql, $katalaluan_mysql) or die
	("Maaf!!..Pangkalan data tidak tersambung");

//memilih nama pangkalan data
//jika pangkalan data tidak wujud, berhenti pelaksanaan dan papar mesej ralat
mysqli_select_db($sambung, $pdata_mysql) or die 
	("Tidak dapat pilih pangkalan data");
	
?>
