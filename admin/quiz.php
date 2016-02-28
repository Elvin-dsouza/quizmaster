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
				<a href="http://sygma.sdm.ac.in/admin/quiz's.php">Quizes</a>
			</nav>
	
		
		<div id="error" style="display:none">

			<p id="main-heading">Error Message</p>
		</div>
		<div class="main-container">
			
					
			<div class="content">
				

					
			
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
		





