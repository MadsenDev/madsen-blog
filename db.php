<?php
// Database connection details
$db_host = 'localhost';
$db_name = 'madsensd_blog';
$db_user = 'madsensd_madsen';
$db_password = 'data2023';

// Establish a connection using MySQLi
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check for a successful connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Set the character set for the connection
$mysqli->set_charset("utf8mb4");
?>