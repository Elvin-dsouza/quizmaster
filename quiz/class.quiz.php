<?php



class quiz
{

/*
	private $connection; //connection handle , private to prevent unauthorised usage and modification of the users data from external sources
	private $db_addr='localhost';
	private $db_user='root';//username for the database
	private $db_pw="";//database pssword
	private $db_name='sygma';// database name.
*/
	private $connection; //connection handle , private to prevent unauthorised usage and modification of the users data from external sources
	private $db_addr='localhost';
	private $db_user='sygmaapp';//username for the database
	private $db_pw="sygelvshi15";//database pssword
	private $db_name='sygma2015';// database name.

	function __CONSTRUCT()
	{
		$this->connection= new mysqli($this->db_addr, $this->db_user, $this->db_pw, $this->db_name);
		$this->connection->query("CREATE TABLE IF NOT EXISTS `question`(qt_id INT(5) PRIMARY KEY AUTO_INCREMENT,q_id INT(10), question_name VARCHAR(128))");
		$this->connection->query("CREATE TABLE IF NOT EXISTS `answer`(a_id INT(5) PRIMARY KEY AUTO_INCREMENT, qt_id INT(10),q_id INT(10), answer_name VARCHAR(50), isans INT(3))");
		$this->connection->query("CREATE TABLE IF NOT EXISTS `contestants`(`p_id` INT(5) PRIMARY KEY AUTO_INCREMENT, q_id INT(5), `team_code` VARCHAR(50), `score` INT(10), `stamp` INT(20))");
		$this->connection->query("CREATE TABLE IF NOT EXISTS `quiz`(q_id INT(5) PRIMARY KEY AUTO_INCREMENT, quiz_name VARCHAR(50), e_id INT(10), init INT(3))");


	}

	function updateScore(array $request)
	{
		$handle=$this->connection;
		$s = $request['s'];
		$user = $request['user'];
		$id = $request['id'];
		$q="SELECT * FROM contestants WHERE team_code ='".$user."' AND q_id =".$id." ";
		$result= $handle->query($q);
		if($result->num_rows)
		{
			echo "recieved";
			while($row = $result->fetch_assoc())
			{
				$s = $row['score'] + $request['s'];
				$q="UPDATE contestants SET score = ". $s .", stamp = ".time()." WHERE team_code = '".$user."'AND q_id =".$id." " ;
				$handle->query($q);
			}
		}
		else
		{
			echo "idle";
		}
	}

	function getQuizName($qid)
	{
		$handle=$this->connection;
		$result = $handle->query("SELECT * FROM quiz WHERE q_id=".$qid);
		$row = $result ->fetch_assoc();
		echo $row['quiz_name'] ." Quiz";
	}

	function populateQuiz($id)
	{

		$handle=$this->connection;
				$result = $handle ->query("SELECT * FROM question WHERE q_id=".$id);


				$opt2 = 	str_replace('â€', "'", $opt2);
				$opt3 = 	str_replace('â€', "'", $opt3);
				$opt4 = 	str_replace('â€', "'", $opt4);
				$j=1;
				if($result->num_rows)
				{
					while($row = $result->fetch_assoc())
					{
						echo "<section class='card question' style='display:none' >
						<section class='question-cover' style='display:none'></section>";

						$question=$row['question_name'];
						$question_id=$row['qt_id'];
						echo "<h3>".$j.") ".htmlspecialchars_decode(str_replace('â€', "'", $question))."</h3>";
						$j++;
						$i=0;
						$res = $handle ->query("SELECT * FROM answer WHERE qt_id=".$question_id);
						if($res->num_rows)
						{

							echo "<form><span class='answer-row'>";
							while($r = $res->fetch_assoc())
							{	$i++;
								$answer=$r['answer_name'];
								$isans=$r['isans'];
								if($isans == 0)
								{
									echo "<span class='answer'><input type='radio' name='answer' value='FF' required/>".htmlspecialchars_decode(str_replace('â€', "'", $answer))."</span>";
								}
								else
								{
									echo "<span class='answer'><input type='radio' name='answer' value='AA' required/>".htmlspecialchars_decode(str_replace('â€', "'", $answer))."</span>";
								}
								if($i == 2)
								{
								echo "</span><span class='answer-row'>";
								}
							}

							echo "</span></form>
									<div class='material-button circle raised accept' style=' width:50px; height:50px ; border-radius:50%;padding:0px; '>
										<div class='material-layer light'>
										</div>
										<svg class='icon-check'><use xlink:href='#icon-check'></use></svg>
									</div>
								</section>";
						}

					}
				}
	}



