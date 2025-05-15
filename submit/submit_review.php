<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$host = 'localhost';
$dbname = 'project';
$username = 'root';
$password = '';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Validate inputs
        $required_fields = ['line', 'date', 'time', 'rating', 'comment'];
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("All fields are required");
            }
        }

        // For demonstration, using a static user_id - in real app, get from session
        $user_id = 1; // Replace with actual user ID from your authentication system
        
        $line_id = htmlspecialchars(trim($_POST['line']));
        $rating = intval($_POST['rating']);
        $comment = htmlspecialchars(trim($_POST['comment']));
        $travel_date = $_POST['date'];
        $travel_time = $_POST['time'];

        // Validate rating
        if ($rating < 1 || $rating > 5) {
            throw new Exception("Invalid rating value");
        }

        // Validate date
        if (!DateTime::createFromFormat('Y-m-d', $travel_date)) {
            throw new Exception("Invalid date format");
        }

        // Create database connection
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the insert statement
        $stmt = $conn->prepare("INSERT INTO reviews12 
                              (user_id, line_id, rating, comment, travel_date, travel_time) 
                              VALUES (:user_id, :line_id, :rating, :comment, :travel_date, :travel_time)");
        
        $stmt->execute([
            ':user_id' => $user_id,
            ':line_id' => $line_id,
            ':rating' => $rating,
            ':comment' => $comment,
            ':travel_date' => $travel_date,
            ':travel_time' => $travel_time
        ]);

        // Success - redirect to indexV3.1.php
        header("Location: indexV3,1.php");
        exit();

    } catch(PDOException $e) {
        // Log the error and show a message
        error_log("Database error: " . $e->getMessage());
        die("An error occurred while submitting your review. Please try again later.");
    } catch(Exception $e) {
        // Log the error and show a message
        error_log("Error: " . $e->getMessage());
        die($e->getMessage());
    }
} else {
    // If someone tries to access this page directly, redirect them
    header("Location: indexV3,1.php");
    exit();
}