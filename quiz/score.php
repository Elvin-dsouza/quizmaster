<?php 
		/*$handle=new mysqli('localhost','sygmaapp','sygelvshi15','sygma2015');
		$handle->query("CREATE TABLE IF NOT EXISTS `contestants` (p_id INT(5) PRIMARY KEY AUTO_INCREMENT, q_id INT(5), team_code VARCHAR(50), score INT(10))");
		$s = $_POST['s'];
		$user = $_POST['user'];
		$id = $_POST['id'];
		$q="SELECT * FROM contestants WHERE team_code ='".$user."' AND q_id =".$id." ";
		$result= $handle->query($q);
		if($result->num_rows)
		{
			echo "recieved";
			while($row = $result->fetch_assoc())
			{
				$s = $row['score'] + $_POST['s'];
				$q="UPDATE contestants SET score = ". $s ." WHERE team_code = '".$user."'AND q_id =".$id." " ;
				$handle->query($q);
			}
		}
		else
		{
			echo "idle";
		}*/
		require "class.quiz.php";
		$q= new quiz();
		$q->updateScore($_POST);


?>