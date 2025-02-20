$host = getenv('MYSQLHOST');
$user = getenv('MYSQLUSER');
$pass = getenv('MYSQLPASSWORD');
$db_name = getenv('MYSQLDATABASE');
$port = getenv('MYSQLPORT') ?: 3306; // Default MySQL port

$conn = new mysqli($host, $user, $pass, $db_name, $port);

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}
