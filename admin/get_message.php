<?php

/*
	 $db_addr='localhost';
	 $db_user='root';//userusername for the database
	 $db_pw="";//database pssword
	 $db_username='sygma';// database username.
*/
	 $connection; //connection handle ,  to prevent unauthorised usage and modification of the users data from external sources
	 $db_addr='localhost';
	 $db_user='sygmaapp';//userusername for the database
	 $db_pw="sygelvshi15";//database pssword
	 $db_username='sygma2015';// database username.
	


   
	$handle= new mysqli($db_addr, $db_user, $db_pw, $db_username);

	
	
	$query="SELECT * FROM message";
	$array;
	$i=0;
	$result=$handle->query($query);
	if($result->num_rows)
	{
		
		while($row = $result->fetch_assoc())
		{
			
								
			$array[$i]['username']= $row['username'];
			$array[$i]['message']=	$row['message']	;				
								
			$i++;					
									
								
							
		}
	}

	
	
	echo "{chat:",json_encode($array),"}";

	//echo '{chat:[{"username":"Elvin Dsouza","message":"500000"},{"username":"Shivaprasad Bhat","message":"500000"},{"username":"Deepak R.S","message":"500000"}]}';

	

	
?>