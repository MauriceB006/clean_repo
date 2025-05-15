<?php
// (Optional: You can add PHP cookie logic here if needed)
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        .cookie-popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .cookie-popup-box {
            background: #fff;
            padding: 20px 25px;
            border-radius: 10px;
            max-width: 400px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            text-align: center;
        }
        .cookie-popup-box p {
            margin: 0 0 15px;
            font-size: 16px;
            color: #333;
        }
        .cookie-popup-box a {
            color: #0066cc;
            text-decoration: underline;
        }
        .cookie-popup-box button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .cookie-popup-box button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div id="cookie-popup" class="cookie-popup-overlay">
    <div class="cookie-popup-box">
        <p>We use cookies to ensure you get the best experience on our website. <a href="privacy-policy.html" target="_blank">Learn more</a></p>
        <button id="accept-cookies">Accept</button>
    </div>
</div>

<script>
function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        const d = new Date();
        d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + d.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

// Wait for DOM to fully load
document.addEventListener("DOMContentLoaded", function() {
    if (!getCookie("cookiesAccepted")) {
        document.getElementById("cookie-popup").style.display = "flex";
    }

    document.getElementById("accept-cookies").addEventListener("click", function() {
        setCookie("cookiesAccepted", "yes", 365);
        document.getElementById("cookie-popup").style.display = "none";
    });
});
</script>

</body>
</html>
<?php 
require_once 'authentication\check_auth.php';

// Handle cookie consent
$showCookieConsent = true;
if (isset($_COOKIE['cookie_consent'])) {
    $showCookieConsent = false;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cookie_action'])) {
    $cookieConsent = false;
    $preferenceCookies = false;
    $analyticsCookies = false;
    
    if ($_POST['cookie_action'] === 'accept_all') {
        $cookieConsent = true;
        $preferenceCookies = true;
        $analyticsCookies = true;
    } elseif ($_POST['cookie_action'] === 'save_settings') {
        $cookieConsent = true;
        $preferenceCookies = isset($_POST['preference_cookies']);
        $analyticsCookies = isset($_POST['analytics_cookies']);
    } elseif ($_POST['cookie_action'] === 'reject_all') {
        $cookieConsent = true;
        $preferenceCookies = false;
        $analyticsCookies = false;
    }
    
    // Set cookies for 1 year
    setcookie('cookie_consent', $cookieConsent ? 'true' : 'false', time() + 365*24*60*60, '/');
    setcookie('cookie_preference', $preferenceCookies ? 'true' : 'false', time() + 365*24*60*60, '/');
    setcookie('cookie_analytics', $analyticsCookies ? 'true' : 'false', time() + 365*24*60*60, '/');
    
    // Redirect to avoid form resubmission
    header('Location: '.$_SERVER['PHP_SELF']);
    exit();
}

// Track route usage if analytics cookies are enabled
if (isset($_GET['route_used']) && ($_COOKIE['cookie_analytics'] ?? 'false') === 'true') {
    $route = $_GET['route_used'];
    $favoriteRoutes = json_decode($_COOKIE['favorite_routes'] ?? '{}', true);
    $favoriteRoutes[$route] = ($favoriteRoutes[$route] ?? 0) + 1;
    setcookie('favorite_routes', json_encode($favoriteRoutes), time() + 365*24*60*60, '/');
}
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
  
  <!-- favicon -->
  <link rel="shortcut icon" href="assets\images_v5\ACTC LOGO -02 SMALL.png" type="image/svg+xml">

  <!-- custom css link -->
  <link rel="stylesheet" href="assets\css\styleV4.css">

  <!-- google font link -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Rubik:wght@400;500;600;700&display=swap"
    rel="stylesheet">
  <!-- preload images -->
  
</head>

