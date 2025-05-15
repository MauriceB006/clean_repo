<?php
// Debug first
echo "<pre>POST Data: ";
print_r($_POST);
echo "</pre>";

// Database connection
$conn = new mysqli('localhost', 'root', '', 'project');
if ($conn->connect_error) die("Connection failed: ".$conn->connect_error);

// Get form data
$name = $_POST['user_name'];
$contact = $_POST['contact_info'];
$line = $_POST['route_line']; // Will be "1", "2", or "3"
$date = $_POST['lost_date'];
$description = $_POST['item_description'];

// Convert to integer
$line_id = (int)$line;

// Insert into database
$stmt = $conn->prepare("INSERT INTO lostitems 
    (user_name, line_id, item_description, lost_date, contact_info) 
    VALUES (?, ?, ?, ?, ?)");

// Bind parameters - note "i" for integer
$stmt->bind_param("sisss", $name, $line_id, $description, $date, $contact);

if ($stmt->execute()) {
    echo "Success! Inserted ID: ".$stmt->insert_id;
} else {
    echo "Error: ".$stmt->error;
}

$stmt->close();
$conn->close();
?>