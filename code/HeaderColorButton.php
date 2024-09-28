<!--HeaderColorButton.php-->
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
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<table style="width:100%">
		<tr>
			<td style="text-align:right">
			<!--Menukarkan warna tulisan dalam sistem-->
				<a style="font-size:16px">Warna Tulisan:</a>
				<a href="TukarWarnaTulisan.php?nowarna=1"><img src="Black.png" width="15" height="15" style="border:1px solid black"></a>
				<a href="TukarWarnaTulisan.php?nowarna=2"><img src="Purple.png" width="15" height="15" style="border:1px solid black"></a>
				<a href="TukarWarnaTulisan.php?nowarna=3"><img src="Orange.png" width="15" height="15" style="border:1px solid black"></a>
				<a href="TukarWarnaTulisan.php?nowarna=4"><img src="DarkBlue.png" width="15" height="15" style="border:1px solid black"></a>
				<a href="TukarWarnaTulisan.php?nowarna=5"><img src="Brown.png" width="15" height="15" style="border:1px solid black"></a>
			<!--Menukarkan warna latar dalam sistem-->
				<a style="font-size:16px">Warna Latar:</a>
				<a href="TukarWarnaLatar.php?no=1"><img src="White.png" width="15" height="15" style="border:1px solid black"></a>
				<a href="TukarWarnaLatar.php?no=2"><img src="LightGreen.png" width="15" height="15" style="border:1px solid black"></a>
				<a href="TukarWarnaLatar.php?no=3"><img src="LightPink.png" width="15" height="15" style="border:1px solid black"></a>
				<a href="TukarWarnaLatar.php?no=4"><img src="LightPurple.png" width="15" height="15" style="border:1px solid black"></a>
				<a href="TukarWarnaLatar.php?no=5"><img src="LightYellow.png" width="15" height="15" style="border:1px solid black"></a>
			</td>
		</tr>
	</table>
</body>
</html>