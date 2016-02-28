<?php

class scoring
{
	/*private $connection; //connection handle , private to prevent unauthorised usage and modification of the users data from external sources
	private $db_addr='localhost';
	private $db_user='root';//username for the database
	private $db_pw="";//database pssword
	private $db_name='sygma';// database name.*/

	private $connection; //connection handle , private to prevent unauthorised usage and modification of the users data from external sources
	private $db_addr='localhost';
	private $db_user='sygmaapp';//username for the database
	private $db_pw="sygelvshi15";//database pssword
	private $db_name='sygma2015';// database name.



	function __CONSTRUCT()
	{

		$this->connection= new mysqli($this->db_addr, $this->db_user, $this->db_pw, $this->db_name);
		$this->connection->query("CREATE TABLE IF NOT EXISTS score (s_id INT(3) PRIMARY KEY AUTO_INCREMENT, e_id INT(3), r_id INT(3), c_id INT(3),score1 INT(5),score2 INT(5))");
		$this->connection->query("CREATE TABLE IF NOT EXISTS event (e_id INT(3) PRIMARY KEY AUTO_INCREMENT, event_name VARCHAR(50), contestant INT(3))");
		$this->connection->query("CREATE TABLE IF NOT EXISTS round (r_id INT(3) PRIMARY KEY AUTO_INCREMENT, e_id INT(3),round_name VARCHAR(50))");

	
	}


	function createEvent(array $request)
	{
		$eventname = $request['event_name'];
		$handle=$this->connection;
		$handle->query("INSERT INTO event (event_name) VALUES('".$eventname."')");

	}

	function createRound(array $request)
	{
		$roundname = $request['round_name'];
		$eventid = $request['eid'];
		$handle=$this->connection;
		$handle->query("INSERT INTO round (round_name, e_id) VALUES('".$roundname."',".$eventid.")");
		
	}

	public function getEventList()
	{
		$handle=$this->connection;		
		$qry="SELECT * FROM event";
		$i = 0;
		$events;
		$result=$handle->query($qry);
		if($result->num_rows)
		{
			while($row = $result->fetch_assoc())
			{
				$events[$i]['e_id']=$row['e_id']; 
				$events[$i]['event_name']=$row['event_name']; 
				$events[$i]['contestant']=$row['contestant']; 
				$i++;
			}
		}
		return $events;

	}
	public function getMaxEvents()
	{
		$handle=$this->connection;		
		$qry="SELECT * FROM event";
		$result=$handle->query($qry);
		if($result->num_rows)
		{
			return $result->num_rows;
		}
		return 0;
		

	}
	public function createEventList()
	{
		$handle=$this->connection;
		$qry="SELECT * FROM event";
		$result=$handle->query($qry);
		if($result->num_rows)
		{
			while($row = $result->fetch_assoc())
			{
				echo "<option value=".$row['e_id'].">". $row['event_name'] ."</option>";
			}
		}

	}
	public function createRoundList($eventid)
	{
		$handle=$this->connection;
		$qry="SELECT * FROM round WHERE e_id=".$eventid;
		$result=$handle->query($qry);
		if($result->num_rows)
		{
			while($row = $result->fetch_assoc())
			{
				echo "<option value=".$row['r_id'].">". $row['round_name'] ."</option>";
			}
		}

	}

	public function getRoundInfo($round_id)
	{
		$handle=$this->connection;
		$qry="SELECT * FROM round WHERE r_id=".$round_id;
		$result=$handle->query($qry);
		if($result->num_rows)
		{
			$row = $result->fetch_assoc();
			
			return $row;
			
		}
	}

	public function getRoundNameFromID($round_id)
	{
		$handle=$this->connection;
		$qry="SELECT round_name FROM round WHERE r_id=".$round_id;
		$result=$handle->query($qry);
		if($result->num_rows)
		{
			$row = $result->fetch_assoc();
			
			return $row['round_name'];
			
		}
	}

	public function getEventNameFromID($event_id)
	{
		$handle=$this->connection;
		$qry="SELECT event_name FROM event WHERE e_id=".$event_id;
		$result=$handle->query($qry);
		if($result->num_rows)
		{
			$row = $result->fetch_assoc();
			
			return $row['event_name'];
			
		}
	}

	public function getEventInfo($event_id)
	{
		$handle=$this->connection;
		$qry="SELECT * FROM event WHERE e_id=".$event_id;
		$result=$handle->query($qry);
		if($result->num_rows)
		{
			$row = $result->fetch_assoc();
			
			return $row;
			
		}
	}

	function addScore(array $request)
	{
		$handle = $this->connection;
		$eid = $request['event_id'];
		$cid = $request['college_id'];
		$rid = $request['round_id'];
		$score = $request['score1'];
		$score2 = $request['score2'];
		if($score != "")
		{
			$qry="INSERT INTO `score` (e_id, c_id, r_id, score1, score2) VALUES(".$eid.",".$cid.",".$rid.",".$score.",".$score2.")";
		}
		$handle->query($qry);
		
		
	}


	function getScoreSheets($event)
	{
		$handle=$this->connection;		
		$qry="SELECT DISTINCT r_id FROM score WHERE e_id=".$event;
		$i = 0;
		$score;
		$result=$handle->query($qry);

		if($result->num_rows)
		{
			
			while($row = $result->fetch_assoc())
			{
				$score[$i]['r_id']=$row['r_id']; 
				$score[$i]['s_id']=$row['s_id']; 
				
				$i++;
			}
		}
		$score[0]['max']=$result->num_rows;
		return $score;
		
		
	}

	function getScore($event, $round)
	{
		$handle=$this->connection;		
		$qry="SELECT * FROM score WHERE e_id=".$event." & r_id=".$round;
		$i = 0;
		$score;
		$result=$handle->query($qry);

		if($result->num_rows)
		{
			
			while($row = $result->fetch_assoc())
			{
				$score[$i]['c_id']=$row['c_id']; 
				$score[$i]['score1']=$row['score2']; 
				$score[$i]['score2']=$row['score2'];
				
				$i++;
			}
		}
		$score[0]['max']=$result->num_rows;
		return $score;
		
		
	}
	


	

	function __DESTRUCT()
	{
		$this->connection->close();
	}
}

?>
