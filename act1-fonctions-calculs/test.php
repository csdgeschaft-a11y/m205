<?php

declare(strict_types=1);

require_once __DIR__ . '/fonctions.php';

// Étape 1
echo "12 + 8 = " . additionner(12, 8) . PHP_EOL;
echo "12 - 8 = " . soustraire(12, 8) . PHP_EOL;
echo "12 * 8 = " . multiplier(12, 8) . PHP_EOL;
echo "12 / 8 = " . diviser(12, 8) . PHP_EOL;

try {
    echo diviser(10, 0);
} catch (InvalidArgumentException $e) {
    echo "Erreur : " . $e->getMessage() . PHP_EOL;
}

// Étape 2
echo "7 est pair ? " . (estPair(7) ? "oui" : "non") . PHP_EOL;
echo "-3 est positif ? " . (estPositif(-3) ? "oui" : "non") . PHP_EOL;
echo "Maximum de 4, 9, 6 : " . maximum(4, 9, 6) . PHP_EOL;
echo "Maximum (avec max) : " . maximumAvecMax(4, 9, 6) . PHP_EOL;
echo "13 est premier ? " . (estPremier(13) ? "oui" : "non") . PHP_EOL;
echo "15 est premier ? " . (estPremier(15) ? "oui" : "non") . PHP_EOL;

// Étape 3
echo "100 HT avec TVA 20% = " . calculerTTC(100) . PHP_EOL;
echo "100 avec remise 15% = " . calculerRemise(100, 15) . PHP_EOL;
$facture = calculerFacture(100, 10, 10, 20);
echo "Facture : " . number_format($facture, 2, ",", " ") . " MAD" . PHP_EOL;

// Étape 4
echo "Moyenne (12, 15, 9) = " . round(moyenne(12, 15, 9), 2) . PHP_EOL;
echo "Moyenne sans note = " . moyenne() . PHP_EOL;
echo "Aire du cercle (r=5) = " . aireCercle(5) . PHP_EOL;
echo "Périmètre du cercle (r=5) = " . perimetreCercle(5) . PHP_EOL;
echo "25°C = " . celsiusVersFahrenheit(25) . "°F" . PHP_EOL;
echo "77°F = " . fahrenheitVersCelsius(77) . "°C" . PHP_EOL;
echo "1000 MAD = " . convertirDevise(1000, 0.092) . " EUR" . PHP_EOL;

// Étape 5
echo "5! = " . factorielle(5) . PHP_EOL;
echo "Fibonacci(8) : " . implode(", ", fibonacci(8)) . PHP_EOL;
echo "PGCD(48, 18) = " . pgcd(48, 18) . PHP_EOL;
echo "2^10 (boucle) = " . puissance(2, 10) . PHP_EOL;
echo "2^10 (récursive) = " . puissanceRecursive(2, 10) . PHP_EOL;

try {
    factorielle(-1);
} catch (InvalidArgumentException $e) {
    echo "Erreur : " . $e->getMessage() . PHP_EOL;
}