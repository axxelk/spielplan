<!DOCTYPE html>
<html>
<head>
<title>Spielplan</title>
<meta http-equiv='Content-Type' content='text/html;charset=utf-8'/>
<style type="text/css">
<!--
h1, .pagebreak { page-break-before: always; } // page-break-after works, as well
-->
</style>
</head>
<body>


<!--
<form method='post' action='index.php'>
<p>Gerade Anzahl der Teams:</p>
    <select name='anzahl_teams'>
    <option value='6'>6</option>
    <option value='8'>8</option>
    <option selected value='10'>10</option>
    <option value='12'>12</option>
    <option value='14'>14</option>
    <option value='16'>16</option>
    <option value='18'>18</option>
    <option value='20'>20</option>
    </select>
<input type='submit' name='submit' value='submit' />
</form>
--!>

<?php
// --- Test x3m_Spielplan() -------------------------------------------------
//   if ($_POST['anzahl_teams'] =='') 
//      { $teams_cnt = 10;}
//.   else
//      $teams_cnt = $_POST['anzahl_teams'];
date_default_timezone_set('Europe/Berlin');

if (isset($_POST['stage']) && ('process' == $_POST['stage'])) {
	process_form();
} else {
	print_form();
}


function print_form() {

	$defaultteam = array(
		1 => 'FC Barcelona',
		'Bayern Muenchen',
		'Inter Mailand',
		'Borussia Dortmund',
		'Manchester Utd.',
		'FC Chelsea',
		'Manchester City',
		'Paris St. Germain',
		'Tottenham',
		'Liverpool',
		'Real Madrid',
		'Atletico Madrid',
		'Arsenal London',
		'FC St. Pauli',
		'AC Milan',
		'Olympique Marseille',
		'AS Rom',
		'Juventus Urin',
		'Benfica Lissabon',
		'Aston Villa');

	echo <<<END
	<h2>Turnierplaner...</h2>
	<form action="$_SERVER[PHP_SELF]" method="post">
	<h3>Anzahl der Teams Eingeben:</h3>
	<select name='anzahl_teams'>
     <option value='4'>4</option>
     <option value='6'>6</option>
     <option value='8'>8</option>
     <option selected value='10'>10</option>
     <option value='12'>12</option>
     <option value='14'>14</option>
     <option value='16'>16</option>
     <option value='18'>18</option>
     <option value='20'>20</option>
    </select>
	<input type="hidden" name="stage" value="process">
END;

	echo "<br/>";
	echo "<h3>Namen der Teams:</h3>";
	foreach ($defaultteam as $number => $team) {
		// print "$number: $team<br/>";
		echo str_pad($number, 2, '0', STR_PAD_LEFT).": ";
		// echo sprintf('%02d', $number); 
		echo "<input type='text' name='team".$number."' size='30' maxlength='30' value='".$team."'><br/>";
	}
	echo "<h3>Alles Ok? Dann:</h3>";
	echo "<input type='submit' name='submit' value='submit'>";
}



