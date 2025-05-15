<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: sign_in.php");
    exit();
}

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verify user exists
$check_user = $conn->prepare("SELECT user_id FROM users WHERE user_id = ?");
$check_user->bind_param("i", $_SESSION['user_id']);
$check_user->execute();
$check_user->store_result();

if ($check_user->num_rows == 0) {
    $check_user->close();
    $conn->close();
    header("Location: sign_in.php");
    exit();
}
$check_user->close();

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate required fields
    $required = ['name', 'contact', 'line', 'date', 'time', 'description', 'public'];
    $errors = [];
    
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "The $field field is required.";
        }
    }
    
    // Validate line selection
    if (empty($_POST['line']) || !is_numeric($_POST['line'])) {
        $errors[] = "Please select a valid bus line.";
    }
    
    // If errors exist, show them
    if (!empty($errors)) {
        echo "<h2>Form Errors:</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
        exit();
    }

    // Get and sanitize form data
    $name = $conn->real_escape_string($_POST['name']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $line_id = (int)$_POST['line']; // Convert to integer
    $incident_date = $_POST['date'];
    $incident_time = $_POST['time'];
    $prob_desc = $conn->real_escape_string($_POST['description']);
    $is_public = ($_POST['public'] == 'yes') ? 1 : 0;
    
    // Validate date format
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $incident_date)) {
        die("Invalid date format. Please use YYYY-MM-DD.");
    }
    
    // Validate time format
    if (!preg_match('/^\d{2}:\d{2}$/', $incident_time)) {
        die("Invalid time format. Please use HH:MM.");
    }

    // Verify line exists in buslines table
    $check_line = $conn->prepare("SELECT line_id FROM buslines1 WHERE line_id = ?");
    $check_line->bind_param("i", $line_id);
    $check_line->execute();
    $check_line->store_result();

    if ($check_line->num_rows == 0) {
        // More detailed error message
        die("Error: The selected bus line (ID: $line_id) does not exist in our system. Available lines: " . 
            implode(", ", getAvailableLineIds($conn)));
    }
    $check_line->close();
    
    // Helper function to get available line IDs
    function getAvailableLineIds($conn) {
        $result = $conn->query("SELECT line_id FROM buslines1");
        $ids = [];
        while ($row = $result->fetch_assoc()) {
            $ids[] = $row['line_id'];
        }
        return $ids;
    }
    // Prepare and bind report insertion
    $stmt = $conn->prepare("INSERT INTO reports (user_id, line_id, prob_desc, incident_date, incident_time, is_public) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("iisssi", $_SESSION['user_id'], $line_id, $prob_desc, $incident_date, $incident_time, $is_public);
    
    // Execute the statement
    if ($stmt->execute()) {
        header("Location: thank_you.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close connections
    $stmt->close();
    $conn->close();
} else {
    // If not POST request, redirect to form
    header("Location: report.html");
    exit();
}
?>