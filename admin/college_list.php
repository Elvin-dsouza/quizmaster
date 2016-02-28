 <?php
		   		 require "mysql.login.php";
		   		 require "class.scoring.php";
		 		 require "college.register.php";
				  $s=new scoring();
				  $c=new college();
				  	$u=new login();


								$n=$u->getMaxUsersFromCollege($_POST['cid']);

								echo "<table>";
								echo "<tr><th>Contestants Name</th><th>Phone Number</th><th>Event Name</th></tr>";
								$users=$u->getUsersFromCollege($_POST['cid']);
								for ($j=0; $j < $n ; $j++) {
									echo "<tr><td>".$users[$j]['username']." </td><td>".$users[$j]['phone']." </td><td>".$s->getEventNameFromID($users[$j]['e_id'])."</td> </tr>";
								}
								echo "</table>"



?>
