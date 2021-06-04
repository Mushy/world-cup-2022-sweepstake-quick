<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') exit;

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

foreach ($_POST as $post_key => $post_value) {
	if ($post_key === 'name') continue;

	$i_match = 0;
	$did_match = false;
	foreach ($matches as $match) {
		foreach ($match as $match_key => $match_value) {
			if ($post_key === $match_key) {
				$matches[$i_match][$match_key] = $post_value;
				$did_match = true;
			}
			if ($did_match) break;
		}
		$i_match++;
		if ($did_match) break;
	}
}

$predictions = "'{$_POST['name']}' => [\n";
	$i = 0;
	foreach ($matches as $match) {
		$i++;
		$predictions .= "\t['{$match[0]}', {$match['match_'.$i.'_score_1']}, {$match['match_'.$i.'_score_2']}, '{$match[1]}'],\n";
	}
$predictions .= "],\n";

$_SESSION['predictor'] = $_POST['name'];
$_SESSION['predictions'] = $matches;

mail('colin@ina4.com', "Euro 2020 predictions :: {$_POST['name']}", $predictions, "From: col@colincharlton.net");

header('Location: predictions_sent.php');
exit;