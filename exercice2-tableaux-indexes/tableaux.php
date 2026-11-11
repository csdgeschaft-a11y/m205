<?php
declare(strict_types=1);

$notes = [12, 15, 8, 17, 9, 14, 11];
$prenoms = ['Sara', 'Youssef', 'Imane', 'Omar', 'Khadija'];

//  Étape 1 : Lecture et parcours 
echo "Premier : " . $notes[0] . PHP_EOL;
echo "Dernier : " . $notes[array_key_last($notes)] . PHP_EOL;
echo "Nombre de notes : " . count($notes) . PHP_EOL;

foreach ($notes as $i => $note) {
    echo "Note n°" . ($i + 1) . " : " . $note . PHP_EOL;
}


// Parcours des prénoms avec indice : 1. Sara, 2. Youssef...
foreach ($prenoms as $i => $prenom) {
    echo ($i + 1) . ". " . $prenom . PHP_EOL;
}


//  Étape 2 : Ajouter, retirer, insérer 
// On travaille sur une copie pour garder $notes intact
$copie = $notes;

// 1. Ajouter 16 à la fin (deux façons)
$copie[] = 16;
array_push($copie, 16);

// 2. Ajouter 10 au début
array_unshift($copie, 10);

// 3. Retirer la dernière puis la première note
$derniere = array_pop($copie);
$premiere = array_shift($copie);
echo "Retirée (dernière) : $derniere" . PHP_EOL;
echo "Retirée (première) : $premiere" . PHP_EOL;

// 4. Insérer 13 à l'indice 2 sans rien écraser
array_splice($copie, 2, 0, [13]);
print_r($copie);

// 5. unset crée un "trou" dans les indices
unset($copie[1]);
print_r($copie);          
$copie = array_values($copie);
print_r($copie);          


//  Étape 3 : Recherche 

// 1. Does the note 17 exist?
echo "17 existe ? " . (in_array(17, $notes) ? "oui" : "non") . PHP_EOL;

// 2. Index of the note 9 (compare with === false, because the index can be 0)
$indice = array_search(9, $notes);
if ($indice === false) {
    echo "La note 9 n'existe pas." . PHP_EOL;
} else {
    echo "La note 9 est à l'indice $indice." . PHP_EOL;
}

// 3. Is "Omar" in $prenoms?
echo "Omar est dans la liste ? " . (in_array('Omar', $prenoms) ? "oui" : "non") . PHP_EOL;


//  Étape 4 : Statistiques 
// Back to the original data (we use $notes, which was never modified)

// 1. Sum, average, min, max
$somme = array_sum($notes);
$moyenne = round($somme / count($notes), 2);
$min = min($notes);
$max = max($notes);
echo "Somme : $somme | Moyenne : $moyenne | Min : $min | Max : $max" . PHP_EOL;

// 2. Number of notes >= 10 (first with a loop)
$nbAdmis = 0;
foreach ($notes as $note) {
    if ($note >= 10) {
        $nbAdmis++;
    }
}
echo "Admis (boucle) : $nbAdmis" . PHP_EOL;

// ... then with array_filter + count
$admis = array_filter($notes, fn($n) => $n >= 10);
echo "Admis (array_filter) : " . count($admis) . PHP_EOL;

// 3. Success percentage
$pourcentage = round(count($admis) / count($notes) * 100, 2);
echo "Admis (>= 10) : " . count($admis) . " sur " . count($notes) . " ($pourcentage %)" . PHP_EOL;

// 4. Median: sort a copy, take the middle value
$triees = $notes;
sort($triees);
$n = count($triees);
$milieu = intdiv($n, 2);

if ($n % 2 === 0) {
    $mediane = ($triees[$milieu - 1] + $triees[$milieu]) / 2;
} else {
    $mediane = $triees[$milieu];
}
echo "Médiane : $mediane" . PHP_EOL;


// ===== Étape 5 : Tri et extraction =====

// 1. Ascending (sort) and descending (rsort), on copies so $notes stays intact
$croissant = $notes;
sort($croissant);
echo "Croissant : " . implode(", ", $croissant) . PHP_EOL;

$decroissant = $notes;
rsort($decroissant);
echo "Décroissant : " . implode(", ", $decroissant) . PHP_EOL;

// 2. Top 3 notes: rsort + array_slice
$top3 = array_slice($decroissant, 0, 3);
echo "3 meilleures notes : " . implode(", ", $top3) . PHP_EOL;

// 3. First names sorted alphabetically, then reversed
$prenomsTries = $prenoms;
sort($prenomsTries);
echo "Prénoms triés : " . implode(", ", $prenomsTries) . PHP_EOL;

