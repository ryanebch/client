$(document).ready(function () {
  // Delegate the click event to dynamically added .view-btn elements
  $(document).on('click', '.view-btn', function () {
    // Get the data from the clicked button
    var motif = $(this).data('motif') || '';  // Default to empty string if not set
    var date = $(this).data('date') || '';    // Default to empty string if not set
    var heure = $(this).data('heure') || '';  // Default to empty string if not set
    var prenom = $(this).data('prenom') || ''; // Default to empty string if not set
    var nom = $(this).data('nom') || '';      // Default to empty string if not set
    var phone = $(this).data('phone') || '';  // Default to empty string if not set

    // Set the modal values with the data attributes
    $('#view-prenom').text(prenom);
    $('#view-nom').text(nom);
    $('#view-phone').text(phone);

    // Format and display motif, date, and heure in the textarea
    var motifText = motif.split(',').join('\n'); // Display each motif on a new line
    var dateText = date.split(',').join('\n'); // Display each date on a new line
    var heureText = heure.split(',').join('\n'); // Display each heure on a new line

    var detailsText = "";
    var motifArray = motif.split(',');
    var dateArray = date.split(',');
    var heureArray = heure.split(',');

    for (var i = 0; i < motifArray.length; i++) {
      detailsText += "Motif: " + motifArray[i] + "\n";
      detailsText += "Date: " + dateArray[i] + "\n";
      detailsText += "Heure: " + heureArray[i] + "\n\n";
    }

    // Update the textarea with all the details
    $('#view-motif').val(detailsText);

    // Show the modal
    $('#viewModal').modal('show');
  });

  // Filter patients when a doctor is selected
  $('#filters').on('change', function () {
    const selectedDoctor = $(this).val(); // Get the selected doctor's name

    // AJAX request to fetch filtered patients
    $.ajax({
      url: 'filter_patients.php', // Path to your PHP file
      method: 'POST', // Use POST for sending data
      data: { nom_docteur: selectedDoctor }, // Send the selected doctor as POST data
      success: function (response) {
        $('tbody').html(response); // Update the table body with the response
      },
      error: function (xhr, status, error) {
        console.error('Erreur:', error); // Log any errors
      }
    });
  });
});
