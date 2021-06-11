<?php
ini_set('display_errors', 1);
error_reporting(-1);

// Office players.
$players = ['Colin', 'Tom', 'Connor', 'Cath', 'Mia', 'Samara', 'Andy', 'Carl', 'Stephen', 'John', 'Rob', 'John A'];
$sweepWinBonus = 15;

// Teams and the group they are in.
$teams = [
	'Italy' => 'A',
	'Switzerland' => 'A',
	'Turkey' => 'A',
	'Wales' => 'A',
	'Belgium' => 'B',
	'Russia' => 'B',
	'Denmark' => 'B',
	'Finland' => 'B',
	'Ukraine' => 'C',
	'Netherlands' => 'C',
	'Austria' => 'C',
	'North Macedonia' => 'C',
	'England' => 'D',
	'Croatia' => 'D',
	'Czech Republic' => 'D',
	'Scotland' => 'D',
	'Spain' => 'E',
	'Poland' => 'E',
	'Sweden' => 'E',
	'Slovakia' => 'E',
	'Germany' => 'F',
	'France' => 'F',
	'Portugal' => 'F',
	'Hungary' => 'F',
];

// Knockout brackets. This order will update once the actual games start since it depends on results.
$knockout = '2A2B,1A2C,1C3D,1F3A,1D2F,1E3A';

// Teams to players, generated using sweepstakes tool.
$playerTeams = [
	'Belgium' => 'Tom',
	'Switzerland' => 'Stephen',
	'Ukraine' => 'Connor',
	'Russia' => 'Colin',
	'Hungary' => 'Carl',
	'Slovakia' => 'Cath',
	'Wales' => 'Tom',
	'Germany' => 'Andy',
	'Croatia' => 'Colin',
	'Czech Republic' => 'Mia',
	'Scotland' => 'Connor',
	'Turkey' => 'John',
	'Netherlands' => 'Samara',
	'North Macedonia' => 'Rob',
	'Poland' => 'Carl',
	'Spain' => 'Stephen',
	'Finland' => 'Samara',
	'Austria' => 'John A',
	'Denmark' => 'Rob',
	'Italy' => 'John',
	'Portugal' => 'Andy',
	'England' => 'John A',
	'France' => 'Mia',
	'Sweden' => 'Cath',
];

// Group match results
$matchesGroups = [
	['A' => ['Turkey', 0, 0, 'Italy', 'np']],
	['A' => ['Wales', 0, 0, 'Switzerland', 'np']],
	['B' => ['Denmark', 0, 0, 'Finland', 'np']],
	['B' => ['Belgium', 0, 0, 'Russia', 'np']],
	['D' => ['England', 0, 0, 'Croatia', 'np']],
	['C' => ['Austria', 0, 0, 'North Macedonia', 'np']],
	['C' => ['Netherlands', 0, 0, 'Ukraine', 'np']],
	['D' => ['Scotland', 0, 0, 'Czech Republic', 'np']],
	['E' => ['Poland', 0, 0, 'Slovakia', 'np']],
	['E' => ['Spain', 0, 0, 'Sweden', 'np']],
	['F' => ['Hungary', 0, 0, 'Portugal', 'np']],
	['F' => ['France', 0, 0, 'Germany', 'np']],
	['B' => ['Finland', 0, 0, 'Russia', 'np']],
	['A' => ['Turkey', 0, 0, 'Wales', 'np']],
	['A' => ['Italy', 0, 0, 'Switzerland', 'np']],
	['C' => ['Ukraine', 0, 0, 'North Macedonia', 'np']],
	['B' => ['Denmark', 0, 0, 'Belgium', 'np']],
	['C' => ['Netherlands', 0, 0, 'Austria', 'np']],
	['E' => ['Sweden', 0, 0, 'Slovakia', 'np']],
	['D' => ['Croatia', 0, 0, 'Czech Republic', 'np']],
	['D' => ['England', 0, 0, 'Scotland', 'np']],
	['F' => ['Hungary', 0, 0, 'France', 'np']],
	['F' => ['Portugal', 0, 0, 'Germany', 'np']],
	['E' => ['Spain', 0, 0, 'Poland', 'np']],
	['A' => ['Italy', 0, 0, 'Wales', 'np']],
	['A' => ['Switzerland', 0, 0, 'Turkey', 'np']],
	['C' => ['North Macedonia', 0, 0, 'Netherlands', 'np']],
	['C' => ['Ukraine', 0, 0, 'Austria', 'np']],
	['B' => ['Russia', 0, 0, 'Denmark', 'np']],
	['B' => ['Finland', 0, 0, 'Belgium', 'np']],
	['D' => ['Czech Republic', 0, 0, 'England', 'np']],
	['D' => ['Croatia', 0, 0, 'Scotland', 'np']],
	['E' => ['Slovakia', 0, 0, 'Spain', 'np']],
	['E' => ['Sweden', 0, 0, 'Poland', 'np']],
	['F' => ['Germany', 0, 0, 'Hungary', 'np']],
	['F' => ['Portugal', 0, 0, 'France', 'np']],
];

// Test pool
if (isset($_GET['test-data'])) {
	$matchesGroups = [
		['A' => ['Turkey', 0, 2, 'Italy', 'p']],
		['A' => ['Wales', 0, 2, 'Switzerland', 'p']],
		['B' => ['Denmark', 2, 1, 'Finland', 'p']],
		['B' => ['Belgium', 4, 0, 'Russia', 'p']],
		['D' => ['England', 2, 1, 'Croatia', 'p']],
		['C' => ['Austria', 0, 2, 'North Macedonia', 'p']],
		['C' => ['Netherlands', 0, 0, 'Ukraine', 'np']],
		['D' => ['Scotland', 0, 0, 'Czech Republic', 'np']],
		['E' => ['Poland', 0, 0, 'Slovakia', 'np']],
		['E' => ['Spain', 0, 0, 'Sweden', 'np']],
		['F' => ['Hungary', 0, 0, 'Portugal', 'np']],
		['F' => ['France', 0, 0, 'Germany', 'np']],
		['B' => ['Finland', 0, 0, 'Russia', 'np']],
		['A' => ['Turkey', 0, 0, 'Wales', 'np']],
		['A' => ['Italy', 0, 0, 'Switzerland', 'np']],
		['C' => ['Ukraine', 0, 0, 'North Macedonia', 'np']],
		['B' => ['Denmark', 0, 0, 'Belgium', 'np']],
		['C' => ['Netherlands', 0, 0, 'Austria', 'np']],
		['E' => ['Sweden', 0, 0, 'Slovakia', 'np']],
		['D' => ['Croatia', 0, 0, 'Czech Republic', 'np']],
		['D' => ['England', 0, 0, 'Scotland', 'np']],
		['F' => ['Hungary', 0, 0, 'France', 'np']],
		['F' => ['Portugal', 0, 0, 'Germany', 'np']],
		['E' => ['Spain', 0, 0, 'Poland', 'np']],
		['A' => ['Italy', 0, 0, 'Wales', 'np']],
		['A' => ['Switzerland', 0, 0, 'Turkey', 'np']],
		['C' => ['North Macedonia', 0, 0, 'Netherlands', 'np']],
		['C' => ['Ukraine', 0, 0, 'Austria', 'np']],
		['B' => ['Russia', 0, 0, 'Denmark', 'np']],
		['B' => ['Finland', 0, 0, 'Belgium', 'np']],
		['D' => ['Czech Republic', 0, 0, 'England', 'np']],
		['D' => ['Croatia', 0, 0, 'Scotland', 'np']],
		['E' => ['Slovakia', 0, 0, 'Spain', 'np']],
		['E' => ['Sweden', 0, 0, 'Poland', 'np']],
		['F' => ['Germany', 0, 0, 'Hungary', 'np']],
		['F' => ['Portugal', 0, 0, 'France', 'np']],
	];
}

