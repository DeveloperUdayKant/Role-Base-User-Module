<?php
session_start();

// Verify that the user is logged in and has the admin role.
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'editor') {
    header("Location: login.php");
    exit;
}

include 'db.php'; 

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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="homestyles.css">
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
            <li><a href="profile.php?<?php echo htmlspecialchars($user['username']); ?>">Profile</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="main-content">
    <div class="dashboard-card">
      <h2>Welcome!</h2>
      <p>This is your home page. You can view your latest updates and manage your account from here.</p>
    </div>
    <!-- Add more cards or content sections as needed -->
  </div>
  <footer>
    <p>&copy; 2025. All rights reserved.</p>
  </footer>
</body>
</html>
