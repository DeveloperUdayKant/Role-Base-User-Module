<?php
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'db.php'; // Your PDO connection

// Check required POST fields
if (isset($_POST['current_password']) && isset($_POST['new_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $user_id = $_SESSION['user_id'];

    // Retrieve the current password hash from the database
    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    if (!$user) {
        echo "User not found.";
        exit;
    }

    // Verify the current password
    if (password_verify($current_password, $user['password'])) {
        // Hash the new password and update it in the database
        $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $updateStmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        if ($updateStmt->execute([$new_password_hash, $user_id])) {
            header("Location: settings.php?msg=PasswordUpdated");
            exit;
        } else {
            echo "Error updating password. Please try again.";
        }
    } else {
        echo "Current password is incorrect.";
    }
} else {
    echo "Required fields are missing.";
}
?>
