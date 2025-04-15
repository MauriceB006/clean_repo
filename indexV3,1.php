<?php 

require_once 'check_auth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ACTC - Public Transport</title>
  <!--map-->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  
  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="styleV3.css">

  <!--
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Rubik:wght@400;500;600;700&display=swap"
    rel="stylesheet">

  <!-- 
    - preload images
  -->
</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">
  
      <h1>
        <a href="#" class="logo">ACTC-Public Transport</a>
      </h1>
      <?php 
// Include this at the top of your header file
require_once 'check_auth.php';
?>

<!-- In your header where the login button was -->
<div class="header-user">
  <?php if (isset($_SESSION['user_id'])): ?>
    <div class="user-profile">
      <span class="user-greeting">
        <ion-icon name="person-circle-outline"></ion-icon>
        Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?> (ID: <?php echo $_SESSION['user_id']; ?>)
      </span>
      <div class="user-dropdown">
        <a href="logout.php">Logout</a>
      </div>
    </div>
  <?php else: ?>
    <a href="sign_in.php" class="login-button">
      <span class="login-icon">
        <ion-icon name="person-circle-outline"></ion-icon>
      </span>
      <span class="login-text">Sign In</span>
    </a>
  <?php endif; ?>
</div>
     
      <nav class="navbar" data-navbar>
        <!-- Navigation links -->
        <ul class="navbar-list">
          <li class="navbar-item">
            <a href="#home" class="navbar-link" data-nav-link>
              <span>Home</span>
            </a>
          </li>
          <li class="navbar-item">
            <a href="#about" class="navbar-link" data-nav-link>
              <span>About</span>
            </a>
          </li>
          <li class="navbar-item">
            <a href="#service" class="navbar-link" data-nav-link>
              <span>Service</span>
            </a>
          </li>
          <li class="navbar-item">
            <a href="#contact" class="navbar-link" data-nav-link>
              <span>Contact</span>
            </a>
          </li>
        </ul>
      </nav>
        
      
  
      <!-- Search Bar -->
      <div class="header-search-bar">
        <input type="text" class="search-input" placeholder="Search..." aria-label="Search">
        <button class="search-button" aria-label="Search">
          <ion-icon name="search-outline"></ion-icon>
        </button>
      </div>
  
      <button class="nav-open-btn" aria-label="Open menu" data-nav-toggler>
        <ion-icon name="menu-outline"></ion-icon>
      </button>
  
      <div class="overlay" data-nav-toggler data-overlay></div>
  
    </div>
  </header>
  

