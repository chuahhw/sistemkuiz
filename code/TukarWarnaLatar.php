<?php
session_start();
if(!empty ($_GET)){
	$no = $_GET['no'];
	switch($no){
		case 1:$_SESSION["warnalatar"]="#ffffff";
		break;
		case 2:$_SESSION["warnalatar"]="#CEFFFF";
		break;
		case 3:$_SESSION["warnalatar"]="#FFDBED";
		break;
		case 4:$_SESSION["warnalatar"]="#C8BFE7";
		break;
		default:$_SESSION["warnalatar"]="#FFFFCC";
	}
	echo"<script>window.history.back()</script>";
}
?>