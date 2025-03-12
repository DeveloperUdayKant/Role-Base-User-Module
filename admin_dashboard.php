<?php
session_start();

// Verify that the user is logged in and has the admin role.
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
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
    <main>
        <section>
            <h2>Pending User Approvals</h2>
            <?php
            // Retrieve all pending users (is_active = 0)
            $stmt = $pdo->prepare("SELECT * FROM users WHERE is_active = 0");
            $stmt->execute();
            $pendingUsers = $stmt->fetchAll();

            if(count($pendingUsers) > 0){
                echo "<table>";
                echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Current Role</th><th>Action</th></tr>";
                foreach($pendingUsers as $user){
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($user['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['role']) . "</td>";
                    // Link to the approval action with the user's ID
                    echo "<td>";
                // Form for approving the user with role selection
                    echo "<form action='approve_user.php' method='post'>";
                        echo "<input type='hidden' name='id' value='" . htmlspecialchars($user['id']) . "'>";
                        echo "<select name='role'>";
                            // Define available roles
                            $roles = array("user", "editor", "guest");
                            foreach($roles as $roleOption) {
                                $selected = ($user['role'] == $roleOption) ? "selected" : "";
                                echo "<option value='" . htmlspecialchars($roleOption) . "' $selected>" . htmlspecialchars(ucfirst($roleOption)) . "</option>";
                            }
                        echo "</select>";
                        echo "<button type='submit'>Approve</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No pending approvals.</p>";
            }
            ?>
        </section>
    </main>
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
