 <?php
		   		 require "mysql.login.php";
		   		 require "class.scoring.php";
		       require "college.register.php";
				  $s=new scoring();
				  $u=new login();
          $c=new college();


					$u->deleteUsersFromCollege($_POST['cid']);
          $c->deleteCollege($_POST['cid']);


?>
