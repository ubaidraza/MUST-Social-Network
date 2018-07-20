<?php
session_start();
		$_SESSION["myName"]='';
		$_SESSION["myUserName"]='';
		$_SESSION["pwd"]='';
		$_SESSION["myId"]='';
session_destroy();
//$_SESSION = array();

header("location:../login.php");

?>
