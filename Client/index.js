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

  // Search function for filtering rows based on the search input
  $('#search-input').on('input', function () {
    var searchText = $(this).val().trim().toLowerCase(); // Trim spaces and convert to lowercase

    // If the search text is empty, show all rows
    if (searchText === "") {
      $('tbody tr').show();
      return;
    }

    // Split the search term by space so we can match individual words
    var searchTerms = searchText.split(' ');

    // Loop through the table rows and filter based on the search terms
    $('tbody tr').each(function () {
      var prenomText = $(this).find('td').eq(1).text().toLowerCase();  // Prenom column (index 1)
      var nomText = $(this).find('td').eq(2).text().toLowerCase();      // Nom column (index 2)
      var phoneText = $(this).find('td').eq(3).text().toLowerCase();    // Phone column (index 3)

      var matches = true;

      // Check if each search term matches any of the columns
      searchTerms.forEach(function (term) {
        if (
          !prenomText.includes(term) &&
          !nomText.includes(term) &&
          !phoneText.includes(term)
        ) {
          matches = false;
        }
      });

      // Show row if all search terms match, otherwise hide it
      if (matches) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });
});
