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