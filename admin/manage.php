<!doctype html>

<?php
	session_start();
	if(isset($_SESSION['logged']))
	{
		if($_SESSION['logged'] == 0 )
		{
			header('Location: http://sygma.sdm.ac.in/admin/admin.php');
		}

	}
	else
	{
		header('Location: http://sygma.sdm.ac.in');
	}

	if($_SESSION['permissions'] <=5)
	{
		header('Location: http://sygma.sdm.ac.in/admin/event.php');
	}



?>
<html>

	<head>
		<link href="../css/style-dash.css" rel="stylesheet" type="text/css"/>
		<meta name=viewport content="width=device-width, initial-scale=1">
		<title>Sygma 2016-Dashboard</title>
		<link href='http://fonts.googleapis.com/css?family=Josefin+Slab:600,300,400700,600,800,900italic' rel='stylesheet' type='text/css'>
		<meta name="description" content="Sygma Is a State Level IT Fest Organised By Shri Dharmasthala Manjunatheshwara College of Business Management Mangalore
						To Provide a Platform for budding IT Professionals and Technology Enthusiasts to gain Real world experience and showcase thier Various Talents
						Sygma Provides a whole host of events ranging from Technical to Communicational Events.">
		<meta name="keywords" content="SDM,Fest,sygma,sygma 2016, SDM mangalore, mangalore IT fest">
		<meta name="theme-color" content="#607D8B">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500italic,500,400italic,300italic,300,100italic,100' rel='stylesheet' type='text/css'>


	</head>
	<body>
		<?php require "../inline-svg.php";?>
		<header style="padding:20px;">
		
			<span class="material-layer" style="display:none">
			</span>
			<p id="main-heading">Sygma Administrative Tools</p>
			<p style="visibility:hidden" id="uname"><?php echo $_SESSION['name']; ?></p>

		</header>
		<?php
					if($_SESSION['permissions'] < 1)
					{
						echo "<div id='error'>

							<p id='main-heading'>Error: Access Denied, you are not authorised to view this page</p>
						</div>";
						die();

					}

					

		?>

			<nav>
				<a href="http://sygma.sdm.ac.in/admin/manage.php">Home</a>
				<a href="http://sygma.sdm.ac.in/admin/colleges.php">Colleges</a>
				<a href="http://sygma.sdm.ac.in/admin/reg-form.php">Registration</a>
				<a href="http://sygma.sdm.ac.in/admin/events.php">Event Management</a>
				<a href="http://sygma.sdm.ac.in/admin/scores.php">Scores</a>
			</nav>
	
		
		<div id="error" style="display:none">

			<p id="main-heading">Error Message</p>
		</div>
		<div class="main-container">
			<?php
										include "class.scoring.php";
										include "college.register.php";

		   								 require "mysql.login.php";
										$o=new scoring();
										

									
									
		   		 $c=new college();
				  $array=$c->getCollegeArray();

				  $u=new login();

					?>			
			<div class="content">
				

						<h2 style="color:white;">College Statistics</h2>
				<div class="chart">
					<?php

						for ($i=0; $i < $array[0]['max']; $i++) { 
						$n=$u->getMaxUsersFromCollege($array[$i]['c_id']);
						$m = $n * 100;

							echo "
							<div class='bar-graph' style='width:".$m."px'>
								".$array[$i]['college_name']."

							</div>";
						}


					?>
					<div class="bar-graph">
						College 1
					</div>
				</div>
			
			</div>
			<div class="aside">
				<div class="option">

						<div class="option-header">
							<p>Colleges Registered</p>
						</div>
						<p><?php 
							$c->createCollegeList();
							?>
						</p>
							
						

				</div>
				<div class="option">

						<div class="option-header">
							<p>Message Board</p>
						</div>
						<div class="message-box">
							<div class="message">
								<!--<div class="message-header">
									Elvin Dsouza:
								</div>
								<div class="message-body">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Prae
								</div>-->
							</div>
						
						</div>

							<div class="option-header">
							<div class="form-body-part">
								<input id="message" type="text" name="message" placeholder="college name"required/>
								<center><div id="sendmessage" class="material-button circle raised college-accept pink" style=" width:50px; height:50px; border-radius:50%; "><div class="material-layer light"></div><svg class="icon-check"><use xlink:href="#icon-check"></use></svg></div>


							</div>
								
							
						</div>
					</div>
					<?php
						if($_SESSION['permissions'] > 5)
						{
							echo "<div class='option'>
							<div class='option-header'>
								<p>Register New User</p>
							</div>
							<form  class='form-body-part' action='reg.php' method='post'>
							<input type='text' name='name' placeholder='First Name' required>
							<input type='password' name='password' placeholder='password'>
							<input type='password' name='cpassword' placeholder='confirm pass' required>
							
							<input type='email' name='email' placeholder='someone@something.com' required>
							<input type='submit' value='Send' class='Register'>
						</form>
						</div>
						

						</div>";

						}
					?>
					

			</div>
		</div>
		<script>

				$("#sendmessage").click(function(e){
						var message=$("#message").val();
						var username=$("#uname").text();
						  


				    
				   		  $.post('send_message.php',{

				   		  	'message':message,
				   		  	'username':username, 	
				   		  },
				   		  function(data){
				   		  

				   		 });
				});
				var responseRecieved = true;
				setInterval(function(){
					if(responseRecieved == true)
					{
						responseRecieved=false;
						$.get("get_message.php",
				   		 function(data,success)
						{
							 $('.message-box').html(data);
							 if(success)
							 	responseRecieved=true;
							 $('.message-box').scrollTop($('.message-box')[0].scrollHeight);

						});
					}
						

				},3000);
		</script>
