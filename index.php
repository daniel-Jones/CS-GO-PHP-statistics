<DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="../css/style.css">
<title>CS:GO Stats</title>	
<body>
<div id="wrapper">

<main>
<div id="content">
<div class="innertube">
<h1> CS:GO stats </h1>
<?php
ini_set('error_reporting', E_ALL);

/* arrays containing key info */

/* username => steam id */
$players = array(
	"daniel_j" => "76561198055087665",
	"StaticPoints" => "76561198123558184",
	"ScruffyRules" => "76561198046533376",
	"CriMsoN" => "76561198074419223"
	);

$actions = array("Total kills", "Total deaths", "Total hours played", "Total bomb plants", "Total bomb defuses", "Total round wins", "Total knife kills", "Total grenade kills", "Total deagle kills", "Total p90 kills", "Total awp kills", "Total ak47 kills", "Total headshot kills");

$stats_index = array(0, 1, 2, 3, 4, 5, 9, 10, 12, 18, 19, 20, 25);
$player_data_raw = array();
$player_data = array();

/*
now we need to loop through each $players and download their stats
we then decode their stats and place it all neatly into $player_data
 */
foreach ($players as $name => $id)
{
	$tmp = file_get_contents('http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=730&key=FEBFDE46520663091143F867FEE39BFF&steamid=' . $id);
	$player_data_raw[$name] = $tmp;
	$player_data[] = json_decode($player_data_raw[$name], true);
}

//echo $player_data[0]['playerstats']['stats'][$stats_index[3]]['value'];

for ($c = 0; $c < count($players); $c++)
{
	/* convert hours plated from seconds to hours */
	$player_data[$c]['playerstats']['stats'][2]['value'] = $player_data[$c]['playerstats']['stats'][2]['value'] / 3600;
	echo "<b>" . array_keys($players)[$c] . "</b> <br />";
	for ($x = 0; $x < 13; $x++)
	{
		echo $actions[$x] . " " . $player_data[$c]['playerstats']['stats'][$stats_index[$x]]['value'] . "<br />";
	}
	echo "<br />";
}
?>
</main>

<?php include('../includes/navbar.php');?>

</div>
</body>
</html>