	function getResult(array $request)
	{
		$handle=$this->connection;
		$id = $request['id'];
		$q="SELECT * FROM contestants WHERE q_id =".$id;
		$res= $handle->query($q);

		if($res->num_rows)
		{


				$q="SELECT * FROM `contestants` WHERE q_id =".$id;
				$result = $handle->query($q);
				while($row = $result->fetch_assoc())
				{
					$height=500*$row['score']/100;
					echo "<div class='bar' style= 'height:". $height ."px;''><p class='rot'>". $row['team_code']."(".$row['score'].")</p></div>";
				}


		}
		else
		{
			echo "Waiting for participants...";
		}
	}

	function getResultAsTable(array $request)
	{

		$handle=$this->connection;
		$id = $request['id'];
		$q="SELECT * FROM contestants WHERE q_id =".$id;
		$res= $handle->query($q);
		$i=0;
		if($res->num_rows)
		{


				$q="SELECT * FROM `contestants` WHERE q_id =".$id." ORDER BY score DESC,stamp ASC";
				$result = $handle->query($q);
				echo"<br/><table class='tg' style='undefined;table-layout: fixed; width: 1028px'>
					<colgroup>
					<col style='width: 72px'>
					<col style='width: 331px'>
					<col style='width: 162px'>
					</colgroup>
					";
				while($row = $result->fetch_assoc())
				{
					$i++;
						if($i==1)
						{
							echo '<tr style="font-size:4em; color:gold;"><td class="tg-031e">'. $i.'</td>
							<td class="tg-031e">'.$row['team_code'] .'</td>
							<td class="tg-031e">'.$row['score'] .'</td>
							</tr>';
						}
						else if($i==2)
						{
							echo '<tr style="font-size:3em; color:silver;"><td class="tg-031e">'. $i.'</td>
							<td class="tg-031e">'.$row['team_code'] .'</td>
							<td class="tg-031e">'.$row['score'] .'</td>
							</tr>';
						}
						else if($i==3)
						{
							echo '<tr style="font-size:2em; color:brown;"><td class="tg-031e">'. $i.'</td>
							<td class="tg-031e">'.$row['team_code'] .'</td>
							<td class="tg-031e">'.$row['score'] .'</td>
							</tr>';
						}
						else
						{
							echo '<tr style="font-size:1em;"><td class="tg-031e">'. $i.'</td>
							<td class="tg-031e">'.$row['team_code'] .'</td>
							<td class="tg-031e">'.$row['score'] .'</td>
							</tr>';
						}


				}
				echo "</table>";
		}

	}

	function createQuestion(array $request)
	{

		$handle=$this->connection;
		$question = htmlspecialchars($request['question']);
		$opt1 = htmlspecialchars($request['opt1']);
		$opt2 = htmlspecialchars($request['opt2']);
		$opt3 = htmlspecialchars($request['opt3']);
		$opt4 = htmlspecialchars($request['opt4']);
		$ans = htmlspecialchars($request['ans']);
		$id = $request['id'];
		echo "recieved";
		$options = array();
		$options[1]=$opt1;
		$options[2]=$opt2;
		$options[3]=$opt3;
		$options[4]=$opt4;
		$qry="INSERT INTO question (q_id, question_name) VALUES (".$id.",'".$question."')";
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
		}

	}
	function createContestant(array $request)
	{
		$handle=$this->connection;
		$user = $request['user'];
		$id = $request['id'];
		echo "recieved";
		$q="INSERT INTO contestants (team_code , q_id, score) VALUES('".$user."',".$id.",0)";

		$handle->query($q);
	}

	function createQuiz(array $request)
	{
		$handle=$this->connection;
		$name = $request['quiz'];

		echo "recieved";
		$q="INSERT INTO quiz (quiz_name) VALUES('".$name."')";

		$handle->query($q);

	}

	function getQuizList()
	{
		$handle=$this->connection;
		$q="SELECT * FROM quiz";
		$result = $handle->query($q);
		$quiz;
		$i=0;
		if($result->num_rows)
		{
			$quiz[$i]['max']= $result->num_rows();
			while($row = $result->fetch_assoc())
			{
				$quiz['name']=$row['quiz_name'];
				$res = $handle->query("SELECT * FROM contestants WHERE q_id=".$row['q_id']);
				$quiz['contestants']=$res->num_rows;
				$res = $handle->query("SELECT * FROM questions WHERE q_id=".$row['q_id']);
				$quiz['questions']=$res->num_rows;
				$i++;
			}


		}
	}

	function __DESTRUCT()
	{
		$this->connection->close();
	}
}
?>
