'use strict';



/**
 * navbar toggle
 */

const navbar = document.querySelector("[data-navbar]");
const navToggler = document.querySelectorAll("[data-nav-toggler]");
const navLinks = document.querySelectorAll("[data-nav-link]");
const overlay = document.querySelector("[data-overlay]");

for (let i = 0; i < navToggler.length; i++) {
  navToggler[i].addEventListener("click", function () {
    navbar.classList.toggle("active");
    overlay.classList.toggle("active");
  });
}

for (let i = 0; i < navLinks.length; i++) {
  navLinks[i].addEventListener("click", function () {
    navbar.classList.remove("active");
    overlay.classList.remove("active");
  });
}



/**
 * header
 */

const header = document.querySelector("[data-header]");
const backTopBtn = document.querySelector("[data-back-top-btn]");

window.addEventListener("scroll", function () {
  if (window.scrollY >= 100) {
    header.classList.add("active");
    backTopBtn.classList.add("active");
  } else {
    header.classList.remove("active");
    backTopBtn.classList.remove("active");
  }
});
const routes1 = {
  B1: ["City Mall", "Ain El Mraiseh", "Raouche", "Mazraa", "Cola", "Adlieh", "Corniche El Nahr", "Dora"],
  ML3: ["City Mall", "Bourj Hammond", "Saloumi", "Chevrolet", "Al Hadath", "Antounieh", "Saraya Baabda", "Dora"],
  B3: ["Mar Mikhael", "Sagesse", "Borj al Ghazal", "BDL", "LAU Lower Gate", "Makdissi St", "AUB Upper Gate", "Sanayeh", "Gemmayze", "EDL"],
  B2: ["Dora", "Corniche El Nahr", "Adlieh", "Cola", "Mazraa", "Raouche", "Ain El Mraiseh", "City Mall"]
};

function startJourney() {
  const selectedRoute = document.getElementById("route-select").value;
  const stopsDiv = document.getElementById("stops");
  const bus = document.getElementById("bus");

  // Reset the stops and bus position
  stopsDiv.innerHTML = "";
  bus.style.left = "0px";

  if (selectedRoute) {
    const stops = routes1[selectedRoute];
    stops.forEach((stop) => {
      const stopDiv = document.createElement("div");
      stopDiv.className = "stop";
      stopDiv.innerHTML = `<div class="circle"></div><span>${stop}</span>`;
      stopsDiv.appendChild(stopDiv);
    });

    let currentStop = 0;
    const totalStops = stops.length;
    const roadWidth = stopsDiv.offsetWidth;
    const stepWidth = roadWidth / (totalStops - 1);

    const interval = setInterval(() => {
      if (currentStop < totalStops) {
        const circles = document.getElementsByClassName("circle");

        // Move the bus to the next stop
        bus.style.left = `${stepWidth * currentStop}px`;

        // Highlight the current stop
        Array.from(circles).forEach((circle, index) => {
          circle.classList.remove("bus-arrived");
          if (index === currentStop) {
            circle.classList.add("bus-arrived");
          }
        });

        currentStop++;
      } else {
        clearInterval(interval); // Stop the journey when completed
      }
    }, 750); // Move to the next stop every second
  }
}
const fares = {
  B1: "200,000 LBP",
  ML3: "250,000 LBP",
  B3: "180,000 LBP",
  B2: "200,000 LBP"
};

function showPrice() {
  const selectedRoute = document.getElementById("route-select").value;
  const priceText = document.getElementById("price-text");
  const priceDisplay = document.getElementById("price-display");

  if (selectedRoute) {
    // Display the price for the selected route
    priceText.textContent = `The fare for Line ${selectedRoute} is ${fares[selectedRoute]}.`;
  } else {
    // Handle case where no line is selected
    priceText.textContent = "Please select a line to view its fare.";
  }

  // Make the price display section visible
  priceDisplay.style.display = "block";
}// Initialize the map
const map = L.map('map').setView([33.8938, 35.5018], 12); // Centered on Beirut

