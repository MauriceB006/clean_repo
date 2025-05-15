<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTC - Login / Signup </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css" />
</head>
<body>
    <div class="container" id="container">
        <!-- Registration Form -->
        <div class="form-container register-container">
            <form action="process_auth.php" method="post">
                <h1>Create an account</h1>
                <?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
                    <div class="error-message">
                        <?php foreach ($_SESSION['errors'] as $error): ?>
                            <p><?php echo htmlspecialchars($error); ?></p>
                        <?php endforeach; ?>
                        <?php unset($_SESSION['errors']); ?>
                    </div>
                <?php endif; ?>
                
                <input type="text" name="full_name" placeholder="Full Name" required 
                       >
                <input type="email" name="email" placeholder="Email" required 
                       >
                <input type="tel" name="phone" placeholder="Phone Number" required 
                       >
                <input type="password" name="password" id="password" placeholder="Password" required>
                <div class="input-container">
                    <span id="togglePassword" onclick="togglePassword()" style="cursor: pointer;" class="icon-container">
                        <i class="fa fa-eye" id="eyeIcon"></i>
                    </span>
                </div>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <button type="submit" name="register">Create</button>
                <?php unset($_SESSION['form_data']); ?>
            </form>
        </div>

        <!-- Login Form -->
        <div class="form-container login-container">
            <form action="process_auth.php" method="post">
                <h1>Login here</h1>
                <?php if (isset($_SESSION['login_error'])): ?>
                    <div class="error-message">
                        <p><?php echo htmlspecialchars($_SESSION['login_error']); ?></p>
                        <?php unset($_SESSION['login_error']); ?>
                    </div>
                <?php endif; ?>
                
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <div class="content">
                    <div class="checkbox">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <div class="pass-link">
                        <a href="forgot_password.php">Forgot password?</a>
                    </div>
                </div>
                <button type="submit" name="login">Login</button>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="title">Welcome <br> Back!</h1>
                    <p>Already have an account? Login</p>
                    <button class="ghost" id="login">Login</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="title">Join us <br> now!</h1>
                    <p>Don't have an account? Create one</p>
                    <button class="ghost" id="register">Register</button>
                </div>
            </div>
        </div>
    </div>
    <script src="login.js"></script>
</body>
</html>