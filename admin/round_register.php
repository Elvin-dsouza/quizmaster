<?php

	include "class.scoring.php";
	$o=new scoring();
	$o->createRound($_POST);
	header('Location:manage.php');
?>