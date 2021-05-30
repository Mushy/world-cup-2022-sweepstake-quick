<?php

error_reporting(E_ALL);

$wcTeams = array(
    'Brazil'=>'A', 
    'Cameroon'=>'A',
    'Croatia'=>'A', 
    'Mexico'=>'A',
    'Australia'=>'B',
    'Chile'=>'B',
    'Netherlands'=>'B',
    'Spain'=>'B',
    'Colombia'=>'C',
    'Greece'=>'C',
    'Ivory Coast'=>'C',
    'Japan'=>'C',
    'Costa Rica'=>'D',
    'England'=>'D',
    'Italy'=>'D',
    'Uraguay'=>'D',
    'Ecuador'=>'E',
    'France'=>'E',
    'Honduras'=>'E',
    'Switzerland'=>'E',
    'Argentina'=>'F',
    'Bosnia'=>'F',
    'Iran'=>'F',
    'Nigeria'=>'F',
    'Germany'=>'G',
    'Ghana'=>'G',
    'Portugal'=>'G',
    'United States'=>'G',
    'Algeria'=>'H',
    'Belgium'=>'H',
    'Russia'=>'H',
    'South Korea'=>'H'
);

$wcKnockout = 'A1B2,C1D2,E1F2,G1H2,B1A2,D1C2,F1E2,H1G2';

$wcPlayers = array('John','Tom','Cath','Martin','Colin','Connor','Steve','Andy');

$wcTeamPlayer = array();
$allocateTeams = array(); // allocate teams evenly to players (do this once then hardcode to fix)
foreach ($wcTeams as $key=>$val) $allocateTeams[]=$key;
while (count($allocateTeams) >= count($wcPlayers)) {
    foreach ($wcPlayers as $key) {
        $val = rand(0,count($allocateTeams)-1);
        $wcTeamPlayer[$allocateTeams[$val]] = $key;
        array_splice($allocateTeams,$val,1);
    }
}
//print_r($wcPlayers);
//print_r($allocateTeams);
echo '<pre>'.print_r($wcTeamPlayer,true).'</pre>';
/*
foreach ($wcTeams as $key=>$val) {
    echo $key.'<img src="https://countries-ofthe-world.com/flags-normal/flag-of-'.str_replace(' ','-',$key).'.png" /><br />';
}
*/
$wcMatches = array(
    array('Brazil',3,1,'Croatia'),
    array('Mexico',1,0,'Cameroon'),
    array('Brazil',0,0,'Mexico'),
    array('Cameroon',0,4,'Croatia'),
    array('Cameroon',1,4,'Brazil'),
    array('Croatia',1,3,'Mexico'),
    array('Spain',1,5,'Netherlands'),
    array('Chile',3,1,'Australia'),
    array('Australia',2,3,'Netherlands'),
    array('Spain',0,2,'Chile'),
    array('Australia',0,3,'Spain'),
    array('Netherlands',2,0,'Chile'),
    array('Colombia',3,0,'Greece'),
    array('Ivory Coast',2,1,'Japan'),
    array('Colombia',2,1,'Ivory Coast'),
    array('Japan',0,0,'Greece'),
    array('Japan',1,4,'Colombia'),
    array('Greece',2,1,'Ivory Coast'),
    array('Uraguay',1,3,'Costa Rica'),
    array('England',1,2,'Italy'),
    array('Uraguay',2,1,'England'),
    array('Italy',0,1,'Costa Rica'),
    array('Italy',0,1,'Uraguay'),
    array('Costa Rica',0,0,'England'),
    array('Switzerland',2,1,'Ecuador'),
    array('France',3,0,'Honduras'),
    array('Switzerland',2,5,'France'),
    array('Honduras',1,2,'Ecuador'),
    array('Honduras',0,3,'Switzerland'),
    array('Ecuador',0,0,'France'),
    array('Argentina',2,1,'Bosnia'),
    array('Iran',0,0,'Nigeria'),
    array('Argentina',1,0,'Iran'),
    array('Nigeria',1,0,'Bosnia'),
    array('Nigeria',2,3,'Argentina'),
    array('Bosnia',3,1,'Iran'),
    array('Germany',4,0,'Portugal'),
    array('Ghana',1,2,'United States'),
    array('Germany',2,2,'Ghana'),
    array('United States',2,2,'Portugal'),
    array('United States',0,1,'Germany'),
    array('Portugal',2,1,'Ghana'),
    array('Belgium',2,1,'Algeria'),
    array('Russia',1,1,'South Korea'),
    array('Belgium',1,0,'Russia'),
    array('South Korea',2,4,'Algeria'),
    array('South Korea',0,1,'Belgium'),
    array('Algeria',1,1,'Russia')
);

