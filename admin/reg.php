<?php


	require "mysql.login.php";
	
		
		
	
		$ilogin= new login();
		$flag=$ilogin->user_register($_POST);
		if($flag)
		{
			$_SESSION['error']=$flag;
			echo "Registration terminated with error code:" . $flag;
			
			
		}
		else
		{
			$_SESSION['logged']=1;
			echo " Registration Successful";

	
			
		}
		

	

?>