<?php

	include_once "API.php";
	
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1255">
<title>Your Score</title>

<link rel="stylesheet" href="styles.css">
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>

<script src="jquery-1.11.1.js"></script>
<script src="functions.js"></script>
<script>

var score = 0;

	$(function() {

			// display score and username input field: 
			$("#submit_name").attr('maxlength','10');
			$("#submit_name, #your_score").fadeIn("slow");
			
	 		//get score from index and show in page:
	 		score = window.name; //retrieves variable from Index page
	 		if (score > 0) {
	 			$("#score").html(score);
	 			window.name = 0;
	 		}
	 		else{
	 			window.location.assign("index.php");
		 	}

 	});


	// if user clicks New Game, send to Index page:
	
	$(function() {

		$(".new_game, .new_game_2").click(function() {
			
			window.location.assign("index.php");
			
		});
		
	});


	// save username and score to the database, and update Scores display accordingly:
	
	$(function() {
	
		$("#name_submit").click(function() {
			
			//validate that "name" field is not empty
			if($("[name='user_name']").val() == "") {
				
				$("[name='user_name']").css({"background-color": "pink"});
				
			}
				
			else {

				var username = $("#txt_user_name").val();

				$.ajax({
		 			
					// GET / POST
					type: "GET",

					// The page to go to:
					url: "API.php",

					// The data to send:
					data: {score: score, username: $("#txt_user_name").val(), command: "add_username_and_score"},

					// The function to execute on success:
					success: function(result) {

						$("#submit_name, #your_score").slideUp(500, "linear");
						
					},

					// The function to execute on error:
					error: function (err) {
						alert("Error: " + err.status + ", " + err.statusText);
					},

					// Don't save the response in the browser's cache:
					cache: false

				});

				$.ajax({
					
					// GET / POST
					type: "GET",
		
					// The page to go to:
					url: "API.php",
		
					// The data to send:
					data: {command: "populate_high_scores"},
		
					// The function to execute on success:
					success: function(result) {
		
						$("#submit_name, #your_score").slideUp(500, "linear");
						result = JSON.parse(result);
						for(var i = 0; i < result.length; i++) {
							var name = result[i].user_name; 
							var score = result[i].score;
							var row = "<div class='scoresDetail'>" + name + "</div>" + "<div class='scoresDetail'>" + score + "</div>";
							$("#high_scores").append(row);
						}
						$("#personal_thanks").html("Thanks for playing, " + username + "!");
						$("#thank_you, #high_scores").show();
						
					},
		
					// The function to execute on error:
					error: function (err) {
						alert("Error: " + err.status + ", " + err.statusText);
					},
		
					// Don't save the response in the browser's cache:
					cache: false
	
				});
								
			}
			
		});
	
	});


</script>


</head>
<body>


	<section id="sec_game">
		
	<!-- DISPLAY 1 -->
		
		<!-- Score Summary -->
		
		<div class="optionsWrap" id="your_score" style="display:none">
			
			<h1>Great Job!</h1>
			
			<p>Your Score: <span id="score"></span></p>
		
		</div>
		
		
		<!-- Submit Name -->
		
		<div class="optionsWrap" id="submit_name" style="display:none">
			<div id="containerScores">
					<input type="text" name="user_name" id="txt_user_name" maxlength="10" placeholder="Submit your name..." />
					<input type="button" class="btnScores" id="name_submit" value="send" />
					<input type="button" class="new_game" value="cancel" />
					<span class="stretch"></span>
			</div>
		</div>
		
		
	<!-- DISPLAY 2 -->
		
		<!-- Thanks and New Game -->
		
		<div class="optionsWrap" id="thank_you" style="display:none">
	
			<h4 id="personal_thanks"></h4>
			<input type="button" class="new_game_2" value="play again" />
		
		</div>
		
		
		<!-- High Scores -->
		
		<div class="optionsWrap" id="high_scores" style="display:none">
		
			<h4>Top Scores</h4>
	
		</div>
	
	</section>
	
</body>
</html>