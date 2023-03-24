<?php

session_start();
if ($_SESSION['admin'] == true) {
    require_once realpath(__DIR__ . '/vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $host = $_ENV['DB_HOST'];
    $user = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];
    $database = $_ENV['DB_NAME'];

    // Connect to MySQL using PDO
    $dsn = "mysql:host=$host;dbname=$database";
    $pdo = new PDO($dsn, $user, $password);
    $stmt = $pdo->prepare("SELECT * FROM employee WHERE id != :id AND (email=:email or phone=:phone)");
    $stmt->bindParam(":id", $_GET['id']);
    $stmt->bindParam(":email", $_POST['email']);
    $stmt->bindParam(":phone", $_POST['phone']);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $id = $_GET['id'];
        echo '<script language="javascript"> alert("Email already exists");</script>';
        header("refresh:0 ,url= update.php?id=$id");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $production = $_POST['department'];

        $stmt = $pdo->prepare("UPDATE employee SET fname = ?, lname = ?, email = ?, phone = ?, department = ? WHERE id = ?");
        $stmt->execute([$fname, $lname, $email, $phone, $production, $id]);

        header("Location: view.php");
        exit();
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM employee WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch();

    // Output the form with the current employee data
    echo "<link rel='stylesheet' href='style.css'>";
    echo "<form method='POST'>";
    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
    echo "<label>First Name:</label><br>";
    echo "<input type='text' name='fname' value='" . $row['fname'] . "'required><br>";
    echo "<label>Last Name:</label><br>";
    echo "<input type='text' name='lname' value='" . $row['lname'] . "'required><br>";
    echo "<label>Email:</label><br>";
    echo "<input type='email' name='email' value='" . $row['email'] . "'required><br>";
    echo "<label>Phone:</label><br>";
    echo "<input type='tel' name='phone' value='" . $row['phone'] . "'required><br>";
    echo "<label>Department:</label><br>";
    echo "<input type='text' name='department' value='" . $row['department'] . "'><br><br><br>";
    echo "<input type='submit' value='Save'>";
    echo "</form>";

    $pdo = null;
} else {
    header("Location: index.php");
}