$playerPredictions = [
	'Colin' => [
		['Turkey', 1, 3, 'Italy'],
		['Wales', 0, 2, 'Switzerland'],
		['Denmark', 3, 1, 'Finland'],
		['Belgium', 3, 0, 'Russia'],
		['England', 2, 1, 'Croatia'],
		['Austria', 2, 0, 'North Macedonia'],
		['Netherlands', 2, 1, 'Ukraine'],
		['Scotland', 0, 1, 'Czech Republic'],
		['Poland', 2, 1, 'Slovakia'],
		['Spain', 3, 1, 'Sweden'],
		['Hungary', 0, 2, 'Portugal'],
		['France', 2, 1, 'Germany'],
		['Finland', 0, 2, 'Russia'],
		['Turkey', 2, 0, 'Wales'],
		['Italy', 2, 1, 'Switzerland'],
		['Ukraine', 2, 0, 'North Macedonia'],
		['Denmark', 0, 2, 'Belgium'],
		['Netherlands', 2, 1, 'Austria'],
		['Sweden', 2, 0, 'Slovakia'],
		['Croatia', 2, 1, 'Czech Republic'],
		['England', 3, 0, 'Scotland'],
		['Hungary', 0, 4, 'France'],
		['Portugal', 1, 1, 'Germany'],
		['Spain', 3, 0, 'Poland'],
		['Italy', 3, 0, 'Wales'],
		['Switzerland', 1, 1, 'Turkey'],
		['North Macedonia', 0, 2, 'Netherlands'],
		['Ukraine', 2, 0, 'Austria'],
		['Russia', 1, 1, 'Denmark'],
		['Finland', 0, 3, 'Belgium'],
		['Czech Republic', 0, 2, 'England'],
		['Croatia', 3, 0, 'Scotland'],
		['Slovakia', 0, 3, 'Spain'],
		['Sweden', 1, 1, 'Poland'],
		['Germany', 3, 0, 'Hungary'],
		['Portugal', 1, 1, 'France'],
	],
	'Connor' => [
		['Turkey', 0, 2, 'Italy'],
		['Wales', 2, 2, 'Switzerland'],
		['Denmark', 2, 0, 'Finland'],
		['Belgium', 3, 1, 'Russia'],
		['England', 1, 1, 'Croatia'],
		['Austria', 2, 1, 'North Macedonia'],
		['Netherlands', 3, 1, 'Ukraine'],
		['Scotland', 1, 1, 'Czech Republic'],
		['Poland', 2, 1, 'Slovakia'],
		['Spain', 1, 0, 'Sweden'],
		['Hungary', 0, 4, 'Portugal'],
		['France', 2, 1, 'Germany'],
		['Finland', 1, 1, 'Russia'],
		['Turkey', 0, 2, 'Wales'],
		['Italy', 3, 1, 'Switzerland'],
		['Ukraine', 0, 0, 'North Macedonia'],
		['Denmark', 1, 2, 'Belgium'],
		['Netherlands', 2, 1, 'Austria'],
		['Sweden', 2, 0, 'Slovakia'],
		['Croatia', 2, 1, 'Czech Republic'],
		['England', 3, 1, 'Scotland'],
		['Hungary', 0, 5, 'France'],
		['Portugal', 1, 2, 'Germany'],
		['Spain', 2, 2, 'Poland'],
		['Italy', 2, 1, 'Wales'],
		['Switzerland', 1, 1, 'Turkey'],
		['North Macedonia', 1, 4, 'Netherlands'],
		['Ukraine', 2, 1, 'Austria'],
		['Russia', 0, 2, 'Denmark'],
		['Finland', 0, 3, 'Belgium'],
		['Czech Republic', 1, 2, 'England'],
		['Croatia', 2, 0, 'Scotland'],
		['Slovakia', 1, 3, 'Spain'],
		['Sweden', 1, 2, 'Poland'],
		['Germany', 3, 0, 'Hungary'],
		['Portugal', 2, 2, 'France'],
	],
	'Nashy' => [
		['Turkey', 1, 1, 'Italy'],
		['Wales', 2, 0, 'Switzerland'],
		['Denmark', 2, 0, 'Finland'],
		['Belgium', 2, 1, 'Russia'],
		['England', 0, 1, 'Croatia'],
		['Austria', 2, 0, 'North Macedonia'],
		['Netherlands', 3, 0, 'Ukraine'],
		['Scotland', 1, 0, 'Czech Republic'],
		['Poland', 2, 1, 'Slovakia'],
		['Spain', 2, 0, 'Sweden'],
		['Hungary', 0, 3, 'Portugal'],
		['France', 1, 1, 'Germany'],
		['Finland', 1, 3, 'Russia'],
		['Turkey', 1, 1, 'Wales'],
		['Italy', 1, 0, 'Switzerland'],
		['Ukraine', 2, 0, 'North Macedonia'],
		['Denmark', 1, 1, 'Belgium'],
		['Netherlands', 4, 0, 'Austria'],
		['Sweden', 1, 1, 'Slovakia'],
		['Croatia', 2, 0, 'Czech Republic'],
		['England', 1, 2, 'Scotland'],
		['Hungary', 0, 3, 'France'],
		['Portugal', 2, 1, 'Germany'],
		['Spain', 1, 1, 'Poland'],
		['Italy', 2, 0, 'Wales'],
		['Switzerland', 1, 0, 'Turkey'],
		['North Macedonia', 0, 3, 'Netherlands'],
		['Ukraine', 1, 1, 'Austria'],
		['Russia', 0, 2, 'Denmark'],
		['Finland', 1, 3, 'Belgium'],
		['Czech Republic', 0, 2, 'England'],
		['Croatia', 1, 1, 'Scotland'],
		['Slovakia', 0, 3, 'Spain'],
		['Sweden', 1, 2, 'Poland'],
		['Germany', 2, 0, 'Hungary'],
		['Portugal', 1, 1, 'France'],
	],
	'Tom' => [
		['Turkey', 0, 2, 'Italy'],
		['Wales', 2, 1, 'Switzerland'],
		['Denmark', 1, 0, 'Finland'],
		['Belgium', 4, 1, 'Russia'],
		['England', 1, 1, 'Croatia'],
		['Austria', 0, 1, 'North Macedonia'],
		['Netherlands', 2, 1, 'Ukraine'],
		['Scotland', 0, 3, 'Czech Republic'],
		['Poland', 2, 0, 'Slovakia'],
		['Spain', 1, 1, 'Sweden'],
		['Hungary', 0, 2, 'Portugal'],
		['France', 3, 1, 'Germany'],
		['Finland', 1, 1, 'Russia'],
		['Turkey', 0, 2, 'Wales'],
		['Italy', 1, 0, 'Switzerland'],
		['Ukraine', 1, 1, 'North Macedonia'],
		['Denmark', 2, 3, 'Belgium'],
		['Netherlands', 2, 1, 'Austria'],
		['Sweden', 2, 0, 'Slovakia'],
		['Croatia', 2, 2, 'Czech Republic'],
		['England', 3, 1, 'Scotland'],
		['Hungary', 0, 4, 'France'],
		['Portugal', 3, 3, 'Germany'],
		['Spain', 2, 0, 'Poland'],
		['Italy', 1, 2, 'Wales'],
		['Switzerland', 0, 0, 'Turkey'],
		['North Macedonia', 1, 1, 'Netherlands'],
		['Ukraine', 2, 2, 'Austria'],
		['Russia', 3, 2, 'Denmark'],
		['Finland', 1, 4, 'Belgium'],
		['Czech Republic', 3, 1, 'England'],
		['Croatia', 2, 1, 'Scotland'],
		['Slovakia', 0, 3, 'Spain'],
		['Sweden', 2, 1, 'Poland'],
		['Germany', 3, 0, 'Hungary'],
		['Portugal', 2, 3, 'France'],
	],
	'John' => [
		['Turkey', 0, 2, 'Italy'],
		['Wales', 0, 1, 'Switzerland'],
		['Denmark', 2, 0, 'Finland'],
		['Belgium', 3, 0, 'Russia'],
		['England', 2, 1, 'Croatia'],
		['Austria', 3, 1, 'North Macedonia'],
		['Netherlands', 0, 0, 'Ukraine'],
		['Scotland', 1, 0, 'Czech Republic'],
		['Poland', 2, 0, 'Slovakia'],
		['Spain', 1, 0, 'Sweden'],
		['Hungary', 0, 1, 'Portugal'],
		['France', 1, 0, 'Germany'],
		['Finland', 1, 2, 'Russia'],
		['Turkey', 0, 0, 'Wales'],
		['Italy', 1, 2, 'Switzerland'],
		['Ukraine', 2, 0, 'North Macedonia'],
		['Denmark', 0, 1, 'Belgium'],
		['Netherlands', 1, 0, 'Austria'],
		['Sweden', 2, 1, 'Slovakia'],
		['Croatia', 2, 0, 'Czech Republic'],
		['England', 2, 0, 'Scotland'],
		['Hungary', 1, 2, 'France'],
		['Portugal', 1, 1, 'Germany'],
		['Spain', 3, 0, 'Poland'],
		['Italy', 2, 1, 'Wales'],
		['Switzerland', 1, 0, 'Turkey'],
		['North Macedonia', 0, 3, 'Netherlands'],
		['Ukraine', 2, 1, 'Austria'],
		['Russia', 1, 2, 'Denmark'],
		['Finland', 1, 0, 'Belgium'],
		['Czech Republic', 0, 3, 'England'],
		['Croatia', 0, 1, 'Scotland'],
		['Slovakia', 0, 2, 'Spain'],
		['Sweden', 1, 1, 'Poland'],
		['Germany', 2, 0, 'Hungary'],
		['Portugal', 0, 0, 'France'],
	],
	'Taylor' => [
		['Turkey', 0, 3, 'Italy'],
		['Wales', 0, 1, 'Switzerland'],
		['Denmark', 2, 1, 'Finland'],
		['Belgium', 2, 0, 'Russia'],
		['England', 1, 1, 'Croatia'],
		['Austria', 2, 0, 'North Macedonia'],
		['Netherlands', 2, 1, 'Ukraine'],
		['Scotland', 0, 2, 'Czech Republic'],
		['Poland', 1, 0, 'Slovakia'],
		['Spain', 3, 1, 'Sweden'],
		['Hungary', 0, 4, 'Portugal'],
		['France', 1, 1, 'Germany'],
		['Finland', 0, 1, 'Russia'],
		['Turkey', 1, 0, 'Wales'],
		['Italy', 2, 0, 'Switzerland'],
		['Ukraine', 3, 0, 'North Macedonia'],
		['Denmark', 1, 2, 'Belgium'],
		['Netherlands', 1, 0, 'Austria'],
		['Sweden', 2, 0, 'Slovakia'],
		['Croatia', 2, 2, 'Czech Republic'],
		['England', 1, 2, 'Scotland'],
		['Hungary', 0, 3, 'France'],
		['Portugal', 2, 2, 'Germany'],
		['Spain', 2, 0, 'Poland'],
		['Italy', 1, 0, 'Wales'],
		['Switzerland', 0, 1, 'Turkey'],
		['North Macedonia', 1, 4, 'Netherlands'],
		['Ukraine', 1, 0, 'Austria'],
		['Russia', 1, 2, 'Denmark'],
		['Finland', 0, 2, 'Belgium'],
		['Czech Republic', 1, 1, 'England'],
		['Croatia', 2, 0, 'Scotland'],
		['Slovakia', 0, 2, 'Spain'],
		['Sweden', 1, 1, 'Poland'],
		['Germany', 2, 0, 'Hungary'],
		['Portugal', 1, 2, 'France'],
	],
	'Samara' => [
		['Turkey', 1, 2, 'Italy'],
		['Wales', 0, 1, 'Switzerland'],
		['Denmark', 3, 2, 'Finland'],
		['Belgium', 3, 1, 'Russia'],
		['England', 1, 0, 'Croatia'],
		['Austria', 0, 0, 'North Macedonia'],
		['Netherlands', 2, 0, 'Ukraine'],
		['Scotland', 0, 2, 'Czech Republic'],
		['Poland', 1, 1, 'Slovakia'],
		['Spain', 4, 2, 'Sweden'],
		['Hungary', 1, 3, 'Portugal'],
		['France', 2, 2, 'Germany'],
		['Finland', 0, 2, 'Russia'],
		['Turkey', 3, 0, 'Wales'],
		['Italy', 2, 1, 'Switzerland'],
		['Ukraine', 2, 0, 'North Macedonia'],
		['Denmark', 1, 3, 'Belgium'],
		['Netherlands', 1, 1, 'Austria'],
		['Sweden', 1, 0, 'Slovakia'],
		['Croatia', 2, 1, 'Czech Republic'],
		['England', 2, 1, 'Scotland'],
		['Hungary', 0, 3, 'France'],
		['Portugal', 2, 2, 'Germany'],
		['Spain', 3, 1, 'Poland'],
		['Italy', 2, 0, 'Wales'],
		['Switzerland', 0, 0, 'Turkey'],
		['North Macedonia', 0, 1, 'Netherlands'],
		['Ukraine', 2, 1, 'Austria'],
		['Russia', 1, 3, 'Denmark'],
		['Finland', 0, 3, 'Belgium'],
		['Czech Republic', 1, 2, 'England'],
		['Croatia', 1, 0, 'Scotland'],
		['Slovakia', 0, 2, 'Spain'],
		['Sweden', 1, 1, 'Poland'],
		['Germany', 2, 0, 'Hungary'],
		['Portugal', 2, 2, 'France'],
	],
	'Rob' => [
		['Turkey', 0, 2, 'Italy'],
		['Wales', 1, 1, 'Switzerland'],
		['Denmark', 1, 0, 'Finland'],
		['Belgium', 2, 1, 'Russia'],
		['England', 1, 1, 'Croatia'],
		['Austria', 2, 0, 'North Macedonia'],
		['Netherlands', 2, 1, 'Ukraine'],
		['Scotland', 0, 1, 'Czech Republic'],
		['Poland', 1, 1, 'Slovakia'],
		['Spain', 2, 1, 'Sweden'],
		['Hungary', 0, 2, 'Portugal'],
		['France', 2, 2, 'Germany'],
		['Finland', 0, 1, 'Russia'],
		['Turkey', 1, 1, 'Wales'],
		['Italy', 2, 0, 'Switzerland'],
		['Ukraine', 2, 1, 'North Macedonia'],
		['Denmark', 1, 3, 'Belgium'],
		['Netherlands', 2, 1, 'Austria'],
		['Sweden', 1, 0, 'Slovakia'],
		['Croatia', 2, 1, 'Czech Republic'],
		['England', 2, 1, 'Scotland'],
		['Hungary', 0, 3, 'France'],
		['Portugal', 1, 1, 'Germany'],
		['Spain', 2, 0, 'Poland'],
		['Italy', 2, 1, 'Wales'],
		['Switzerland', 2, 2, 'Turkey'],
		['North Macedonia', 1, 3, 'Netherlands'],
		['Ukraine', 1, 1, 'Austria'],
		['Russia', 2, 1, 'Denmark'],
		['Finland', 0, 1, 'Belgium'],
		['Czech Republic', 0, 2, 'England'],
		['Croatia', 2, 1, 'Scotland'],
		['Slovakia', 0, 3, 'Spain'],
		['Sweden', 1, 2, 'Poland'],
		['Germany', 3, 1, 'Hungary'],
		['Portugal', 1, 1, 'France'],
	],
	'Mia' => [
		['Turkey', 0, 3, 'Italy'],
		['Wales', 0, 2, 'Switzerland'],
		['Denmark', 1, 1, 'Finland'],
		['Belgium', 3, 1, 'Russia'],
		['England', 2, 1, 'Croatia'],
		['Austria', 4, 0, 'North Macedonia'],
		['Netherlands', 2, 0, 'Ukraine'],
		['Scotland', 0, 2, 'Czech Republic'],
		['Poland', 2, 0, 'Slovakia'],
		['Spain', 3, 0, 'Sweden'],
		['Hungary', 1, 3, 'Portugal'],
		['France', 2, 2, 'Germany'],
		['Finland', 0, 1, 'Russia'],
		['Turkey', 1, 1, 'Wales'],
		['Italy', 2, 0, 'Switzerland'],
		['Ukraine', 2, 0, 'North Macedonia'],
		['Denmark', 1, 3, 'Belgium'],
		['Netherlands', 2, 0, 'Austria'],
		['Sweden', 2, 1, 'Slovakia'],
		['Croatia', 2, 1, 'Czech Republic'],
		['England', 3, 0, 'Scotland'],
		['Hungary', 0, 3, 'France'],
		['Portugal', 1, 2, 'Germany'],
		['Spain', 3, 1, 'Poland'],
		['Italy', 2, 0, 'Wales'],
		['Switzerland', 1, 0, 'Turkey'],
		['North Macedonia', 0, 3, 'Netherlands'],
		['Ukraine', 0, 0, 'Austria'],
		['Russia', 1, 2, 'Denmark'],
		['Finland', 0, 2, 'Belgium'],
		['Czech Republic', 1, 2, 'England'],
		['Croatia', 2, 0, 'Scotland'],
		['Slovakia', 0, 3, 'Spain'],
		['Sweden', 1, 2, 'Poland'],
		['Germany', 3, 0, 'Hungary'],
		['Portugal', 2, 3, 'France'],
	],
	'Super John' => [
		['Turkey', 2, 2, 'Italy'],
		['Wales', 2, 0, 'Switzerland'],
		['Denmark', 2, 1, 'Finland'],
		['Belgium', 1, 0, 'Russia'],
		['England', 2, 1, 'Croatia'],
		['Austria', 1, 3, 'North Macedonia'],
		['Netherlands', 3, 0, 'Ukraine'],
		['Scotland', 1, 1, 'Czech Republic'],
		['Poland', 1, 1, 'Slovakia'],
		['Spain', 3, 1, 'Sweden'],
		['Hungary', 0, 2, 'Portugal'],
		['France', 2, 0, 'Germany'],
		['Finland', 1, 3, 'Russia'],
		['Turkey', 1, 3, 'Wales'],
		['Italy', 2, 0, 'Switzerland'],
		['Ukraine', 0, 1, 'North Macedonia'],
		['Denmark', 1, 1, 'Belgium'],
		['Netherlands', 0, 0, 'Austria'],
		['Sweden', 1, 0, 'Slovakia'],
		['Croatia', 0, 0, 'Czech Republic'],
		['England', 4, 0, 'Scotland'],
		['Hungary', 0, 3, 'France'],
		['Portugal', 2, 2, 'Germany'],
		['Spain', 2, 0, 'Poland'],
		['Italy', 1, 3, 'Wales'],
		['Switzerland', 1, 1, 'Turkey'],
		['North Macedonia', 0, 1, 'Netherlands'],
		['Ukraine', 0, 0, 'Austria'],
		['Russia', 1, 0, 'Denmark'],
		['Finland', 0, 2, 'Belgium'],
		['Czech Republic', 0, 2, 'England'],
		['Croatia', 0, 1, 'Scotland'],
		['Slovakia', 0, 2, 'Spain'],
		['Sweden', 2, 1, 'Poland'],
		['Germany', 4, 1, 'Hungary'],
		['Portugal', 1, 1, 'France'],
	],
	'Carl' => [
		['Turkey', 0, 2, 'Italy'],
		['Wales', 1, 1, 'Switzerland'],
		['Denmark', 2, 1, 'Finland'],
		['Belgium', 3, 0, 'Russia'],
		['England', 1, 0, 'Croatia'],
		['Austria', 2, 0, 'North Macedonia'],
		['Netherlands', 3, 0, 'Ukraine'],
		['Scotland', 1, 1, 'Czech Republic'],
		['Poland', 2, 1, 'Slovakia'],
		['Spain', 2, 0, 'Sweden'],
		['Hungary', 0, 3, 'Portugal'],
		['France', 1, 1, 'Germany'],
		['Finland', 1, 1, 'Russia'],
		['Turkey', 1, 1, 'Wales'],
		['Italy', 2, 0, 'Switzerland'],
		['Ukraine', 2, 0, 'North Macedonia'],
		['Denmark', 0, 2, 'Belgium'],
		['Netherlands', 2, 0, 'Austria'],
		['Sweden', 2, 1, 'Slovakia'],
		['Croatia', 1, 1, 'Czech Republic'],
		['England', 2, 1, 'Scotland'],
		['Hungary', 0, 3, 'France'],
		['Portugal', 1, 2, 'Germany'],
		['Spain', 3, 0, 'Poland'],
		['Italy', 2, 0, 'Wales'],
		['Switzerland', 2, 1, 'Turkey'],
		['North Macedonia', 0, 3, 'Netherlands'],
		['Ukraine', 2, 1, 'Austria'],
		['Russia', 2, 1, 'Denmark'],
		['Finland', 1, 3, 'Belgium'],
		['Czech Republic', 0, 2, 'England'],
		['Croatia', 1, 0, 'Scotland'],
		['Slovakia', 0, 2, 'Spain'],
		['Sweden', 1, 2, 'Poland'],
		['Germany', 4, 0, 'Hungary'],
		['Portugal', 2, 1, 'France'],
	],
	'Andy' => [
		['Turkey', 1, 3, 'Italy'],
		['Wales', 0, 1, 'Switzerland'],
		['Denmark', 2, 0, 'Finland'],
		['Belgium', 3, 1, 'Russia'],
		['England', 1, 1, 'Croatia'],
		['Austria', 3, 0, 'North Macedonia'],
		['Netherlands', 2, 1, 'Ukraine'],
		['Scotland', 0, 2, 'Czech Republic'],
		['Poland', 1, 1, 'Slovakia'],
		['Spain', 2, 1, 'Sweden'],
		['Hungary', 1, 4, 'Portugal'],
		['France', 2, 2, 'Germany'],
		['Finland', 0, 1, 'Russia'],
		['Turkey', 1, 0, 'Wales'],
		['Italy', 2, 1, 'Switzerland'],
		['Ukraine', 3, 0, 'North Macedonia'],
		['Denmark', 1, 2, 'Belgium'],
		['Netherlands', 2, 1, 'Austria'],
		['Sweden', 3, 1, 'Slovakia'],
		['Croatia', 1, 1, 'Czech Republic'],
		['England', 2, 0, 'Scotland'],
		['Hungary', 1, 3, 'France'],
		['Portugal', 1, 2, 'Germany'],
		['Spain', 2, 1, 'Poland'],
		['Italy', 2, 0, 'Wales'],
		['Switzerland', 1, 1, 'Turkey'],
		['North Macedonia', 0, 4, 'Netherlands'],
		['Ukraine', 1, 1, 'Austria'],
		['Russia', 1, 2, 'Denmark'],
		['Finland', 1, 3, 'Belgium'],
		['Czech Republic', 1, 2, 'England'],
		['Croatia', 1, 1, 'Scotland'],
		['Slovakia', 1, 3, 'Spain'],
		['Sweden', 1, 1, 'Poland'],
		['Germany', 3, 1, 'Hungary'],
		['Portugal', 1, 2, 'France'],
	],
	'Martin' => [
		['Turkey', 0, 2, 'Italy'],
		['Wales', 0, 1, 'Switzerland'],
		['Denmark', 3, 1, 'Finland'],
		['Belgium', 4, 1, 'Russia'],
		['England', 2, 1, 'Croatia'],
		['Austria', 2, 0, 'North Macedonia'],
		['Netherlands', 2, 1, 'Ukraine'],
		['Scotland', 0, 1, 'Czech Republic'],
		['Poland', 2, 2, 'Slovakia'],
		['Spain', 2, 1, 'Sweden'],
		['Hungary', 0, 3, 'Portugal'],
		['France', 2, 2, 'Germany'],
		['Finland', 1, 2, 'Russia'],
		['Turkey', 0, 0, 'Wales'],
		['Italy', 2, 1, 'Switzerland'],
		['Ukraine', 2, 1, 'North Macedonia'],
		['Denmark', 1, 3, 'Belgium'],
		['Netherlands', 3, 1, 'Austria'],
		['Sweden', 2, 0, 'Slovakia'],
		['Croatia', 2, 1, 'Czech Republic'],
		['England', 2, 0, 'Scotland'],
		['Hungary', 1, 3, 'France'],
		['Portugal', 2, 3, 'Germany'],
		['Spain', 3, 1, 'Poland'],
		['Italy', 3, 0, 'Wales'],
		['Switzerland', 1, 0, 'Turkey'],
		['North Macedonia', 0, 3, 'Netherlands'],
		['Ukraine', 2, 2, 'Austria'],
		['Russia', 1, 3, 'Denmark'],
		['Finland', 1, 3, 'Belgium'],
		['Czech Republic', 2, 1, 'England'],
		['Croatia', 3, 0, 'Scotland'],
		['Slovakia', 1, 2, 'Spain'],
		['Sweden', 2, 0, 'Poland'],
		['Germany', 3, 1, 'Hungary'],
		['Portugal', 2, 3, 'France'],
	],
];

