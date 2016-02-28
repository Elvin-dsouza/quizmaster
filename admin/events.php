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



?>
<html>
	<head>
		<link href="../css/style-dash.css" rel="stylesheet" type="text/css"/>
		<meta name=viewport content="width=device-width, initial-scale=1">
		<title>Sygma 2016-Event Dashboard</title>
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
		<header style="padding:20px;">

			<span class="material-layer" style="display:none">
			</span>
			<p id="main-heading">Sygma Administrative Tools</p>


		</header>
		<?php
					if($_SESSION['permissions'] < 5)
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
			<div class="content">
				<div class='option-container'>
			 <?php require "college.register.php";
			 require "class.scoring.php";
			 $s=new scoring();
					 require "mysql.login.php";
					 $c=new college();
					$array=$s->GetEventList();
					$max=$s->getMaxEvents();

					$u=new login();

					for ($i=0; $i < $max; $i++) {
						$n=$u->get_max_users_in_event($array[$i]['e_id']);

							echo "
							<div class='option' style='width:100%; margin:1px;'>
								<div class='option-header'>
									<a href='http://sygma.sdm.ac.in/admin/event_list.php?eid=".$array[$i]['e_id']."'>".$array[$i]['e_id'].")  ".$array[$i]['event_name']."     (". $n." Participants)</a>

								</div>";

							echo "</div>";
					}
			?>
		</div>
			</div>
			<div class="aside">

				<div class="option">
						<div class="option-header">

							<p>Register Rounds</p>
							</div>
							<form action ="round_register.php" method="post" class="form-body-part">
								<input type="text" name="round_name" placeholder="Round Name"required/>
								<select name="eid" placeholder="event" required>
									<?php
										include "class.scoring.php";
										include "college.register.php";
										include "mysql.login.php";
										$o=new scoring();
										$o->createEventList();

									?>

								</select>
								<input type="submit" text="submit"/>
							</form>



					</div>
					 <?php if($_SESSION['permissions'] <=5)
					{
						die();

					}?>
				<div class="option">

						<div class="option-header">
							<p>Register Events</p></div>
							<form action ="event_register.php" method="post" class="form-body-part">
								<input type="text" name="event_name" placeholder="event name"required/>

								<input type="submit" text="submit"/>
							</form>

					</div>


		</div>

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




			</table>
		<footer>

		</footer>






	</body>
</html>
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
