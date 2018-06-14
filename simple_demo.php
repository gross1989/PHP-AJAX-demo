<?php

$myPDO = new PDO('pgsql:host=localhost;dbname=postgres_db', 'postgres_user', 'postgres_user');

// list all entries from the table
if (empty($_GET)) {

    $sql = "SELECT * FROM organisationen";
    $result = $myPDO->query($sql);

    echo "<table>
    <tr>
    <th>Organisation</th>
    <th>Branche</th>
    <th>Mitarbeiter</th>
    <th>Umsatz</th>
    </tr>";
    while($row = $result->fetch()) {
        echo "<tr>";
        echo "<td>" . $row['organisation'] . "</td>";
        echo "<td>" . $row['branche'] . "</td>";
        echo "<td>" . $row['mitarbeiter'] . "</td>";
        echo "<td>" . $row['umsatz'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
// add the new entry to the table
else {

    $sql = "INSERT INTO organisationen VALUES("
        . $myPDO->quote($_GET['organisation']) . ','
        . $myPDO->quote($_GET['branche']) . ','
        . $_GET['mitarbeiter'] . ','
        . $_GET['umsatz'] . ")";

    $result = $myPDO->query($sql);
}