$playerPredictionsKO = [];

// processMatch([0], [1], [2], [floor4], [4-floor4*10])
// processMatch('Russia', 5, 0, 1, 10)
// processMatch([3], [2], [1], [floor5], [5-floor5*10])
// processMatch('Saudi Arabia', 0, 5, 1, 10)
// processMatch('Columbia', 1, 2, 'Japan', 2.1, 1); // Columbia = 2x Yellow Carc 1x Red Card, Japan = 1x Yellow Card
// Yellow cards = floor(column) so the 2.1 becomes 2.
// Red cards = column - floor(column) [2.1 - 2] * 10.
// function processMatch($team, $gf, $ga, $yc = yellow cards, $rc = red cards) :: in function fp = fair play

// Euro 2020 tie rules.
// The procedures to determine ranking are as follows:
// 1) Points in head-to-head matches among tied teams;
// 2) Goal difference in head-to-head matches between tied teams;
// 3) Goals scored in head-to-head matches among tied teams.

// If, after following the criteria above, the teams are still level, the next stage of the process takes the whole group into account.
// 1) Superior goal difference in all matches;
// 2) Higher number of goals scored in all group stage matches;
// 3) Highest number of wins in all group stages.

// And if you still can't separate the teams tied, the process turns its attention towards the team's disciplinary record in the group stages.
// A red card is scored as three points, a yellow card is scored as one and two yellow cards in one match count as three points.

