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

    $stmt = $myPDO->prepare("INSERT INTO organisationen VALUES (?, ?, ?, ?)");

    $stmt->bindParam(1, $_GET['organisation']);
    $stmt->bindParam(2, $_GET['branche']);
    $stmt->bindParam(3, $_GET['mitarbeiter']);
    $stmt->bindParam(4, $_GET['umsatz']);

    $stmt->execute();
}
