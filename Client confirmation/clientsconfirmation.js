$(document).ready(function () {
    let appointments = []; // Stocke les rendez-vous

    // Fonction pour afficher les rendez-vous dans le tableau
    function displayAppointments(filteredAppointments) {
        const tbody = $('#clients-tbody');
        tbody.empty(); // Vide le tableau avant d'ajouter les nouvelles données

        // Trier les rendez-vous par date et heure
        filteredAppointments.sort((a, b) => {
            // Comparer la date et l'heure
            const dateA = new Date(a.date + ' ' + a.heure);
            const dateB = new Date(b.date + ' ' + b.heure);
            return dateA - dateB;
        });

        filteredAppointments.forEach(appointment => {
            const row = `
                <tr data-id="${appointment.appointment_id}">
                    <td class="info">${appointment.prenom}</td>
                    <td class="info">${appointment.nom}</td>
                    <td class="info">${appointment.phone}</td>
                    <td class="info">${appointment.date}</td>
                    <td class="info">${appointment.heure}</td>
                    <td class="info">${appointment.doctor}</td>
                    <td>
                        <button class="confirm-btn" data-id="${appointment.appointment_id}">Confirmer</button>
                        <button class="delete-btn" data-id="${appointment.appointment_id}">Supprimer</button>
                    </td>
                </tr>
            `;
            tbody.append(row);
        });
    }

    // Récupérer les rendez-vous depuis le serveur
    $.ajax({
        url: 'fetchAppointments.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            if (data.error) {
                console.error(data.error);
                return;
            }
            appointments = data; // Stocke tous les rendez-vous
            displayAppointments(appointments); // Affiche tous les rendez-vous au départ
        }
    });

    // Filtrer les rendez-vous en fonction du médecin sélectionné
    $('#filters').on('change', function () {
        const selectedDoctor = $(this).val(); // Récupère le médecin sélectionné
        const filteredAppointments = filterAppointmentsByDoctor(selectedDoctor); // Filtre les rendez-vous
        displayAppointments(filteredAppointments); // Affiche les rendez-vous filtrés
    });

    // Fonction de filtrage
    function filterAppointmentsByDoctor(doctorName) {
        if (doctorName === "tous") {
            return appointments; // Affiche tous les rendez-vous si "Tous les Docteurs" est sélectionné
        } else {
            return appointments.filter(appointment => appointment.doctor === doctorName); // Filtre par médecin
        }
    }

    // Gestionnaire du bouton "Confirmer"
    $('#clients-tbody').on('click', '.confirm-btn', function () {
        const appointmentId = $(this).data('id');
        $.ajax({
            url: 'confirmAppointment.php',
            type: 'POST',
            data: { appointment_id: appointmentId },
            dataType: 'json',  // Ensure we expect a JSON response
            success: function (response) {
                console.log(response);  // Log the response to the console
                if (response.success) {
                    alert('Rendez-vous confirmé!');
                    // Remove the confirmed appointment from the array
                    appointments = appointments.filter(appointment => appointment.appointment_id !== appointmentId);
                    displayAppointments(appointments); // Re-render the table without the confirmed appointment
                } else {
                    alert('Erreur lors de la confirmation du rendez-vous: ' + (response.message || 'Erreur inconnue'));
                }
            },
            error: function (xhr, status, error) {
                console.error('Erreur:', status, error);  // Log AJAX error
            }
        });
    });

    // Gestionnaire du bouton "Supprimer"
    $('#clients-tbody').on('click', '.delete-btn', function () {
        const appointmentId = $(this).data('id');
        console.log('Bouton Supprimer cliqué pour l`ID de rendez-vous:', appointmentId);

        // Send an AJAX request to soft delete the appointment
        $.ajax({
            url: 'deleteAppointment.php',  // PHP script for soft delete
            type: 'POST',
            data: { appointment_id: appointmentId },
            success: function (response) {
                console.log('Réponse du serveur:', response);  // Debugging log

                const data = JSON.parse(response);
                if (data.success) {
                    alert('Rendez-vous supprimé avec succées!');
                    // Update the frontend to remove the deleted appointment from the list
                    appointments = appointments.filter(a => a.appointment_id !== appointmentId);
                    displayAppointments(appointments);
                } else {
                    alert('Échec de la suppression du rendez-vous: ' + (data.message || 'Erreur inconnue.'));
                }
            },
            error: function (xhr, status, error) {
                alert('Une erreur est survenu lors de la suppression du rendez vous.');
                console.error('Erreur:', error);  // Debugging log for AJAX errors
            }
        });
    });


    // Toggle du menu et de la navigation latérale
    const menuBtn = document.getElementById('menu-btn');
    const sideNav = document.querySelector('.side-nav');

    menuBtn.addEventListener('click', () => {
        sideNav.classList.toggle('active');
        menuBtn.classList.toggle('active');
    });
});
