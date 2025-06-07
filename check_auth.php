<?php


if (!isset($_SESSION['user_id'])) {
    // Check for remember me token
    if (isset($_COOKIE['remember_token'])) {
        $conn = new mysqli("localhost", "", "root", "project");
        
        $stmt = $conn->prepare("SELECT id, full_name FROM users WHERE remember_token = ?");
        $stmt->bind_param("s", $_COOKIE['remember_token']);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
        }
        
        $stmt->close();
        $conn->close();
    }
}
?>