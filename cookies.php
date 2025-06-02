<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie Consent</title>
    <style>
        /* Modern cookie consent styling */
        #cookie-consent {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #2d3748;
            color: white;
            padding: 1rem;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.2);
            z-index: 9999;
            display: none;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .cookie-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 1rem;
        }

        .cookie-message {
            flex: 1;
            min-width: 300px;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .cookie-link {
            color: #63b3ed;
            text-decoration: underline;
            font-weight: 500;
        }

        .cookie-link:hover {
            color: #90cdf4;
        }

        .cookie-button {
            background: #4299e1;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 0.5rem 1rem;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: background 0.2s ease;
        }

        .cookie-button:hover {
            background: #3182ce;
        }

        @media (max-width: 640px) {
            .cookie-container {
                flex-direction: column;
                text-align: center;
            }
            
            .cookie-button {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div id="cookie-consent">
    <div class="cookie-container">
        <p class="cookie-message">
            We use cookies to enhance your experience on our website. By clicking "Accept", you consent to our use of cookies.
            <a href="/privacy" class="cookie-link" target="_blank">Learn more</a>
        </p>
        <button id="cookie-accept" class="cookie-button">Accept</button>
    </div>
</div>

<script>
    // Test if cookies are enabled
    function areCookiesEnabled() {
        try {
            // Set a test cookie
            document.cookie = "testCookie=1; SameSite=Lax; path=/";
            return document.cookie.indexOf("testCookie=") !== -1;
        } catch (e) {
            return false;
        }
    }

    // Enhanced cookie functions
    function setCookie(name, value, days) {
        if (!areCookiesEnabled()) return false;
        
        try {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            const expires = "expires=" + date.toUTCString();
            document.cookie = `${name}=${value};${expires};path=/;SameSite=Lax`;
            return true;
        } catch (e) {
            console.error("Error setting cookie:", e);
            return false;
        }
    }

    function getCookie(name) {
        if (!areCookiesEnabled()) return null;
        
        try {
            const nameEQ = name + "=";
            const cookies = document.cookie.split(';');
            for (let i = 0; i < cookies.length; i++) {
                let cookie = cookies[i].trim();
                if (cookie.indexOf(nameEQ) === 0) {
                    return cookie.substring(nameEQ.length);
                }
            }
            return null;
        } catch (e) {
            console.error("Error reading cookies:", e);
            return null;
        }
    }

    // Initialize cookie consent
    document.addEventListener("DOMContentLoaded", function() {
        const consentPopup = document.getElementById("cookie-consent");
        const acceptButton = document.getElementById("cookie-accept");
        
        // First check if cookies are enabled at all
        if (!areCookiesEnabled()) {
            console.warn("Cookies are disabled in browser settings");
            // You might want to show a persistent message here
            return;
        }

        // Only show if consent not given
        if (getCookie("cookie_consent") !== "true") {
            consentPopup.style.display = "block";
        }

        // Handle accept button click
        acceptButton.addEventListener("click", function() {
            if (setCookie("cookie_consent", "true", 365)) {
                consentPopup.style.display = "none";
            } else {
                // Only show alert if we're sure cookies are supposed to work
                if (areCookiesEnabled()) {
                    alert("We couldn't save your preference. Please try again.");
                }
            }
        });
    });
</script>

</body>
</html>