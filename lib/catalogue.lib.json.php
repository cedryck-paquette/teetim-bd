<?php

/************************************************Librairie de code pour gérer le catalogue des produits **************************************************************/

/**
 * Retourne les thèmes et les produits de la catégorie demandée
 * @param string $categorie Catégorie de produits (ex.:T-shirts, casquettes, etc.)
 * @param string $codeLangue Code en 2 lettres de la langue d'affichage.
 * @param string $critereTri Valeur du critère de tri.
 * @return array Tableau contenant les deux tableaux des thèmes et des produits.
 */
function obtenirCatalogue($categorie, $codeLangue, $critereTri)
{
    $catalogue = json_decode(file_get_contents("data/$categorie.json"));
    $themes = [];
    $produits = [];

    foreach ($catalogue as $codeTheme => $detailTheme) {
        $themes[$codeTheme] = $detailTheme->theme->$codeLangue;
        $produits = array_merge($produits, $detailTheme->produits);
    }

    // Trier le tableau produit avant de le retourner
    if (function_exists($critereTri)) {
        usort($produits, $critereTri);
    } else {
        shuffle($produits);
    }


    return [$themes, $produits];
}

/**
 * Fonction de comparaison des nombres de ventes descendants.
 * @param stdClass $produit1 Objet correspondant au premier produit à comparer.
 * @param stdClass $produit2 Objet correspondant au deuxième produit à comparer.
 * @return int Nombre entier positif, négatif ou 0 selon la comparaison.
 */
function ventesDesc($produit1, $produit2)
{
    return 100 * $produit2->ventes - 100 * $produit1->ventes;
}

/**
 * Fonction de comparaison des prix ascendants des produits.
 * @param stdClass $produit1 Objet correspondant au premier produit à comparer.
 * @param stdClass $produit2 Objet correspondant au deuxième produit à comparer.
 * @return int Nombre entier positif, négatif ou 0 selon la comparaison.
 */
function prixAsc($produit1, $produit2)
{
    return 100 * $produit1->prix - 100 * $produit2->prix;
}

/**
 * Fonction de comparaison des prix descendants des produits.
 * @param stdClass $produit1 Objet correspondant au premier produit à comparer.
 * @param stdClass $produit2 Objet correspondant au deuxième produit à comparer.
 * @return int Nombre entier positif, négatif ou 0 selon la comparaison.
 */
function prixDesc($produit1, $produit2)
{
    return 100 * $produit2->prix - 100 * $produit1->prix;
}

function nomDesc() {}

/**
 * Fonction de comparaison des dates d'ajout au catalogue en ordre descendant.
 * @param stdClass $produit1 Objet correspondant au premier produit à comparer.
 * @param stdClass $produit2 Objet correspondant au deuxième produit à comparer.
 * @return int Nombre entier positif, négatif ou 0 selon la comparaison.
 */
function dateAjout($produit1, $produit2)
{
    if ($produit2->dac > $produit1->dac) {
        return 1;
    } else if ($produit2->dac < $produit1->dac) {
        return -1;
    } else {
        return 0;
    }
}
