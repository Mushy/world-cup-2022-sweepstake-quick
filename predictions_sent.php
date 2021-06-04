<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thanks!</title>
</head>
<body>
<h1>Thanks!</h1>
<p>Your submissions have now been sent and will be added to the system shortly. Below is a copy for your reference until they show up.</p>
<pre>
<?php
//print_r($_SESSION);
//print_r($_SESSION['predictor']);echo '<br><br>';
//print_r($_SESSION['predictions']);
$i = 0;
foreach ($_SESSION['predictions'] as $prediction) {
	++$i;
//	print_r($prediction);
	echo "{$prediction[0]} {$prediction['match_'.$i.'_score_1']} - {$prediction['match_'.$i.'_score_2']} {$prediction[1]}<br>";
}
?>	
</body>
</html>