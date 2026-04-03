<?php
//Development Connection    
$host = '127.0.0.1';
$db = 'lourse';
$user = 'stan';
$pass = 'stan';
$charset = 'utf8mb4';
 
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage());
    echo($pdo);
}
function BDD($pdo) 
{
    return $pdo;
}
require_once('fonctions_user.php');
$User=new User($pdo);

?>