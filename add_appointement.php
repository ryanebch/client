<?php
// Include database connection
include 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['prenom_patient'], $_POST['nom_patient'], $_POST['phone'], $_POST['nom_docteur'], $_POST['date'], $_POST['heure'], $_POST['motif'])) {
        $prenom_patient = $_POST['prenom_patient'];
        $nom_patient = $_POST['nom_patient'];
        $phone = $_POST['phone'];
        $nom_docteur = $_POST['nom_docteur'];
        $date = $_POST['date'];
        $heure = $_POST['heure'];
        $motif = $_POST['motif'];

        // Insert appointment data
        $stmt = $conn->prepare("INSERT INTO appointments (nom_patient, prenom_patient, phone, nom_docteur, date, heure, motif) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $nom_patient, $prenom_patient, $phone, $nom_docteur, $date, $heure, $motif);

        if ($stmt->execute()) {
            header("Location: index.php?msg=Rendez-vous ajouté avec succès"); // Redirect to index with success message
            exit();
        } else {
            echo "Erreur lors de l'insertion : " . $stmt->error;
        }
    }
}
?>
