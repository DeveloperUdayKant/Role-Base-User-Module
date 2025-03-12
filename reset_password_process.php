<?php
include 'db.php';
if(isset($_POST['token']) && isset($_POST['new_password'])){
    $token = $_POST['token'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    
    // Update the password and clear the reset token and expiry
    $stmt = $pdo->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expiry = NULL WHERE reset_token = ?");
    if($stmt->execute([$new_password, $token])){
        echo "Your password has been reset successfully.";
    } else {
        echo "There was an error resetting your password. Please try again.";
    }
}
?>
