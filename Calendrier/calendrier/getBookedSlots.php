<?php
include 'connect.php'; // Assuming the connection to the database is established here
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if doctor and date are provided
if (isset($_GET['doctor']) && isset($_GET['date'])) {
    $doctor = $_GET['doctor'];
    $date = $_GET['date'];

    // Sanitize the input to avoid SQL injection
    $doctor = mysqli_real_escape_string($conn, $doctor);
    $date = mysqli_real_escape_string($conn, $date);

    // Prepare and execute the query to get booked slots for the doctor and date
    $stmt = $conn->prepare("SELECT heure FROM appointments WHERE nom_docteur = ? AND date = ?");
    $stmt->bind_param("ss", $doctor, $date);
    $stmt->execute();
    $result = $stmt->get_result();

    // Initialize an array to store booked slots
    $bookedSlots = [];

    // Fetch all booked slots and store in the array
    while ($row = $result->fetch_assoc()) {
        $bookedSlots[] = $row['heure'];
    }

    // Return the booked slots as a JSON response
    echo json_encode($bookedSlots);
} else {
    echo json_encode(['error' => 'Doctor and date are required.']);
}

$conn->close();
?>
