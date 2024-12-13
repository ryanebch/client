<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reponsive landing page</title>

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <!-- bootstrap cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
  <!-- custom css file link  -->
  <link rel="stylesheet" href="home.css">
</head>

<body>

  <header class="header fixed-top">

    <div class="container">

      <div class="row align-items-center justify-content-between">
        <div><img src="./images/tooth.png" alt="logo">

          <a href="#home" class="logo">Cabinet<span>Plus</span></a>
        </div>

        <nav class="nav">
          <a href="#home">Accueil</a>
          <a href="#about">About</a>
          <a href="#services">Services</a>
          <a href="#review">Revues</a>
          <a href="#contact">Contact</a>
        </nav>
        <button class="link-btn">Rendez-vous</button>
        <div id="menu-btn" class="fas fa-bars">
        </div>
      </div>
  </header>
  <!-- header section ends -->

  <!-- home section starts -->
  <section class="home" id="home">

    <div class="container">

      <div class="row min-vh-100 align-items-center">
        <div class="content text-center text-md-left">
          <h3>Laissez nous vous illuminez votre sourire!</h3>
          <p>Faites-nous confiance pour améliorer votre santé dentaire grâce à notre engagement à fournir des services
            de haute qualité</p>
          <a href=" #contact" class="link-btn">Rendez-vous</a>
        </div>
      </div>

    </div>

  </section>
  <!-- home section ends -->

  <!-- about section starts -->
  <section class="about" id="about">

    <div class="container">

      <div class="row align-items-center">

        <div class="col-md-6">
          <img src="./images/rendezvous.png" class="w-100 mb-5 mb-md-0" alt="">
        </div>
        <div class="col-md-6 content">
          <span>À propos</span>
          <h3>De véritables soins de santé pour votre famille</h3>
          <p>Nos cliniques ont été construites sur le fait que nous souhaitons offrir un environnement confortable et
            agréable à nos patients. Nous avons pensé à chaque détail de votre visite pour vous garantir une expérience
            relaxante afin que nous puissions nous concentrer sur ce qui compte le plus : vous et vos
            soins.</p>
          <a href="#about" class="link-btn">Rendez-vous</a>
        </div>
      </div>
    </div>
  </section>
  <!-- about section ends -->
  <!-- process section starts -->
  <section class="process" id="about">
    <h1 class="heading">Processus de travail</h1>
    <div class="box-container container">

      <div class="box">
        <img src="images/process-1.png" alt="">
        <h3>Dentisterie esthétique</h3>
        <p>Améliorez l'apparence de vos dents et retrouvez un sourire éclatant grâce à nos solutions esthétiques sur
          mesure.</p>
      </div>
      <div class="box">
        <img src="images/process-2.png" alt="">
        <h3>Dentisterie pédiatrique</h3>
        <p>Offrez à vos enfants des soins dentaires adaptés et une expérience agréable pour garantir leur santé buccale.
        </p>
      </div>
      <div class="box">
        <img src="images/process-3.png" alt="">
        <h3>Implants dentaires</h3>
        <p>Bénéficiez d'implants dentaires solides et esthétiques pour remplacer les dents manquantes de façon durable.
        </p>
      </div>

    </div>
  </section>
  <!-- process section ends -->
  <!-- services section starts -->
  <section class="services" id="services">

    <h1 class="heading">Nos services</h1>

    <div class="box-container container">

      <div class="box">
        <img src="./images/icon-1.svg" alt="">
        <h3>Spécialiste d'alignement</h3>
        <p>Nous vous accompagnons pour retrouver un sourire parfaitement aligné grâce aux dernières technologies.</p>
      </div>

      <div class="box">
        <img src="./images/icon-2.svg" alt="">
        <h3>Dentisterie esthétique</h3>
        <p>Des solutions adaptées pour embellir vos dents et améliorer votre santé bucco-dentaire.</p>
      </div>

      <div class="box">
        <img src="./images/icon-3.svg" alt="">
        <h3>Expert en hygiène bucco-dentaire</h3>
        <p>Profitez de soins spécialisés et de conseils pour maintenir une hygiène buccale impeccable.</p>
      </div>

      <div class="box">
        <img src="./images/icon-4.svg" alt="">
        <h3>Spécialiste du traitement de canal</h3>
        <p>Recevez des soins de pointe pour préserver la santé de vos dents endommagées.</p>
      </div>

      <div class="box">
        <img src="./images/icon-5.svg" alt="">
        <h3>Conseil dentaire en direct</h3>
        <p>Échangez avec nous pour des conseils rapides et personnalisés.</p>
      </div>

      <div class="box">
        <img src="./images/icon-6.svg" alt="">
        <h3>Inspection des caries</h3>
        <p>Identifiez et traitez les caries grâce à des technologies modernes et un diagnostic précis.</p>
      </div>

    </div>

  </section>
  <!-- services section ends -->


  <!-- review section starts -->
  <!-- reviews  -->

  <section class="testimonials" id="review">
    <h2>Ce que disent nos clients</h2>
    <div class="slider">
      <div class="slide">
        <div class="card">
          <img src="./images/booumi.jpg" alt=" Photo client">
          <h3>Bachir</h3>
          <p>"Service exceptionnel et équipe très professionnelle !"</p>
          <div class="stars">⭐⭐⭐⭐⭐</div>
        </div>
      </div>
      <div class="slide">
        <div class="card">
          <img src="./images/plomr.jpg" alt=" Photo client">
          <h3>Plombier</h3>
          <p>"Service exceptionnel et équipe très professionnelle !"</p>
          <div class="stars">⭐⭐⭐⭐⭐</div>
        </div>
      </div>
      <div class="slide">
        <div class="card">
          <img src="./images/lei.jpg" alt=" Photo client">
          <h3>lulu</h3>
          <p>"Service exceptionnel !"</p>
          <div class="stars">⭐⭐⭐⭐⭐</div>
        </div>
      </div>
      <div class="slide">
        <div class="card">
          <img src="girl.jpg" alt=" Photo client">
          <h3>lynda len</h3>
          <p>" équipe très professionnelle !"</p>
          <div class="stars">⭐⭐⭐⭐⭐</div>
        </div>
      </div>
      <div class="slide">
        <div class="card">
          <img src="girl.jpg" alt=" Photo client">
          <h3>lynda len</h3>
          <p>" équipe très professionnelle !"</p>
          <div class="stars">⭐⭐⭐⭐⭐</div>
        </div>
      </div>

    </div>
    <div class="dots">
      <span class="dot active"></span>
      <span class="dot "></span>
      <span class="dot "></span>

    </div>
    <!-- Formulaire pour entrer un avis client -->
    <section class="feedback-form">
      <h2>Donnez votre avis</h2>
      <form id="feedbackForm">
        <div class="form-group">
          <label for="name">Votre nom :</label>
          <input type="text" id="name" name="name" placeholder="Entrez votre nom" required>
        </div>
        <div class="form-group">
          <label for="photo">Lien vers votre photo (optionnel) :</label>
          <input type="file" id="photo" name="photo" placeholder="Entrez le lien de votre photo">
        </div>
        <div class="form-group">
          <label for="feedback">Votre avis :</label>
          <textarea id="feedback" name="feedback" rows="4" placeholder="Partagez votre expérience" required></textarea>
        </div>
        <div class="form-group">
          <label for="rating">Votre note :</label>
          <select id="rating" name="rating" required>
            <option value="5">⭐⭐⭐⭐⭐</option>
            <option value="4">⭐⭐⭐⭐</option>
            <option value="3">⭐⭐⭐</option>
            <option value="2">⭐⭐</option>
            <option value="1">⭐</option>
          </select>
        </div>
        <button type="submit">Envoyer</button>
      </form>

    </section>
    <!-- review section ends -->
    <!-- contact section starts -->

    <section class="footer" id="contact">

   <div class="box-container container">

      <div class="box">
         <i class="fas fa-phone"></i>
         <h3>numéro de téléphone</h3>
         <p>+2130541125796</p>
         <p>+2130614423560</p>
      </div>
      
      <div class="box">
         <i class="fas fa-map-marker-alt"></i>
         <h3>notre adresse</h3>
         <p>blida, algérie - 091005</p>
      </div>

      <div class="box">
         <i class="fas fa-clock"></i>
         <h3>heures d'ouverture</h3>
         <p>08:00 - 15h00</p>
      </div>

      <div class="box">
         <i class="fas fa-envelope"></i>
         <h3>adresse mail</h3>
         <p>adresse@gmail.com</p>
         <p>email@gmail.com</p>
      </div>

   </div>

   <div class="credit"> &copy; copyright @ <?php echo date('Y'); ?> par <span>boulghour</span>  </div>

</section>
<!-- contact section starts -->



    <!-- custom js file link -->
    <script src="home.js"></script>
</body>

</html>