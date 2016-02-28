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
	<header style=" padding:20px;">
			<span class="material-layer" style="display:none">
			</span>
			<a href="manage.php"><div class="material-button flat" style="padding:0px; "><div class="material-layer dark"></div><svg class="icon-back"><use xlink:href="#icon-arrow_back"></use></svg></div></a>
			<p id="main-heading">College Registration Form</p>
			<?php

					if($_SESSION['permissions'] < 1)
					{
						die("Access Denied you do not possess permission to access this page");
					}

					

				?>
			<p id="main-heading" style="text-align:right; padding-left:50px;">Currently logged in as <?php echo $_SESSION['name'];?></p>

		</header>
		<div class="modal" style="display:none; ">
			<div class="option" style="width:50%" >

						<div class="option-header">
							<p>Registering Contestants</p>
						</div>
						<div class="progress-bar" style="max-width:100%;" ></div>
						<div class="option-header" id="button-bar">
								<span style="display:flex;"><div id="sendmessage" class="material-button circle raised accept-reg " style=" width:50px; height:50px; border-radius:50%; "><div class="material-layer light"></div><svg class="icon-check"><use xlink:href="#icon-check"></use></svg></div>
								<div id="sendmessage" class="material-button circle raised cancel-reg " style=" width:50px; height:50px; border-radius:50%; margin-left:20px;"><div class="material-layer light"></div><svg class="icon-check"><use xlink:href="#icon-clear"></use></svg></div>
								</span>
							
						</div>
						<div class="list">
							
						</div>
						
			</div>
								
							
		</div>
		
		<div id="error" style="display:none">

			<p id="main-heading">Error Message</p>
		</div>
		<?php

		require "class.scoring.php";
		$o=new scoring();
		$array = $o->getEventList();
		$n = $o->getMaxEvents();

		?>
		<div id="form-container">

			<div class="form-item">
					<div class="form-header" style="position:relative; background:#9C27B0;">
						<h5 class="head" id="college">College Registration</h5>
						<h5 class="head" id="contact"></h5>
						<div class="material-button circle raised college-accept pink" style=" width:50px; position:absolute; bottom:-75px; right:-25px;height:50px ; margin:50px; border-radius:50%;padding:0px; "><div class="material-layer light"></div><svg class="icon-check"><use xlink:href="#icon-check"></use></svg></div>

						<div class="form-body">
						
						<input type="text" name="name" placeholder="college name" id="cname"required/>
						<input type="email" name="email" placeholder = "Email Adress" id="cemail" required/>
						<input type="text" name="text" placeholder="College Code" id="ccode" required/>
					</div>

				</div>
				<div class="progress-bar"></div>
				<?php

					for ($i=0; $i < $n; $i++) { 
						if($array[$i]['contestant'] > 1)
						{
							echo "<div class='form-body-part'>
								<p id='eid' style='visibility:hidden'>".$array[$i]['e_id']."</p>
								<h5>".$array[$i]['event_name']."</h5>
								<input type='text' name='name' placeholder='Participant Name' id='pname'required/>
								<input type='email' name='email' placeholder = 'Participant Email' required/>
								<input type='text' name='number' placeholder='Participant Contact Number'id='pnumber' required/>
							  </div>";
							  echo "<div class='form-body-part'>
								<p id='eid' style='visibility:hidden'>".$array[$i]['e_id']."</p>
								<h5>".$array[$i]['event_name']."</h5>
								<input type='text' name='name' placeholder='Participant Name' id='pname'required/>
								<input type='email' name='email' placeholder = 'Participant Email' required/>
								<input type='text' name='number' placeholder='Participant Contact Number'id='pnumber' required/>
							  </div>";
						}
						else
						{
							echo "<div class='form-body-part'>
								<p id='eid' style='visibility:hidden'>".$array[$i]['e_id']."</p>
								<h5>".$array[$i]['event_name']."</h5>
								<input type='text' name='name' placeholder='Participant Name' id='pname'required/>
								<input type='email' name='email' placeholder = 'Participant Email' required/>
								<input type='text' name='number' placeholder='Participant Contact Number'id='pnumber' required/>
							  </div>";
						}
						
					}
				?>
			</div>
			<div class="material-button raised registration-accept" style=" margin:50px; padding:20px; border-radius:5px; "><div class="material-layer light"></div>Submit Participants</div>
				
	</div>
			



				

		<footer>

		</footer>
		<script type="text/javascript">
		var cid;
		var $progress = $(".progress-bar");
			$(".college-accept").click(function(e){
						var cname=$("#cname").val();
						  var cemail=$("#cemail").val();
						  var ccode=$("#ccode").val();
						  


				          
				   		  $.post('college_register.php',{

				   		  	'college_name':cname,
				   		  	'contact_email':cemail,
				   		  	'college_code':ccode
				   		  },
				   		  function(data){
				   		  	if(data != -1)
				   		  	{
				   		  		cid=data;
					   		  	$('.form-body').fadeOut('fast', function() {
					   		  		
					   		  	});
					   		  	$('#college').text(cname+"("+ccode+")");
					   		  	$('#contact').text(cemail);
					   		  	$('.pink').fadeOut('fast', function() {
					   		  		
					   		  	});
					   		  	/*$progress.animate({
					   		  		"width": "10%"
					   		  		},
					   		  		500, function() {
					   		  		
					   		  	});*/
				   		  	}

				   		  	

				   		 });
			});
			$(".registration-accept").click(function(e){

						  
						$('.modal').show();
						var m=0;
				   		$(".form-body-part").each(function(i){

				   			var $pname=$(this).find("#pname");
						  	var $pnumber=$(this).find("#pnumber");
						    var $e_id=$(this).find("#eid");
						 
						    	$.post('register_p.php',{

						   		  	'name':$pname.val(),
						   		  	'number':$pnumber.val(),
						   		  	'college_id':cid,
						   		  	'event_id':$e_id.text()


						   		 	 },
					   		  	  	function(data){

					   		  			$progress.animate({
							   		  		"width": "+=10%"
							   		  		},
							   		  		500, function() {
							   		  		m++;
							   		  		if(m == 11)
							   		  		{
							   		  			$.post("college_list.php",
							   		  			{
							   		  				'cid':cid
							   		  			}
										   		 ,function(data,success)
												{
													if(success)
													$('.list').html(data);
													$('#button-bar').show(); 

												});
							   		  		}
							   		  	});			

					   		 		});
						    
					   		$pname.val('');	
					   		$pnumber.val('');	
				   		 

				   		});
				   		
				   				  	

		    });
		    var animStart = 0;//boolean to check if animated 
		 $(".material-button").click(function(e){

		 		if(animStart == 0)//if no animation is currently in progress
		 		{
		 			animStart=1;//set the boolean to 1
		 			   var parentOffset = $(this).offset();//get the offset of the parent of the material layer from the window
		               var $layer = $(this).find(".material-layer");//find the material layer
		               var relX = e.pageX - parentOffset.left;// 
		               var relY = e.pageY - parentOffset.top;

		               $layer.css({
		                 "left":relX,
		                 "top":relY,
		               });
		            $layer.addClass("animate");
		              setTimeout(function(){
		                  $layer.removeClass("animate");
		                  animStart=0;
		              },400);
		 		}
              

          });


		  $(".cancel-reg").click(function(e){

		 										$.post("delete_part.php",
							   		  			{
							   		  				'cid':cid
							   		  			}
										   		,function(data,success)
												{
													if(success)
													location.reload();

												});
              

          });
          $(".accept-reg").click(function(e){

		 										
													location.reload();

												
              

          });
		</script>
	




	</body>
</html>
