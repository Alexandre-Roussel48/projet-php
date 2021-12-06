<?php

	if ($panierVide) {
		echo "vide";
	} else {
		foreach ($_SESSION['panier'] as $code => $quantité) {
			$p = $tab[$code];
			$modele = $p->get('modele');
			$marque = $p->get('marque');
			$couleur = $p->get('couleur');
			$taille = $p->get('taille');
			$prix = $p->get('prix');
			echo "<p>Quantité : $quantité Produit : $modele, $marque, $couleur, $taille, $prix</p>";
		}
	}

?>