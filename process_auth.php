<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Handle login
    if (isset($_POST['login'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $password = $_POST['password'];
        
        // Changed to password1 to match database
        $stmt = $conn->prepare("SELECT user_id, full_name, password1 FROM users WHERE email = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password1'])) {
                // Successful login
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['full_name'];
                
                // Remember me functionality
                if (isset($_POST['remember'])) {
                    $token = bin2hex(random_bytes(32));
                    setcookie('remember_token', $token, time() + 86400 * 30, "/");
                    
                    $updateStmt = $conn->prepare("UPDATE users SET remember_token = ? WHERE user_id = ?");
                    $updateStmt->bind_param("si", $token, $user['user_id']);
                    $updateStmt->execute();
                    $updateStmt->close();
                }
                
                header("Location: indexV51.php");
                exit();
            }
        }
        
        // If login fails
        $_SESSION['login_error'] = "Invalid email or password";
        header("Location: sign_in.php");
        exit();
    }

    // Handle registration
    if (isset($_POST['register'])) {
        $_SESSION['errors'] = [];
        
        // [Keep all your existing validation code...]
        
        // If no errors, register user
        if (empty($_SESSION['errors'])) {
            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $phone = !empty($_POST['phone']) ? $_POST['phone'] : null;
            
            // This is correct for password1 column
            $stmt = $conn->prepare("INSERT INTO users (full_name, email, phone, password1) VALUES (?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Prepare failed: " . $conn->error);
            }
            
            $stmt->bind_param("ssss", $_POST['full_name'], $_POST['email'], $phone, $hashedPassword);
            
            if ($stmt->execute()) {
                // Success - log in user
                $_SESSION['user_id'] = $stmt->insert_id;
                $_SESSION['user_name'] = $_POST['full_name'];
                header("Location: indexV51.php");
                exit();
            } else {
                throw new Exception("Execute failed: " . $stmt->error);
            }
        } else {
            $_SESSION['form_data'] = $_POST;
            header("Location: indexV51.php");
            exit();
        }
    }

} catch (Exception $e) {
    $_SESSION['errors'][] = "System error: " . $e->getMessage();
    header("Location: sign_in.php");
    exit();
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}
?>