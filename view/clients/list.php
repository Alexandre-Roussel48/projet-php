<table>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Administrateur</th>
        <th>Voir les détails</th>
    </tr>
    <?php
foreach ($tab_cli as $c) {

    $codeClient = $c->get('codeClient');
    $codeClientUrl = rawurlencode($codeClient);

    $nomClient = $c->get('nomClient');
    $prenomClient = $c->get('prenomClient');

    echo "<tr>";
    echo "<td> {$nomClient} </td>";
    echo "<td>{$prenomClient} </td>";
    $a = $c->isAdmin();
    if ($c->isAdmin()===true) echo "<td>Oui</td>";
    else echo "<td>Non</td>";
    echo "<td><a href=\"?controller=clients&action=read&client={$codeClientUrl}\">Détail du client</a></td>";
    echo "</tr>";
}
?>
</table>



