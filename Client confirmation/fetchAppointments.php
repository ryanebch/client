<?php
include "connect.php";

$sql = "SELECT appointment_id, prenom_patient, nom_patient, phone, nom_docteur, date, heure, motif FROM appointments  WHERE status IN ('pending')";
$result = $conn->query($sql);

if ($result === false) {
    die(json_encode(["error" => "Error executing query: " . $conn->error]));
}

$appointments = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $start = $row['date'] . 'T' . $row['heure'];
        
        $formattedHeure = substr($row['heure'], 0, 5);

        $appointments[] = [
            'appointment_id' => $row['appointment_id'],  
            'heure' => $formattedHeure,
            'start' => $start,
            'nom' => $row['nom_patient'],
            'title' => "{$row['prenom_patient']} {$row['nom_patient']}", 
            'doctor' => $row['nom_docteur'],
            'phone' => $row['phone'],
            'motif' => $row['motif'],
            'date' => $row['date'],
            'prenom' => $row['prenom_patient'],
        ];
        
    }
}

header('Content-Type: application/json');
echo json_encode($appointments);

$conn->close();
?>
