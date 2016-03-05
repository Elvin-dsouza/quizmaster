<?php 
		//$handle=new mysqli('localhost','root','','sygma');
		
		require "class.quiz.php";
		$q=new quiz();
		$q->createQuiz($_POST);
		header('create_question.php');
			
		
?>