<?php
include 'db_conn.php';

$sql = "SELECT DISTINCT nom_patient, prenom_patient, phone FROM appointments ORDER BY date DESC";
$result = mysqli_query($conn, $sql);

$clients = [];
while ($row = mysqli_fetch_assoc($result)) {
    $clients[] = $row;
}

echo json_encode($clients);  // Return the result as JSON
?>
