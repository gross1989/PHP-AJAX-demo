<?php

class SimpleDemo {

    private $myPDO;

    public function __construct() {
        $this->myPDO = new PDO('pgsql:host=localhost;dbname=postgres_db', 'postgres_user', 'postgres_user');
    }

    // list all entries from the table
    public function list() {
        $sql = "SELECT * FROM organisationen";
        $result = $this->myPDO->query($sql);

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
    public function addEntry() {
        $stmt = $this->myPDO->prepare("INSERT INTO organisationen VALUES (?, ?, ?, ?)");

        $stmt->bindParam(1, $_GET['organisation']);
        $stmt->bindParam(2, $_GET['branche']);
        $stmt->bindParam(3, $_GET['mitarbeiter']);
        $stmt->bindParam(4, $_GET['umsatz']);

        $stmt->execute();
    }

}


$demo = new SimpleDemo();

if (empty($_GET)) {
    $demo->list();
} else {
    $demo->addEntry();
}