// The last resort is separating the two teams based on their overall European Qualifiers ranking.

$matchesKO = [];

// Team standings from results. Initial seed, set all to 0
$standings = [];
foreach ($teams as $k => $v) {
	$standings[$k] = ['pld' => 0, 'w' => 0, 'd' => 0, 'l' => 0, 'gf' => 0, 'ga' => 0, 'gd' => 0, 'pts' => 0];
}

// Initial seeds for predictions.
$standingsPredictions = [];
foreach ($playerPredictions as $k => $v) {
	$standingsPredictions[$k] = ['rs' => 0, 'r' => 0, 's' => 0, 'pts' => 0];
}

foreach ($matchesGroups as $groupMatch) {
	$match = end($groupMatch); // Since I added the groups to be able to select the matches I need to do a mini hack...
	if ($match[4] !== 'np') { // Not played. This is so the group tables don't show everyone having played.
		processMatch($match[0], $match[1], $match[2]);
		processMatch($match[3], $match[2], $match[1]);

		processPrediction($match[0], $match[1], $match[2], $match[3]);
	}
	// Above could be called once with the function being clever instead?
}

function processPrediction($home, $goalsHome, $goalsAway, $away) {
	global $playerPredictions, $standingsPredictions;

	foreach ($playerPredictions as $player => $predictions) {
		$standing = $standingsPredictions[$player];

		foreach ($predictions as $match) {
			if ($match[0] == $home && $match[3] == $away) {
				$resultScore = 0;
				$result = 0;
				$score = 0;

				if ($match[1] == $goalsHome && $match[2] == $goalsAway) {
					$resultScore = 1;
					$result = 1;
					$score = 2;
				} else {
					if (($match[1] > $match[2] && $goalsHome > $goalsAway) || ($match[1] < $match[2] && $goalsHome < $goalsAway) || ($match[1] == $match[2] && $goalsHome == $goalsAway)) {
						$result = 1;
					}

					if ($match[1] == $goalsHome || $match[2] == $goalsAway) {
						$score = 1;
					}
				}

				$standing['rs'] += $resultScore;
				$standing['r'] += $result;
				$standing['s'] += $score;
				$standing['pts'] += ($resultScore * 2) + ($result * 3) + $score;
				$standingsPredictions[$player] = $standing;
			
				break;
			}
		}
	}
}



