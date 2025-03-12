<?php
// Include database connection
include 'db.php';

// Retrieve and sanitize user inputs
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Set default role and inactive status pending admin approval
$role = 'user';
$is_active = 0;

$stmt = $pdo->prepare("INSERT INTO users (username, email, password, role, is_active) VALUES (?, ?, ?, ?, ?)");
if($stmt->execute([$username, $email, $password, $role, $is_active])){
    echo "Signup successful. Please wait for admin approval.";
} else {
    echo "Error during signup. Please try again.";
}
?>
