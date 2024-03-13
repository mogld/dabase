<?php
$type     = 'mysql';                 //DB 타입
$server   = 'localhost';
$db       = 'TeamDB';             //DB 이름
$port     = '3306';
$charset  = 'utf8mb4';

$username = 'cookUser';
$password = '1234';
//require 'DB-connection.php';

$dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";
$options  = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $con = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), $e->getCode());
}

date_default_timezone_set('Asia/Seoul');

?>