<?php
session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'marketplace';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    die('Failed to connect to MySQL: ' . $mysqli->connect_error);
}
?>
