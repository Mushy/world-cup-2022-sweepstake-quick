<?php require_once('scores/euro-2020.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://cdnjs.cloudflare.com">

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer">
<link rel="stylesheet" href="css/style-input.css">

<style>
input[type="number"] {
	width: 40px;
}

.matches label ~ label {
	flex: 0;
	flex-basis: 160px;
}

.row > div {
	flex: 1;
	text-align: left;
}

select {
	margin-top: 11px;
	padding: 1px;
}
</style>

<title>Euro 2020 Score Updater</title>
</head>
<body>
<h1>Please don't be a wanker.</h1>
<img src="images/euro2020_negative.svg" width="300px">
<p>Help the office banter by keeping our scores up to date!<br>There is a delay of around 4 seconds from submit while my server chokes updating a file.<br>I had to do this or it didn't show when returned to this screen without another refresh</p>
<p>At the moment there are no free API feeds to give me up to date info without limits. If I get a free API this will go down.</p>
<form method="post" action="scores_submit.php">
	<div class="matches">
	<?php
	$i = 0;
	foreach ($matchesGroups as $groupMatch) {
		foreach ($groupMatch as $group => $match) {
			++$i;
			echo '<div class="row">';
				echo '<label for="match_'.$i.'_score_1">'.$match[0].'</label>';
				echo '<input type="number" name="match_'.$i.'_score_1" id="match_'.$i.'_score_1" value="'.$match[1].'" min="0" max="99" step="1">';

				echo '<input type="number" name="match_'.$i.'_score_2" id="match_'.$i.'_score_2" value="'.$match[2].'" min="0" max="99" step="1">';
				echo '<label for="match_'.$i.'_score_2">'.$match[3].'</label>';

				echo '<div><select name="match_'.$i.'_status">';
					echo '<option value="np"'.($match[4] === 'np' ? ' selected' : '').'>Not Played</option>';
					echo '<option value="l"'.($match[4] === 'l' ? ' selected' : '').'>Live</option>';
					echo '<option value="ft"'.($match[4] === 'ft' ? ' selected' : '').'>Full Time</option>';
				echo '</select></div>';
			echo '</div>';
		}
	}
	?>
	</div>

	<div class="row">
		<button type="submit">Save Scores</button>
	</div>
</form>
</body>
</html>