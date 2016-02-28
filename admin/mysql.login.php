<?php
/*
----------------------------------------------------------------------------------------------------------
	Mysql Login and Registeration system
----------------------------------------------------------------------------------------------------------

*/
class login
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

	 const REDIRECT_LOGIN = 'Location:../index.php'; // the adress to redirect to after login process is successfully completed
	 const REDIRECT_REGISTER='Location:../index.php'; // the adress to redirect to after the registration process is completed
	 const REDIRECT_LOGIN_ERROR='Location:../index.php';// the adress to redirect if an error is encountered on login process this is optional

    function __CONSTRUCT()
	{

		/*Starts a connection to the mysql database with the user details as specified*/
		$this->connection= new mysqli($this->db_addr, $this->db_user, $this->db_pw, $this->db_name);
		$this->connection->query("CREATE TABLE IF NOT EXISTS
									`users`
									(
										`uid` INT(10) PRIMARY KEY AUTO_INCREMENT,
										`name` VARCHAR(50),
										`permission` INT(10),
										`cid` INT(10),
										`eid` INT(10),
										`password` VARCHAR(256),
										`phone` VARCHAR(50),
										`email` VARCHAR(40)

									)

								");
		return $this->connection;// Returns the connection handle


	}

	public function verifyuser(array $dbarray)//user verification
	{

				$dbhandle= $this->connection;//saves the private connection handle returned by the constructor in a local variable for quick access
				$paswd=hash("sha256" ,$dbarray['password']);//hashes the password string with sha 256 bit encryption
				$q="SELECT * FROM `users` WHERE `email` ='".$dbarray['email']."' "."AND `password` ='".$paswd. "'";//query to check whether a user with the same email id exists or not
				$result = $dbhandle ->query($q);
				//print_r($result); ignore **test**
				if($result->num_rows !=1)//checks if rows are returned from the query if not a error of 1 is returned
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
						$_SESSION['permissions']=$row['permission'];


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

	public function getMaxUsersFromCollege($cid)
	{
				$dbhandle = $this->connection;
				$q="SELECT * FROM `users` WHERE cid=".$cid;
				$result =$dbhandle-> query($q);
				return $result->num_rows;
	}
	public function getUsersFromCollege($cid)
	{
				$handle=$this->connection;
				$qry="SELECT * FROM `users` WHERE cid=".$cid;
				$i = 0;
				$user;
				$result=$handle->query($qry);
				if($result->num_rows)
				{
					while($row = $result->fetch_assoc())
					{
						$user[$i]['e_id']=$row['eid'];
						$user[$i]['phone']=$row['phone'];
						$user[$i]['email']=$row['email'];
						$user[$i]['username']=$row['name'];
						$i++;
					}
				}
				return $user;
	}
	public function deleteUsersFromCollege($cid)
	{
				$handle=$this->connection;
				$query="DELETE FROM users WHERE cid=".$cid;
				$handle->query($query);
	}
	public function get_max_users_in_event($eventid)
	{
				$dbhandle = $this->connection;
				$q="SELECT * FROM `users` WHERE eid=".$eventid;
				$result =$dbhandle-> query($q);
				return $result->num_rows;
	}

	public function get_users_in_event($eventid)
	{

		$handle=$this->connection;
		$qry="SELECT * FROM `users` WHERE eid=".$eventid;
		$i = 0;
		$parts;
		$result=$handle->query($qry);
		if($result->num_rows)
		{
			
			while($row = $result->fetch_assoc())
			{

				$parts[$i]['c_id']=$row['cid'];
				$parts[$i]['username']=$row['name'];
				$i++;
			}
		}
		return $parts;


	}

	public function get_unique_users_in_event($eventid)
	{

		$handle=$this->connection;
		$qry="SELECT DISTINCT cid FROM `users` WHERE eid=".$eventid;
		$i = 0;
		$parts;
		$result=$handle->query($qry);
		$parts[0]['max']=$result->num_rows;
		if($result->num_rows)
		{
			while($row = $result->fetch_assoc())
			{

				$parts[$i]['c_id']=$row['cid'];

				$i++;
			}
		}
		return $parts;


	}


	public function user_register(array $dbarray)// this method registers a user in the database
	{



					function read_text($instr) // function to read text
					{
						$instr=trim($instr);
						$instr=stripslashes($instr);
						$instr=htmlspecialchars($instr);
						return $instr;

					}
					$dbhandle = $this->connection;
					if($dbarray['password'] == $dbarray['cpassword'])//checks if the confirm password matches the entered password
					{


						$dbarray['name']=read_text($dbarray['name']);//stripslashes name and email
						$dbarray['email']=read_text($dbarray['email']);


								$q="SELECT * FROM `users` WHERE `email` ='".$dbarray['email']."'";//selects from users with the email as key
								$result = $dbhandle -> query($q);
								if($result->num_rows)// if the query results in rows returned , ie, a user with that username already exists an error code 3 is returned
								{
										return 3;

								}
								else// inserting values into the table when there are no errors found
								{
									$fpass="";

										$fpass=hash('sha256',$dbarray['password']);//hashes the password to be stored in the database

									/*$qry= $dbhandle->prepare("INSERT INTO `users` (`name`, `password`,`email`) VALUES(?,?,?)");
									$qry->bind_param("sss",$dbarray['name'],$fpass,$dbarray['email']);
									$qry->execute();*/

									$qry="INSERT INTO `users` (`name`, `password`,`email`) VALUES('".$dbarray['name']."','".$fpass."','".$dbarray['email']."')";
									$dbhandle->query($qry);
									$_SESSION['logged']=1;
									$_SESSION['name']=$dbarray['name'];




									//$qry->close();
									$dbhandle->close();
									//header(self :: REDIRECT_REGISTER);
									/*to handle the redirect from the login page directly from the server the above line must be uncommented
									if the line is ignored redirects must be handled strictly using javascript*/






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
					$default_perm=1;


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

						if($dbarray['name'] !='')
						{
								$qry= "INSERT INTO `users` (`name`,`eid`,`cid`,`phone`,`permission`) VALUES('".$dbarray['name']."',".$dbarray['event_id'].",".$dbarray['college_id'].",'".$dbarray['number']."',".$default_perm.")";
								$dbhandle->query($qry);
						}










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

		return 0;
	}

}

/*

---------------------------------------------------------Registration form Example------------------------------------------------------------------------------------------------------------


					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
						<input type="text" name="name" placeholder="First Name" required>
						<input type="text" name="lastname" placeholder="Last name">
						<br/><br>
						<input type="email" name="email" placeholder="someone@something.com" required>
						<br/><br>
						<input type="password" name="password" placeholder="password" required>

						<input type="password" name="cpassword" placeholder="confirm password" required><?php if($flag > 0)echo "<span id='error'>passwords entered do not match</span>";
						else echo "<svg class='icon-checkmark'><use xlink:href='#icon-checkmark'></use></svg>"?>

						<br>
						<br>
						<input type="radio" name="sex" value="male" required><label for="male">male</label>
						<input type="radio" name="sex" value="female" required><label for="female">female</label>
						<br>
						<br>
						<input type="submit" value="Send" class="Register">
					</form>

------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------Login Form Example--------------------------------------------------------------------------------------------------------------

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
						<input type="email" name="email" placeholder="someone@something.com" required>
						<br/><br>
						<input type="password" name="password" placeholder="password" required>
						<?php if($flag)
						{
							echo "<span id='error'>username/password invalid</span>";
						}	?><br><br>
						<input type="submit" value="Login" class="Register"><br><br>
						<a href="../network/recovery.php">Forgot your password? request a new one</a><br/>
						<a href="../network/register.php">Havent Signed up yet? register an account now!</a>

					</form>
					class="text-bx"class="text-bx"class="text-bx"class="text-bx"
-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


*/
?>
