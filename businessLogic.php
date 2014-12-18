<?php

include_once "DAL.php";

function add_user_details($username, $score) {
	$sql = "INSERT INTO users (user_name, score) VALUES ('$username', $score)";
	dml($sql);
}

function populate_high_scores() {
	$sql = "SELECT * FROM users ORDER BY score DESC LIMIT 10";
	$arr = select($sql);
	return $arr;
}