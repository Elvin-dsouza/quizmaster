<?php
	require "mysql.login.php";
	$o = new login;
	$o->give_permission($_POST['user_id'],$_POST['permission']);
	unset($o);
?>