$wcMatchesKnockout = array(
    array('Brazil',3,2,'Chile'),
    array('Colombia',2,0,'Uraguay'),
    array('France',2,0,'Nigeria'),
    array('Germany',2,1,'Algeria'),
    array('Netherlands',2,1,'Mexico'),
    array('Costa Rica',5,3,'Greece'),
    array('Argentina',1,0,'Switzerland'),
    array('Belgium',2,1,'United States'),
    array('Brazil',2,1,'Colombia'),
    array('France',0,1,'Germany'),
    array('Netherlands',4,3,'Costa Rica'),
    array('Argentina',1,0,'Belgium'),
    array('Brazil',1,7,'Germany'),
    array('Netherlands',2,4,'Argentina'),
    array('Germany',1,0,'Argentina'),
    array('Brazil',0,3,'Netherlands')
);

$wcStandings = array();
//foreach ($wcTeams as $key=>$val) $wcStandings[$key] = array('pld'=>0, 'w'=>0, 'd'=>0, 'l'=>0, 'gf'=>0, 'ga'=>0, 'gd'=>0, 'pts'=>0);


foreach ($wcMatches as $row) {
    //echo '<pre>'.print_r($row,true).'</pre>';
    processMatch($row[0], $row[1], $row[2]);
    processMatch($row[3], $row[2], $row[1]);
}
//echo '<pre>'.print_r($wcStandings,true).'</pre>';
foreach (array_unique($wcTeams) as $group) {
    $tbl = sortTable($group);
    echo showTable($tbl,$group);
}
echo showKnockout();

function processMatch($team, $gf, $ga) {

    //echo $team.' f:'.$gf.' a:'.$ga.'<br />';
    global $wcStandings;
    if ($gf > $ga) {
        $pts = 3; $win = 1; $draw = 0; $loss = 0;
    } elseif ($gf == $ga) {
        $pts = 1; $win = 0; $draw = 1; $loss = 0;
    } else {
        $pts = 0; $win = 0; $draw = 0; $loss = 1;
    }
    if ( empty($wcStandings[$team]) )
        $standing = array('pld'=>0, 'w'=>0, 'd'=>0, 'l'=>0, 'gf'=>0, 'ga'=>0, 'gd'=>0, 'pts'=>0);
    else 
        $standing = $wcStandings[$team];

    $standing['pld']++;
    $standing['w'] += $win;
    $standing['d'] += $draw;
    $standing['l'] += $loss;
    $standing['gf'] += $gf;
    $standing['ga'] += $ga;
    $standing['gd'] += $gf - $ga;
    $standing['pts'] += $pts;
    $wcStandings[$team] = $standing;
}

function sortTable($group = '') {
    global $wcStandings, $wcTeams;
    $tbl = array();
    foreach ($wcStandings as $key => $row) {
        if ($group == '' || $group == $wcTeams[$key]) {
            $pts[$key]  = $row['pts'];
            $gd[$key] = $row['gd'];
            $gf[$key] = $row['gf'];
            $tbl[$key] = $row;
        }
    }
    array_multisort($pts, SORT_DESC, $gd, SORT_DESC, $gf, SORT_DESC, $tbl);
    return $tbl;
}

