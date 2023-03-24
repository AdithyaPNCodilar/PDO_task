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

$exists = true;
try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if email already exists
    $email = $_POST["email"];
    $check_email_sql = $conn->prepare("SELECT * FROM employee WHERE email = ?");
    $check_email_sql->bindParam(1, $email);
    $check_email_sql->execute();

    if ($check_email_sql->rowCount() > 0) {
        echo "emailID already exists";
        $exists = false;
    }
    $phone = $_POST["phone"];
    $check_phone_sql = $conn->prepare("SELECT * FROM employee WHERE phone = ?");
    $check_phone_sql->bindParam(1, $phone);
    $check_phone_sql->execute();

    if ($check_phone_sql->rowCount() > 0) {
        echo "Phone number already exists";
        $exists = false;
    }
    if ($exists) {
        $sql = $conn->prepare("INSERT INTO employee (fname, lname, email, phone, department) VALUES (?, ?, ?, ?, ?)");

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $phone = $_POST["phone"];
        $department = $_POST["department"];

        $sql->bindParam(1, $fname);
        $sql->bindParam(2, $lname);
        $sql->bindParam(3, $email);
        $sql->bindParam(4, $phone);
        $sql->bindParam(5, $department);

        if ($sql->execute()) {
            header("Location: view.php");
        } else {
            echo "Error: " . $sql->errorInfo()[2];
        }

        $sql->closeCursor();
        $check_email_sql->closeCursor();
        $conn = null;
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
