<?php
	include "college.register.php";
	$newobj=new college();
	$id=$newobj->college_register($_POST);
	echo $id;
	
?>