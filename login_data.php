<?php

session_start();

require_once realpath(__DIR__ . "/vendor/autoload.php");
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$username = $_ENV['ADMIN_USERNAME'];
$password = $_ENV['ADMIN_PASSWORD'];
echo($password);
echo($username);
$user = $_POST['username'];
$upassword = $_POST['password'];
echo($user);
echo($upassword);
if ($user == $username && $upassword == $password) {
    $_SESSION ['admin'] = $username;
    header("Location:index.html");
} else {
    header("Location:login.php");
}
