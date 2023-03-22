<?php

require_once realpath(__DIR__ . "/vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_NAME'];

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $conn->query("SELECT * FROM employee");

    echo "<table>";
    echo "<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Department</th></tr>";
    while ($row = $sql->fetch()) {
        echo "<tr>
        <td>" . $row['fname'] . "</td>
        <td>" . $row['lname'] . "</td>
        <td>" . $row['email'] . "</td>
        <td>" . $row['phone'] . "</td>
        <td>" . $row['department'] . "</td>
        </tr>";
    }
    echo "</table>";

    $sql->closeCursor();
    $conn = null;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
