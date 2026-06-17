<?php

// Connect to database
$dsn = "mysql:host=localhost;dbname=databases";
$dbusername = "root";
$dbpassword = "";

// Error handle with database connection failed
try{
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

// Print the error message if connection failed
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}