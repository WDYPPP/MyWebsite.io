<?php
// Connect to SQL
require_once "dbh.inc.php";

// Run query to show all data in table devices
try {
    $query = "SELECT * FROM devices;";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
}
// Show the error message if failed
catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Device Dashboard</title>
</head>
<body>
  <h2>Inventory</h2>
  <table border="1" cellpadding="8">
    <tr>
      <th>Device ID</th><th>Device Name</th><th>Device Type</th><th>Vendor</th>
      <th>MAC</th><th>IP</th><th>Location</th><th>Status</th>
    </tr>
    <?php foreach ($results as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row["device_id"]) ?></td>
        <td><?= htmlspecialchars($row["device_name"]) ?></td>
        <td><?= htmlspecialchars($row["device_type"]) ?></td>
        <td><?= htmlspecialchars($row["vendor"]) ?></td>
        <td><?= htmlspecialchars($row["mac_address"]) ?></td>
        <td><?= htmlspecialchars($row["ip_address"]) ?></td>
        <td><?= htmlspecialchars($row["location"]) ?></td>
        <td><?= htmlspecialchars($row["status"]) ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
