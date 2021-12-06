<h1>Historique de vos commandes</h1>
<table>
    <tr>
        <th>Marque</th>
        <th>Modèle</th>
        <th>Prix unitaire</th>
        <th>Couleur</th>
        <th>Taille</th>
        <th>Quantité</th>
        <th>Date de la commande</th>
    </tr>
    <tr>
<?php
echo '<br><br><br><br><br><br><br><br><br>';
var_dump($tab_commande);
for ($i = 0; $i < count($tab_commande); ++$i){
	echo '<td>'.$key["marque"].'</td>';
}
?>
	</tr>
</table>