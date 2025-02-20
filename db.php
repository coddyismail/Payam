$host = getenv('MYSQLHOST');
$user = getenv('MYSQLUSER');
$pass = getenv('MYSQLPASSWORD');
$db_name = getenv('MYSQLDATABASE');
$port = getenv('MYSQLPORT') ?: 3306; // Default MySQL port

<<<<<<< HEAD
$conn = new mysqli($host, $user, $pass, $db_name, $port);
=======
$conn = new mysqli($user, $pass, $db_name, $port);
>>>>>>> 450a0550ecdf681aef0d47c88b22c7db003fe141

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}
