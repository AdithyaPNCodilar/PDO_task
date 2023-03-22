<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
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
    $sql = $conn->prepare("INSERT INTO employee (fname, lname, email, phone, department) VALUES (?, ?, ?, ?, ?)");

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $department = $_POST["department"];

    $sql->bindParam(1, $fname);
    $sql->bindParam(2, $lname);
    $sql->bindParam(3, $email);
    $sql->bindParam(4, $phone);
    $sql->bindParam(5, $department);

    if ($sql->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql->errorInfo()[2];
    }
    $sql->closeCursor();
    $conn = null;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
