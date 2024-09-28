<!--PenafianAkses.php-->
<?php
session_start();
//perlu fail ini untuk sambung ke pangkalan data
include("Connection.php");

//papar mesej pop up penafian akses
echo"<script>alert('Maaf. Anda tidak layak untuk melayari halaman ini.');
		window.location='HalamanUtama.php'</script>"
?>