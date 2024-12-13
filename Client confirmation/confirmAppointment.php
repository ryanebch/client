<?php
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['appointment_id'])) {
        $appointment_id = $_POST['appointment_id'];

        // Make sure the appointment_id is valid
        if (!is_numeric($appointment_id)) {
            echo json_encode(["success" => false, "message" => "Invalid appointment ID"]);
            exit;
        }

        // Prepare the SQL query to update the appointment status (or move to patient table)
        $sql = "UPDATE appointments SET status = 'confirmed' WHERE appointment_id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            echo json_encode(["success" => false, "message" => "Error preparing query: " . $conn->error]);
            exit;
        }

        $stmt->bind_param("i", $appointment_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Optionally, you can move the appointment to a 'patients' table here
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "No appointment found with ID: $appointment_id"]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Appointment ID not provided"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}

$conn->close();
?>
