        <?php
        if (empty($_SESSION['panier'])) {
            echo "<p>Votre panier est vide.</p>";
        } else {
            echo "<table style=\"width: 400px\">
            <tr>
                <td colspan=\"6\">Panier</td>
            </tr>
            <tr>
                <td>Marque</td>
                <td>Modèle</td>
                <td>Couleur</td>
                <td>Taille</td>
                <td>Prix unitaire</td>
                <td>Quantité</td>
                <td>Action</td>
            </tr>
            ";
            $MontantGlobal = 0;
            foreach ($_SESSION['panier'] as $code => $quantité) {
                $p = $tab[$code];
                $modele = $p->get('modele'); $modeleHtml = htmlspecialchars($modele);
                $marque = $p->get('marque'); $marqueHtml = htmlspecialchars($marque);
                $couleur = $p->get('couleur'); $couleurHtml = htmlspecialchars($couleur);
                $taille = $p->get('taille'); $tailleHtml = htmlspecialchars($taille);
                $prix = $p->get('prix'); $prixHtml = htmlspecialchars($prix);

                $MontantGlobal += $prix * $quantité;

                echo "<tr><td>".$marqueHtml."</td>";
                echo "<td>".$modeleHtml."</td>";
                echo "<td>".$couleurHtml."</td>";
                echo "<td>".$tailleHtml."</td>";
                echo "<td>".$prixHtml."</td>";
                echo "<td>".$quantité."</td>";
                echo "<td>
                <p><a href=\"index.php?controller=modeles&action=ajouterArticle&codeProduit=".rawurlencode($code)."\"> Ajouter</a></p>
                <p><a href=\"index.php?controller=modeles&action=supprimerArticle&codeProduit=".rawurlencode($code)."\"> Supprimer</a></p>
                </td></tr>";

            }
            echo "<tr><td colspan=\"6\">
                            </td></tr>";
            echo "<tr><td colspan=\"4\"><a href='index.php?controller=modeles&action=validerCommande&montantGlobal=".rawurlencode($MontantGlobal)."'>Valider le panier</a></td>
                          <td colspan=\"2\">
                          Total : ".$MontantGlobal."</td></tr>";
            echo "</table>";
        }
        ?>