</body>
</html>
		<!--<div class="option">

				<div class="option-header">
			<form action="reg.php" method="post" style="border-right:1px solid darkgrey;" id="register">
					<h2 style="color:#333; font-family:'roboto';">Registration Form</h2>
					<p style="color:#333; font-family:'roboto';">Dont have an account?,Register now</p>
						<input type="text" name="name" placeholder="full name" class="text-bx" required>
						<input type="email" name="email" placeholder="someone@something.com" class="text-bx" required>
						<input type="password" name="password" placeholder="password" class="text-bx" required>
						<input type="password" name="cpassword" placeholder="confirm password" class="text-bx" required>
						<input type="submit" value="Send" class="register">
					</form>
				</div>
		</div>-->
	<!--
		<h3> Registered users</h3>
	<table class="tg" style="undefined;table-layout: fixed; width: 1028px">
	<colgroup>
	<col style="width: 72px">
	<col style="width: 331px">
	<col style="width: 162px">
	<col style="width: 132px">
	<col style="width: 116px">
	<col style="width: 215px">
	</colgroup>
	  <tr>
	    <th class="tg-031e">user_id</th>
	    <th class="tg-031e">Name</th>
	    <th class="tg-031e">Permission</th>
	    <th class="tg-031e">event_id</th>
	    <th class="tg-031e">college_id</th>
	    <th class="tg-031e">Email</th>
	  </tr>


				<?php

					if($_SESSION['permissions'] < 1)
					{
						die("Access Denied you do not possess permission to access this page");
					}

					include "mysql.login.php";
					$obj= new login();
					$MAX_USERS=$obj->get_max_users();

					for($i=0; $i < $MAX_USERS; $i++)
					{
						$array=$obj->user_details($i+1);
						echo '<tr><td class="tg-031e">'. $array['uid'].'</td>
						<td class="tg-031e">'.$array['name'] .'</td>
						<td class="tg-031e">'.$array['permission'] .'</td>
						<td class="tg-031e">'.$array['eid'] .'</td>
						<td class="tg-031e">'.$array['cid'] .'</td>
						<td class="tg-031e">'.$array['email'] .'</td>
						</tr>';

					}

				?>

			</table>
		<footer>

		</footer>

	





