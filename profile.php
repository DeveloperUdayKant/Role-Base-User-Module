<?php
session_start();

// Check if the user is logged in; otherwise, redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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
  <title>My Profile</title>
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
    <div class="profile-container">
      <h2>Profile Details</h2>
      <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
      <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
      <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
    </div>
  </main>
  <footer>
    <p>&copy; 2025. All rights reserved.</p>
  </footer>
</body>
</html>
