<?php
$matches = [
	['Turkey', 'match_1_score_1' => 0, 'match_1_score_2' => 0, 'Italy'],
	['Wales', 'match_2_score_1' => 0, 'match_2_score_2' => 0, 'Switzerland'],
	['Denmark', 'match_3_score_1' => 0, 'match_3_score_2' => 0, 'Finland'],
	['Belgium', 'match_4_score_1' => 0, 'match_4_score_2' => 0, 'Russia'],
	['England', 'match_5_score_1' => 0, 'match_5_score_2' => 0, 'Croatia'],
	['Austria', 'match_6_score_1' => 0, 'match_6_score_2' => 0, 'North Macedonia'],
	['Netherlands', 'match_7_score_1' => 0, 'match_7_score_2' => 0, 'Ukraine'],
	['Scotland', 'match_8_score_1' => 0, 'match_8_score_2' => 0, 'Czech Republic'],
	['Poland', 'match_9_score_1' => 0, 'match_9_score_2' => 0, 'Slovakia'],
	['Spain', 'match_10_score_1' => 0, 'match_10_score_2' => 0, 'Sweden'],
	['Hungary', 'match_11_score_1' => 0, 'match_11_score_2' => 0, 'Portugal'],
	['France', 'match_12_score_1' => 0, 'match_12_score_2' => 0, 'Germany'],
	['Finland', 'match_13_score_1' => 0, 'match_13_score_2' => 0, 'Russia'],
	['Turkey', 'match_14_score_1' => 0, 'match_14_score_2' => 0, 'Wales'],
	['Italy', 'match_15_score_1' => 0, 'match_15_score_2' => 0, 'Switzerland'],
	['Ukraine', 'match_16_score_1' => 0, 'match_16_score_2' => 0, 'North Macedonia'],
	['Denmark', 'match_17_score_1' => 0, 'match_17_score_2' => 0, 'Belgium'],
	['Netherlands', 'match_18_score_1' => 0, 'match_18_score_2' => 0, 'Austria'],
	['Sweden', 'match_19_score_1' => 0, 'match_19_score_2' => 0, 'Slovakia'],
	['Croatia', 'match_20_score_1' => 0, 'match_20_score_2' => 0, 'Czech Republic'],
	['England', 'match_21_score_1' => 0, 'match_21_score_2' => 0, 'Scotland'],
	['Hungary', 'match_22_score_1' => 0, 'match_22_score_2' => 0, 'France'],
	['Portugal', 'match_23_score_1' => 0, 'match_23_score_2' => 0, 'Germany'],
	['Spain', 'match_24_score_1' => 0, 'match_24_score_2' => 0, 'Poland'],
	['Italy', 'match_25_score_1' => 0, 'match_25_score_2' => 0, 'Wales'],
	['Switzerland', 'match_26_score_1' => 0, 'match_26_score_2' => 0, 'Turkey'],
	['North Macedonia', 'match_27_score_1' => 0, 'match_27_score_2' => 0, 'Netherlands'],
	['Ukraine', 'match_28_score_1' => 0, 'match_28_score_2' => 0, 'Austria'],
	['Russia', 'match_29_score_1' => 0, 'match_29_score_2' => 0, 'Denmark'],
	['Finland', 'match_30_score_1' => 0, 'match_30_score_2' => 0, 'Belgium'],
	['Czech Republic', 'match_31_score_1' => 0, 'match_31_score_2' => 0, 'England'],
	['Croatia', 'match_32_score_1' => 0, 'match_32_score_2' => 0, 'Scotland'],
	['Slovakia', 'match_33_score_1' => 0, 'match_33_score_2' => 0, 'Spain'],
	['Sweden', 'match_34_score_1' => 0, 'match_34_score_2' => 0, 'Poland'],
	['Germany', 'match_35_score_1' => 0, 'match_35_score_2' => 0, 'Hungary'],
	['Portugal', 'match_36_score_1' => 0, 'match_36_score_2' => 0, 'France'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://cdnjs.cloudflare.com">

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer">
<link rel="stylesheet" href="css/style-input.css">

<title>Euro 2020 Score Prediction Game</title>
</head>
<body>
<h1>Euro 2020 (Yes, Still) Score Prediction Game</h1>
<img src="images/euro2020_negative.svg" width="300px">
<p>Welcome to the Euro 2020 Score Prediction Game, the rules are simple...</p>
<ul>
	<li>Guess the scores to each game.</li>
	<li>The more you get right, the more points you get.</li>
	<li>Get more points than everyone else.</li>
</ul>
<h2>Instructions</h2>
<p>Is this not simple enough for you?</p>
<p>Enter your predicted scores below. This is just for the group stages, another version will be around for the knockout, etc stages.</p>
<p>You have until kick off of the first game to submit your scores, any scores submitted after a game has started will not be counted on a per game basis.<br>e.g. You submit your scores after the 3rd game has started your first 3 games will be 0 points.</p>
<form method="post" action="predictions_submit.php">
	<div class="row">
		<label for="name">First Name / Nickname</label>
		<input class="inputname" type="text" name="name" id="name">
	</div>
	<div class="matches">
	<?php
	$i = 0;
	$i_score = 1;
	foreach ($matches as $match) {
		++$i;
		echo '<div class="row">';
			//foreach ($match as $k => $v) {
				echo '<label for="match_'.$i.'_score_1">'.$match[0].'</label>';
				echo '<input type="text" name="match_'.$i.'_score_1" id="match_'.$i.'_score_1">';

				echo '<input type="text" name="match_'.$i.'_score_2" id="match_'.$i.'_score_2">';
				echo '<label for="match_'.$i.'_score_2">'.$match[1].'</label>';
			//}
		echo '</div>';
	}
	?>

	</div>

	<div class="row">
		<button type="submit">Save Predictions</button>
	</div>
</form>
</body>
</html>