function process_form() {
	$teams_cnt = $_POST['anzahl_teams'];
	$team[1] = $_POST['team1'];
	$team[2] = $_POST['team2'];
	$team[3] = $_POST['team3'];
	$team[4] = $_POST['team4'];
	$team[5] = $_POST['team5'];
	$team[6] = $_POST['team6'];
	$team[7] = $_POST['team7'];
	$team[8] = $_POST['team8'];
	$team[9] = $_POST['team9'];
	$team[10] = $_POST['team10'];
	$team[11] = $_POST['team11'];
	$team[12] = $_POST['team12'];
	$team[13] = $_POST['team13'];
	$team[14] = $_POST['team14'];
	$team[15] = $_POST['team15'];
	$team[16] = $_POST['team16'];
	$team[17] = $_POST['team17'];
	$team[18] = $_POST['team18'];
	$team[19] = $_POST['team19'];
	$team[20] = $_POST['team20'];


	   // $teams_cnt     = 12;
	   $spielplan     = x3m_Spielplan::build($teams_cnt, date("Ymd"), 0, true);
	   
	   $spieltage_cnt = count($spielplan);
	   // echo "input value: ". $_POST['anzahl_teams'] ."<br/>";
	   echo "<h2>Spielplan ".date("d.m.Y")."</h2>";
	   echo "Anzahl Teams: <b>"     . $teams_cnt     . "</b> ";
	   echo "Spieltage: <b>" . $spieltage_cnt . "</b><br>";
	   echo "<a href='http://leporidae.de/spielplan/'>Neustart</a><br/>";


	echo "<pre>\n";
	// echo "<table border=1><tr><td>\n";
	for ($x = 1; $x <= $spieltage_cnt; $x++) {
		echo "<h1>&nbsp;</h1>\n";
		echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td>\n";
		echo "<table border=\"1\" cellpadding=\"6\" cellspacing=\"0\"width=100%>\n";
		echo "<colgroup>\n";
		echo "<col width=100>";
		echo "<col width=100>";
		echo "<col width=50>";
		echo "</colgroup>\n";

		echo "<tr>\n";
		echo "<td colspan=3><h3>".$x.". Spieltag ".$spielplan[$x]['datum'].":".str_repeat(" ", 30)."</h3></td> ";
		echo "</tr>\n";



		$spiele_cnt = count($spielplan[$x]) - 1;
		$spieltag   = $spielplan[$x];
		for ($y = 0; $y < $spiele_cnt; $y++) {
			echo "<tr>\n";
			echo "<td>".$team[$spieltag[$y]['h']]."</td><td>".$team[$spieltag[$y]['a']]."</td>";
			echo "<td align=center>&nbsp;:&nbsp;</td>";
			echo "</tr>\n";
		}
		echo "</table>\n";
		echo "</td></tr><tr><td>"; // outer table
		echo "<table border=1 cellpadding=6 cellspacing=\"0\" width=100%>";
		echo "<tr>\n";
		echo "<td align=center><h3>Tabelle Spieltag ".$x."</h3></td>";
		echo "<td align=center><h3>Tore</h3></td>";
		echo "<td align=center><h3>Punkte</h4></td>";
		echo "</tr>\n";
		for ($i = 1; $i <= $teams_cnt; $i++) {
			echo "<tr>\n";
			echo "<td>".$team[$i]."</td><td align=center>&nbsp;:&nbsp;</td><td>&nbsp</td>";
			echo "</tr>\n";
		}
		echo "</table>\n";
		echo "</td></tr>\n";
		echo "</table>\n";
	}
	//echo "</td></tr>\n";
	//echo "</table>\n";
	echo "</pre>\n";
//	exit();
}   // end function process_form


	/**
	* Spielplan generieren
	*
	* Spielplan generieren nach dem "Kantenfärbungs Algorithums".
	* Quelle: http://www-i1.informatik.rwth-aachen.de/~algorithmus/algo36.php
	*
	* ---------------------------------------------------------------------
	* Support/Info/Download: https://github.com/deezaster/spielplan
	* ---------------------------------------------------------------------
	*
	* @package    x3m
	* @version    1.0 für PHP5
	* @author     Andy Theiler <andy@x3m.ch>
	* @copyright  Copyright (c) 1996 - 2007, Xtreme Software GmbH, Switzerland (www.x3m.ch)
	* @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
	*/
	abstract class x3m_Spielplan {

	  public static function build ($teams = 4, $start_date = 20070101, $interval = 7, $mit_rueckrunde = true) {
	  
		 // nur gerade Anzahl Teams erlaubt
		 if (($teams % 2) != 0) { return false; }


		 // --- Spielpaarungen bestimmen ---------------------------------------
		 $n      = $teams - 1;
		 $spiele = array();

		 for ($i = 1; $i <= $teams - 1; $i++) {
			$h = $teams;
			$a = $i;
			// heimspiel? auswärtsspiel?
			if (($i % 2) != 0) {
			   $temp = $a;
			   $a    = $h;
			   $h    = $temp;
			}

			$spiele[] = array('h'        => $h, 
							  'a'        => $a, 
								  'spieltag' => $i);
	   
				for ($k = 1; $k <= (($teams / 2) - 1); $k++) {
	   
				   if (($i-$k) < 0) {
					  $a = $n + ($i-$k);
				   }
				   else {
					  $a = ($i-$k) % $n;
					  $a = ($a == 0) ? $n : $a; // 0 -> n-1
				   }
	   
				   $h = ($i+$k) % $n;
				   $h = ($h == 0) ? $n : $h;    // 0 -> n-1
	   
				   // heimspiel? auswärtsspiel?
				   if (($k % 2) == 0) {
					  $temp = $a;
					  $a = $h;
					  $h = $temp;
				   }
	   
				   $spiele[] = array('h' => $h, 'a' => $a, 'spieltag' => $i);
				}
			 }
	   
	   
			 // --- mit Rückrunde? -------------------------------------------------------
			 if ($mit_rueckrunde) {
	   
				$spiele_cnt = count($spiele);
				for ($x = 0; $x < $spiele_cnt; $x++) {
	   
				   $spiele[] = array('h'        => $spiele[$x]['a'],
									 'a'        => $spiele[$x]['h'],
									 'spieltag' => $spiele[$x]['spieltag'] + $n);
				}
			 }
	   
		  
			 // --- Spielplan erstellen --------------------------------------------------
			 $spielplan  = array();
			 $spiele_cnt = count($spiele);
	   
			 for ($x = 0; $x < $spiele_cnt; $x++) {
	   
				$spielplan[$spiele[$x]['spieltag']][] = array('h' => $spiele[$x]['h'],
															  'a' => $spiele[$x]['a']);
			 }
	   
			 $start_date = strtotime($start_date);
			 $game_date  = date("Ymd", mktime(0, 0, 0, date("m", $start_date) ,
													   date("d", $start_date)+$interval,
													   date("Y", $start_date)));
	   
			 for ($x = 1; $x <= count($spielplan); $x++) {
				$spielplan[$x]['datum'] = $game_date;
				$game_date              = strtotime($game_date);
				$game_date              = date("Ymd", mktime(0, 0, 0, date("m", $game_date) ,
																	  date("d", $game_date)+$interval,
																	  date("Y", $game_date)));
			 }
	   
			 return $spielplan;
		  }
	   }

	?>

	</body>
	</html>
