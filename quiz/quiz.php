<!doctype html>
<?php

	session_start();
	if(!isset($_GET['qid']))
	{
		die("Please Provide a valid quiz id");
	}
	require "class.quiz.php";
?>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
		<script src="js/mustache.js"></script>

		<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500italic,500,400italic,300italic,300,100italic,100' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="favicon.ico">
	</head>
	<body>


	<?php require "../inline-svg.php";?>



		<header>


			<article id="heading-area">

				<h1><?php
						$id = $_GET['qid'];
						$q = new quiz();
						$q->getQuizName($id);
					?>
				</h1>
			</article>
		</header>
		<section id="content" >
			<nav class="main-nav">
			</nav>
				<div class="timer-box"style="">TIMER</div>
			<section class="card registration" style="margin-top:0px;">
				<section class="question-cover" style="display:none"></section>
				<h3>Please Enter your Name/Code to Continue.</h3>
				<p style="font-size:17px; color:grey;">Note: The name should not contain double or single quotes</p>
				<p style="font-size:17px; color:grey;">closing the browser on commencement of the quiz will disqualify you.</p>

				<p id="quizid" style="visibility:hidden;"><?php echo $_GET['qid']; ?></p>
				<p id="timerno"  style="visibility:hidden;"><?php  if($_GET['qid'] == 6) echo"15"; else echo"20"; ?></p>
				<input class="team-code" type="text" placeholder="Team Code"/>
				<div class="material-button circle raised team-accept" style=" width:50px; height:50px ; margin:50px; border-radius:50%;padding:0px; "><div class="material-layer light"></div><svg class="icon-check"><use xlink:href="#icon-check"></use></svg></div>

			</section>
			<div class="page-wipe">

				Time's Up
			</div>
			<?php

				$q->populateQuiz($id);

			?>



				<footer>
			<section>
			<article>

				<h3>SYGMA 2016</h3>
				<p>SDM College of Business Management Mangalore</p>
				<p>Email: sygma@sdm.ac.in</p>
				<p>Ph:0824 2424186</p>

			</article>


		</footer>
		 <script type="text/javascript">
		      window.onbeforeunload = function() {
		          return "Exiting this screen ends the quiz Continue?"
      			}
    	</script>
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
				$(".page-wipe").hide();
				$(".material-button").click(function(e){
			 var parentOffset = $(this).offset();//get the offset of the parent of the material layer from the window
			 var $layer = $('<div/>');//define a new div
			 $layer.addClass("material-layer");// add the material-layer class to the div
			 var relX = e.pageX - parentOffset.left;//page click x - offset of the button(x)
			 var relY = e.pageY - parentOffset.top;//page click y - offset of the button(y)
			 $layer.css({
				 "left":relX,
				 "top":relY,
			 });//assign the respective offset x y coords for the element

			 $layer.appendTo($(this));//append the created div to the button
			 $layer.show();//show the element
			 $layer.addClass("animate");//animate the element

			 setTimeout(function(){
			 $layer.remove();//remove after 2 seconds

			 },2000);



		});
				 $(".accept").click(function(e){



				          $(this).parent().find(".question-cover").css({
				          	"display":"block"
				          });
				          var answer=$(this).parent().find("form input[type='radio'][name='answer']:checked").val();
				          var scor;
				          console.log(answer);
				          if(answer == 'AA')
				          	scor=10;

				          else
				          	scor=0;
				   		  $.post('score.php',{ 'user': teamCodeName,'s': scor ,'id':quiz_id },
				   		  function(data,status){

				   		  });

		          });
				 var mm=$('#timerno').text();
				 var ss=00;
				  $(".team-accept").click(function(e){


				 		 $(this).parent().find(".question-cover").css({
				          	"display":"block"
				          });
				          var team_code=$(this).parent().find("input").val();


				        teamCodeName=team_code;

				   		  $.post('team-reg.php',{

				   		  	'user':team_code,
				   		  	'id':quiz_id

				   		  },
				   		  function(data,status){
				   		  		$('.question').each(function(index, el) {
				   		  			$(this).fadeIn('fast');
				   		  		});
				   		  		var interval=setInterval(function(){
									if(mm == 00 && ss ==00)
									{
										clearInterval(interval);
										$(".page-wipe").show();
									}
									else if(ss == 00)
									{
										mm--;
										ss=60;

									}
									else
									{
										ss--;
									}
									$('.timer-box').html(mm+":"+ss);

								},1000);
				   		  	});


		          });
				/* $(".submit-info").click(function(e) {
				 	$.post('create_player.php',{

				 		team: $('input').val();

				 	}
				 	,function(data,status){
				 		if(data == 'true')
				 		{

				 		}

				 	});
				 });*/
			</script>

	</body>
</html>
