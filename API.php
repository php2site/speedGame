<?php

include_once "businessLogic.php";

$command = "";
if(isset($_REQUEST["command"])) {
	$command = $_REQUEST["command"];
}

switch($command) {
	case "add_username_and_score" : 
		$username = $_GET["username"];
		$score = $_GET["score"];
		add_user_details($username, $score);
		echo $username;
		break;
	case "populate_high_scores" :
		$topTenScores = populate_high_scores();
		echo json_encode($topTenScores);
		break;
}