$prenomsInverses = array_reverse($prenomsTries);
echo "Prénoms inversés : " . implode(", ", $prenomsInverses) . PHP_EOL;


// ===== Étape 6 : Transformer =====

// 1. Bonus: +1 point on each note, capped at 20
$bonus = array_map(fn($n) => min($n + 1, 20), $notes);
echo "Avec bonus : " . implode(", ", $bonus) . PHP_EOL;

// 2. Admitted notes (>= 10), reindexed
$admisNotes = array_values(array_filter($notes, fn($n) => $n >= 10));
echo "Admis : " . implode(", ", $admisNotes) . PHP_EOL;

// 3. Total with array_reduce (without array_sum)
$total = array_reduce($notes, fn($cumul, $n) => $cumul + $n, 0);
echo "Total (reduce) : $total" . PHP_EOL;

// 4. First names in uppercase
$majuscules = array_map('strtoupper', $prenoms);
echo "Majuscules : " . implode(", ", $majuscules) . PHP_EOL;

// 5. Mentions: "12 → Passable"
$mentions = array_map(function ($n) {
    if ($n < 10) {
        $mention = 'Ajourné';
    } elseif ($n < 14) {
        $mention = 'Passable';
    } elseif ($n < 16) {
        $mention = 'Assez bien';
    } else {
        $mention = 'Bien';
    }
    return "$n → $mention";
}, $notes);
echo implode(" | ", $mentions) . PHP_EOL;


// ===== Étape 7 : Chaînes, fusion et ensembles =====

// 1. First names separated by commas
echo "Prénoms : " . implode(", ", $prenoms) . PHP_EOL;

// 2. String -> array, then remove duplicates
$langages = explode(",", "php,js,sql,php,html,js");
$langagesUniques = array_values(array_unique($langages));
echo "Langages uniques : " . implode(", ", $langagesUniques) . PHP_EOL;

// 3. Merge two arrays, then remove duplicates
$fusion = array_values(array_unique(array_merge(["php", "sql"], ["js", "sql"])));
echo "Fusion dédoublonnée : " . implode(", ", $fusion) . PHP_EOL;

// 4. Common elements and elements only in $a
$a = ["php", "js", "sql"];
$b = ["js", "html", "sql"];
echo "Communs : " . implode(", ", array_intersect($a, $b)) . PHP_EOL;
echo "Seulement dans a : " . implode(", ", array_diff($a, $b)) . PHP_EOL;

// 5. Split range(1, 10) into chunks of 3
$paquets = array_chunk(range(1, 10), 3);
foreach ($paquets as $paquet) {
    echo "[" . implode(",", $paquet) . "] ";
}
echo PHP_EOL;


// ===== Étape 8 : Carnet de notes (fonctions) =====

const SEUIL_ADMISSION = 10;

function moyenne(array $notes): float
{
    if (count($notes) === 0) {
        return 0.0; // avoid division by zero
    }
    return round(array_sum($notes) / count($notes), 2);
}

function mediane(array $notes): float
{
    $n = count($notes);
    if ($n === 0) {
        return 0.0;
    }
    sort($notes); // $notes is a local copy here, the original is untouched
    $milieu = intdiv($n, 2);
    if ($n % 2 === 0) {
        return ($notes[$milieu - 1] + $notes[$milieu]) / 2;
    }
    return (float) $notes[$milieu];
}

function admis(array $notes, float $seuil = SEUIL_ADMISSION): array
{
    return array_values(array_filter($notes, fn($n) => $n >= $seuil));
}

function meilleures(array $notes, int $n = 3): array
{
    rsort($notes); // local copy
    return array_slice($notes, 0, $n);
}

function histogramme(array $notes): void
{
    foreach ($notes as $note) {
        echo str_pad((string) $note, 3, " ", STR_PAD_LEFT) . " | "
            . str_repeat("*", (int) $note) . PHP_EOL;
    }
}

// --- Tests with $notes ---
echo "Moyenne : " . moyenne($notes) . PHP_EOL;
echo "Médiane : " . mediane($notes) . PHP_EOL;
echo "Admis : " . implode(", ", admis($notes)) . PHP_EOL;
echo "Meilleures : " . implode(", ", meilleures($notes)) . PHP_EOL;
histogramme($notes);

// --- Tests with an empty array: no error must appear ---
$vide = [];
echo "Moyenne (vide) : " . moyenne($vide) . PHP_EOL;
echo "Médiane (vide) : " . mediane($vide) . PHP_EOL;
echo "Admis (vide) : " . implode(", ", admis($vide)) . PHP_EOL;
echo "Meilleures (vide) : " . implode(", ", meilleures($vide)) . PHP_EOL;
histogramme($vide);