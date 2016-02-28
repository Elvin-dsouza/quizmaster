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
		
		<?php
					if($_SESSION['permissions'] < 1)
					{
						echo "<div id='error'>

							<p id='main-heading'>Error: Access Denied, you are not authorised to view this page</p>
						</div>";
						die();

					}
					$round=$_GET['rid'];
					$event=$_GET['eid'];
					require "class.scoring.php";
					require "college.register.php";
					$s=new scoring();
					$c=new college();
					$scores=$s->getScore($event,$round);
					$ename=$s->getEventNameFromID($event);
					$rname=$s->getRoundNameFromID($round);

					//$c->getCollegeNameFromID($cid);

					

		?>
		<h1><?php echo $ename;?></h1>
		<h2><?php echo $rname;?> Score Sheet</h2>
		<h2>Sygma 2016 </h2>
		<table>
			
			<tr>
				<th style="max-width:60px;">sno</th>
				<th>College Code</th>
				
				<th>Final Result</th>
			</tr>
			<?php

				for ($i=0; $i < $scores[0]['max']; $i++) { 
					$sno = $i+1;
					$a=$c->getCollegeCodeFromID($scores[$i]['c_id']);

					echo "
						<tr>
							<td  style='max-width:60px;'>".$sno."</td>
							<td>".$a."</td>
						
							<td>".($scores[$i]['score2']+$scores[$i]['score1'])."</td>
						</tr>

					";
				}


			?>
			
		</table>
		
			
		
	</body>
</html>