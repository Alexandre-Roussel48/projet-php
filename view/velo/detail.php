<?php
   $vModele = $m->get("modele");
    $vMarque = $m->get("marque");
    $vPrix = $m->get("prix");
    echo "Velo :\n".htmlspecialchars($vModele).", ".htmlspecialchars($vMarque).", ".htmlspecialchars($vPrix);

    echo '<p><a href="index.php?action=delete&immat='.rawurlencode($vModele).'">supprimer</a> cette voiture</p>';
?>