			var maxcards=8;
			var facingRight=1;
			var cardCount=1;
			var cardWidth = 250;
			var cardPadding = 46;
			$(function(){

				header_load();
				if($(window).width() < 500)
				{
					maxcards=9;
				}
				else if($(window).width() < 700)
				{
					maxcards=8;
				}
				else
				{
					 maxcards=6;
				}


			});
			var modalOpened=0;//variable:holds the Boolean Flag for modal opened
			var mHeight;//height of the window
			var slideTimer; //variable to hold the interval id
			var $heading=$("#heading-area");//cache heading area which stores the heading and image
			var $cloud1=$(".icon-cloud");//unused
			var $cloud2=$(".icon-cloud2");
			var $mainNav=$(".main-nav");//caches main nav which is used frequently in fixing and releasing the main navigation bar
			var $itemInfo=$(".item-info");//caches the information buttons which animate in on scroll, reduces the amount of processing required on scroll for faster transtion's
			var set=0;
			var Timer;//variable to hold any set timer
			var startedScroll=0;//unused block
			var isScrolling=0;
			var reachedEnd=0;
			var reachedStart=0;
			var finishedScrolling=0;
			var vheight;

			function header_load()//called when the page has loaded provides a subtle animation to the social icons bar
			{


				$('#social-bar').fadeIn(1000);
				$('#social-bar').animate({
					bottom:'+=60px'
				},500);

			}


			function randomIntFromInterval(min,max)
			{
			    return Math.floor(Math.random()*(max-min+1)+min);
			}

			function scrollhere()
			{
						$('html, body').animate({scrollTop: $("#sector").offset().top}, 1200);
			}

			function scrollnav(obj)//function to scroll to a specified element in the dom
			{
						$('html, body').animate({scrollTop: $(obj).offset().top - $mainNav.height()-50}, 1000);
			}

			var scrollFixed=0;//boolean to hold whether the navbar is currently fixed or static
			$(window).scroll(function(){//callback on scroll


					var parscr=$(this).scrollTop();//gets the current scrolled height of the window
					// callback when scroll position reaches the top of the information buttons sector
					if(parscr > $("#sector").offset().top -$(window).height()/8)// starts animation of the 3 information icon/buttons in the '#sector' container
					{



							$itemInfo.each(function(i){//gets each of the information sections
								setTimeout(function(){
									$itemInfo.eq(i).addClass('show-img');//shows image
								},200*i);//animation of each section occours in a progression with a difference of 200ms
							});
					}
					//end of section---
					//callback when the scrolltop reaches the top of the navigation bar
					if(parscr > $mainNav.offset().top )
					{



							if(scrollFixed == 0)//check if navigation bar is currently in the fixed or released state
							{	//if the navigation bar is not fixed then return to its original static state as the scroll position has reached the initial navigation bar location
								//TODO:  Find a more efficient way to deal with the above situation , perform adjustments for optimal responsiveness
								$mainNav.css({
										"position":"fixed",
										"top":"0",
										"left":"0",
										"width":"100%",
									});
								vheight=$mainNav.offset().top;//updates the height of the nav every time NOTE:Ineffecient --
								scrollFixed=1;//change the boolean scrollfixed to true
							}




					}
					if(parscr < vheight )// check if the current scrolled location is less than the height (kept frequently updated) , ie: the navigation bar must me made static
					{

								$mainNav.css({
										"position":"static",

										"width":"auto",
									});
									scrollFixed=0;



					}





					/*if(parscr >$(".contacts").offset().top - $(window).height()/2)//check if the scroll position is half the height of the window offset from the position of the contacts container
					{


							$(".contact").each(function(i){//for each contact in the container >> added for easier addition of extra contacts
								setTimeout(function(){
									$(".contact").eq(i).addClass('zoom-out');// a simple zoom out animation when in view
								},100*i);//progression with a difference of 300ms
							});




					}*/

					if(parscr > $(".event-section").offset().top - $(window).height()/2)
					{


							$(".card-art").each(function(i){
								setTimeout(function(){
									$(".card-art").eq(i).addClass('enlarge');
								},100*i);
							});




					}

					/*if(parscr > $(".event-head-sector").offset().top - $(window).height()/2)
					{


							$(".team-art").each(function(i){
								setTimeout(function(){
									$(".team-art" ).eq(i).addClass('enlarge');
								},100*i);
							});




					}*/


			});

			$("#header").load(function() {
				$this.animate({
					"height": "=90vh",
					},
					2000, function() {

				});
			});


		//material design button click animation ie,ripple effect
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




		$(".chevron-right").click(function(e) {



			var movement = (cardWidth + cardPadding);
			console.log(cardCount);
			if(cardCount < maxcards-1)
			{
				console.log("yes");
				$(".event-slide-container").animate({
					marginLeft: "-="+movement+"px"
					},
					100, function() {
					cardCount ++;

				});

			}
			else
			{
				console.log("no");
				$(".event-slide-container").animate({
					marginLeft: "0px"
					},
					100, function() {
					cardCount =1;
				});
			}
		});
			$(".chevron-left").click(function(e) {



			var movement = (cardWidth + cardPadding);
			console.log(cardCount);
			if(cardCount > 1)
			{

				$(".event-slide-container").animate({
					marginLeft: "+="+movement+"px"
					},
					100, function() {
					cardCount --;

				});

			}








		});

		$(".event-slide-container").swipe({
		  swipeLeft:function(event, direction, distance, duration, fingerCount) {
		   	var movement = (cardWidth + cardPadding);
			console.log(cardCount);
			if(cardCount < maxcards-1)
			{
				console.log("yes");
				$(".event-slide-container").animate({
					marginLeft: "-="+movement+"px"
					},
					100, function() {
					cardCount ++;

				});

			}

		  }

		});

		$(".event-slide-container").swipe({
		  swipeRight:function(event, direction, distance, duration, fingerCount) {
		   	var movement = (cardWidth + cardPadding);
			console.log(cardCount);
			if(cardCount > 1)
			{
				console.log("yes");
				$(".event-slide-container").animate({
					marginLeft: "+="+movement+"px"
					},
					100, function() {
					cardCount --;

				});

			}

		  }

		});



		var flip = false;

		 $(".icon-ham").click(function(e){
		 	if(flip)
		 	{
		 		$mainNav.find('nav').css('display','none');
		 		flip=false;
		 	}
		 	else
		 	{
		 		$mainNav.find('nav').css('display','flex');
		 		flip=true;
		 	}




          });
			$( ".video-sector").find('figure').hover(function(){
				$(this).find('figcaption').removeClass("shown-play-icon");
 				$(this).find('figcaption').addClass("show-play-icon");
			},
			function(){
				$(this).find('figcaption').removeClass("show-play-icon");
				$(this).find('figcaption').addClass("shown-play-icon");
			});

		function toggleBar()
		{
			$(".side-bar").toggle();
			$("#screen-cover").toggle();
			$(".side-bar").toggleClass('slide');
			$(".side-bar").height($(window).height());


		}


		function close_modal()
		{
			$(".page-flow").hide();

		}
		function open_modal()
		{
			$(".page-flow").show();

		}
