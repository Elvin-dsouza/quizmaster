<?php
/*
	 $db_addr='localhost';
	 $db_user='root';//username for the database
	 $db_pw="";//database pssword
	 $db_name='sygma';// database name.*/
	 $connection; //connection handle ,  to prevent unauthorised usage and modification of the users data from external sources
	 $db_addr='localhost';
	 $db_user='sygmaapp';//username for the database
	 $db_pw="sygelvshi15";//database pssword
	 $db_name='sygma2015';// database name.

	


   
	$handle= new mysqli($db_addr, $db_user, $db_pw, $db_name);
	
	$query="CREATE TABLE IF NOT EXISTS message(mid INT(4) PRIMARY KEY AUTO_INCREMENT, username VARCHAR(50), message VARCHAR(256))";
	$handle->query($query);
	$message = $handle->real_escape_string($_POST['message']);
	$query="INSERT INTO message(username,message) VALUES ('".$_POST['username']."','".$message."')";
	$handle->query($query);
?>