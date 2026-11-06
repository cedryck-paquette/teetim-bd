<?php
// tableau simple
$fruits = [
    "Pamplemousse",
    "grenade",
    "kiwi"
];
// parcourir le tableau avec foreach
foreach ($fruits as $unFruit) {
    echo "<p>$unFruit</p>";
}

// tableau associatif (étiquettes)
$listeGroupe = [
    "e1052145" => "Marc Antoine",
    "e2445367" => "Jean Jean Jean Jean",
    "e5603323" => "Alain Terieur"
];

foreach ($listeGroupe as $noDossier => $nomEtudiant) {
    echo "<p><b>$nomEtudiant</b> (<i>$noDossier</i>) </p>";
}
