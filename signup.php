<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>User Signup</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="form-container">
  <form action="signup_process.php" method="post">
    <h2>Signup</h2>
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Sign Up</button>
  </form>
</div>
</body>
</html>