<!--<h3> Registered users</h3>
	<table class="tg" style="undefined;table-layout: fixed; width: 1028px">
	<colgroup>
	<col style="width: 72px">
	<col style="width: 331px">
	<col style="width: 162px">
	<col style="width: 132px">
	<col style="width: 116px">
	<col style="width: 215px">
	</colgroup>
	  <tr>
	    <th class="tg-031e">user_id</th>
	    <th class="tg-031e">Name</th>
	    <th class="tg-031e">Permission</th>
	    <th class="tg-031e">event_id</th>
	    <th class="tg-031e">college_id</th>
	    <th class="tg-031e">Email</th>
	  </tr>


				<?php

					if($_SESSION['permissions'] < 1)
					{
						die("Access Denied you do not possess permission to access this page");
					}

					include "mysql.login.php";
					$obj= new login();
					$MAX_USERS=$obj->get_max_users();

					for($i=0; $i < $MAX_USERS; $i++)
					{
						$array=$obj->user_details($i+1);
						echo '<tr><td class="tg-031e">'. $array['uid'].'</td>
						<td class="tg-031e">'.$array['name'] .'</td>
						<td class="tg-031e">'.$array['permission'] .'</td>
						<td class="tg-031e">'.$array['eid'] .'</td>
						<td class="tg-031e">'.$array['cid'] .'</td>
						<td class="tg-031e">'.$array['email'] .'</td>
						</tr>';

					}

				?>

			</table>
		
		<table class="tg" style="undefined;table-layout: fixed; width: 1028px">
			<h3> Registered Colleges</h3>
		<colgroup>
		<col style="width: 72px">
		<col style="width: 331px">
		<col style="width: 162px">
		<col style="width: 132px">
		<col style="width: 116px">
		<col style="width: 215px">
		</colgroup>
		  <tr>
		    <th class="tg-031e">college_id</th>
		    <th class="tg-031e">College name/Code</th>

		  </tr>
		  			<?php

						include "college.register.php";
						$obj= new college();
						$MAX_USERS=$obj->get_max_colleges();

						for($i=0; $i < $MAX_USERS; $i++)
						{
							$array=$obj->college_details($i+1);
							echo '<tr><td class="tg-031e">'. $array['cid'].'</td>
							<td class="tg-031e">'.$array['code'] .'</td>

							</tr>';

						}

					?>

				</table>
			<section>
				<article>
					<h3>Register College</h3>
					<form action ="college_register.php" method="post">
						<input type="text" name="college_name" placeholder="college name"required/>
						<input type="text" name="contact_email" placeholder="email"required/>
						<input type="text" name="college_code" placeholder="code"required/>
						<input type="submit" text="submit"/>
					</form>

				</article>

				<article>
					<h3>Register New Event</h3>
					<form action ="event_register.php" method="post">
						<input type="text" name="event_name" placeholder="college name"required/>

						<input type="submit" text="submit"/>
					</form>
				</article>

			</section>
			<section>
				<article>
					<h3>Register New Participant</h3>
					<form action ="register_p.php" method="post">
						<input type="text" name="name" placeholder="participant name"required/>
						<input type="text" name="number" placeholder="participant phone Number"required/>
						<select name="event_id" placeholder="Event" >
							<option value="1">Web Design</option>

						</select>
						<select name="college_id" placeholder="College" required>
							<?php

							$obj= new college();
							$MAX_USERS=$obj->get_max_colleges();
							for($i=0; $i < $MAX_USERS; $i++)
							{
								$array=$obj->college_details($i+1);
								echo "<option value=".$array['cid'].">". $array['college_name'] ."</option>";

							}

							?>

						</select>
						<input type="submit" text="submit"/>
					</form>
				</article>
				<article>
					<h3>Register New Round</h3>
					<form action ="round_register.php" method="post">
						<input type="text" name="round_name" placeholder="Round Name"required/>
						<select name="eid" placeholder="event" required>
							<?php
								include "class.scoring.php";
								$o=new scoring();
								$o->createEventList();

							?>

						</select>
						<input type="submit" text="submit"/>
					</form>
				</article>


			</section>
			<section>

				<article>
					<h3>Change users Permissions</h3>
					<form action ="perm.php" method="post">
						<input type="number" name="user_id" placeholder="user"required/>
						<input type="number" name="permission" placeholder="user"required/>
						<input type="submit" text="submit"/>
					</form>
				</article>


			</section>
		</main>-->
