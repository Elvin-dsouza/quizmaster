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
		<link href="../css/style-scsheet.css" rel="stylesheet" type="text/css"/>
		<meta name=viewport content="width=device-width, initial-scale=1">
		<title>Sygma 2016-College</title>
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

		<?php
					if($_SESSION['permissions'] < 1)
					{
						echo "<div id='error'>

							<p id='main-heading'>Error: Access Denied, you are not authorised to view this page</p>
						</div>";
						die();

					}

					$event=$_GET['eid'];
					require "class.scoring.php";
					require "mysql.login.php";
					require "college.register.php";
					$s=new scoring();
					$c=new college();
					$u=new login();
					$users = $u->get_users_in_event($event);
				  $max = $u->get_max_users_in_event($event);




		?>
		<h1>Sygma 2016 Registration Form</h1>

		<h1><?php echo $s->getEventNameFromID($event);?></h1>

		<h2>Sygma 2016 </h2>
		<table style="width:85%; margin:0 auto;">

			<tr>
				<th style="max-width:60px;">sno</th>
				<th>Participant Name</th>
				<th>College code</th>
			</tr>
			<?php

				for ($i=0; $i < $max; $i++) {
					$sno = $i+1;

					$code = $c->getCollegeCodeFromID($users[$i]['c_id']);
					echo "<tr>
							<td  style='max-width:60px;'>".$sno."</td>
							<td>".$users[$i]['username']."</td>
							<td>".$code."</td>


						</tr>";
				}


			?>

		</table>



	</body>
</html>
