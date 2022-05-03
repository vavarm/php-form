<?php

require_once __DIR__ . '/../vendor/autoload.php'; //require Composer modules

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$serverName = "localhost";
$dBUsername = $_ENV["DB_USERNAME"];
$dBPassword = $_ENV["DB_PASSWORD"];
$dBName = "profile_system";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName); //TODO - change the method and the error throwing by PDO

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
