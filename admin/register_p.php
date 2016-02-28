<?php


	include "mysql.login.php";
	$o= new login;
	$o->register_participant($_POST);
	

?>
