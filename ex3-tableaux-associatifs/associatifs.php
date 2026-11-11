<?php
declare(strict_types=1);

// ===== Étape 1 : La fiche d'un stagiaire =====
$stagiaire = [
    'nom'     => 'Alami',
    'prenom'  => 'Sara',
    'age'     => 21,
    'filiere' => 'Développement digital',
    'notes'   => ['php' => 16, 'js' => 14, 'sql' => 15],
];

// 1. Full sentence with the last name in uppercase
echo $stagiaire['prenom'] . " " . strtoupper($stagiaire['nom']) . ", "
    . $stagiaire['age'] . " ans, filière " . $stagiaire['filiere'] . PHP_EOL;

// 2. Add 'ville', then change 'age' to 22
$stagiaire['ville'] = 'Casablanca';
$stagiaire['age'] = 22;

// 3. Default value with ?? when the key does not exist
echo "Email : " . ($stagiaire['email'] ?? 'non renseigné') . PHP_EOL;

// 4. isset vs array_key_exists with a null value
$stagiaire['telephone'] = null;
echo "isset : " . (isset($stagiaire['telephone']) ? 'true' : 'false') . PHP_EOL;
echo "array_key_exists : " . (array_key_exists('telephone', $stagiaire) ? 'true' : 'false') . PHP_EOL;

// 5. Remove 'ville'
unset($stagiaire['ville']);

// 6. PHP note, then the average of the three notes
echo "Note PHP : " . $stagiaire['notes']['php'] . PHP_EOL;
$moyenne = array_sum($stagiaire['notes']) / count($stagiaire['notes']);
echo "Moyenne : " . round($moyenne, 2) . PHP_EOL;

// 7. Loop over the notes
foreach ($stagiaire['notes'] as $matiere => $note) {
    echo "$matiere : $note/20" . PHP_EOL;
}


// ===== Étape 2 : Le panier d'achat =====
$panier = [
    'Clavier' => 250,
    'Souris'  => 90,
    'Ecran'   => 1400,
    'Casque'  => 320,
];

// 1. Total and number of items
echo "Total du panier : " . array_sum($panier) . " MAD (" . count($panier) . " articles)" . PHP_EOL;

// 2. Most expensive and cheapest, with their names
$plusCher = array_search(max($panier), $panier);
$moinsCher = array_search(min($panier), $panier);
echo "Plus cher : $plusCher (" . max($panier) . ") | Moins cher : $moinsCher (" . min($panier) . ")" . PHP_EOL;

// 3. 10% discount: array_map keeps the string keys
$remise = array_map(fn($prix) => round($prix * 0.9, 2), $panier);
print_r($remise);

// 4. Only items above 200 MAD: array_filter keeps the keys
$chers = array_filter($panier, fn($prix) => $prix > 200);
print_r($chers);

// 5. Sorting (on copies, so $panier stays intact)
$parNom = $panier;
ksort($parNom);
echo "Par nom : " . implode(", ", array_keys($parNom)) . PHP_EOL;

$croissant = $panier;
asort($croissant);
echo "Prix croissant : " . implode(", ", array_keys($croissant)) . PHP_EOL;

$decroissant = $panier;
arsort($decroissant);
echo "Prix décroissant : " . implode(", ", array_keys($decroissant)) . PHP_EOL;

// 6. Add Webcam only if it does not exist, otherwise increase a quantity
$quantites = [];
if (!array_key_exists('Webcam', $panier)) {
    $panier['Webcam'] = 180;
    $quantites['Webcam'] = 1;
} else {
    $quantites['Webcam'] = ($quantites['Webcam'] ?? 1) + 1;
}

// 7. Aligned display
foreach ($panier as $produit => $prix) {
    printf("%-10s %8.2f MAD\n", $produit, $prix);
}


// ===== Étape 3 : Tableaux multidimensionnels =====
$stagiaires = [
    ['nom' => 'Alami',   'filiere' => 'Développement',  'notes' => [16, 14, 15]],
    ['nom' => 'Benani',  'filiere' => 'Infrastructure', 'notes' => [11, 13, 12]],
    ['nom' => 'Chraibi', 'filiere' => 'Développement',  'notes' => [18, 17, 19]],
    ['nom' => 'Daoudi',  'filiere' => 'Infrastructure', 'notes' => [9, 10, 8]],
];

// 1. Add an average to each trainee (foreach by reference)
foreach ($stagiaires as &$s) {
    $s['moyenne'] = array_sum($s['notes']) / count($s['notes']);
}
unset($s); // break the reference

// 2. List of names
echo "Noms : " . implode(", ", array_column($stagiaires, 'nom')) . PHP_EOL;

