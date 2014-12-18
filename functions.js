//generate game board based on selected level:

function generate_game_size(max_num, level) {
	var div_start = "<div class='gray_block'>";
	var div_end = "<div>";
	$("#table_game_blocks").html("<div id='game_blocks_" + level + "'>");
	for (var i = 1; i <= max_num; i++) {
		$("#game_blocks_" + level).append(div_start + div_end);
	}
}


//handle timer:

var timer = null;

function startTimer() {
		clearInterval(timer);
		document.getElementById("game_time").innerHTML = "0";
		timer = setInterval(function(){advanceTimer()}, 1000);
}

function stopTimer() {
	clearInterval(timer);
	timer = null;
	document.getElementById("game_time").innerHTML = "0";
}

function advanceTimer() {
	var counter = document.getElementById("game_time").innerHTML;
	counter = parseInt(counter);
	counter++;
	document.getElementById("game_time").innerHTML = counter;
}


//shuffle array of numbers that go into game cubes: 
function shuffle(arrayToShuffle) {
	var copy = [], n = arrayToShuffle.length, i;

	// While there remain elements to shuffle…
	while (n) {

		// Pick a remaining element…
		i = Math.floor(Math.random() * n--);
		
		// And move it to the new array.
		copy.push(arrayToShuffle.splice(i, 1)[0]);
	  
	}

	return copy;
}

//get next number: 
function getNextNum(clicked_num, max_num, next_num) {

	if(clicked_num == next_num) {
		next_num = clicked_num + 1;
	}
	
	return next_num;
}

//get game score: 

function calculateScore(max_num, game_time) {
	var score = (1000 - game_time) * max_num;
	return score;
}
















