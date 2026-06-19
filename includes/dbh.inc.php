<?php

// Connect to database
$host = "sql103.infinityfree.com";
$databasename = "if0_42219202_databases";
$dsn = "mysql:host=$host;dbname=$databasename";
$dbusername = "if0_42219202";
$dbpassword = "kB6ho2oATawr";

// Error handle with database connection failed
try{
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

// Print the error message if connection failed
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}