function processMatch($team, $gf, $ga) {
	global $standings;
	if ($gf > $ga) {
		$pts = 3;
		$win = 1;
		$draw = 0;
		$loss = 0;
	} elseif ($gf == $ga) {
		$pts = 1;
		$win = 0;
		$draw = 1;
		$loss = 0;
	} else {
		$pts = 0;
		$win = 0;
		$draw = 0;
		$loss = 1;
	}

	$standing = $standings[$team];
	$standing['pld']++;
	$standing['w'] += $win;
	$standing['d'] += $draw;
	$standing['l'] += $loss;
	$standing['gf'] += $gf;
	$standing['ga'] += $ga;
	$standing['gd'] =+ $gf - $ga;
	$standing['pts'] += $pts;
	$standings[$team] = $standing;
}



function sortTable($group = '') {
	global $standings, $teams, $matchesGroups;

	$tbl = [];
	foreach ($standings as $key => $row) {
		if ($group == '' || $group == $teams[$key]) {
			$pts[$key] = $row['pts'];
			$gd[$key] = $row['gd'];
			$gf[$key] = $row['gf'];
			$tm[$key] = $key; // tm = Team
			$tbl[$key] = $row;
		}
	}
	array_multisort($pts, SORT_DESC, $gd, SORT_DESC, $gf, SORT_DESC, $tm, SORT_ASC, $tbl);

	$intH2H = 0; // check for Head 2 Head victories
	$tblH2H = [];
	foreach ($tbl as $key => $row) {
		$tblH2H[$intH2H] = array_merge(['tm' => $key], $row);
		$intH2H++;
	}

	$intH2H = false;
	foreach ($tblH2H as $key => $row) {
		if (isset($tblH2H[$key+1]) && $row['pts']==$tblH2H[$key+1]['pts'] && $row['gd']==$tblH2H[$key+1]['gd'] && $row['gf']==$tblH2H[$key+1]['gf'] && (checkMatch($row['tm'],$tblH2H[$key+1]['tm']) || checkMatch($tblH2H[$key+1]['tm'],$row['tm']))) {
			//foreach ($matchesGroups as $val) {
			foreach ($matchesGroups as $groupMatch) {
				foreach ($groupMatch as $k => $val) {
					if (($val[0] == $row['tm'] && $val[3] == $tblH2H[$key+1]['tm'] && $val[1] < $val[2]) || ($val[3] == $row['tm'] && $val[0] == $tblH2H[$key+1]['tm'] && $val[2] < $val[1])) { // swap
						$val = $tblH2H[$key];
						$tblH2H[$key] = $tblH2H[$key+1];
						$tblH2H[$key+1] = $val;
						$intH2H = true;
					}
				}
			}
		}
	}

	if ($intH2H) { // new table
		$tbl = array();
		foreach ($tblH2H as $row) {
			$key = $row['tm']; // tm = Team
			unset($row['tm']);
			$tbl[$key]=$row;
		}
	}

	return $tbl;
}


function showTable($tbl, $group = '', $slim = false) {
	global $teams, $playerTeams;

	if ($slim === false) {
		$head = true;
		$posit = 1;
		$result = '<table class="group">';
		foreach ($tbl as $tm => $tb) {
			if ($head) {
				$result .= '<thead>';
				$result .= '<tr><th>Group '.$group.'</th>';
				foreach ($tb as $key => $val) {
					$result .= '<th>'.$key.'</th>';
				}
				$result .= '</tr>';
				$result .='</thead>';
				$head = false;        
			}
			if ($tb['gd'] > 0) $tb['gd'] = '+'.$tb['gd'];
			$result .= '<tr><td>'.showFlag($tm).$tm.($playerTeams[$tm]?' ('.$playerTeams[$tm].')':' ').'</td><td>'.implode('</td><td>',$tb).'</td></tr>';
			//$wcTeams[$tm] = $group.$posit;
			$posit++;
		}
		$result .= '</table>';
	} else {
		$result = '<div class="group">';
			$result .= '<h2>Group '.$group.'</h2>';
			$result .= '<div class="group-teams">';
				foreach ($tbl as $tm => $tb) {
					$result .= '<div class="group-team">';
						$result .= '<div class="team-flag">'.showFlag($tm).'</div>';
						$result .= '<div class="team-player">';
							$result .= "<div class=\"team\">{$tm}</div>";
							$result .= "<div class=\"player\">{$playerTeams[$tm]}</div>";
						$result .= '</div>';
					$result .= '</div>';
				}
			$result .= '</div>';
		$result .= '</div>';
	}

	return $result;
}



function checkMatch($home, $away, $knockout = false) {
	global $matchesGroups, $matchesKO;

//	$checkMatches = $knockout ? $matchesKO : $matchesGroups;
//	foreach ($checkMatches as $key => $val) {
//		if ($val[0] === $home && $val[3] === $away) {
//			return true;
//		}
//	}


	if ($knockout) {
		return false;
	} else {
		foreach ($matchesGroups as $groupMatch) {
			foreach ($groupMatch as $k => $v) {
				if ($v[0] === $home && $v[3] === $away) return true;
			}
		}
	}

	return false;
}



function showFlag($str) {
	return '<img src="images/flags/'.strtolower(str_replace(' ', '-', $str)).'.png" width="35" height="35">';
}



function sortPredictions() {
	global $standingsPredictions;

	$tbl = [];
	foreach ($standingsPredictions as $key => $row) {
		$pts[$key]  = $row['pts'];
		$rs[$key] = $row['rs'];
		$r[$key] = $row['r'];
		$s[$key] = $row['s'];
		$p[$key] = $key;
		$tbl[$key] = $row;
	}

	array_multisort($pts, SORT_DESC, $rs, SORT_DESC, $r, SORT_DESC, $s, SORT_DESC, $p, SORT_ASC, $tbl);

	return $tbl;
}


function showPredictions($tbl) {
	$head = true;
	//$posit = 1;
	
	$result = '<div class="group">';
	$result .= '<h2>Predictions</h2>';
	$result .= '<table class="group prediction">';
	$result .= '<tbody>';
	foreach ($tbl as $player => $tb) {
		if ($head) {
			$result .= '<tr><th>&nbsp;</th>';
			foreach ($tb as $key => $val) {
				if ($key == 'rs') $key = 'r+s';
				$result .= '<th>'.$key.'</th>';
			}
			$result .= '</tr>';
			$head = false;        
		}
		$result .= '<tr><td>'.$player.'</td><td>'.implode('</td><td>',$tb).'</td></tr>';
	}
	$result .= '</tbody>';
	$result .= '</table>';
	$result .= '</div>';

	return $result;
}


