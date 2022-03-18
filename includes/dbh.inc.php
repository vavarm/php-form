<?php

require_once('/../vendor/autoload.php');
\Dotenv\Dotenv::createImmutable(paths: __DIR__ . '/../')->load();

$serverName = "localhost";
$dBUsername = getenv('DB_USERNAME');
$dBPassword = getenv('DB_PASSWORD');
var_dump($dBUsername, $dBPassword);
$dBName = "PROFILE_SYSTEM";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
