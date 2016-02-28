<?php 
		
		require "class.quiz.php";
		$q= new quiz();
		//$q->getResult($_POST);



		$q->getResultAsTable($_POST);
?>