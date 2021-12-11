<?php
    echo 'Le vélo ' . $_GET['modele'] . ' a été entièrement supprimé des stocks !';
    require_once(File::build_path(array("view", "produit", "list.php")));
?>