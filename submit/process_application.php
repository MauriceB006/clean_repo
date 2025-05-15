<?php
// Database configuration
$host = 'localhost';
$dbname = 'project';
$username = 'root';
$password = '';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Validate inputs
        $required_fields = ['name', 'email', 'phone', 'address'];
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("All fields are required");
            }
        }

        $name = htmlspecialchars(trim($_POST['name']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $phone = htmlspecialchars(trim($_POST['phone']));
        $address = htmlspecialchars(trim($_POST['address']));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }

        // Create connection
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert data
        $stmt = $conn->prepare("INSERT INTO bus_card_applications 
                              (name, email, phone, address) 
                              VALUES (:name, :email, :phone, :address)");
        
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':address' => $address
        ]);

        // Success
        header("Location: success.html");
        exit();

    } catch(PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    } catch(Exception $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<!-- Display errors on the same page if you prefer -->
<?php if (!empty($error)): ?>
    <div style="color: red; padding: 10px; margin: 10px 0; border: 1px solid red;">
        <?php echo htmlspecialchars($error); ?>
    </div>
<?php endif; ?>