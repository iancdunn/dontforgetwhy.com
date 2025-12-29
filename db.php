<?php
  
$host = 'localhost';
$db_name = '[Your DB Name]';
$db_user = '[Your DB Username]';
$db_pass = '[Your DB Password]';
$charset = 'utf8mb4';
  
$dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $db_user, $db_pass, $options);
