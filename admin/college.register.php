<?php
/*
----------------------------------------------------------------------------------------------------------
	College Registration System
----------------------------------------------------------------------------------------------------------
CREATE TABLE `college` (
 `cid` int(10) NOT NULL AUTO_INCREMENT,
 `college_name` varchar(50) DEFAULT NULL,
 `code` varchar(50) DEFAULT NULL,
 `score` int(10) DEFAULT NULL,
 `email` varchar(50) DEFAULT NULL,
 PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1

*/
class college
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

	 const REDIRECT_LOGIN = 'Location:../index.php'; // the adress to redirect to after login process is successfully completed
	 const REDIRECT_REGISTER='Location:../index.php'; // the adress to redirect to after the registration process is completed
	 const REDIRECT_LOGIN_ERROR='Location:../index.php';// the adress to redirect if an error is encountered on login process this is optional


    function __CONSTRUCT()
	{

		/*
			Starts a connection to the mysql database with the user details as specified
		*/
		$this->connection= new mysqli($this->db_addr, $this->db_user, $this->db_pw, $this->db_name);
		$this->connection->query("CREATE TABLE IF NOT EXISTS `college` (
								 `cid` int(10) NOT NULL AUTO_INCREMENT,
								 `college_name` varchar(50) DEFAULT NULL,
								 `code` varchar(50) DEFAULT NULL,
								 `score` int(10) DEFAULT NULL,
								 `email` varchar(50) DEFAULT NULL,
								 PRIMARY KEY (`cid`)
								)


								");
		return $this->connection;// Returns the connection handle


	}



	public function college_details($cid)
	{
				$dbhandle = $this->connection;
				$q="SELECT * FROM `college` WHERE `cid` = ".$cid;
				$result =$dbhandle-> query($q);
				if($result->num_rows < 1)
				{

					//error condition
				}

				$row = $result-> fetch_assoc();
				return $row;
	}

	public function createCollegeList()
	{
				$dbhandle = $this->connection;
				$q="SELECT * FROM `college`";
				$result =$dbhandle-> query($q);
				if($result->num_rows )
				{

					while($row = $result-> fetch_assoc())
					{
						echo $row['college_name']."<br/>";
					}

				}

				
				
	}


	public function get_max_colleges()
	{
				$dbhandle = $this->connection;
				$q="SELECT * FROM `college`";
				$result =$dbhandle-> query($q);
				return $result->num_rows;
	}



	public function college_register(array $dbarray)
	{
					$dbhandle=$this ->connection;
					function read_text($instr)
					{
						$instr=trim($instr);
						$instr=stripslashes($instr);
						$instr=htmlspecialchars($instr);
						return $instr;

					}


					$id=0;
						$dbarray['college_name']=read_text($dbarray['college_name']);
						$dbarray['contact_email']=read_text($dbarray['contact_email']);
						$dbarray['college_code']=read_text($dbarray['college_code']);
						if($dbarray['college_name'] !='' && $dbarray['contact_email'] !='' && $dbarray['college_code']!='')
						{
							$dbhandle= new mysqli($this->db_addr, $this->db_user, $this->db_pw, $this->db_name);
							if($dbhandle->connect_error)// if the connection to the mysql server is lost this method returns an error code "2";
							{
								die ("Connection Failed: ". $dbhandle->connect_error);
								

							}
							else
							{
									$q="SELECT * FROM `college` WHERE `email` ='".$dbarray['contact_email']."' LIMIT 1";
									$result = $dbhandle -> query($q);
									if(!$result->num_rows)// if the query results in rows returned , ie, a user with that username already exists an error code 3 is returned
									{


										$qry="INSERT INTO `college` (`college_name`,`email`,`code`) VALUES('".$dbarray['college_name']."','".$dbarray['contact_email']."','".$dbarray['college_code']."')";
										$dbhandle->query($qry);
										$_SESSION['college_registeration']=1;
										$_SESSION['college_name']=$dbarray['college_name'];
										$_SESSION['college_code']=$dbarray['college_code'];
										$id=$dbhandle->insert_id;

									}




							}
							return $id;
						}
						else
						{
							return -1;
						}
						
						
						
						
						


				

	}

	public function getCollegeArray()
	{
		$handle=$this->connection;		
		$qry="SELECT * FROM college";
		$i = 0;
		$college;
		$result=$handle->query($qry);

		if($result->num_rows)
		{
			
			while($row = $result->fetch_assoc())
			{
				$college[$i]['c_id']=$row['cid']; 
				$college[$i]['college_name']=$row['college_name']; 
				$college[$i]['code']=$row['code']; 
				$i++;
			}
		}
		$college[0]['max']=$result->num_rows;
		return $college;

	}
	public function getCollegeCodeFromID($cid)
	{
		$handle=$this->connection;		
		$qry="SELECT * FROM college WHERE cid=".$cid;
		
		$result=$handle->query($qry);

		if($result->num_rows)
		{
			
			$row = $result->fetch_assoc();
		}
		
		return $row['code'];

	}

	public function deleteCollege($cid)
	{
		$handle=$this->connection;
		$handle->query("DELETE FROM college WHERE cid=".$cid);
		
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

CREATE TABLE `users` (`uid` INT(10) PRIMARY KEY AUTO_INCREMENT, `name` VARCHAR(50), `permission` INT(10), `cid` INT(10), `eid` INT(10));
*/
?>
