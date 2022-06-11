<?php
	session_start();
	if( !isset($_SESSION["username"]) || $_SESSION["username"] == '' || $_SESSION["username"] == NULL ){
		header('Location: ../index.php');
	}
?>