<!-- test test, does it show on the github web version? -->


  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="section hero" aria-label="home" id="home"
        style="background-image: url('../images/inside2.jpg')">
        <div class="container">

          <div class="hero-content">

            <h2 class="h1 hero-title">
              <span class="span">Where Every</span> Mile Matters
            </h2>

            <p class="hero-text">
              Yalla, hop on Beirut Bus! From souk adventures to Corniche cruises-w ba3dna faster than your cousin’s dabke moves!""
            </p>
          
            <a href="#" class="btn-outline">View Services</a>

            <img src="..\images\hero-shape.png" width="116" height="116" loading="lazy"
              class="hero-shape shape-1">

            <img src="..\images\hero-shape.png" width="116" height="116" loading="lazy"
              class="hero-shape shape-2">

          </div>

        </div>
      </section>





      <!-- 
        - #ABOUT
      -->

      <section class="section about" id="about" aria-label="about">
        <div class="container">

          <figure class="about-banner img-holder" style="--width: 400; --height: 720;">
            <img src="..\images\employee.jpg" width="400" height="720" loading="lazy" alt=""
              class="img-cover">

            <img src="C:\Users\lenovo\Documents\GitHub\NFA021-project-2025\..\images\about-shape-1.png" width="260" height="170" loading="lazy" alt=""
              class="abs-img abs-img-1">

            <img src="..\images\about-shape-2.png" width="500" height="500" loading="lazy" alt=""
              class="abs-img abs-img-2">
          </figure>

          <div class="about-content">

            <p class="section-subtitle">Why Choose Us ?</p>

            <h2 class="h2 section-title">We Are Professional Logistics.</h2>

            <p class="section-text">
              we are dedicated to providing an essential and efficient public transportation service that reflects the dynamic spirit of Beirut
            </p>
         
            <ul class="about-list">

              <li class="about-item">
                <div class="about-icon">
                  <ion-icon name="chevron-forward"></ion-icon>
                </div>

                <p class="about-text">
                  Providing safe, reliable, and efficient transportation services.                </p>
              </li>

              <li class="about-item">
                <div class="about-icon">
                  <ion-icon name="chevron-forward"></ion-icon>
                </div>

                <p class="about-text">
                  Prioritizing comfort, punctuality, and accessibility for all passengers.                </p>
              </li>

              <li class="about-item">
                <div class="about-icon">
                  <ion-icon name="chevron-forward"></ion-icon>
                </div>

                <p class="about-text">
                  Supporting the daily mobility needs of residents and visitors.

                </p>
              </li>

              <li class="about-item">
                <div class="about-icon">
                  <ion-icon name="chevron-forward"></ion-icon>
                </div>

                <p class="about-text">
                  Reflecting a commitment to quality and excellence in every journey.

                </p>
              </li>

              <li class="about-item">
                <div class="about-icon">
                  <ion-icon name="chevron-forward"></ion-icon>
                </div>

                <p class="about-text">
                  Honoring Beirut’s pulse with every honk and every turn.

                </p>
              </li>

              <li class="about-item">
                <div class="about-icon">
                  <ion-icon name="chevron-forward"></ion-icon>
                </div>

                <p class="about-text">
                  Where Beirut’s traffic turns into a celebration of tarab.

                </p>
              </li>

            </ul>

            <a href="#" class="btn">Learn More</a>

          </div>

        </div>
      </section>





      <!-- 
        - #SERVICE
      -->

 
      
      


      <!-- 
        - #FEATURE
      -->
      <section class="section feature" aria-label="feature" style="background-color: rgb(243, 248, 253);" >
        <div class="container">
      
          <div class="title-wrapper">
            <div>
              <p class="section-subtitle">Routes & Stops</p>
              <h2 class="h2 section-title">Our Latest Bus Routes and Stops.</h2>
              <p class="section-text">
                Providing frequent stops to ensure accessibility for all passengers.
              </p>
            </div>
            <a href="#" class="btn">Read More</a>
          </div>
          <h1>Bus Route Journey</h1>
          <select id="route-select" onchange="startJourney()">
            <option value="">Select a Line</option>
            <option value="B1">Line B1</option>
            <option value="ML3">Line ML3</option>
            <option value="B3">Line B3</option>
            <option value="B2">Line B2</option>
          </select>
          <div id="road">
            <span id="bus">🚌</span>
            <div id="stops">
              <!-- Stops will be dynamically updated -->
            </div>
          </div>
          <!-- Button to Display Prices -->
    <button id="show-price-btn" class="btn" onclick="showPrice()">View Price</button>
    
    <!-- Price Display Section -->
    <div id="price-display" style="margin-top: 20px; display: none;">
      <h2>Fare Information</h2>
      <p id="price-text">Select a line to see its fare.</p>
    </div>
        </div>
      </section>
      
