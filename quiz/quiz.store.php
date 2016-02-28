<?php

class event
{


	private $connection; //connection handle , private to prevent unauthorised usage and modification of the users data from external sources
	private $db_addr='localhost';
	private $db_user='root';//username for the database
	private $db_pw="";//database pssword
	private $db_name='sygma';// database name.

	 const REDIRECT_LOGIN = 'Location:../index.php'; // the adress to redirect to after login process is successfully completed
	 const REDIRECT_REGISTER='Location:../index.php'; // the adress to redirect to after the registration process is completed
	 const REDIRECT_LOGIN_ERROR='Location:../index.php';// the adress to redirect if an error is encountered on login process this is optional


    function __CONSTRUCT()
	{

		/*
			Starts a connection to the mysql database with the user details as specified
		*/
		$this->connection= new mysqli($this->db_addr, $this->db_user, $this->db_pw, $this->db_name);
		$this->connection->query("CREATE TABLE IF NOT EXISTS
									`quiz`
									(
										`quiz_id` INT(10) PRIMARY KEY AUTO_INCREMENT,
										`name` VARCHAR(50)
										

									)

								");
		$this->connection->query("CREATE TABLE IF NOT EXISTS
									`questions`
									(
										`q_id` INT(10) PRIMARY KEY AUTO_INCREMENT,
										`qdx` INT(10),
										`statement` VARCHAR(256)
									)

								");
		$this->connection->query("CREATE TABLE IF NOT EXISTS
									`answers`
									(
										`a_id` INT(10) PRIMARY KEY AUTO_INCREMENT,
										`option` VARCHAR(256),
										`q_id` INT(10),
										`flag` INT(10)

									)

								");
		return $this->connection;// Returns the connection handle


	}

	public function getquestion($id,$quiz_id)
	{

				
				$q="SELECT * FROM `questions` WHERE `email` ='".$dbarray['email']."' "."AND `password` ='".$paswd. "'";
				$result = $dbhandle ->query($q);
				
				if($result->num_rows !=1)
				{
						$flag=1;

				}

				else
				{
					$flag=0;//if not no error is returned
					$_SESSION['logged'] = 1;//setting the session to logged
					while($row = $result-> fetch_assoc())// looping through each associated feild returned
					{
						$_SESSION['uid']=$row['uid'];//setting the session useri and name
						$_SESSION['name']=$row['name'];


						//header(self :: REDIRECT_LOGIN);
						/*to handle the redirect from the login page directly from the server the above line must be uncommented
						if the line is ignored redirects must be handled strictly using javascript*/

					}

				}
				return $flag;//returns the flag which if the login was unsuccessful would be 1 else 0
	}

	public function user_details($uid)// sends the whole row of a user in the form of an indexed array
	{
				$dbhandle = $this->connection;
				$q="SELECT * FROM `users` WHERE `uid` = ".$uid;
				$result =$dbhandle-> query($q);
				if($result->num_rows < 1)//if user does not exist return the error code
				{
					return -1;

				}

				$row = $result-> fetch_assoc();
				return $row;
	}

	public function get_max_users()
	{
				$dbhandle = $this->connection;
				$q="SELECT * FROM `users`";
				$result =$dbhandle-> query($q);
				return $result->num_rows;
	}


	public function user_register(array $dbarray)
	{
				$dbhandle=$this ->connection;


					function read_text($instr)
					{
						$instr=trim($instr);
						$instr=stripslashes($instr);
						$instr=htmlspecialchars($instr);
						return $instr;

					}
					if($dbarray['password'] == $dbarray['cpassword'])
					{


						$dbarray['name']=read_text($dbarray['name']);
						$dbarray['email']=read_text($dbarray['email']);
						$dbhandle= new mysqli("localhost", "root", "", "sygma");
						if($dbhandle->connect_error)// if the connection to the mysql server is lost this method returns an error code "2";
						{
							die ("Connection Failed: ". $dbhandle->connect_error);
							return 2;

						}
						else
						{
								$q="SELECT * FROM `users` WHERE `email` ='".$dbarray['email']."' LIMIT 1";
								$result = $dbhandle -> query($q);
								if($result->num_rows)// if the query results in rows returned , ie, a user with that username already exists an error code 3 is returned
								{
										return 3;

								}
								else// inserting values into the table when there are no errors found
								{
									$fpass="";

										$fpass=hash('sha256',$dbarray['password']);

									$qry= $dbhandle->prepare("INSERT INTO `users` (`name`, `password`,`email`) VALUES(?,?,?)");
									$qry->bind_param("sss",$dbarray['name'],$fpass,$dbarray['email']);
									$_SESSION['logged']=1;
									$_SESSION['name']=$dbarray['name'];
									$qry->execute();
									$qry->close();
									$dbhandle->close();
									//header(self :: REDIRECT_REGISTER);
									/*to handle the redirect from the login page directly from the server the above line must be uncommented
									if the line is ignored redirects must be handled strictly using javascript*/
								}




						}


					}
					else
					{
						return 1;
					}
				return 0;

	}

	public function give_permission($uid,$permission)
	{
		$dbhandle=$this->connection;
		$qry="UPDATE `users` SET `permission`=".$permission ." WHERE uid = ".$uid;
		$result=$dbhandle->query($qry);
		

		return 0;
	}
	public function register_participant(array $dbarray)
	{
					$dbhandle=$this ->connection;
					$default_perm=0;

					function read_text($instr)
					{
						$instr=trim($instr);
						$instr=stripslashes($instr);
						$instr=htmlspecialchars($instr);
						return $instr;

					}
					


						$dbarray['name']=read_text($dbarray['name']);
						$dbarray['number']=read_text($dbarray['number']);
						$dbarray['college_id']=read_text($dbarray['college_id']);
						$dbarray['event_id']=read_text($dbarray['event_id']);
						$qry= $dbhandle->prepare("INSERT INTO `users` (`name`,`eid`,`cid`,`phone`,`permission`) VALUES(?,?,?,?,?)");
						$qry->bind_param("sssss",$dbarray['name'],$dbarray['event_id'],$dbarray['college_id'],$dbarray['number'],$default_perm);
						$qry->execute();
						$qry->close();

								
									
								


					
				return 0;

	}

    function closeconnection()// an extra method to close mysql connection remotely without destroying the object
	{
		$dbhandle= $this->connection;
		$dbhandle->close();
		return 0;
	}


	function __DESTRUCT()// makes sure the mysql connection is closed before the object is destroyed.
	{
		$dbhandle= $this->connection;
		$dbhandle->close();
		return 0;
	}

}


?>
