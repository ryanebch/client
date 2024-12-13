let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .nav');
let header = document.querySelector('.header');


menu.onclick = () => {
  menu.classList.toggle('fa-times');
  navbar.classList.toggle('active');
}
window.onscroll = () => {
  menu.classList.toggle('fa-times');
  navbar.classList.toggle('active');
  if (window.scrollY > 0) {
    header.classList.add('active');
  } else {
    header.classList.remove('active');
  }

}
document.getElementById('feedbackForm').addEventListener('submit', function (e) {
  e.preventDefault(); // Empêche le rechargement de la page lors de la soumission du formulaire

  // Récupérer les données du formulaire
  const name = document.getElementById('name').value;
  const photoInput = document.getElementById('photo');
  const feedback = document.getElementById('feedback').value;
  const rating = document.getElementById('rating').value;

  // Initialiser la variable photo
  let photo = 'default-avatar.jpg';  // Image par défaut si aucune photo n'est choisie

  // Vérifier si une photo a été téléchargée
  if (photoInput.files && photoInput.files[0]) {
    const fileReader = new FileReader();

    // Lorsque l'image est chargée en base64
    fileReader.onload = function (e) {
      photo = e.target.result;  // Cette donnée est une URL Base64

      // Ajouter le feedback après le chargement de l'image
      addFeedbackToSlider(name, photo, feedback, rating);

      // Sauvegarder les données dans le localStorage
      saveFeedbackToLocalStorage(name, photo, feedback, rating);
    };

    // Charger l'image en Base64
    fileReader.readAsDataURL(photoInput.files[0]);
  } else {
    // Si aucune photo n'est téléchargée, ajouter le feedback avec une image par défaut
    addFeedbackToSlider(name, photo, feedback, rating);

    // Sauvegarder les données dans le localStorage
    saveFeedbackToLocalStorage(name, photo, feedback, rating);
  }

  // Réinitialiser le formulaire après soumission
  this.reset();

  // Afficher un message de confirmation
  alert('Merci pour votre avis !');
});

// Fonction pour ajouter le feedback dans le slider
function addFeedbackToSlider(name, photo, feedback, rating) {
  const newSlide = document.createElement('div');
  newSlide.classList.add('slide');
  newSlide.innerHTML = `
      <div class="card">
          <img src="${photo}" alt="Photo client">
          <h3>${name}</h3>
          <p>"${feedback}"</p>
          <div class="stars">${'⭐'.repeat(rating)}</div>
      </div>
  `;

  // Ajouter la nouvelle slide au slider
  document.querySelector('.slider').appendChild(newSlide);

  // Ajouter un nouveau point dans la navigation du slider (dots)
  const newDot = document.createElement('span');
  newDot.classList.add('dot');
  document.querySelector('.dots').appendChild(newDot);

  // Mettre à jour les slides et les dots après l'ajout de la nouvelle slide
  updateSlidesAndDots();
}

// Fonction pour sauvegarder un avis dans le localStorage
function saveFeedbackToLocalStorage(name, photo, feedback, rating) {
  let feedbacks = JSON.parse(localStorage.getItem('feedbacks')) || [];

  // Ajouter le nouveau feedback
  feedbacks.push({ name, photo, feedback, rating });

  // Sauvegarder à nouveau dans le localStorage
  localStorage.setItem('feedbacks', JSON.stringify(feedbacks));
}

// Fonction pour charger les avis depuis le localStorage
function loadFeedbackFromLocalStorage() {
  let feedbacks = JSON.parse(localStorage.getItem('feedbacks')) || [];

  // Ajouter chaque avis au slider
  feedbacks.forEach(feedback => {
    addFeedbackToSlider(feedback.name, feedback.photo, feedback.feedback, feedback.rating);
  });
}

// Sélectionne les slides et les dots
let slides = document.querySelectorAll('.slide');
let dots = document.querySelectorAll('.dot');

let currentIndex = 0; // Index de la slide active

// Fonction pour afficher une seule slide
function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.toggle('active', i === index); // Active uniquement la slide correspondante
  });

  dots.forEach((dot, i) => {
    dot.classList.toggle('active', i === index); // Active le dot correspondant
  });
}

// Fonction pour passer à la slide suivante
function nextSlide() {
  currentIndex = (currentIndex + 1) % slides.length; // Repart à 0 après la dernière slide
  showSlide(currentIndex);
}

// Fonction pour passer à une slide via les dots
dots.forEach((dot, index) => {
  dot.addEventListener('click', () => {
    currentIndex = index;
    showSlide(currentIndex);
  });
});

// Défilement automatique
setInterval(nextSlide, 5000); // Change de slide toutes les 5 secondes

// Initialisation
function updateSlidesAndDots() {
  slides = document.querySelectorAll('.slide');  // Re-récupérer les slides à chaque mise à jour
  dots = document.querySelectorAll('.dot');      // Re-récupérer les dots

  // Si aucune slide n'est active, rendre la première active
  if (slides.length > 0 && !slides[currentIndex].classList.contains('active')) {
    currentIndex = 0;  // Réinitialiser à la première slide si aucune n'est active
  }

  showSlide(currentIndex);  // Afficher la slide active
}

// Charger les feedbacks depuis le localStorage au chargement de la page
loadFeedbackFromLocalStorage();

updateSlidesAndDots();  // Mettre à jour les slides et dots au chargement