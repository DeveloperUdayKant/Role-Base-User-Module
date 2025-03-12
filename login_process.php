<?php
session_start();
include 'db.php';

$email = trim($_POST['email']);
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if($user){
    if(!$user['is_active']){
        echo "Your account has not been activated yet. Please wait for admin approval.";
        exit;
    }
    if(password_verify($password, $user['password'])){
         $_SESSION['user_id'] = $user['id'];
         $_SESSION['role'] = $user['role'];
         // Redirect user based on their role
         if($user['role'] == 'admin'){
             header("Location: admin_dashboard.php");
         } elseif($user['role'] == 'user'){
             header("Location: user_dashboard.php");
         }elseif($user['role'] == 'editor'){
            header("Location: editor_dashboard.php");
         } else {
             // For additional roles, add conditions as needed
             header("Location: index_dashboard.php");
         }
         exit;
    } else {
         echo "Invalid email or password.";
         header("Location: login.php");
    }
} else {
    echo "No user found with that email.";
}
?>
