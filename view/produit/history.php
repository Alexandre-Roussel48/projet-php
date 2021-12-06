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
<?php
foreach ($jointures as $key => $value){
    echo '<tr>';
	echo '<td>'.$value->get("marque").'</td>';
    echo '<td>'.$value->get("modele").'</td>';
    echo '<td>'.$value->get("prix").'</td>';
    echo '<td>'.$value->get("couleur").'</td>';
    echo '<td>'.$value->get("taille").'</td>';
    echo '<td>'.$value->get("quantite").'</td>';
    echo '<td>'.$value->get("date").'</td>';
    echo '</tr>';
}
?>
	</tr>
</table>