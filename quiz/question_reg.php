<?php 
		/*$handle=new mysqli('localhost','root','','sygma');
		
		$handle->query("CREATE TABLE IF NOT EXISTS `question`(qt_id INT(5) PRIMARY KEY AUTO_INCREMENT,q_id INT(10), question_name VARCHAR(128))");
		$handle->query("CREATE TABLE IF NOT EXISTS `answer`(a_id INT(5) PRIMARY KEY AUTO_INCREMENT, qt_id INT(10),q_id INT(10), answer_name VARCHAR(50), isans INT(3))");
		echo "recieved";
		$question = $_POST['question'];
		$opt1 = $_POST['opt1'];
		$opt2 = $_POST['opt2'];
		$opt3 = $_POST['opt3'];
		$opt4 = $_POST['opt4'];
		$ans = $_POST['ans'];
		$id = $_POST['id'];
		$options = array();
		$options[1]=$opt1;
		$options[2]=$opt2;
		$options[3]=$opt3;
		$options[4]=$opt4;
		$qry="INSERT INTO question (q_id, question_name) VALUES(".$id.",'".$question."')";
		$handle->query($qry);
		$qid = $handle->insert_id;
		for ($i=1; $i < 5; $i++) { 
			
			if($ans == $i)
			{
				$isans = 1;

			}
			else
			{
				$isans=0;
			}
			$qry="INSERT INTO answer (qt_id,q_id,answer_name,isans) VALUES (".$qid.",".$id.",'".$options[$i]."',".$isans.")";

			$handle->query($qry);
		}*/
		require "class.quiz.php";
		$q=new quiz();
		$q->createQuestion($_POST);
	
		
		
			
		
?>