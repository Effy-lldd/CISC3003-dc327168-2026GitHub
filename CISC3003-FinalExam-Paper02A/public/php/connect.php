<?php
// Database Configuration
$host = 'localhost';
$dbname = 'cisc3003_scenario_a';
$username = 'root';
$password = '';
$port = 3307;

// Create Connection
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Check Connection
if ($conn->connect_error) {
    die("Database Connection Failed");
}

$conn->set_charset("utf8mb4");
?>