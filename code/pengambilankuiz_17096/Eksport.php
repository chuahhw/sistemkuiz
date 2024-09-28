<?php
//Eksport.php
//mengeksport data dari sistem

session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");

//memastikan pengguna murid tidak dapat mengakseskan halaman ini
include("KepastianJenisPengguna.php");

//Mendapatkan data yang diperlukan
$sql="SELECT topik.IDTopik, topik.ButiranTopik, soalan.IDKuiz, kuiz.TarikhKemaskini, pilihan.IDSoalan, soalan.ButiranSoalan, pilihan.ButiranPilihan, pilihan.Markah,
	pengambilankuiz.IDPengguna, pengguna.NamaPengguna, pengguna.Kelas, pengambilankuiz.IDPengambilan, pengambilankuiz.TarikhPengambilan, pengambilankuiz.Masa,
	 pengambilankuiz.JumlahMarkah, pengambilankuiz.IDGred, gred.Kenyataan,gred.MinMarkah
	FROM topik INNER JOIN kuiz ON kuiz.IDTopik=topik.IDTopik
	INNER JOIN soalan ON soalan.IDKuiz=kuiz.IDKuiz
	INNER JOIN pilihan ON pilihan.IDSoalan=soalan.IDSoalan
	INNER JOIN pengambilankuiz ON pengambilankuiz.IDKuiz=kuiz.IDKuiz
	INNER JOIN pengguna ON pengguna.IDPengguna=pengambilankuiz.IDPengguna
	INNER JOIN gred ON gred.IDGred=pengambilankuiz.IDGred
	WHERE JenisPengguna='Murid'";
$result=mysqli_query($sambung, $sql);

//Nama fail yang akan dicipta
$filename="dataexport.xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
$flag = false;

//Kandungan data
while($row=mysqli_fetch_assoc($result)){
	if(!$flag){
		//display field/column names as first row
		echo implode ("\t", array_keys($row))."\r\n";
		$flag = true;
		
	}
	echo implode ("\t", array_values($row))."\r\n";
}
?>