<?php
session_start();
if(!empty ($_GET)){
	$nowarna = $_GET['nowarna'];
	switch($nowarna){
		case 1:$_SESSION["warnatulisan"]="#000000";
		break;
		case 2:$_SESSION["warnatulisan"]="#A349A4";
		break;
		case 3:$_SESSION["warnatulisan"]="#FF8040";
		break;
		case 4:$_SESSION["warnatulisan"]="#3F48CC";
		break;
		default:$_SESSION["warnatulisan"]="#B97A57";
	}
	echo"<script>window.history.back()</script>";
}
?>