<h1>Historique de vos commandes</h1>
<?php 
    if($jointures!==false){ 
        echo <<<EOD
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

EOD;
        
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
        echo "</tr>
            </table>";
    } else {
        echo <<<EOD
            <p>À notre connaissance, vous n'avez rien commandé</p>
EOD;
}
    
?>