// Add a tile layer (base map)
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 18,
  attribution: '© OpenStreetMap contributors'
}).addTo(map);

// Bus line data (coordinates of stops)
const routes = {
  B1: [
    [33.8938, 35.5018], // City Mall
    [33.9015, 35.5096], // Ain El Mraiseh
    [33.9055, 35.5146], // Raouche
    [33.8999, 35.5031], // Mazraa
    [33.8962, 35.4937], // Cola
    [33.8931, 35.4835], // Adlieh
    [33.8916, 35.4729], // Corniche El Nahr
    [33.8869, 35.4825]  // Dora
  ],
  ML3: [
    [33.8938, 35.5018], // City Mall
    [33.8980, 35.4889], // Bourj Hammond
    [33.8921, 35.4803], // Saloumi
    [33.8875, 35.4730], // Chevrolet
    [33.8829, 35.4710], // Al Hadath
    [33.8787, 35.4690], // Antounieh
    [33.8735, 35.4671], // Saraya Baabda
    [33.8689, 35.4649]  // Dora
  ],
  B3: [
    [33.8959, 35.5186], // Mar Mikhael
    [33.8978, 35.5123], // Sagesse
    [33.8985, 35.5092], // Borj al Ghazal
    [33.8992, 35.5075], // BDL
    [33.8999, 35.5032], // LAU Lower Gate
    [33.9010, 35.5010], // Makdissi St
    [33.9021, 35.5000], // AUB Upper Gate
    [33.9035, 35.4989], // Sanayeh
    [33.9048, 35.4955], // Gemmayze
    [33.9062, 35.4920]  // EDL
  ],
  B2: [
    [33.8869, 35.4825], // Dora
    [33.8916, 35.4729], // Corniche El Nahr
    [33.8931, 35.4835], // Adlieh
    [33.8962, 35.4937], // Cola
    [33.8999, 35.5031], // Mazraa
    [33.9055, 35.5146], // Raouche
    [33.9015, 35.5096], // Ain El Mraiseh
    [33.8938, 35.5018]  // City Mall
  ]
};

// Function to show a selected route on the map
function showLine(line) {
  // Clear existing layers
  map.eachLayer((layer) => {
    if (!!layer.toGeoJSON) {
      map.removeLayer(layer);
    }
  });

  // Add the base map again
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  // Check if the route exists
  if (routes[line]) {
    const routeCoordinates = routes[line];

    // Draw the route as a polyline
    const polyline = L.polyline(routeCoordinates, { color: 'blue', weight: 5 }).addTo(map);

    // Add markers for stops
    routeCoordinates.forEach((coords, index) => {
      L.marker(coords).addTo(map)
        .bindPopup(`<b>Stop ${index + 1}</b>`)
        .openPopup();
    });

    // Fit the map view to the route
    map.fitBounds(polyline.getBounds());
  }
}
function showDetails(id) {
  const detail = document.getElementById(id);
  if (detail.style.display === "none") {
    detail.style.display = "block";
  } else {
    detail.style.display = "none";
  }
}
document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.querySelector('.search-input');
  const searchButton = document.querySelector('.search-button');

  // Example: Data for the bus lines
  const busLines = ['B1', 'ML3', 'B3', 'B2'];

  // Handle search functionality
  searchButton.addEventListener('click', (event) => {
      event.preventDefault(); // Prevent default button behavior

      const searchQuery = searchInput.value.trim().toLowerCase();

      if (searchQuery === '') {
          alert('Please enter a search query.');
          return;
      }

      // Search logic: Match search query with bus lines
      const matchingLines = busLines.filter(line => line.toLowerCase().includes(searchQuery));

      if (matchingLines.length > 0) {
          alert(`Matching Bus Lines: ${matchingLines.join(', ')}`);
          // You can further implement logic to dynamically display or highlight the matching results
      } else {
          alert('No matching bus lines found.');
      }
  });
});
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


