<?php

$home = "Location: ../index.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = htmlspecialchars($_POST["name"]);
    $type = htmlspecialchars($_POST["type"]);
    $vendor = htmlspecialchars($_POST["vendor"]);
    $mac = htmlspecialchars($_POST["mac"]);
    $ip = htmlspecialchars($_POST["ip"]);
    $location = htmlspecialchars($_POST["location"]);
    $status = htmlspecialchars($_POST["status"]);

    try{
        header("Location: dashboard.php?status=success");

        // Connect to database
        require_once "dbh.inc.php";

        $query = "INSERT INTO devices(device_name,device_type,vendor,mac_address,ip_address,location,status)
        VALUES(?, ?, ?, ?, ?, ?, ?);";

        $statement = $pdo->prepare($query);

        $statement->execute([$name, $type, $vendor, $mac, $ip, $location, $status]);

        require "dashboard.php";

        die();

    } catch(PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
}
else{
    header($home);
}

