<?php

declare(strict_types=1);

// ===== Étape 1 : les quatre opérations =====
function additionner(float $a, float $b): float
{
    return $a + $b;
}

function soustraire(float $a, float $b): float
{
    return $a - $b;
}

function multiplier(float $a, float $b): float
{
    return $a * $b;
}

function diviser(float $a, float $b): float
{
    if ($b === 0.0) {
        throw new InvalidArgumentException("Division par zéro impossible");
    }
    return $a / $b;
}

// ===== Étape 2 : fonctions logiques =====
function estPair(int $n): bool
{
    return $n % 2 === 0;
}

function estPositif(float $n): bool
{
    return $n > 0;
}

// Version sans max()
function maximum(float $a, float $b, float $c): float
{
    $max = $a;
    if ($b > $max) {
        $max = $b;
    }
    if ($c > $max) {
        $max = $c;
    }
    return $max;
}

// Version avec max()
function maximumAvecMax(float $a, float $b, float $c): float
{
    return max($a, $b, $c);
}

function estPremier(int $n): bool
{
    if ($n < 2) {
        return false;
    }
    // Il suffit de tester les diviseurs jusqu'à la racine carrée
    for ($i = 2; $i <= (int) floor(sqrt($n)); $i++) {
        if ($n % $i === 0) {
            return false;
        }
    }
    return true;
}

// ===== Étape 3 : calculs commerciaux =====
function calculerTTC(float $ht, float $tva = 20.0): float
{
    return $ht * (1 + $tva / 100);
}

function calculerRemise(float $prix, float $pourcentage): float
{
    return round($prix * (1 - $pourcentage / 100), 2);
}

function calculerFacture(
    float $prixUnitaire,
    int $quantite,
    float $remise = 0,
    float $tva = 20.0
): float {
    $total = $prixUnitaire * $quantite;
    $apresRemise = calculerRemise($total, $remise);
    return calculerTTC($apresRemise, $tva);
}

// ===== Étape 4 : statistiques et géométrie =====
function moyenne(float ...$notes): float
{
    if (count($notes) === 0) {
        return 0.0;
    }
    return array_sum($notes) / count($notes);
}

function aireCercle(float $rayon): float
{
    return round(M_PI * $rayon ** 2, 2);
}

function perimetreCercle(float $rayon): float
{
    return round(2 * M_PI * $rayon, 2);
}

function celsiusVersFahrenheit(float $c): float
{
    return $c * 9 / 5 + 32;
}

function fahrenheitVersCelsius(float $f): float
{
    return ($f - 32) * 5 / 9;
}

function convertirDevise(float $montant, float $taux): float
{
    return $montant * $taux;
}

// ===== Étape 5 : fonctions à boucle =====
function factorielle(int $n): int
{
    if ($n < 0) {
        throw new InvalidArgumentException("Factorielle d'un nombre négatif impossible");
    }
    $resultat = 1;
    for ($i = 2; $i <= $n; $i++) {
        $resultat *= $i;
    }
    return $resultat;
}

function fibonacci(int $n): array
{
    $suite = [];
    $a = 0;
    $b = 1;
    for ($i = 0; $i < $n; $i++) {
        $suite[] = $a;
        [$a, $b] = [$b, $a + $b];
    }
    return $suite;
}

function pgcd(int $a, int $b): int
{
    // Algorithme d'Euclide
    while ($b !== 0) {
        [$a, $b] = [$b, $a % $b];
    }
    return abs($a);
}

// Défi : puissance sans ** ni pow() (version boucle)
function puissance(float $x, int $n): float
{
    if ($n < 0) {
        return 1 / puissance($x, -$n);
    }
    $resultat = 1.0;
    for ($i = 0; $i < $n; $i++) {
        $resultat *= $x;
    }
    return $resultat;
}

// Défi : puissance version récursive
function puissanceRecursive(float $x, int $n): float
{
    if ($n < 0) {
        return 1 / puissanceRecursive($x, -$n);
    }
    if ($n === 0) {
        return 1.0;
    }
    return $x * puissanceRecursive($x, $n - 1);
}