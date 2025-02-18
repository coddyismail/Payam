<?php
// Get MySQL URL from Railway environment variables
$database_url = getenv("MYSQL_URL");

if (!$database_url) {
    die("DATABASE_URL is not set in environment variables.");
}

// Parse MySQL URL
$db = parse_url($database_url);
$host = $db["host"];
$user = $db["user"];
$pass = $db["pass"];
$dbname = ltrim($db["path"], "/");
$port = isset($db["port"]) ? $db["port"] : 3306; // Default MySQL port

// Create MySQL connection
$conn = new mysqli($host, $user, $pass, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Uncomment for testing
// echo "Connected to Railway MySQL successfully!";
?>
