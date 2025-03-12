<?php
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'db.php'; // Your PDO connection

// Check required POST fields
if (isset($_POST['username']) && isset($_POST['email'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $user_id = $_SESSION['user_id'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Update the user's profile
    $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    if ($stmt->execute([$username, $email, $user_id])) {
        // Optionally update session values
        $_SESSION['username'] = $username;
        header("Location: profile.php?msg=ProfileUpdated");
        exit;
    } else {
        echo "Error updating profile. Please try again.";
    }
} else {
    echo "Required fields are missing.";
}
?>
