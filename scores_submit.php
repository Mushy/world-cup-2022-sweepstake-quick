<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') exit;

require_once('scores/euro-2020.php');

$i = 0;
$i_post = 1;
foreach ($matchesGroups as $groupMatch) {
	foreach ($groupMatch as $group => $match) {
		$matchesGroups[$i][$group][1] = $_POST['match_'.$i_post.'_score_1'];
		$matchesGroups[$i][$group][2] = $_POST['match_'.$i_post.'_score_2'];
		$matchesGroups[$i][$group][4] = $_POST['match_'.$i_post.'_status'];
	}
	++$i;
	++$i_post;
}

file_put_contents('scores/euro-2020.php', '<?php $matchesGroups = '.var_export($matchesGroups, true).';');

usleep(3000000);

header('Location: score-updater.php');
exit;