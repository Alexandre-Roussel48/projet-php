<?php
//session start est dans la view.php
$action = $_GET['action'];

if($action !== null) {
    //récupération des variables
    $nom = $_GET['nomProduit'];
    $qte = $_GET['qteProduit'];
    $prix = $_GET['prixProduit'];

    //$q peut être un entier simple ou un tableau d'entiers (pls exemplaires dun article)
    if (is_array($qte)){
        $QteArticle = array();
        $i=0;
        foreach ($qte as $contenu){
            $QteArticle[$i++] = $contenu;
        }
    }
}

switch($action){
    Case "ajout":
        ajouterArticle($nom, $qte, $prix);
        break;
    Case "suppression":
        supprimerArticle($nom);
        break;
    Case "refresh" :
        for ($i = 0 ; $i < count($QteArticle) ; $i++) {
            modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i], $QteArticle[$i]);
        }
        break;
}
?>
<!DOCTYPE html>

<body>
<form method="get" action="panier.php"> <!--ajt une action, je crois que vu que je met toutes les fonctions ici ya besoin de mettre que ça-->
    <table style="width: 400px">
        <tr>
            <td colspan="4">Panier</td>
        </tr>
        <tr>
            <td>Nom</td>
            <td>Quantité</td>
            <td>Prix Unitaire</td>
            <td>Action</td>
        </tr>


        <?php
        if (creationPanier()) {
            $nbArticles = count($_SESSION['panier']['nomProduit']);
            if ($nbArticles <= 0)
                echo "Votre panier est vide.";
            else {
                for ($i=0 ;$i < $nbArticles ; $i++) {
                    echo "<tr><td>".htmlspecialchars($_SESSION['panier']['nomProduit'][$i])."</td>";
                    echo "<td><input type=\"text\" name=\"qte[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"></td>";
                    echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
                    echo "<td><a href=\"".htmlspecialchars("test2.php?action=suppression&nom=".rawurlencode($_SESSION['panier']['nomProduit'][$i]))."\"> Supprimer</a></td></tr>";
                }
                echo "<tr><td colspan=\"2\"></td>
                          <td colspan=\"2\">
                          Total : ".MontantGlobal()."</td></tr>";
                echo "<tr><td colspan=\"4\">
                            <input type=\"submit\" value=\"Rafraichir\">
                            <input type=\"hidden\" name=\"action\" value=\"refresh\"/>
                            </td></tr>";
            }
        }
        ?>
    </table>
</form>
</body>
</html>