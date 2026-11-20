<?php
// Libraire du catalogue de produits
include("lib/catalogue.lib.php");
// Définir la variable $page pour indiquer la page affichée.
$page = 'teeshirts';

// Inclure la partie de haut de la page.
include('parties-communes/entete.php');

/** @var stdClass $_ : raccourci pour la section texte de cette page. 
 *  @var string $langue : code de la langue active
 */
// Gérer l'interactivité de filtre et de tri
// Capturer la saisie de l'utilisateur (defaut = aleatoire)
$tri = $_GET['tri'] ?? 'aleatoire';
$filtre = $_GET['filtre'] ?? 'tous';

$themes = obtenirThemes();
$produits = obtenirProduits($page, $tri, $filtre);

// Formatteur des montants d'argent 
$formatteurMontants = new NumberFormatter($langue, NumberFormatter::CURRENCY);

?>
<main class="page-produits page-teeshirts">
	<article class="amorce">
		<h1><?= $_->titrePage ?></h1>
		<form class="controle">
			<div class="filtre">
				<label for="filtre">Filtrer par thème : </label>
				<select name="filtre" id="filtre">
					<option value="tous">Tous les produits</option>
					<!--Gabarit option thème-->
					<?php foreach ($themes as $theme) : ?>
						<option value="<?= $theme->id; ?>"><?= $theme->nom; ?></option>
					<?php endforeach; ?>

				</select>
			</div>
			<div class="tri">
				<label for="tri">Trier par : </label>
				<select name="tri" id="tri">
					<option <?= ($tri == 'aleatoire') ? ' selected ' : ''; ?> value="aleatoire">Aléatoire</option>
					<option <?= ($tri == 'ventesDesc') ? ' selected ' : ''; ?> value="ventesDesc">Meilleur vendeur</option>
					<option <?= ($tri == 'prixAsc') ? ' selected ' : ''; ?> value="prixAsc">Prix / ascendant</option>
					<option <?= ($tri == 'prixDesc') ? ' selected ' : ''; ?> value="prixDesc">Prix / descendant</option>
					<option <?= ($tri == 'nomAsc') ? ' selected ' : ''; ?> value="nomAsc">Alpha / ascendant</option>
					<option <?= ($tri == 'nomDesc') ? ' selected ' : ''; ?> value="nomDesc">Alpha / descendant</option>
					<option <?= ($tri == 'dateAjout') ? ' selected ' : ''; ?> value="dateAjout">Nouveauté</option>
				</select>
			</div>
		</form>
	</article>
	<article class="principal">
		<!-- Gabarit -->
		<?php foreach ($produits as $prd) : ?>
			<div class="produit">
				<span class="image">
					<img src="images/produits/teeshirts/<?= $prd->id; ?>.webp" alt="<?= $prd->nom->$langue; ?>">
				</span>
				<span class="nom"><?= $prd->nom->$langue; ?></span>
				<span class="prix"><?= $formatteurMontants->formatCurrency($prd->prix, 'CAD'); ?></span>
			</div>
		<?php endforeach; ?>
	</article>
</main>
<?php include('parties-communes/pied2page.php'); ?>