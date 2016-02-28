<!doctype html>
<?php

	session_start();

		if(isset($_SESSION['logged']))
		{
			if($_SESSION['logged'] == 0 || $_SESSION['permissions'] < 5 )
			{
				header('location:../admin/admin.php');
			}

		}
		else
		{
			header('location:../index.php');
		}
?>
<html>
	<head>
		<link href="../css/quiz-page.css" rel="stylesheet" type="text/css"/>
		<meta name=viewport content="width=device-width, initial-scale=1">

		<title>Sygma 2016-A State Level IT Fest</title>
		<link href='http://fonts.googleapis.com/css?family=Josefin+Slab:600,300,400700,600,800,900italic' rel='stylesheet' type='text/css'>
		<meta name="description" content="Sygma Is a State Level IT Fest Organised By Shri Dharmasthala Manjunatheshwara College of Business Management Mangalore
						To Provide a Platform for budding IT Professionals and Technology Enthusiasts to gain Real world experience and showcase thier Various Talents
						Sygma Provides a whole host of events ranging from Technical to Communicational Events.">
		<meta name="keywords" content="SDM,Fest,sygma,sygma 2016, SDM mangalore, mangalore IT fest">
		<meta name="theme-color" content="#607D8B">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="../js/mustache.js"></script>

		<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500italic,500,400italic,300italic,300,100italic,100' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="favicon.ico">
	</head>
	<body>
		<?php require "../inline-svg.php";?>





		<header>


			<article id="heading-area">
				<figure><img src="../images/logo.png" alt="SDMCBM" /></figure>
				<h1><?php require "class.quiz.php";
						$id = $_GET['qid'];
						$q = new quiz();
						$q->getQuizName($id);
					?></h1>
			</article>
		</header>
		<section id="content" >
			<nav class="main-nav">
				<a href="index.php"><div class="material-button square flat" style="padding:0px; "><div class="material-layer dark"></div><svg class="icon-back"><use xlink:href="#icon-arrow_back"></use></svg></div></a>

			</nav>
				<p id="quizid" style="visibility:hidden;"><?php echo $_GET['qid']; ?></p>

			<section class="card question" >
				<section class="question-cover" style="display:none"></section>

				<form>
					<input class="team-code" id="question" type="text" placeholder="Question Sentence"/>
					<span class="answer-row">
						<span class="answer"><input class="team-code" type="text" placeholder="Answer 1" id="opt1"/></span>
						<span class="answer"><input class="team-code" type="text" placeholder="Answer 2" id="opt2"/></span>
					</span>
					<span class="answer-row">
						<span class="answer"><input class="team-code" type="text" placeholder="Answer 3" id="opt3"/></span>
						<span class="answer"><input class="team-code" type="text" placeholder="Answer 4" id="opt4"/></span>
					</span>
					<span class="answer-row">
						<span class="answer"><input class="team-code" type="text" placeholder="Answer Number" id="ans"/></span>

					</span>

				</form>
				<div class="material-button circle raised accept" style=" width:50px; height:50px ; border-radius:50%;padding:0px; "><div class="material-layer light"></div><svg class="icon-check"><use xlink:href="#icon-check"></use></svg></div>

			</section>




				<footer>
			<section>
			<article>

				<h3>SYGMA 2016</h3>
				<p>SDM College of Business Management Mangalore</p>
				<p>Email: sygma@sdm.ac.in</p>
				<p>Ph:2398342324</p>
				<div class="material-button square raised" style="width:70px"><div class="material-layer light"></div>Visit Website</div>
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
			function escapeHtml(text) {
				return text
						.replace(/&/g, "&amp;")
						.replace(/</g, "&lt;")
						.replace(/>/g, "&gt;")
						.replace(/"/g, "&quot;")
						.replace(/'/g, "&#039;");
				}
				var quiz_id = $('#quizid').text();
				var animStart = 0;
				var teamCodeName;
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
				 $(".accept").click(function(e){


				 			var question = escapeHtml($('#question').val());
				 			var o1 = escapeHtml($('#opt1').val());
				 			var o2 = escapeHtml($('#opt2').val());
				 			var o3 = escapeHtml($('#opt3').val());
				 			var o4 = escapeHtml($('#opt4').val());
				 			var ans = $('#ans').val();
				      	 $.post('question_reg.php',
				      	 	{
				      	 		'question': question,
				      	 		'opt1': o1,
				      	 		'opt2': o2,
				      	 		'opt3': o3,
				      	 		'opt4': o4,
				      	 		'ans':ans,
				      	 		'id':quiz_id

				      	 	},
				   		  function(data,status){
				   		  		if(data == 'recieved')
				   		  		{
				   		  			 $('#opt1').val('');
				   		  			 $('#opt2').val('');
				   		  			 $('#opt3').val('');
				   		  			 $('#opt4').val('');
				   		  			 $('#ans').val('');
				   		  			 $('#question').val('');
				   		  		}
				   		  		else
				   		  		{
				   		  			window.alert('Error Creating Question Please Contact Administrator');
				   		  		}
				   		  });

		          });


			</script>

	</body>
</html>
