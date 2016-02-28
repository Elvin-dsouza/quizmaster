<!doctype html>

<?php
	session_start();
	if(isset($_SESSION['logged']))
	{
		if($_SESSION['logged'] == 0 )
		{
			header('location:../index.php');
		}

	}
	else
	{
		header('location:../index.php');
	}



?>
<html>
	<head>
		<link href="../css/style-dash.css" rel="stylesheet" type="text/css"/>
		<meta name=viewport content="width=device-width, initial-scale=1">
		<title>Sygma 2016-create new scoresheet</title>
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
	<header style=" padding:20px;">
			<span class="material-layer" style="display:none">
			</span>
			<p id="main-heading">Score sheet</p>
			<?php

					if($_SESSION['permissions'] < 2)
					{
						die("Access Denied you do not possess permission to access this page");
					}

					

				?>
			<p id="main-heading" style="text-align:right; padding-left:50px;">Currently logged in as <?php echo $_SESSION['name'];?></p>
		</header>
		<div id="error" style="display:none">

			<p id="main-heading">Error Message</p>
		</div>
		<?php

		require "class.scoring.php";
		require "college.register.php";
		require "mysql.login.php";
		$o=new scoring();
		$u=new login();
		$array = $u->get_unique_users_in_event($_GET['event']);
		$n = $array[0]['max'];
		$events = $o->getEventInfo($_GET['event']);
		$c=new college();


		?>
		<div id="form-container">

			<div class="form-item">
					<div class="form-header" style="position:relative;">
						<h5 class="head" id="college"><?php echo $events['event_name']." ";?>Score Sheet</h5>
						<h5 class="head" id="contact"></h5>
						<h5 class="head" style="visibility:hidden;" id="event_i"><?php echo $_GET['event'];?></h5>
						<div class="material-button circle raised college-accept pink" style=" width:50px; position:absolute; bottom:-75px; right:-25px;height:50px ; margin:50px; border-radius:50%;padding:0px; "><div class="material-layer light"></div><svg class="icon-check"><use xlink:href="#icon-check"></use></svg></div>

						<div class="form-body">
						
						
						<select name="round" id="round">
							<?php
								$o->createRoundList($_GET['event']);


							?>
						</select>
					</div>

				</div>
				<?php

					for ($i=0; $i < $n; $i++) { 
						echo "<div class='form-body-part'>
								<p id='collegeid' style='visibility:hidden'>".$array[$i]['c_id']."</p>
								<h5>".$c->getCollegeCodeFromID($array[$i]['c_id'])."</h5>
								<input type='number' name='name' placeholder='Score 1' id='score1' required/>
								<input type='number' name='email' placeholder = 'Score 2' id='score2'required/>
								<input type='checkbox' name='eliminate' value='1'/>
							  </div>";
					}
				?>
			</div>
			<div class="material-button circle raised registration-accept" style=" width:50px; height:50px ; margin:50px; border-radius:50%;padding:0px; "><div class="material-layer light"></div><svg class="icon-check"><use xlink:href="#icon-check"></use></svg></div>
				
	</div>
			



				

		<footer>

		</footer>
		<script type="text/javascript">
		var roundid=$("#round").val();
	    var eventid=$("#event_i").text();
			$(".college-accept").click(function(e){
						
				   		
				   		 
				   		  
				   		  	$('.form-body').fadeOut('fast', function() {
				   		  		
				   		  	});
				   		  	
				
				   		  	$('#contact').text(roundid);
				   		  	$('.pink').fadeOut('fast', function() {
				   		  		
				   		  	});


				   		 
			});
			$(".registration-accept").click(function(e){

						  

				   		$(".form-body-part").each(function(i){
				   			var $score1=$(this).find("#score1");
						  	var $score2=$(this).find("#score2");
						    var $collegeid=$(this).find("#collegeid");
						 
						    	$.post('score_add.php',{

						   		  	'score1':$score1.val(),
						   		  	'score2':$score2.val(),
						   		  	'college_id':$collegeid.text(),
						   		  	'event_id':eventid,
				   		  			'round_id':roundid


						   		 	 },
					   		  	  	function(data){
					   		  					

					   		 		});
						    
					   			
				   		 

						});  		  	

		    });
		</script>
	




	</body>
</html>
