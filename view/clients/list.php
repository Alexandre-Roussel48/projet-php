<table>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
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
    echo "<td><a href=\"?controller=clients&action=read&client={$codeClientUrl}\">Détail du client</a></td>";
    echo "</tr>";
}
?>
</table>



