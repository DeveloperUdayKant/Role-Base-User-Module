<?php
session_start();

// Ensure only admin can perform this action.
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include 'db.php'; // Include your PDO connection.

// Check if the required POST parameters are set.
if (isset($_POST['id']) && isset($_POST['role'])) {
    // Sanitize and validate the user ID.
    $userId = intval($_POST['id']);
    
    // Define allowed roles and validate the selected role.
    $allowedRoles = ['user', 'editor', 'guest'];
    $role = $_POST['role'];
    if (!in_array($role, $allowedRoles)) {
         echo "Invalid role selected.";
         exit;
    }

    // Update the user record: set is_active to 1 (approved) and update the role.
    $stmt = $pdo->prepare("UPDATE users SET is_active = 1, role = ? WHERE id = ?");
    if ($stmt->execute([$role, $userId])) {
        // Redirect back to the dashboard with a success message.
        header("Location: admin_dashboard.php?msg=UserApproved");
        exit;
    } else {
        echo "Error approving user. Please try again.";
    }
} else {
    echo "Required parameters are missing.";
}
?>