function showPredictionMatches() {
	global $playerPredictions, $playerPredictionsKO, $teams, $matchesGroups;

	foreach ($playerPredictions as $player => $predictions) {
		echo '<div class="group-matches group-predictions">';
		echo '<h2>'.$player.'</h2>';

		foreach ($predictions as $game) {
			$resultClass = '';
			$resultScore = 0;
			$result = 0;
			$score = 0;

			foreach ($matchesGroups as $groupMatch) {
				foreach ($groupMatch as $k => $v) {
					if ($v[4] == 'p' && ($v[0] == $game[0] && $v[3] == $game[3])) {
						if ($v[1] == $game[1] && $v[2] == $game[2]) {
							$resultScore = 1;
							$result = 1;
							$score = 2;
						} else {
							if (
								($game[1] > $game[2] && $v[1] > $v[2]) ||
								($game[1] < $game[2] && $v[1] < $v[2]) ||
								($game[1] == $game[2] && $v[1] == $v[2])
							) {
								$result = 1;
							}

							if ($v[1] == $game[1] || $v[2] == $game[2]) {
								$score = 1;
							}
						}

						$scoreTotal = ($resultScore * 2) + ($result * 3) + $score;
						$resultClass = 'f';
						switch ($scoreTotal)
						{
							case 7:
								$resultClass = 'rs';
								break;
							case 4:
								$resultClass = 'r-s';
								break;
							case 3:
								$resultClass = 'r';
								break;
							case 1:
								$resultClass = 's';
								break;
						}
					}
				}
			}

			echo '<div class="match '. $resultClass .'">';
				echo '<div class="team-home">'.$game[0].'</div>';
				echo '<div class="team-flag">'.showFlag($game[0]).'</div>';
				echo '<div class="team-score">'.$game[1].'</div>';
				echo '<div class="team-score">'.$game[2].'</div>';
				echo '<div class="team-flag">'.showFlag($game[3]).'</div>';
				echo '<div class="team-away">'.$game[3].'</div>';
			echo '</div>';
		}
		echo '</div>';

		// foreach ($playerPredictionsKO[$player] as $game) {
		// 	if (checkMatch($game[0], $game[3], true)) {
		// 		echo '<tr>';
		// 			echo '<td>'.showFlag($game[0]).' '.$game[0].'</td>';
		// 			echo '<td>'.$game[1].':'.$game[2].'</td>';
		// 			echo '<td>'.$game[3].' '.showFlag($game[3]).'</td>';
		// 			echo '<td><span>'.getPoints($game[0], $game[1], $game[2], $game[3], true).'</span></td>';
		// 		echo '</tr>';
		// 	}
		// }
	}
}



function showPlayerPredictions($selectedPlayer) {
	global $playerPredictions, $playerPredictionsKO, $teams, $matchesGroups;

	foreach ($playerPredictions as $player => $predictions) {
		if ($player === $selectedPlayer) {
			echo '<div class="group-matches group-predictions">';
			echo '<h2>'.$player.'</h2>';
	
			foreach ($predictions as $game) {
				$resultClass = '';
				$resultScore = 0;
				$result = 0;
				$score = 0;
	
				foreach ($matchesGroups as $groupMatch) {
					foreach ($groupMatch as $k => $v) {
						if ($v[4] == 'p' && ($v[0] == $game[0] && $v[3] == $game[3])) {
							if ($v[1] == $game[1] && $v[2] == $game[2]) {
								$resultScore = 1;
								$result = 1;
								$score = 2;
							} else {
								if (
									($game[1] > $game[2] && $v[1] > $v[2]) ||
									($game[1] < $game[2] && $v[1] < $v[2]) ||
									($game[1] == $game[2] && $v[1] == $v[2])
								) {
									$result = 1;
								}
	
								if ($v[1] == $game[1] || $v[2] == $game[2]) {
									$score = 1;
								}
							}
	
							$scoreTotal = ($resultScore * 2) + ($result * 3) + $score;
							$resultClass = 'f';
							switch ($scoreTotal)
							{
								case 7:
									$resultClass = 'rs';
									break;
								case 4:
									$resultClass = 'r-s';
									break;
								case 3:
									$resultClass = 'r';
									break;
								case 1:
									$resultClass = 's';
									break;
							}
						}
					}
				}
	
				echo '<div class="match '. $resultClass .'">';
					echo '<div class="team-home">'.$game[0].'</div>';
					echo '<div class="team-flag">'.showFlag($game[0]).'</div>';
					echo '<div class="team-score">'.$game[1].'</div>';
					echo '<div class="team-score">'.$game[2].'</div>';
					echo '<div class="team-flag">'.showFlag($game[3]).'</div>';
					echo '<div class="team-away">'.$game[3].'</div>';
				echo '</div>';
			}
			echo '</div>';
			break;
		}

		// foreach ($playerPredictionsKO[$player] as $game) {
		// 	if (checkMatch($game[0], $game[3], true)) {
		// 		echo '<tr>';
		// 			echo '<td>'.showFlag($game[0]).' '.$game[0].'</td>';
		// 			echo '<td>'.$game[1].':'.$game[2].'</td>';
		// 			echo '<td>'.$game[3].' '.showFlag($game[3]).'</td>';
		// 			echo '<td><span>'.getPoints($game[0], $game[1], $game[2], $game[3], true).'</span></td>';
		// 		echo '</tr>';
		// 	}
		// }
	}
}



function checkMatchPredResult($prediction, $home, $gf, $ga, $away) {
	$resultScore = 0;
	$result = 0;
	$score = 0;

//	if ($) {

//	}
}



function getPoints($home, $gf, $ga, $away, $knockout = false) {
	global $matchesGroups, $matchesKO;

	if ($knockout) {

	} else {
		foreach ($matchesGroups as $groupMatch) {
			foreach ($groupMatch as $group => $match) {
				if ($match[0] == $home && $match[3] == $away) {
					$rs = 0;
					$r = 0;
					$s = 0;
		
					if ($match[1] == $gf && $match[2]==$ga) {
						$rs = 1;
						$r = 1;
						$s = 2;
					} else {
						if (($match[1] > $match[2] && $gf > $ga) || ($match[1] < $match[2] && $gf < $ga) || ($match[1] == $match[2] && $gf == $ga)) {
							$r = 1;
						} 
						if ($match[1] == $gf || $match[2] == $ga) {
							$s = 1;
						}
					}
				
					return ($rs * 2) + ($r * 3) + $s;
				}
			}
		}
	}

	// $checkMatches = $knockout ? $matchesKO : $matchesGroups;
	// foreach ($checkMatches as $match) {
	// 	if ($match[0] == $home && $match[3] == $away) {
	// 		$rs = 0;
	// 		$r = 0;
	// 		$s = 0;

	// 		if ($match[1] == $gf && $match[2]==$ga) {
	// 			$rs = 1;
	// 			$r = 1;
	// 			$s = 2;
	// 		} else {
	// 			if (($match[1] > $match[2] && $gf > $ga) || ($match[1] < $match[2] && $gf < $ga) || ($match[1] == $match[2] && $gf == $ga)) {
	// 				$r = 1;
	// 			} 
	// 			if ($match[1] == $gf || $match[2] == $ga) {
	// 				$s = 1;
	// 			}
	// 		}
		
	// 		return ($rs * 2) + ($r * 3) + $s;
	// 	}
	// }
}



function showGroupMatches($group) {
	global $matchesGroups;

	$output = '<div class="group-matches">';
		$output .= '<h2>Group '.$group.'</h2>';
		$output .= '<div class="matches-container">';

			foreach ($matchesGroups as $groupMatch) {
				foreach ($groupMatch as $k => $v) {
					if ($k === $group) {
						$output .= '<div class="match">';
							$output .= '<div class="team-home">'.$v[0].'</div>';
							$output .= '<div class="team-flag">'.showFlag($v[0]).'</div>';
							$output .= '<div class="team-score">'.$v[1].'</div>';
							$output .= '<div class="team-score">'.$v[2].'</div>';
							$output .= '<div class="team-flag">'.showFlag($v[3]).'</div>';
							$output .= '<div class="team-away">'.$v[3].'</div>';
						$output .= '</div>';
					}
				}
			}

		$output .= '</div>';
	$output .= '</div>';

	return $output;
}
?>

<!doctype html>
<html lang="en">
<head>
<title>Euro 2020 Matches</title>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap">
<style>
*,
*::before,
*::after {
	box-sizing: border-box;
}

body {
	padding: 20px 50px;
	margin: 0;
	background-image: url(images/euro-bg.webp);
	background-size: cover;
	background-attachment: fixed;
	color: #FFF;
	font-family: 'Poppins', sans-serif;
	font-size: 14px;
}

.container {
	display: flex;
	gap: 30px;
}

.wrap {
	flex-wrap: wrap;
}

.sb {
	justify-content: space-between;
}

.panel-1,
.panel-3 {
	flex: 1;
}

.f1 {
	flex: 1;
}

.panel-2 {
	width: 60%;
}

.group-matches {
	border-radius: 10px;
	background-color: rgba(23, 158, 180, .8);
}

.group-matches h2 {
	background: rgb(69, 189, 206);
	text-align: center;
	border-top-left-radius: 10px;
	border-top-right-radius: 10px;
	font-size: 16px;
	font-weight: 400;
	padding: 10px 0;
}

.matches-container {
	padding: 0 20px 10px;
}

