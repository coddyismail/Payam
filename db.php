<?php
// Get DATABASE_URL from Railway environment variables
$database_url = getenv("DATABASE_URL");

// If DATABASE_URL is not set, use hardcoded Railway MySQL URL
if (!$database_url) {
    $database_url = "mysql://root:OKLKIrlLyndBiMDCuRsYNEATVXmgoWTb@mysql.railway.internal:3306/railway";
}

// Parse the DATABASE_URL to extract connection details
$db = parse_url($database_url);

$host = $db["host"] ?? "localhost";  // Default fallback
$user = $db["user"] ?? "root";
$pass = $db["pass"] ?? "";
$dbname = isset($db["path"]) ? ltrim($db["path"], "/") : "railway"; 
$port = $db["port"] ?? 3306; // Default MySQL port

// Create MySQL connection
$conn = new mysqli($host, $user, $pass, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("❌ Database connection failed: " . $conn->connect_error);
}

// Debugging - Uncomment to check connection
// echo "✅ Connected to Railway MySQL successfully!";
?>
