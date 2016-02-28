<!doctype html>
<?php

	session_start();
?>
<html>
	<head>
		<link href="../css/admin.css" rel="stylesheet" type="text/css"/>
		<meta name=viewport content="width=device-width, initial-scale=1">
		<title>Sygma 2016-Administration Login</title>
		<link href='http://fonts.googleapis.com/css?family=Josefin+Slab:600,300,400700,600,800,900italic' rel='stylesheet' type='text/css'>
		<meta name="description" content="Administration Login for Fest Scoring and Management">
		<meta name="theme-color" content="#607D8B">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500italic,500,400italic,300italic,300,100italic,100' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="favicon.ico">
	</head>
	<body>
		<?php require "../inline-svg.php";?>
	

		<header>

			
			<article id="heading-area">
				<figure><img src="../images/logo.png" alt="SDMCBM" /></figure>
				<h1>Administration Login</h1>
				
			</article>
		</header>
		<section id="content" >
			<nav class="main-nav">
				<a href="index.php"><div class="material-button flat" style="padding:0px; "><div class="material-layer dark"></div><svg class="icon-back"><use xlink:href="#icon-arrow_back"></use></svg></div></a>
				
			</nav>
			<article>
				<h3>Please enter Your Username And password to Continue.... </h3>
				<p>
					if you are unauthorised to use this site, or you have been redirected here please return to the <a href="sygma.sdm.ac.in">main site</a>
				</p>
			</article>
			<form action="login.php" method="post" id="login">
					<h2 style="color:#333; font-family:'roboto';">Login/Registration Form</h2>
						<input type="email" name="email" placeholder="someone@something.com" class="text-bx" required>
						<input type="password" name="password" placeholder="password" class="text-bx" required>
						<input type="submit" value="Login" class="register"><br><br>


				</form>
		

				
		
		</section>
		<footer>
			<section>
			<article>

				<h3>SYGMA 2016</h3>
				<p>SDM College of Business Management Mangalore</p>
				<p>Email: sygma@sdm.ac.in</p>
				<p>Ph:2398342324</p>
				<div class="material-button raised" style="width:70px"><div class="material-layer light"></div>Visit Website</div>
			</article>
			<aside>
			<h3>FOLLOW SYGMA</h3>
			<nav>
				<a href="#">Facebook</a>
				<a href="#">Twitter</a>
				<a href="#">Youtube</a>
				<a href="#">Google Plus</a>

		</aside>
				<aside>
				<h3>LINKS</h3>
				<nav>
					<a href="#">Online Registeration</a>
					<a href="#">Videos</a>
					<a href="#">About</a>
					<a href="#">Contact</a>
					<a  onclick="open_modal();" href="#">Admin Login</a>
					<a href="#">Administration Tools</a>
					<a href="#">Back to Top</a>
			</aside></section>



		</footer>
			<script>
				var animStart = 0;
		 $(".material-button").click(function(e){

		 		if(animStart == 0)
		 		{
		 			animStart=1;
		 			 var parentOffset = $(this).offset();
		               var $layer = $(this).find(".material-layer");
		               //or $(this).offset(); if you really just want the current element's offset
		               var relX = e.pageX - parentOffset.left;
		               var relY = e.pageY - parentOffset.top;

		               $layer.css({
		                 "left":relX,
		                 "top":relY,
		               });
		            $layer.addClass("animate");
		              setTimeout(function(){
		                  $layer.removeClass("animate");
		                  animStart=0;
		              },500);
		 		}
              

          });
			</script>

	</body>
</html>