// 3. name => average
print_r(array_column($stagiaires, 'moyenne', 'nom'));

// 4. Ranking: sort by average, descending
usort($stagiaires, fn($a, $b) => $b['moyenne'] <=> $a['moyenne']);
echo "Classement :" . PHP_EOL;
foreach ($stagiaires as $i => $s) {
    printf("%d. %s (%.2f)\n", $i + 1, $s['nom'], $s['moyenne']);
}

// 5. Best trainee and class average
echo "Meilleur : " . $stagiaires[0]['nom'] . PHP_EOL;
$moyenneClasse = array_sum(array_column($stagiaires, 'moyenne')) / count($stagiaires);
printf("Moyenne générale : %.2f\n", $moyenneClasse);

// 6. Only admitted trainees (average >= 10)
$admis = array_filter($stagiaires, fn($s) => $s['moyenne'] >= 10);
echo "Admis : " . implode(", ", array_column($admis, 'nom')) . PHP_EOL;

// 7. Group by filière
$parFiliere = [];
foreach ($stagiaires as $s) {
    $parFiliere[$s['filiere']][] = $s;
}
foreach ($parFiliere as $filiere => $groupe) {
    $moy = array_sum(array_column($groupe, 'moyenne')) / count($groupe);
    printf("%s : effectif %d, moyenne %.2f\n", $filiere, count($groupe), $moy);
}

// 8. Mention for each trainee
function mention(float $moyenne): string
{
    if ($moyenne < 10) {
        return 'Ajourné';
    } elseif ($moyenne < 14) {
        return 'Passable';
    } elseif ($moyenne < 16) {
        return 'Assez bien';
    }
    return 'Bien';
}

foreach ($stagiaires as &$s) {
    $s['mention'] = mention($s['moyenne']);
}
unset($s);

foreach ($stagiaires as $s) {
    echo $s['nom'] . " : " . $s['mention'] . PHP_EOL;
}


// ===== Étape 4 : Gestion de stock =====
$stock = [
    'P001' => ['designation' => 'Clavier', 'prix' => 250.0,  'quantite' => 12],
    'P002' => ['designation' => 'Souris',  'prix' => 90.0,   'quantite' => 40],
    'P003' => ['designation' => 'Ecran',   'prix' => 1400.0, 'quantite' => 5],
];

function ajouterProduit(array &$stock, string $ref, string $designation, float $prix, int $qte): bool
{
    if (array_key_exists($ref, $stock)) {
        return false; // reference already exists
    }
    $stock[$ref] = ['designation' => $designation, 'prix' => $prix, 'quantite' => $qte];
    return true;
}

function retirerStock(array &$stock, string $ref, int $qte): bool
{
    if (!array_key_exists($ref, $stock) || $stock[$ref]['quantite'] < $qte) {
        return false; // unknown reference or not enough stock
    }
    $stock[$ref]['quantite'] -= $qte;
    return true;
}

function valeurTotale(array $stock): float
{
    $total = 0.0;
    foreach ($stock as $produit) {
        $total += $produit['prix'] * $produit['quantite'];
    }
    return $total;
}

function produitsEnRupture(array $stock, int $seuil = 10): array
{
    $refs = [];
    foreach ($stock as $ref => $produit) {
        if ($produit['quantite'] < $seuil) {
            $refs[] = $ref;
        }
    }
    return $refs;
}

function afficherStock(array $stock): void
{
    foreach ($stock as $ref => $p) {
        printf("%-6s %-10s %8.2f MAD x %3d\n", $ref, $p['designation'], $p['prix'], $p['quantite']);
    }
}

// --- Test script ---
echo "Ajout P004 : " . (ajouterProduit($stock, 'P004', 'Casque', 320.0, 8) ? 'ok' : 'refusé') . PHP_EOL;
echo "Ajout doublon P001 : " . (ajouterProduit($stock, 'P001', 'Clavier', 250.0, 1) ? 'ok' : 'refusé') . PHP_EOL;
echo "Retrait 3 claviers : " . (retirerStock($stock, 'P001', 3) ? 'ok' : 'refusé') . PHP_EOL;
echo "Retrait 100 écrans : " . (retirerStock($stock, 'P003', 100) ? 'ok' : 'refusé') . PHP_EOL;
echo "Retrait réf inconnue : " . (retirerStock($stock, 'P999', 1) ? 'ok' : 'refusé') . PHP_EOL;

afficherStock($stock);
printf("Valeur totale : %.2f MAD\n", valeurTotale($stock));
echo "En rupture : " . implode(", ", produitsEnRupture($stock)) . PHP_EOL;