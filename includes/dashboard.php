<?php

$showSuccess = (($_GET['status'] ?? '') === 'success');

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assets Inventory System</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

    <a href="../index.php" class="btn btn-outline-primary">Add Devices</a>

  <!-- Success toast: only rendered when script.php redirected here with ?status=success -->
  <?php if ($showSuccess): ?>
  <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1080;">
    <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="4000">
      <div class="d-flex">
        <div class="toast-body">Device added successfully.</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>
  <?php endif; ?>



  <h2>Assets</h2>
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


<!-- Total device -->
<h5 class="card-title">Total Devices</h5>
<p class="display-6">
<?php
try {
$result = $pdo->query("SELECT COUNT(device_id) FROM devices;");
$count = $result->fetchColumn();
echo $count;
}
catch (PDOException $e) {
echo "Error: " . $e->getMessage();
}
?>
</p>

<!-- Online Devices -->
<h5 class="card-title">Online</h5>
<p class="display-6">
<?php
try {
$result = $pdo->query("SELECT COUNT(`status`) FROM devices WHERE `status` = \"online\";");
$count = $result->fetchColumn();
echo $count;
}
catch (PDOException $e) {
echo "Error: " . $e->getMessage();
}
?>
</p>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<?php if ($showSuccess): ?>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastEl = document.getElementById('successToast');
        const toast = new bootstrap.Toast(toastEl);
        toast.show();

        // Clean the URL so a refresh doesn't re-trigger the toast
        history.replaceState(null, '', window.location.pathname);
        });
    </script>

<?php endif; ?>

</body>
</html>