<!--alert-->


  <section class="section updates-map" class="updates-map" aria-label="updates-map"
  style="background-image: url('inside2.jpg'); background-repeat: no-repeat;; background-size: cover; background-position: center;">
  <div class="container">

    <div class="title-wrapper">
      <h1 class="section-subtitle" style="font-size: 100px;">Bus Line Updates</h1>
      <h2 class="h2 section-title" style="color: rgb(134, 166, 192);">Stay informed about delays, cancellations, or schedule changes.</h2>
    </div>

    <ul class="update-list">
      <li class="update-item">
        <strong>Alert:</strong> Line B1 is delayed due to traffic.
      </li>
      <li class="update-item">
        <strong>Notice:</strong> Line ML3 will not operate on Sunday.
      </li>
    </ul>
    </div>
  </section>
    <section class="section feature" aria-label="feature" >
      <div class="container">
    <p class="section-subtitle" style="color: hsl(244, 89%, 17%);font-size: 50px;">Map</p>
    <h2 class="h2 section-title" style="color: rgb(181, 217, 246);">Explore Our Bus Lines</h2><br>
 
        <div class="map-buttons">
          <button class="btn" onclick="showLine('B1')">Show Line B1</button>
          <button class="btn" onclick="showLine('ML3')">Show Line ML3</button>
          <button class="btn" onclick="showLine('B3')">Show Line B3</button>
          <button class="btn" onclick="showLine('B2')">Show Line B2</button>
        </div>
        <div id="map" style="height: 500px; margin-top: 20px;"></div>
      </div>
    </section>
    

  </div>
</section>






      <!-- 
        - #PROJECT
      -->

      <section class="section project" aria-label="project">
        <div class="container">

          <p class="section-subtitle">Communication</p>

          <h2 class="h2 section-title">Engagemenet Featured </h2>

          <p class="section-text">
            Offering a platform for passengers to provide feedback or ask questions enhances user satisfaction.
          </p>

          <ul class="project-list">

            <li class="project-item">
              <div class="project-card">

                <figure class="card-banner img-holder" style="--width: 397; --height: 352;">
                  <img src="..\images\report.jpg" width="397" height="352" loading="lazy"
                    alt="Warehouse inventory" class="img-cover">
                </figure>

                <button class="action-btn" aria-label="View image">
                  <ion-icon name="expand-outline"></ion-icon>
                </button>

                <div class="card-content">
                  <p class="card-tag"> Passenger Reporting System</p>

                  <h3 class="h3">
                    <a href="reportV3.html" class="card-title">Report drivers, incidents, or misconduct </a>
                  </h3>

                  <a href="reportV3.html" class="card-link">click here</a>
                </div>

              </div>
            </li>

            <li class="project-item">
              <div class="project-card">

                <figure class="card-banner img-holder" style="--width: 397; --height: 352;">
                  <img src="../images/pay.jpg" width="397" height="352" loading="lazy"
                    alt="Warehouse inventory" class="img-cover">
                </figure>

                <button class="action-btn" aria-label="View image">
                  <ion-icon name="expand-outline"></ion-icon>
                </button>

                <div class="card-content">
                  <p class="card-tag">Payment & Bus Card</p>

                  <h3 class="h3">
                    <a href="paymentV3.html" class="card-title">Apply for a bus card</a>
                  </h3>

                  <a href="paymentV3.html" class="card-link">click here</a>
                </div>

              </div>
            </li>

            <li class="project-item">
              <div class="project-card">

                <figure class="card-banner img-holder" style="--width: 397; --height: 352;">
                  <img src="../images/opinion.jpg" width="397" height="352" loading="lazy"
                    alt="Warehouse inventory" class="img-cover">
                </figure>

                <button class="action-btn" aria-label="View image">
                  <ion-icon name="expand-outline"></ion-icon>
                </button>

                <div class="card-content">
                  <p class="card-tag">Reviews & Ratings</p>

                  <h3 class="h3">
                    <a href="reviewV3.html" class="card-title">Share your experience with us</a>
                  </h3>

                  <a href="reviewV3.html" class="card-link">click here</a>
                </div>

              </div>
            </li>

            <li class="project-item">
              <div class="project-card">

                <figure class="card-banner img-holder" style="--width: 397; --height: 352;">
                  <img src="../images/bus2.jpg" width="397" height="352" loading="lazy"
                    alt="Warehouse inventory" class="img-cover">
                </figure>

                <button class="action-btn" aria-label="View image">
                  <ion-icon name="expand-outline"></ion-icon>
                </button>

                <div class="card-content">
                  <p class="card-tag"> Lost Items</p>

                  <h3 class="h3">
                    <a href="lostV3.html" class="card-title">Report lost items on our buses.</a>
                  </h3>

                  <a href="lostV3.html" class="card-link">click here</a>
                </div>

              </div>
            </li>

            <li class="project-item">
              <div class="project-card">

                <figure class="card-banner img-holder" style="--width: 397; --height: 352;">
                  <img src="..\images\employee2.jpg" width="397" height="352" loading="lazy"
                    alt="Warehouse inventory" class="img-cover">
                </figure>

                <button class="action-btn" aria-label="View image">
                  <ion-icon name="expand-outline"></ion-icon>
                </button>

                <div class="card-content">
                  <p class="card-tag">Contact Us</p>

                  <h3 class="h3">
                    <a href="contactV3.html" class="card-title">Get in touch with us for any inquiries or support.</a>
                  </h3>

                  <a href="contactV3.html" class="card-link">click here</a>
                </div>

              </div>
            </li>

          </ul>

        </div>
      </section>

      <?php
