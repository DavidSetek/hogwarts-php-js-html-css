<?php

/**
 * Popis studenta
 * 
 * @param string $first_name - křestní jméno studenta
 * @param string $second_name - příjmení studenta
 * @param integer $age - věk studenta
 * 
 * @return string popis studenta
 */
function studentDescription($first_name, $second_name, $age){
    return "Toto je " . $first_name . " " . $second_name . ". Věk studenta je " . $age . " let. <br>";
}

// Použití
echo studentDescription("Harry", "Potter", 15);
echo studentDescription("Ron", "Weasley", 14);
$student = studentDescription("Hermiona", "Grangerová", 15);
echo $student;