<?php 
require "Aircraft.php";
require "Airport.php";

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
var_dump($manaLidosta);