if (isset($_GET['review']) && $_GET['review'] === 'success') {
    echo '<div class="alert alert-success">Thank you for your review!</div>';
}
?>




      <!-- 
        - #NEWSLETTER
      -->

      <section class="section newsletter" aria-label="newsletter">
        <div class="container">

          <figure class="newsletter-banner img-holder">
            <img src="..\images\newsletter-banner.png" width="303" height="381" alt="newsletter banner"
              class="w-100">
          </figure>

          <div class="newsletter-content">

            <h2 class="h2 section-title">Subscribe for offers and news</h2>

            <form action="" class="newsletter-form">
              <input type="email" name="email_address" placeholder="Enter Your Email" aria-label="email"
                class="email-field">

              <button type="submit" class="newsletter-btn">Subscribe Now</button>
            </form>

          </div>

        </div>
      </section>

    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

  <footer class="footer">
    <div class="container">

      <div class="footer-top section">

        <div class="footer-brand">

          <a href="#" class="logo">ACTC Transport</a>

          <p class="footer-text">
            Empowering journeys, building connections, and driving progress every step of the way.
          </p>

          <ul class="social-list">

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-instagram"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-youtube"></ion-icon>
              </a>
            </li>

          </ul>

        </div>

        <ul class="footer-list">

          <li>
            <p class="footer-list-title">Quick Links</p>
          </li>

          <li>
            <a href="#" class="footer-link">About</a>
          </li>

          <li>
            <a href="#" class="footer-link">Services</a>
          </li>

          <li>
            <a href="#" class="footer-link">Blog</a>
          </li>

          <li>
            <a href="#" class="footer-link">FAQ</a>
          </li>

          <li>
            <a href="#" class="footer-link">Contact Us</a>
          </li>

        </ul>

        <ul class="footer-list">

          <li>
            <p class="footer-list-title">Services</p>
          </li>

          <li>
            <a href="#" class="footer-link">Warehouse</a>
          </li>

          <li>
            <a href="#" class="footer-link">Air Freight</a>
          </li>

          <li>
            <a href="#" class="footer-link">Ocean Freight</a>
          </li>

          <li>
            <a href="#" class="footer-link">Road Freight</a>
          </li>

          <li>
            <a href="#" class="footer-link">Packaging</a>
          </li>

        </ul>

        <ul class="footer-list">

          <li>
            <p class="footer-list-title">Community</p>
          </li>

          <li>
            <a href="#" class="footer-link">Business Consulting</a>
          </li>

          <li>
            <a href="#" class="footer-link">Testimonials</a>
          </li>

          <li>
            <a href="#" class="footer-link">Track Your Shipment</a>
          </li>

          <li>
            <a href="#" class="footer-link">Privacy Policy</a>
          </li>

          <li>
            <a href="#" class="footer-link">Terms & Condition</a>
          </li>

        </ul>

      </div>

      <div class="footer-bottom">
        <p class="copyright">
          &copy; 2025 ACTC-Transport Publique. All Rights Reserved  <a href="#" class="copyright-link"></a>
        </p>
      </div>

    </div>
  </footer>





  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn>
    <ion-icon name="chevron-up"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="scriptV3.js" defer></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>