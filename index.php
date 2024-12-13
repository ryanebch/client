<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Page</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!-- Header -->
<button id="menu-btn">
  <i class="fa fa-bars"></i> <!-- You can use any icon or text for the menu -->
</button>
<header class="header fixed-top">
    <div class="h-bar">
        <div class="row align-items-center justify-content-between">
            <div>
                <img src="./images/tooth.png" alt="logo">
                <a href="#home" class="logo">Cabinet<span>Plus</span></a>
            </div>
            
            <nav class="nav">
                <a href="#home">Accueil</a>
                <a href="#">Patients</a>
                <a href="#">Calendrier</a>
                <div class="dropdown">
                    <a href="#suivre" class="suivre" >Suivre</a>
                    <ul class="suivre-menu">
                        <li><a href="#suivi-produits">Suivi des Produits</a></li>
                        <li><a href="#suivi-achats">Suivi des Achats</a></li>
                        <li><a href="#suivi-protheses">Suivi des Prothèses</a></li>
                    </ul>
                </div>
            </nav>
            
            <button class="link-btn">Connexion</button>
        </div> <!-- End of row -->
    </div> <!-- End of h-bar -->
</header>

<main>
  <div class="side-nav">
    <div class="user">
      <img src="images/ryry.jpg" class="user-img">
      <div>
        <h2>Ryane</h2>
        <p>ryane@gmail.com</p>
        </div>
    </div>
    <ul>
      <a href="index.php"><li><img src="images/dashboard.png">
        <p>Dashboard</p>
      </li></a>
      <a href="#"><li><img src="images/members.png">
        <p>Page de clients</p>
      </li></a>
      <a href="./produit/index2.php"><li><img src="images/rewards.png">
        <p>Pages de produits</p>
      </li></a>
      <a href="./produit/index2.php"><li><img src="images/prothese.png">
        <p>Pages de prothèses</p>
      </li></a>
      <a href="#"><li><img src="images/projects.png">
        <p>Bon d'achat</p>
      </li></a>
      <a href="#"><li><img src="images/setting.png">
        <p>Fournisseur</p>
      </li></a>
    </ul>

    <ul>
      <li><img src="images/logout.png">
        <p>Deconnexion</p>
      </li>
    </ul>
  </div>
</div>

<div class="container" style="margin-left: 120px; margin-top: 100px;">
    <div class="selection">
        <select id="filters">
            <option value="tous">Tous les Docteurs</option>
            <option value="Dr Keciour Nesma">Dr Keciour Nesma</option>
            <option value="Dr Belhedid Ibtissem">Dr Belhedid Ibtissem</option>
            <option value="Dr Bensalah Meriem">Dr Bensalah Meriem</option>
            <option value="Dr Guerroumi Lynda">Dr Guerroumi Lynda</option>
            <option value="Dr Bouchetara">Dr Bouchetara Ryane</option>
        </select>
    </div>
    
    <h2>Liste des patients</h2>
    <!-- Add Search Bar above the table -->
<div class="search-bar">
    <input type="text" id="search-input" class="form-control" placeholder="Rechercher un patient" />
</div>

    <table class="table table-hover text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "db_conn.php";

            // Filter by doctor if one is selected
            $nom_docteur = isset($_POST['nom_docteur']) ? $_POST['nom_docteur'] : 'tous';
            
            $sql = "SELECT 
                        appointment_id as appointment_id,
                        prenom_patient, 
                        nom_patient, 
                        nom_docteur,
                        phone, 
                        GROUP_CONCAT(motif ORDER BY date ASC) AS motif, 
                        GROUP_CONCAT(date ORDER BY date ASC) AS date, 
                        GROUP_CONCAT(heure ORDER BY date ASC) AS heure
                    FROM appointments
                    WHERE status IN ('confirmed', 'deleted')";

            if ($nom_docteur && $nom_docteur !== 'tous') {
                $sql .= " AND nom_docteur = '$nom_docteur'";
            }

            $sql .= " GROUP BY prenom_patient, nom_patient, phone
                      ORDER BY appointment_id ASC";

            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row['appointment_id']; ?></td>
                    <td><?php echo $row['prenom_patient']; ?></td>
                    <td><?php echo $row['nom_patient']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td>
                        <button class="btn btn-info view-btn" 
                                data-prenom="<?php echo $row['prenom_patient']; ?>"
                                data-nom="<?php echo $row['nom_patient']; ?>"
                                data-phone="<?php echo $row['phone']; ?>"
                                data-motif="<?php echo $row['motif']; ?>"
                                data-date="<?php echo $row['date']; ?>"
                                data-heure="<?php echo $row['heure']; ?>">
                            Détails
                        </button>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<!-- View Details Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Détails</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- View Appointment Details -->
                <p><strong>Prénom:</strong> <span id="view-prenom"></span></p>
                <p><strong>Nom:</strong> <span id="view-nom"></span></p>
                <p><strong>Phone:</strong> <span id="view-phone"></span></p>

                <!-- Textarea for Motif, Date, and Heure -->
                <div class="mb-3">
                    <label for="view-motif" class="form-label">Motif / Date / Heure</label>
                    <textarea class="form-control" id="view-motif" rows="6" readonly style="resize: none;"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Include Bootstrap JS and jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="index.js"></script>
</body>
</html>