<body id="top">

  <!-- HEADER -->
  <header class="header" data-header>
    <div class="container">
  
      <h1>
        <a href="indexV51.html">
          <img src="assets\images_v5\ACTC LOGO -02 SMALL.png" class="logo" alt="ACTC Public Transport">
        </a>
      </h1>
  
      <div class="header-user" style="color: black; font-weight: bold;">
        <?php if (isset($_SESSION['user_id'])): ?>
          <div class="user-profile">
            <span class="user-greeting">
              <ion-icon name="person-circle-outline"></ion-icon>
              Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?> (ID: <?php echo $_SESSION['user_id']; ?>)
            </span>
            <div class="user-dropdown">
              <a href="authentication\logout.php">Logout</a>
            </div>
          </div>
        <?php else: ?>
          <a href="authentication\sign_in.php" class="login-button">
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
            <a href="pages\searchplanner.html" class="navbar-link" data-nav-link>
              <span>Plan</span>
            </a>
          </li>
          <li class="navbar-item">
            <a href="#about" class="navbar-link" data-nav-link>
              <span>Lines</span>
            </a>
          </li>
          <li class="navbar-item">
            <a href="#service" class="navbar-link" data-nav-link>
              <span>About</span>
            </a>
          </li>
          <li class="navbar-item">
            <a href="pages\contactV3.html" class="navbar-link" data-nav-link>
              <span>Contact</span>
            </a>
          </li>
          <li class="navbar-item">
            <a href="pages\career.html" class="navbar-link" data-nav-link>
              <span>Career</span>
            </a>
          </li>
        </ul>
      </nav>
  
      <button class="nav-open-btn" aria-label="Open menu" data-nav-toggler>
        <ion-icon name="menu-outline"></ion-icon>
      </button>
  
      <div class="overlay" data-nav-toggler data-overlay></div>
  
    </div>
  </header>

  <main>
    <article>
      <!-- HERO SECTION -->
      <section class="section hero" aria-label="home" id="home"
        style="background-image: url('assets/images_v5/2 IMG_7419.jpg')">
        <div class="container">
          <div class="hero-content">
            <h2 class="h1 hero-title">
              <span class="span">Where Every</span> Mile Matters
            </h2>

            <p class="hero-text">
              <strong>Yalla, hop on The Public Transport Buses! From souk adventures to Corniche cruises-w ba3dna faster than your cousin's dabke moves!""</strong>
            </p>
          
            <a href="pages\searchplanner.html" class="btn-outline">Discover More</a>

            <img src="assets\images_v5\hero-shape.png" width="116" height="116" loading="lazy"
              class="hero-shape shape-1">

            <img src="assets\images_v5\hero-shape.png" width="116" height="116" loading="lazy"
              class="hero-shape shape-2">
          </div>
        </div>
      </section>

      <!-- ADS BANNER -->
      <style>
        :root {
            --primary: #3d50dc;
            --secondary: #1d2f42;
            --light: #f2f2f2;
            --text-muted: #7d879c;
            --text-heading: #1d2f42;
            --text-body: #1d2f42;
            --border-color: #dfe0e4;
            --border-radius: 5px;
            --card-radius: 8px;
            --card-shadow: 0 0 5px 0 rgba(0,0,0,0.1);
            --card-shadow-hover: 0 0.3rem 1.525rem -0.375rem rgba(0,0,0,0.1);
            --font-family: "Arial", sans-serif;
            --font-base: 13px;
            --font-lg: 17px;
            --font-xl: 21px;
            --font-xxl: 36px;
            --semibold: 500;
            --bold: bold;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: var(--font-family);
        }
        
        .banners-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 15px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .promo-banner {
            border-radius: var(--card-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: white;
        }

        .promo-banner deal-banner {
            border-radius: var(--card-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: white;
        }
        
        
        .promo-banner:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow-hover);
        }
        
        .banner-link {
            display: block;
            text-decoration: none;
            color: inherit;
        }
        
        .banner-image {
            width: 100%;
            height: auto;
            display: block;
        }
        
        .banner-content {
            padding: 15px;
        }
        
        .banner-title {
            font-size: var(--font-xl);
            font-weight: var(--bold);
            color: var(--text-heading);
            margin-bottom: 8px;
        }
        
        .banner-subtitle {
            font-size: var(--font-lg);
            color: var(--text-body);
            margin-bottom: 12px;
        }
        
        .banner-cta {
            display: inline-block;
            background-color: var(--primary);
            color: white;
            padding: 8px 16px;
            border-radius: var(--border-radius);
            font-weight: var(--semibold);
            font-size: var(--font-lg);
            margin-top: 10px;
        }
        
        .banner-footer {
            font-size: var(--font-base);
            color: var(--text-muted);
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px dashed var(--border-color);
        }
        
        .deal-banner {
            background: linear-gradient(135deg, #f5f7fa 0%, #ffffff 100%);
            padding: 20px;
            border-radius: var(--card-radius);
            position: relative;
            overflow: hidden;
        }
        
        .deal-highlight {
            position: absolute;
            top: 0;
            right: 0;
            background-color: var(--primary);
            color: white;
            padding: 5px 15px;
            font-weight: var(--bold);
            border-bottom-left-radius: var(--border-radius);
        }
        
        .deal-title {
            font-size: var(--font-xl);
            font-weight: var(--bold);
            margin-bottom: 5px;
        }
        
        .deal-value {
            font-size: var(--font-xxl);
            font-weight: var(--bold);
            color: var(--primary);
            line-height: 1;
            margin: 10px 0;
        }
        
        .deal-products {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }
        
        .deal-product {
            flex: 1;
            background-color: white;
            padding: 10px;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
        }
        
        .product-name {
            font-weight: var(--bold);
            margin-bottom: 5px;
        }
        
        .product-price {
            color: var(--primary);
            font-weight: var(--bold);
        }
        
        .product-discount {
            color: var(--text-muted);
            text-decoration: line-through;
            font-size: var(--font-base);
        }
        
        @media (max-width: 768px) {
            .banners-container {
                grid-template-columns: 1fr;
            }
            
            .deal-products {
                flex-direction: column;
            }
        }

        .scroll-controls {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px 0;
            overflow: hidden;
        }

        .horizontal-scroll-wrapper {
            overflow-x: auto;
            scroll-behavior: smooth;
            width: 100%;
        }

        .banners-container {
            display: flex !important;
            flex-wrap: nowrap !important;
            gap: 20px;
            padding: 10px 0;
            min-width: max-content;
        }

        .promo-banner {
            flex: 0 0 auto;
            width: 300px;
        }

        .scroll-btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 12px;
            font-size: 24px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 2;
            margin: 0 10px;
            transition: background-color 0.3s ease;
        }

        .scroll-btn:hover {
            background-color: #3a8f3a;
        }
      </style>

      <div class="scroll-controls">
        <button class="scroll-btn left" onclick="scrollBanners(-1)">&#9664;</button>
        
        <div class="horizontal-scroll-wrapper">
            <div class="banners-container">
                <div class="banners-container">
                  <!-- Discount Banner -->
                  <div class="promo-banner">
                      <a href="#" class="banner-link" data-promotionid="2853" data-index="1" onclick="viewPromotionEvent(this);">
                          <img src="https://www.usj.edu.lb/images/logo.png" alt="USJ Logo" class="banner-image">
                          <div class="banner-content">
                              <h3 class="banner-title">Gift Cards</h3>
                              <p class="banner-subtitle">The Secret Behind Big Smiles!</p>
                              <span class="banner-cta">CHECK ALL DISCOUNTS NOW</span>
                              <p class="banner-footer">For partnerships, reach out to us at partner@actc.com</p>
                          </div>
                      </a>
                  </div>
                  
                  <div class="promo-banner">
                    <a href="https://www.cartlow.com/uae/en/home/iphones-page" class="banner-link" data-promotionid="2855" data-index="3" onclick="viewPromotionEvent(this);">
                        <img src="assets\images_v5\logo-cartlow.svg"  alt="cartlow" class="banner-image">
                        <div class="banner-content">
                            <h3 class="banner-title">XXXX YYYYY</h3>
                            <p class="banner-subtitle"> XX YYY ZZZ OOO</p>
                            <span class="banner-cta">VIEW DEALS</span>
                        </div>
                    </a>
                  </div>

                  <div class="promo-banner">
                    <a href="https://www.cartlow.com/uae/en/home/iphones-page" class="banner-link" data-promotionid="2855" data-index="3" onclick="viewPromotionEvent(this);">
                        <img src="assets\images_v5\Lebanese_University_logo.png" alt="Premium Deals" class="banner-image" width="200">
                        <div class="banner-content">
                            <h3 class="banner-title">XXXX YYYYY</h3>
                            <p class="banner-subtitle"> XXX YYY ZZZ OOO</p>
                            <span class="banner-cta">VIEW DEALS</span>
                        </div>
                    </a>
                  </div>

                  <div class="promo-banner">
                    <a href="https://www.cartlow.com/uae/en/home/iphones-page" class="banner-link" data-promotionid="2855" data-index="3" onclick="viewPromotionEvent(this);">
                        <img src="assets\images_v5\wish_logo.svg" alt="Premium Deals" class="banner-image">
                        <div class="banner-content">
                            <h3 class="banner-title">XXXX YYYYY</h3>
                            <p class="banner-subtitle"> XXX YYY ZZZ OOO</p>
                            <span class="banner-cta">VIEW DEALS</span>
                        </div>
                    </a>
                  </div>

                  <div class="promo-banner">
                    <a href="https://www.cartlow.com/uae/en/home/iphones-page" class="banner-link" data-promotionid="2855" data-index="3" onclick="viewPromotionEvent(this);">
                        <img src="assets\images_v5\new_omt_logo.svg" alt="Premium Deals" class="banner-image">
                        <div class="banner-content">
                            <h3 class="banner-title">XXXX YYYYY</h3>
                            <p class="banner-subtitle"> XXX YYY ZZZ OOO</p>
                            <span class="banner-cta">VIEW DEALS</span>
                        </div>
                    </a>
                  </div>
                </div>
            </div>
        </div>
        <button class="scroll-btn right" onclick="scrollBanners(1)">&#9654;</button>
      </div>

      <!-- ABOUT SECTION -->
      <section class="section about" id="about" aria-label="about">
        <div class="container">
            <img src="assets\images_v5\employee.jpg" width="400" height="720" loading="lazy" alt=""
              class="img-cover-1">

            <img src="assets\images_v5\about-shape-2.png" width="500" height="500" loading="lazy" alt=""
              class="abs-img abs-img-2">

          <div class="about-content">
            <p class="section-subtitle">Why Choose Us ?</p>

            <p class="section-text">
              we are dedicated to providing an essential and efficient public transportation service that reflects the dynamic spirit of Lebanon
            </p>
         
            <ul class="about-list">
              <li class="about-item">
                <div class="about-icon">
                  <ion-icon name="chevron-forward"></ion-icon>
                </div>
                <p class="about-text">
                  Providing safe, reliable, and efficient transportation services.
                </p>
              </li>

              <li class="about-item">
                <div class="about-icon">
                  <ion-icon name="chevron-forward"></ion-icon>
                </div>
                <p class="about-text">
                  Prioritizing comfort, punctuality, and accessibility for all passengers.
                </p>
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
                  Honoring Lebanon's pulse with every honk and every turn.
                </p>
              </li>

              <li class="about-item">
                <div class="about-icon">
                  <ion-icon name="chevron-forward"></ion-icon>
                </div>
                <p class="about-text">
                  Where Lebanon's traffic turns into a celebration of tarab.
                </p>
              </li>
            </ul>

            <a href="pages\searchplanner.html" class="btn">Learn More</a>
          </div>
        </div>
      </section>

      <!-- FEATURE SECTION -->
      <section class="section feature" aria-label="feature" style="background-color: rgb(243, 248, 253);">
        <div class="container">
          <div class="title-wrapper">
            <div>
              <p class="section-subtitle">Routes & Stops</p>
              <h2 class="h2 section-title">Our Latest Bus Routes and Stops.</h2>
              <p class="section-text">
                Providing frequent stops to ensure accessibility for all passengers.
              </p>
            </div>
            <a href="pages\searchplanner.html" class="btn">Read More</a>
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
      
      <!-- UPDATES SECTION -->
      <section class="section updates-map" class="updates-map" aria-label="updates-map"
        style="background-image: url('assets\images_v5\inside2.jpg'); background-repeat: no-repeat;; background-size: cover; background-position: center;">
        <div class="container">
          <div class="title-wrapper">
            <h1 class="section-subtitle" style="font-size: 100px;">Bus Line Updates</h1>
            <h2 class="h2 section-title" style="color: rgb(134, 166, 192);">Stay informed about delays, cancellations, or schedule changes.</h2>
          </div>

          <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1xj7EirT1nTXvtXv52VAkjy3f8OpAZkU" width="100%" height="600"></iframe>

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
      <!-- PROJECT SECTION -->
      <section class="section project" aria-label="project">
        <div class="container">
          <p class="section-subtitle">Communication</p>
          <h2 class="h2 section-title">Engagement Featured</h2>
          <p class="section-text">
            Offering a platform for passengers to provide feedback or ask questions enhances user satisfaction.
          </p>

          <ul class="project-list">
            <li class="project-item">
              <div class="project-card">
                <figure class="card-banner img-holder" style="--width: 397; --height: 352;">
                  <img src="assets\images_v5\report.jpg" width="397" height="352" loading="lazy"
                    alt="Warehouse inventory" class="img-cover">
                </figure>

                <button class="action-btn" aria-label="View image">
                  <ion-icon name="expand-outline"></ion-icon>
                </button>

                <div class="card-content">
                  <p class="card-tag"> Passenger Reporting System</p>
                  <h3 class="h3">
                    <a href="pages\reportV3.html" class="card-title">Report drivers, incidents, or misconduct</a>
                  </h3>
                  <a href="pages\reportV3.html" class="card-link">click here</a>
                </div>
              </div>
            </li>

            <li class="project-item">
              <div class="project-card">
                <figure class="card-banner img-holder" style="--width: 397; --height: 352;">
                  <img src="assets\images_v5\pay.jpg" width="397" height="352" loading="lazy"
                    alt="Warehouse inventory" class="img-cover">
                </figure>

                <button class="action-btn" aria-label="View image">
                  <ion-icon name="expand-outline"></ion-icon>
                </button>

                <div class="card-content">
                  <p class="card-tag">Payment & Bus Card</p>
                  <h3 class="h3">
                    <a href="pages\paymentV3.html" class="card-title">Apply for a bus card</a>
                  </h3>
                  <a href="pages\paymentV3.html" class="card-link">click here</a>
                </div>
              </div>
            </li>

            <li class="project-item">
              <div class="project-card">
                <figure class="card-banner img-holder" style="--width: 397; --height: 352;">
                  <img src="assets\images_v5\opinion.jpg" width="397" height="352" loading="lazy"
                    alt="Warehouse inventory" class="img-cover">
                </figure>

                <button class="action-btn" aria-label="View image">
                  <ion-icon name="expand-outline"></ion-icon>
                </button>

                <div class="card-content">
                  <p class="card-tag">Reviews & Ratings</p>
                  <h3 class="h3">
                    <a href="pages\reviewV3.html" class="card-title">Share your experience with us</a>
                  </h3>
                  <a href="pages\reviewV3.html" class="card-link">click here</a>
                </div>
              </div>
            </li>

            <li class="project-item">
              <div class="project-card">
                <figure class="card-banner img-holder" style="--width: 397; --height: 352;">
                  <img src="assets\images_v5\bus2.jpg" width="397" height="352" loading="lazy"
                    alt="Warehouse inventory" class="img-cover">
                </figure>

                <button class="action-btn" aria-label="View image">
                  <ion-icon name="expand-outline"></ion-icon>
                </button>

                <div class="card-content">
                  <p class="card-tag"> Lost Items</p>
                  <h3 class="h3">
                    <a href="pages\lostV3.html" class="card-title">Report lost items on our buses.</a>
                  </h3>
                  <a href="pages\lostV3.html" class="card-link">click here</a>
                </div>
              </div>
            </li>

            <li class="project-item">
              <div class="project-card">
                <figure class="card-banner img-holder" style="--width: 397; --height: 352;">
                  <img src="assets\images_v5\employee2.jpg" width="397" height="352" loading="lazy"
                    alt="Warehouse inventory" class="img-cover">
                </figure>

                <button class="action-btn" aria-label="View image">
                  <ion-icon name="expand-outline"></ion-icon>
                </button>

                <div class="card-content">
                  <p class="card-tag">Contact Us</p>
                  <h3 class="h3">
                    <a href="pages\contactV3.html" class="card-title">Get in touch with us for any inquiries or support.</a>
                  </h3>
                  <a href="pages\contactV3.html" class="card-link">click here</a>
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

      <!-- NEWSLETTER SECTION -->
      <section class="section newsletter" aria-label="newsletter">
        <div class="container">
          <figure class="newsletter-banner img-holder">
            <!-- REMOVED AS PER ACTC REQUEST -->
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

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container">
      <div class="footer-top section">
        <div class="footer-brand">
          <a href="indexV51.html">
            <img src="assets\images_v5\ACTC LOGO -01.png" class="logo" alt="ACTC Public Transport">
          </a>

          <p class="footer-text">
            Empowering journeys, building connections, and driving progress every step of the way.
          </p>

          <ul class="social-list">
            <li>
              <a href="https://www.facebook.com/people/Ahdab-Commuting-Trading-Company-Public-Transport/61562826866056/" class="social-link">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>

            <li>
              <a href="https://www.instagram.com/actcpt.lb/?hl=en" class="social-link">
                <ion-icon name="logo-instagram"></ion-icon>
              </a>
            </li>

            <li>
              <a href="https://www.youtube.com/watch?v=CBHuCte5bdg" class="social-link">
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
            <a href="pages\searchplanner.html" class="footer-link">Lines</a>
          </li>
          <li>
            <a href="#" class="footer-link">About</a>
          </li>
          <li>
            <a href="#" class="footer-link">Blog</a>
          </li>
          <li>
            <a href="#" class="footer-link">FAQ</a>
          </li>
          <li>
            <a href="pages\contactV3.html" class="footer-link">Contact Us</a>
          </li>
        </ul>

        <ul class="footer-list">
          <li>
            <p class="footer-list-title">Community</p>
          </li>
          <li>
            <a href="#" class="footer-link">Testimonials</a>
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

  <!-- BACK TO TOP -->
  <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn>
    <ion-icon name="chevron-up"></ion-icon>
  </a>

  <!-- custom js link -->
  <script src="assets/js/scriptV3.js" defer></script>
