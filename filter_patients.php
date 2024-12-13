<?php
include "db_conn.php";

$nom_docteur = $_POST['nom_docteur'];
if ($nom_docteur === "tous") {
    $sql = "SELECT 
        appointment_id as appointment_id,
        prenom_patient, 
        nom_patient, 
        phone 
    FROM appointments
    WHERE status IN ('confirmed','deleted')
    GROUP BY prenom_patient, nom_patient, phone
    ORDER BY appointment_id ASC";
} else {
    $sql = "SELECT 
        appointment_id as appointment_id,
        prenom_patient, 
        nom_patient, 
        phone 
    FROM appointments
    WHERE status IN ('confirmed','deleted') AND nom_docteur = ?
    GROUP BY prenom_patient, nom_patient, phone
    ORDER BY appointment_id ASC";
}

$stmt = $conn->prepare($sql);
if ($nom_docteur !== "tous") {
    $stmt->bind_param("s", $nom_docteur);
}
$stmt->execute();
$result = $stmt->get_result();

// Generate the table rows dynamically
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['appointment_id']}</td>
        <td>{$row['prenom_patient']}</td>
        <td>{$row['nom_patient']}</td>
        <td>{$row['phone']}</td>
        <td>
            <button class='btn btn-info view-btn' 
                    data-prenom='{$row['prenom_patient']}'
                    data-nom='{$row['nom_patient']}'
                    data-phone='{$row['phone']}'>
                Détails
            </button>
        </td>
    </tr>";
}
$stmt->close();
$conn->close();
?>
