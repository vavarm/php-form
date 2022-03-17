<?php

$serverName = "localhost";
$dBUsername = "root"; //default username
$dBPassword = ""; //default password
$dBName = "PROFILE_SYSTEM";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
