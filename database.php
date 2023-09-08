<?php

$server = 'localhost';
$username = 'ADMBOGSDATEC30';
$password = 'ADMBOGSDATEC30';
$database = 'php_login_database';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

?>
