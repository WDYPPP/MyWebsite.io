<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = trim($_POST["name"] ?? "");
    $type = trim($_POST["type"] ?? "");
    $vendor = trim($_POST["vendor"] ?? "");
    $mac = trim($_POST["mac"] ?? "");
    $ip = trim($_POST["ip"] ?? "");
    $location = trim($_POST["location"] ?? "");
    $status = trim($_POST["status"] ?? "");

    // Check missing field
    if ($name === "") {
        echo("Missing fields");
        exit();
    }

    // Connect to database
    require_once "dbh.inc.php";

    try{
        $query = "INSERT INTO devices(device_name,device_type,vendor,mac_address,ip_address,location,status)
        VALUES(?, ?, ?, ?, ?, ?, ?);";

        $statement = $pdo->prepare($query);
        $statement->execute([$name, $type, $vendor, $mac, $ip, $location, $status]);
        $statement = null;

        header("Location: dashboard.php?status=success");

        die();

    } catch(PDOException $e){
        die("Query failed: " . $e->getMessage());
    }

}
else{
    header("Location: ../index.php");
    die();
}

