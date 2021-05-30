<?php
ini_set('display_errors', 1);
error_reporting(-1);

$players = ['Colin', 'Tom', 'Andy', 'John', 'Stephen', 'Samara', 'Mia', 'Carl', 'Connor', 'Cath', 'Martin', 'Gill'];

$teams = [
	'Italy' => 'A', // 0
	'Switzerland' => 'A', // 1
	'Turkey' => 'A', // 2
	'Wales' => 'A', // 3
	'Belgium' => 'B', // 4
	'Russia' => 'B', // 5
	'Denmark' => 'B', // 6
	'Finland' => 'B', // 7
	'Ukraine' => 'C', // 8
	'Netherlands' => 'C', // 9
	'Austria' => 'C', // 10
	'North Macedonia' => 'C', // 11
	'England' => 'D', // 12
	'Croatia' => 'D', // 13
	'Czech Republic' => 'D', // 14
	'Scotland' => 'D', // 15
	'Spain' => 'E', // 16
	'Poland' => 'E', // 17
	'Sweden' => 'E', // 18
	'Slovakia' => 'E', // 19
	'Germany' => 'F', // 20
	'France' => 'F', // 21
	'Portugal' => 'F', // 22
	'Hungary' => 'F', // 23
];

$knockout = '2A2B,1A2C,1C3D,1F3A,1D2F,1E3A';

$playerTeams = [
	[0] => ['Belgium', 'Switzerland'], // Colin
	[1] => ['Ukraine', 'Russia'], // Tom
	[2] => ['Hungary', 'Slovakia'], // Andy
	[3] => ['Wales', 'Germany'], // John
	[4] => ['Croatia', 'Czech Republic'], // Stephen
	[5] => ['Scotland', 'Turkey'], // Samara
	[6] => ['Netherlands', 'North Macedonia'], // Mia
	[7] => ['', ''], // Carl
	[8] => ['', ''], // Connor
	[9] => ['', ''], // Cath
	[10] => ['', ''], // Martin
	[11] => ['', ''], // Gill
];

$matchesGroups = [];

$matchesKO = [];