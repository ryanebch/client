$(document).ready(function () {
  // When clicking on the View button
  $('.view-btn').on('click', function () {
    var motif = $(this).data('motif');
    var date = $(this).data('date');
    var heure = $(this).data('heure');
    var prenom = $(this).data('prenom');
    var nom = $(this).data('nom');
    var phone = $(this).data('phone');

    // Set the modal values with the data attributes
    $('#view-prenom').text(prenom);
    $('#view-nom').text(nom);
    $('#view-phone').text(phone);
    $('#view-motif').text(motif);
    $('#view-date').text(date);
    $('#view-heure').text(heure);

    // Show the modal
    $('#viewModal').modal('show');
  });
});
// JavaScript to toggle the menu and side navigation visibility
const menuBtn = document.getElementById('menu-btn');
const sideNav = document.querySelector('.side-nav');

// Toggle the side navigation when the menu button is clicked
menuBtn.addEventListener('click', () => {
  sideNav.classList.toggle('active');
  menuBtn.classList.toggle('active');
});
