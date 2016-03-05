<?php 
		//$handle=new mysqli('localhost','root','','sygma');
		require "class.quiz.php";
		$q=new quiz();
		$q->createContestant($_POST);
			
		
?>