<script>
// Function to set cookie
function setCookie(name, value, days) {
  let expires = "";
  if (days) {
    const d = new Date();
    d.setTime(d.getTime() + (days*24*60*60*1000));
    expires = "; expires=" + d.toUTCString();
  }
  document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

// Function to get cookie
function getCookie(name) {
  const nameEQ = name + "=";
  const ca = document.cookie.split(';');
  for(let i=0; i < ca.length; i++) {
    let c = ca[i];
    while(c.charAt(0)==' ') c = c.substring(1,c.length);
    if(c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}

// Show popup if cookie not set
window.onload = function() {
  if (!getCookie("cookiesAccepted")) {
    document.getElementById("cookie-popup").style.display = "flex";
  }

  document.getElementById("accept-cookies").onclick = function() {
    setCookie("cookiesAccepted", "yes", 365);
    document.getElementById("cookie-popup").style.display = "none";
  };
};
</script>

  <!-- ionicon link -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <!-- Cookie Consent Popup -->

<script>
// Show cookie popup after 3 seconds if consent not given
document.addEventListener('DOMContentLoaded', function() {
    <?php if ($showCookieConsent): ?>
        setTimeout(function() {
            document.getElementById('cookie-popup').style.display = 'block';
        }, 3000);
    <?php endif; ?>
    
    // Track route usage - modify your existing startJourney function
    function startJourney() {
        const routeSelect = document.getElementById('route-select');
        const selectedRoute = routeSelect.value;
        
        if (selectedRoute) {
            // Track route usage if analytics cookies are enabled
            <?php if (($_COOKIE['cookie_analytics'] ?? 'false') === 'true'): ?>
                // Refresh page with route tracking parameter
                window.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>?route_used=' + encodeURIComponent(selectedRoute);
            <?php else: ?>
                // Continue with normal function
                // ... your existing startJourney code ...
            <?php endif; ?>
        }
    }
    
    // Make startJourney available globally
    window.startJourney = startJourney;
});
</script>
</body>
</html>
