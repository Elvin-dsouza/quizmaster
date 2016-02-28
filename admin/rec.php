<?php

	$ch = new mysqli('localhost','sygmaapp','sygelvshi15','sygma2015');
	$ch->query('CREATE TABLE IF NOT EXISTS mail (addr VARCHAR(50))');
	$email = $_GET['email'];
	print_r($_GET);
	print_r($_POST);
	print_r($_REQUEST);
	echo $email;
	$qry = "INSERT INTO mail (addr) VALUES ('".$email."')";
	echo $qry;
	echo "C";
	echo "d";
	$ch->query($qry);
	$ch->close();



?>