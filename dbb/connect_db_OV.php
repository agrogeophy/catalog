<?php 

// ------------------------------------------------------------------------------------
// VALUES TO REPLACE

$uname = "YourUsername";
$pass = "YourPassword";
$dsn = 'mysql:dbname=agrigeophy_zhao;host=127.0.0.1';

try {
    $conn = new PDO($dsn, $uname, $pass);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

?>