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
    echo "<tr>
    <th>FName</th>
    <th>LName</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Department</th>
    <th>Action</th>
    </tr>";
    while ($row = $sql->fetch()) {
        echo "<tr>
        <td>" . $row['fname'] . "</td>
        <td>" . $row['lname'] . "</td>
        <td>" . $row['email'] . "</td>
        <td>" . $row['phone'] . "</td>
        <td>" . $row['department'] . "</td>
        <td><a href='update.php?id=" . $row['id'] . "'>Edit</a>
        <a href='delete.php?id=" . $row['id'] . "'>Delete</a> </td>
        </tr>";
    }
    echo "</table>";

    $sql->closeCursor();
    $conn = null;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" 
    crossorigin="anonymous">
    <title>View</title>
</head>
<body>
<a href="logout.php"><button type="button" class="btn btn-dark" id="logout" name="logout">logout</button></a>
</body>
</html>