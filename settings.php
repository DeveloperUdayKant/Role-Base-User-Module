<?php
session_start();

// Check if the user is logged in; otherwise, redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    echo "User not found.";
    exit;
}
include 'db.php'; // Your database connection file

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT username, email, role FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    echo "User not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Settings</title>
  <link rel="stylesheet" href="other.css"> 
</head>
<body>
  <header>
  <?php
        $dashboardUrl = "./" . htmlspecialchars($user['role']) . "_dashboard.php";
    ?>
        <a style="text-decoration:none;color:#fff;" href="<?php echo $dashboardUrl; ?>">
            <h1 style="text-transform: uppercase;cursor:pointer;">
                <?php echo htmlspecialchars($user['role']); ?> Dashboard
            </h1>
        </a>
    <nav>
      <ul>
        <li style="text-transform: uppercase;cursor:pointer;"><?php echo htmlspecialchars($user['username']); ?></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="settings.php">Settings</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <div class="settings-container">
      <h2>Update Profile</h2>
      <form action="update_profile.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        <button type="submit">Update Profile</button>
      </form>
      
      <h2>Change Password</h2>
      <form action="update_password.php" method="post">
        <label for="current_password">Current Password:</label>
        <input type="password" id="current_password" name="current_password" required>
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>
        <button type="submit">Change Password</button>
      </form>
    </div>
  </main>
  <footer>
    <p>&copy; 2025. All rights reserved.</p>
  </footer>
</body>
</html>
