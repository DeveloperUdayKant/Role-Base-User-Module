<?php
include 'db.php';
if(isset($_GET['token'])){
    $token = $_GET['token'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_expiry > NOW()");
    $stmt->execute([$token]);
    $user = $stmt->fetch();
    if($user){
        // Display the password reset form if token is valid and not expired.
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <form action="reset_password_process.php" method="post">
    <h2>Enter New Password</h2>
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
    <input type="password" name="new_password" placeholder="New Password" required>
    <button type="submit">Reset Password</button>
  </form>
</body>
</html>
<?php
    } else {
        echo "The password reset link is invalid or has expired.";
    }
} else {
    echo "No reset token provided.";
}
?>
