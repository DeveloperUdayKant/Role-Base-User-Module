<?php
include 'db.php';

$email = trim($_POST['email']);
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if($user){
    // Generate a secure token and set an expiry (e.g., 1 hour)
    $token = bin2hex(random_bytes(50));
    $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

    // Store the token and expiry in the database for that user
    $stmt = $pdo->prepare("UPDATE users SET reset_token = ?, reset_expiry = ? WHERE email = ?");
    $stmt->execute([$token, $expiry, $email]);

    // Build the reset link (update 'yourdomain.com' to your actual domain)
    $reset_link = "http://yourdomain.com/reset_password.php?token=" . $token;

    // Send the email using PHP mail or any mail library (error handling omitted for brevity)
    $subject = "Password Reset Request";
    $message = "Click the following link to reset your password: " . $reset_link;
    $headers = "From: no-reply@yourdomain.com";
    mail($email, $subject, $message, $headers);

    echo "A password reset link has been sent to your email.";
} else {
    echo "No user found with that email address.";
}
?>