.match {
	display: flex;
	border-bottom: 2px solid #40BFD2;
	padding: 10px 0;
	gap: 5px;
	place-items: center;
	position: relative;
}
.group-predictions .match::before {
	content: '';
	position: absolute;
	top: 0;
	left: 0;
	bottom: 0;
	width: 5px;
}

.match:last-child {
	border-bottom: 0;
}

/* Since I can't linear gradient a single border and border-image applies to all borders lets use a psuedo element instead. */
.match.rs::before,
.demo.rs::before {
	background-color: #090;
}
.match.r-s::before,
.demo.r-s::before {
	background-image: linear-gradient(to top, #009 50%, #FC0 50%);
}
.match.r::before,
.demo.r::before {
	background-color: #FC0;
}
.match.s::before,
.demo.s::before {
	background-color: #009;
}
.match.f::before,
.demo.f::before {
	background-color: #900;
}

.team-home {
	flex: 1;
	text-align: right;
}

.team-away {
	flex: 1;
	text-align: left;
}

.team-flag {
	width: 35px;
	height: 35px;
	background: #000;
	border-radius: 50%;
}

.team-score {
	width: 35px;
	height: 35px;
	background: #FFF;
	border-radius: 50%;
	color: #000;
	text-align: center;
	font-size: 16px;
	padding-top: 5px;
}

.group-positions {
	display: flex;
	justify-content: space-around;
	margin-top: 13px;
}

.group {
	width: 15%;
	border-radius: 10px;
	background-color: rgba(23, 158, 180, .8);
}

.group-teams {
	padding: 0 10px;
}

.group h2 {
	background: rgb(69, 189, 206);
	text-align: center;
	border-top-left-radius: 10px;
	border-top-right-radius: 10px;
	font-size: 16px;
	font-weight: 400;
	margin: 0;
	padding: 5px 0;
}

.group-team {
	display: flex;
	gap: 5px;
	margin: 10px 0;
}

.team-player {
	display: flex;
	flex-direction: column;
	flex: 1;
	font-size: 11px;
}

.group-team:last-child .player {
	border-bottom: 0;
}

.player {
	border-bottom: 2px solid #40BFD2;
}

.group-predictions {
	width: 23%;
}

.group-predictions h2 {
	margin-top: 0;
	margin-bottom: 0;
}

.container > .group {
	width: 100%;
}

.container > table.group {
	width: 31%;
}

table.group {
	border-collapse: collapse;
}

table.group.prediction {
	width: 100%;
}

.predictions-container {
	width: 17%;
}

table.group img {
	width: 25px;
	height: 25px;
	vertical-align: middle;
	margin-right: 10px;
}

thead th {
	background: rgb(69, 189, 206);
	padding: 7px 5px;
	font-weight: normal;
}

thead th:first-child {
	border-top-left-radius: 10px;
}

thead th:last-child {
	border-top-right-radius: 10px;
}

tr:last-child td {
	border: 0;
}

th,
td {
	padding: 10px;
	text-align: center;
	border-bottom: 1px solid #40BFD2;
}

tr td:first-child {
	text-align: left;
	width: 50%;
}

.knockouts {
	margin-top: 50px;
}

.group .group {
	background-color: transparent;
}

.groups-container {
	flex: 1;
	flex-wrap: wrap;
	justify-content: space-between;
}

.js-togPred {
	cursor: pointer;
}

.js-togPred span {
	display: inline-block;
	transition: transform .3s ease-in;
}

.rotate {
	transform: rotate(180deg);
}



@media screen and (max-width: 500px) {
	.container > table.group {
		width: 100%;
	}
}












.ko-row {
	display: flex;
	justify-content: space-between;
	margin: 30px 0;
}

.ko-cell {
	border: 1px solid #FFF;
	border-radius: 50%;
	width: 50px;
	height: 50px;
	position: relative;
}

.ko-cell::before {
	content: '';
	position: absolute;
	top: 50%;
	right: 100%;
	width: 100%;
	height: 1px;
	border-bottom: 1px solid #FFF;
}

.ko-cell--no-before::before {
	display: none;
}

.ko-cell::after {
	content: '';
	position: absolute;
	top: 50%;
	left: 100%;
	width: 100%;
	height: 1px;
	border-bottom: 1px solid #FFF;
}

.ko-cell--no-after {
	display: none;
}

.ko-cell--yoink {
	width: 50px;
	height: 50px;
	position: relative;
}

.ko-cell--yoink::after {
	content: '';
	position: absolute;
	top: -110%;
	right: -92%;
	width: 1px;
	height: 160%;
	border-left: 1px solid #FFF;
}

.final-row {
	display: flex;
	justify-content: center;
}

.final-cell {
	border: 1px sold #FFF;
	border-radius: 50%;
	width: 75px;
	height: 75px;
}

.test-cell {
	width: 50px;
	height: 50px;
	border: 1px solid #FFF;
	border-radius: 50%;
}

.test-connector {
	border-top: 1px solid #FFF;
	flex: 1;
	margin-top: 25px;
}

.test-cell--gap-right {
	margin-right: 25px;
}

.test-cell--gap-left {
	margin-left: 25px;
}

.test-cell--no-show {
	border: 0;
}

.test-connector--no-show {
	border: 0;
}

.knockouts {
	display: grid;
	grid-template-columns: auto;
	grid-template-rows: auto;
	/* grid-template-areas:
		"KO16-1 JOIN_HORZ_DOWN KO16-2 . KO16-3 JOIN_HORZ_DOWN KO16-4 . KO16-5 JOIN_HORZ_DOWN KO16-6 . KO16-7 JOIN_HORZ_DOWN KO16-8"
		". JOIN_UP_RIGHT QTR-1 JOIN_HORZ_DOWN QTR-2 JOIN_LEFT_UP . . . JOIN_UP_RIGHT QTR-3 JOIN_HORZ_DOWN QTR-4 JOIN_LEFT_UP ."
		"KO16-9 JOIN_HORZ_DOWN KO16-10 . KO16-11 JOIN_HORZ_DOWN KO16-12 . KO16-13 JOIN_HORZ_DOWN KO16-14 . KO16-15 JOIN_HORZ_DOWN KO16-16"; */
		grid-template-areas:
			"KO161 JOIN-HORZ-DOWN KO162 KO163 KO16-4 KO16-5 KO16-6 KO16-7 KO16-8"
			"sp JOIN-UP-RIGHT QTR-1 sp sp sp sp sp sp"
			"KO16-9 JOIN-HORZ-UP KO16-10 KO16-11 KO16-12 KO16-13 KO16-6 KO16-7 KO16-8"
}

.KO161, .KO162, .KO163, .KO16-4, .KO16-5, .KO16-6, .KO16-7, .KO16-8, .KO16-9, .KO16-10, .KO16-11, .KO16-12, .KO16-13, .KO16-14, .KO16-15, .KO16-16 {
	border: 1px solid #FFF;
	border-radius: 50%;
}

.JOIN-HORZ-DOWN {
	grid-area: JOIN-HORZ-DOWN;
}

.JOIN-HORZ-UP {
	grid-area: JOIN-HORZ-UP;
}

.JOIN-UP

.KO16-1 {
	grid-area: KO161;
}
.KO16-2 {
	grid-area: KO162;
}
.KO16-3 {
	grid-area: KO163;
}
.KO16-4 {
	grid-area: KO16-4;
}
.KO16-5 {
	grid-area: KO16-5;
}
.KO16-6 {
	grid-area: KO16-6;
}
.KO16-7 {
	grid-area: KO16-7;
}
.KO16-8 {
	grid-area: KO16-8;
}
.KO16-9 {
	grid-area: KO16-9;
}
.KO16-10 {
	grid-area: KO16-10;
}
.KO16-11 {
	grid-area: KO16-11;
}
.KO16-12 {
	grid-area: KO16-12;
}
.KO16-13 {
	grid-area: KO16-13;
}
.KO16-14 {
	grid-area: KO16-14;
}
.KO16-15 {
	grid-area: KO16-15;
}
.KO16-16 {
	grid-area: KO16-16;
}

.js-preds {
	transition: height .3s ease-in;
	overflow: hidden;
}

.show {
	height: auto;
}

.demo {
	position: relative;
	padding-left: 20px;
	margin-bottom: 10px;
}
.demo::before {
	content: '';
	position: absolute;
	top: 0;
	left: 0;
	bottom: 0;
	width: 10px;
}

.help-toggle {
	position: fixed;
	top: -20px;
	right: 7px;
	font-size: 70px;
	cursor: pointer;
}
.help-box {
	position: fixed;
	top: 0;
	right: 50px;
	background: rgb(23, 158, 180);
	z-index: 1;
	padding: 10px 30px;
	width: 15%;
	border-bottom-left-radius: 10px;
	border-bottom-right-radius: 10px;
	box-shadow: 0 0 10px #fffa;
	border-top: 0;
	overflow: hidden;
	transition: transform .3s ease-in;
	transform: translateY(-100%);
}
.help-box.show {
	transform: translateY(0);
}
.help-box h2 {
	margin-bottom: 0;
}
.help-box h2:first-child {
	margin-top: 0;
}
.help-box h2+p {
	margin-top: 0;
}
	
.help-box a {
	color: #EEE;
	text-decoration: none;
}

.override-group-preds .group-predictions {
	width: 100%;
}
</style>
</head>
<body>
<div class="help-toggle">?</div>
<div class="help-box">
	<h2>Links</h2>
	<p>
		<a href="https://www.colincharlton.net/euro-2020/">Full design</a><br>
		<a href="https://www.colincharlton.net/euro-2020/?noflash">Just groups and predictions</a><br>
		<a href="https://www.colincharlton.net/euro-2020/?noflash&pred-table">Predictions table only</a>
	</p>

	<p>
		<?php
		foreach ($playerPredictions as $player => $predictions) {
			echo '<a href="https://www.colincharlton.net/euro-2020/?noflash&pred-table=0&preds='.$player.'">'.$player.'\'s Predictions</a> (<a href="https://www.colincharlton.net/euro-2020/?noflash&pred-table=1&preds='.$player.'">+ predictions table</a>)<br>';
		}
		?>
	</p>

	<h2>Prediction Colours</h2>
	<div class="demo rs">Result + score<br>7 points</div>
	<div class="demo r-s">Result + a score<br>4 points</div>
	<div class="demo r">Result<br>3 points</div>
	<div class="demo s">A score<br>1 point</div>
	<div class="demo f">Nothing<br>0 points</div>
</div>


<?php if (!isset($_GET['noflash'])) { ?>
<div class="container">
	<div class="panel-1">
		<?php
		echo showGroupMatches('A');
		echo showGroupMatches('B');
		echo showGroupMatches('C');
		?>
	</div>

	<div class="panel-2">
		<div class="group-positions">
			<?php
			$groups = ['A', 'B', 'C', 'D', 'E', 'F'];
			foreach ($groups as $group) {
				$tbl = sortTable($group);
				echo showTable($tbl, $group, true);
			}
			?>
		</div>

		<div class="knockouts">
			<!--
			<div class="KO16-1"></div>
			<div class="JOIN-HORZ-DOWN"></div>
			<div class="KO16-2"></div>
			<div class="KO16-3"></div>
			<div class="KO16-4"></div>
			<div class="KO16-5"></div>
			<div class="KO16-6"></div>
			<div class="KO16-7"></div>
			<div class="KO16-8"></div>




			<div class="KO16-9"></div>
			<div class="JOIN-HORZ-UP"></div>
			<div class="KO16-10"></div>
			<div class="KO16-11"></div>
			<div class="KO16-12"></div>
			<div class="KO16-13"></div>
			<div class="KO16-14"></div>
			<div class="KO16-15"></div>
			<div class="KO16-16"></div>
			-->







			<!--
			<div class="ko-row">
				<div class="test-cell">C</div>
					<div class="test-connector">&nbsp;</div>
				<div class="test-cell test-cell--gap-right">C</div>
				
				<div class="test-cell test-cell--gap-left">C</div>
					<div class="test-connector">&nbsp;</div>
				<div class="test-cell test-cell--gap-right">C</div>
				
				<div class="test-cell test-cell--gap-left">C</div>
					<div class="test-connector">&nbsp;</div>
				<div class="test-cell test-cell--gap-right">C</div>
				
				<div class="test-cell test-cell--gap-left">C</div>
					<div class="test-connector">&nbsp;</div>
				<div class="test-cell">C</div>
			</div>
			<div class="ko-row">
				<div class="test-cell test-cell--no-show">&nbsp;</div>
					<div class="test-connector test-connector--no-show">&nbsp;</div>
				<div class="test-cell">C</div>
				
				<div class="test-cell test-cell--gap-left">C</div>
					<div class="test-connector">&nbsp;</div>
				<div class="test-cell test-cell--gap-right">C</div>
				
				<div class="test-cell test-cell--gap-left">C</div>
					<div class="test-connector">&nbsp;</div>
				<div class="test-cell test-cell--gap-right">C</div>
				
				<div class="test-cell test-cell--gap-left">C</div>
					<div class="test-connector">&nbsp;</div>
				<div class="test-cell">C</div>
			</div>


			<div class="ko-row">
				<div class="ko-cell ko-cell--no-before">C</div>
				<div class="ko-cell">C</div>
				<div class="ko-cell">C</div>
				<div class="ko-cell">C</div>
				<div class="ko-cell">C</div>
				<div class="ko-cell">C</div>
				<div class="ko-cell">C</div>
				<div class="ko-cell">C</div>
			</div>

			<div class="ko-row">
				<div class="ko-cell--yoink"></div>
				<div class="ko-cell">C</div>
				<div class="ko-cell">C</div>
				<div class="ko-cell--yoink"></div>
				<div class="ko-cell--yoink"></div>
				<div class="ko-cell">C</div>
				<div class="ko-cell">C</div>
				<div class="ko-cell--yoink"></div>
			</div>

			<div class="final-row">
				<div class="final-cell">C</div>
				<div class="final-cell">C</div>
			</div>

			<div class="ko-row">
				<div class="ko-cell--yoink"></div>
				<div class="ko-cell">C</div>
				<div class="ko-cell">C</div>
				<div class="ko-cell--yoink"></div>
				<div class="ko-cell--yoink"></div>
				<div class="ko-cell">C</div>
				<div class="ko-cell">C</div>
				<div class="ko-cell--yoink"></div>
			</div>

			<div class="ko-row">
				<div class="ko-cell--yoink"></div>
				<div class="ko-cell">C</div>
				<div class="ko-cell">C</div>
				<div class="ko-cell--yoink"></div>
				<div class="ko-cell--yoink"></div>
				<div class="ko-cell">C</div>
				<div class="ko-cell">C</div>
				<div class="ko-cell--yoink"></div>
			</div>

			<div class="ko-row">
				<div class="ko-cell">C</div>
				<div class="ko-cell">C</div>
				<div class="ko-cell">C</div>
				<div class="ko-cell">C</div>
				<div class="ko-cell">C</div>
				<div class="ko-cell">C</div>
				<div class="ko-cell">C</div>
				<div class="ko-cell">C</div>
			</div>
			-->
		</div>
	</div>

	<div class="panel-3">
		<?php
		echo showGroupMatches('D');
		echo showGroupMatches('E');
		echo showGroupMatches('F');
		?>
	</div>
</div>
<?php } ?>

<?php
//$rss = simplexml_load_file('https://www.scorespro.com/rss/live-soccer.xml');
//echo '<pre>'; print_r($rss); echo '</pre>';
//echo '<h1>'. $rss->channel->title . '</h1>';
//foreach ($rss->channel->item as $item) {}
?>

<?php if (!isset($_GET['pred-table'])) { ?><h2>Groups</h2><?php } ?>
<div class="container">
	<?php if (!isset($_GET['pred-table'])) { ?>
	<div class="container groups-container">
		<?php
		foreach (array_unique($teams) as $group) {
			$tbl = sortTable($group);
			echo showTable($tbl, $group);
		}
		?>
	</div>
	<?php } ?>

	<?php if (isset($_GET['preds'])) { ?>
		<div class="container override-group-preds">
			<?php echo showPlayerPredictions($_GET['preds']); ?>
		</div>
	<?php } ?>

	<?php if ((isset($_GET['pred-table']) && (int) $_GET['pred-table'] == 1) || !isset($_GET['preds'])) { ?>
	<div class="container predictions-container">
		<?php
		$tbl = sortPredictions();
		echo showPredictions($tbl);
		?>
	</div>
	<?php } ?>
</div>

<?php if (!isset($_GET['pred-table'])) { ?>
<h2 class="js-togPred">Predictions <span>&#9660;</span></h2>
<div class="container wrap sb js-preds">
	<?php echo showPredictionMatches(); ?>
</div>
<?php } ?>

<script>
<?php if (!isset($_GET['pred-table'])) { ?>
const togPred = document.querySelector('.js-togPred');
const preds = document.querySelector('.js-preds');
const predsArrow = document.querySelector('.js-togPred span');
<?php } ?>

const togHelp = document.querySelector('.help-toggle');
const helpBox = document.querySelector('.help-box');

window.addEventListener('DOMContentLoaded', () => {
	<?php if (!isset($_GET['pred-table'])) { ?>
	const predsHeight = preds.getBoundingClientRect().height;
	preds.style.height = '0px';
	togPred.addEventListener('click', () => {
		preds.style.height = preds.style.height == '0px' ? predsHeight+'px' : '0px';
		predsArrow.classList.toggle('rotate');
	});
	<?php } ?>

	togHelp.addEventListener('click', () => {
		helpBox.classList.toggle('show');
	});
});
</script>
</body>
</html>