function showTable($tbl,$group = '') {
    global $wcTeams,$wcTeamPlayer;
    $head = true;
    $posit = 1;
    $result = '<table>';
    foreach($tbl as $tm=>$tb) {
        if ($head) {
            $result .= '<tr><td>'.$group.'</td>';
            foreach ($tb as $key=>$val) {
                $result .= '<td>'.$key.'</td>';
            }
            $result .= '</tr>';
            $head = false;        
        }
        $result .= '<tr><td>'.$tm.' ('.$wcTeamPlayer[$tm].')'.'</td><td>'.implode('</td><td>',$tb).'</td></tr>';
        $wcTeams[$tm] .= $posit;
        $posit++;
    }
    $result .= '</table>';
    return $result;
}
function showKnockout() {
    global $wcKnockout, $wcTeams, $wcMatchesKnockout, $wcTeamPlayer;
    $wcQF = array();
    $posQF = 0;
    $bolQF = 0;
    $wcGames = explode(',',$wcKnockout);
    echo '<h2>Knockout</h2>';
    foreach($wcGames as $wcGame) {
        $home = array_search(substr($wcGame,0,2),$wcTeams);
        $away = array_search(substr($wcGame,2,2),$wcTeams);
        //$posit = array_keys($wcMatchesKnockout, array(0 => $home, 3 => $away));
        foreach ($wcMatchesKnockout as $key=>$val) {
            if ($val[0] == $home && $val[3] == $away) {
                $posit = $key;
                break;
            }
        }
        echo $home.' ('.$wcTeamPlayer[$home].') '.$wcMatchesKnockout[$posit][1].':'.$wcMatchesKnockout[$posit][2].' '.$away.' ('.$wcTeamPlayer[$away].')<br />';
        $wcQF[$posQF][$bolQF] = ($wcMatchesKnockout[$posit][1] > $wcMatchesKnockout[$posit][2] ? $home : $away);
        if ($bolQF == 0) {
            $bolQF++; 
        } else { 
            $bolQF = 0; 
            $posQF++; 
        }
    }
    $wcSF = array();
    $posSF = 0;
    $bolSF = 0;
    echo '<h2>QF</h2>';
    foreach ($wcQF as $key=>$QF) {
        foreach ($wcMatchesKnockout as $key=>$val) {
            if ($val[0] == $QF[0] && $val[3] == $QF[1]) {
                $posit = $key;
                break;
            }
        }
        echo $QF[0].' ('.$wcTeamPlayer[$QF[0]].') '.$wcMatchesKnockout[$posit][1].':'.$wcMatchesKnockout[$posit][2].' '.$QF[1].' ('.$wcTeamPlayer[$QF[1]].') '.'<br />';
        $wcSF[$posSF][$bolSF] = ($wcMatchesKnockout[$posit][1] > $wcMatchesKnockout[$posit][2] ? $QF[0] : $QF[1]);
        if ($bolSF == 0) {
            $bolSF++; 
        } else { 
            $bolSF = 0; 
            $posSF++; 
        }
    }
    $wcF = array();
    $posF = 0;
    $bolF = 0;
    $wc3 = array();
    $pos3 = 0;
    $bol3 = 0;
    echo '<h2>SF</h2>';
    foreach ($wcSF as $key=>$SF) {
        foreach ($wcMatchesKnockout as $key=>$val) {
            if ($val[0] == $SF[0] && $val[3] == $SF[1]) {
                $posit = $key;
                break;
            }
        }
        echo $SF[0].' ('.$wcTeamPlayer[$SF[0]].') '.$wcMatchesKnockout[$posit][1].':'.$wcMatchesKnockout[$posit][2].' '.$SF[1].' ('.$wcTeamPlayer[$SF[1]].') '.'<br />';
        $wcF[$posF][$bolF] = ($wcMatchesKnockout[$posit][1] > $wcMatchesKnockout[$posit][2] ? $SF[0] : $SF[1]);
        if ($bolF == 0) {
            $bolF++; 
        } else { 
            $bolF = 0; 
            $posF++; 
        }
        $wc3[$pos3][$bol3] = ($wcMatchesKnockout[$posit][1] > $wcMatchesKnockout[$posit][2] ? $SF[1] : $SF[0]);
        if ($bol3 == 0) {
            $bol3++; 
        } else { 
            $bol3 = 0; 
            $pos3++; 
        }
    }
    echo '<h2>3</h2>';
    foreach ($wc3 as $key=>$F3) {
        foreach ($wcMatchesKnockout as $key=>$val) {
            if ($val[0] == $F3[0] && $val[3] == $F3[1]) {
                $posit = $key;
                break;
            }
        }
        echo $F3[0].' ('.$wcTeamPlayer[$F3[0]].') '.$wcMatchesKnockout[$posit][1].':'.$wcMatchesKnockout[$posit][2].' '.$F3[1].' ('.$wcTeamPlayer[$F3[1]].') '.'<br />';
    }
    echo '<h2>F</h2>';
    foreach ($wcF as $key=>$F) {
        foreach ($wcMatchesKnockout as $key=>$val) {
            if ($val[0] == $F[0] && $val[3] == $F[1]) {
                $posit = $key;
                break;
            }
        }
        echo $F[0].' ('.$wcTeamPlayer[$F[0]].') '.$wcMatchesKnockout[$posit][1].':'.$wcMatchesKnockout[$posit][2].' '.$F[1].' ('.$wcTeamPlayer[$F[1]].') '.'<br />';
    }
}