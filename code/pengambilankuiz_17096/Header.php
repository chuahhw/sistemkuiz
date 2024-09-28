<!--Header.php-->
<!--Header untuk sistem-->
<?php
	if (empty($_SESSION["warnatulisan"]))
	{
	$_SESSION["warnatulisan"]="#000000";
	}
	if (empty($_SESSION["warnalatar"]))
	{
	$_SESSION["warnalatar"]="#ffffff";
	}
?>
<html>
	<head>
		<title>Log Masuk</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body text="<?php echo $_SESSION["warnatulisan"];?>" style="background-color: <?php echo $_SESSION["warnalatar"];?>">
		<table style="width:100%;margin-left:auto;margin-right:auto;">
			<tr>
				<td style="width:15%" rowspan=3></td>
				<td style="text-align:right""width:10%" rowspan=3><img src="Logo1.png" alt="logo" width="120" height="140"></td>
				<td style="text-align:center; font-size:150%;font-family:Times New Roman;"><b>KUIZZARD OZ</b></td>
				<td style="width:15%" rowspan=3></td>
			</tr>
			<tr>
				<td nowrap=nowrap style="text-align:center; font-size:150%;font-family:Times New Roman;"><b>SISTEM KUIZ BAHASA MELAYU</b></td>
			</tr>
			<tr>
				<td nowrap=nowrap style="text-align:center; font-size:150%;font-family:Times New Roman;"><b>SMJK PEREMPUAN CHINA PULAU PINANG</b></td>
			</tr>
			
		</table>
	</body>
</html>