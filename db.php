<?php
// Get DATABASE_URL from Railway environment variables (if using ENV)
$database_url = getenv("DATABASE_URL");

// If DATABASE_URL is not set via ENV, use the hardcoded URL
if (!$database_url) {
    $database_url = "mysql://root:OKLKIrlLyndBiMDCuRsYNEATVXmgoWTb@mysql.railway.internal:3306/railway";
}

// Parse the DATABASE_URL to extract connection details
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

// Uncomment this line to verify connection during testing
// echo "Connected to Railway MySQL successfully!";
?>
