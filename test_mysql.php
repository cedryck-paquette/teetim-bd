<?php
    // Étape 1 : Obtenir une connection à MySQL
    $cnx = new mysqli('db', 'teetim', 'teetim', 'teetim');

    // Étape 2 : Écrire une commande SQL
    $qProduits = "SELECT nom, prix FROM produit LIMIT 10";

    // Étape 3 : Exécuter la commande sur la connexion MySQL
    $resultatRequete = $cnx->query($qProduits);

    // Étape 4 :  Utiliser la réponse pour l'afficher dans une page Web (dans HTML plus bas)
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test intégration PHP/MySQL</title>
</head>
<body>
    <!-- Étape 4 :  Utiliser la réponse pour l'afficher dans une page Web -->
    <h2>Les 10 premiers produits (nom et prix seulements)</h2>
    <ul>
        <?php while($unPrd = $resultatRequete->fetch_object()) : ?>
            <li><?= $unPrd->nom; ?> (<?= $unPrd->prix; ?>) </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>