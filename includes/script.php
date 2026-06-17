<?php

$home = "Location: ../index.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $type = $_POST["type"];
    $vendor = $_POST["vendor"];
    $mac = $_POST["mac"];
    $ip = $_POST["ip"];
    $location = $_POST["location"];
    $status = $_POST["status"];

    try{
        require_once "dbh.inc.php";

        $query = "INSERT INTO devices(device_name,device_type,vendor,mac_address,ip_address,location,status)
        VALUES(?, ?, ?, ?, ?, ?, ?);";

        $statement = $pdo->prepare($query);

        $statement->execute([$name, $type, $vendor, $mac, $ip, $location, $status]);

        $pdo = null;
        $statement = null;

        header($home);

        die();

    } catch(PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
}


