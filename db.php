<?php
$database_url = getenv("${{ MySQL.MYSQL_URL }}"); //  DB URL from Railway

// Parse the URL to extract connection details
$db = parse_url($database_url);
$host = $db["host"];
$user = $db["user"];
$pass = $db["pass"];
$dbname = ltrim($db["path"], "/");
$port = $db["port"];

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
