<html>	
	<head>
	</head>
	<body>
		<h1>Kemasukan Murid Lewat</h1>
		<h1>Sekolah Menegah Bistari Jaya</h1>
		<form method="POST">
			<p>Masukkan Nama Anda<input type="text" name="Nama"></p>
			<input type="submit value="Masuk" name="Masuk"></input>
		</form>
		
			<?php
				date_default_timezone_set("Asia/Kuala_Lumpur");
				if(iseet($_POST['Masuk'])){
					$Nama=$_POST['Nama'];
					$Tarikh=date('d/m/Y H:i:s a');
					$Log=$Nama.",".$Tarikh.PHP_EQL;
					$f=fopen("log.txt","a");
					fwrite($f,$Log);
					fclose($f);
				}
			?>
	</body>
</html>
					