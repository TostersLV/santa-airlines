<?php 
require "Aircraft.php";
require "Airport.php";
require "Flight.php";

echo "serveris";

function addFour($x){
    $rezultats = $x + 4;
    echo "<br>  $rezultats";
}
addFour(5);

$manaLidmasina = new Aircraft("Airbus", "A220-300", 120, 850);
var_dump($manaLidmasina);

echo "<br>";

$manaLidosta = new Airport("RIX", 56.924, 23.971);
$TurkeyAirport = new Airport("Ajet", 58.924, 29.971);

var_dump($manaLidosta);

echo "<br>";

$rigasAirport = $manaLidosta;
$turkeyAiport = $TurkeyAirport;
$departureTime = new DateTime();
$aircraft = $manaLidmasina;

$flight = new Flight("SA503", $rigasAirport, $turkeyAiport, $departureTime, $aircraft);

var_dump($flight);

echo "<br>";

echo $flight->getDistance();
echo "<br>";
echo "Flight Duration: " . $flight->getDuration() . " minutes<br>";

// Get Landing Time
$landingTime = $flight->getLandingTime();
echo "Landing Time: " . $landingTime->format('Y-m-d H:i:s') . "<br>";